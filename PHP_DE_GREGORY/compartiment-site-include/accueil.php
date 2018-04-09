<?php
require_once("inc/header.php");
require_once("inc/nav.php");

/*
require_once() && include_once() :
Il n'y a aucune différence entre les deux sauf.... sauf en cas d'erreur sur le nom du fichier :
 - include fait une erreur et continue l'execution du script
 - require fait une erreur et stop l'execution du script

le once vérifie si le fichier à déja été inclus, si c'est le cas, il ne le ré-inclut pas.
*/
?>
		
	<section>
		Voici le contenu de la page d'accueil<br>
		Voici le contenu de la page d'accueil<br>
		Voici le contenu de la page d'accueil<br>
		Voici le contenu de la page d'accueil<br>
		Voici le contenu de la page d'accueil<br>
	</section>
			
<?php
require_once("inc/footer.php");
?>