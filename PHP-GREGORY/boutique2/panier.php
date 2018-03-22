<?php 
require_once("inc/init.inc.php");

//--- AJOUT PANIER ----//
if(isset($_POST['ajout_panier']))
{
	$resultat = $pdo->query("SELECT * FROM produit WHERE id_produit ='$_POST[id_produit]'");
	$produit = $resultat->fetch(PDO::FETCH_ASSOC);
	//debug($produit);
	ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);
}

//--- SUPPRESSION PRODUIT ---//
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	retirerProduitDuPanier($_GET['id_produit']);
	//header("location:panier.php");	
}

//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == 'vider')
{
	unset($_SESSION['panier']);
}

//--- PAIEMENT ---//
if(isset($_POST['payer']))
{
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
	{
		$resultat = $pdo->query("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
		$produit = $resultat->fetch(PDO::FETCH_ASSOC);
		if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
		{
			$content .= '<hr><div class="alert alert-danger">Stock restant : ' . $produit['stock'] . '</div>';
			$content .= '<hr><div class="alert alert-danger">Quantité demandé : ' .$_SESSION['panier']['quantite'][$i] . '</div>';
			if($produit['stock'] > 0)
			{
				$content .= '<div class="alert alert-danger">la quantite de ce produit ' . $_SESSION['panier']['id_produit'][$i] . ' a été réduite car notre stock était insuffisant, veuillez vérifier vaos achats </div>';
				$_SESSION['panier']['quantite'][$i] = $produit['stock'];
			}
			else
			{
				$content .= '<div class="alert alert-danger">Le produit ' . $_SESSION['panier']['id_produit'][$i] . ' a été retire de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats</div>';
				retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
				$i--;
			}
			$erreur = true;
		}
	}
	if(!isset($erreur))
	{
		$pdo->query("INSERT INTO commande(id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
		$id_commande = $pdo->lastInsertId();
		for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
		{
			$pdo->query("INSERT INTO details_commande(id_commande,id_produit,quantite,prix)VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," .  $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
			$pdo->query("UPDATE produit SET stock = stock - " . $_SESSION['panier']['quantite'][$i] . " WHERE id_produit = " . $_SESSION['panier']['id_produit'][$i]);
		}
		unset($_SESSION['panier']);
		$content .= "<div class='col-md-8 col-md-offset-2 alert alert-success text-center'>Merci pour votre commande. Votre n° de suivi est le $id_commande</div>";
	}
}



require_once("inc/haut.inc.php");
echo $content;
//debug($_SESSION['panier']);
echo "<div class='col-md-8 col-md-offset-2'>";
echo "<div class='alert alert-info text-center'><h2>Panier</h2></div>";
echo "<table class='table'>";
//echo "<tr><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Quantité</th><th>Prix Unitaire</th><th>Total</th><th>Action</th></tr>";
if(empty($_SESSION['panier']['id_produit']))
{
	echo "<tr><td colspan='5'><div class='alert alert-danger text-center'>Votre panier est vide</div></td></tr>";	
}
else
{
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
	{
		
		echo '<tr>';
		echo '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';
		//echo '<td>' . $_SESSION['panier']['id_produit'][$i] . '</td>';
		echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
		echo '<td>' . $_SESSION['panier']['prix'][$i] . ' €</td>';
		echo '<td>' . $_SESSION['panier']['prix'][$i]*$_SESSION['panier']['quantite'][$i] . ' €</td>';
		echo '<td><a href="?action=suppression&id_produit=' . $_SESSION['panier']['id_produit'][$i] . '" OnClick="return(confirm(\'En êtes vous certain ?\'));"><span class="glyphicon glyphicon-trash"></span></a></td>';
		echo '</tr>';
	}
	
	//debug($_SESSION['panier']);
	
	echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . " €</td></tr>";
	if(internauteEstConnecte())
	{
		echo '<form method="post" action="">';
		echo '<tr><td colspan="5"><input type="submit" name="payer" class="col-md-12 btn btn-primary" value="Valider et déclarer le paiement"></td></tr>';
		echo '</form>';
	}
	else
	{
		echo '<tr><td colspan="5"><div class="col-md-12 alert alert-warning text-center">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php"> connecter </a>afin de pouvoir payer</div></td></tr>';
	}
	echo '<tr><td colspan="5"><a href="?action=vider" OnClick="return(confirm(\'En êtes vous certain ?\'));"><span class="glyphicon glyphicon-trash"></span>  Vider mon panier</a></td></tr>';
}
echo "</table>";
echo "</div>";

require_once("inc/bas.inc.php");








