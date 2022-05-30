<?php
include('includes/header.php');

// Utiliser un captcha
// Vérifier que le nom de l'image respecte le bon format xxx.yyy, ptet le yyy dans png ou jpg ou jpeg


?>

<div class="wrapper">
    <div id="formContent" data-aos="zoom-in-down">
        <!-- Icon -->
        <div class="first">
            <img src="img/mamazon.png" id="icon" alt="Mamazon" />
            <h1>Connexion</h1>
        </div>

        <!-- Login Form -->
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Si un formulaire a déjà été rempli, on conserve le login mais pas le mot de passe -->
            <input type="text" id="login" class="second" name="login" placeholder="username" value="<?php if (isset($_POST["login"])) echo $_POST["login"]; ?>">
            <input type="password" id="password" class="third" name="password" placeholder="password">
            <input type="submit" class="fourth" value="Log In" name="connexion">
        </form>

        <p id="etatConnexion">

        </p>
        
        <?php
        if ($_POST) {
            if (
                empty($_SESSION)
                && !empty($_POST["connexion"])
                && isset($_POST["login"])
                && isset($_POST["password"])
            ) {
                $etatConnexion = connexion($_POST["login"], $_POST["password"]);
                if ($etatConnexion) {
                    echo '<p id="connexionOk">' . "\n";
                    echo "Connexion réussie <br />\n";
                    echo "Redirection...<br />\n";
                    echo "</p>\n";
                } else {
                    echo '<p id="connexionPasOk">' . "\n";
                    echo "Login/Mot de passe Incorrect\n";
                    echo "</p>\n";
                }
                logsConnexion();
                redirect();
            }
        }
        ?>

    </div>
</div>

<?php
include('includes/footer.php');
?>