<?php

echo '<pre>'; print_r($_POST); echo '</pre>';

if($_POST)
{
	$_POST["expediteur"] = "From: $_POST[expediteur] \r\n";
	$_POST["expediteur"] .= "MIME-Version: 1.0 \r\n";	// protocole d'envoi de mail à indiquer obligatoirement. Il permet d'envoyer toute sorte de données et pas seulement du texte.
	$_POST["expediteur"] .="Content-type: text/html; charset=utf-8 \r\n";	// Ce code permettra d'envoyer du html directement dans le message. Il sera traduit/interpreté pour l'envoi de la newsletter.


	 mail($_POST["destinataire"],$_POST["sujet"],$_POST["message"],$_POST["expediteur"]);
	 	//l'ordre est important dans la fct mail. Et elle reçoit toujours 4 ARGUMENTS.
	//Comme dans la plupart des fonctions, il faut respecter le NOMBRE et l'ORDRE des arguments que l'on transmet.

/*

Multipurpose Internet Mail Extensions (MIME) ou Extensions multifonctions du courrier Internet1 est un standard internet qui étend le format de données des courriels pour supporter des textes
 en différents codage de caractères autres que l'ASCII, des contenus non textuels, des contenus multiples, et des informations d'en-tête en d'autres codages que l'ASCII. Les courriels
  étant généralement envoyés via le protocole SMTP au format MIME, ces courriels sont souvent appelés courriels SMTP/MIME.

À l'origine, SMTP avait été prévu pour ne transférer que des fichiers textes (codés en ASCII). Avec l'apparition du multimédia et l'utilisation croissante des applications bureautiques,
 le besoin s'est fait sentir d'échanger, en plus des fichiers textes, des fichiers binaires (format des applications bureautiques, images, sons, fichiers compressés).

Les types de contenus définis par le standard MIME peuvent être utilisés à d'autres fins que l'envoi de courriels, dans les protocoles de communication comme le HTTP pour le World Wide Web.

*/


	//if()
	//{}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulaire 5</title>
	<style>
		label{
			float: left;
			width:120px;
			font-style:italic;
			font-family:Calibri;
		}
	</style>
</head>
<body>
	<h1>Mail</h1>
	<hr>
	<form method="post" action="">
	<!-- method:cmt vont circuler les données.  Action: URL de destination -->

		<label for="destinataire">Destinataire</label>
		<input type="text" placeholder="destinataire" name="destinataire" id="destinataire" value="mailto()"><br><br>
		
		<label for="expediteur">expediteur</label>
		<input type="text" placeholder="expediteur" name="expediteur" id="expediteur"> <br><br>

		<label for="sujet">sujet</label>
		<input type="text" placeholder="sujet" name="sujet" id="sujet"><br><br>
		
		<label for="message">message</label>
		<textarea id="message" name="message">Message</textarea><br><br>

		<input type="submit" value="Envoi"> 

	</form>
</body>
</html>