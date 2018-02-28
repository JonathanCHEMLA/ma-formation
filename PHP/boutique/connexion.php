<?php
require_once("inc/init.inc.php");

if(isset($_GET["action"])&& $_GET["action"]=='deconnexion')
{
	session_destroy();
}

if(internauteEstConnecte())	//si l'internaute est connecté, il n'a rien à faire sur la page connexion, on le re-dirige vers sa page profil.
{
	header("location:profil.php");
}



//debug($_POST);
if($_POST)
{
	$requete= $pdo->query("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
	if($requete->rowCount()!=0)
	{
		$membre = $requete->fetch(PDO::FETCH_ASSOC);
		//debug($membre);
		
		//if($_POST['mdp']==$membre['mdp'])
		if(password_verify($_POST['mdp'],$membre['mdp']))	// on controle que le mdp de la BDD est le meme que celui que l'internaute a saisi dans le formulaire
		{
			debug($membre);
			foreach($membre as $indice => $valeur)	//on passe en revue les informations du membre qui a le bon pseudo et mdp
			{
				if($indice !='mdp')// on exclut le mdp qui n'est pas conservé dans le fichier session
				{
					$_SESSION['membre'][$indice]=$valeur;//on crée dans le fichier session un tableau membre et on enregistre les données de l'user qui pourra dès a présent naviguer sur le site sans etre deconnecté
				}	
			}
			//debug($_SESSION);
			header("location:profil.php");	//ayant les bons identifiants, ob lel re-dirige vers sa page profil
		}
		else	// sinon l'internaute a saisi un mauvais mdp
		{
			$content .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Erreur de Mot de Passe !!</div>';	
		}
	
	}
	else	//sinon l'internaute a saisi un mauvais pseudo
	{
		$content .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Erreur de Pseudo !!</div>';	
	}
}

require_once("inc/header.inc.php");
echo $content;
?>

<!-- realiser un formulaire de connection (pseudo, mdp,et submit)-->

<form method="post" action="" class="col-md-8 col-md-offset-2">
	<h1 class="alert alert-info text-center">Connection</h1>
	
  <div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" placeholder="pseudo" name="pseudo">
  </div>
  <div class="form-group">
    <label for="mdp">Mot de Passe</label>
    <input type="password" class="form-control" id="mdp" placeholder="mdp" name="mdp">
  </div>
 
  <button type="submit" class="btn btn-primary col-md-12">Connection</button>
</form>


<?php
require_once("inc/footer.inc.php");
?>