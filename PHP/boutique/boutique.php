<?php
require_once("inc/init.inc.php");

require_once("inc/header.inc.php");
?>
		<!--on a pris un tamplate bootstrap, on a pris que le contenu de la div contener.-->
<div class="row row-offcanvas row-offcanvas-right">


	<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	  <div class="list-group">
		<p class="list-group-item active text-center">CATEGORIES </p>
		<?php 
		//exercice: Afficher les catégories distinctes de la table porduit à l'aide d'une boucle
		$resultat=$pdo->query("SELECT DISTINCT categorie FROM produit");	//$resultat n'est jamais exploitable tel quel.  
		while($categorie=$resultat->fetch(PDO::FETCH_ASSOC))
		{
			foreach($categorie as $indice => $ma_categorie)
			{
				//debug($categorie);
				echo '<a href="?categorie='.$ma_categorie.'" class="list-group-item">'.$ma_categorie.'</a>';				
			}
		}
			
		?>

	  </div>
	</div><!--/.sidebar-offcanvas-->


	<div class="col-xs-12 col-sm-9">
	  <p class="pull-right visible-xs">
		<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
	  </p>
	  <div class="jumbotron">
		<h1>Bienvenue sur mon site</h1>
		<p>Ce site est fabuleux! venez voir!!!!</p>
	  </div>
	  
	  <?php if(isset($_GET["categorie"])): //ici, les ':' signifie 'echo'
	  $donnees= $pdo->prepare("SELECT * FROM produit WHERE categorie= :categorie");
	  $donnees->bindValue(':categorie',$_GET["categorie"],PDO::PARAM_STR);
	  $donnees->execute();
	  
		while($produit=$donnees->fetch(PDO::FETCH_ASSOC)):	//Ne pas oublier les ':' à la fin de la ligne lorsqu'on utilise cette methode
		

	  
	  
	  ?> 
	  <!--<div class="row">-->
		<div class="col-xs-6 col-lg-4">
		  <div class="panel-default border">	<!--on a créé cette div, on a attribué la class panel-default de bootstrap et on a créé et attribué une class css qu'on a appelé 'border' -->
		  <div class="panel-heading text-center"><h2><?= $produit['titre']?></h2></div>
		  <p><a href="fiche_produit.php?id_produit=<?= $produit['id_produit']?>"> <img class="img-responsive" alt="" src="<?= $produit['photo']?>"></a></p>			  
		  <p class="text-center"> <?= $produit['prix']?> €</p>		  
		  <p class="text-center"><a class="btn btn-primary" role="button" href="fiche_produit.php?id_produit=<?= $produit['id_produit']?>">Voir le détail &raquo; </a></p>	<!-- role a juste pour interet de dire que le role a c'est un bouton-->	  


		  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
		  </div>
		</div><!--/.col-xs-6.col-lg-4-->
	  <!--</div><!--/row-->

	<?php 
		//debug($produit);
		endwhile;
	endif; 
	?>

	</div><!--/.col-xs-12.col-sm-9-->
</div><!--/row-->

<?php
require_once("inc/footer.inc.php");

?>