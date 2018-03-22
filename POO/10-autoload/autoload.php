<?php

 
	//methode d'autoload en procedural: 
 
function inclusion_automatique($nom_de_classe){
	
	$tab = explode('\\',  $nom_de_classe);							
	// 2entislash sont nécessaires pour diff avec " \' ", afin d'EVITER l'échapemment
	$chemin_class = implode('/', $tab);
	
	require($chemin_class . '.class.php');
	// require A.class.php

	//-----
	echo 'On passe dans l\'autoload<br/>';
	echo 'L\'autoload fait : require(' . $chemin_class . '.class.php)<br/>';
}

//---------------------
spl_autoload_register('inclusion_automatique');
//---------------------
/*
Commentaires : 
	spl_autoload_register() :
		- c'est une fonction super pratique! Son rôle est de s'exécuter dès que le serveur voit passer un 'new'
		- Cette fonction (spl) va exécuter une fonction... La fonction(inclusion_automatique) que je lui ai passé en argument
		- SPL va apporter à notre fonction, le(s) mot(s) qui se trouve(nt) après le mot 'new'
		
		Concrètement : 
		On lance : $a = new A;
		spl_autoload_register lance : inclusion_automatique('A');
*/

//un namespace sera un dossier physique.

// bref: 	$a = new A; 	=> 		require("A.class.php");
// 		 	$a = new B; 	=> 		require("B.class.php");
// 		 	$a = new C; 	=> 		require("C.class.php");
// 			$a = new D; 	=> 		require("D.class.php");


