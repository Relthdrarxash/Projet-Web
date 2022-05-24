<?php

$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
$fileName = end($fileName);

//##########################Fonctions utilisées###############################

//****************Génération du menu**************************************
function generationMenu($tableauMenu): string
{
	$html = '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">' . "\n" .
		'<div class="container-fluid">' . "\n" .
		'<ul class="navbar-nav me-auto mb-2 mb-lg-0">' . "\n";
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

		// Si on n'est pas connecté -> affichage de la page connexion, pas d'affichage de la page déconnexion, pas d'affichge des pages insertion ou modification
		if (empty($_SESSION) && $page['statut'] == 'all' && $page['url'] != 'deconnexion.php') {
			if ($fileName == $page['url']) {
				// Ici on mettra le lien en active pour qu'il soit mis en évidence
				$html .= '<a class="nav-link active mr px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
			} else if ($page['url'] != 'deconnexion.php') {
				// Ici on va mettre toutes les autres pages qui seront pas en active du coup
				$html .= '<a class="nav-link px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
			}
		} 
		// Si on est connecté -> On teste si on est un utilisateur ou un admin
		else {
			// Si utilisateur -> pas d'affichage des pages insertion et modification
			if (!empty($_SESSION) && $_SESSION["statut"] == 'utilisateur' && $page['statut'] == 'all' && $page['url'] != 'connexion.php') {
				if ($fileName == $page['url']) {
					// Ici on mettra le lien en active pour qu'il soit mis en évidence
					$html .= '<a class="nav-link active mr px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
				} else {
					// Ici on va mettre toutes les autres pages qui seront pas en active du coup
					$html .= '<a class="nav-link px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
				}
			}
			else if (!empty($_SESSION) && $_SESSION["statut"] == 'administrateur' && $page['url'] != 'connexion.php'){
				if ($_SESSION && $page['url'] != 'connexion.php') {
					if ($fileName == $page['url']) {
						// Ici on mettra le lien en active pour qu'il soit mis en évidence
						$html .= '<a class="nav-link active mr px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
					} else {
						// Ici on va mettre toutes les autres pages qui seront pas en active du coup
						$html .= '<a class="nav-link px-1 mx-1" aria-current="page" ' . "href='{$page['url']}'>{$page['texte']}</a>";
					}
				}
			}
		}
		$html .= "</li>\n";
	}
	$html .= "</ul>\n";

	$html .= afficheUtilisateur();

	$html .= "</div>\n";
	$html .= "</nav>\n";

	return $html;
}

// Récupération du nom de fichier pour la génération du menu en dynamique
function nomFichier(): string
{
	$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
	$pageTitle = explode(".", end($fileName));
	return ucwords($pageTitle[0]);
}

function afficheUtilisateur(): string
{
	$html = '<span id="user">' . "\n";
	if (empty($_SESSION)) {
		$html .= "Veuillez vous connecter";
	} else {
		$html .= 'Bonjour ' . ucwords($_SESSION["login"]);
	}
	$html .=  "\n" . '</span';
	return $html;
}

//****************Connexion de l'utilisateur**************************************
function connexion($login, $pass): bool
{
	$retour = false;

	include('connexionBDD.php');

	// On protège les entrées utilisateur
	$login = $BDD->quote($login);
	$pass = $BDD->quote($pass);
	// On pourrait utiliser un lower() pour faciliter la connexion
	$requete = "SELECT login,password,statut FROM comptes WHERE login = $login AND password = $pass ;";
	// var_dump($requete);
	// echo "<br/>";  	
	$resultat = $BDD->query($requete);
	$resRequete = $resultat->fetch(PDO::FETCH_ASSOC);
	// Si le tableau est vide alors c'est que le compte n'est pas valide
	// var_dump($resRequete);
	// var_dump($_SESSION);
	// Si il y a une résultat : connexion effectuée et on créé une session à l'utilisateur
	if ($resRequete) {
		$_SESSION["login"] = $resRequete["login"];
		$_SESSION["statut"] = $resRequete["statut"];

		// connexion OK -> retour True
		$retour = true;
	} else {

		// connexin Pas Ok -> retour False
		$retour = false;
	}
	return $retour;
}

//****************Génération des logs**************************************
function logsConnexion()
{
	$statutConnexion = "échouée";
	$statut = "Non Connecté";
	$date = new DateTime();
	$date = $date->format("d/m/y h:i:s");
	if (!empty($_SESSION)) {
		$statutConnexion = "réussie";
		$statut = $_SESSION["statut"];
	}
	// 1 : on ouvre le fichier
	$monfichier = fopen('logs/access.log', 'a+');
	// 2 : Ajout des logs
	// {date au format jj/mm/aa} {heure au format hh:mm:ss} : Connexion {échouée|réussie} de {utilisateur} (si réussie : {statut})
	// PHP_EOL = retour à la ligne
	fputs($monfichier, "$date : Connexion $statutConnexion de " . $_POST["login"] . ' depuis ' . $_SERVER['REMOTE_ADDR'] . " Statut = $statut".PHP_EOL);
	// 3 : quand on a fini de l'utiliser, on ferme le fichier
	fclose($monfichier);
}

//****************Récupération du statut de l'utilisateur**************************************
function getStatut($login): bool
{
	include('connexionBDD.php');

	$login = $BDD->quote($login);
	$requete = "SELECT statut FROM comptes WHERE login = $login  AND password = $pass ;";
	$resultat = $BDD->query($requete);
	$resRequete = $resultat->fetch(PDO::FETCH_ASSOC);
	if ($resRequete) {
		$retour = $resRequete;
	}
	return $retour;
}

//****************Redirection des pages**************************************
function redirect()
{
	$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
	$fileName = end($fileName);
	// On redirige vers la page connexion.php si l'utilisateur n'est pas connecté
	if ($fileName != "connexion.php" && empty($_SESSION)) {
		header("Location: /Projet-Web/connexion.php");
		exit();
	}
	// Si l'utilisateur est connecté et qu'il est sur connexion.php, alors on le redirige vers l'index
	else if ($fileName == "connexion.php" && !empty($_SESSION)) {
		header("Location: /Projet-Web/index.php");
		exit();
	}
	else if (!empty($_SESSION) && $_SESSION["statut"] == 'utilisateur' && ($fileName == "modification.php" || $fileName == "insertion.php")) {
		header("Location: /Projet-Web/index.php");
		exit();
	}
}

//****************Déconnexion**************************************
function deconnexion()
{
	session_start();
	session_unset(); // == $_SESSION=array()
	session_destroy();
	redirect();
}

//****************Affichage Accès refusé**************************************
function deniedAccess() {
	echo '<p class="text">Welcome to 403:</p>
	<h1 class="title">Forbidden resource</h1>
	<p class="text">The server understood the request but refuses to authorize it.</p>';
}


//********************************************************************************
	function listeCompte()	{ // A faire
		
		$retour = false ;	
		include('connexionBDD.php');

		$requete = 'SELECT Type_mat, Marque, f.NomFournisseur AS Description, Image FROM Materiel AS m INNER JOIN Fournisseur AS f ON f.NomFournisseur = ;';
		$resultat = $madb->query($requete);
		if ($resultat) {
			$retour = $resultat->fetchAll(PDO::FETCH_ASSOC);
		}
		
		return $retour;
	}		