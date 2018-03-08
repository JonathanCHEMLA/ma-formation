<?php
//require_once("../inc/init.inc.php");

require_once("../inc/header.inc.php");
?>

<?php
// création de la base de données

//$pdo = new PDO("mysql:host=localhost;dbname=exercice_3", 'root', '',
//array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::
//MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//Etape 1:
//Réalisée depuis PHP-MYADMIN
?>

<!--Etape 2:Création du formulaire-->
<form method="post" action="" class="col-md-8 col-md-offset-2">
		<h1 class="alert alert-info text-center">'.ucfirst($_GET["action"]) .' produit</h1>		<!-- ucfirst est une fct qui met la premiere lettre en Majuscule. -->
		
		<input type="hidden" id="id_membre" name="id_membre" value="'. $id_membre .'">
		
	  <div class="form-group">
		<label for="pseudo">Pseudo</label>
		<input type="text" class="form-control" id="pseudo" placeholder="pseudo" name="pseudo" value="'. $pseudo .'" >
	  </div>
	  <div class="form-group">
		<label for="mdp">Mot de Passe</label>
		<input type="text" class="form-control" id="mdp" placeholder="mdp" name="mdp" value="'. $mdp .'" >
	  </div>
	  <div class="form-group">
		<label for="nom">Nom</label>
		<input type="text" class="form-control" id="nom" placeholder="nom" name="nom" value="'. $nom .'">
	  </div>
	  <div class="form-group">
		<label for="prenom">Prénom</label>
		<input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom" value="'. $prenom .'">
	  </div>
	  <div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" placeholder="email" name="email" value="'. $email .'">
	  </div>

	  <div class="form-group">
		<label for="civilite">Civilité</label>
		<select class="form-control" name="civilite" id="civilite">
			<option value="m"'; if($civilite=='m') echo 'selected'; echo '>Homme</option>
			<option value="f"'; if($civilite=='f') echo 'selected'; echo '>Femme</option>
		</select>
	  </div>
	  <div class="form-group">
		<label for="ville">Ville</label>
		<input type="text" class="form-control" id="ville" placeholder="ville" name="ville" value="'. $ville .'">
	  </div>	  
	  <div class="form-group">
		<label for="code_postal">Code Postal</label>
		<input type="text" class="form-control" id="code_postal" placeholder="code_postal" name="code_postal" value="'. $code_postal .'">
	  </div>
	  <div class="form-group">
		<label for="adresse">Adresse</label>
		<input type="text" class="form-control" id="adresse" placeholder="adresse" name="adresse" value="'. $adresse .'">
	  </div>
	  
	  <div class="form-group">
		<label for="status">Statut</label>
		<select class="form-control" name="status" id="status">
			<option value="0"'; if($status=='0') echo 'selected'; echo '>MEMBRE</option>
			<option value="1"'; if($status=='1') echo 'selected'; echo '>ADMINISTRATEUR</option>	
		</select>
	  </div>

	  <button type="submit" class="btn btn-primary col-md-12">'.ucfirst($_GET["action"]) .' membre</button>
	  
	</form>
	
<?php
require_once("../inc/footer.inc.php");
?>	
	