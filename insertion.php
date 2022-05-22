<?php
    include('header.php');
    if ($_SESSION["statut"] == 'administrateur') {

    ?>




    <?php
        } 
    else {
        deniedAccess();
    }
    ?>

<?php
    include('footer.php');
?>