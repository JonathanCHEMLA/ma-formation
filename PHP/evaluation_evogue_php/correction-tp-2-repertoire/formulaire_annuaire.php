<?php
$mysqli = new mysqli("localhost", "root", "", "tic_repertoire"); 
if(isset($_POST['inscription']))
{	// --- recuperation des données
	foreach($_POST as $val => $elem){ echo $val . " : " . $elem . "<br />"; }
	$date_de_naissance =  $_POST['annee'] . "-" . $_POST['mois'] . "-" . $_POST['jour'];

	if(strlen($_POST['telephone']) < 10){ print "<div class='erreur'>n° de telephone mobile incorrect</div>"; }		
	if(strlen($_POST['nom']) < 2){ print "<div class='erreur'>nom trop court</div>"; }		
	if(strlen($_POST['prenom']) < 2){ print "<div class='erreur'>prenom trop court</div>"; }
	
	if(strlen($_POST['telephone']) == 10 && strlen($_POST['nom']) > 2 && strlen($_POST['prenom']) > 2)
	{
		$mysqli->query("insert into annuaire (nom,prenom,telephone,profession,ville,codepostal,adresse,date_de_naissance,sexe,description) 
								values ('$_POST[nom]', '$_POST[prenom]', '$_POST[telephone]', '$_POST[profession]', '$_POST[ville]', '$_POST[codepostal]', '$_POST[adresse]',  '$date_de_naissance', '$_POST[sexe]', '$_POST[description]')");
		print "<div class='succes'>Votre inscription à bien été enregistrée dans l'annuaire</div>";
	}
}
?>
<!DOCTYPE html>
<html>
<style>
label,select{  float: left; width: 100px; }
fieldset{ float: left; width: 220px; }
.submit{ clear:both; float: left; margin: 0 0 0 200px; }
.erreur{ background: #ff0000; }
.succes{ background: #669933; }
</style>
	<form method="post" action="">
		<fieldset>
			<legend>Informations</legend>
			<label for="nom">Nom *</label>
			<input type="text" id="nom" name="nom" /><br />
				
			<label for="prenom">Prénom *</label>
			<input type="text" id="prenom" name="prenom" /><br />

			<label for="telephone">Telephone *</label>
			<input type="text" id="telephone" name="telephone" maxlength="10" /><br />
				
			<label for="profession">Profession</label>
			<input type="text" id="profession" name="profession" maxlength="10" /><br />

			<label for="ville">Ville</label>
			<input type="text" id="ville" name="ville" /><br />
				
			<label for="codepostal">Code Postal</label>
			<input type="text" id="codepostal" name="codepostal" maxlength="5" /><br />
				
			<label for="adresse">Adresse</label>
			<textarea id="adresse" name="adresse" cols="16"></textarea>
		
			<legend>Informations supplémentaires</legend>
			<label>Date de Naissance</label><br /><br />
			<label for="jour">Jour</label>
						<select id="jour" name="jour">
							<?php for($i = 1; $i <= 31; $i++)
								{	
									if($i <= 9)
										echo '<option>0' .  $i . '</option>';
									else
										echo '<option>' .  $i . '</option>';
								}	?>
						</select><br />
			<label for="mois">Mois</label>
			<select id="mois" name="mois">
				<option value="01">Janvier</option>
				<option value="02">Février</option>
				<option value="03">Mars</option>
				<option value="04">Avril</option>
				<option value="05">Mai</option>
				<option value="06">Juin</option>
				<option value="07">Juillet</option>
				<option value="08">Aout</option>
				<option value="09">Septembre</option>
				<option value="10">Octobre</option>
				<option value="11">Novembre</option>
				<option value="12">Décembre</option>
			</select><br />
			<label for="annee">Annee</label>
			<select id="annee" name="annee">
				<?php for($i = date("Y"); $i >= 1930; $i--)
					{
						echo '<option>' .  $i . '</option>';
					}	?>
			</select><br /><br />
			<label for="sexe">Sexe</label><br />
			homme:<input type="radio" name="sexe" value="m" checked />
			femme: <input type="radio" name="sexe" value="f" /><br /><br />
			
			<label for="description">Description</label>
			<textarea id="description" name="description" rows="7" cols="25"></textarea>
			<input type="submit" name="inscription" value="inscription"/>
		</fieldset>
	</form>
</html>