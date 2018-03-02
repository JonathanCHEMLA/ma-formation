<?php 

	$resultat=$pdo->prepare("DELETE FROM produit WHERE id_produit= :id_produit");	// ici on a fait un prepare a cause du risque que l'user malveillant modifie dans l'url l'id_produit.  on s'en fout s'il modifie l'action car alors il ne rentrerrait pas dans le if de suppression
	$resultat->bindValue(':id_produit',$_GET['id_produit'],PDO::PARAM_STR);
	$resultat->execute();
	
	
		$verif_ref= $pdo->prepare("SELECT * FROM produit WHERE reference= :reference");
		$verif_ref->bindValue(':reference',$_POST['reference'],PDO::PARAM_STR);
		$verif_ref->execute();
		if($verif_ref->rowCount()>0)
		
		
		$resultat_insert_modif = $pdo->prepare('INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES(:reference,:categorie,:titre,:description,:couleur,:taille,:public,:photo,:prix, :stock)');	
	
	
	$resultat_insert_modif = $pdo->prepare("UPDATE produit SET reference=:reference, categorie=:categorie, titre=:titre, description=:description, couleur=:couleur, taille=:taille, public=:public, photo=:photo, prix=:prix, stock=:stock WHERE id_produit= '$_POST[id_produit]'");
	
	
	$resultat_insert_modif->bindValue(':reference', 	$_POST["reference"], PDO::PARAM_STR);
	$resultat_insert_modif->bindValue(':categorie', 	$_POST["categorie"], PDO::PARAM_STR);
	$resultat_insert_modif->bindValue(':titre', 		$_POST["titre"], PDO::PARAM_STR);
	$resultat_insert_modif->bindValue(':description', 	$_POST["description"], PDO::PARAM_STR);
	$resultat_insert_modif->bindValue(':couleur', 		$_POST["couleur"], PDO::PARAM_STR);
	$resultat_insert_modif->bindValue(':taille', 		$_POST["taille"], PDO::PARAM_STR);
	$resultat_insert_modif->bindValue(':public', 		$_POST["public"], PDO::PARAM_STR);
	$resultat_insert_modif->bindValue(':photo', 		$photo_bdd, PDO::PARAM_STR);	// IMPORTANT c'est $photo_bdd et non $_POST["photo"] car on veut récupérer tout l'URL
	$resultat_insert_modif->bindValue(':prix', 			$_POST["prix"], PDO::PARAM_INT);	//IMPORTANT : mettre PARAM_INT et non PARAM_STR sinon ca risque de faire un conflit avec la bdd, dans laquelle on a déclaré un integer.
	$resultat_insert_modif->bindValue(':stock', 		$_POST["stock"], PDO::PARAM_INT);
	$resultat_insert_modif->execute();



$resultat=$pdo->query("SELECT * FROM produit");
	$content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert-success">Affichage produits</h3>';

	$content .='Nombre de produit(s) dans la boutique : <span class="">' . $resultat->rowCount() . '</span></div>';

	$content .='<table class="col-md-10 table" style="margin-top: 10px;"><tr>';
		for($i=0; $i<$resultat->columnCount(); $i++)	
		{
			$colonne= $resultat->getColumnMeta($i);	
			$content .='<th>' . $colonne['name'] . '</th>';	
		}


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


		//je recupere l'id de l'url et fais une requete pour recuperer toute la ligne correspondant à l'id que j'ai recu dans l'url
		$resultat=$pdo->prepare("SELECT * FROM produit WHERE id_produit= :id_produit");
		$resultat->bindValue(':id_produit',$_GET['id_produit'],PDO::PARAM_INT);
		$resultat->execute(); 	// ATTENTION: $resultat contient UN OBJET
		
		$produit_actuel=$resultat->fetch(PDO::FETCH_ASSOC);


?>		