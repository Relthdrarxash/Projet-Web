<?php
include('includes/header.php');
if ($_SESSION["statut"] == 'administrateur') {

?>
<?php
} else {
    deniedAccess();
    sleep(5);
    redirect();
}
?>
<section id="infos" class="infos">
    <!-- my-4 pour la margin en dessous du nav-->
    <div class="container my-4 content">

        <div class="section-title">
            <h1>
                Modifier un produit
            </h1>
        </div>
        <div class="row">
            <article>

                <?php
                if ($_SESSION["statut"] == 'administrateur') {

                ?>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">

                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Tableau du matériel
                                </button>
                            </h2>

                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <?php
                                    afficheTableau(listeMateriel());
                                    ?>
                                </div>
                            </div>

                        </div>

                        <?php

                        afficheFormulaireIdMateriel();

                        if (isset($_POST["id_mat"])) {
                            afficheFormulaireModification($_POST["id_mat"]);
                            if (
                                !empty($_SESSION)
                                && !empty($_POST)
                                && isset($_POST["type_mat"])
                                && isset($_POST["marque"])
                                && isset($_POST["fournisseur"])
                                && isset($_POST["description"])
                                && isset($_POST["prix"])
                            ) {

                                // Ptet mettre une taille max pour la
                                try {
                                    $res = modification($_POST["type_mat"], $_POST["marque"], $_POST["fournisseur"], $_POST["description"], $_POST["prix"]);
                                    echo "L'entrée a bien été modifié";
                                } catch (Exception $e) {
                                    echo "Erreur : $e";
                                }
                            }
                        ?>
                            <p id="res_modification"></p>
                    <?php
                        }
                    }
                    ?>

            </article>


            <?php
            include('includes/footer.php');
            ?>