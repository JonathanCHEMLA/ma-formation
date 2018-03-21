<?php

//les méthodes magiques sont des fonctions qui s'exécutent automatiquement en fonction d'évenements en particuliers.


class Societe
{
	public $adresse;
	public $ville;
	public $cp;
	
	public function __construct(){} //fct magique qui s'exec au moment de l'instanciation
	public function __set($nom, $valeur){
		echo  'Hey oh, jeune Padawan, que fais-tu? La propriété <u><b>'. $nom. '</b></u> n\'existe pas. Valeur: ' .$valeur;
	// se declenche lorsqu'on tente d'affecter une valeur à une propriété qui n'existe pas
	//set est utile si on travaille avec des proprietes public. mais dans le cas ou mes proprietes sont private et que j'utilise donc un getter et un setter par propriete, __set n'est pas necessaire car l'user mal intentionné ne peut pas créer des getter et des setter pour acceder à une propriete private
	}
	
	public function __get($nom){
		echo "<br/>La propriété $nom  n'existe pas ! <br/>" ;
	}
	
}
//toutes les fct magiques commencent par "__"

$societe = new Societe;
$societe -> adresse ="18 rue geoffroy L'asnier";
$societe -> cp ="75004";
$societe -> ville ="Paris";
$societe -> pays ="France";
echo $societe-> telephone;


//la fonction magique "__set" n'existe qu'en PHP!


/*
	D'autres méthodes magiques existent:
	
	- __call($nom,$args) : s'exécute lorsqu'on tente d'appeler une fct qui n'existe pas. On récupère en args, le nom de la méthode, et les arguments qui avaient été passés dans cette méthode.
	// $societe->ouverture('lundi','mardi');
	
	- __callStatic($nom,$args) : idem mais pour des méthodes static
	// Societe::ouverture('lundi','mardi');
	
	- __destruct() : S'exécute à la fin du script.
	Ex: fermer la connexion à la BDD, fermer des fichiers...
	
	- Liste non-exhaustive: __isset(), __wakeup(),  __sleep(),  __clone(),  __invoke()
	
	
	__clone( à l'instant T on copie un objet, puis chaque objet suit un chemin différent 