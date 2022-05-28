<?php

$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
$fileName = end($fileName);

//##########################Fonctions utilisées###############################
// Récupération du nom de fichier pour la génération du menu en dynamique
function nomFichier()
{
	$fileName = explode("/", $_SERVER['SCRIPT_NAME']);
	$pageTitle = explode(".", end($fileName));
	return ucwords($pageTitle[0]);
}

function afficheUtilisateur()
{
	$html = '<span id="user">' . "\n";
	// On récupère le prénom depuis l'@ mail de l'utilisateur
	if (empty($_SESSION)) {
		$html .= "Veuillez vous connecter";
	} else {
		$username = explode("@", $_SESSION["login"]);
		$html .= 'Bonjour ' . ucwords($username[0]);
	}
	$html .=  "\n" . '</span';
	return $html;
}

//****************Connexion de l'utilisateur**************************************
function connexion($login, $pass)
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
	fputs($monfichier, "$date : Connexion $statutConnexion de " . $_POST["login"] . ' depuis ' . $_SERVER['REMOTE_ADDR'] . " Statut = $statut" . PHP_EOL);
	// 3 : quand on a fini de l'utiliser, on ferme le fichier
	fclose($monfichier);
}

//****************Récupération du statut de l'utilisateur**************************************
function getStatut($login)
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

//****************Récupération des différents fournisseurs**************************************
function recupFournisseur()
{
	include('connexionBDD.php');
	$requete = "SELECT NomFournisseur FROM Fournisseur;";
	$resultat = $BDD->query($requete);
	$resRequete = $resultat->fetchAll(PDO::FETCH_ASSOC);
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
		header("Location: connexion.php");
		exit();
	}
	// Si l'utilisateur est connecté et qu'il est sur connexion.php, alors on le redirige vers l'index
	else if ($fileName == "connexion.php" && !empty($_SESSION)) {
		header("Location: index.php");
		exit();
	} else if (!empty($_SESSION) && $_SESSION["statut"] == 'utilisateur' && ($fileName == "modification.php" || $fileName == "insertion.php")) {
		header("Location: index.php");
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
function deniedAccess()
{
	echo '<p class="text">Welcome to 403:</p>
	<h1 class="title">Forbidden resource</h1>
	<p class="text">The server understood the request but refuses to authorize it.</p>';
}


//********************************************************************************
function listeMateriel()
{

	$retour = false;
	include('connexionBDD.php');

	$requete = 'SELECT Type_mat AS "Type de matériel", Marque, Description, Image, nomfournisseur AS "Vendu par" FROM Materiel AS m INNER JOIN Propose as P ON p.nomateriel = m.nomateriel INNER JOIN Fournisseur AS f ON f.nofournisseur = p.nofournisseur;';
	$resultat = $BDD->query($requete);
	if ($resultat) {
		$retour = $resultat->fetchAll(PDO::FETCH_ASSOC);
	}

	return $retour;
}


function afficheTableau($tab)
{
	echo '<table>';
	echo '<tr>'; // les entetes des colonnes qu'on lit dans le premier tableau par exemple
	foreach ($tab[0] as $colonne => $valeur) {
		echo "<th>$colonne</th>";
	}
	echo "</tr>\n";
	// le corps de la table
	foreach ($tab as $ligne) {
		echo '<tr>';
		foreach ($ligne as $entete => $cellule) {
			if ($entete == "Image") {
				echo '<td><img class="image_table" src="img/' . $cellule . '" alt="' . $cellule . '"/></td>';
			} else {
				echo "<td>$cellule</td>";
			}
		}
		echo "</tr>\n";
	}
	echo '</table>';
}

//*******************************Execution de l'insertion*************************************************
function insertion($type, $marque, $fournisseur, $description, $nom_image, $prix)
{
	$retour = 0;
	include('connexionBDD.php');
	// filtrer les paramètres		
	$type = $BDD->quote($type);
	$marque = $BDD->quote($marque);
	$fournisseur = $BDD->quote($fournisseur);
	$description = $BDD->quote($description);
	$nom_image = $BDD->quote($nom_image);

	// requête
	$requeteMateriel = "INSERT INTO Materiel(type_mat, marque, description, image) VALUES ($type, $marque, $description, $nom_image);";
	$resultatMateriel = $BDD->exec($requeteMateriel);
	// ajout du matériel associé à un fournisseur dans la table propose
	$idFournisseur = getIdFournisseur($fournisseur);
	$idMateriel = getIdMateriel($description);
	$requetePropose = "INSERT INTO Propose VALUES($idMateriel, $idFournisseur, $prix)";
	$resultatPropose = $BDD->exec($requetePropose);
	if ($resultatMateriel == false && $resultatPropose == false)
		$retour = 0;
	else
		$retour = array($resultatMateriel, $resultatPropose);
	return $retour;
}

function getIdFournisseur($fournisseur)
{
	include('connexionBDD.php');
	// $fournisseur est déjà protégé
	$requete = "SELECT NoFournisseur FROM Fournisseur WHERE NomFournisseur = $fournisseur";
	$resultat = $BDD->query($requete);
	if ($resultat) {
		$retour = $resultat->fetch(PDO::FETCH_ASSOC);
	}
	return $retour["NoFournisseur"];
}

function getIdMateriel($description)
{
	include('connexionBDD.php');
	// On utilise la description car elle est différente pour toutes les valeurs	
	$requete = "SELECT NoMateriel FROM Materiel WHERE Description = $description";
	$resultat = $BDD->query($requete);
	if ($resultat) {
		$retour = $resultat->fetch(PDO::FETCH_ASSOC);
	}
	return $retour["NoMateriel"];
}
