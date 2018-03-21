<?php



abstract Class Joueur
{
	public function seConnecter(){
		//Que faut-il pour se connecter ? Etre majeur !
		return $this -> etreMajeur();
	} 
	abstract public function etreMajeur();	//pas de corps dans une fonction abstraite
	abstract public function devise();
	
}
//------------------
Class JoueurFr extends Joueur
{
	public function etreMajeur(){
		return 18;
	}
	public function devise(){
		return '€';
	}
}
//------------------
Class JoueurUs extends Joueur
{
	public function etreMajeur(){
		return 21;
	}
	public function devise(){
		return '$';
	}
}
//------------------
$joueurFr= new JoueurFr;
echo $joueurFr -> seConnecter() . '<br>';	//18

$joueurUs= new JoueurUs;
echo $joueurUs -> seConnecter() . '<br>';	//21

//il n'y a pas de proprietes abstraites. QUE LES METHODES!
//lorsqu une methode de la classe mere devient abstraite, la classe mere le devient aussi.


/*
commentaires:
	- Une classe abstraite ne peut pas être instanciée
	- les méthodes abstraites n'ont pas de contenu (pas de corps)
	- Pour déclarer une méthode abstraite, il faut OBLIGATOIREMENT être dans une classe abstraite.
	- Lorsqu'on hérite d'une méthode abstraite, on doit OBLIGATOIREMENT la redéfinir.
	- Une classe abstraite peut contenir des méthodes normales.
	
	Le développeur qui décrit la classe abstraite est souvent au coeur de l'application (développeur maître)

*/
