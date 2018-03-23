<?php


class Autoload
{
	public static function inclusion_automatique($className){
		// $a = new Controller\ProduitController
		// require(__DIR__ . '/../src/Controller/ProduitController.php')
		// require(c://xampp/htdocs/PHPoo/13-framework/vendor/../src/Controller/ProduitController.php')
		
		// $b = new Manager\PDOManager 
		// require(__DIR__ . '/Manager/PDOManager.php')
		
		$tab = explode('\\', $className);
		
		// Manager\PDManager   -->vendor
		// Manager\application-->vendor
		// Manager\controle-->vendor
		// Manager\security-->vendor
		
		// Controller\ProduitController-->src
		// Controller\Membrecontroller-->src
		// Controller\commandecontroller-->src
		// Controller\controller-->src
		
		// Model\ProduitModel-->src
		// model\MembreModel-->src
		// ...-->src

		// ex d'use de str_replace
		// $phrase="bonjour tout le monde";
		// str_replacece('o','-',$phrase);--> "b-nj-ur t-ut le m-nde";
		
		
		if($tab[0] == 'Manager' || ($tab[0]=='Model' && $tab[1] == 'Model') || ($tab[0] == 'Controller' && $tab[1] == 'Controller')){	//($tab[0]=='Model' && $tab[1] == 'Model')  signifie: "si on est dans Manager\PDOManager  ou  si on est dans Model\Model"
		//on va chercher dans vendor:
			$path = __DIR__ . '/' . implode('/',$tab) . '.php';
			//$path = __DIR__ . '/Manager/PDOManager.php';
		}
		else{
		// on va chercher dans src:
			  $path = __DIR__ . '/../src/' . implode('/',$tab) . '.php';
			//$path = __DIR__ . '/../src/Controller/ProduitController.php';
		}
		//---------------------------------------
	//echo '<pre>Autoload : '.$className .'<br>';
	//echo '===>Require(' . $path .') </pre>';
		//---------------------------------------
		require $path;	
	}

	
}
//----------------------------
spl_autoload_register(Array('Autoload','inclusion_automatique'));
//----------------------------

/*
spl_autoload_register en POO attend 1 argument qui soit un ARRAY, avec LES VALEURS suivantes :
	1. Le nom de la classe
	2. Le nom de la méthode à exécuter (OBLIGATOIREMENT STATIC)
	
	Cela va faire çà:  Autoload::inclusion_automatique($className);      
	Cela est l'equivent des 2 lignes suivantes:       $a=new ...;    +     $a->...;

*/


