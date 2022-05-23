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

<?php
include('includes/footer.php');
?>