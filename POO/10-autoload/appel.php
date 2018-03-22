<?php
//L'idée c'est quoi?
//plutot que de  faire un require de chaque fichier, on va faire un require de notre autoload. Et c'est notre autoload qui va gerer les fichiers qu'il faut charger


// require 'A.class.php';// les use c'est quand on utilise des namespace
// require 'B.class.php';// on peut mettre ou non les () car c'est à la fois une instruction 
// require 'C.class.php';
// require 'D.class.php';// c'est pareil que echo.
//			|
//			|
//			V
			
require 'autoload.php';

$a = new Espace1\A; 
$b = new Espace1\B; 
$c = new Espace2\C; 
$d = new Espace2\D; 

 
	//2 choses:
 //1- les classes sont dans des fichiers différents du notre: --->require
 //2- les classes sont dans des (tiroirs) dossiers physiques différents du notre: ---> Espace1 et Espace2
 //3- 
 
 
 
 
 
 