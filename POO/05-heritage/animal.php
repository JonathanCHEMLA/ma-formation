<?php

class Animal
{
	protected function deplacement(){
		return 'Je me déplace';
	}

	public function manger(){
		return 'Je mange';
	}
	
}	
//---------
Class Elephant extends Animal
{
	// tout le code de la classe Animal est présent ici.
	public function quiSuisJe(){
		return 'Je suis un Elephant, et ' .$this->deplacement() .'<br>'; 
	}
	
}
//---------
class Chat extends Animal
{
	public  function quiSuisJe(){
		return 'Je suis un chat !';
	}
	public function manger(){	//redéfinition  de la fonction "manger" de la classe parent Animal
		return 'Je mange peu !';
	}
	
}
// on n'aurait pas pu ecrire la ligne 19 ici, en dehors des classes.
$eleph= new Elephant;
echo $eleph->manger() .'<br>';//Je mange
echo $eleph->quiSuisJe() .'<br>';//Je suis un Elephant, et Je me déplace

$chat=new Chat;
echo $chat->manger() .'<br>';//Je mange peu !
echo $chat->quiSuisJe() .'<br>';//Je suis un chat !


/*
commentaires:
	L'héritage est l'un des fondements de la programmation orientée objet(tous les langages).
	Lorsqu'une classe hérite d'une autre classe, elle importe tout le code. Les éléments sont donc appelés $this(à l'intérieur de la classe). ex: $this->deplacement()
	
	Redéfinition de fonction : Une classe enfant(héritière) peut modifier ENTIEREMENT le traitement d'une fonction dont elle a hérité. On parle de redéfinition de fonction (vs Surcharge).
	
	L'interprêteur va d'abord regarder si la méthode existe dans la classe qui l'éxécute puis dans la classe mère.

*/

//Pour info: minifier (avec js et css) permet d optimiser le temps de chargement.
	
	