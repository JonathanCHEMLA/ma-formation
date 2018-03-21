<?php

final class Application
{
	public function run(){
		return 'Lancement de l\'application !';
	}
}
//------------
//class Extension extends Application{}	// erreur, il est impossible d'hériter d'une classe finale.

//------------






class Application2
{
	final public function run2(){
		return 'Lancement de l\'application !';
	}
}
//-----------
Class Extension2 extends Application2
{
	// public function run2(){} 	// erreur, on peut, certes, utiliser run2(), mais on ne peut ni faire ni une "surcharge", ni une "redéfinition" d'une fonction "final".
}

/*
commentaires:

	- une "classe final" peut être instanciée.
	- une classe finale ne peut pas être héritée.
	
	- Les méthodes d'une classe finale sont forcément final par définition, puisque, la classe ne pouvant être héritée, les méthodes ne seront jamais surchargées.

	- Une "méthode final" peut etre présente dans une classe normale.
	- Une "méthode final" ne peut pas être surchargée ou redéfinie.

*/