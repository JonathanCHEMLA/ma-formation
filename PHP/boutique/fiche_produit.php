<?php
require_once("inc/init.inc.php");
require_once("inc/header.inc.php");

/*
Exercice: Réaliser une fiche produit avec les informations:titre, categorie,couleur, taille,photo,description,prix,public
Réaliser un selecteur pour choisir la quantité de produit (5 max)
Prévoir un message d'erreur en cas de rupture de stock
  
*/
if(isset($_GET["id_produit"])):

	$resultat=$pdo->prepare("SELECT * FROM produit WHERE id_produit=:id_produit");	//ATTENTION : ne pas oublier les "" dans la requete SQL
	$resultat->bindValue(':id_produit',$_GET['id_produit'],PDO::PARAM_INT);
	$resultat->execute();

	if($resultat->rowcount()<=0) //si un ptit malin s'amuse a modifier dans l'URL le id_produit et met un id_produit inconnu, alors on le redirige vers la page boutique pour ne pas avoir d'erreur 'undifined' sur la page profil
	{
		header("location:boutique.php");// pour rediriger il faut mettre les 2 mots: header ET location.
		exit(); //on stoppe l'execution du script
	}
	
	$produit = $resultat->fetch(PDO::FETCH_ASSOC);
	//debug($produit);
/*************************************************************************************************************************************************/	
//On transforme le résultat de $produit['public']:
	if($produit['public']="M")
	{
		$type_de_public="Homme";
	}
	elseif($produit['public']="F")
	{
		$type_de_public="Femme";
	}
	else
	{
		$type_de_public="Mixte";
	}

?>

<div class="col-md-6 col-md-offset-3">
  <div class="panel-default border">	<!--on a créé cette div, on a attribué la class panel-default de bootstrap et on a créé et attribué une class css qu'on a appelé 'border' -->
	<div class="panel-body">
	  <div class="panel-heading text-center"><h2><?= $produit['titre']?></h2></div>
	  <p class="text-center">Catégorie: <?= $produit['categorie']?> </p>		  
	  <p class="text-center">Couleur: <?= $produit['couleur']?> </p>		  
	  <p class="text-center">Taille: <?= $produit['taille']?> </p>	<!-- role a juste pour interet de dire que le role a c'est un bouton-->	  
	  <p><img width="600" class="img-responsive" alt="photo fantastique" src="<?= $produit['photo']?>"></p>		  
	  <p class="text-center">Description: <?= $produit['description']?> </p>
	  <p class="text-center">Public: <?= $type_de_public ?> </p>
	  <p class="text-center">Prix: <?= $produit['prix']?> €</p>
		  <em>Nombre de produit(s) disponibles: <?= $produit['stock']?></em>
		  
	 <?php if($produit['stock']>0):?>
		<form method="post" action="panier.php">
			<input type="hidden" name="id_produit" value="<?=$produit['id_produit']?>">
			<label for "quantite">Quantité</label>
			<select class="form-control" id="quantite" name="quantite">	<!--c'est le form-control qui permet l'affichage du select sur toute la largeur. si je supprime cette classe, le champ retrécit-->
			<?php
				for($i=1;$i<=$produit['stock'] && $i<=5;$i++)	// la valeur maximale du $i sera 5 si on a plus de 5 produits en stock et $produit['stock'] si le stock est inférieur à 5 qtés.
				{
					echo '<option>'.$i.'</option>';
				}
			?>
			</select><br>
			<input type="submit" name="ajout_panier" class="btn btn-primary col-md-12" value="ajout au panier">
		  </form>
	  
	  <?php else: ?>
		 <div class="alert alert-danger"> Rupture de stock !!!</div>
	  <?php endif; ?>
	  </div>
  </div>
</div><!--/.col-xs-6.col-lg-4-->



<?php

endif;

require_once("inc/footer.inc.php");

?>