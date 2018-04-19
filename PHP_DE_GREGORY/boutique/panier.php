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
if(isset($_GET['action']) && $_GET['action'] == 'suppression') // on ne rentre que seulement dans le cas ou l'on clique sur le lien suppression d'un produit
{
	retirerProduitDuPanier($_GET['id_produit']); // on execute la fonction permettant de d'effacer un produit dans le fichier session, on lui envoi en argument l'id du produit récupéré dans l'URL
		
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
if(isset($_POST['payer'])) // si on a cliqué sur le bouton 'valider le paiement' alors on entre la condition
{
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) // tant qu'il y a d'id_produit dans la session, la boucle for tourne
	{
		$resultat = $pdo->query("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]); // on selectionne en BDD les informations des produits ajoutés au panier
		$produit = $resultat->fetch(PDO::FETCH_ASSOC); // on associe la méthode fetch() pour exploiter le résultat sous forme de tableau
		// $produit est un tableau ARRAY qui contient les informations d'un produit du panier pour chaque tour de boucle for 		
		//debug($produit);
		$erreur = '';
		if($produit['stock'] < $_SESSION['panier']['quantite'][$i]) // si le stock de la BDD est inférieur a la quantité ajouté au panier, alors on rentre dans la condition if
		{
			$erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Stock restant du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> : ' . $produit['stock'] . '</div>'; // affichage du stock restant en BDD
			
			$erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Quantité demandée du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> : ' . $_SESSION['panier']['quantite'][$i] . '</div>'; // afffichage de la quantité demandée
			
			if($produit['stock'] > 0) // si le stock de la BDD est supérieur à 0, cela veut dire qu'il reste des produits en BDD mais pas suffisant pour la quantité demandé
			{
				$erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">La quantité du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> a été réduite car notre stock est insuffisant, veuillez vérifier vos achats!</div>';
				$_SESSION['panier']['quantite'][$i] = $produit['stock']; // on affecte la quantité du produit en BDD directement dans la session à l'indice du produit, donc on actaulise le panier.
			}
			else // dans les tout les autre cas, le stock est à 0, on supprime le produit de la session et actualise le panier
			{
				$erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Le produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> a été supprimé car nous sommes en rupture de stock, veuillez vérifier vos achats!</div>';
				
				retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]); // on supprime le produit de la session
				$i--;// on fait un tour de boucle à l'envers, on décremente, parce que la fonction array_splice() supprime le produit mais réorganise la session, elle remonte les indice inférieur vers les indices supérieur, cela nous permet de ne pas oublier de contrôler un produit qui aurait changé d'indice
			}
			$content .= $erreur; //on stock toute les potentielles erreurs
		}		
	}
	
	if(empty($erreur)) // si la variable $erreur est vide, c'est que nous ne sommes pas enrté dans la condition if, donc les stocks sont OK, on peut valider la commande
	{
		$resultat = $pdo->exec("INSERT INTO commande(id_membre, montant, date_enregistrement)VALUES(" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())"); // on insert les données dans la table commande
		$id_commande = $pdo->lastInsertId(); // on récupère le dernier id généré dans la table commande, nous en avons besoin pour l'insertion du détail de la commande 
		//echo $id_commande;
		for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) // la boucle for tourne tant qu'il y a de produit dans la session 'panier'
		{
			$resultat = $pdo->exec("INSERT INTO details_commande(id_commande,id_produit,quantite,prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . ", " . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")"); // pour chaque tour de boucle, on insère le dètail de la commande pour chaque produit 

			$resultat = $pdo->exec("UPDATE produit SET stock = stock - " . $_SESSION['panier']['quantite'][$i] . " WHERE id_produit = " . $_SESSION['panier']['id_produit'][$i]); // dépreciation des stock, on modifie la quantité dans la BDD	
		}
		unset($_SESSION['panier']); // on vide le panier
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
				
				if(isset($_GET['action']) && $_GET['action'] == 'retirer')
				{
					if($_SESSION['panier']['quantite'][$i] > 0)
					{
						$_SESSION['panier']['quantite'][$i] = $_SESSION['panier']['quantite'][$i] - 1;
						header("location:panier.php");
					}
				}
				if(isset($_GET['action']) && $_GET['action'] == 'ajouter')
				{
					$_SESSION['panier']['quantite'][$i] = $_SESSION['panier']['quantite'][$i] + 1;
					header("location:panier.php");
				}
					
				echo '<td><a href="?action=retirer"><span class="glyphicon glyphicon-chevron-left"></span></a>' . $_SESSION['panier']['quantite'][$i] . '<a href="?action=ajouter"><span class="glyphicon glyphicon-chevron-right"></span></a></td>';
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











