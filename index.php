<?php
include('includes/header.php');
?>

<section id="infos" class="infos">
  <!-- my-4 pour la margin en dessous du nav-->
  <div class="container my-4 content">

    <div class="section-title">
      <h1>Menu principal</h1>
    </div>
    <!-- <?php //var_dump($_POST); 
          ?> -->
    <div class="row mx-1 text-center">
      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">

          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              Produits
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
      </div>
      <?php
      if (!empty($_POST) && isset($_POST["type_mat"])) {
      ?>

        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">

            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Produits filtrés
              </button>
            </h2>

            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <?php
                afficheTableau(listerProduitParType($_POST["type_mat"]));
                ?>
              </div>
            </div>

          </div>
        </div>
      <?php
      }
      ?>
    </div>

    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Choisir produit par type</button>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Formulaire de sélection des critères</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <?php
        afficheFormulaireTableauParType();
        ?>
      </div>
    </div>

  </div>
</section>

<?php
include('includes/footer.php');
?>