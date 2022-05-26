<?php
include('includes/header.php'); ?>

<?php
if ($_SESSION["statut"] == 'administrateur') {
?>
    <section id="infos" class="infos">
        <!-- my-4 pour la margin en dessous du nav-->
        <div class="container my-4 content">

            <div class="section-title">
                <h2>Menu principal</h2>
            </div>

            <div class="row">
                <article>
                    <?php
                    afficheFormulaireAjoutUtilisateur();
                    if (!empty($_SESSION) && !empty($_POST) && isset($_POST["mail"]) && isset($_POST["pass"]) && isset($_POST["status"]) && isset($_POST["rue"]) && isset($_POST["ville_etu"])) {
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