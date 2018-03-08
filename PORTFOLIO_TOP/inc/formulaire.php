<?php

if($_POST)
{	
	if(isset($_POST["message"]) and isset($_POST["email"]) and !empty($_POST["message"])and !empty($_POST["email"]) )
	{
/*---------------ENVOI DU MESSAGE-------------------------*/


	$_POST["email"] = "From: $_POST[email] \r\n";
	$_POST["email"] .= "MIME-Version: 1.0 \r\n";	
	$_POST["email"] .="Content-type: text/html; charset=utf-8 \r\n";	

	$_POST["message"]     =     "Nom: " . $_POST["nom"]. "\nPrénom : " . $_POST["prenom"] . "\nSociété : " . $_POST["societe"] . "\nMessage : " .$_POST["message"];

	$email="jonathanchemla55@gmail.com";
	 mail($email,$_POST["sujet"],$_POST["message"],$_POST["email"]);

	// mail( qui va recevoir le message ? , objet ? , message ? , qui envoie le message ? );
//*--------------FIN D ENVOI DU MESSAGE--------------------*/

//*--------------ENREGISTREMENT DU MESSAGE-----------------*/	

		$insert_membre = $pdo->prepare('INSERT INTO formulaire (nom, prenom, societe, civilite, email, sujet, message, date_enregistrement) VALUES(:nom,:prenom, :societe, :civilite,:email,:sujet,:message, NOW())');	
		// ATTENTION: dans Insert into, ne PAS OUBLIER de fermer les ''  !!!

		$insert_membre->bindValue(':nom', $_POST["nom"], PDO::PARAM_STR);
		$insert_membre->bindValue(':prenom', $_POST["prenom"], PDO::PARAM_STR);
		$insert_membre->bindValue(':societe', $_POST["societe"], PDO::PARAM_STR);
		$insert_membre->bindValue(':civilite', $_POST["civilite"], PDO::PARAM_STR);		
		$insert_membre->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
			$insert_membre->bindValue(':sujet', $_POST["sujet"], PDO::PARAM_STR);
			$insert_membre->bindValue(':message', $_POST["message"], PDO::PARAM_STR);
			//$insert_membre->bindValue(':date_enregistrement', NOW(), PDO::PARAM_STR);

		$insert_membre->execute();
		
		$content .= '<div class="alert alert-success col-md-12 text-center mt-4">Vous message a bien été transmis. </div>';	
	}
	else
	{
		$content .= '<div class="alert alert-danger col-md-12 text-center mt-4">Les champs \'Email\' et \'Message\' sont requis !!!</div>';			
	}
}
/*----------------FIN D ENREGISTREMENT---------------------*/

echo $content;	//au premier chargement de la page, on ne rentre pas dans le if donc si on avait fait ici: echo $erreur il y aurait eu un msg d'erreur.

?>

<!-- Réaliser un formulaire d'inscription correspondant à la table membre de la BDD (sans les champs id_membre, status) -->
<h1 class="alert alert-info col-md-12 text-center mt-4">Formulaire de contact</h1>

<form method="post" action="index.php#contact">
<div  class="formulaire flex-row d-flex flex-wrap">
	<div class="col-md-6">	
		
		<div class="form-group">
		<label for="civilite">Civilité</label>
		<select class="form-control" name="civilite" id="civilite">
			<option value="m">Homme</option>
			<option value="f">Femme</option>
		</select>
	  </div>
		<div class="form-group">
		<label for="nom">Nom</label>
		<input type="text" class="form-control" id="nom" placeholder="nom" name="nom">
	  </div>
		<div class="form-group">
		<label for="prenom">Prénom</label>
		<input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom">
	  </div>
	  <div class="form-group">
		<label for="societe">Société</label>
		<input type="text" class="form-control" id="societe" placeholder="societe" name="societe">
	  </div>
	 </div> 
	<div class="col-md-6"> 
		<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" placeholder="email" name="email">
	  </div>
	 
		 <div class="form-group">
		<label for="sujet" class="col-md-12">Objet du message</label>
		<input type="text" class="form-control" id="sujet" placeholder="sujet" name="sujet">
	  </div>
		  <div class="form-group">
		<label for="message">Message</label>
		<textarea placeholder="votre message ici" class="form-control" id="message" name="message"></textarea><br><br>
	  </div>
	</div>
	<div class="col-md-12">
	  <button type="submit" class="btn btn-primary col-md-12">Inscription</button>
	</div>  
</div>
</form>


	