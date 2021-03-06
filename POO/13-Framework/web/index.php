<?php
session_start();
// on fait appel à notre AUTOLOAD:* 
require __DIR__ .'/../vendor/autoload.php';	//"index.php est fils de web, et web et vendor sont des dossiers freres."
	//Astuce: traduire '/' par 'puis, je vais dans...'

$a = new Manager\Application;
$a->run();	
	
//	/produit/afficheall
//	/produit/boutique/ETE
//  /produit/affiche/10	
	
	
	
	
	
	
	
	
	
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
//---------------------------------------------------------------------------------------------------------------------------


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
//---------------------------------------------------------------------------------------------------------------------------

//TEST 3: Model :
//Attention: pour tester la classe Model, nous avons dû forcer la fonction getTableName() ... à nous retourner un nom de table. Après les tests, nous devons rétablir le traitement orignal de la fonction.

// $model = new Model\Model;
// $produit = $model->find(3);	// à part $produit, on testera aussi les membre et cde, en remplacant dans ... ligne...
// $produits = $model->findAll();

// echo '<pre>';
// print_r($produits);
// print_r($produit);
// echo '</pre>';

/*
affiche:

Autoload : Model\Model
===>Require(C:\wamp64\www\WF3\ma-formation\POO\13-Framework\vendor/Model/Model.php) 
Autoload : Manager\PDOManager
===>Require(C:\wamp64\www\WF3\ma-formation\POO\13-Framework\vendor/Manager/PDOManager.php) 
Autoload : Entity\produit
===>Require(C:\wamp64\www\WF3\ma-formation\POO\13-Framework\vendor/../src/Entity/produit.php) 
Array
(
    [0] => Entity\Produit Object
        (
            [id_produit:Entity\Produit:private] => 3
            [reference:Entity\Produit:private] => 4578
            [categorie:Entity\Produit:private] => sdfdsaaa
            [titre:Entity\Produit:private] => roule ma poule
            [description:Entity\Produit:private] => fsdfgsdfgvsdfg
            [couleur:Entity\Produit:private] => 
            [taille:Entity\Produit:private] => L
            [public:Entity\Produit:private] => m
            [photo:Entity\Produit:private] => 4578-pic-3.jpg
            [prix:Entity\Produit:private] => 14254
            [stock:Entity\Produit:private] => 78
        )

    [1] => Entity\Produit Object
        (
            [id_produit:Entity\Produit:private] => 4
            [reference:Entity\Produit:private] => 78
            [categorie:Entity\Produit:private] => dgfhdfg
            [titre:Entity\Produit:private] => dfgd
            [description:Entity\Produit:private] => fgdffg
            [couleur:Entity\Produit:private] => 
            [taille:Entity\Produit:private] => S
            [public:Entity\Produit:private] => m
            [photo:Entity\Produit:private] => 78-pic-3.jpg
            [prix:Entity\Produit:private] => 54
            [stock:Entity\Produit:private] => 668
        )
	...
	)
Entity\Produit Object
(
    [id_produit:Entity\Produit:private] => 3
    [reference:Entity\Produit:private] => 4578
    [categorie:Entity\Produit:private] => sdfdsaaa
    [titre:Entity\Produit:private] => roule ma poule
    [description:Entity\Produit:private] => fsdfgsdfgvsdfg
    [couleur:Entity\Produit:private] => 
    [taille:Entity\Produit:private] => L
    [public:Entity\Produit:private] => m
    [photo:Entity\Produit:private] => 4578-pic-3.jpg
    [prix:Entity\Produit:private] => 14254
    [stock:Entity\Produit:private] => 78
)
*/

//---------------------------------------------------------------------------------------------------------------------------
//TEST 4 : ProduitModel
// $pm= new Model\ProduitModel;

// echo '<pre>';
// print_r($pm -> getAllProduit());
// print_r($pm -> getProduitById(10));
// print_r($pm -> getAllCategorie());
// print_r($pm -> getAllProduitByCategorie('ETE'));
// echo '</pre>';

/*
Affiche:

Autoload : Model\ProduitModel
===>Require(C:\xampp\htdocs\formateur\ma-formation\POO\13-Framework\vendor/../src/Model/ProduitModel.php) 
Autoload : Model\Model
===>Require(C:\xampp\htdocs\formateur\ma-formation\POO\13-Framework\vendor/Model/Model.php) 
Autoload : Manager\PDOManager
===>Require(C:\xampp\htdocs\formateur\ma-formation\POO\13-Framework\vendor/Manager/PDOManager.php) 
Autoload : Entity\produit
===>Require(C:\xampp\htdocs\formateur\ma-formation\POO\13-Framework\vendor/../src/Entity/produit.php) 
Array
(
    [0] => Entity\Produit Object
        (
            [id_produit:Entity\Produit:private] => 3
            [reference:Entity\Produit:private] => 4578
            [categorie:Entity\Produit:private] => sdfdsaaa
            [titre:Entity\Produit:private] => roule ma poule
            [description:Entity\Produit:private] => fsdfgsdfgvsdfg
            [couleur:Entity\Produit:private] => 
            [taille:Entity\Produit:private] => L
            [public:Entity\Produit:private] => m
            [photo:Entity\Produit:private] => captain-america.jpg
            [prix:Entity\Produit:private] => 14254
            [stock:Entity\Produit:private] => 78
        )

	...
		
    [4] => Entity\Produit Object
        (
            [id_produit:Entity\Produit:private] => 10
            [reference:Entity\Produit:private] => 12-az-45
            [categorie:Entity\Produit:private] => eee
            [titre:Entity\Produit:private] => eee
            [description:Entity\Produit:private] => eee
            [couleur:Entity\Produit:private] => 
            [taille:Entity\Produit:private] => S
            [public:Entity\Produit:private] => m
            [photo:Entity\Produit:private] => football.jpg
            [prix:Entity\Produit:private] => 450
            [stock:Entity\Produit:private] => 448
        )
	...

)
Entity\Produit Object
(
    [id_produit:Entity\Produit:private] => 10
    [reference:Entity\Produit:private] => 12-az-45
    [categorie:Entity\Produit:private] => eee
    [titre:Entity\Produit:private] => eee
    [description:Entity\Produit:private] => eee
    [couleur:Entity\Produit:private] => 
    [taille:Entity\Produit:private] => S
    [public:Entity\Produit:private] => m
    [photo:Entity\Produit:private] => football.jpg
    [prix:Entity\Produit:private] => 450
    [stock:Entity\Produit:private] => 448
)
Array
(
    [0] => Array
        (
            [categorie] => sdfdsaaa
        )

	...
    [7] => Array
        (
            [categorie] => ETE
        )

)
Array
(
    [0] => Entity\Produit Object
        (
            [id_produit:Entity\Produit:private] => 13
            [reference:Entity\Produit:private] => 12-az-49
            [categorie:Entity\Produit:private] => ETE
            [titre:Entity\Produit:private] => chemise longue
            [description:Entity\Produit:private] => ma description
            [couleur:Entity\Produit:private] => bleu
            [taille:Entity\Produit:private] => L
            [public:Entity\Produit:private] => m
            [photo:Entity\Produit:private] => captain-america.jpg
            [prix:Entity\Produit:private] => 20
            [stock:Entity\Produit:private] => 8
        )
)

*/
//---------------------------------------------------------------------------------------------------------------------------

//TEST 5 : ProduitController
// $pc=new Controller\ProduitController;	//  Controller\ est ajouté car ProduitController est dans le namespace Controller
// $pc->afficheAll();

/*
Affiche:le site avec tous les produits de toutes les categ du site.

*/

//---------------------------------------------------------------------------------------------------------------------------

//TEST 5.2
// $pc=new Controller\ProduitController;
// $pc->boutique('ETE');
/*
Affiche:le site avec tous les produits de la categorie 'ETE'

*/
//---------------------------------------------------------------------------------------------------------------------------


//TEST 5.3
// $pc=new Controller\ProduitController;
// $pc->affiche(10);
//---------------------------------------------------------------------------------------------------------------------------

//TEST 6 :
//index.php?controller=produit&action=afficheall
//index.php?controller=produit&action=boutique&arg=ETE
//index.php?controller=produit&action=affiche&arg=10


// $controller = 'Controller\\' . $_GET['controller'] . 'Controller';
// $action = $_GET['action'];

// if(isset($_GET['arg'])){
	// $arg=$_GET['arg'];
// }
// else{
	// $arg='';
// }


// $a=new $controller;
// $a->$action($arg);

///////////////////////////////////////////////////////////////////////////

//ré-écriture d'URL :
///produit/affiche/10

//routing :
///toto/tata/10 ======> produit/affiche/10

