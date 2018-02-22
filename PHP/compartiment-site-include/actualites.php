<?php
require_once("inc/header.php");		// permet de ne l'inclure qu'une seule fois. Alors que require(....) peut inclure plusieurs fois le meme fichier.
require_once("inc/nav.php");


/*
require_once() && include_once() :
il n'y a aucune différence entre les deux, sauf... sauf en cas d'erreur sur le nom de fichier :
-include fait une erreur et continue l'exécution du script
-require fait une erreur et stope l'exécution du script

le once vérifie si le fichier a déjà été inclus, si c'est le cas, il ne le ré-inclut pas.
*/
//include_once("inc/na.php"); en cas d'erreur, comme c'est le cas ici (na au lieu de nav), avec include il affiche quand meme le reste. require_once n'affichera pas ce qui viend ensuite
?>

			<section>
			Voici le contenu de la page d'actualités<br>
			Voici le contenu de la page d'actualités<br>
			Voici le contenu de la page d'actualités<br>
			Voici le contenu de la page d'actualités<br>
			Voici le contenu de la page d'actualités<br>
			Voici le contenu de la page d'actualités<br>
			Voici le contenu de la page d'actualités<br>
			</section>

<?php
require_once("inc/footer.php");
?>