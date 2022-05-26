<?php
include('includes/header.php'); ?>

<?php
if ($_SESSION["statut"] == 'administrateur') {
?>
    <section id="infos" class="infos">
        <!-- my-4 pour la margin en dessous du nav-->
        <div class="container my-4 content">

            <div class="section-title">
                <h1>
                    Insertion d'un nouveau matériel
                </h1>
            </div>
            <?php var_dump($_POST); ?>
            <div class="row">
                <article>
                    <?php
                    afficheFormulaireInsertion();
                    if (!empty($_SESSION) && !empty($_POST) && isset($_POST["type_mat"]) && isset($_POST["fournisseur"]) && isset($_POST["description"]) && isset($_POST["nom_image"])) {
                        try {
                            $res = ajoutUtilisateur($_POST["mail"], $_POST["pass"], $_POST["rue"], $_POST["ville_etu"], $_POST["status"]);
                            echo "L'utilisateur a bien été inséré";
                        } catch (Exception $e) {
                            echo "Erreur, l'utlisateur n'a pas été inséré";
                        }
                        afficheTableau(listeCompte());
                    }
                    ?>
                </article>
            </div>
        </div>
    </section>
<?php
} else {
    deniedAccess();
}
?>

<?php
include('includes/footer.php');
?>