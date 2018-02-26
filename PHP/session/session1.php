<h1>Les sessions </h1>

<?php
session_start();        //permet de créer un fichier session ou de l'ouvrir s'il existe déjà.   // pour voir la session créer aller dans c:, xampp, tmp.

$_SESSION['pseudo']="Greg formateur";   // On definit un indice 'pseudo' auquel on affecte la valeur de 'Greg formateur'
$_SESSION['nom']="LACROIX";
$_SESSION['prenom']="Grégory";




// A savoir: toutes les superglobales sont de type ARRAY

// dans le fichier tmp on obtient un fichier contenant:
//  pseudo|s:14:"Greg formateur";nom|s:7:"LACROIX";prenom|s:8:"Grégory";           où "s:14" signifie qu'il s'agit d'une chaine de caractere contenant 14 caracteres


unset($_SESSION["nom"]);    //pour supprimer une partie de la session

session_destroy();          //permet de supprimer la session

echo '<pre>'; print_r($_SESSION); echo '</pre>';

// quand je cree une session , un cookie est cree egalemeznt. c'est de la session