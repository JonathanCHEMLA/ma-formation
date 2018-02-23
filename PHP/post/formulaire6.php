<?php
/*
Exercice: Améliorer le formulaire de contact formulaire5.php:
	1 - Vous devez procéder aux changements vous permettant d'être l'unique destinataire du message
	2 - Ajouter les champs: société, Nom, Prénom. Sans retirer les champs actuels
	3 - Ajouter au corps du message: Nom, Prenom, Société", message
*/

echo '<pre>'; print_r($_POST); echo '</pre>';

if($_POST)
{
	$_POST["email"] = "From: $_POST[email] \r\n";
	$_POST["email"] .= "MIME-Version: 1.0 \r\n";	
	$_POST["email"] .="Content-type: text/html; charset=utf-8 \r\n";	

	$_POST["message"]     =     "Nom: " . $_POST["nom"]. "\nPrénom : " . $_POST["prenom"] . "\nSociété : " . $_POST["societe"] . "\nMessage : " .$_POST["message"];

	$email="jonathanchemla55@gmail.com";
	 mail($email,$_POST["sujet"],$_POST["message"],$_POST["email"]);



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
		


		<label for="nom">Nom</label>
		<input type="text" placeholder="nom" name="nom" id="nom"><br><br>		

		<label for="prenom">Prenom</label>
		<input type="text" placeholder="prenom" name="prenom" id="prenom"><br><br>

		<label for="societe">Societe</label>
		<input type="text" placeholder="societe" name="societe" id="societe"><br><br>

		<label for="email">email</label>
		<input type="text" placeholder="email" name="email" id="email"> <br><br>

		<label for="sujet">sujet</label>
		<input type="text" placeholder="sujet" name="sujet" id="sujet"><br><br>
		
		<label for="message">message</label>
		<textarea id="message" name="message">Message</textarea><br><br>


		<input type="submit" value="Envoi"> 

	</form>
</body>
</html>