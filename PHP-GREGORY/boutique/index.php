<?php 
require_once("inc/init.inc.php");
require_once("inc/header.inc.php");
?>

<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
    <div class="list-group">
	<p class="list-group-item active text-center">CATEGORIES</p>
    <?php  
	// Exercice : faites en sorte d'afficher les ctégories distinctes de la table produit à l'aide d'une boucle
	$resultat = $pdo->query("SELECT DISTINCT categorie FROM produit");
	while($categorie = $resultat->fetch(PDO::FETCH_ASSOC))
	{	
		//debug($categorie);
		echo '<a href="?categorie=' . $categorie['categorie']  . '" class="list-group-item">' . $categorie['categorie'] . '</a>';
	}
    ?>  
    </div>
  </div>
  <!--/.sidebar-offcanvas-->
  <div class="col-xs-12 col-sm-9">
    <p class="pull-right visible-xs">
      <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
    </p>
    <div class="jumbotron">
      <h1>Bienvenue sur notre boutique de OUF!!!!</h1>
      <p>Que du lourd!!! viendez voir!!!</p>
    </div>
	
<?php 
if(isset($_GET['categorie'])): 
	$donnees = $pdo->prepare("SELECT * FROM produit WHERE categorie = :categorie");
	$donnees->bindValue(':categorie', $_GET['categorie'], PDO::PARAM_STR);
	$donnees->execute();
	
	while($produit = $donnees->fetch(PDO::FETCH_ASSOC)):	
	
?>
	<!-- afficher pour chaque produit : la photo, le prix et un lien permettant d'envoyer vers la fichie produit -->
    <!--<div class="row"> -->
      <div class="col-xs-6 col-lg-4">
	  <div class="panel-default border">
        <div class="panel-heading text-center"><h2><?= $produit['titre'] ?></h2></div>
        <p><a href="fiche_produit.php?id_produit=<?= $produit['id_produit'] ?>"><img src="<?= $produit['photo'] ?>" alt="" class="img-responsive"></a></p>
        <p class="text-center"><?= $produit['prix'] ?> €</p>
        <p class="text-center"><a class="btn btn-primary" href="fiche_produit.php?id_produit=<?= $produit['id_produit'] ?>" role="button">Voir le détails &raquo;</a></p>
	  </div> 	
      </div>
      <!--/.col-xs-6.col-lg-4-->
    <!-- </div> -->
    <!--/row-->
	
<?php 
	//debug($produit);
	endwhile;
endif; 
?>
	
  </div>
  <!--/.col-xs-12.col-sm-9-->
</div>
<!--/row-->



<?php
require_once("inc/footer.inc.php");