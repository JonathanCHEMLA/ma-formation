<?php
if($_POST)

{
echo '<pre>'; print_r($_POST); echo '</pre>';

foreach($_POST as $indice => $valeur)
{
	echo $indice. '=>'.$valeur.'<br>';
}

// on peut écrire dans un fichier créé dynamiquement:
// les fonctions prédéfinies suivantes permettent d'écrire dunamiquement dans un fichier: fopen(), fwite(), fclose().
// utiliser les sequences d'echappement & ATTENTION à le mettre entre "\r\n" et non entre '\r\n' ni inverser, en ecrivant: "\n\r"


$monfichier = fopen('fichier.txt', 'a');

fputs($monfichier, $_POST["pseudo"]. '-'. $_POST["email"]."\r\n");

fclose($monfichier);	//non obligatoire, mais en fermant notre fichier ca nous permet de libérer de la ressource et donc de libérer de la mémoire vive qui permet de faire tourner ton pc + vite.


}



?>