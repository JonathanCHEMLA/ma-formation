<?php
require_once("inc/init.inc.php");

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
	session_destroy();
}

if(internauteEstConnecte())
{
	header("location:profil.php");
}

if($_POST)
{
	$resultat = $pdo->query("SELECT * FROM membre WHERE pseudo ='$_POST[pseudo]'");
	
	if($resultat->rowCount() != 0)
	{
		$membre = $resultat->fetch(PDO::FETCH_ASSOC);
		//echo '<pre>';print_r($membre); echo '</pre>';
		// $membre['mdp'] == $_POST['mdp']	
		//password_verify($_POST['mdp'], $membre['mdp'])
		if($membre['mdp'] == $_POST['mdp'])
		{
			foreach($membre as $indice => $valeur)
			{
				if($indice != 'mdp')
				{
					$_SESSION['membre'][$indice] = $valeur;
					// nous créons une session avec les éléments provenant de la BDD
				}
				//echo '<pre>'; print_r($_SESSION);echo '</pre>';
			}
			header("location:profil.php");// le pseudo, le mdp étant correct, nous l'envoyons sur son profil
		}
		else
		{
			$content .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Erreur de MDP</div>';
		}
	}
	else
	{
		$content .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Erreur de pseudo</div>';
	}
	
	
}



require_once("inc/haut.inc.php");
echo $content;
?>

<form method="post" action="" class="col-md-8 col-md-offset-2">
	<h1 class="alert alert-info text-center">Connexion</h1>

	<div class="form-group">
		<label for="pseudo">Pseudo</label>
		<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo">
	</div>
	<div class="form-group">
		<label for="mdp">Mot de passe</label>
		<input type="text" class="form-control" id="mdp" name="mdp" placeholder="Password">
	</div><br>
  
	<input type="submit" class="col-md-10 col-md-offset-1 btn btn-success">
</form>

  
<?php
require_once("inc/bas.inc.php");