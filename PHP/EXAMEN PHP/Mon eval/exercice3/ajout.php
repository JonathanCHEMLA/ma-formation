<?php

require_once("inc/init.inc.php");
	$erreur="";
//---------------------LORS DE LA VALIDATION DU FORMULAIRE: 


if(isset($_POST['envoi']))
{
	if(isset($_POST['title']) && isset($_POST['director']) && isset($_POST['actors']) && isset($_POST['producer']) && isset($_POST['storyline']) && isset($_POST['video']))
	{	
		//	1-TESTER QUE ES CHAMPS SONT REMPLIS CORRECTEMENT
		if(iconv_strlen($_POST['title'])<5)
		{
			$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Le champs \'titre\' doit contenir 5 caractères minimum !!!</div>';	
		
		}
		if(iconv_strlen($_POST['actors'])<5)
		{
			$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Le champs \'acteurs\' doit contenir 5 caractères minimum !!!</div>';	
		
		}
		if(iconv_strlen($_POST['director'])<5)
		{
			$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Le champs \'directeur\' doit contenir 5 caractères minimum !!!</div>';	
		
		}
		if(iconv_strlen($_POST['producer'])<5)
		{
			$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Le champs \'producteur\' doit contenir 5 caractères minimum !!!</div>';	
		
		}
		if(iconv_strlen($_POST['storyline'])<5)
		{
			$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Le champs \'synopsys\' doit contenir 5 caractères minimum !!!</div>';	
		}
		
		if(empty($erreur))

		{
		//	2-ENREGISTRER LE FILM
			$resultat_insert = $pdo->prepare('INSERT INTO movies (title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES(:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)');	

			$resultat_insert->bindValue(':title', 	$_POST["title"], PDO::PARAM_STR);
			$resultat_insert->bindValue(':actors', 	$_POST["actors"], PDO::PARAM_STR);
			$resultat_insert->bindValue(':director', 		$_POST["director"], PDO::PARAM_STR);
			$resultat_insert->bindValue(':producer', 	$_POST["producer"], PDO::PARAM_STR);
			$resultat_insert->bindValue(':year_of_prod', 		$_POST["year_of_prod"], PDO::PARAM_STR);
			$resultat_insert->bindValue(':language', 		$_POST["language"], PDO::PARAM_STR);
			$resultat_insert->bindValue(':category', 		$_POST["category"], PDO::PARAM_STR);
			$resultat_insert->bindValue(':storyline', 		$_POST["storyline"], PDO::PARAM_STR);	// IMPORTANT c'est $photo_bdd et non $_POST["photo"] car on veut récupérer tout l'URL
			$resultat_insert->bindValue(':video', 			$_POST["video"], PDO::PARAM_INT);	
			$resultat_insert->execute();

			$content .= '<div class="alert alert-succes col-md-8 col-md-offset-2 text-center">Le film intitulé: <strong class="text-success">'. $_POST["title"] . '</strong> a bien été enregistré dans la table movies </div>'; 
		}
	}
	else 
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Tous les champs sont obligatoires !!!</div>';	
	}
}
	$content .=$erreur;

	require_once("inc/header.inc.php");
	echo $content;
?>

	<form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">		
		<h1 class="alert alert-info text-center">Ajout d'un nouveau film:</h1>		
		
	  <div class="form-group">
		<label for="title">titre</label>
		<input type="text" class="form-control" id="title" placeholder="titre" name="title" value="">
	  </div>
	  <div class="form-group">
		<label for="actors">Acteurs</label>
		<input type="text" class="form-control" id="actors" placeholder="acteurs" name="actors" value="">
	  </div>
	  <div class="form-group">
		<label for="director">Directeur</label>
		<input type="text" class="form-control" id="director" placeholder="directeur" name="director" value="">
	  </div>
	  <div class="form-group">
		<label for="producer">Producteur</label>
		<input type="text" class="form-control" id="producer" placeholder="producteur" name="producer" value="">
	  </div>
	  <div class="form-group">
		<label for="year_of_prod">Année de production</label>
		<select class="form-control" name="year_of_prod" id="year_of_prod">
		<?php
			$i=2018;
			while($i>1950)
			{
				echo '<option value="'.$i.'">'.$i.'</option>';
				$i--;
			}
		?>
		</select>
	  </div>	  
	  <div class="form-group">
		<label for="language">Langue</label>
		<select class="form-control" name="language" id="language">
			<option value="f">Francais</option>
			<option value="a">Anglais</option>
		</select>
	  </div>
	  <div class="form-group">
		<label for="category">Catégorie</label>
		<select class="form-control" name="category" id="category">
			<option value="action">Action</option>
			<option value="comedie">Comédie</option>
			<option value="documentaire">Documentaire</option>
		</select>
	  </div>
	  <div class="form-group">
		<label for="storyline">Synopsis du film</label>
		<textarea class="form-control" id="storyline" name="storyline" rows="3"></textarea>
	  </div>
	  <div class="form-group">
		<label for="video">Lien de la bande annonce</label>
		<input type="text" class="form-control" id="video" placeholder="Lien de la bande annonce" name="video" value="">
	  </div>

	 
	  <button type="submit" class="btn btn-primary col-md-12" name="envoi">Ajouter ce film</button>
	  
	</form>
	
<?php	

require_once("inc/footer.inc.php");	
?>