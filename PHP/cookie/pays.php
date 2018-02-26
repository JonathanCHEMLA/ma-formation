<?php /*cookies : informations PAS importantes, memorisees cote cient. c'est par exemple lorsque je sors d'une page et vais sur un autre site et retrouve les produits consultes sur le site precedent*/ ?>

<h1>Votre langue :</h1>
<ul> 
    <li><a href="?pays=fr">France</a></li>
    <li><a href="?pays=es">Espagne</a></li>
    <li><a href="?pays=an">Angleterre</a></li>
    <li><a href="?pays=it">Italie</a></li>
</ul>

<?php
if(isset($_GET["pays"]))    //si un pays est passé dans l'url, c'est que nous avons cliqué sur un lien
{
    $pays = $_GET["pays"];  // on stocke l'info dans une variable
}
elseif(isset($_COOKIE["pays"])) // on ne rentre dans le elseif que si la cdtion if n'est pas passée et qu'un cookie existe(donc je suis deja venu, par ex, 15jours + tot et j'avais cliqué sur ce lien)
{
    $pays= $_COOKIE['pays'];
}
else                         // sinon, c'est notre première visite sur le site.
{
    $pays ='fr'; // ce cas là correspond à la première fois que j'arrive sur cette page. Il n'a donc pas encore choisi sa langue. En attendant, il faut bien qu'il y ait une langue par defaut.
}
// un cookie est sauveg rdé sur le pc de l'internaute et on y mettra des informations d'importance mineure, des préférences, des traces de visite 
//(ex: pour vous proposer des suggestions de chemises dans le même modèle de la derniere chemise que vous avez regardé sur une boutique).
// parceque le cookie est directement conservé sur le pc de l'internaute et qu'il peut se le faire voler, nous ne mettrons pas des info comme son pseudo et son mot de passe.

// Pour info: Dans Adwards le retargettting s'appelle une campagne de REMARKETING, c'est pareil.
//echo time();

$un_an=365*24*3600; // cookie en secondes par an
setcookie("pays",$pays,time()+$un_an);  // Nom=nomquejedonneamoncookie,Valeur=languechoisie,Temps=durée
//dans tous les cas, un cookie est créé car ce morceau de code n'est pas dans une condition.
//setcookie() permet de créer un cookie. setcookie("nom","valeur","durée de vie")


switch($pays)
{
    case 'fr':
    echo 'Bonjour vous êtes sur un site en francais';
    break;
    case 'es':
    echo 'Bonjour vous êtes sur un site en espagnol';
    break;    
    case 'an':
    echo 'Bonjour vous êtes sur un site en anglais';
    break;
    case 'it':
    echo 'Bonjour vous êtes sur un site en italien';
}
