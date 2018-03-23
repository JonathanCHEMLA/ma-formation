<?php
require_once("inc/init.inc.php");

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion') // si on clique sur le lien deconnexion, on supprime le session
{
	session_destroy();
}

if(internauteEstConnecte()) // si l'internaute est connecté, il n'a rien à faire sur la page connexion, on le re dirige vers sa page profil
{
	header("location:profil.php");
}

//debug($_POST);
if($_POST)
{
	$resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'"); // on selectionne en BDD tout les membre qui possède le même pseudo que l'internaute a saisie dans le formaulaire
	
	if($resultat->rowCount() != 0) // si le résultat est différent de 0, c'est que le pseudo est connu en BDD
	{
		$membre = $resultat->fetch(PDO::FETCH_ASSOC); // on associe la méthode fetch() pour rendre exploitable le résultat et récupérer les données de l'internaute ayant saisie le bon pseudo
		//debug($membre);
		//password_verify($_POST['mdp'], $membre['mdp']) 
		if($membre['mdp'] == $_POST['mdp']) // on contrôle que le mot de passe de la BDD est le même que celui que l'internaute a saisie dans le formaulaire
		{
			foreach($membre as $indice => $valeur) // on passe en revue les inforamtions du membre qui a le bon pseudo et mdp
			{
				if($indice != 'mdp') // on exclu le mdp qui n'est pas conservé dans le fichier session
				{
					$_SESSION['membre'][$indice] = $valeur; // on crée dans le fichier session un tableau membre et on enregistre les données de l'internaute qui pourra dès à présent naviguer sur le site sans être déconnecté
				}
			}
			//debug($_SESSION);
			header("location:profil.php"); // ayant les bons identifiants, on le re-dirige vers sa page profil
		}
		else // sinon l'internaute a saisie un mauvais mdp
		{
			$content .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Erreur de mot de passe !!</div>';
		}
	}
	else // sinon l'internaute a saisie un mauvais pseudo
	{
		$content .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Erreur de pseudo !!</div>';
	}
}

require_once("inc/header.inc.php");
echo $content;
?>


<!-- Réaliser un formaulaire HTML de connexion (champs pseudo, mot de passe et le bouton submit) -->
<form method="post" action="" class="col-md-8 col-md-offset-2">
	<h1 class="alert alert-info text-center">Connexion</h1>

  <div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo">
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="mot de passe">
  </div>
<button type="submit" class="btn btn-primary col-md-12">Connexion</button>
</form>

<?php
require_once("inc/footer.inc.php");
?>