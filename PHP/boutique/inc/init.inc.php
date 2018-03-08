<?php

//------------------------------------------------CONNECTION A LA BDD
//$pdo = new PDO("mysql:host=localhost;dbname=boutique", 'root', '',
$pdo = new PDO("mysql:host=sql309.epizy.com;dbname=epiz_21744600_boutique", 'epiz_21744600', 'N88v5iFHjgbD',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::
MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//------------------------------------------------SESSION
session_start();

//------------------------------------------------CHEMIN


define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/");
//define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/formateur/ma-formation/PHP/boutique/");

// cette constant retourne le CHEMIN PHYSIQUE du dossier boutique sur le serveur
// lors de l'enregistrement d'images/photos, nous aurons besoin du chemin complet do dossier photo pour enregistrer la photo

//echo '<pre>'; print_r($_SERVER); echo '</pre>';

//echo RACINE_SITE;				->Affiche:     C:/xampp/htdocs/formateur/ma-formation/PHP/boutique/

define("URL", 'http://joch.epizy.com/');
//define("URL", 'http://localhost/formateur/ma-formation/PHP/boutique/');

//cette constante servira à enregistrer l'URL d'une photo/image dans la BDD.
//On ne conserve jamais la photo elle-meme; ce serait trop lourd pour la BDD.

//------------------------------------------------VARIABLES
$content = '';

//------------------------------------------------INCLUSIONS
require_once("fonction.inc.php");		// 

