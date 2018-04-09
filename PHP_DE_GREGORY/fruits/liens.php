<?php
/*
	Exercice : 
	1 - Effectuer 4 liens HTML pointant sur la même page avec le nom des fruits
	2 - Faire en sorte d'envoyer "cerises" dans l'URL si l'on clic sur le lien "cerises", faire la même chose avec tout les fruits
	3 - Tenter d'afficher "cerises" sur la page web si l'on a cliqué dessus (si "cerises" est passé dans l'URL)
	4 - Envoyer l'information à la fonction déclarée "calcul()" afin d'afficher le prix pour 1kg de "cerises"(pour tout les fruits) 
*/
require_once("fonction.inc.php");

if(isset($_GET['choix']))
{
	echo '<pre>'; print_r($_GET); echo '</pre>';
	echo 'Fruit recup : ' . $_GET['choix'] . '<br>';
	echo calcul($_GET['choix'], 1000);
}

?>
<h1>Liens fruits</h1>

<a href="?choix=cerises">cerises</a>
<a href="?choix=bananes">banane</a>
<a href="?choix=pommes">pomme</a>
<a href="?choix=peches">peche</a>