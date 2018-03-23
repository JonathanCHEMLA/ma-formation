
<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
    <div class="list-group">
	<p class="list-group-item active text-center">CATEGORIES</p>
	
	
	<?php foreach($categories as $cat) : ?>
	
		<a href="" class="list-group-item"><?= $cat['categorie'] ?></a>
		
	<?php endforeach; //mode twouig?> 
	
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
	
	<?php  foreach($produits as $produit) : // chaque element de $produits sera mis dans $produit?>
	<!--{% for produit in produits %}-->
	
	<!-- afficher pour chaque produit : la photo, le prix et un lien permettant d'envoyer vers la fichie produit -->
    <!--<div class="row"> -->
      <div class="col-xs-6 col-lg-4">
	  <div class="panel-default border">
        <div class="panel-heading text-center"><h2><?= $produit->getTitre() ?></h2></div>
        <p><a href="fiche_produit.php?id_produit=<?= $produit->getId_Produit() ?>">
		
		<img src="<?=  'photo/' . $produit->getPhoto() ?>" alt="" class="img-responsive"></a></p>
        <p class="text-center"><?= $produit->getPrix() ?> €</p>
        <p class="text-center"><a class="btn btn-primary" href="" role="button">Voir le détails &raquo;</a></p>
		</div>

      <!--/.col-xs-6.col-lg-4-->
    <!-- </div> -->
    <!--/row-->
	<!--{% endfor %}--> 
	<?php endforeach; ?>
	
  </div>
  <!--/.col-xs-12.col-sm-9-->
</div>
<!--/row-->

