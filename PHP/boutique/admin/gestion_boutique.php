<?php

require_once("../inc/init.inc.php");

//---------- VERIFICATION ADMIN
if(!internanuteEstConnecteEtEstAdmin())	// si l'internaute n'est pas admin, il n' a rien à faire sur cette page. On le re-dirige vers la page connexion 
{
	header("location:" . URL . "connexion.php");
}

//-----------SUPPRESSION PRODUIT
if(isset($_GET['action']) && $_GET['action']=='suppression')	// on rentre dans la condition seulement dans le cas ou l'on clique sur le lien suppression de l'affichage des produits
{
	$resultat=$pdo->prepare("DELETE FROM produit WHERE id_produit= :id_produit");	// ici on a fait un prepare a cause du risque que l'user malveillant modifie dans l'url l'id_produit.  on s'en fout s'il modifie l'action car alors il ne rentrerrait pas dans le if de suppression
	$resultat->bindValue(':id_produit',$_GET['id_produit'],PDO::PARAM_STR);
	$resultat->execute();
	
	$_GET['action']="affichage";	//on affecte une nouvelle valeur à l'indice 'action' afin d'être redirigé sur l'affichage des produits après la suppression.	//Attention à la casse!!!: j'avais mis par erreur: Affichage. 
	$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center"> Le produit n° <span class="text-success">' . $_GET['id_produit'] . '<span> a bien été supprimé</div>';
	
}


//----------ENREGISTREMENT PRODUIT
if(!empty($_POST))		// (if post)= s'il a envoyé le formulaire.   (if !empty post)=si le form a été rempli et a été renvoyé.
{
	//debug($_FILES);	//CETTE LIGNE DE DEBUGAGE EST TRES IMPORTANTE   on fait le debug , juste de la photo; pas du reste du formulaire.

	//Exercice : réaliser le script permettant de contrôler la disponibilité de la référence.
	$erreur="";
	$verif_ref= $pdo->prepare("SELECT * FROM produit WHERE reference= :reference");
	$verif_ref->bindValue(':reference',$_POST['reference'],PDO::PARAM_STR);
	$verif_ref->execute();
	if($verif_ref->rowCount()>0)
	{
		$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">La référence est déjà existante. Merci de remplir une référence valide !!</div>';	
	}
	$content .=$erreur;
	
	if(empty($erreur))

	{	
		if(!empty($_FILES['photo']['name']))		//si il a select une photo
		{
			$nom_photo = $_POST['reference'] . '-' . $_FILES["photo"]["name"];			//concatener la reference saisie dans le formulaire avec le nom de la photo via la superglobale $_FILES
			//echo $nom_photo; 		//pour le tester: remplir une ref, selectionner une photo, valider le formulaire et le echo apparait.
			$photo_bdd= URL . "photo/$nom_photo";		//on définit l'URL de la photo pour l'enreg dans la BDD
			//echo $photo_bdd;		//idem pour tester ce echo: remplir une ref, selectionner une photo, valider le formulaire et le echo apparait.
			$photo_dossier = RACINE_SITE . "photo/$nom_photo"; 	//	RACINE_SITE a été déclaré dans le fichier init.inc	RACINE_SITE c'est le CHEMIN PHYSIQUE DU DOSSIER (c'est c:// ... )	//on definit le chemin physique complet du dossier photo sur le serveur.
			//echo $photo_dossier;
			copy($_FILES['photo']['tmp_name'],$photo_dossier);   //IMPORTANT permet de copier la photo directement dans notre dossier photo		// copy(nom_temporaire_de_ma_photo,chemin_du_dossier_photo)
		}
/*******************************************************************************************************************************************************************************************************/
		// Réaliser le script permettant d'insérer un produit dans la table 'produit' à l'aide d'une requête préparée
		
		$insert_membre = $pdo->prepare('INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES(:reference,:categorie,:titre,:description,:couleur,:taille,:public,:photo,:prix, :stock)');	
		// ATTENTION: dans Insert into, ne PAS OUBLIER de fermer les ''  !!!
		$insert_membre->bindValue(':reference', 	$_POST["reference"], PDO::PARAM_STR);
		$insert_membre->bindValue(':categorie', 	$_POST["categorie"], PDO::PARAM_STR);
		$insert_membre->bindValue(':titre', 		$_POST["titre"], PDO::PARAM_STR);
		$insert_membre->bindValue(':description', 	$_POST["description"], PDO::PARAM_STR);
		$insert_membre->bindValue(':couleur', 		$_POST["couleur"], PDO::PARAM_STR);
		$insert_membre->bindValue(':taille', 		$_POST["taille"], PDO::PARAM_STR);
		$insert_membre->bindValue(':public', 		$_POST["public"], PDO::PARAM_STR);
		$insert_membre->bindValue(':photo', 		$photo_bdd, PDO::PARAM_STR);	// IMPORTANT c'est $photo_bdd et non $_POST["photo"] car on veut récupérer tout l'URL
		$insert_membre->bindValue(':prix', 			$_POST["prix"], PDO::PARAM_INT);	//IMPORTANT : mettre PARAM_INT et non PARAM_STR sinon ca risque de faire un conflit avec la bdd, dans laquelle on a déclaré un integer.
		$insert_membre->bindValue(':stock', 		$_POST["stock"], PDO::PARAM_INT);
		$insert_membre->execute();
		
		$content .= '<div class="alert alert-succes col-md-8 col-md-offset-2 text-center">Le produit référence: <strong class="text-success">'. $_POST["reference"] . '</strong> a bien été enregistré dans la boutique </div>'; 
	
/*********************************************************************************************************************************************************************************************************/	
	}
}
// --------LIEN PRODUITS
$content .= '<div class="list-group col-md-6 col-md-offset-3">';
$content .= '<h3 class="list-group-item active text-center">BACK OFFICE</h3>';
$content .= '<a href="?action=affichage" class="list-group-item text-center">Affichage produits</a>';
$content .= '<a href="?action=ajout" class="list-group-item text-center">Ajout produit</a>';
$content .= '<hr></div>';

/*********************************************************************************************************************************************************************************************************/

//-- AFFICHAGE PRODUITS
if(isset($_GET['action']) && $_GET['action']=='affichage')	// signifie : si j'ai bien cliqué sur le lien Affichage produit, et si l'action souhaitée est "affichage" alors execute le script suivant:
{
	// Afficher l'ensemble de la table produit sous la forme d'un tableau HTML, et prévoir un lien de modification et de suppression pour chaque produit
	$resultat=$pdo->query("SELECT * FROM produit");
	$content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert-success">Affichage produits</h3>';

	$content .='Nombre de produit(s) dans la boutique : <span class="">' . $resultat->rowCount() . '</span></div>';

	$content .='<table class="col-md-10 table" style="margin-top: 10px;"><tr>';
		for($i=0; $i<$resultat->columnCount(); $i++)	
		{
			$colonne= $resultat->getColumnMeta($i);	
			$content .='<th>' . $colonne['name'] . '</th>';	
		}
		$content .='<th>' . 'Modifier' . '</th>';
		$content .='<th>' . 'Supprimer' . '</th>';
	$content .='</tr>';

	/*************************************************************************************************/
	//Ce que j'ai fait et qui fonctionne:
	/*
	for ($j=0;$j<$resultat->rowCount(); $j++)
	{	
		$content .= '<tr>';
		$ligne = $resultat->fetch(PDO::FETCH_ASSOC);	
		foreach($ligne as $indice => $valeur)
		{
			if($indice=="photo")
			{
				$content .= '<td>' . '<img src="' .$valeur. '" width=100>' . '</td>';
			}
			else
			{
				$content .= '<td>' . $valeur . '</td>';		
			}	
		}
	*/
	/**************************************************************************************************/
	/*ce que le prof a fait:*/
	while($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
	{
		//debug($ligne);
		$content .= '<tr>';
		foreach($ligne as $indice => $valeur)
		{
			if($indice=="photo")
			{
				$content .= '<td>' . '<img src="' .$valeur. '" width=100 alt="">' . '</td>';
			}
			else
			{
				$content .= '<td>' . $valeur . '</td>';		
			}	
		}	
	/**/
	/***************************************************************************************************/


	$content .= '<td>' . '<a href="?action=modification&id_produit=' . $ligne['id_produit'] . '"><span class="glyphicon glyphicon-refresh">Modifier</span></a>' . '</td>';
	$content .='<td>' . '<a href="?action=suppression&id_produit=' . $ligne['id_produit'] . '" onclick="return(confirm(\'En êtes vous certain?\'));"><span class="glyphicon glyphicon-remove">Supprimer</span></a>' . '</td>';	// Attention aux parenthèses.
	$content .= '</tr>';
	}
	$content .= '</table>';
}	
/**********************************************************************************************************************************************************************************************************/
	
require_once("../inc/header.inc.php");
echo $content;	//ATTENTION : Ne pas oublier de faire le ECHO de CONTENT




if(isset($_GET['action']) && ($_GET['action']=='ajout' || $_GET['action']=='modification') )
{
	if(isset($_GET['id_produit']))
	{
		//je recupere l'id de l'url et fais une requete pour recuperer toute la ligne correspondant à l'id que j'ai recu dans l'url
		$resultat=$pdo->prepare("SELECT * FROM produit WHERE id_produit= :id_produit");
		$resultat->bindValue(':id_produit',$_GET['id_produit'],PDO::PARAM_INT);
		$resultat->execute(); 	// ATTENTION: $resultat contient UN OBJET
		
		$produit_actuel=$resultat->fetch(PDO::FETCH_ASSOC);
		//debug($produit_actuel);
	}
	
	$id_produit = (isset($produit_actuel['id_produit'])) ? $produit_actuel['id_produit'] : ''; //si l'id produit est defini dans la BDD, alors on l'affiche sinon on affiche une chaine de caractere vide.
	// si l'user a cliqué sur le bouton modifier, cela entraine donc qu'on transporte dans l'url, (en plus de 'action')  le GET du id_produit. ainsi, la ligne ci-dessus teste:
	// (isset($produit_actuel['id_produit']))	: si j'arrive dans le formulaire apres avoir cliqué sur 'modifier' alors mon id_produit n'est pas vide; et il contient l'id du produit à modifier.
	// ? $produit_actuel['id_produit']      	: si tel est le cas, alors je rentre dans ma variable '$id_produit' la valeur de l'id importée  et contenue dans 'produit_actuel['id_produit']'
	// : ''										: autrement, cela signifie que l'user ne souhaite non pas faire une modif mais un ajout (car on ne transporte pas d 'Id_produit' dans notre url.) je demande donc que ma variable '$id_produit' prenne la valeur ''  
	
	//je fais pareil avec les autres champs:
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

	
	
	echo '<form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">		<!---ATTENTION, TRES IMPORTANT: je suis obligé de rajouter l\'attribut enctype="multipart/form-data"   lorsqu on veut imploder une photo.-->
		<h1 class="alert alert-info text-center">'.ucfirst($_GET["action"]) .' produit</h1>		<!-- ucfirst est une fct qui met la premiere lettre en Majuscule. -->
		
		<input type="text" id="id_produit" name="id_produit" value="'. $id_produit .'">
		
	  <div class="form-group">
		<label for="reference">Référence</label>
		<input type="text" class="form-control" id="reference" placeholder="reference" name="reference" value="'. $reference .'">
	  </div>
	  <div class="form-group">
		<label for="categorie">Catégorie</label>
		<input type="text" class="form-control" id="categorie" placeholder="categorie" name="categorie" value="'. $categorie .'">
	  </div>
	  <div class="form-group">
		<label for="titre">Titre</label>
		<input type="text" class="form-control" id="titre" placeholder="titre" name="titre" value="'. $titre .'">
	  </div>
	  <div class="form-group">
		<label for="description">Description</label>
		<textarea class="form-control" id="description" name="description" rows="3">'. $description .'</textarea>
	  </div>
	  <div class="form-group">
		<label for="couleur">Couleur</label>
		<input type="text" class="form-control" id="couleur" placeholder="couleur" name="couleur" value="'. $couleur .'">
	  </div>
	  <div class="form-group">
		<label for="public">Public</label>
		<select class="form-control" name="public" id="public">
			<option value="m"'; if($public=='m') echo 'selected'; echo '>Homme</option>
			<option value="f"'; if($public=='f') echo 'selected'; echo '>Femme</option>
			<option value="mixte"'; if($public=='mixte') echo 'selected'; echo '>Mixte</option>
		</select>
	  </div>
	  <div class="form-group">
		<label for="taille">Taille</label>
		<select class="form-control" name="taille" id="taille">
			<option value="S"'; if($taille=='S') echo 'selected'; echo '>S</option>
			<option value="M"'; if($taille=='M') echo 'selected'; echo '>M</option>	
			<option value="L"'; if($taille=='L') echo 'selected'; echo '>L</option>
			<option value="XL"'; if($taille=='XL') echo 'selected'; echo '>XL</option>
		</select>
	  </div>	<!-- Attention, dans les copier coller. ici le footer etait remonté car je n\'avais pas fermé cette div -->
	  
	  <div class="form-group">
		<label for="photo">Photo</label>
		<input type="file" id="photo" name="photo" value="'. $photo .'"><br>'; // on ferme notre echo et on le reouvre  4 ligne en dessous, afin de pouvoir mettre une condition php sur plusieurs lignes.
		if(!empty($photo))
		{
			echo '<em>Vous pouvez uploder une nouvelle photo si vous souhaitez la changer</em><br>';
			echo '<img src="'.$photo.'" width="90" value="' .$photo. '"><br>';
		}
		
	  echo'</div>
	  <div class="form-group">
		<label for="prix">Prix</label>
		<input type="text" class="form-control" id="prix" placeholder="prix" name="prix" value="'. $prix .'">
	  </div>
	  <div class="form-group">
		<label for="stock">Stock</label>
		<input type="text" class="form-control" id="stock" placeholder="stock" name="stock" value="'. $stock .'">
	  </div>
	 
	  <button type="submit" class="btn btn-primary col-md-12">'.ucfirst($_GET["action"]) .' produit</button>
	  
	</form>';
}



require_once("../inc/footer.inc.php");
?>