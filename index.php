<?php
include('includes/header.php');
?>

<section id="infos" class="infos">
    <!-- my-4 pour la margin en dessous du nav-->
    <div class="container my-4 content">

        <div class="section-title">
            <h1>Menu principal</h1>
        </div>

        <div class="row mx-1 text-center" >
            <?php
                // Afficher les images dans la fonction affiche tableau
                // Mettre un tableau qui utilise 6 colonnes bootstrap 
                afficheTableau(listeMateriel());
            ?>
        </div>

    </div>
</section>

<?php
include('includes/footer.php');
?>