<?php
$pdo= new PDO("mysql:host=localhost;dbname=folio", 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8'));

//$pdo= new PDO("mysql:host=sql208.epizy.com;dbname=epiz_21745459_formulaire",'epiz_21745459','hQvy3YATcEYs',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8'));



define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/");
define("URL", 'http://daddouche.epizy.com/');

$content='';


require_once("fonction.php");
?>