<?php 
if(isset($_POST['envoi']))
{
	print "nom: " . $_POST['nom'] . "<br />";
	print "prenom: " . $_POST['prenom'] . "<br />";
	print "adresse: " . $_POST['adresse'] . "<br />";
	print "ville: " . $_POST['ville'] . "<br />";
	print "cp: " . $_POST['cp'] . "<br />";
	print "sexe: " . $_POST['sexe'] . "<br />";
	print "description: " . $_POST['description'] . "<br />";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<style>label,select{float: left;width: 120px;}</style>
	</head>
	<body>
		<hr />
		<form method="post" action="">
			<label for="nom">Nom</label>
			<input type="text" id="nom" name="nom" /><br />

			<label for="prenom">Prenom</label>
			<input type="text" id="prenom" name="prenom" /><br />

			<label for="adresse">Adresse</label>
			<input type="text" id="adresse" name="adresse" /><br />

			<label for="ville">Ville</label>
			<input type="text" id="ville" name="ville" /><br />

			<label for="cp">Code Postal</label>
			<input type="text" id="cp" name="cp" /><br />

			<label for="sexe">sexe</label>
							<select name="sexe">
								<option value="m"/>Homme</option>
								<option value="f"/>Femme</option>
							</select><br /><br />
					
			<label for="description">Description</label>
			<textarea name="description" rows="8" cols="40" id="description"></textarea>
			<input type="submit" name="envoi" value="envoi" />
		</form>
	</body>
</html>