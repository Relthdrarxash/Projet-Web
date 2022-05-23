<?php session_start(); ?>
<?php include('includes/fonctions.php'); ?>
<?php 
// Appelle de la fonction redirection pour toutes les pages (si l'utilisateur n'est pas autorisé, il sera redirigé pour toutes les pages du site)
redirect(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>
		<?php
		echo nomFichier();
		?>
	</title>
	<link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<!-- On insère les pages de style dans l'ordre d'importance (bootstrap ne doit pas réecrire le style que l'on a choisi)  -->
	<!-- Pour l'Animate On Scroll -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="scripts/validation.js"></script>
	<link rel="stylesheet" href="style/style.css">
</head>

<body>
	<header>
		<?php
		$menu = array(
			'Index' => array('texte' => 'Menu', 'url' => 'index.php', 'statut' => 'all'),
			'Insertion' => array('texte' => 'Insertion', 'url' => 'insertion.php', 'statut' => 'administrateur'),
			'Modification' => array('texte' => 'Modification', 'url' => 'modification.php', 'statut' => 'administrateur'),
			'Connexion' => array('texte' => 'Connexion', 'url' => 'connexion.php', 'statut' => 'all'),
			'Déconnexion' => array('texte' => 'Déconnexion', 'url' => 'deconnexion.php', 'statut' => 'all')
		);
		echo generationMenu($menu); ?>
	</header>