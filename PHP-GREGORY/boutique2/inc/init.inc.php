<?php
//---------- BDD
$pdo = new PDO('mysql:host=localhost;dbname=boutique2','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//---------- SESSION
session_start();

//---------- CHEMIN
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/PHP/boutique2/");
// echo RACINE_SITE;
// echo '<pre>'; print_r($_SERVER); echo '</pre>';
define("URL", 'http://localhost/PHP/boutique2/');

//---------- VARIABLES
$content = '';

//---------- INCLUSIONS
require_once("fonction.inc.php");

