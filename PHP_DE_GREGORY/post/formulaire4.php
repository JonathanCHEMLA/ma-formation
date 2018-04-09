<?php
if($_POST)
{
	echo '<pre>'; print_r($_POST); echo '</pre>';

	foreach($_POST as $indice => $valeur)
	{
		echo $indice . ' : ' . $valeur . "<br>"; 
	}

	// écriture dans un fichier crée dynamiquement :
	// les fonctions prédéfinies suivantes permeettent d'ecrire dynamiquement dans un fichier : fopen(), fwrite(), fclose()

	$fichier = fopen("liste.txt", "a");
		fwrite($fichier, $_POST['pseudo'] . ' - ' . $_POST['email'] . "\r\n");
		fclose($fichier);
}
?>