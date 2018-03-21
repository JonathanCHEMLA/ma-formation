<?php

class Membre
{
	public $id_membre;
	public $pseudo;
	public $email;
	
	public function inscription(){
		return 'Je m\'inscrits !';
	}
	public function connexion(){
		return 'Je me connecte !';
	}
} 
//------------------

// class admin
// {
	
// }
//la seule diff avec le membre c'est que l'admin a acces au back office.
class Admin extends Membre //admin hérite de Membre
{
	//tout le code de la classe Membre est présent ici
	Public function accesBackOffice(){
		return 'J\'accède au BackOffice !';
	}
}
//------------------

$admin= new Admin();
echo $admin-> inscription().'<br>';
echo $admin-> connexion().'<br>';
echo $admin-> accesBackOffice().'<br>';

/*
commentaires:
Dans notre site, un admin c'est un membre avec une fonctionnalité supplémentaire: Accès au BackOffice. Il est donc naturel que la classe admin hérite (extends) de la classe Membre et qu'on ne réécrive pas tout le code deux fois.

on herite de private et de protected dans admin. mais on n'a pas le droit d'utiliser, dans admin, les elements private de la classe membre.
*/