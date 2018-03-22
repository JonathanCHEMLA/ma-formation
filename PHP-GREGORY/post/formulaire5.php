<?php
echo '<pre>'; print_r($_POST); echo '</pre>';
if($_POST)
{
	$_POST['expediteur'] = "From: $_POST[expediteur] \n"; // toujours FROM!!
	$_POST['expediteur'] .= "MIME-Version: 1.0 \r\n";
	$_POST['expediteur'] .= "Content-type: text/html; charset=utf8 \r\n";
	// MIME (Multipurpose Internet Mail Extensions) est un standard qui a été proposé par les laboratoires Bell Communications en 1991 afin d'étendre les possibilités limitées du courrier électronique (mail) et notamment de permettre d'insérer des documents (images, sons, texte, ...) dans un courrier. cette ligne est obligatoire!!!
	//Content-type: text/html : ce code permettra d'envoyer du HTML directement dans le message,le code sera traduit , pratique pour l'envoi d'une newsletter. 
	
	mail($_POST['destinataire'], $_POST['sujet'], $_POST['message'], $_POST['expediteur']); // la fonction mail() reçoit toujours 4 ARGUMENTS et l'ordre à une importance cruciale. Comme dans la plupart des fonctions, il faut respecter le NOMBRE et l'ORDRE des arguments que l'on transmet.
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Formulaire 1</title>
		<style>
			label{
				float: left;
				width: 120px;
				font-style: italic;
				font-family: Calibri;
			}
		</style>
	</head>
	<body>
		<h1>Formulaire de connexion</h1>
		<hr>
		<form method="post" action=""><!-- method : comment vont circuler les données , action : URL de destination -->
			<label for="destinataire">Destinataire</label>
			<input type="text" id="destinataire" name="destinataire" placeholder="destinataire"><br><br><!-- l'attribut name est indispansable pour exploiter les données en PHP -->
			
			<label for="expediteur">Expéditeur</label>
			<input type="text" id="expediteur" name="expediteur" placeholder="expediteur"><br><br>
			
			<label for="sujet">Sujet</label>
			<input type="text" id="sujet" name="sujet" placeholder="sujet"><br><br>
			
			<label for="message">Message</label>
			<textarea id="message" name="message"></textarea><br><br>
			
			<input type="submit" value="connexion">
		</form>
	</body>
</html>