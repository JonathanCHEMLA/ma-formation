<?php
require_once("inc/init.inc.php");

$categories_des_produits = $pdo->query("SELECT DISTINCT categorie FROM produit");
$content .='<div class="row row-offcanvas row-offcanvas-right">

		<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <p class="list-group-item active text-center">CATEGORIES</p>';
			while($cat = $categories_des_produits->fetch(PDO::FETCH_ASSOC))
			{
            $content .='<a href="?categorie=' . $cat['categorie'] . '" class="list-group-item text-center">' . $cat['categorie'] . '</a>';
			}
          $content .='</div>
        </div><!--/.sidebar-offcanvas-->

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>Bienvenue dans ma boutique de OUF!!!!!</h1>
            <p>Que du LOURD!!!</p>
          </div>';

if(isset($_GET['categorie']))
{	 
		$donnees = $pdo->query("SELECT * FROM produit WHERE categorie = '$_GET[categorie]'");
		
		while($produit = $donnees->fetch(PDO::FETCH_ASSOC))
		{
		   // <div class="row">
            $content.='<div class="col-md-4 col-lg-4">
			<div class="panel-default border">
              <div class="panel-heading text-center"><h2>'. $produit['titre'] . '</h2></div>';
              $content .='<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '"><img class="img-responsive" src="' . $produit['photo'] . '"></a><hr>';
			  $content .='<p class="text-center">' . $produit['prix'] . ' €</p>';
              $content .='<p class="text-center"><a class="btn btn-primary" href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '" role="button">Voir le détail</a></p>
			</div><br> 
            </div><!--/.col-xs-6.col-lg-4-->';
            
          //</div><!--/row-->
        
		}
}
else
{
		$donnees = $pdo->query("SELECT * FROM produit");
		
		while($produit = $donnees->fetch(PDO::FETCH_ASSOC))
		{
		   // <div class="row">
            $content.='<div class="col-md-4 col-lg-4">
			<div class="panel-default border">
              <div class="panel-heading text-center"><h2>'. $produit['titre'] . '</h2></div>';
              $content .='<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '"><img class="img-responsive" src="' . $produit['photo'] . '"></a><hr>';
			  $content .='<p class="text-center">' . $produit['prix'] . ' €</p>';
              $content .='<p class="text-center"><a class="btn btn-primary" href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '" role="button">Voir le détail</a></p>
			</div><br> 
            </div><!--/.col-xs-6.col-lg-4-->';
            
          //</div><!--/row-->
        
		}
}	

$content.= '</div><!--/.col-xs-12.col-sm-9-->';
$content.= '</div><!--/row-->';  
require_once("inc/haut.inc.php");
echo $content;
require_once("inc/bas.inc.php");