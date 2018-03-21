<?php

//require 'A.class.php';  // les use c'est quand on utilise des namespace
//require('B.class.php');	// on peut mettre ou non les () car c'est à la fois une instruction et une fonction
//require 'C.class.php';	// c'est pareil que echo.
//require('D.class.php');

//plutot que de  faire un require de chaque fichier, on va faire un require de notre autoload. Et c'est notre autoload qui va gerer les fichiers qu'il faut charger

require ('autoload.php');

$a = new A;
$b = new B;
$c = new C;
$d = new D;



