<?php
/*
Exercice : 
	1 - déclarer un tableau ARRAY avec tout les fruits
	2 - Déclarer un tableau ARRAY avec les poids suivants : 100, 500, 1000, 1500, 2000, 3000, 5000, 10000
	3 - Afficher les 2 tableaux
	4 - Sortir le fruit "cerises" et le poids 500 en passant par vos tableaux pour les transmettre à la fonction "calcul" et obtenir le prix
	5 - Sortir tous les prix pour les cerises avec tous les poids (indice : boucle)
	6 - Sortir tout les prix pour tout les fruits avec tout les poids (indice : boucle imbriquée)
	7 - Faire un affichage dans un tableau HTML pour une meilleur présentation
*/
require_once("fonction.inc.php");
// Réponse  1 :
$tab_fruits = array("cerises","pommes","peches","bananes");

// Réponse  2 :
$tab_poids = array(100,500,1000,1500,2000,3000,5000,10000);

// Réponse 3 : 
echo '<pre>'; print_r($tab_fruits); echo '</pre>';
echo '<pre>'; print_r($tab_poids); echo '</pre>';

// Réponse 4 :
echo calcul($tab_fruits[0], $tab_poids[1]) . '<hr>';

// Réponse 5 :
foreach($tab_poids as $indice => $valeur)
{
	echo calcul($tab_fruits[0], $valeur);
}
echo '<hr>';
 
// Réponse 6 : 
foreach($tab_poids as $poids)
{
	foreach($tab_fruits as $fruit)
	{
		echo calcul($fruit, $poids) . '<br>';
	}
	echo '<hr>';
}

// Réponse 7 :
echo "<table border=1><tr>";
echo "<th>Poids</th>";
foreach($tab_fruits as $indice_fruit => $fruit)
{
	echo "<th>$fruit</th>";
}
echo '</tr>';
foreach($tab_poids as $poids)
{
	echo '<tr>';
	echo "<th>$poids g</th>";
	foreach($tab_fruits as $fruit)
	{
		echo "<td>" . calcul($fruit, $poids) . "</td>";
	}
	echo '</tr>';
}
echo "</table>";
?>




