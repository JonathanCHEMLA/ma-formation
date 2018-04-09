<?php
require_once("inc/init.inc.php");
//debug($_POST); 
/*
	Contrôle des champs suivants : 
	- contrôler la disponibilité du pseudo
	- contrôler la taille des champs : pseudo, nom, prenom : entre 2 et 20 caractère
	- contrôler que le code postal soit de type numérique et de 5 caractères
	- contrôler la validité du champs email
*/
if($_POST)
{
	$erreur = '';
	$verif_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
	$verif_pseudo->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
	$verif_pseudo->execute();
	if($verif_pseudo->rowCount() > 0)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Pseudo indisponible !!</div>';
	}
	if(strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">taille de pseudo non valide !!</div>';
	}
	if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">taille de nom non valide !!</div>';
	}
	if(strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">taille de prenom non valide !!</div>';
	}
	if(!is_numeric($_POST['code_postal']) || strlen($_POST['code_postal']) !== 5)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Code postal non valide !!</div>';
	}
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Format Email non valide !!</div>';
	}
	$content .= $erreur;
	
	if(empty($erreur))
	{
		// Exercice : réaliser le script permettant de s'insérer dans la table membre à l'aide d'une requete préparée
		//$_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);// on ne conserve jamais les mots de passe en clair dans la BDD, password_hash permet de hacher le mot de passe en algorithme
		
		$resultat = $pdo->prepare("INSERT INTO membre (pseudo,mdp,nom,prenom,email,civilite,ville,code_postal,adresse) VALUES (:pseudo,:mdp,:nom,:prenom,:email,:civilite,:ville,:code_postal,:adresse)");
		
		$resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$resultat->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR);
		$resultat->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
		$resultat->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
		$resultat->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
		$resultat->bindValue(':civilite', $_POST['civilite'], PDO::PARAM_STR);
		$resultat->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
		$resultat->bindValue(':code_postal', $_POST['code_postal'], PDO::PARAM_INT);
		$resultat->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
		
		$resultat->execute();
		
		$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center">Vous êtes inscrit sur notre site Web !! <a href="connexion.php" class="alert-link">Cliquez ici pour vous connecter</a></div>';
		
	}
}

require_once("inc/header.inc.php");
echo $content;


?>

<!-- Réaliser un formulaire d'inscription correspondant à la table membre de la BDD (sans les champs id_membre, satuts) -->

<form method="post" action="" class="col-md-8 col-md-offset-2">
	<h1 class="alert alert-info text-center">Inscription</h1>

  <div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo">
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="mot de passe">
  </div>
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="nom">
  </div>
  <div class="form-group">
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="email">
  </div>
  <div class="form-group">
	  <label for="civilite">Civilité</label>
	  <select class="form-control" id="civilite" name="civilite">
		  <option value="m">Homme</option>
		  <option value="f">Femme</option>
	  </select>
  </div>
  <div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" class="form-control" id="ville" name="ville" placeholder="ville">
  </div>
  <div class="form-group">
    <label for="code_postal">Code postal</label>
    <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="code_postal">
  </div>
  <div class="form-group">
    <label for="adresse">Adresse</label>
	<textarea class="form-control" rows="3" id="adresse" name="adresse"></textarea>
  </div>	
  <button type="submit" class="btn btn-primary col-md-12">Inscription</button>
</form>








<?php
require_once("inc/footer.inc.php");
?>