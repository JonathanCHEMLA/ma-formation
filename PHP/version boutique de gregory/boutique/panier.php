<?php
require_once("inc/init.inc.php");

//---- AJOUT PANIER -----//
if(isset($_POST['ajout_panier']))
{
	//debug($_POST);
	$resultat = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_POST[id_produit]'");
	$produit = $resultat->fetch(PDO::FETCH_ASSOC);
	//debug($produit);
	ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'], $_POST['quantite'], $produit['prix']);
	//debug($_SESSION);
}

require_once("inc/header.inc.php");
?>

<div class="col-md-8 col-md-offset-2">
	<table class="table">
		<tr><th colspan="5" class="text-center"><div class="alert alert-success">PANIER<div></th></tr>
		<tr><th>Titre</th><th>quantité</th><th>prix unitaire</th><th>prix total</th><th>supprimer</th></tr>
		<?php
		if(empty($_SESSION['panier']['id_produit'])) // si dans la session 'panier' il n y a pas d'id_produit, c'est que l'internaute n'a pas ajouté de produit dans le panier
		{
			echo '<tr><td colspan="5"><div class="alert alert-danger text-center">Votre panier est vide !</div></td></tr>';
		}
		else
		{
			for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
			{
				echo '<tr>';
				echo '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';
				echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
				echo '<td>' . $_SESSION['panier']['prix'][$i] . ' €</td>';
				echo '<td>' . $_SESSION['panier']['prix'][$i]*$_SESSION['panier']['quantite'][$i] . ' €</td>';
				echo '<td><a href="?action=suppression&id_produit=' . $_SESSION['panier']['id_produit'][$i] . '" onClick="return(confirm(\'En êtes vous certain ?\'));"><span class="glyphicon glyphicon-trash"></span></a></td>';
				echo '</tr>';
			}
			echo '<tr><th colspan="3">Total</th><th colspan="2">' . montantTotal() . ' €</th></tr>';
			if(internauteEstConnecte())
			{
				echo '<form method="post" action="">';
				echo '<tr><td colspan="5"><input type="submit" name="payer" class="col-md-12 btn btn-primary" value="valider le paiement"></td></tr>';
				echo '</form>';
			}
			else
			{
				echo '<tr><td colspan="5"><div class="alert alert-warning text-center">Veuillez vous <a href="inscription.php" class="alert-link">inscrire</a> ou vous <a href="connexion.php" class="alert-link">connecter</a> pour valider le paiement</div></td></tr>';
			}
			echo '<tr><td colspan="5"><a href="?action=vider" onClick="return(confirm(\'En êtes vous certain ?\'));"><span class="glyphicon glyphicon-trash"></span>  Vider mon panier</a></td></tr>';
		}
		?>
	</table>
</div>

<?php
require_once("inc/footer.inc.php");











