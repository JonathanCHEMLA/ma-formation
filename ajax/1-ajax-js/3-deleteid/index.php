<!DOCTYPE html> <!-- taper ! puis entrée -->
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX DELETE ID</title>
</head>
<body>
	<form method="post" action="#">
		<div id="employes">
			<select id="personne" name="personne">
				<?php 
				
				require_once('init.php');
				$result=$pdo->query("SELECT *FROM employes");
				//a chaque tour de boucle on lit les resultats de ma requete
				while( $employe= $result->fetch(PDO::FETCH_ASSOC) ){
				?>
				
				<option value="<?=$employe['id_employes']?>"><?=$employe['prenom']?></option>
				
				<?php
				}
				?>
			</select>
		</div>
		<input type="submit" value="Supprimer" id="submit">
	</form>
	<div id="resultat"></div>
    <script src="ajax.js"></script>
</body>
</html>