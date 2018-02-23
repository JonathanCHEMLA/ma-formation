<?php
function calcul($fruit, $poids)
{
    switch($fruit)
    {
        case 'cerises': $prix_kg= 5.76; break;
        case 'bananes': $prix_kg= 1.09; break;
        case 'pommes': $prix_kg= 1.61; break; 
        case 'peches': $prix_kg= 3.23; break;            
        default: return "fruit inexistant";  // il sort completement et retourne dans le main         
    }
    $resultat= round(($poids*$prix_kg/1000),2); // prix au gramme
    return "Les " .$fruit . " coûtent " . $resultat . " Euros pour " . $poids . " grammes";
}
/*
echo calcul("cerises",2500)."<br>";
echo calcul("bananes",2000)."<br>";
echo calcul("peches",500)."<br>";
echo calcul("kiwis",500)."<br>";
echo calcul("pommes",1000)."<br>";
echo calcul("ananas",2000)."<br>";
*/