<!-- 
Réaliser un formulaire HTML avec les champs suivant : pseudo , email , bouton d'envoi, en récupérant et affichant les informations directement sur la page formulaire4.php 
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
		<h1>Formulaire de connexion</h1>
		<hr>
		<form method="post" action="formulaire4.php"><!-- method : comment vont circuler les données , action : URL de destination -->
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" placeholder="pseudo"><br><br><!-- l'attribut name est indispansable pour exploiter les données en PHP -->
			
			<label for="email">Email</label>
			<input type="text" id="email" name="email" placeholder="votre email"><br><br>
			<input type="submit" value="connexion">
		</form>
	</body>
</html>