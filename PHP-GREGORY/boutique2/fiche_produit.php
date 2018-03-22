<?php
require_once("inc/init.inc.php");
/*
Réaliser un page fiche_produit avec les informations : titre, catégorie, couleur, taille, photo, description, prix
Prévoir un selecteur pour choisir la quantité de produit(5 max) 
Prévoir un message d'erreur en cas de rupture de stock 
*/
//debug($_POST);
if(!empty($_POST))
{
	$resultat = $pdo->prepare("INSERT INTO commentaire (id_produit, pseudo, message, date_enregistrement)VALUES(:id_produit, :pseudo, :message, NOW())");
	$resultat->bindValue(':id_produit', $_POST['id_produit'], PDO::PARAM_INT);
	$resultat->bindValue(':pseudo', $_SESSION['membre']['pseudo'], PDO::PARAM_STR);
	$resultat->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
	$resultat->execute();
}

if(isset($_GET['id_produit']))
{	
	$resultat =  $pdo->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
	
	if($resultat->rowCount() <= 0)
	{
		header("location:boutique.php");
		exit();
	}
	
	$produit = $resultat->fetch(PDO::FETCH_ASSOC);

	$content .= '<div class="col-md-8 col-md-offset-2">
					<div class="panel-default border">
						<div class="panel-heading text-center"><h2>' . $produit['titre'] . '</h2></div>
							<div class="panel-body">
							<img src="' . $produit['photo'] . '" width="300" height="230" class="col-md-4 img-responsive">
							<p class="text-center">Catégorie : ' . $produit['categorie'] . '</p>
							<p class="text-center">Couleur : ' . $produit['couleur'] . '</p>
							<p class="text-center">Taille : ' . $produit['taille'] . '</p>
							<p class="text-center">Description : ' . $produit['description'] . '</p>
							<p class="text-center">Prix : ' . $produit['prix'] . '</p>
							<p class="text-center">stock : ' . $produit['stock'] . '</p>
							
							</div>
						</div><br>';
						
if($produit['stock'] > 0)
{
	$content .= "<i>Nombre de produit(s) disponible : $produit[stock]</i><br><br>";
	$content .= '<form method="post" action="panier.php">';
	$content .= "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";
	$content .= '<label for="quantite">Quantité : </label>';
	$content .= '<select id="quantite" name="quantite" class="form-control">';
		for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++)
		{
			$content .= "<option>$i</option>";
		}
	$content .= '</select><br>';
	$content .= '<input type="submit" name="ajout_panier" value="ajout au panier" class="col-md-12 btn btn-primary">';	
	$content .= '</form><br><br>';
}
else
{
	$content .= '<div class="alert alert-danger text-center">Rupture de stock !! </div>';
}

$content .= '<br><a href="boutique.php?categorie=' . $produit['categorie'] . '"><span class="glyphicon glyphicon-arrow-left"></span>  Retour vers la sélection de ' . $produit['categorie'] . '</a><hr>';

$content .= '<h4 class="text-center alert alert-warning col-md-8 col-md-offset-2">Deposer un commentaire</h4>';	

if(!internauteEstConnecte())
{
	$content .='<div class="col-md-4 col-md-offset-4 alert alert-warning text-center"><a href="connexion.php">Identifiez vous  </a> pour poster un commentaire</div>';
}
else
{
	$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS 'datefr', DATE_FORMAT(date_enregistrement, '%h:%i:%s') AS 'heurefr'  FROM commentaire WHERE id_produit = '$_GET[id_produit]' ORDER BY date_enregistrement DESC");
	if($resultat->rowCount() == 0)
	{
		$content .= '<div class="col-md-8 col-md-offset-2 text-center"><p>Soyez le premier à poster un avis!</p></div>';	
		
		$content .= '<form method="post" action="" class="col-md-8 col-md-offset-2">';
		$content .= '<input type="hidden" name="id_produit" value="' . $produit['id_produit'] . '">';
		
		$content .= '<label for="message">Message</label>
					<textarea class="form-control" rows="3" id="message" name="message"></textarea><br>';
					
		$content .= '<input type="submit" class="btn btn-primary" value="Poster"><br><br><br>';			
		$content .= '</form>';
						
		$content .= '</div>';
	}	
	else
	{
		
	
		$content .= '<form method="post" action="" class="col-md-8 col-md-offset-2">';
		$content .= '<input type="hidden" name="id_produit" value="' . $produit['id_produit'] . '">';
		
		$content .= '<label for="message">Message</label>
					<textarea class="form-control" rows="3" id="message" name="message"></textarea><br>';
					
		$content .= '<input type="submit" class="btn btn-primary" value="Poster"><br><br><br>';			
		$content .= '</form>';
						
		$content .= '</div>';
		
		$content .= '<div><h4 class="text-center col-md-8 col-md-offset-2 alert alert-info">Derniers Avis</h4><hr>';

		while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC))
		//debug($commentaire);
		{
			$content .= '<div class="col-md-8 col-md-offset-2">';
			$content .= '<p>Posté par : ' . $commentaire['pseudo'] . ', le ' . $commentaire['datefr'] . ' à ' . $commentaire['heurefr'] . '</p>';
			$content .= '<p>' . $commentaire['message'] . '</p>';
			$content .= '<hr></div>';
		}
	}
}

$content .='</div>';
$content .= '</div>';	

}


require_once("inc/haut.inc.php");
echo $content;
require_once("inc/bas.inc.php");