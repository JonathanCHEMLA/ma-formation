<?php
/*
	Exercice: Améliorer le formulaire de contact formulaire5.php :
	1 - Vous devez procéder aux changements vous permettant d'être l'unique destinataire du message
	2 - Vous devez  ajouter les champs : Société, Nom, Prénom. Sans retirer les champs actuels
	3 - ajouter au corps du message : Nom, prenom, société, message.
*/
if($_POST)
{
	$_POST['email'] = "From: $_POST[email] \n"; // toujours FROM!!
	$_POST['email'] .= "MIME-Version: 1.0 \r\n";
	$_POST['email'] .= "Content-type: text/html; charset=utf8 \r\n";
	
	$_POST['message'] = "Nom : " . $_POST['nom'] . "\nPrénom : " . $_POST['prenom'] . "\nSociété : " . $_POST['societe'] . "\nMessage : " . $_POST['message'];
	
	$email = "glx78@free.fr"; 
	mail($email, $_POST['sujet'], $_POST['message'], $_POST['email']);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Formulaire 6</title>
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
		<h1>Formulaire de contact</h1>
		<hr>
		<form method="post" action=""><!-- method : comment vont circuler les données , action : URL de destination -->
			<label for="nom">Nom</label>
			<input type="text" id="nom" name="nom" placeholder="nom"><br><br><!-- l'attribut name est indispansable pour exploiter les données en PHP -->
			
			<label for="prenom">Prénom</label>
			<input type="text" id="prenom" name="prenom" placeholder="prenom"><br><br><!-- l'attribut name est indispansable pour exploiter les données en PHP -->
			
			<label for="societe">Société</label>
			<input type="text" id="societe" name="societe" placeholder="societe"><br><br><!-- l'attribut name est indispansable pour exploiter les données en PHP -->
			
			<label for="email">Email</label>
			<input type="text" id="email" name="email" placeholder="email"><br><br>
			
			<label for="sujet">Sujet</label>
			<input type="text" id="sujet" name="sujet" placeholder="sujet"><br><br>
			
			<label for="message">Message</label>
			<textarea id="message" name="message"></textarea><br><br>
			
			<input type="submit" value="connexion">
		</form>
	</body>
</html>