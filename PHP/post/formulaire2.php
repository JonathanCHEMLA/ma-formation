<?php

echo '<pre>'; print_r($_POST); echo'</pre>';

if($_POST)
{

$erreur="";
// les regexp vont me permettre de definir quels caracteres doivent ou non etre saisis dan sun champ.
	if(iconv_strlen($_POST["pseudo"])>20 || iconv_strlen($_POST["pseudo"])<5 )
	{
		//echo "votre pseudo doit avoir une taille comprise entre 5 et 20 caractères";
		$erreur.= '<div style="background: red; padding: 10px; color: #fff; width: 300px; border-radius: 5px;">Merci de saisir un pseudo valide</div>';
	}
	if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
	{
		$erreur.= '<div style="background: red; padding: 10px; color: #fff; width: 300px; border-radius: 5px;">Merci de saisir un email valide</div>';	

	}	
	if (!filter_var($_POST["cp"], FILTER_VALIDATE_INT) || iconv_strlen($_POST["cp"])!=5)
// on aurait pu aussi taper le If de cette manière: 
//  if !is_numeric($_POST["cp"]) || iconv_strlen($_POST["cp"])!=5)
	{
		$erreur.= '<div style="background: red; padding: 10px; color: #fff; width: 300px; border-radius: 5px;">Merci de saisir un Code Postal valide</div>';	

	}		
	if(!preg_match('#^[a-zA-Z0-9.-_]+$#', $_POST['prenom']))	
	// preg_match(): expression régulière REGEX
	// les regex sont tjrs encadrees de #.
	
	//concernant les options:
	// ^ et $ delimitent les chaines de caracteres. 
	// le + signifie qu'on peut utiliser un meme caractère plusieurs fois.
	// les seuls caractères acceptés dans ce champ sont les lettres, de A à Z, de a à z, de 0 à 9, le point, le tiret et l'underscore. le % n est pas accepté.
	{
		$erreur.= '<div style="background: red; padding: 10px; color: #fff; width: 300px; border-radius: 5px;">Merci de saisir un Prénom valide</div>';	
	}
	if(!preg_match('#[a-zA-Z.-_]+#', $_POST['nom']))	
	{
		$erreur.= '<div style="background: red; padding: 10px; color: #fff; width: 300px; border-radius: 5px;">Merci de saisir un Nom valide</div>';	
	}	
	if(empty($erreur)){


		foreach($_POST as $indice => $valeur)
		{

			echo $indice.':'.$valeur."<br>";

		}

		$erreur.= '<div style="background: green; padding: 10px; color: #fff; width: 300px; border-radius: 5px;"> inscription ok</div>';	

		//informer l'user si la taille du pseudo n'est pas compirse entre 5 et 20 caractères
		//controler que l'email est bien valide
		//controler la taille et le type numérique du code postal
		//si les données sont valides, on affiche les données du formaulaire.
	}
	echo $erreur;
}
?>


<!--
	Réaliser un formulaire d'inscription avec les champs suivants :
	Pseudo, mdp, prenom, nom, email, adresse, cp, bouton submit

	-controler que l'on récupère en PHP toutes les données saisies du formulaire
	-Afficher au dessus, les données du formulaire à l'aide d'un affichage conventionnel
-->


<!DOCTYPE html>
<html>
<head>
	<title>Formulaire 2</title>
	<style>
		label{
			float:left;	/* IL FAUT 3 instructions: le float, le width, et 2 <br> apres chaque input */
			width:120px;
			font-style:italic;
			font-family:calibri;
		}
	</style>
</head>
<body>

	<h1>FORMULAIRE D'INSCRIPTION</h1>
	
	<form action="" method="post">
		<label for="pseudo">pseudo</label>
		<input type="text" placeholder="pseudo" name="pseudo" id="pseudo"><br><br>
		
		<label for="mdp">Mot de Passe</label>
		<input type="text" placeholder="Mot de Passe" name="mdp" id="mdp"> <br><br>

		<label for="nom">Nom</label>
		<input type="text" placeholder="nom" name="nom" id="nom"> <br><br>

		<label for="prenom">Prénom</label>
		<input type="text" placeholder="prenom" name="prenom" id="prenom" pattern="[a-zA-Z0-9.-_]{5,20}" title="caractères acceptés: a-zA-Z0-9.-_ "> <br><br>
<!---comme le pattern peut etre contourné par l'user malveillant, il vaut mieux mettre un controle en php, plutot que le pattern html-->
		<label for="email">Email</label>
		<input type="text" placeholder="email" name="email" id="email"> <br><br>

		<label for="adresse">Adresse</label>
		<input type="text" placeholder="adresse" name="adresse" id="adresse"> <br><br>

		<label for="cp">Code Postal</label>
		<input type="text" placeholder="Code Postal" name="cp" id="cp"> <br><br>

		<input type="submit" name="submit" value="inscription"> 
	</form>
</body>
</html>