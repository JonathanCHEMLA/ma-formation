<?php
//---------- CONNEXION BDD
//$pdo = new PDO('mysql:host=sql309.epizy.com;dbname=epiz_21744593_boutique', 'epiz_21744593', 'christelle78950', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');

//---------- SESSION
session_start();

//---------- CHEMIN
//define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/");
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/");

// cette constante retourne le chemin physique du dossier boutique sur le serveur
// lors de l'enregistrement d'image/photos , nous aurons du chemin complet du dossier photo pour enregistrer la photo 
//echo '<pre>'; print_r($_SERVER); echo '</pre>';
//echo RACINE_SITE;

define("URL", 'http://localhost/formateur/ma-formation/POO/PHP-YAKINE-HAMIDA/boutique/');
//define("URL", 'http://ma-boutique.epizy.com/');
// cette constante servira à enregister l'URL d'une photo/image dans la BDD, on ne conserve jamais la photo elle même, ce serait trop lourd pour la BDD

//--------- VARAIBLES
$content = '';

//--------- INCLUSIONS
require_once("fonction.inc.php");









