<?php

class A
{
	public function test(){
		return 'test';
	}
	protected function test4()
	{
		return '+test4';
	}
}
//-------
Class B extends A
{
	public function test2(){
		return 'test2';
	}
}
//-------
Class C extends	B
{
	public function test3(){
		return 'test3'. $this -> test4();
	}
}
//-------
$c = new C;

//Methode de A accessible par C(héritage indirect)
echo $c->test().'<br>';	//test

//Methode de B accessible par C(héritage direct)
echo $c->test2().'<br>';//test2

echo $c->test3().'<br>';//test3+test4

//transitivité : si C hérite de B, et que B hérite de A, alors C hérite de A
//ex: si la class felin herite de la classe animal, et chat herite de felin, alors chat herite d'animal.

echo '<pre>';
var_dump(get_class_methods($c));
echo '</pre>';
/*
array(3) {
  [0]=>
  string(5) "test3"
  [1]=>
  string(5) "test2"
  [2]=>
  string(4) "test"
}
on constate que test3 passe avant celles des parents.
etque test4 n'est pas present car il est protected donc non dispo hors de la classe.
*/

/*
commentaires:
	transitivité:
	Si B hérite de A
		Et si C hérite de B
			Alors C hérite de A (indirectement)
		Les méthodes protected de A sont accessibles dans C meme si l'heritage est indirect.

	L'héritage est:
		- Non reflexif : Class D extends D ====> une classe ne peut pas hériter d'elle-même
		- Non Symétrique : ce n'est pas parce que E extends F que F va extends E. // pas automatique
		- Sans cycle : Si E extends de F, il est impossible que F extends E	// pas possible
		- pas multiple : Class N extends M, P ==> En PHP il n'y a pas d'héritage multiple.
		
	Une classe peut avoir un nombre infini d'héritiers.	
*/