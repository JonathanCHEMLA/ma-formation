<?php 

namespace Controller;

use Model,Config;	// on utilise ce qu'il y a dans le namespace Model

Class Controller
{
	protected $model;	// Contiendra le nom du model à instancier (ProduitModel si je suis dans ProduitController, MembreModel si je suis dans MembreController...)
	
	protected $url;	//contiendra le chemin du site
	
	public function __construct(){
		$class= 'Model\\' . str_replace(array('Controller\\','Controller'),'',get_Called_Class()) .'Model';
		
		// Exemple : Si je suis dans Controller\ProduitController
		// Je retire 'Controller\' et 'Controller', il reste 'Produit'
		// J'ajouter 'Model\' au début et 'Model' à la fin...
		// Il reste donc...
		// $class = Model\ProduitModel	

		$this -> model = new $class; //$this->model = new Model\ProduitModel     //voir ligne 12
		//j'instancie donc Model\ProduitModel et je stocke l'objet ProduitModel dans $this->model;
		
		$config=new Config;
		$site=$config->getParametersSite();
		$this->url=$site['url'];
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
		
		
		$params['url']=$this->url;
		//on embarque avec nous, dans toutes les pages, la variable $url qui contient l'url du site, paramétrée dans app/Config/parameters.php.(il faut absolument que ca soit fait avant le extract)
		
		//le contenu de $params se trouve dans ProduitController. 
		extract($params);	// extract n'est pas oblige mais c'est prefereable car,
		//Grâce à ce extract, les noms des indices dans mon array params, correspondront aux noms des variables utilisées dans mes vues. Ainsi, dans mes vues, plutot que d'avoir dans le foreach:     "$params['produit'] as $produit"     on aura:     "$produits as $produit"		
		
		//------------------------------obstart: require la vue! mais pas tout de suite!  mets ca dans $content. 
		//met de cote!
		ob_start(); //enclenche la temporisation de sortie. C'est a dire que ce qui va suivre ne sera pas executé tout de suite, mais temporisé(retenue en mémoire tampon).
		require $path_view;	//require $path_view  est 'ce qui va suivre'
		
		$content=ob_get_clean();	//je stocke ce qui a été retenu, dans la variable $content.	// stocke cet ordre
		
		ob_start();	//require le layout mais pas tt de suite! stock ca dans $content.  
		require $path_layout;
		
		//retourne tout ce qui a été mis de coté
		return ob_end_flush();	//Retourne tout ce qui a été retenu et éteint la temporisation.
	}						
}