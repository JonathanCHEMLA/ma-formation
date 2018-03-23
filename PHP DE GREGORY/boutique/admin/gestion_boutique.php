<?php
require_once("../inc/init.inc.php");

//----- VERIFICATION ADMIN
if(!internauteEstConnecteEtEstAdmin()) // si l'internaute n'est pas admin, il n 'a rien à faire sur cette page, on le re dirige vers la page connexion
{
	header("location:" . URL . "connexion.php");
}

//---- SUPPRESSION PRODUIT
if(isset($_GET['action']) && $_GET['action'] == 'suppression') // on rentre dans la condition seulement dans le cas ou l'on clique sur lien suppression de l'affichage des produits
{
	$resultat = $pdo->prepare("DELETE FROM produit WHERE id_produit = :id_produit");
	$resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
	$resultat->execute();
	
	$_GET['action'] = 'affichage'; // on affecte une nouvelle valeur à l'indice 'action' afin d'être rédirigé sur l'affichage des produitds aprés la suppression
	
	$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center">Le produit n° <span class="text-success">' . $_GET['id_produit'] . '</span> a bien été supprimé</div>';
	
}

//---- ENREGISTREMENT PRODUIT
if(!empty($_POST))
{
	
		$photo_bdd = '';
		if(isset($_GET['action']) && $_GET['action'] == 'modification')
		{
			$photo_bdd = $_POST['photo_actuelle']; // si on souhiate conserver la même photo en cas de modification, on affecte la valeur du champs photo 'hidden', c'est à dire l'URL de la photo selectionné en BDD
		}
		//debug($_FILES);
		if(!empty($_FILES['photo']['name']))
		{
			$nom_photo = $_POST['reference'] . '-' . $_FILES['photo']['name']; // on concatène la référence saisie dans le formulaire avec le nom de la photo via la superglobale $_FILES
			//echo $nom_photo;
			$photo_bdd = URL . "photo/$nom_photo"; // on définit l'URL de la photo 
			//echo $photo_bdd;
			$photo_dossier = RACINE_SITE . "photo/$nom_photo"; // on définit le chemin physique du dossier photo sur le serveur
			//echo $photo_dossier;
			copy($_FILES['photo']['tmp_name'], $photo_dossier); // on copie la photo directement dans le dossier photo. la fonction copy() reçoit 2 arguments : 1 - le nom temoraire de la photo --- 2 - le chemin du dossier photo
		}
		
		if(isset($_GET['action']) && $_GET['action'] == 'ajout')
		{
			// Exercice : réaliser le script permttant de contrôler la disponibilité de la référence
			$erreur = '';
			$verif_ref = $pdo->prepare("SELECT * FROM produit WHERE reference = :reference");
			$verif_ref->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
			$verif_ref->execute();
			if($verif_ref->rowCount() > 0)
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">La référence existe déja. Merci de saisir une référence valide !!</div>';
			}
			$content .= $erreur;
			
			if(empty($erreur)) // on stock les messages d'erreur dans la variable $erreur, si elle est vide , cela veut dire que nous ne sommes rentré dans la condition if, que notre référence est valide
			{
				$resultat = $pdo->prepare("INSERT INTO produit(reference,categorie,titre,description,couleur,taille,public,photo,prix,stock)VALUES(:reference,:categorie,:titre,:description,:couleur,:taille,:public,:photo,:prix,:stock)");
				
				$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center">Le produit n° <strong class="text-success">' . $_POST['reference'] . '</strong> a bien été ajouté !</div>';
			}
		}
		else
		{
			$erreur = '';
			$verif_ref = $pdo->prepare("SELECT * FROM produit WHERE reference = :reference");
			$verif_ref->bindValue(':reference', $_POST['id_produit'], PDO::PARAM_STR);
			$verif_ref->execute();
			if($verif_ref->rowCount() > 0)
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">La référence existe déja. Merci de saisir une référence valide !!</div>';
			}
			$content .= $erreur;
			
			if(empty($erreur)) // on stock les messages d'erreur dans la variable $erreur, si elle est vide , cela veut dire que nous ne sommes rentré dans la condition if, que notre référence est valide
			{
				// Exercice : réaliser le script permettant de modifier un produit à l'aide d'une requete préparée
				$resultat = $pdo->prepare("UPDATE produit SET reference = :reference, categorie = :categorie, titre = :titre, description = :description, couleur = :couleur, taille = :taille, public = :public, photo = :photo, prix = :prix, stock = :stock WHERE id_produit = '$_POST[id_produit]'");
				
				$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center">Le produit n° <strong class="text-success">' . $_POST['id_produit'] . '</strong> a bien été modifié !</div>';
			}
		}
		
		if(empty($erreur))
		{
			if(isset($_GET['action']) && $_GET['action'] == 'modification')
			{
				$donnees = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
				$produit = $donnees->fetch(PDO::FETCH_ASSOC);
				//debug($produit);
				$resultat->bindValue(':reference', $produit['reference'], PDO::PARAM_STR);
			}
			else
			{		
				$resultat->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
			}
				$resultat->bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);
				$resultat->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
				$resultat->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
				$resultat->bindValue(':couleur', $_POST['couleur'], PDO::PARAM_STR);
				$resultat->bindValue(':taille', $_POST['taille'], PDO::PARAM_STR);
				$resultat->bindValue(':public', $_POST['public'], PDO::PARAM_STR);
				$resultat->bindValue(':photo', $photo_bdd , PDO::PARAM_STR);
				$resultat->bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);
				$resultat->bindValue(':stock', $_POST['stock'], PDO::PARAM_INT);
			
			
			$resultat->execute();
		}
	
}

//----- LIENS PRODUITS 
$content .= '<div class="list-group col-md-6 col-md-offset-3">';
$content .= '<h3 class="list-group-item active text-center">BACK OFFICE</h3>';
$content .= '<a href="?action=affichage" class="list-group-item text-center">Affichage produits</a>';
$content .= '<a href="?action=ajout" class="list-group-item text-center">Ajout produit</a>';
$content .= '<hr></div>';

//----- AFFICHAGE PRODUITS
if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
	// Exercice : afficher l'ensemble de la table produit sous forme de tableau HTML, prévoir un lien modification et suppression pour chaque produit
	$resultat = $pdo->query("SELECT * FROM produit");

	$content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert alert-success">Affichage produits</h3>';

	$content .= 'Nombre de produit(s) dans la boutique : <span class="badge text-danger">' . $resultat->rowCount() . '</span></div>';

	$content .= '<table class="col-md-10 table" style="margin-top: 10px;"><tr>';
	for($i = 0; $i < $resultat->columnCount(); $i++)
	{
		$colonne = $resultat->getColumnMeta($i);
		$content .= '<th>' . $colonne['name'] . '</th>';
	}
	$content .= '<th>Modification</th>';
	$content .= '<th>suppression</th>';
	$content .= '</tr>';
	while($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
	{
		//debug($ligne);
		$content .= '<tr>';
		foreach($ligne as $indice => $valeur)
		{
			if($indice == 'photo')
			{
				$content .= '<td><img src="' . $valeur . '" alt="" width="70" height="70"></td>';
			}
			else
			{
				$content .= '<td>' . $valeur . '</td>';
			}
			
		}
		$content .= '<td class="text-center"><a href="?action=modification&id_produit=' . $ligne['id_produit'] . '"><span class="glyphicon glyphicon-pencil"></span></a></td>';
		$content .= '<td class="text-center"><a href="?action=suppression&id_produit=' . $ligne['id_produit'] . '" Onclick="return(confirm(\'En êtes vous certain ?\'));"><span class="glyphicon glyphicon-trash"></span></a></td>';
		$content .= '</tr>';
	}
	$content .= '</table>';
}

require_once("../inc/header.inc.php");
echo $content;

if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification'))
{
	if(isset($_GET['id_produit']))
	{
		$resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
		$resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_INT);
		$resultat->execute();
		
		$produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
		//debug($produit_actuel);
	}
	
	// if(isset($produit_actuel['id_produit']))
	// {
		// echo $produit_actuel['id_produit'];
	// }
	// else
	// {
		// echo '';
	// }
	// si l'id_produit est définit dans la BDD, on l'affiche sinon on affiche une chaine de caractère vide
	$id_produit = (isset($produit_actuel['id_produit'])) ? $produit_actuel['id_produit'] : '';
	$reference = (isset($produit_actuel['reference'])) ? $produit_actuel['reference'] : '';
	$categorie = (isset($produit_actuel['categorie'])) ? $produit_actuel['categorie'] : '';
	$titre = (isset($produit_actuel['titre'])) ? $produit_actuel['titre'] : '';
	$description = (isset($produit_actuel['description'])) ? $produit_actuel['description'] : '';
	$couleur = (isset($produit_actuel['couleur'])) ? $produit_actuel['couleur'] : '';
	$taille = (isset($produit_actuel['taille'])) ? $produit_actuel['taille'] : '';
	$public = (isset($produit_actuel['public'])) ? $produit_actuel['public'] : '';
	$photo = (isset($produit_actuel['photo'])) ? $produit_actuel['photo'] : '';
	$prix = (isset($produit_actuel['prix'])) ? $produit_actuel['prix'] : '';
	$stock = (isset($produit_actuel['stock'])) ? $produit_actuel['stock'] : '';
	$controle = (isset($_GET['action']) && $_GET['action'] == 'modification') ? 'disabled' : '';
	
	
	echo '<form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
		<h1 class="alert alert-info text-center">' . ucfirst($_GET['action']) . ' produit</h1>
		
		<input type="hidden" id="id_produit" name="id_produit" value="' . $id_produit . '">

	  <div class="form-group">
		<label for="reference">Référence</label>
		<input type="text" class="form-control" id="reference" name="reference" placeholder="reference" value="' . $reference . '" ' . $controle . '>
	  </div>
	  <div class="form-group">
		<label for="categorie">Catégorie</label>
		<input type="text" class="form-control" id="categorie" name="categorie" placeholder="categorie" value="' . $categorie . '">
	  </div>
	  <div class="form-group">
		<label for="titre">Titre</label>
		<input type="text" class="form-control" id="titre" name="titre" placeholder="titre" value="' . $titre . '">
	  </div>
	  <div class="form-group">
		<label for="description">Description</label>
		<textarea class="form-control" rows="3" id="description" name="description">' . $description . '</textarea>
	  </div>
	  <div class="form-group">
		<label for="couleur">Couleur</label>
		<input type="text" class="form-control" id="couleur" name="couleur" placeholder="couleur" value="' . $couleur . '">
	  </div>
	  <div class="form-group">
		  <label for="taille">Taille</label>
		  <select class="form-control" id="taille" name="taille">
			  <option value="s"'; if($taille == 's') echo 'selected'; echo '>S</option>
			  <option value="m"'; if($taille == 'm') echo 'selected'; echo '>M</option>
			  <option value="l"'; if($taille == 'l') echo 'selected'; echo '>L</option>
			  <option value="xl"'; if($taille == 'xl') echo 'selected'; echo '>XL</option>
		  </select>
	  </div>
	  <div class="form-group">
		  <label for="public">Public</label>
		  <select class="form-control" id="public" name="public">
			  <option value="m"'; if($public == 'm') echo 'selected'; echo '>Homme</option>
			  <option value="f"'; if($public == 'f') echo 'selected'; echo '>Femme</option>
			  <option value="mixte"'; if($public == 'mixte') echo 'selected'; echo '>Mixte</option>
		  </select>
	  </div>
	   <div class="form-group">
		<label for="photo">Photo</label>
		<input type="file" id="photo" name="photo" value="' . $photo . '"><br>';
		if(!empty($photo))
		{
			echo '<em>Vous pouvez uploader une nouvelle photo si vous souhaitez la changer</em><br>';
			echo '<img src="' . $photo . '" width="90" height="90" value="' . $photo . '"><br>';
		}
		echo '<input type="hidden" id="photo_actuelle" name="photo_actuelle" value="' . $photo . '">';
	  echo '</div>
	  <div class="form-group">
		<label for="prix">Prix</label>
		<input type="text" class="form-control" id="prix" name="prix" placeholder="prix" value="' . $prix . '">
	  </div>
	  <div class="form-group">
		<label for="stock">Stock</label>
		<input type="text" class="form-control" id="stock" name="stock" placeholder="stock" value="' . $stock . '">
	  </div>
	 
	  <button type="submit" class="btn btn-primary col-md-12">' . ucfirst($_GET['action']) . ' d\'un produit</button>
	</form>';
}

require_once("../inc/footer.inc.php");
?>