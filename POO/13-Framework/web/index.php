<?php
session_start();

require __DIR__ .'/../vendor/autoload.php';

//TEST 1: Entity :
// $produit = new Entity\Produit;
// $produit->setTitre('Mon super produit');
// echo $produit ->getTitre();

// $membre = new Entity\Membre;
// $membre->setPseudo('Yakine');
// echo $membre ->getPseudo();

// $commande = new Entity\Commande;
// $commande->setId_commande('5');
// echo $commande ->getId_commande();

/*
Affiche:
Autoload : Entity\Produit
===>Require(C:\xampp\htdocs\formateur\ma-formation\POO\13-Framework\vendor/../src/Entity/Produit.php) 
Mon super produit
Autoload : Entity\Membre
===>Require(C:\xampp\htdocs\formateur\ma-formation\POO\13-Framework\vendor/../src/Entity/Membre.php) 
Yakine
Autoload : Entity\Commande
===>Require(C:\xampp\htdocs\formateur\ma-formation\POO\13-Framework\vendor/../src/Entity/Commande.php) 
5
*/



//TEST 2: PDOManager :
//je creer l'obj unique de pdo manager:
// $pdom = Manager\PDOManager::getInstance();	// c'est comme ca qu'on recupere l'objet d'un singleton
// $pdo = $pdom->getPdo();
// $resultat = $pdo -> query("SELECT * FROM produit");
// $produits= $resultat-> fetchAll();

// echo '<pre>';
// print_r($produits);
// echo '</pre>';

/*
Affiche:

Autoload : Manager\PDOManager
===>Require(C:\xampp\htdocs\formateur\ma-formation\POO\13-Framework\vendor/Manager/PDOManager.php) 

Array
(
    [0] => Array
        (
            [id_produit] => 3
            [reference] => 4578
            [categorie] => sdfdsaaa
            [titre] => roule ma poule
            [description] => fsdfgsdfgvsdfg
            [couleur] => 
            [taille] => L
            [public] => m
            [photo] => captain-america.jpg
            [prix] => 14254
            [stock] => 78
        )

    [1] => Array
        (
            [id_produit] => 4
            [reference] => 78
            [categorie] => dgfhdfg
            [titre] => dfgd
            [description] => fgdffg
            [couleur] => 
            [taille] => S
            [public] => m
            [photo] => irish.jpg
            [prix] => 54
            [stock] => 668
        )
		
		...
)
*/


//TEST 3: Model :
//Attention: pour tester la classe Model, nous avons d^u forcer la fonction getTableName() à nous retourner un nom de table. Après les tests, nous devons rétablir le traitement orignal de la fonction.

$model = new Model\Model;
$produit = $model->find(3);
$produits = $model->findAll();

echo '<pre>';
print_r($produits);
print_r($produit);
echo '</pre>';

