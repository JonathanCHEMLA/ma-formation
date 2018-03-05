<?php

require_once("../inc/init.inc.php");

//---------- VERIFICATION ADMIN	//redirection de l'user égaré
if(!internanuteEstConnecteEtEstAdmin())	// si l'internaute n'est pas admin, il n' a rien à faire sur cette page. On le re-dirige vers la page connexion 
{
	header("location:" . URL . "connexion.php");
}


// --------LIEN COMMANDE	//CECI EST NOTRE MENU BLEU ET BLANC, EN HAUT DE LA PAGE
$content .= '<div class="list-group col-md-6 col-md-offset-3">';
$content .= '<h3 class="list-group-item active text-center">BACK OFFICE</h3>';
$content .= '<a href="?action=affichage" class="list-group-item text-center">Affichage des commandes</a>';
$content .= '<hr></div>';


//-----------SUPPRESSION COMMANDE
if(isset($_GET['action']) && $_GET['action']=='suppression')
{
	$resultat=$pdo->prepare("DELETE FROM commande WHERE id_commande= :id_commande");	
	$resultat->bindValue(':id_commande',$_GET['id_commande'],PDO::PARAM_STR);
	$resultat->execute();
	
	$_GET['action']="affichage";	//on affecte une nouvelle valeur à l'indice 'action' afin d'être redirigé sur l'affichage des commandes après la suppression.
	$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center"> La commande n° <span class="text-success">' . $_GET['id_commande'] . '<span> a bien été supprimée</div>';
}



//---------------------LORS DE LA VALIDATION DU FORMULAIRE: 

if(!empty($_POST))		// (if post)= s'il a envoyé le formulaire.   (if !empty post)=si le form a été rempli et a été renvoyé.
{

// CAS N°2 : ON SOUHAITE FAIRE UNE MODIFICATION-------------------------------------------------------------------------------------------------------------------

	$photo_bdd='';
	if(isset($_GET['action']) && $_GET['action'] == 'modification')	
	{
		$resultat_modif_cde = $pdo->prepare("UPDATE commande SET id_commande=:id_commande, id_membre=:id_membre, montant=:montant, date_enregistrement=:date_enregistrement, etat=:etat WHERE id_commande= '$_POST[id_commande]'");
		$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center"> La commande n° <span class="text-success">' . $_POST['id_commande'] . '<span> a bien été modifiée</div>';			
	}
//	ON TERMINERA LA MODIFICATION AVEC BINDVALUE ET EXECUTE, SITUES PLUS BAS
	
// FIN DU CAS N°2.


//	BINDVALUE ET EXECUTE
	if(empty($erreur))
	{
	// Exercice : Réaliser le script permettant d'insérer un produit dans la table 'produit' à l'aide d'une requête préparée
	$resultat_modif_cde->bindValue(':id_commande', 			$_POST["id_commande"], PDO::PARAM_STR);
	$resultat_modif_cde->bindValue(':id_membre', 			$_POST["id_membre"], PDO::PARAM_STR);
	$resultat_modif_cde->bindValue(':montant', 				$_POST["montant"], PDO::PARAM_STR);
	$resultat_modif_cde->bindValue(':date_enregistrement', 	$_POST["date_enregistrement"], PDO::PARAM_STR);
	$resultat_modif_cde->bindValue(':etat', 				$_POST["etat"], PDO::PARAM_STR);

	$resultat_modif_cde->execute();
	
	}
/*********************************************************************************************************************************************************************************************************/	
	
}
//	FIN VALIDATION FORMULAIRE

/*********************************************************************************************************************************************************************************************************/

//-- AFFICHAGE COMMANDES: CREATION DU TABLEAU, VISUEL AU CLIC SUR 'Affichage commandes' 






if(isset($_GET['action']) && $_GET['action']=='affichage')	// si j'ai cliqué sur 'Affichage produit' dans le menu Bleu/Blanc:
{
//	1-L'ENTETE DU TABLEAU
	$resultat=$pdo->query("SELECT m.id_membre as 'N° membre', email, prenom, nom, adresse, id_commande as 'N° de commande', montant, etat  FROM commande c, membre m WHERE m.id_membre=c.id_membre ORDER BY id_commande");
	$content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert-success">Liste des commandes</h3>';

	$content .='Nombre de commande(s) dans la boutique : <span class="">' . $resultat->rowCount() . '</span></div>';

	$content .='<table class="col-md-10 table" style="margin-top: 10px;"><tr>';
	for($i=0; $i<$resultat->columnCount(); $i++)	
	{
		$colonne= $resultat->getColumnMeta($i);	
		$content .='<th>' . $colonne['name'] . '</th>';	
	}
	$content .='<th>' . 'Détails' . '</th>';
	$content .='<th>' . 'Suppression' . '</th>';
	$content .='<th>' . 'Etat' . '</th>';	
	$content .='<th>' . 'Modification' . '</th>';
	$content .='</tr>';


	while($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
	{
		debug($ligne);
		$content .='<tr>';
		$content .='<td>' . $ligne['N° membre'] . '</td>';
		$content .='<td>' . $ligne['email'] . '</td>';
		$content .='<td>' .  $ligne['prenom']  	. '</td>';
		$content .='<td>' .  $ligne['nom'] 		. '</td>';
		$content .='<td>' .  $ligne['adresse'] 	. '</td>';
		$content .='<td>' .  $ligne['N° de commande']  . '</td>';		
		$content .='<td>' .  $ligne['montant'] 	. '</td>';		
		$content .='<td>' .  $ligne['etat'] 	. '</td>';		
		$content .='<td><a href="?action=modification&id_commande=' . $ligne['N° de commande'] . '"><span class="glyphicon glyphicon-search">Modifier</span></a>' . '</td>';		
		$content .='<td><a href="?action=suppression&id_commande=' . $ligne['N° de commande'] . '" onclick="return(confirm(\'En êtes vous certain?\'));"><span class="glyphicon glyphicon-remove">Supprimer</span></a>' . '</td>';
		
		$content .='<td>
		<div class="form-group">
		<select class="form-control" name="etat" id="etat" >
			<option value="en cours de traitement"'; if($ligne['etat']=='en cours de traitement') $content .= 'selected'; $content .= '>En cours de traitement</option>
			<option value="envoyé"'; if($ligne['etat']=='envoyé') $content .= 'selected'; $content .= '>Envoyé</option>
			<option value="livré"'; if($ligne['etat']=='livré') $content .= 'selected'; $content .= '>Livré</option>
		</select>   
	    </div></td>';

		$content .= '<td><div class="form-group"><a href="?action=modification&id_commande=' . $ligne['N° de commande'] . '"><button type="submit" class="btn btn-primary col-md-12">Modifier l\'état</button></a></div></td>';	

		
	$content .= '</tr>';
	}
	$content .= '</table>';
}	

//	FIN DU CONTENU DE TABLEAU

/**********************************************************************************************************************************************************************************************************/
	
require_once("../inc/header.inc.php");
echo $content;	


//-- FORMULAIRE D'ENREGISTREMENT PRODUIT: CREATION DU FORMULAIRE, VISUEL AU CLIC SUR 'Ajout commande' 

if(isset($_GET['action']) && $_GET['action']=='modification') 
{

	if(isset($_GET['id_commande']))
	{
		//je recupere l'id de l'url et fais une requete pour recuperer toute la ligne correspondant à l'id que j'ai recu dans l'url
		$resultat=$pdo->prepare("SELECT * FROM commande WHERE id_commande= :id_commande");
		$resultat->bindValue(':id_commande',$_GET['id_commande'],PDO::PARAM_INT);
		$resultat->execute(); 	// ATTENTION: $resultat contient UN OBJET
		
		$commande_actuelle=$resultat->fetch(PDO::FETCH_ASSOC);
		//debug($commande_actuelle);
	}
	
	$id_commande = (isset($commande_actuelle['id_commande'])) ? $commande_actuelle['id_commande'] : ''; 
	$id_membre = (isset($commande_actuelle['id_membre'])) ? $commande_actuelle['id_membre'] : '';
	$montant = (isset($commande_actuelle['montant'])) ? $commande_actuelle['montant'] : '';
	$date_enregistrement = (isset($commande_actuelle['date_enregistrement'])) ? $commande_actuelle['date_enregistrement'] : '';
	$etat = (isset($commande_actuelle['etat'])) ? $commande_actuelle['etat'] : '';

	
	echo '<form method="post" action="" class="col-md-8 col-md-offset-2">
		<h1 class="alert alert-info text-center">'.ucfirst($_GET["action"]) .' commande</h1>		<!-- ucfirst est une fct qui met la premiere lettre en Majuscule. -->
		
		<input type="hidden" id="id_commande" name="id_commande" value="'. $id_commande .'">
		
	  <div class="form-group">
		<label for="id_membre">ID MEMBRE</label>
		<input type="text" class="form-control" id="id_membre" placeholder="id_membre" name="id_membre" value="'. $id_membre .'" >
	  </div>
	  <div class="form-group">
		<label for="montant">Montant</label>
		<input type="text" class="form-control" id="montant" placeholder="montant" name="montant" value="'. $montant .'">
	  </div>
	  <div class="form-group">
		<label for="date_enregistrement">Date d\'enregistrement</label>
		<input type="text" class="form-control" id="date_enregistrement" placeholder="date_enregistrement" name="date_enregistrement" value="'. $date_enregistrement .'">
	  </div>
	  <div class="form-group">
		<label for="etat">Etat</label>
		<select class="form-control largeur" name="etat" id="etat">
			<option value="en cours de traitement"'; if($etat=='en cours de traitement') echo 'selected'; echo '>En cours de traitement</option>
			<option value="envoyé"'; if($etat=='envoyé') echo 'selected'; echo '>Envoyé</option>
			<option value="livré"'; if($etat=='livré') echo 'selected'; echo '>Livré</option>
		</select>
	  </div>


	 
	  <button type="submit" class="btn btn-primary col-md-12">'.ucfirst($_GET["action"]) .' produit</button>
	  
	</form>';
}

//-- FIN DE 'FORMULAIRE D'ENREGISTREMENT PRODUIT'

require_once("../inc/footer.inc.php");

?>
