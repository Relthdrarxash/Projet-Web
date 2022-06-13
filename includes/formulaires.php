<?php

//****************Génération du menu**************************************
function generationMenu($tableauMenu)
{
    // on exploite le fait que l'html n'est que du texte pour le stocker dans une variable
    // et ensuite afficher le texte de cette variable sur la page
    $html = '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">' . "\n" .
        '<div class="container-fluid">' . "\n" .
        '<ul class="navbar-nav me-auto mb-2 mb-lg-0">' . "\n";

    // On récupère le nom de fichier pour le mettre en évidence avec le "active" de Bootstrap
    // On enlève tout le chemin avec le explode
    $fileName = explode("/", $_SERVER['SCRIPT_NAME']);
    // on récupère la fin du chemin (nom du fichier) avec le end
    $fileName = end($fileName);

    // Décommenter pour vérifier le nom du fichier
    // echo end($fileName);
    // Le code html du contenu est stocké dans la variable html
    foreach ($tableauMenu as $page) {
        /* On peut ptet s'éviter de faire deux fois le même test si on met le active dans un if
             En mode <a class="nav-link "<?php if ($_SERVER['PHP_SELF'] == $page['url']) echo 'active';?href='{$page['url']}'>{$page['texte']}</a>\n";
            */
        $html .= "<li>";

        // Si on n'est pas connecté -> affichage de la page connexion, pas d'affichage de la page déconnexion, pas d'affichge des pages insertion ou modification
        if (empty($_SESSION) && $page['statut'] == 'all' && $page['url'] != 'deconnexion.php') {
            if ($fileName == $page['url']) {
                // Ici on mettra le lien en active pour qu'il soit mis en évidence
                $html .= '<a class="nav-link active mr px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
            } else if ($page['url'] != 'deconnexion.php') {
                // Ici on va mettre toutes les autres pages qui seront pas en active du coup
                $html .= '<a class="nav-link px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
            }
        }

        // Si on est connecté -> On teste si on est un utilisateur ou un admin
        else {
            // Si utilisateur -> pas d'affichage des pages insertion et modification
            if (!empty($_SESSION) && $_SESSION["statut"] == 'utilisateur' && $page['statut'] == 'all' && $page['url'] != 'connexion.php') {
                if ($fileName == $page['url']) {
                    // Ici on mettra le lien en active pour qu'il soit mis en évidence
                    $html .= '<a class="nav-link active mr px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
                } else {
                    // Ici on va mettre toutes les autres pages qui seront pas en active du coup
                    $html .= '<a class="nav-link px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
                }
            } else if (!empty($_SESSION) && $_SESSION["statut"] == 'administrateur' && $page['url'] != 'connexion.php') {
                if ($_SESSION && $page['url'] != 'connexion.php') {
                    if ($fileName == $page['url']) {
                        // Ici on mettra le lien en active pour qu'il soit mis en évidence
                        $html .= '<a class="nav-link active mr px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
                    } else {
                        // Ici on va mettre toutes les autres pages qui seront pas en active du coup
                        $html .= '<a class="nav-link px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
                    }
                }
            }
        }
        // on ferme le li
        $html .= "</li>\n";
    }
    // on ferme le ul
    $html .= "</ul>\n";

    // on affiche l'utilisateur ou la demande de connexion à droite
    $html .= afficheUtilisateur();

    // on ferme les dernières balises
    $html .= "</div>\n";
    $html .= "</nav>\n";

    return $html;
}


//****************Génération du formulaire d'insertion de matériel**************************************
function afficheFormulaireInsertion()
{
    // on note les différents types pour en faire un menu dropdown
    $types = array('accessoire', 'écran', 'portable', 'serveur', 'station');
    $fournisseurs = recupFournisseur();
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="insertion" onsubmit="return validationMateriel();">
        <fieldset>
            <label for="id_type_mat">Type du matériel :</label>
            <select id="id_type_mat" name="type_mat" size="1">
                <?php
                foreach ($types as $type) {
                    if (isset($_POST['type_mat'])) {
                        if ($type == $_POST['type_mat']) {
                            echo '<option value="' . $type . '" selected>' . ucwords($type) . '</option>';
                        } else {
                            echo '<option value="' . $type . '">' . ucwords($type) . '</option>';
                        }
                    } else {
                        echo '<option value="' . $type . '">' . ucwords($type) . '</option>';
                    }
                    // ucwords pour mettre la première lettre en majuscule
                }
                ?>
            </select> <br />
            <label for="id_fournisseur">Fournisseur :</label>
            <select id="id_fournisseur" name="fournisseur" size="1">
                <?php
                foreach ($fournisseurs as $fournisseur) {
                    if (isset($_POST['fournisseur'])) {
                        if ($fournisseur["NomFournisseur"] == $_POST['fournisseur']) {
                            echo '<option value="' . $fournisseur["NomFournisseur"] . '" selected>' . $fournisseur["NomFournisseur"] . '</option>';
                        } else {
                            echo '<option value="' . $fournisseur["NomFournisseur"] . '">' . $fournisseur["NomFournisseur"] . '</option>';
                        }
                    } else {
                        echo '<option value="' . $fournisseur["NomFournisseur"] . '">' . $fournisseur["NomFournisseur"] . '</option>';
                    }
                }
                ?>
            </select> <br />
            <label for="id_marque">Marque : </label>
            <input type="text" name="marque" id="id_marque" placeholder="Marque" required size="6" value="<?php if (isset($_POST['marque'])) echo $_POST['marque'] ?>" /><br />

            <label for="id_description">Description : </label>
            <input type="text" name="description" id="id_description" placeholder="Description" required size="20" value="<?php if (isset($_POST['description'])) echo $_POST['description'] ?>" /><br />

            <label for="id_prix">Prix :</label>
            <input id="id_prix" name="prix" type="number" min="1" step="any" required value="<?php if (isset($_POST['prix'])) echo $_POST['prix'] ?>" /><br />

            <label for="id_nom_image">Nom de l'image : </label>
            <input type="text" name="nom_image" id="id_nom_image" placeholder="image.png" required size="6" value="<?php if (isset($_POST['nom_image'])) echo $_POST['nom_image'] ?>" />

            <input type="text" name="captcha" id="captcha" /> <br />
            <input type="submit" name="submit" value="Submit" />
            <img src="includes/image.php" onclick="this.src='includes/image.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
        </fieldset>
    </form>
<?php
    echo "<br/>";
} // fin afficheFormulairInsertion

function afficheFormulaireIdMateriel()
{
    if (!empty($_POST && isset($_POST["id_mat"]))) {
        $selection = $_POST["id_mat"];
    }
    $tab = listeIdMateriel();
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="select_id_mat">
        <fieldset>

            <label for="id_mat">Sélectionner le numéro du matériel :</label>
            <select id="id_mat" name="id_mat" size="1">
                <?php
                foreach ($tab as $id) {
                    if (isset($selection) && $id["NoMateriel"] == $selection) {
                        echo '<option value="' . $id["NoMateriel"] . '" selected >' . $id["NoMateriel"] . '</option>';
                    } else {
                        echo '<option value="' . $id["NoMateriel"] . '">' . $id["NoMateriel"] . '</option>';
                    }
                }
                ?>
            </select> <br />
            <input type="submit" name="submit" />
        </fieldset>
    </form>
<?php
}


function afficheFormulaireModification($id)
{
    include('connexionBDD.php');

    $requete = 'SELECT Type_mat, Marque, Description, p.prix AS "Prix", Image, nomfournisseur FROM Materiel AS m INNER JOIN Propose as P ON p.nomateriel = m.nomateriel INNER JOIN Fournisseur AS f ON f.nofournisseur = p.nofournisseur WHERE m.NoMateriel = ' . $id . ';';
    $resultat = $BDD->query($requete);
    $materiel = $resultat->fetch(PDO::FETCH_ASSOC);

    // on note les différents types pour en faire un menu dropdown
    $types = array('accessoire', 'écran', 'portable', 'serveur', 'station');
    $fournisseurs = recupFournisseur();
    // décommenter pour voir le résultat de la requête
    // var_dump($materiel);
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="modification" onsubmit="return validationMateriel();">
        <fieldset>
            <label for="id_type_mat">Type du matériel :</label>
            <select id="id_type_mat" name="type_mat" size="1">
                <?php
                foreach ($types as $type) {
                    if ($materiel["Type_mat"] == $type) {
                        echo '<option value="' . $type . '" selected>' .  ucwords($type) . '</option>';
                    } else {
                        echo '<option value="' . $type . '">' .  ucwords($type) . '</option>';
                    }
                }
                ?>
            </select> <br />
            <label for="id_fournisseur">Fournisseur :</label>
            <select id="id_fournisseur" name="fournisseur" size="1">
                <?php
                foreach ($fournisseurs as $fournisseur) {
                    if ($fournisseur["NomFournisseur"] == $materiel["NomFournisseur"]) {
                        echo '<option value="' . $fournisseur["NomFournisseur"] . '" selected>' . $fournisseur["NomFournisseur"] . '</option>';
                    } else {
                        echo '<option value="' . $fournisseur["NomFournisseur"] . '">' . $fournisseur["NomFournisseur"] . '</option>';
                    }
                }
                ?>
            </select> <br />

            <label for="id_marque">Marque : </label>
            <input type="text" name="marque" id="id_marque" required size="6" value="<?= $materiel["Marque"]; ?>" /><br />

            <label for="id_description">Description : </label>
            <input type="text" name="description" id="id_description" required size="10" value="<?= $materiel["Description"]; ?>" /><br />

            <label for="id_prix">Prix (en €):</label>
            <input id="id_prix" name="prix" type="number" min="1" step="any" required value="<?= $materiel['Prix']; ?>" /><br />

            <input type="hidden" name="id_mat" value="<?= $_POST["id_mat"]; ?>" />

            <div onclick=""><input type="submit" value="Modifier" /></div>

        </fieldset>
    </form>
<?php
    echo "<br/>";
} // fin afficheFormulairModification

function afficheFormulaireTableauParType()
{
    $types = array('accessoire', 'écran', 'portable', 'serveur', 'station');
    $fournisseurs = recupFournisseur();
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validationMateriel();">
        <fieldset>
            <label for="id_type_mat">Type du matériel :</label>
            <select id="id_type_mat" name="type_mat" size="1">
                <?php
                foreach ($types as $type) {
                    if (isset($_POST['type_mat'])) {
                        if ($type == $_POST['type_mat']) {
                            echo '<option value="' . $type . '" selected>' . ucwords($type) . '</option>';
                        } else {
                            echo '<option value="' . $type . '">' . ucwords($type) . '</option>';
                        }
                    } else {
                        echo '<option value="' . $type . '">' . ucwords($type) . '</option>';
                    }
                }
                ?>
            </select> <br />
            <input type="submit" value="Afficher" />
        </fieldset>
    </form>
<?php
}
?>