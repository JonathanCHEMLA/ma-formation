<?php
	/*
		Exercice: 
		1 - réaliser un formulaire permettant de selectionner un fruit et sasir un poids
		2 - réaliser le traitement permettant d'afficher le prix en passant par la fonction déclarée "calcul"
		3 - Faites en sorte de garder le dsernier fruit sezlectionné et le dernier poids saisie dans le formulaire lorsqu'il a été validé		
	*/
	require_once("fonction.inc.php");
	if($_POST)
	{
		echo '<pre>'; print_r($_POST); echo '</pre>';
		echo calcul($_POST['fruit'], $_POST['poids']);
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
		<h1>Formulaire calcul fruits</h1>
		<hr>
		<form method="post" action=""><!-- method : comment vont circuler les données , action : URL de destination -->
			<label for="fruit">Fruit</label>
			<select name="fruit">
				<option value="cerises" <?php if(isset($_POST['fruit']) && $_POST['fruit'] == "cerises") echo "selected"; ?>>Cerises</option>
				<option value="bananes" <?php if(isset($_POST['fruit']) && $_POST['fruit'] == "bananes") echo "selected"; ?>>Bananes</option>
				<option value="pommes" <?php if(isset($_POST['fruit']) && $_POST['fruit'] == "pommes") echo "selected"; ?>>Pommes</option>
				<option value="peches" <?php if(isset($_POST['fruit']) && $_POST['fruit'] == "peches") echo "selected"; ?>>Peches</option>
			</select><br><br>
			
			<label for="poids">Poids</label>
			<input type="text" id="poids" name="poids" value="<?php if(isset($_POST['poids'])) echo $_POST['poids']; ?>"><br><br>
			
			<input type="submit" value="calculer">
		</form>
	</body>
</html>			