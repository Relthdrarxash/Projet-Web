<?php
include('includes/header.php');
?>

<section id="infos" class="infos">
    <!-- my-4 pour la margin en dessous du nav-->
    <div class="container my-4 content">

        <div class="section-title">
            <h1>Menu principal</h1>
        </div>

        <div class="row mx-1 text-center">
            <?php
            // Afficher les images dans la fonction affiche tableau
            // Mettre un tableau qui utilise 6 colonnes bootstrap 
            afficheTableau(listeMateriel());

            var_dump($_GET);

            if (!empty($_GET) && isset($_GET['type_mat'])) {


                $tab = afficherTableauParType($_GET['type_mat']);
                if ($tab) afficheTableau($tab);
            }
            ?>
        </div>

<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Enable both scrolling & backdrop</button>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdroped with scrolling</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Try scrolling the rest of the page to see this option in action.</p>
  </div>
</div>
        
    </div>
</section>

<?php
include('includes/footer.php');
?>