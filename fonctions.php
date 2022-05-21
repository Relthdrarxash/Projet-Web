<?php

$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
$fileName = end($fileName);

//****************Fonctions utilisées**************************************


//****************Génération du menu**************************************
function generationMenu($tableauMenu)
{
	$html = '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">' . "\n" .
		'<div class="container-fluid">' . "\n" .
		'<ul class="navbar-nav me-auto mb-2 mb-lg-0">'."\n";
	// On récupère le nom de fichier pour le mettre en évidence avec le "active" de Bootstrap
	$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
	$fileName = end($fileName);
	// Décommenter pour vérifier le nom du fichier
	// echo end($fileName);
	// Le code html du contenu est stocké dans la variable html
	foreach ($tableauMenu as $page) {
		/* On peut ptet s'éviter de faire deux fois le même test si on met le active dans un if
             En mode <a class="nav-link "<?php if ($_SERVER['PHP_SELF'] == $page['url']) echo 'active';?href='{$page['url']}'>{$page['texte']}</a>\n";
            */
		$html .= "<li>";
		if ($_SESSION && $page['url'] != 'connexion.php') {
			if ($fileName == $page['url']) {
				// Ici on mettra le lien en active pour qu'il soit mis en évidence
				$html .= '<a class="nav-link active mr mx-1" aria-current="page" '. "href='{$page['url']}'>{$page['texte']}</a>";
			} 
			else {
				// Ici on va mettre toutes les autres pages qui seront pas en active du coup
				$html .= '<a class="nav-link mx-2" aria-current="page" '. "href='{$page['url']}'>{$page['texte']}</a>";
			}
		} else if (empty($_SESSION) && $page['url'] != 'deconnexion.php') {
			if ($fileName == $page['url']) {
				// Ici on mettra le lien en active pour qu'il soit mis en évidence
				$html .= '<a class="nav-link active mr mx-1" aria-current="page" '. "href='{$page['url']}'>{$page['texte']}</a>";
			} 
			else {
				// Ici on va mettre toutes les autres pages qui seront pas en active du coup
				$html .= '<a class="nav-link mx-2" aria-current="page" '. "href='{$page['url']}'>{$page['texte']}</a>";
			}
		}
		
		$html .= "</li>\n";
	}
	$html .= "</ul>\n";
	$html .= "</div>\n";
	$html .= "</nav>\n";

	return $html;
}

function nomFichier() {
	$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
	$pageTitle = explode(".", end($fileName));
	return ucwords($pageTitle[0]);
}

function connexion($login, $pass)
{
	$retour = false;

	include('connexionBDD.php');

	$login = $BDD->quote($login);
	$pass = $BDD->quote($pass);
	$requete = "SELECT login,password,statut FROM comptes WHERE lower(login) = lower(" . $login . ") AND password = " . $pass;
	// var_dump($requete);
	// echo "<br/>";  	
	$resultat = $BDD->query($requete);
	$resRequete = $resultat->fetch(PDO::FETCH_ASSOC);
	// Si le tableau est vide alors c'est que le compte n'est pas valide
	// var_dump($resRequete);
	// var_dump($_SESSION);
	if ($resRequete){
		$_SESSION["login"] = $resRequete["login"];
		$_SESSION["statut"] = $resRequete["statut"];

		$retour = true;
	} 
	else {
		$retour = false;
	}
	return $retour;

}

function redirect(){
	$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
	$fileName = end($fileName);
	// On redirige vers la page connexion.php si l'utilisateur n'est pas connecté
	if($fileName != "connexion.php" && empty($_SESSION)) {	
		header("Location: /Projet-Web/connexion.php");
		exit();
	}
	else if ($fileName == "connexion.php" && !empty($_SESSION)) {
		header("Location: /Projet-Web/index.php");
		exit();
	}
}

function deconnexion(){
	session_start();
	session_unset(); // == $_SESSION=array()
	session_destroy();
	redirect();
}