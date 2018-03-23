<?php
require_once("inc/init.inc.php");

if(!internauteEstConnecte())
{
	header("location:connexion.php");
}

//--- MODIFICATION MEMBRE ---//
if(!empty($_POST))
{
	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	{
		$resultat = $pdo->prepare("UPDATE membre SET pseudo = :pseudo, mdp = :mdp, nom = :nom, prenom = :prenom, email = :email, civilite = :civilite, ville = :ville, code_postal = :code_postal, adresse = :adresse WHERE id_membre ='$_POST[id_membre]'");
		
		$content .= '<div class="col-md-8 col-md-offset-2 alert alert-success text-center">Le membre n° ' . $_GET['id_membre'] . ' a bien été modifié ! </div>';
		
	}
		$resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$resultat->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR);
		$resultat->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
		$resultat->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
		$resultat->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
		$resultat->bindValue(':civilite', $_POST['civilite'], PDO::PARAM_STR);
		$resultat->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
		$resultat->bindValue(':code_postal', $_POST['code_postal'], PDO::PARAM_INT);
		$resultat->bindValue(':adresse', $_POST['adresse'] , PDO::PARAM_STR);
		
		$resultat->execute();
		
		$compte = $pdo->query("SELECT * FROM membre WHERE id_membre = '$_POST[id_membre]'");
		
		$new_compte_membre = $compte->fetch(PDO::FETCH_ASSOC);
		//debug($new_compte_membre);
		//debug($_SESSION);
		
		foreach($new_compte_membre as $indice => $valeur)
		{
			if($indice != 'mdp')
			{
				$_SESSION['membre'][$indice] = $valeur;
			}
		}
		header("location:" . URL . "profil.php?action=modif_compte&id_membre=" . $_SESSION['membre']['id_membre']);
}

if(isset($_GET['action']) && $_GET['action'] == 'modification')
{
	if(isset($_GET['id_membre']))
	{
		$resultat = $pdo->query("SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]'");
		$membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
		//debug($produit_actuel);
	}
	$id_membre = (isset($membre_actuel['id_membre'])) ? $membre_actuel['id_membre'] : '';
	$pseudo = (isset($membre_actuel['pseudo'])) ? $membre_actuel['pseudo'] : '';
	$mdp = (isset($membre_actuel['mdp'])) ? $membre_actuel['mdp'] : '';
	$nom = (isset($membre_actuel['nom'])) ? $membre_actuel['nom'] : '';
	$prenom = (isset($membre_actuel['prenom'])) ? $membre_actuel['prenom'] : '';
	$email = (isset($membre_actuel['email'])) ? $membre_actuel['email'] : '';
	$civilite = (isset($membre_actuel['civilite'])) ? $membre_actuel['civilite'] : '';
	$ville = (isset($membre_actuel['ville'])) ? $membre_actuel['ville'] : '';
	$ville = (isset($membre_actuel['mdp'])) ? $membre_actuel['mdp'] : '';
	$code_postal = (isset($membre_actuel['code_postal'])) ? $membre_actuel['code_postal'] : '';
	$adresse = (isset($membre_actuel['adresse'])) ? $membre_actuel['adresse'] : '';
	
	$content .= '<form method="post" enctype="multipart/form-data" action="" class="col-md-8 col-md-offset-2">
		<h3 class="alert alert-info text-center">Modification de vos informations</h3>
			<input type="hidden" id="id_membre" name="id_membre" value="' . $id_membre . '">
		
		  <div class="form-group">
			<label for="pseudo">Pseudo</label>
			<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo" value="' . $pseudo .'">
		  </div>
		  <div class="form-group">
			<label for="pseudo">Mot de passe</label>
			<input type="text" class="form-control" id="mdp" name="mdp" placeholder="mdp" value="' . $mdp .'">
		  </div>
		  <div class="form-group">
			<label for="nom">Nom</label>
			<input type="text" class="form-control" id="nom" name="nom" placeholder="nom" value="' . $nom . '">
		  </div>
		  <div class="form-group">
			<label for="prenom">Prénom</label>
			<input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" value="' . $prenom . '">
		  </div>
		  <div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="email" value="' . $email . '">
		  </div>
		  <label for="civilite">Civilité</label>
		  <select class="form-control" name="civilite">
			  <option value="m"'; if($civilite == 'm')$content .= 'selected';  $content .='>Homme</option>
			  <option value="f"'; if($civilite == 'f')$content .= 'selected';  $content .='>Femme</option>
		  </select><br>
		  <div class="form-group">
			<label for="ville">Ville</label>
			<input type="text" class="form-control" id="ville"  name="ville" placeholder="ville" value="' . $ville . '">
		  </div>
		  <div class="form-group"><br>
			<label for="code_postal">Code Postal</label>
			<input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="code_postal" value="' . $code_postal . '">
		  </div>
		  <div class="form-group"><br>
			<label for="adresse">Adresse</label>
			<textarea class="form-control" id="adresse" name="adresse" rows="3">' . $adresse . '</textarea>
		  </div>	
		  
		  <input type="submit" class="col-md-12 btn btn-primary" value="Enregistrer les ';$content .= $_GET['action'] . 's"><br><br><br>
	</form>';
}
else
{
	$content .= '<div class="col-md-8 col-md-offset-2 alert alert-danger text-center">T\'as modifié l\'URL hein ? tu t\'es bien fait avoir!!!!</div>';
}

require_once("inc/haut.inc.php");
echo $content;
require_once("inc/bas.inc.php");