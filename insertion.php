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
                    Nouveau matériel
                </h1>
            </div>
            <div class="row">
                <article>
                    <?php
                    afficheFormulaireInsertion();
                    ?>
                    <p id="res_insertion"></p>
                    <?php
                    if (isset($_POST['captcha']) &&  $_POST['captcha'] == $_SESSION['code']) {

                        if (
                            !empty($_SESSION)
                            && !empty($_POST)
                            && isset($_POST["type_mat"])
                            && isset($_POST["fournisseur"])
                            && isset($_POST["description"])
                            && isset($_POST["nom_image"])
                            && isset($_POST["prix"])
                        ) {
                            // ^[a-zA-Z ]*$ pour matcher un texte et éviter des problèmes de stockage dans la BDD
                            // Ptet mettre une taille max
                            try {
                                $res = insertion($_POST["type_mat"], $_POST["marque"], $_POST["fournisseur"], $_POST["description"], $_POST["nom_image"], $_POST["prix"]);
                                echo "L'entrée a bien été inséré";
                            } catch (Exception $e) {
                                echo "Erreur : $e";
                            }

                            afficheTableau(listeMateriel());
                        }
                    }
                    else {
                        echo '<p>Captcha incorrect, veuillez recommencer</p>';
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