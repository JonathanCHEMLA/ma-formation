<h1>Votre langue :</h1>
<ul>
	<li><a href="?pays=fr">France</a></li>
	<li><a href="?pays=es">Espagne</a></li>
	<li><a href="?pays=an">Angleterre</a></li>
	<li><a href="?pays=it">Italie</a></li>
</ul>

<?php
if(isset($_GET['pays'])) // si un pays est passé dans l'url c'est que nous avons cliqué sur un lien
{
	$pays = $_GET['pays']; // on stock l'info dans une varaible
}
elseif(isset($_COOKIE['pays'])) // on ne rentre que dans le esleif uniquement si la condition if n'est pas passé et qu'un cookie existe
{
	$pays = $_COOKIE['pays'];
}
else // sinon , c'est la première visite sur le site
{
	$pays = 'fr';
}
// un cookie est sauvegardé sur le pc de l'internaute et on y mettra dexds informations d'importance mineur, des préférences, des tracesz de visite(ex : pour vous proposez des suggéstions de chemise dans le même modèle de la dernière chemise que vous avez regardé sur une boutique). Parce que la cookie est directement conservé sur le pc de l'internaute et qu'il peut se le faire voler, nous ne mettrons pas des informations comme son pseudo et son mot de passe.
//echo time();
$un_an = 365*24*3600; // cookie en seconde par an
setCookie("pays", $pays, time()+$un_an); // dans tout les cas un cookie est crée car ce morceau de code n'est pas dans une condition . setCookie() permet de créer un cookie . setCookie("nom", "valeur", "durrée de vie") 

switch($pays)
{
	case 'fr':
	echo 'Bonjour vous êtes sur un site en français';
	break;
	
	case 'es':
	echo 'Bonjour vous êtes sur un site en espagnol';
	break;
	
	case 'an':
	echo 'Bonjour vous êtes sur un site en angleterre';
	break;
	
	case 'it':
	echo 'Bonjour vous êtes sur un site en italien';
	break;
}



