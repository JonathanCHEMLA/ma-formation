<?php 


$nom_fichier="fichier.txt";
$fichier=file($nom_fichier); // la fonction file() fait tout le travail:
// c'est elle qui retourne chaque ligne d'un fichier à des indices différents d'un tableau ARRAY

//Afficher les données du tableau ARRAY, représenté pr $fichier à l'aide d'une boucle

foreach($fichier as $indice => $valeur)
{
    echo $indice." - ".$valeur."<br>";
}

echo '<pre>'; print_r($fichier); echo '<pre>'; 
/*
voici ce qui s'affiche:

Array
(
    [0] => jonathan-jonathanchemla55@gmail.com
    [1] => ccvxxc-jonathanchemla55@gmail.com
    [2] => membre-membre@gmail.com
    [3] => Adnane-Adnane@gmail.com
    [4] => Quentin-quentin@gmail.com
    [5] => Vincent-vincent@gmail.com
    [6] => Hana-hana@gmail.com
    [7] => Nicolas-nicolas@gmail.com
    [8] => grégory-gregory@gmail.com
    [9] => Andrei-andrei@gmail.com

)
*/
