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

//----SUPPRESSION PRODUIT
if(isset($_GET["action"]) && $_GET["action"]=="suppression")	// si on clique sur le lien "suppression" d'un produit.
{
	retirerProduitDuPanier($_GET['id_produit']);	//on execute la fct permettant d'effacer un pdt dans le fichier session. On lui envoie en argument l'id du produit récupéré dans l'URL
	
	$resultat=$pdo->prepare('SELECT * FROM produit WHERE id_produit= :id_produit');
	//cette requete n'est tapee ici que dans le but de pouvoir exploiter le titre associé à l'id_produit recu dans l'URL
	$resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
	$resultat->execute();
	$produit_supp = $resultat->fetch(PDO::FETCH_ASSOC);
	
	$content.= '<hr><div class="alert alert-success col-md-8 col-md-offset-2 text-center"> le produit <strong>'. $produit_supp['titre'] . '</strong>  a bien été supprimé du panier! </div>';
}


//----VIDER PANIER	
if(isset($_GET['action']) && $_GET['action']=='vider')	//si on clique sur le lien 'vider':
{
	unset($_SESSION['panier']);	//on supprime seulement le tableau 'panier' de la session; pas le tableau 'membre'. Du coup, je reste connecté
}



//--- PAIEMENT ---------/
if(isset($_POST['payer']))	// il a donc cliqué pour valider le paiment, en cliquant sur le bouton bleu 'valider le paiement'
{
	for($i=0; $i < count($_SESSION['panier']['id_produit']); $i++)	//il parcoure l'ensemble des produits qu'on a mis dans le panier
	{
		$resultat=$pdo->query("SELECT * FROM produit WHERE id_produit=". $_SESSION['panier']['id_produit'][$i]);// on selectionne les infos des produits ajoutés au panier
		$produit=$resultat->fetch(PDO::FETCH_ASSOC);//on associe la methode fetch() pour exploiter le resultat sous forme de tableau
		// $produit est un tableau ARRAY quiu contient les informations d'un produit du panier pour chaque tour de boucle For
		//debug($produit);
		$erreur="";
		if($produit['stock'] < $_SESSION['panier']['quantite'][$i])	// si le stock de la BDD est inf. à la quantité ajoutée au panier, alors on rentre dans la condition IF
		{
			$erreur.= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Stock restant du produit: <strong>'.$_SESSION['panier']['titre'][$i] .' </strong> : ' .$produit['stock'].'</div>';//affichage du stock restant en BDD
			$erreur.= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Quantité demandée du produit: <strong>'.$_SESSION['panier']['titre'][$i] .' </strong>: ' .$_SESSION['panier']['quantite'][$i].'</div>';// Affichage de la quantité demandée
			
			if($produit['stock'] > 0)
			{
				$erreur.= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Quantité demandée du produit: <strong>'.$_SESSION['panier']['titre'][$i] .' </strong>: a été réduite car notre stock est insuffisant. Veuillez vérifier vos achats !</div>';
				$_SESSION["panier"]["quantite"][$i]=$produit['stock'];// si le stock de la BDD est sup.  à 0 ,cela veut dire qu'il reste des pdts en BDD mais pas assez pour la quantité demandée	//on affecte la quantité du pdt en BDD directement dans la session à l'indice du pdt, donc on actualise le panier. 
			}
			else// dans tous les autres cas, le stock est à 0. On supprime le pdt de la session et on actualise le panier
			{
				//on n'utilisera pas ici     unset($_SESSION["panier"]["quantite"][$i]);    	car on souhaite, non seulement supprimer la ligne, mais en plus, ne pas avoir d'espace vide dans notre session.
								
				$erreur.= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Le produit <strong>'.$_SESSION['panier']['titre'][$i] .' </strong>: a été supprimé car nous sommes en rupture de stock. Vérifiez vos achats !</div>';
				retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
				$i--;	//A quoi sert i-- ? supposons que l'indice à suppr est le 4. le array_splice, de la fonction retirerProduitDuPanier (voir fonction.php), fait remonter l'indice suivant (indice 5) d' un indice (5->4). Si je ne met pas i--, le produit 5 qui a à présent l'indice 4 ne sera pas rajouté à sa validation de commande.
				//On fait un tour de boucle à l'envers, on décrémente, parceque la fonction array_splice() supprime le pdt mais réorganise la session, elle remonte les indices inf. vers les indices superieurs. Cela nous permet de ne pas oublier de controler un pdt qui aurait changé d'indice.
				
			}
			$content.=$erreur;	//Stocke toutes les potentielles erreurs. Dans le cas ou la quantité est egale à 0 ou si elle est inferieure à la quantité demandée. bref, erreur est defini si on passe dans le if ou dans le else.
		}
	}
	if(empty($erreur))// si la variable $erreur est vide, c'est que nous ne sommes pas entres dans la condition IF, donc les stocks sont OK, on peut valider la commande.
	{
		$resultat=$pdo->exec("INSERT INTO commande(id_membre, montant,date_enregistrement) VALUES (" . $_SESSION["membre"]["id_membre"] . "," . montantTotal() . ",NOW())");
		// on insert les données dans la table "commande"
		//je vais déclarer une variable: $id_commande
		$id_commande = $pdo->lastInsertId();	//il va stocker le dernier id qui a été inséré dans la table commande. on va l'utiliser dans la table "detail commande".
		//on récupére le dernier ID généré dans la table commande, nous en avons besoin pour l'insertion du détail de la commande
		
		//echo $id_commande;	//on constate, avec cette ligne, qu'on insere bien le dernier id_commande
		for($i=0;$i<count($_SESSION["panier"]["id_produit"]);$i++)	// la boucle For tourne tant qu'il y a des produits dans la session 'panier'
		{
			$resultat=$pdo->exec("INSERT INTO details_commande(id_commande, id_produit, quantite, prix) VALUES ( $id_commande, ". $_SESSION["panier"]["id_produit"][$i].",". $_SESSION["panier"]["quantite"][$i].",". $_SESSION["panier"]["prix"][$i].")");
			//pour chaque tour de boucle, on insère le détail de la commande pour chaque produit
			
			$resultat=$pdo->exec("UPDATE produit SET stock=stock- ".$_SESSION["panier"]["quantite"][$i]." WHERE id_produit= " .$_SESSION["panier"]["id_produit"][$i]);//depreciation du stock. On modifie la quantité dans la BDD
		}
	unset($_SESSION["panier"]);	// A present que sa commande a été enregistrée, on vide le panier
	$content.= '<hr><div class="alert alert-success col-md-8 col-md-offset-2 text-center"> Votre commande a bien été validée. Votre n° de suivi est le <strong>'.$id_commande .' </strong></div>';
	}
}	
	
require_once("inc/header.inc.php");
echo $content;
?>

<div class="col-md-8 col-md-offset-2">
	<table class="table"><!--cellpadding c'est pour avoir du padding AUTOUR DE MON TEXTE, dans chaque cellule de mon tableau   -->
		<tr class="text-center"><td colspan="5" class="text-center"><div class="alert alert-success text-center"><strong>PANIER</strong></div></td></tr><!--cellspacing c'est pour avoir du margin AUTOUR DES CELLULES de mon texte   colspan permet de fusionner les cellules horizontalement; rowspan:verticalement -->
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