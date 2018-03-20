<?php 
class Etudiant
{
	private $prenom;
	
	public function __construct($arg){
		//la fonction __construct() (méthode magique) se lance au moment de l'instanciation (à la ligne 24)...
		$this->setPrenom($arg);	// ne pas oublier le "$this"
			//instanciation=création de l'objet	
			// le construct sert aussi à déclencher la création de nouveau objets
	}
	
	public function setPrenom($prenom){
		$this->prenom = $prenom;
	}
	public function getPrenom(){
		return $this->prenom;
	}
}
//---------

$etudiant=new Etudiant('Yakine');
echo 'Prénom: ' . $etudiant->getPrenom();
///en modifiant UNIQUEMENT l'intérieur de la classe, essayer d'affecter la valeur 'Yakine' à la propriété prénom

echo '<pre>';
var_dump($etudiant) ;
echo '</pre>';

/*
Ce qui s'affiche: 

	Prénom: Yakine

	object(Etudiant)#1 (1) {
	  ["prenom":"Etudiant":private]=>
	  string(6) "Yakine"
	}
*/



