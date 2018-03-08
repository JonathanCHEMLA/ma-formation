<?php
function operation()
{
	switch($_POST['operateur'])
	{
		case 'addition': $resultat = $_POST['valeur1'] + $_POST['valeur2']; break;
		case 'soustraction': $resultat = $_POST['valeur1'] - $_POST['valeur2']; break;
		case 'multiplication': $resultat = $_POST['valeur1'] * $_POST['valeur2']; break;
		case 'division' && $_POST['valeur2'] != 0: $resultat = $_POST['valeur1'] / $_POST['valeur2']; break;
	}
	return $resultat;
}
if(!empty($_POST))
{
	echo 'Resultat : ' . operation() . '<hr />';
}
?>
<form action="" method="post">
	<input type="text" name="valeur1" placeholder="valeur1">
	<select name="operateur">
		<option value="addition">+</option>
		<option value="soustraction">-</option>
		<option value="multiplication">*</option>
		<option value="division">/</option>
	</select>
	<input type="text" name="valeur2" placeholder="valeur2">
	<input type="submit" value="Calculer">
</form>