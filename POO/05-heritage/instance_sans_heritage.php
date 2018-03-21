<?php
// " UN OBJET 'C' CONTENANT UN AUTRE OBJET 'A' "    ET     " HERITAGE MULTIPLE "
// C'est ce qui permet à une application de se déployer.

// Voici comment créer une instance de A sans hériter de A:

class A
{
	public function direBonjour(){
		return 'Bonjour !';
	}
}
//----------
class B
{}
//----------
class C extends B
{
	public $maVariable;	
	public function __construct(){
		//A LA CREATION D UN OBJET 'C', UNE PROPRIETE "maVariable" EST CREE ET CETTE PROPRIETE EST DEFINI COMME OBJET DE 'A': 
		$this-> maVariable = new A;
	}
}
//----------
$c= new C;
// IMPORTANT: Pour ACCEDER aux méthodes et propriétés d'une classe, IL ME FAUT créer un objet.
// DONC, J ACCEDE A LA FONCTION direBonjour() DE 'A'... GRACE A MON OBJET DE 'A':
echo $c->maVariable -> direBonjour();
// En clair, cela revient au meme que si on avait pu faire :   echo $objetA -> direBonjour();

//"l'instance sans heritage" : c'est un objet qui contient un objet

/*
commentaires :

	-Nous avons un objet A à l'intérieur de l'objet C.
	
	L'INTERET d'avoir une instance sans héritage (récupérer un objet dans la propriété d'une classe) est de POUVOIR HERITER D UNE CLASSE MERE d'un côté, ET de RECUPERER LES ELEMENTS D UNE AUTRE CLASSE en même temps.
	
	Pour le rappel le PHP n'accepte pas l'héritage multiple, c'est donc une manière d'aller plus loin dans l'héritage. 
	
	Ce concept est ce qui permet à un application de "se déployer"
	
	C'est une FACON DE FAIRE UN HERITAGE MULTIPLE. 
*/