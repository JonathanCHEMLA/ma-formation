<?php
/*
Exercice : 
	1 - Rélaiser un formaulaire HTML correspondant à la table 'employes' de la BDD entreprise
	2 - Réaliser le script permettant d'insérer un employes dans la BDD en soumettant le formulaire : 
		- connexion BDD
		- contrôle de récupération des données du formulaire
		- script de requête d'insertion
*/
//echo '<pre>'; print_r($_POST); echo '</pre>';
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if($_POST)
{
	$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche,salaire) VALUES ('$_POST[prenom]', '$_POST[nom]','$_POST[sexe]','$_POST[service]','$_POST[date_embauche]','$_POST[salaire]')");
	
	echo '<div style="background: green; padding: 10px; text-align: center; border-radius: 5px; width: 200px;">Inscription OK!!</div>';
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
		<h1>Formulaire d'inscription</h1>
		<hr>
		<form method="post" action=""><!-- method : comment vont circuler les données , action : URL de destination -->
			<label for="prenom">Prénom</label>
			<input type="text" id="prenom" name="prenom" placeholder="prenom"><br><br><!-- l'attribut name est indispansable pour exploiter les données en PHP -->
			
			<label for="nom">Nom</label>
			<input type="text" id="nom" name="nom" placeholder="nom"><br><br>
			
			<label for="sexe">Sexe</label>
			<select name="sexe">
				<option value="m">Homme</option>
				<option value="f">Femme</option>
			</select><br><br>
			
			<label for="service">Service</label>
			<input type="text" id="service" name="service" placeholder="service"><br><br>
			
			<label for="date_embauche">Date embauche</label>
			<input type="date" id="date_embauche" name="date_embauche" placeholder="date_embauche"><br><br>
				
			<label for="salaire">Salaire</label>
			<input type="text" id="salaire" name="salaire" placeholder="salaire"><br><br>
			
			<input type="submit" value="inscription">
		</form>
	</body>
</html>