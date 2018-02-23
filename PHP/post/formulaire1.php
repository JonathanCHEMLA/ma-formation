<?php
/*
	les superglobales : ce sont des variables de type ARRAY qui sont prédéfinies dans le code et qui permettent de véhiculer des données. On peut les appeler a tout moment dans le code, à la fois dans l' espace local et dans l'espace global
les superglobales renvoient des tableaux
	*/

//echo '<pre>'; print_r($_SERVER); echo '</pre>';	// affiche des informations de notre serveur local XAMPP


echo '<pre>'; print_r($_POST); echo '</pre>';	

//equivalent de ctrl+F5:  cliquer qur la barre d'url,  ca recharge la page comme si que tu y accedais pour la 1ere fois.
if($_POST)		//avant la validation du formulaire, $_POST="". Apres la validation du formulaire $_POST="informations envoyées".  LORSQU'UNE variable="" CELA VAUT FALSE
{
echo "Pseudo : ".$_POST['pseudo'].'<br>';
echo "Mot de Passe : ".$_POST['mdp'].'<br>';
//exercice: afficher les données saisies dans le formulaire à l'aide d'une boucle

echo "<br>";
echo "<br>";

foreach($_POST as $indice=>$info)
{
	echo $indice. " : ".$info.'<br>';// on affiche successivement les données saisies dans le formulaire
}
/*

Sans le if, la premiere fois, lorsque nous n'avons rien posté nous avons 2 erreur undifined.  
mais cela n'empêche pas l'exemple de fonctionner.
C'est dû au fait que , quand on clique sur le bouton "connection", le code se recharge.
Il est ré-exécuté, et par consequent, le $_POST  n'est plus undifined.

*/

//on ne peut afficher un array avec un simple echo.
//on doit utiliser un foreach: 
//	
//	foreach($nomDuTableauArraySansCrochetsNiParentheses as $indice => $valeurQuiPeutEtreSoitUneVariableSoitUnArray)
//	{
//		echo $indice . ":" . $valeur;
//	}

}
?>



<!Doctype html>
<html>
<head>
	<title>Formulaire 1 </title>
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


<h1>FORMULAIRE DE CONNEXION</H1>
<hr>

<form action="" method="post">		<!-- method: comment vont circuler les données.   get: envoyer les info dans l'url dans $_GET,   post: via le formulaire et pas via l'url et on va ensuite les exploiter dans $_POST-->
<label for="pseudo">Pseudo</label>
<input type="text" name="pseudo" placeholder="Pseudo" id="pseudo"><br><br>	<!--l'atribut name est indispensable pour exploiter les données en php-->
<label for="mdp">Password</label>
<input type="password" name="mdp" placeholder="Mot de passe" id="mdp"><br><br>

<input type="submit" name="valider" value="connexion">

</form>


</body>
</html>

