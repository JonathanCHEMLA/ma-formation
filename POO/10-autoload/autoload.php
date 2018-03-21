<?php



	//methode d'autoload en procedural:

function inclusion_automatique($nom_de_classe){
	
	$tab = explode('\\',  $nom_de_classe);
	// 2entislash sont nécessaires car avec un seul c'est un caractere d' echappement
	$chemin_class = implode('/', $tab);
	
	require($chemin_class . '.class.php');
	// require A.class.php

	//-----
	echo 'On passe dans l\'autoload<br/>';
	echo 'L\'autoload fait : require(' . $chemin_class . '.class.php)<br/>';
}
	
	
}

//---------------------
spl_autoload_register('inclusion_automatique');
//---------------------
/*
Commentaires:
	spl_autoload_register() :
		c'est une fct super pratique!
		- son rôle c'est des se déclencher dès que le serveur voit passer un 'new'
		- cette fonction va éxécuter une fonction... La fonction que je lui ai passé en argument
		- spl va apporter à notre fonction, le(s) mot(s) qui se trouve(nt) après le mot 'new'
		ex concret: si je fais:  $a = new A;  spl déclenche automatiquement:  inclusion_automatique('A');
*/


//un namespace sera un dossier physique.

// bref: 	$a = new A; 	=> 		require("A.class.php");
// 		 	$a = new B; 	=> 		require("B.class.php");
// 		 	$a = new C; 	=> 		require("C.class.php");
// 			$a = new D; 	=> 		require("D.class.php");