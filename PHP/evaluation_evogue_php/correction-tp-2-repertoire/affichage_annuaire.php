<!DOCTYPE html>
<html>
<h1> Liste des entrées dans l'annuaire </h1>
<?php	
	$mysqli = new mysqli("localhost", "root", "", "tic_repertoire");
	$resultat = $mysqli->query("SELECT * FROM annuaire");
	$nbcol = $resultat->field_count;

	echo "<table style='border-color:red' border=10> <tr>";
	for ($i=0; $i < $nbcol; $i++)
	{
		$colonne = $resultat->fetch_field();
		echo '<th>' . $colonne->name . '</th>';
	}
	echo "</tr>";

	while ($ligne = $resultat->fetch_assoc())
	{
		echo '<tr>';
		foreach ($ligne as $information)
			echo '<td>' . $information . '</td>';
		echo '</tr>';
	}
	echo '</table>';

	$resultat_homme = $mysqli->query("select * from annuaire where sexe='m'");
	$resultat_femme = $mysqli->query("select * from annuaire where sexe='f'");
	 print "<br />il y a " . $resultat_homme->num_rows . " homme(s) et " . $resultat_femme->num_rows . " femme(s)";