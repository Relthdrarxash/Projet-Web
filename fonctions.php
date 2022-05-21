<?php
//****************Fonctions utilisées**************************************



//****************Génération du menu**************************************
function generationMenu($tableauMenu)
{
	$html = '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">' . "\n" .
		'<div class="container-fluid">' . "\n" .
		'<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
	// On récupère le nom de fichier pour le mettre en évidence avec le "active" de Bootstrap
	$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
	// Décommenter pour vérifier le nom du fichier
	// echo end($fileName);
	foreach ($tableauMenu as $page) {
		/* On peut ptet s'éviter de faire deux fois le même test si on met le active dans un if
             En mode <a class="nav-link "<?php if ($_SERVER['PHP_SELF'] == $page['url']) echo 'active';?href='{$page['url']}'>{$page['texte']}</a>\n";
            */
		if (end($fileName) == $page['url']) {
			// Ici on mettra le lien en active pour qu'il soit mis en évidence
			$html .= '<a class="nav-link active mr mx-1" aria-current="page"' . "href='{$page['url']}'>{$page['texte']}</a>\n";
		} else {
			// Ici on va mettre toutes les autres pages qui seront pas en active du coup
			$html .= '<a class="nav-link mx-2" aria-current="page"' . "href='{$page['url']}'>{$page['texte']}</a>\n";
		}
	}
	$html .= "</nav>\n";
	return $html;
}

function connexion($login, $pass)
{
	$retour = false;

	include('connexionBDD.php');

	$login = $BDD->quote($login);
	$pass = $BDD->quote($pass);
	$requete = "SELECT login,password FROM comptes WHERE login = " . $login . " AND password = " . $pass;
	// var_dump($requete);
	// echo "<br/>";  	
	$resultat = $BDD->query($requete);
	$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
	// Si le tableau est vide alors c'est que le compte n'est pas valide
	var_dump($tableau_assoc);
	if (sizeof($tableau_assoc) != 0) $retour = true;
	return $retour;

}
