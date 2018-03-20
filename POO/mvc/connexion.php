<?php

require('formulaire.php');


if($_POST){


	$resultat = $pdo -> prepare("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES (:prenom, :nom, :sexe, :service, :salaire, CURDATE())");

	$resultat -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
	$resultat -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
	$resultat -> bindParam(':sexe', $_POST['sexe'], PDO::PARAM_STR);
	$resultat -> bindParam(':salaire', $_POST['salaire'], PDO::PARAM_STR);
	$resultat -> bindParam(':service', $_POST['service'], PDO::PARAM_STR);

	if($resultat -> execute()){
		echo '<p style="color: white; background:green; padding:5px">Félicitations, vous êtes enregistré(e) !</p>';
	}


}
