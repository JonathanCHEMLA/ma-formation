<?php
require_once("../inc/init.inc.php");

//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
	header("location:" . URL . "connexion.php");
}

//--- SUPPRESSION PRODUIT ---//
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$pdo->exec("DELETE FROM produit WHERE id_produit='$_GET[id_produit]'");
	$_GET['action'] = 'affichage';
}	


//--- ENREGISTREMENT PRODUIT ---//
if(!empty($_POST))
{
	//debug($_FILES);
	$photo_bdd = '';
	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	{
		$photo_bdd = $_POST['photo_actuelle'];
	}
	
	if(!empty($_FILES['photo']['name']))
	{
		$nom_photo = $_POST['reference'] . '-' . $_FILES['photo']['name'];
		//echo $nom_photo;
		$photo_bdd = URL . "photo/$nom_photo";
		//echo $photo_bdd;
		$photo_dossier = RACINE_SITE . "photo/$nom_photo";
		//echo $photo_dossier;
		copy($_FILES['photo']['tmp_name'],$photo_dossier);
	}
	if(isset($_GET['action']) && $_GET['action'] == 'ajout')
	{	
		$resultat = $pdo->prepare("INSERT INTO produit(reference,titre,categorie,description,couleur,taille,public,photo,prix,stock)VALUES(:reference,:titre,:categorie,:description,:couleur,:taille,:public,:photo,:prix,:stock)");
		
		$content .= '<div class="col-md-8 col-md-offset-2 alert alert-success">Produit enregistré ! </div>';
	}
	else
	{
		$resultat = $pdo->prepare("UPDATE produit SET reference = :reference, titre = :titre, categorie = :categorie, description = :description, couleur = :couleur, taille = :taille, public = :public, photo = :photo, prix = :prix, stock = :stock WHERE id_produit = '$_POST[id_produit]'");
		
		$content .= '<div class="col-md-8 col-md-offset-2 alert alert-success text-center">Produit modifié ! </div>';
		
	}
		$resultat->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
		$resultat->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
		$resultat->bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);
		$resultat->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		$resultat->bindValue(':couleur', $_POST['couleur'], PDO::PARAM_STR);
		$resultat->bindValue(':taille', $_POST['taille'], PDO::PARAM_STR);
		$resultat->bindValue(':public', $_POST['public'], PDO::PARAM_STR);
		$resultat->bindValue(':photo', $photo_bdd , PDO::PARAM_STR);
		$resultat->bindValue(':prix', $_POST['prix'] , PDO::PARAM_STR);
		$resultat->bindValue(':stock', $_POST['stock'] , PDO::PARAM_STR);
		
		$resultat->execute();
}	

//---- LIENS PRODUIT ----//
$content .= '<div class="list-group col-md-6 col-md-offset-3">';
$content .= '<h3 class="list-group-item active text-center">BACK OFFICE</h3>';
$content .= '<a href="?action=affichage" class="list-group-item text-center">Affichage produits</a>';
$content .= '<a href="?action=ajout" class="list-group-item text-center">Ajout produit</a>';
$content .= '<hr></div>';
 
//--- AFFICHAGE PRODUITS ---// 
// Exercice : afficher l'ensemble de la table produit sous forme de tableau HTML, prévoir un lien modification et suppression pour chaque produit

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
	$resultat = $pdo->query("SELECT * FROM produit");
	
	$content .= '<div class="col-md-12 text-center" style="margin-bottom: 10px;"><h3 class="alert alert-info">Affichage produits</h3>';
	
	$content .= 'Nombre de produit(s) dans la boutique : <span class="badge" style="background: #dff0d8; color:#000;font-size: 15px;">' . $resultat->rowCount() . '</span></div>';
	
	$content .= '<br><table class="col-md-10 table text-center" style="margin-bottom: 40px;"><tr>';
	for($i = 0; $i < $resultat->columnCount(); $i++)
	{
		$colonne = $resultat->getColumnMeta($i);
		$content .= '<th class="text-center">' . $colonne['name'] . '</th>';	
	}
	$content .= '<th class="text-center">Modification</th>';
	$content .= '<th class="text-center">Suppression</th>';
	$content .= '</tr>';
	while($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
	{
		$content .= '<tr>';
		foreach($ligne as $indice => $information)
		{
			if($indice == 'photo')
			{
				$content .= '<td><img src="' . $information . '" width="70" height="70"></td>';	
			}
	
			else
			{
				$content .= '<td>' . $information . '</td>'; 
			}	
		}
		$content .= '<td><a href="?action=modification&id_produit= ' . $ligne['id_produit'] . '"><span class="glyphicon glyphicon-wrench"></span></a></td>';
		$content .= '<td><a href="?action=suppression&id_produit= ' . $ligne['id_produit'] . '"   OnClick="return(confirm(\'En êtes vous certain ?\'));"><span class="glyphicon glyphicon-trash"></span></a></td>';
		$content .= '</tr>';
	}
	$content .= '</table><br><br><br><br>';
}

 
require_once("../inc/haut.inc.php");
echo $content; 
//debug($_POST);

if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification'))
{	
	if(isset($_GET['id_produit']))
	{
		$resultat = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
		$produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
		//debug($produit_actuel);
	}
	$id_produit = (isset($produit_actuel['id_produit'])) ? $produit_actuel['id_produit'] : '';
	$reference = (isset($produit_actuel['reference'])) ? $produit_actuel['reference'] : '';
	$categorie = (isset($produit_actuel['categorie'])) ? $produit_actuel['categorie'] : '';
	$description = (isset($produit_actuel['description'])) ? $produit_actuel['description'] : '';
	$couleur = (isset($produit_actuel['couleur'])) ? $produit_actuel['couleur'] : '';
	$taille = (isset($produit_actuel['taille'])) ? $produit_actuel['taille'] : '';
	$public = (isset($produit_actuel['public'])) ? $produit_actuel['public'] : '';
	$prix = (isset($produit_actuel['prix'])) ? $produit_actuel['prix'] : '';
	$stock = (isset($produit_actuel['stock'])) ? $produit_actuel['stock'] : '';
	$titre = (isset($produit_actuel['titre'])) ? $produit_actuel['titre'] : '';
	$photo = (isset($produit_actuel['photo'])) ? $produit_actuel['photo'] : '';
	
	echo '<form method="post" enctype="multipart/form-data" action="" class="col-md-8 col-md-offset-2">
		<h3 class="alert alert-info text-center">';echo ucfirst($_GET['action']) . ' produit</h3>
			<input type="hidden" id="id_produit" name="id_produit" value="' . $id_produit . '">
		
		  <div class="form-group">
			<label for="reference">Référence</label>
			<input type="text" class="form-control" id="pseudo" name="reference" placeholder="reference" value="' . $reference .'">
			
			
		  </div>
		  <div class="form-group">
			<label for="categorie">Catégorie</label>
			<input type="text" class="form-control" id="categorie" name="categorie" placeholder="categorie" value="' . $categorie . '">
		  </div>
		  <div class="form-group">
			<label for="titre">Titre</label>
			<input type="text" class="form-control" id="titre" name="titre" placeholder="titre" value="' . $titre . '">
		  </div>
		  <label for="description">Description</label>
		  <textarea class="form-control" rows="3" id="description" name="description">' . $description . '</textarea><br>
		  <div class="form-group">
			<label for="couleur">Couleur</label>
			<input type="text" class="form-control" id="couleur" name="couleur" placeholder="couleur" value="' . $couleur . '">
		  </div>
		  <div class="form-group">
			<label for="taille">Taille</label>
			<input type="text" class="form-control" id="taille"  name="taille" placeholder="taille" value="' . $taille . '">
		  </div>
		  
		  <label for="public">Public</label>
		  <select class="form-control" name="public">
			  <option value="m"'; if($public == 'm')echo 'selected';  echo'>Homme</option>
			  <option value="f"'; if($public == 'f')echo 'selected';  echo'>Femme</option>
			  <option value="mixte"'; if($public == 'mixte')echo 'selected';  echo'>Mixte</option>
		  </select><br>
		  
		  <div class="form-group">
			<label for="photo">Photo</label>
			<input type="file" id="photo" name="photo" value"' . $photo .
			'"><br>';
			if(!empty($photo))
			{
				echo '<i>Vous pouvez uploader une nouvelle photo si vous souhaitez la changer</i><br>';
				echo '<img src="' . $photo . '" width="90" height="90"><br>';
			}
			echo '<input type="hidden" name="photo_actuelle" value="' . $photo . '"><br>';
		  echo '</div>
		  <div class="form-group"><br>
			<label for="prix">Prix</label>
			<input type="text" class="form-control" id="prix" name="prix" placeholder="prix" value="' . $prix . '">
		  </div>
		  
		  <div class="form-group">
			<label for="stock">Stock</label>
			<input type="text" class="form-control" id="stock" name="stock" placeholder="stock" value="' . $stock . '">
		  </div>
		  
		  
		  <input type="submit" class="col-md-12 btn btn-primary" value="';echo ucfirst($_GET['action']) . ' produit"><br><br><br>
	</form>';
}

require_once("../inc/bas.inc.php");