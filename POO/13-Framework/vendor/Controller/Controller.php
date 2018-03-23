<?php 

namespace Controller;

use Model;	// on utilise ce qu'il y a dans le namespace Model

Class Controller
{
	protected $model;	// Contiendra le nom du model à instancier (ProduitModel si je sui sdans ProduitController, MembreModel si je suis dans MembreController)
	
	public function __construct(){
		$class= 'Model\\' . str_replace(array('Controller\\','Controller'),'',get_Called_Class()) .'Model';
		
		// Exemple : Si je suis dans Controller\ProduitController
		// Je retire 'Controller\' et 'Controller', il reste 'Produit'
		// J'ajouter 'Model\' au début et 'Model' à la fin...
		// Il reste donc...
		// $class = Model\ProduitModel	

			$this -> model = new $class;	//$this->model = new Model\ProduitModel
			//j'instancie donc Model\ProduitModel et je stocke l'objet ProduitModel dans $this->model;
	}
	
	public function getModel(){
		return $this->model;
	}
	
	public function render($layout,$view,$params){
		
		$dirView = __DIR__ .'/../../src/View/';
		$dirFile = str_replace(array('Controller\\','Controller'),'',get_called_class()). '/';
		//controller\ProduitController ===> Produit
		
		$path_view =$dirView.strtolower($dirFile).$view;	//vue à aller chercher
		// ../View/produit/boutique.html
		
		$path_layout=$dirView.$layout;						//layout à aller chercher
		// ../View/layout.html
		
		extract($params);
		//Grâce à ce extract, les noms des indices dans mon array params, correspondront aux noms des variables utilisées dans mes vues.
		
		//------------------------------
		ob_start(); //enclenche la temporisation de sortie. C'est a dire que ce qui va suivre ne sera pas executé tout de suite, mais temporisé(retenue en mémoire tampon).
		require $path_view;	//require $path_view  est 'ce qui va suivre'
		
		$content=ob_get_clean();	//je stocke ce qui a été retenu, dans la variable $content.
		
		ob_start();
		require $path_layout;
		
		return ob_end_flush();	//Retourne tout ce qui a été retenu et éteint la temporisation.
	}
}