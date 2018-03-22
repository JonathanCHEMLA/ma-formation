<h1>Les SESSIONS</h1>
<?php
session_start(); // permet de créer un fichier session ou de l'ouvrir si il existe déja
$_SESSION['pseudo'] = "Greg_formateur"; // la présence de crochets rappel l'utilisation de tableau ARRAY, dans le fichier session représenté par la surperglobal $_SESSION, on définit un indice 'pseudo' auquel on affecte la valeur de 'Greg_formateur'
$_SESSION['prenom'] = "Grégory";
$_SESSION['nom'] = "LACROIX";
//unset($_SESSION['nom']); // unset permet de vider une partie de la session

//session_destroy(); // permet de supprimer la session

echo '<pre>'; print_r($_SESSION); echo '</pre>';







