<?php

/*
Exercice 1:
1 - Réaliser un formulaire HTML, correspondant à la table 'employes' de la BDD entreprise
2 - Réaliser le script permettant d'insérer un employé dans la BDD en soumettant le formulaire:
	- connection BDD
	- Controle de récupération des données du formulaire
	- script de la requete d'insertion
*/
 echo '<pre>'; print_r($_POST); echo '</pre>';


$pdo = new PDO("mysql:host=localhost;dbname=entreprise", 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::
MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') );
//PDO::ATTR_ERRMODE : rapport d'erreurs.
//PDO::ERRMODE_WARNING : En plus de définir le code d'erreur, PDO émettra un message E_WARNING traditionnel. Cette configuration est utile lors des tests et du débogage, si vous voulez voir le problème sans interrompre l'application.
//PDO::MYSQL_ATTR_INIT_COMMAND : Commande à exécuter lors de la connexion au serveur MySQL. Sera automatiquement ré-exécuté lors d'une reconnexion. Notez que cette option n'a d'effet que si utilisée dans le tableau d'options driver_options du constructeur.
//'SET NAMES utf8' : 

if($_POST)
{
	if(ISSET($_POST["nom"]) and ISSET($_POST["prenom"]) and ISSET($_POST["sexe"]) and ISSET($_POST["salaire"]) and ISSET($_POST["date_embauche"]) and ISSET($_POST["service"]))
	{
		$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche,salaire) VALUES('$_POST[prenom]','$_POST[nom]','$_POST[sexe]','$_POST[service]','$_POST[date_embauche]','$_POST[salaire]' )"); 	
		// ATTENTION les "" de $_POST["prenom"] doivent:
			//1-devenir des '' car le INSERT INTO est entre "",
			//2-ces '' changent de place pour englober aussi $_POST: '$_POST[prenom]'
			
		echo '<div style="background:green; padding: 10px; text-align:center; border-radius:5px;width:200px;">vous etes bien enregistré !</div><br>';	// ATTENTION à bien mettre:          style = "...."
	}
	else
	{
		echo 'le formulaire est incomplet !!! merci de remplir tous les champs !!!!';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Formulaire Entreprise PDO</title>
		<style>
			label{
				float:left;
				width: 95px;
				font-style:italic;
				font-family: calibri;
			}
		</style>
	</head>
<body>	
	<form method="post" action="">
	<!-- method:cmt vont circuler les données.  Action: URL de destination -->
		<label for="nom">Nom</label>
		<input type="text" placeholder="nom" name="nom" id="nom"><br><br>
		<label for="prenom">Prénom</label>
		<input type="text" placeholder="prenom" name="prenom" id="prenom"><br><br>
		<label for="salaire">Salaire</label>
		<input type="text" placeholder="salaire" name="salaire" id="salaire"><br><br>
		<label for="service">Service</label>
		<input type="text" placeholder="service" name="service" id="service"><br><br>
		<label for="date_embauche">Date d'embauche</label>
		<input type="date" placeholder="date_embauche" name="date_embauche" id="date_embauche"><br><br>
		<label for="sexe">Sexe</label>
		<select id="sexe" name="sexe">
			<option value="m">Homme</option>
			<option value="f">Femme</option>
		</select><br><br>

		<input type="submit" name="submit" value="inscription"> 
	</form>
</body>
<html>