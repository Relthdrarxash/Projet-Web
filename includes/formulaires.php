<?php

//****************Génération du menu**************************************
function generationMenu($tableauMenu)
{
    $html = '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">' . "\n" .
        '<div class="container-fluid">' . "\n" .
        '<ul class="navbar-nav me-auto mb-2 mb-lg-0">' . "\n";
    // On récupère le nom de fichier pour le mettre en évidence avec le "active" de Bootstrap
    $fileName = explode("/", $_SERVER['SCRIPT_NAME']);
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
        $html .= "</li>\n";
    }
    $html .= "</ul>\n";

    $html .= afficheUtilisateur();

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
                    echo '<option value="' . $type . '">' . ucwords($type) . '</option>';
                    // ucwords pour mettre la première lettre en majuscule
                }
                ?>
            </select> <br />
            <label for="id_fournisseur">Fournisseur :</label>
            <select id="id_fournisseur" name="fournisseur" size="1">
                <?php
                foreach ($fournisseurs as $fournisseur) {
                    echo '<option value="' . $fournisseur["NomFournisseur"] . '">' . $fournisseur["NomFournisseur"] . '</option>';
                }
                ?>
            </select> <br />
            <label for="id_marque">Marque : </label>
            <input type="text" name="marque" id="id_marque" placeholder="Marque" required size="6" /><br />

            <label for="id_marque">Description : </label>
            <input type="text" name="description" id="id_description" placeholder="Description" required size="20" /><br />

            <label for="id_prix">Prix :</label>
            <input id="id_prix" name="prix" type="number" min="1" step="any" required /><br />

            <label for="id_nom_image">Nom de l'image : </label>
            <input type="text" name="nom_image" id="id_nom_image" placeholder="image.png" required size="6" />

            <input type="text" name="captcha" id="captcha" /> <br />
            <input type="submit" name="submit" value="Submit" />
            <img src="includes/image.php" onclick="this.src='includes/image.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
        </fieldset>
    </form>
<?php
    echo "<br/>";
} // fin afficheFormulairInsertion

function afficherTableauParType()
{

    include('connexionBDD.php');
    $requete = 'SELECT Type_mat AS "Type de matériel", Marque, Description, p.prix AS "Prix", Image, nomfournisseur AS "Vendu par" FROM Materiel AS m INNER JOIN Propose as P ON p.nomateriel = m.nomateriel INNER JOIN Fournisseur AS f ON f.nofournisseur = p.nofournisseur;';
    $resultat = $BDD->query($requete);
    $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <fieldset>


            <label for="customRange2" class="form-label">Example range</label>
            <input type="range" class="form-range" min="0" max="5" id="customRange2">
            <label for="id_prix">Prix :</label>
            <select id="id_prix" name="prix" size="1" onclick='listeMateriel()'>

                <option value="0">Choisir un prix</option>
                <?php
                foreach ($tableau_assoc as $ligne) {
                    echo '<option value="' . $ligne["Type Mat"] . '">' . $ligne["Marque"] . " " . $ligne["Description"] . " " . $ligne["Prix"] . " " . $ligne["Nom fournisseur"] . " </option>" . "\n";
                }
                ?>
            </select>
        </fieldset>
    </form>

    <label for="id_marque">Marque :</label>
    <select id="id_marque" name="marque" size="1" onclick='listeMateriel()'>
        <option value="0">Choisir une marque</option>
        <?php
        foreach ($tableau_assoc as $ligne) {
            echo '<option value="' . $ligne["Type Mat"] . '">' . $ligne["Marque"] . " " . $ligne["Description"] . " " . $ligne["Prix"] . " " . $ligne["Nom fournisseur"] . " </option>" . "\n";
        }
        ?>
    </select>
    </fieldset>
    </form>


    <label for="id_type_mat">Type du matériel :</label>
    <select id="id_type_mat" name="type_mat" size="1" onclick='listeMateriel()'>
        <option value="0">Choisir un Type</option>
        <?php
        foreach ($tableau_assoc as $ligne) {
            echo '<option value="' . $ligne["Type Mat"] . '">' . $ligne["Marque"] . " " . $ligne["Description"] . " " . $ligne["Prix"] . " " . $ligne["Nom fournisseur"] . " </option>" . "\n";
        }
        ?>
    </select>
    </fieldset>
    </form>
<?php
    echo "<br/>";
}

function afficheFormulaireIdMateriel()
{
    $tab = listeIdMateriel();
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="select_id_mat">
        <fieldset>

            <label for="id_mat">Sélectionner le numéro du matériel :</label>
            <select id="id_mat" name="id_mat" size="1">
                <?php
                foreach ($tab as $id) {
                    echo '<option value="' . $id["NoMateriel"] . '">' . $id["NoMateriel"] . '</option>';
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

    $requete = 'SELECT Type_mat AS "Type de matériel", Marque, Description, p.prix AS "Prix", Image, nomfournisseur AS "Vendu par" FROM Materiel AS m INNER JOIN Propose as P ON p.nomateriel = m.nomateriel INNER JOIN Fournisseur AS f ON f.nofournisseur = p.nofournisseur WHERE m.NoMateriel = ' . $id . ';';
    $resultat = $BDD->query($requete);
    $materiel = $resultat->fetch(PDO::FETCH_ASSOC);
    var_dump($materiel);   

    // on note les différents types pour en faire un menu dropdown
    $types = array('accessoire', 'écran', 'portable', 'serveur', 'station');
    $fournisseurs = recupFournisseur();
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="modification" onsubmit="return validationMateriel();">
        <fieldset>
            <label for="id_type_mat">Type du matériel :</label>
            <select id="id_type_mat" name="type_mat" size="1">
                <?php
                foreach ($types as $type) {
                    if ($materiel['Insee'] == $utilisateur['Insee']) {
						echo '<option value="' . $ville["Insee"] . '" selected>' . $ville["Commune"] . '</option>';
					} else {
						echo '<option value="' . $ville["Insee"] . '">' . $ville["Commune"] . '</option>';
					}


                    echo '<option value="' . $type . '">' . ucwords($type) . '</option>';
                    // ucwords pour mettre la première lettre en majuscule
                }
                ?>
            </select> <br />
            <label for="id_fournisseur">Fournisseur :</label>
            <select id="id_fournisseur" name="fournisseur" size="1">
                <?php
                foreach ($fournisseurs as $fournisseur) {
                    echo '<option value="' . $fournisseur["NomFournisseur"] . '">' . $fournisseur["NomFournisseur"] . '</option>';
                }
                ?>
            </select> <br />
            <label for="id_marque">Marque : </label>
            <input type="text" name="marque" id="id_marque" required size="6" value="<?= $materiel["Marque"]; ?>" /><br />
            <label for="id_prix">Prix (en €):</label>
            <input id="id_prix" name="prix" type="number" min="1" step="any" required value="<?= $materiel  ['Prix']; ?>" /><br />
            <div onclick=""><input type="submit" value="Modifier" /></div>

        </fieldset>
    </form>
<?php
    echo "<br/>";
} // fin afficheFormulairModification
