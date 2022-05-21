<?php
include('header.php');
?>

<div class="wrapper">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="first">
            <img src="https://www.b-cube.in/wp-content/uploads/2014/05/aditya-300x177.jpg" id="icon" alt="User Icon" />
            <h1>Aditya News</h1>
        </div>

        <!-- Login Form -->
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return EtTaFonctionJS();">
            <!-- Si un formulaire a déjà été rempli, on conserve le login mais pas le mot de passe -->
            <input type="text" id="login" class="second" name="login" placeholder="username" value="<?php if(isset($_POST["login"])) echo $_POST["login"]; ?>">
            <input type="password" id="password" class="third" name="password" placeholder="password">
            <input type="submit" class="fourth" value="Log In" name="connexion">
        </form>


        <p>
            <?php
            if (empty($_SESSION)
                && !empty($_POST["connexion"])
                && isset($_POST["login"])
                && isset($_POST["password"])) {
                $etatConnexion = connexion($_POST["login"], $_POST["password"]);
                if ($etatConnexion) {
                    redirect();
                }
                else {
                    echo '<p id="connexionPasOk">'."\n";
                    echo "Login/Mot de passe Incorrect\n";
                    echo "</p>\n";
                }
            }
            ?>
        </p>

    </div>
</div>

<?php
include('footer.php');
?>