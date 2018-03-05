<?php

require_once("../inc/init.inc.php");

//---------- VERIFICATION ADMIN	//redirection de l'user égaré
if(!internanuteEstConnecteEtEstAdmin())	// si l'internaute n'est pas admin, il n' a rien à faire sur cette page. On le re-dirige vers la page connexion 
{
	header("location:" . URL . "connexion.php");
}


// --------LIEN MEMBRES	//CECI EST NOTRE MENU BLEU ET BLANC, EN HAUT DE LA PAGE
$content .= '<div class="list-group col-md-6 col-md-offset-3">';
$content .= '<h3 class="list-group-item active text-center">BACK OFFICE</h3>';
$content .= '<a href="?action=affichage" class="list-group-item text-center">Liste des membres</a>';
$content .= '<hr></div>';


//-----------SUPPRESSION PRODUIT
if(isset($_GET['action']) && $_GET['action']=='suppression')
{
	$resultat=$pdo->prepare("DELETE FROM membre WHERE id_membre= :id_membre");	
	$resultat->bindValue(':id_membre',$_GET['id_membre'],PDO::PARAM_STR);
	$resultat->execute();
	
	$_GET['action']="affichage";
	$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center"> Le membre n° <span class="text-success">' . $_GET['id_membre'] . '<span> a bien été supprimé</div>';
}



//---------------------LORS DE LA VALIDATION DU FORMULAIRE: 

if(!empty($_POST))		
{
	
// CAS N°2 : ON SOUHAITE FAIRE UNE MODIFICATION-------------------------------------------------------------------------------------------------------------------

	$photo_bdd='';
	if(isset($_GET['action']) && $_GET['action'] == 'modification')	// j'ai cliqué sur 'modification' dans 'Liste des membres':
	{
		//$photo_bdd=$_POST['photo_actuelle']; // si on souhaite conserver la meme photo en cas de modification, on affecte le champs photo 'hidden' c'est à dire l'URL de la photo //selectionné en BDD . Ici on affecte a $photo_bdd  l'image selectionnée par l'user lorsqu'il valide le formulaire.
		

		$membre_modifie = $pdo->prepare("UPDATE membre SET id_membre=:id_membre, pseudo=:pseudo, mdp=:mdp, nom=:nom, prenom=:prenom, email=:email, civilite=:civilite, ville=:ville, code_postal=:code_postal, adresse=:adresse, status=:status WHERE id_membre= '$_POST[id_membre]'");		
		
		
		$content .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center"> Le membre <span class="text-success">' . $_POST['prenom'] ." ". $_POST['nom'] . " Alias " . $_POST['pseudo'] . '<span> a bien été modifié</div>';			
	}

	if(empty($erreur))
	{
	debug($_POST);
	$membre_modifie->bindValue(':id_membre', 	$_POST["id_membre"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':pseudo', 		$_POST["pseudo"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':mdp', 			$_POST["mdp"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':nom', 			$_POST["nom"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':prenom', 		$_POST["prenom"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':email', 		$_POST["email"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':civilite', 	$_POST["civilite"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':ville', 		$_POST["ville"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':code_postal', 	$_POST["code_postal"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':adresse', 		$_POST["adresse"], PDO::PARAM_STR);
	$membre_modifie->bindValue(':status', 		$_POST["status"], PDO::PARAM_INT);
	$membre_modifie->execute();
	
	}
/*********************************************************************************************************************************************************************************************************/	
	
}
//	FIN VALIDATION FORMULAIRE

/*********************************************************************************************************************************************************************************************************/

//-- AFFICHAGE MEMBRES: CREATION DU TABLEAU, VISUEL AU CLIC SUR 'Liste des membres' 

if(isset($_GET['action']) && $_GET['action']=='affichage')
{

//	1-L'ENTETE DU TABLEAU
	$resultat=$pdo->query("SELECT * FROM membre");
	$content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert-success">Liste des membres</h3>';

	$content .='Nombre de membre(s) inscrits dans la bdd "membre" : <span class="">' . $resultat->rowCount() . '</span></div>';

	$content .='<table class="col-md-10 table" style="margin-top: 10px;"><tr>';
		for($i=0; $i<$resultat->columnCount(); $i++)	
		{
			$colonne= $resultat->getColumnMeta($i);	
			$content .='<th>' . $colonne['name'] . '</th>';	
		}
		$content .='<th>' . 'Modifier' . '</th>';
		$content .='<th>' . 'Supprimer' . '</th>';
	$content .='</tr>';

	while($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
	{
		//debug($ligne);
		$content .= '<tr>';
		foreach($ligne as $indice => $valeur)
		{
			$content .= '<td>' . $valeur . '</td>';		
		}	
	/**/
	/***************************************************************************************************/


	$content .= '<td>' . '<a href="?action=modification&id_membre=' . $ligne['id_membre'] . '"><span class="glyphicon glyphicon-refresh">Modifier</span></a>' . '</td>';
	$content .='<td>' . '<a href="?action=suppression&id_membre=' . $ligne['id_membre'] . '" onclick="return(confirm(\'En êtes vous certain?\'));"><span class="glyphicon glyphicon-remove">Supprimer</span></a>' . '</td>';	// Attention aux parenthèses.
	$content .= '</tr>';
	}
	$content .= '</table>';
}	

//	FIN DU CONTENU DE TABLEAU

/**********************************************************************************************************************************************************************************************************/
	
require_once("../inc/header.inc.php");
echo $content;	//ATTENTION : Ne pas oublier de faire le ECHO de CONTENT pour afficher les msg d'erreur et autres textes


//-- FIN DE 'AFFICHAGE MEMBRE DANS TABLEAU' 


//-- FORMULAIRE D'ENREGISTREMENT MEMBRE: CREATION DU FORMULAIRE, VISUEL AU CLIC SUR 'Mettre à jour' 

if(isset($_GET['action']) && $_GET['action']=='modification' )
{

	if(isset($_GET['id_membre']))
	{
		//je recupere l'id de l'url et fais une requete pour recuperer toute la ligne correspondant à l'id que j'ai recu dans l'url
		$resultat=$pdo->prepare("SELECT * FROM membre WHERE id_membre= :id_membre");
		$resultat->bindValue(':id_membre',$_GET['id_membre'],PDO::PARAM_INT);
		$resultat->execute(); 	// ATTENTION: $resultat contient UN OBJET
		
		$membre_actuel=$resultat->fetch(PDO::FETCH_ASSOC);
		//debug($membre_actuel);
	}
	
	$id_membre = (isset($membre_actuel['id_membre'])) ? $membre_actuel['id_membre'] : ''; //si l'id produit est defini dans la BDD, alors on l'affiche sinon on affiche une chaine de caractere vide.
	// si l'user a cliqué sur le bouton modifier, cela entraine donc qu'on transporte dans l'url, (en plus de 'action')  le GET du id_produit. ainsi, la ligne ci-dessus teste:
	// (isset($membre_actuel['id_produit']))	: si j'arrive dans le formulaire apres avoir cliqué sur 'modifier' alors mon id_produit n'est pas vide; et il contient l'id du produit à modifier.
	// ? $membre_actuel['id_produit']      	: si tel est le cas, alors je rentre dans ma variable '$id_produit' la valeur de l'id importée  et contenue dans 'membre_actuel['id_produit']'
	// : ''										: autrement, cela signifie que l'user ne souhaite non pas faire une modif mais un ajout (car on ne transporte pas d 'Id_produit' dans notre url.) je demande donc que ma variable '$id_produit' prenne la valeur ''  
	
	//je fais pareil avec les autres champs:
	$pseudo = (isset($membre_actuel['pseudo'])) ? $membre_actuel['pseudo'] : '';
	$mdp = (isset($membre_actuel['mdp'])) ? $membre_actuel['mdp'] : '';
	$nom = (isset($membre_actuel['nom'])) ? $membre_actuel['nom'] : '';
	$prenom = (isset($membre_actuel['prenom'])) ? $membre_actuel['prenom'] : '';
	$email = (isset($membre_actuel['email'])) ? $membre_actuel['email'] : '';
	$civilite = (isset($membre_actuel['civilite'])) ? $membre_actuel['civilite'] : '';
	$ville = (isset($membre_actuel['ville'])) ? $membre_actuel['ville'] : '';
	$code_postal = (isset($membre_actuel['code_postal'])) ? $membre_actuel['code_postal'] : '';
	$adresse = (isset($membre_actuel['adresse'])) ? $membre_actuel['adresse'] : '';
	$status = (isset($membre_actuel['status'])) ? $membre_actuel['status'] : '';

	

	echo '<form method="post" action="" class="col-md-8 col-md-offset-2">
		<h1 class="alert alert-info text-center">'.ucfirst($_GET["action"]) .' produit</h1>		<!-- ucfirst est une fct qui met la premiere lettre en Majuscule. -->
		
		<input type="hidden" id="id_membre" name="id_membre" value="'. $id_membre .'">
		
	  <div class="form-group">
		<label for="pseudo">Pseudo</label>
		<input type="text" class="form-control" id="pseudo" placeholder="pseudo" name="pseudo" value="'. $pseudo .'" >
	  </div>
	  <div class="form-group">
		<label for="mdp">Mot de Passe</label>
		<input type="text" class="form-control" id="mdp" placeholder="mdp" name="mdp" value="'. $mdp .'" >
	  </div>
	  <div class="form-group">
		<label for="nom">Nom</label>
		<input type="text" class="form-control" id="nom" placeholder="nom" name="nom" value="'. $nom .'">
	  </div>
	  <div class="form-group">
		<label for="prenom">Prénom</label>
		<input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom" value="'. $prenom .'">
	  </div>
	  <div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" placeholder="email" name="email" value="'. $email .'">
	  </div>

	  <div class="form-group">
		<label for="civilite">Civilité</label>
		<select class="form-control" name="civilite" id="civilite">
			<option value="m"'; if($civilite=='m') echo 'selected'; echo '>Homme</option>
			<option value="f"'; if($civilite=='f') echo 'selected'; echo '>Femme</option>
		</select>
	  </div>
	  <div class="form-group">
		<label for="ville">Ville</label>
		<input type="text" class="form-control" id="ville" placeholder="ville" name="ville" value="'. $ville .'">
	  </div>	  
	  <div class="form-group">
		<label for="code_postal">Code Postal</label>
		<input type="text" class="form-control" id="code_postal" placeholder="code_postal" name="code_postal" value="'. $code_postal .'">
	  </div>
	  <div class="form-group">
		<label for="adresse">Adresse</label>
		<input type="text" class="form-control" id="adresse" placeholder="adresse" name="adresse" value="'. $adresse .'">
	  </div>
	  
	  <div class="form-group">
		<label for="status">Statut</label>
		<select class="form-control" name="status" id="status">
			<option value="0"'; if($status=='0') echo 'selected'; echo '>MEMBRE</option>
			<option value="1"'; if($status=='1') echo 'selected'; echo '>ADMINISTRATEUR</option>	
		</select>
	  </div>

	  <button type="submit" class="btn btn-primary col-md-12">'.ucfirst($_GET["action"]) .' membre</button>
	  
	</form>';
}

//-- FIN DE 'FORMULAIRE D'ENREGISTREMENT MEMBRE'

require_once("../inc/footer.inc.php");



?>
