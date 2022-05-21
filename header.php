<?php session_start(); ?>
<?php include('fonctions.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<header>
		<?php
		$menu = array(
			'Index' => array('texte' => 'Menu', 'url' => 'index.php'),
			'Connexion' => array('texte' => 'Connexion', 'url' => 'connexion.php'),
			'Insertion' => array('texte' => 'Insertion', 'url' => 'insertion.php'),
			'Modification' => array('texte' => 'Modification', 'url' => 'modification.php')
		);
		echo generationMenu($menu); ?>
	</header>
	<!-- Fichier à inclure pour faire le header -->