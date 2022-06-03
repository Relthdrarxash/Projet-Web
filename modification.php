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

                            afficheFormulaireModification();
                            ?><p id="res_modification"></p><?php
                            if (
                                !empty($_SESSION)
                                && !empty($_POST)
                                && isset($_POST["type_mat"])
                                && isset($_POST["fournisseur"])
                                && isset($_POST["marque"])
                            ) {
                                // ^[a-zA-Z ]*$ pour matcher un texte et éviter des problèmes de stockage dans la BDD
                                // Ptet mettre une taille max
                                try {
                                    $res = modification($_POST["type_mat"], $_POST["marque"], $_POST["fournisseur"]);
                                    echo "L'utilisateur a bien été modifié";
                                } catch (Exception $e) {
                                    echo "Erreur : $e";
                                }
                            ?>
        
                                
        
                            <?php
                                afficheTableau(listeMateriel());
                            }
                            
                            
                        }
                        ?>

            </article>


<?php
include('includes/footer.php');
?>