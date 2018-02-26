<?php
/*
	Exercice : 
	1 - Effectuer 4 liens HTML pointant sur la même page avec le nom des fruits
	2 - Faire en sorte d'envoyer "cerises" dans l'URL si l'on clic sur le lien "cerises", faire la même chose avec tout les fruits
	3 - Tenter d'afficher "cerises" sur la page web si l'on a cliqué dessus (si "cerises" est passé dans l'URL)
	4 - Envoyer l'information à la fonction déclarée "calcul()" afin d'afficher le prix pour 1kg de "cerises" 
*/
?>


<H1> Liens Fruits </h1>
<a href="?choix=bananes">bananes</a>	<!--ATTENTION: Ne pas oublier de mettre Toujours l'INDICE avec le get-->
<a href="?choix=cerises">cerises</a>
<a href="?choix=pommes">pommes</a>		<!--ATTENTION: A savoir: si on veut afficher les get sur la meme page, pas besoin de mettre 	LIENS.PHP?choix=pommes
<a href="?choix=peches">peches</a>


<?php
require_once("fonction.inc.php");
if(isset($_GET["choix"]))
{
	echo '<pre>'; print_r($_GET); echo '</pre>';			// Attention: print_r(ne pas y mettre de guillemets)
	echo 'Fruit récupéré : '. $_GET["choix"].'<br>';
	echo calcul($_GET["choix"],1000);
}


?>