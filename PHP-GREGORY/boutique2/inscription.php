<?php
require_once("inc/init.inc.php");
//echo '<pre>'; print_r($_POST);echo '</pre>';

/* Contrôlé les champs suivants :
	contrôler la disponibilité du pseudo,
	contrôler la taille des champs : pseudo, nom, prenom : entre 4 et 20 caractères
*/

if($_POST)
{
	
	$erreur = '';
	$resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
	if($resultat->rowCount() >= 1)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Pseudo indisponible</div>';
	}
	if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Erreur de taille pseudo</div>';
	}
	if(strlen($_POST['nom']) < 4 || strlen($_POST['nom']) > 20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Erreur de taille nom</div>';
	}
	if(strlen($_POST['prenom']) < 4 || strlen($_POST['prenom']) > 20)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Erreur de taille prénom</div>';
	}
	if(!preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']))
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Erreur format/caractère pseudo</div>';
	}
	// preg_match() : une expression régulière est toujours entouré de # pour préciser les options:
	// ^ indique le début de la chaine
	// $ indique la fin de la chaine
	// + est la pour dire que les lettres autorisés peuvent apparaitre plausieurs fois
	foreach($_POST as $indice => $valeur)
	{
		$_POST[$indice] = strip_tags($valeur);
	}
	
	$content .= $erreur;
	
	if(empty($erreur))
	{
		//$_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // cryptage du mdp.
		
		$resultat = $pdo->prepare("INSERT INTO membre(pseudo,mdp,nom,prenom,email,civilite,ville,code_postal,adresse)VALUES(:pseudo,:mdp,:nom,:prenom,:email,:civilite,:ville,:code_postal,:adresse)");
		
		$resultat->bindValue(':pseudo',$_POST['pseudo'],PDO::PARAM_STR);
		$resultat->bindValue(':mdp',$_POST['mdp'],PDO::PARAM_STR);
		$resultat->bindValue(':nom',$_POST['nom'],PDO::PARAM_STR);
		$resultat->bindValue(':prenom',$_POST['prenom'],PDO::PARAM_STR);
		$resultat->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
		$resultat->bindValue(':civilite',$_POST['civilite'],PDO::PARAM_STR);
		$resultat->bindValue(':ville',$_POST['ville'],PDO::PARAM_STR);
		$resultat->bindValue(':code_postal',$_POST['code_postal'],PDO::PARAM_INT);
		$resultat->bindValue(':adresse',$_POST['adresse'],PDO::PARAM_STR);
		
		$resultat->execute();
		
		$content .= '<div class="alert alert-success col-md-8 col-md-offset-2">Vous êtes inscrit à notre site WEB. <a href="connexion.php">Cliquez ici pour vous connecter</a></div>';
		
		
	}
}
require_once("inc/haut.inc.php");
echo $content;

?>


<!-- Réaliser un formulaire d'inscription correspondant à la table membre de la BDD -->

<form method="post" action="" class="col-md-8 col-md-offset-2">
	<h1 class="alert alert-info text-center">Inscription</h1>

  <div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" pattern="[a-zA-Z0-9-_.]{4,20}" title="caractères acceptés : a-zA-Z0-9-_.">
  </div>
  <div class="form-group">
    <label for="mdp">Password</label>
    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="Password">
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
    <input type="email" class="form-control" id="email"  name="email" placeholder="Email">
  </div>
  
	<label for="civilite">Civilité</label><br>
	<label class="radio-inline">
	<input type="radio" id="civilite" name="civilite" value="m" checked> homme
	</label>
	<label class="radio-inline">
	<input type="radio" id="civilite" name="civilite" value="f"> femme<br>
	</label><br>
	
  <div class="form-group"><br>
    <label for="ville">Ville</label>
    <input type="text" class="form-control" id="ville" name="ville" placeholder="ville">
  </div>
  
  <div class="form-group">
    <label for="code_postal">Code Postal</label>
    <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="Code Postal">
  </div>
  
  <label for="adresse">Adresse</label>
  <textarea class="form-control" rows="3" id="adresse" name="adresse"></textarea><br>
  
  <input type="submit" class="col-md-12 btn btn-primary" value="inscription"><br><br><br>
</form>


<?php
require_once("inc/bas.inc.php");
?>