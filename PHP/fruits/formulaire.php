<?php
/*
	Exercice : 
	1 - réaliser un formulaire permettant de sélectionner un fruit et saisir un poids
	2 - réaliser le traitement permettant d'afficher le prix en passant par la fonction déclarée "calcul"
	3 - garder le dernier fruit sélectionné et le dernier poids saisidans le formulaire lorsqu'il a été validé
*/

require_once("fonction.inc.php");


if(isset($_POST["fruit"]) && empty($_POST["poids"]))
{

	echo '<pre>'; print_r($_POST); echo '</pre>';			// Attention: print_r(ne pas y mettre de guillemets)
	echo 'Fruit sélectionné : '. $_POST["fruit"].'<br>';

	echo calcul($_POST["fruit"],$_POST["poids"]);	
}
else
{
	echo "<p style='color:red;'> Merci de remplir tout le formulaire!</p>";		//ATTENTION: ne pas oublier le "=" apres le mot style, et mettre de simples cotes.
	//style="background: red; padding: 10px; color: #fff; width: 300px; border-radius: 5px;
	
}



?>
<html>
<body>

<h1>Formulaire</h1>
<form action="" method="post">
<label for="">Fruit</label>
<select name="fruit">							<!-- ATTENTION, penser a mettre name="fruit"   -->
<option>Choisir un fruit</option>				<!-- cette option est necessaire pour obliger l'user a choisir un fruit avant de lancer le traitement php-->
<option value="bananes" <?php if(isset($_POST["fruit"]) && $_POST["fruit"]=="bananes") echo "selected"; ?> > bananes</option>		<!-- ATTENTION, penser a mettre value="..."   -->
<option value="cerises" <?php if(isset($_POST["fruit"]) && $_POST["fruit"]=="cerises") echo "selected"; ?> > cerises</option>
<option value="pommes" 	<?php if(isset($_POST["fruit"]) && $_POST["fruit"]=="pommes")  echo "selected"; ?> > pomme	</option>
<option value="peches" 	<?php if(isset($_POST["fruit"]) && $_POST["fruit"]=="peches")  echo "selected"; ?> > peches	</option>
<option value="autre">autre</option>
</select><br><br>
<label for="poids">Combien de grammes souhaitez-vous?</label>
<input type="text" id="poids" name="poids" placeholder="1000" value="<?php if(isset($_POST["poids"])) echo $_POST["poids"];?>"><br><br>

<input type="submit" value="calculer">
</form>

</body>
</html>