<?php

namespace manager;

final class Application
{
	protected $controller;	//le controller a instancier
	protected $action;		// l'action à lancer
	protected $argument = '';	//l'argument s'il y en a un
	
	public function __construct(){	//on scan l'URL
		$tab=explode('/',$_SERVER['REQUEST_URI']);	//Affiche (SANS le explode) :  /formateur/ma-formation/POO/13-Framework/web/produit/afficheall
			
		//Affiche, (AVEC le explode):
		/*
		Array
		(
			[0] => 
			[1] => formateur
			[2] => ma-formation
			[3] => POO
			[4] => 13-Framework
			[5] => web
			[6] => produit
			[7] => afficheall
		)
		*/
		// echo '<pre>';
		// print_r($tab);
		// echo '</pre>';			
		if(isset($tab[6]) && !empty($tab[6]) && file_exists(__DIR__ . '/../../src/Controller/'.ucfirst($tab[6]).'Controller.php')){
			//s'il y a un controller xxxxx dans l'url, et qu le fichier  xxxxxController.php existe
			
			$this->controller = 'Controller\\' .ucfirst($tab[6]) . 'Controller';
		}
		else{
			//Sinon, par défaut, je lance le ProduitController (pour afficher la home par defaut)
			$this-> controller = 'Controller\ProduitController';
		}
		
		if(isset($tab[7]) && !empty($tab[7])){
			$this->action = $tab[7];
		}
		else{
			$this->controller = 'Controller\ProduitController';
			$this->action = 'afficheAll';
		}
		//---------------------------------------------------
		if(isset($tab[8])  && !empty($tab[8])){
			$this->argument = $tab[8];
		}
	

	}
	
	
	public function run(){	// Lance les instanciations. bref, lance l'application
		if (!is_null($this->controller)){
			$a = new $this-> controller;		// $a est, par ex: un objet de la classe 	"ProduitController"
	// L'instanciation d'un controller crée automatiquement l'instanciation	d'un Model: 	"ProduitModel"
	// ce Model sera contenu dans la variable $model et sera appelé ensuite grace à getModel().

			
			if(!is_null($this->action) && method_exists($a,$this->action) ){
				$action = $this->action;		// $action va récupérer l'action souhaitée par l'user
				$a->$action($this->argument);	// cette ligne va déclencher par ex la fonction: 	"affiche(5)"
				//$a
			}
		}
		else{
			require __DIR__ . '/../../src/View/404.html';
		}
		
		
		
	}
	
}