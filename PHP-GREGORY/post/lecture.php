<?php
$nom_fichier = 'liste.txt';
$fichier = file($nom_fichier); // la fonction file() fait tout le travail, elle retourne chaque ligne d'un fichier à des indices différents d'un tableau ARRAY

echo '<pre>'; print_r($fichier); echo '</pre><hr>';
// afficher les données du tableau ARRAY representé par $fichier à l'aide d'une boucle
foreach($fichier as $informations)
{
	echo $informations . "<br>";
}


