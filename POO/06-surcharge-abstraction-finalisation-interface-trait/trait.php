<?php

// ATTENTION, les traits ne fonctionnent que depuis PHP 5.4

trait TPanier
{
	public $nbProduit = 1;
	
	public function affichageProduits(){
		return 'Affichage des produits';
	}
}
//--------
trait TMembre
{
	public $nbProduit = 1;
	
	public function affichageMembre(){
		return 'Affichage des membres';
	}
}
//--------
class Site
{
	use TPanier, TMembre;
	// on importe tout le code contenu dans les traits TPanier et TMembre
}

//-----
$site = new Site;
echo $site -> affichageProduits() .'<br>';
echo $site -> affichageMembre() .'<br>';

//-----

/*
Commentaires:
	- Les traits ont été inventés pour repousser l'héritage non-multiple du PHP.(extends A, B)
	
	- Une classe peut hériter d'une seule classe, mais importer plusieurs traits.
	
	- Un trait peut importer un ou des traits.

*/