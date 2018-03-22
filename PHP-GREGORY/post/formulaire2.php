<?php
echo '<pre>'; print_r($_POST); echo '</pre>';

if($_POST)
{
	// Faites en sorte d'informer l'internaute si la taille du pseudo n'est paas comprise entre 5 et 20 caractères, si les données sont valides, on affiche les données du formulaire
	// Contrôler la validiter du champs email à l'aide d'une fonction prédéfinie
	// Contrôler la taille et type numéric (fonction prédéfinie PHP) du champs code postal
	$erreur = "";
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 230px; border-radius: 5px; text-align: center;margin-bottom: 10px;">Merci de saisir un email valide</div>';
	}	
	if(iconv_strlen($_POST['pseudo']) < 5 || iconv_strlen($_POST['pseudo']) > 20)
	{
		$erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 230px; border-radius: 5px; text-align: center;margin-bottom: 10px;">Merci de saisir un pseudo valide</div>';
	}
	if(iconv_strlen($_POST['code_postal']) !== 5 || !is_numeric($_POST['code_postal']))
	{
		$erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 230px; border-radius: 5px; text-align: center; margin-bottom: 10px;">Merci de saisir un code postal valide</div>';
	}
	if(!preg_match('#^[a-zA-Z0-9.-_]+$#', $_POST['prenom']))
	{
		$erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 230px; border-radius: 5px; text-align: center; margin-bottom: 10px;">Merci de saisir un code prenom valide</div>';
	}
	/*
		preg_match(): expression régulière REGEX est toujours entouré de # pour préciser les options :
		^ indique le début de la chaine
		$ indique la fin de la chaine 
		+ est la pour dire que les lettres autorisés peuvent apparaitre plusieurs fois
	*/
	
	if(empty($erreur))
	{
		foreach($_POST as $indice => $valeur)
		{
		echo $indice . ' : ' . $valeur . "<br>";
		}
		echo '<div style="background: green; padding: 10px; color: #fff; width: 230px; border-radius: 5px; text-align: center;">Inscription OK</div>';
	}
	echo $erreur;
}
?>
<!--
Réaliser un formulaire d'inscription avec les champs suivant : 
Pseudo, mdp, prenom, nom, email, adresse, cp, bouton submit
 - Contôler que l'on récupère en PHP toute les données saisies du formulaire
 - afficher au dessus les données du formulaire à l'aide d'un affichage conventionnelle 
 -->
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
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" placeholder="pseudo"><br><br><!-- l'attribut name est indispansable pour exploiter les données en PHP -->
			
			<label for="mdp">Mot de passe</label>
			<input type="text" id="mdp" name="mdp" placeholder="mot de passe"><br><br>
			
			<label for="nom">Nom</label>
			<input type="text" id="nom" name="nom" placeholder="nom"><br><br>
			
			<label for="prenom">Prénom</label>
			<input type="text" id="prenom" name="prenom" placeholder="prenom" pattern="[a-zA-Z0-9.-_]" title="caractères acceptés : a-zA-Z0-9.-_"><br><br>
			
			<label for="email">Email</label>
			<input type="text" id="email" name="email" placeholder="email"><br><br>
			
			<label for="adresse">Adresse</label>
			<textarea id="adresse" name="adresse"></textarea><br><br>
			
			<label for="code_postal">Code postal</label>
			<input type="text" id="code_postal" name="code_postal" placeholder="code_postal"><br><br>
			
			<input type="submit" value="inscription">
		</form>
	</body>
</html>