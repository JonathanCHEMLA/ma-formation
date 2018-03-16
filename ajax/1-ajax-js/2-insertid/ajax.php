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
$result->execute( array(
    ':personne' => $personne
));





