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
            <input type="text" id="login" class="second" name="login" placeholder="username">
            <input type="text" id="password" class="third" name="password" placeholder="password">
            <input type="submit" class="fourth" value="Log In" name="connexion">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Go to the Site</a>
        </div>

    </div>
</div>

<?php
include('footer.php');
?>