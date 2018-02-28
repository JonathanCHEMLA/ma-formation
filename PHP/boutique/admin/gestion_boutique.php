<?php

require_once("../inc/init.inc.php");

//---------- Vérification Admin
if(!internanuteEstConnecteEtEstAdmin())	// si l'internaute n'est pas admin, il n' a rien à faire sur cette page. On le re-dirige vers la page connexion 
{
	header("location:" . URL . "connexion.php");
}

//----------ENREGISTREMENT PRODUIT
if(!empty($_POST))
{
	//debug($_FILES);	//CETTE LIGNE DE DEBUGAGE EST TRES IMPORTANTE   on fait le debug , juste de la photo; pas du reste du formulaire.
	if(!empty($_FILES['photo']['name']))		//si il a select une photo
	{
		$nom_photo = $_POST['reference'] . '-' . $_FILES["photo"]["name"];			//concatener la ref avec le nom de la photo
		//echo $nom_photo; 		//pour le tester: remplir une ref, selectionner une photo, valider le formulaire et le echo apparait.
		$photo_bdd= URL . "photo/$nom_photo";		//pour l'enreg dans la BDD
		//echo $photo_bdd;		//idem pour tester ce echo: remplir une ref, selectionner une photo, valider le formulaire et le echo apparait.
		$photo_dossier = RACINE_SITE . "photo/$nom_photo"; 	//	RACINE_SITE a été déclaré dans le fichier init.inc	RACINE_SITE c'est le CHEMIN PHYSIQUE DU DOSSIER (c'est c:// ... )	//indique le chem complet de destination ede ma photo
		//echo $photo_dossier;
		copy($_FILES['photo']['tmp_name'],$photo_dossier);   //IMPORTANT permet de copier la photo dans notre dossier		// copy(nom_temporaire_de_ma_photo,chemin_de_destination)
	}
}

require_once("../inc/header.inc.php");
?>

<!-- Réaliser un formulaire HTML correspondant à la table produit de la BDD (sauf l'id_produit)--> 

<form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">		<!---ATTENTION, TRES IMPORTANT: je suis obligé de rajouter l'attribut enctype="multipart/form-data"   lorsqu on veut imploder une photo.-->
	<h1 class="alert alert-info text-center">Ajout d'un produit</h1>
	
  <div class="form-group">
    <label for="reference">Référence</label>
    <input type="text" class="form-control" id="reference" placeholder="reference" name="reference">
  </div>
  <div class="form-group">
    <label for="categorie">Catégorie</label>
    <input type="text" class="form-control" id="categorie" placeholder="categorie" name="categorie">
  </div>
  <div class="form-group">
    <label for="titre">Titre</label>
    <input type="text" class="form-control" id="titre" placeholder="titre" name="titre">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
	<textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="couleur">Couleur</label>
    <input type="text" class="form-control" id="couleur" placeholder="couleur" name="couleur">
  </div>
  <div class="form-group">
    <label for="public">Public</label>
	<select class="form-control" name="public" id="public">
		<option value="m">Homme</option>
		<option value="f">Femme</option>
		<option value="mixte">Mixte</option>
	</select>
  </div>
  <div class="form-group">
    <label for="public">Taille</label>
	<select class="form-control" name="public" id="public">
		<option value="s">S</option>
		<option value="m">M</option>	
		<option value="l">L</option>
		<option value="xl">XL</option>
	</select>
  </div>	<!-- Attention, dans les copier coller. ici le footer etait remonté car je n'avais pas fermé cette div-->
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo">
  </div>
  <div class="form-group">
    <label for="prix">Prix</label>
    <input type="text" class="form-control" id="prix" placeholder="prix" name="prix">
  </div>
  <div class="form-group">
    <label for="stock">Stock</label>
    <input type="text" class="form-control" id="stock" placeholder="stock" name="stock">
  </div>
 
  <button type="submit" class="btn btn-primary col-md-12">Ajout d'un produit</button>
  
</form>



<?php
require_once("../inc/footer.inc.php");
?>