<!-- Exercice : dessiner au tableau l'objectif attendu -->
<h1> Formulaire Date de Naissance </h1>
<form method="POST" action="">
	<label for="jour">Jour</label>
	<select name="jour">
		<?php for($jour = 1; $jour <= 31; $jour++)
		{ 
			echo "<option>$jour</option>";
		} ?>
	</select>
	
	<label for="mois">Mois</label>
	<?php
	$tab_mois = array("janvier","fevrier","mars","avril","mai","juin","juillet","aout","septembre","octobre","novembre","decembre");
	echo '<select name="mois">';
	foreach($tab_mois as $element)
	{
		echo "<option>$element</option>";
	}
	echo '</select>';
	?>
	
	<label for="annee">Annee</label>
	<?php echo '<select name="annee">';
	for($annee = date("Y"); $annee >= 1930; $annee--)
	{
		echo "<option>$annee</option>";
	}
	echo '</select>';
	?>
	
	<input type="submit" id="envoi" value="envoi"/>
</form>