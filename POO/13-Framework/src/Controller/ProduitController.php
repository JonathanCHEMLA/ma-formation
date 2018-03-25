<?php

namespace Controller;

//use Model  j'ai pas besoin car je vais heriter de controller et controler le fait deja!

class ProduitController extends Controller
{
	// Afficher tous les produits (home du site)
	public function afficheAll(){
		// 1:récupère tous les produits
		// 2:récupérer toutes les catégories
		// 3:renvoyer la vue (boutique.php) 
		// $this est Controller\ProduitController   getModel() appartient à COntroller.php   getAllProduit() produitModel.php
		$produits = $this->getModel()->getAllProduit();
		$categories = $this->getModel()->getAllCategorie();
		
		$params=array(
			'produits'=>$produits,
			'categories'=>$categories
			);
		return $this->render('layout.html', 'boutique.html', $params);	//'boutique.html' car n'oublions pas que nous sommes tjrs dans le dossier index.php
	}
	// Afficher un produit (fiche produit)	
	public function affiche($id){
		// 1:récupère les infos du produit dont l'id est $id
		// 2:renvoyer la vue (boutique.php) 
		$produit = $this->getModel()->getProduitById($id);	//getModel:controller.php     get ProduitById:ProduitModel.php

		$params = array(
			'produit'=>$produit
			);
		return $this ->render('layout.html','fiche_produit.html',$params);	
	}			
		
	// Afficher les produit d'une categorie(boutique/categorie)	
	public function boutique($cat){
		// 1:récupère tous les produits de la categorie $cat
		// 2:récupérer toutes les catégories
		// 3:renvoyer la vue (boutique.php) 
		$produits = $this->getModel()->getAllProduitByCategorie($cat);
		$categories = $this->getModel()->getAllCategorie();
		
		$params=array(
			'produits'=>$produits,
			'categories'=>$categories
			);
		return $this->render('layout.html', 'boutique.html', $params);	
	}
	// Afficher les produits en fonction d'une recherche
	public function recherche($term){
		
	}	
	
}