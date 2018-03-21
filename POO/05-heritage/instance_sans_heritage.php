<?php


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
	public $maVariable;		//on obtient un objet de la classe A
	public function __construct(){
		$this-> maVariable = new A;
	}
}
//----------
$c= new C;
echo $c->maVariable -> direBonjour();
// echo $objetA -> direBonjour();

//"l'instance sans heritage" : c'est un objet qui contient un objet

/*
commentaires :

	-Nous avons un objet A à l'intérieur de l'objet C.
	
	L'intérêt d'avoir une instance sans héritage (récupérer un objet dans la propriété d'une classe) est de pouvoir hériter d'une classe mère d'un côté, et de récupérer les éléments d'une autre classe en même temps.
	
	Pour le rappel le PHP n'accepte pas l'héritage multiple, c'est donc une manière d'aller plus loin dans l'héritage. 
	
	Ce concept est ce qui permet à un eapplication de "se déployer"
	
	C'est une façon de faire un héritage multiple. 
*/