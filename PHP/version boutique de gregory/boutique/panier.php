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
}

//debug($_SESSION);
//----- SUPPRESSION PRODUIT -----//
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	retirerProduitDuPanier($_GET['id_produit']);
		
	$resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
	$resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
	$resultat->execute();	
	$produit_supp = $resultat->fetch(PDO::FETCH_ASSOC);
	
	$content .= '<hr><div class="alert alert-success col-md-8 col-md-offset-2 text-center">Le Produit <strong>' . $produit_supp['titre'] . '</strong> a bien été supprimé du panier!</div>';
}

//---- VIDER PANIER -----//
// Réaliser le script permettant de vider le panier
if(isset($_GET['action']) && $_GET['action'] == 'vider')  // si on a cliqué sur le lien 'vider', on rentre dans la condition 
{
	unset($_SESSION['panier']); // on supprime seulement le tableau 'panier' de la session
}

//---- PAIEMENT ---------//
if(isset($_POST['payer']))
{
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
	{
		$resultat = $pdo->query("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
		$produit = $resultat->fetch(PDO::FETCH_ASSOC);		
		//debug($produit);
		$erreur = '';
		if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
		{
			$erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Stock restant du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> : ' . $produit['stock'] . '</div>';
			
			$erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Quantité demandée du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> : ' . $_SESSION['panier']['quantite'][$i] . '</div>';
			
			if($produit['stock'] > 0)
			{
				$erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">La quantité du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> a été réduite car notre stock est insuffisant, veuillez vérifier vos achats!</div>';
				$_SESSION['panier']['quantite'][$i] = $produit['stock'];
			}
			else
			{
				$erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Le produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> a été supprimé car nous sommes en rupture de stock, veuillez vérifier vos achats!</div>';
				
				retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
				$i--;
			}
			$content .= $erreur;
		}		
	}
	
	if(empty($erreur))
	{
		$resultat = $pdo->exec("INSERT INTO commande(id_membre, montant, date_enregistrement)VALUES(" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
		$id_commande = $pdo->lastInsertId();
		//echo $id_commande;
		for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
		{
			$resultat = $pdo->exec("INSERT INTO details_commande(id_commande,id_produit,quantite,prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . ", " . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");

			$resultat = $pdo->exec("UPDATE produit SET stock = stock - " . $_SESSION['panier']['quantite'][$i] . " WHERE id_produit = " . $_SESSION['panier']['id_produit'][$i]);	
		}
		unset($_SESSION['panier']);
		$content .= '<hr><div class="alert alert-success col-md-8 col-md-offset-2 text-center">Votre commande a bien été validée. Votre n° de suivi est le <strong>' . $id_commande . '</strong></div>';
	}
	
}

require_once("inc/header.inc.php");
echo $content;
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











