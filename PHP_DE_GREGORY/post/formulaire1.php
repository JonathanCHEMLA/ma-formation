<?php
	/*
		les superglobales : ce sont des variables de type ARRAY qui sont prédéfinies dans le code et qui permettent de véhiculer des données
		on peut les appeler partout dans le code, à la fois dans l'espace local et dans l'espace global	
	*/
	//echo '<pre>'; print_r($_SERVER); echo '</pre>'; // affiche des informations sur notre serveur local XAMPP
	
	echo '<pre>'; print_r($_POST); echo '</pre>';
	// exercice : afficher les données saisies dans le formulaire avec un affichage classique 
	if($_POST) // si je clique sur le bouton connexion alors on rentre dans le if
	{
		echo '<hr>Pseudo : ' . $_POST['pseudo'] . '<br>';
		echo 'Mot de passe : ' . $_POST['mdp'] . '<br><hr>';
		// Exercice : afficher les données saisies dans le formulaire à l'aide d'une boucle
		foreach($_POST as $indice => $valeur) // la boucle foreach parcours la superglobal $_POST qui est une variable de type ARRAY
		{
			echo $indice . ' : ' . $valeur . '<br>'; // on affiche successivement les données saisies dans le formulaire
		}
	}
	/*
		Sans le if, la première fois lorsque nous n'avons rien posté, noius avons 2 erreurs undifined, mais cela n'empêche pas l'exemple de fonctionner.
		C'sst du au fait que quand on clic sur le bouton "connexion" le code se recharge, il est ré-executé et par conséquent le $_POST n'est plus unedifine
	*/
	
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
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" placeholder="pseudo"><br><br><!-- l'attribut name est indispansable pour exploiter les données en PHP -->
			
			<label for="mdp">Mot de passe</label>
			<input type="text" id="mdp" name="mdp" placeholder="mot de passe"><br><br>
			
			<input type="submit" value="connexion">
		</form>
	</body>
</html>
