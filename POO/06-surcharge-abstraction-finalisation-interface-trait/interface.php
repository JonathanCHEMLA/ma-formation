<?php


interface Mouvement
{
	public function start();
	public function turnLeft();
	public function turnRight();
}

class Avion implements Mouvement
{
	public function demarrer(){}
	public function tourneGauche(){}	
	public function tourneDroite(){}	
	// Cette classe contient plein d'erreur puisque le dev' qui a codé ces fonctions n'a pas respecté le contrat(interface Mouvement/ lexique) dans le naming des fonctions.
}
//--------------
class Bateau implements Mouvement
{
	public function start(){}
	public function turnLeft(){}
	public function turnRight(){}	
}

/*
Commentaires:

	- Une interface n'est pas instanciable.
	

	- une interface est une liste de méthodes (sans contenu, sans corps) qui permet de garantir que toutes les classes qui implements l'interface contiendront toutes les méthodes de l'interface, avec LES MEMES NOMS. C'est une sorte de lexique, ou de contrat passé entre le dev' maître et les autres développeurs.
	
	- "Bateau" et "Avion" peuvent par exemple hériter d'une classe "Véhicule", et implémenter l'interface Mouvement. Les mouvements sont des points communs que "Bateau" et "Avion" partagent.
	
	- On peut hériter d'une classe, et implémenter une interface en même temps : class A extends B implements C.
	
	- Les méthodes d'une interface sont forcément "public" sinon elle ne pourraient pas être redéfinies 

*/