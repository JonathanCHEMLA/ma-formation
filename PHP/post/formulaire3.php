<!-- 
	Realiser un formulaire html avec les champs suivants: pseudo, email, valider, en recupernat et affichant les informations directement sur la page formulaire4.php
-->
<!DOCTYPE html>
<html>
<head>
	<title>Formulaire 3</title>
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
	<h1>Formulaire de connexion</h1>
	<hr>
	<form method="post" action="formulaire4.php">
	<!-- method:cmt vont circuler les données.  Action: URL de destination -->
		<label for="pseudo">pseudo</label>
		<input type="text" placeholder="pseudo" name="pseudo" id="pseudo"><br><br>
		
		<label for="email">Email</label>
		<input type="text" placeholder="email" name="email" id="email"> <br><br>

		<input type="submit" name="submit" value="inscription"> 
	</form>
</body>
</html>