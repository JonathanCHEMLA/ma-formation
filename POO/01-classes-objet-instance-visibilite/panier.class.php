<?php
//un fichier = une classe


class Panier
{
	public $nbProduit;	//propriété, n'ayant pas de valeur
	
	public function ajouterProduit(){	//méthode
		// traitements de la méthode
		return 'L\'article a été ajouté !';
	}
	protected function retirerProduit(){
		
		return 'L\'article a été supprimé du panier !';		
	}
	private function afficherPanier(){
		
		return 'Voici les articles dans le panier !';		
	}	
}
//---------
$panier1=new Panier;	//
//$panier1 est un objet/instance de la classe panier. Pas besoin de () car il n'y a pas de parametres. on peut les mettre.
//var dump:pour les objet  et print r pour les array
echo '<pre>';
var_dump($panier1);
echo '</pre>';

//il s'affiche:
/*
object(Panier)#1 (1) {
  ["nbProduit"]=>
  NULL
}
*/

// le premier 1 correspond au nbre d'objets créés. le second, au nbre de proprietes de cette classe(nbProduit)


echo '<pre>';
var_dump(get_class_methods($panier1));
echo '</pre>';
/*
array(1) {
  [0]=>
  string(14) "ajouterProduit"
}
*/
//le 1 est le nbre de methodes de ma class. y en a qu'1 seule: ajouterProduit . les autres fcts etant private ou protected.


$panier1->nbProduit=5;
//affectation de la valeur 5 dans la propriété nbProduit de Panier1
//$pdo->	// obj de la classe PDO


//$res->execute();	// obj de la classe PDO STATEMENT
//$res->rowcount();	// obj de la classe PDO STATEMENT
//$res->bindvalue();	// obj de la classe PDO STATEMENT

echo '<pre>';
var_dump($panier1);
echo '</pre>';

/*
object(Panier)#1 (1) {
  ["nbProduit"]=>
  int(5)
}
*/

echo 'il y a ' . $panier1->nbProduit . ' produit(s) dans votre panier <br>';
//il y a 5 produit(s) dans votre panier 

echo 'panier :' . $panier1->ajouterProduit() . '<br>';

$panier2 = new Panier;
echo '<pre>';
var_dump($panier2);
echo '</pre>';
/*
object(Panier)#2 (1) {
  ["nbProduit"]=>
  NULL
}
*/

//Nous avons affecté une valeur à nbProduit de Panier1... Cela n'a pas d'incidence sur Panier2 pour lequel lla valueur de nbProduit reste null!!


echo 'Panier : '.$panier1-> retirerProduit(). '<br>';
echo 'Panier : '.$panier1-> afficherProduit(). '<br>';
//il me met un msg d'erreur car la methode est en private/protected donc j'ai pas le droit de le faire.
//Erreur: Nous ne pouvons pas accéder à des éléments protected et private depuis l'extérieur d'une classe.


/*
Commentaires:
new est un mot-clé qui permet de créer un objet issu d'une classe. On parle d'instanciation.

Niveaux de visibilité:
	- public :		l'element est accéssible partout(intérieur et extérieur des classes)
	- protected :	l'element est accéssible à l'intérieur de la classe à laquelle il appartient et des classes héritières
	- private :		l'element est accéssible uniquement dans la classe ou l'element est déclaré

	on peut créer plusieurs objets issus d'une même classe
*/
