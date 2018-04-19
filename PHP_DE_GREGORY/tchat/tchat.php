<?php
	/*
	Exercice : Espace de dialogue 
		1.		Modélisation et création
				BDD : tchat 
				table : commentaire
						id_commentaire  // INT(11) PK - AI
						pseudo 			// VARCHAR(20)
						message			// TEXT
						date Enregistrement // DATETIME
		2. connexion à la BDD
		3. Création du formulaire HTML (pour l'ajout de message)
		4. Contrôle de récupération des données saisies en PHP
		5. Requete SQL d'enregistrement 
		6. Affichage des messages (date au format français)	
	*/
// Réponse 2 : connexion BDD
$pdo = new PDO('mysql:host=localhost;dbname=tchat', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Réponse 4 : contrôle
echo '<pre>'; print_r($_POST); echo '</pre>';
foreach($_POST as $indice => $valeur)
{
	$_POST[$indice] = htmlspecialchars(strip_tags($valeur));
	// $_POST[$indice] = htmlspecialchars($valeur);
	//$_POST[$indice] = htmlentities($valeur);
}

// Réponse 5:
if($_POST)
{
	// $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
	// $_POST['message'] = htmlspecialchars($_POST['message']);
	// $req = "INSERT INTO commentaire(pseudo, dateEnregistrement, message)VALUES('$_POST[pseudo]', NOW(), '$_POST[message]')";
	// $resultat = $pdo->exec($req);
	// echo $req;
	// préparer la requete SQL permet d'éviter les injections SQL qui détourne le comportement initial de la requete
	// les marqueurs nominatif ':pseudo' et ':message' peuvent se comparer à des boites ou son son stockés les données
	// htmlspecialchars() permet de rendre innoffensives les balsies HTML
	// htmlentities() permet de convertir les balises HTML
	// strip_tags() permet de supprimer les balises HTML
	$req = "INSERT INTO commentaire (pseudo, dateEnregistrement, message) VALUES (:pseudo, NOW(), :message)";
	$resultat = $pdo->prepare($req);
	
	$resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
	$resultat->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
	
	$resultat->execute();
	echo $req;
	
}	

// Réponse 6 : 
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(dateEnregistrement, '%H:%i:%s') AS heurefr, DATE_FORMAT(dateEnregistrement, '%d/%m/%Y') AS datefr FROM commentaire ORDER BY dateEnregistrement DESC");
echo '<legend><h2>' . $resultat->rowCount() . ' commentaire(s)</h2></legend>';

while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC))
{
	//echo '<pre>'; print_r($commentaire); echo '</pre>';
	echo '<div class="message">';
		echo '<div class="titre">Par : ' . $commentaire['pseudo'] . ',le ' . $commentaire['datefr'] . ' à ' . $commentaire['heurefr'] . '</div>';
		echo '<div class="contenu">' . $commentaire['message'] . '</div>';
	echo '</div><hr>';
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TCHAT</title>
		<link rel="stylesheet" href="style.css">
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
		<h1>TCHAT !!!</h1>
		<hr>
		<form method="post" action="">
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" placeholder="pseudo"><br><br>
			
			<label for="pseudo">Message</label>
			<textarea id="message" name="message"></textarea><br><br>
			
			<input type="submit" value="publier">
		</form>
	</body>
</html>	
			
			
			
			