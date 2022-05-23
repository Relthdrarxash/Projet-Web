<?php
include('header.php');
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
include('footer.php');
?>