<?php
//voir le site sololearn pour tester nos connaissances dans les languages.

require_once("inc/init.inc.php");

require_once("inc/header.inc.php");
//debug($_POST);	// si j'insere cette ligne entre les 2 précédents require et que je supprime  [ float: center; clear both; ](page fonction.inc.php) la boite s'affiche sur tte la largeur, au dessus du menu
/*
	controle des champs suivants:
	- controler la disponibilité du pseudo
	- controler la taille des champs : pseudo, nom, prenom : entre 4 et 20 caractères
	- controler que le code postal soit de type numéric et de 5 caratères
	- controler la validité du champs email
*/


if($_POST)
{
	$erreur="";
	$verif_pseudo = $pdo->prepare('SELECT pseudo FROM membre WHERE pseudo = :pseudo');
	$verif_pseudo->bindValue(':pseudo', $_POST["pseudo"], PDO::PARAM_STR);
	$verif_pseudo->execute();
    
	if($verif_pseudo->rowCount()>0)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Pseudo Indisponible !!</div>';	
	}
	if(strlen($_POST["pseudo"]) <2 || strlen($_POST["pseudo"])>20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille de pseudo invalide !!</div>';	
	}
	if(strlen($_POST["nom"]) <2 || strlen($_POST["nom"])>20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille de nom invalide !!</div>';	
	}
	if(strlen($_POST["prenom"]) <2 || strlen($_POST["prenom"])>20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille du prenom invalide !!</div>';	
	}
	if(!is_numeric($_POST["code_postal"]) || strlen($_POST["code_postal"])!==5)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">code postal non valide !!</div>';	
	}
	if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))		//FILTER_VALIDATE_EMAIL est une instruction NATIVE de PHP qui teste la validite de mon Email.
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Format Email non valide !!</div>';	
	}		
	
	$content .= $erreur;		//on a dû mettre $erreur dans $content car $erreur n'est pas connue tant qu'on ne rentre pas dans le if($_POST). $content, quant à lui, est declare dans la page init.inc.php qui est rattaché à notre page
	
	if (empty($erreur))
	{
		//Exercice : réaliser le script permettant de s'insérer dans la table membre à l'aide d'une requête préparée
		
		$_POST["mdp"] =password_hash($_POST['mdp'], PASSWORD_DEFAULT); //on ne conserve jamais les mots de passe en clair dans la BDD.
		//password_hash permet de hacher le mot de passe en algorithme
	
		$insert_membre = $pdo->prepare('INSERT INTO membre (pseudo, mdp, nom, prenom, civilite, ville, code_postal, adresse, email) VALUES(:pseudo,:mdp,:nom,:prenom,:civilite,:ville,:code_postal,:adresse,:email)');	
		// ATTENTION: dans Insert into, ne PAS OUBLIER de fermer les ''  !!!
		$insert_membre->bindValue(':pseudo', $_POST["pseudo"], PDO::PARAM_STR);
		$insert_membre->bindValue(':mdp', $_POST["mdp"], PDO::PARAM_STR);
		$insert_membre->bindValue(':nom', $_POST["nom"], PDO::PARAM_STR);
		$insert_membre->bindValue(':prenom', $_POST["prenom"], PDO::PARAM_STR);
		$insert_membre->bindValue(':ville', $_POST["ville"], PDO::PARAM_STR);
		$insert_membre->bindValue(':code_postal', $_POST["code_postal"], PDO::PARAM_STR);
		$insert_membre->bindValue(':adresse', $_POST["adresse"], PDO::PARAM_STR);
		$insert_membre->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
		$insert_membre->bindValue(':civilite', $_POST["civilite"], PDO::PARAM_STR);
		$insert_membre->execute();
		
		$content .= '<div class="alert alert-succes col-md-8 col-md-offset-2 text-center">Vous êtes inscrit sur notre site Web !! <a href="connexion.php" class="alert-link"> Cliquez ici pour vous connecter</a></div>';	
	}
	
}

echo $content;	//au premier chargement de la page, on ne rentre pas dans le if donc si on avait fait ici: echo $erreur il y aurait eu un msg d'erreur.

?>
<!-- Réaliser un formulaire d'inscription correspondant à la table membre de la BDD (sans les champs id_membre, status) -->
<form method="post" action="" class="col-md-8 col-md-offset-2">
	<h1 class="alert alert-info text-center">Inscription</h1>
	
  <div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" placeholder="pseudo" name="pseudo">
  </div>
  <div class="form-group">
    <label for="mdp">Mot de Passe</label>
    <input type="password" class="form-control" id="mdp" placeholder="mdp" name="mdp">
  </div>
    <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" placeholder="nom" name="nom">
  </div>
    <div class="form-group">
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom">
  </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" placeholder="email" name="email">
  </div>
    <div class="form-group">
    <label for="civilite">Civilité</label>
	<select class="form-control" name="civilite" id="civilite">
		<option value="m">Homme</option>
		<option value="f">Femme</option>
	</select>
  </div>
    <div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" class="form-control" id="ville" placeholder="ville" name="ville">
  </div>
  <div class="form-group">
    <label for="code_postal">Code Postal</label>
    <input type="text" class="form-control" id="code_postal" placeholder="code_postal" name="code_postal">
  </div>
  <div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control" id="adresse" placeholder="adresse" name="adresse">
  </div>
 

  <button type="submit" class="btn btn-primary col-md-12">Inscription</button>
</form>



<?php
require_once("inc/footer.inc.php");
?>