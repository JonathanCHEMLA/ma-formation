<?php
// lorsqu'on teste le var_dump,si c'est pas dans le corps de notre page html, 
//ce n'est pas la peine de l'entourer des balises echo "<pre>";
//var_dump($_POST);

require_once("init.php");
extract($_POST);

/*
Ex: 
si on a: 

$_POST (
    'nom' => 'Leclercq',
    'prenom' =>'Fred'
)

conséquence du extract($_POST), il va generer automatiquement: 'prenom' -->$prenom
$nom="Leclercq"
$prenom =>"Fred"
*/

$result = $pdo->prepare("INSERT INTO employes (prenom) VALUES (:personne)");


if($result->execute( array(
    ':personne' => $personne
)))
{
    $tab['validation']='ok';
    echo json_encode($tab); // le echo est rempli d'un objet JSON qui contient validation:ok.  Donc au final, on renvoie { 'validation':'ok' }
}   // c'est un echo qu'on utilise et pas un return car nous ne sommes pas dan sune fonction.





