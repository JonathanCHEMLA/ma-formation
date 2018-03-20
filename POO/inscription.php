<?php

$pdo=new PDO('mysql:host=localhost;dbname=entreprise_origine',
'root','',array( PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // cette ligne est à banir de notre site lorsqu'il sera en production!!!!
//Autrement on pourra le pirater en tapant dans google:		inurl id=  et mettre une '  ,à la fin de l'url.
PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'));

if($_POST) // c'est pareil que if(!empty($_POST)) 
{
	//on met curdate quand le champ est un champ date ,  et now quand le champ est un champ datetime
	$resultat=$pdo->prepare("INSERT INTO employes (nom,prenom,sexe,service,salaire,date_embauche) VALUES(:nom,:prenom,:sexe,:service,:salaire,CURDATE())");
	$resultat->fetch(PDO::FETCH_ASSOC);
	$resultat->execute( array(
    ':nom' => $_POST['nom'],
	':prenom' => $_POST['prenom'],
	':sexe' => $_POST['sexe'],
	':service' => $_POST['service'],
	':salaire' => $_POST['salaire']
	));
	echo '<p style="color: white; background:green; padding:5px">Félicitations, vous êtes enregistré(e) !</p>';
}

?>
<h1>Enrtegistrement entreprise</h1>

<form method="post" action="">

	<input type="text" name="prenom" placeholder="Votre prénom"><br/>
	<input type="text" name="nom" placeholder="Votre nom"><br/>
	<input type="text" name="salaire" placeholder="Votre salaire"><br/>

	<select name="sexe">
		<option value="m">Homme</option>
		<option value="f">Femme</option>
	</select><br/>

	<select name="service">
		<option value="direction">Direction</option>
		<option value="comptabilite">Comptabilité</option>
		<option value="informatique">Informatique</option>
		<option value="production">Production</option>
		<option value="secretariat">Secrétariat</option>
	</select><br/>


	<input type="submit" value="enregistrer"><br/>
</form>