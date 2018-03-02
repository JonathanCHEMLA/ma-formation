<?php
require_once("inc/init.inc.php");

//----AJOUTER PANIER
if(isset($_POST['ajout_panier'])) // si on a validé le formulaire de la page 'fiche_produit', et qu'on lui a alors enregistré dans $_POST: id_produit et quantité, alors: 
{
	//debug($_POST['ajout_panier']);
	$resultat=$pdo->query("SELECT * FROM produit WHERE id_produit= '$_POST[id_produit]'");
	$produit=$resultat->fetch(PDO::FETCH_ASSOC);
	//debug($produit);
	ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'], $_POST['quantite'],$produit['prix']);
	
}
//debug($_SESSION);
	
require_once("inc/header.inc.php");
?>

<div class="col-md-8 col-md-offset-2">
	<table class="table"><!--cellpadding c'est pour avoir du padding AUTOUR DE MON TEXTE, dans chaque cellule de mon tableau   -->
		<tr class="text-center"><td colspan="5" class="text-center"><div class="alert alert-success text-center">PANIER</div></td></tr><!--cellspacing c'est pour avoir du margin AUTOUR DES CELLULES de mon texte   colspan permet de fusionner les cellules horizontalement; rowspan:verticalement -->
		<tr class="text-center"><th>Titre</th><th>Quantité</th><th>Prix_unitaire</th><th>Prix_total</th><th>Supprimer</th></tr>
		
		<?php 
		if(empty($_SESSION['panier']['id_produit']))	//si mon panier est vide, c'est à dire: si, dans ma session 'panier', il n'y a pas de  id_produit, c'est que l'internaute n'a pas ajouté de produit dans le panier 
		{
			echo '<tr><td colspan="5"><div class="alert alert-danger text-center">Votre panier est vide !</div></td></tr>';
		}
		else
		{
			for($i=0; $i < count($_SESSION['panier']['id_produit']); $i++)
			{
				echo '<tr>';
				echo '<td>'.$_SESSION['panier']['titre'][$i].'</td>';
				echo '<td>'.$_SESSION['panier']['quantite'][$i].'</td>';
				echo '<td>'.$_SESSION['panier']['prix'][$i].' €</td>';				
				echo '<td>'.$_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i].' €</td>';
				echo '<td><a href="?action=suppression&id_produit=' .$_SESSION['panier']['id_produit'][$i]. '" onclick="return(confirm(\'En etes vous sûr ?\'));"><span class="glyphicon glyphicon-trash"></span></a></td>';	
				echo '</tr>';				// 'confirm' est l'equivalent du echo.    "\", du debut et de la fin du confirm, permet d'afficher mon message d'alerte entre '':  'En etes vous sur?'
			}
			echo '<tr><th colspan="3">Total</th><td colspan="2">' . montantTotal() . ' €</td></tr>';
			if(internauteEstConnecte())	//
			{
				echo '<form method="post" action="">';
				echo '<tr><td colspan="5"><input type="submit" name="payer" class="col-md-12 btn btn-primary" value="Valider le paiement"></td></tr>';
				echo '</form>';	// class="col-md-12" permet de prendre toute la largeur de son conteneur, a savoir toute la largeur du col-md-8 du dessus.
			}
			else
			{
				echo '<tr><td colspan="5"><div class="alert alert-warning text-center">Veuillez vous <a href="inscription.php" class="alert-link">inscrire</a> ou vous <a href="connexion.php" class="alert-link">connecter</a> pour valider le paiement.</div></td></tr>';
			}
			echo '<tr><td colspan="5"><a href="?action=vider" onclick="return(confirm(\'En etes vous sûr ?\'));"><span class="glyphicon glyphicon-trash"></span> Vider mon panier</a></td></tr>';	
			
		}// il y aura autant de i, c'est à dire d'indice, qu'il y aura "d'ajout distinct" dans le panier. (ok) // i contient le nombre d'articles que le client veut acheter. (ok)
		
		?>
	</table>
</div>

<?php
/*************************************************************************************************************************************************/

//on réduit de la quantité en stock la quantité choisie par l'utilisateur

//$nouvelle_quantite=
	//$resultat=$pdo->prepare("UPDATE produit SET qunatité= WHERE id_produit=:id_produit");
?>










<?
require_once("inc/footer.inc.php");	
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

<?php
require_once("inc/footer.inc.php");

?>