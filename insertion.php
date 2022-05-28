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
            <?php var_dump($_POST); ?>
            <div class="row">
                <article>
                    <?php
                    afficheFormulaireInsertion();
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
                        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["description"])) {
                            echo "Description non valide";
                        }
                        // (.*/)*.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$ pour matcher un nom d'image
                        // les @ au début et à la fin sont les délimiteurs du regex (comme # et /)
                        else if (!preg_match("@(.*/)*.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$@", $_POST["nom_image"])) {
                            echo "Format de nom de fichier invalide";
                        } 
                        else if (!is_numeric($_POST["prix"])){
                            echo "Erreur du format du prix";
                        }
                        else {
                            try {
                                $res = insertion($_POST["type_mat"], $_POST["marque"], $_POST["fournisseur"], $_POST["description"], $_POST["nom_image"], $_POST["prix"]);
                                echo "L'utilisateur a bien été inséré";
                            } catch (Exception $e) {
                                echo "Erreur : $e";
                            }
                        }
                        afficheTableau(listeMateriel());
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