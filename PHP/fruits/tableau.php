<?php 
/* 
Exercice:
1 - Déclarer un tableau ARRAY avec tous les fruits
2 - Déclarer un tableau ARRAY avec les poids suivants: 100, 500, 1000, 1500, 2000, 3000, 5000, 10000
3 - Afficher les 2 tableaux
4 - Sortir le fruit "cerises" et le poids 500 en passant par vos tableaux pour les transmettre à la fonction "calcul" et obtenir le prix
5 - Sortir tous les prix pour les cerises avec tous les poids (indice : boucle)
6 - Sortir tous les prix pour tous les fruits avec tous les poids (indice: boucle imbriquée)
7 - Faire un affichage dans un tableau HTML pour une meilleure présentation
*/

//1
$tab_fruits=Array("pommes","peches","bananes","cerises");    // ATTENTION, ne pas oublier $ , les ""  ainsi que le mot Array
//2
$tab_poids=Array(100, 500, 1000, 1500, 2000, 3000, 5000, 10000);

//3
echo "<pre>"; print_r($tab_fruits); echo "</pre>";      // on aurait pu aussi utiliser implode(), foreach, join()
echo "<pre>"; print_r($tab_poids); echo "</pre>"; 
echo "<hr>";

require_once("fonction.inc.php");

//4

echo calcul($tab_fruits[3],$tab_poids[1])."<br>";

echo "<hr>";

//5
foreach($tab_poids as $valeur)
{
    echo calcul($tab_fruits[3],$valeur)."<br>";
}
echo "<hr>";


//6
foreach($tab_fruits as $mon_fruit)
{
    foreach($tab_poids as $mon_poids)
    {
        echo calcul($mon_fruit,$mon_poids)."<br>";
    }
}

echo "Voici mon prix:".$resultat;

//7
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr><th><center>Fruit</center></th><th>Poids en grammes</th><th><center>Cout</center></th></tr>";


foreach($tab_fruits as $mon_fruit)
{
    foreach($tab_poids as $mon_poids)
    {
        echo "<tr><td>".$mon_fruit."</td><td>".$mon_poids."</td><td>".calcul($mon_fruit,$mon_poids)."</td></tr>";
    }
}
echo "</table>";


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