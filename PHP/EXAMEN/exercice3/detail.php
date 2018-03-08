<?php
require_once("inc/init.inc.php");

if($_GET && isset($_GET['id_movie']))
{
	//Préparation de notre requête
	$resultat=$pdo->prepare("SELECT * FROM movies WHERE id_movie= :id_movie");
	$resultat->bindValue(':id_movie',$_GET['id_movie'],PDO::PARAM_STR);
	$resultat->execute();
	
	//On vérifie que la requete retourne bien un film
	$nb_movies=$resultat->rowcount();
	if($nb_movies>0)	
	{
		//le film selectionné est trouvé
		$movie=$resultat->fetch(PDO::FETCH_ASSOC);
		$content .= '<div class="col-md-8 col-md-offset-2 text-center"><h3 class="alert-success">Tous les détails sur ce film</h3>';
		$content .='<table border=1 class="col-md-10 table" style="margin-top: 10px;">';
		//Affichage du film sélectionné		
		foreach($movie as $indice=>$valeur)
		{
			$content .='<tr><th>'.$indice.'</th><td>'.$valeur.'</td></tr>';
		}
		$content .= '</table>';
	}
	else
	{
		//le film selectionné n'est pas trouvé
		//L'internaute est peut rentré froduleusement sur ma page. Il est alors redirigé:
		header("location:exercice3.php");
	}
}
require_once("inc/header.inc.php");
echo $content;	

require_once("inc/footer.inc.php");
?>	
	