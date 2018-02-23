<!---->
<?php
echo "<pre>";print_r($_GET);echo "</pre>";

// afficher les données pour chaque produit avec un affichage conventionnel


if($_GET)
{
    echo '<h1>Voici le détail du produit n° '. $_GET['id_produit'] . '</h1>';

    foreach($_GET as $indice => $valeur)
    {
       
        if($indice!="id_produit")
        {
        echo $indice . " - " . $valeur. "<br>";
        }
    }
    
// Afin de ne pas avoir l'id produit à l'affichage    
}