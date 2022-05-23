<?php
include('header.php'); ?>

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
                <div class="">
                    <img src="images/20220103_154706.jpg" class="img-fluid" alt="">
                </div>
                <div class="pt-4 pt-lg-0 content">
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
include('footer.php');
?>