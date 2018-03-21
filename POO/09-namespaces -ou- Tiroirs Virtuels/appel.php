<?php

namespace General;

//si on met la ligne ci-dessus, il me met le message d'erreur ci dessous, car je dois sortir du "tiroir virtuel pour pouvoir acceder au Global de PHP et entre autre à  $pdo=new PDO('mysql:host=localhost;dbname=entreprise','root','') :

//Fatal error: Uncaught Error: Class 'General\Espace1\A' not found in C:\xampp\htdocs\formateur\ma-formation\POO\09-namespaces\appel.php:10 Stack trace: #0 {main} thrown in C:\xampp\htdocs\formateur\ma-formation\POO\09-namespaces\appel.php on line 10

// la solution c'est soit de rajouter un "\" devant Espace1\A, ou devant PDO ... , soit d'utiliser:
use PDO;		//classe PDO
use Espace1;	// c'est un namespace dans lequel se trouve  la class A
use Espace2;	// c'est un namespace dans lequel se trouve  la class A


require('espace1.php');
require('espace2.php');	


$c = new Espace1\A;
echo $c-> test().'<hr>';
$d = new Espace2\A;
echo $d-> test2().'<hr>';





//erreur qui apparait si on ne met pas "namespace Espace1;" dans "espace1.php" :

//Fatal error: Cannot declare class A, because the name is already in use in C:\xampp\htdocs\formateur\ma-formation\POO\09-namespaces\espace2.php on line 3





//erreur qui apparait si on ne met pas "Espace1\" dans notre page "appel.php": 		$c = new Espace1\A;

//Fatal error: Uncaught Error: Class 'A' not found in C:\xampp\htdocs\formateur\ma-formation\POO\09-namespaces\appel.php:6 Stack trace: #0 {main} thrown in C:\xampp\htdocs\formateur\ma-formation\POO\09-namespaces\appel.php on line 6



/* Commentaires
	- Les namespaces sont incontournables dès lors qu'on travaille sur une application vaste et ORGANISEE
	- Les namespaces permettent de déclarer des espaces virtuels afin de mieux organiser nos fichiers, et aussi de mieux gérer le travail collaboratif (exemple le dev A peut créer une classe C dans son namespace pendant  que le dev B va créer également une class C dans son namespace...)
		
	Dès lors qu'on utilise les namespaces, quelques règles s'appliquent:
		- on instancie une class avec son nom complet: $a=new Espace1\A
		- Pour pouvoir utiliser les classes d'un autre namespace ou de l'espace GLOBAL de PHP (PDO par exemple), on doit au choix :
			-> Définir le chemin complet : $PDO =new \PDO
			-> Importer les classes  et namespaces avec l'instruction "use" (exemple: use PDO, Espace1, Espace2)
*/



/*
Pour me souvenir de ce cours:


Namespace Controller
	$membre = new Controller\Membre
	$membre = new Controller\produit
	$membre = new Controller\commande
	
namespace Model
	$membre = new Model\Membre
	$membre = new Model\Produit
	$membre = new Model\Pommande

	
VS



// ce qui est est utilisé par symfony:

namespace membre
	membre\controller
	membre\model
	
namespace produit
	produit\controller
	produit\model

namespce commande
	commande\controller
	commande\model

	
c'est une question de choix d'organisation de mes fichiers. Au meme titre que si je veux ranger mes photos: vais-je les trier par nom d'enfant? par annee de vacances? par age de l'enfant? ... c'est à nous de choisir le choix le plus judicieux
*/


