<?php

class Config
{
	protected $parameters; //on aurait pu aussi la faire private, c est pareil
	
	public function __construct(){	
		require __DIR__ . '/Config/parameters.php';	// constante magique qui nous retourne le chemin du dossier en cours. !ci ! ci dessus, C'est un require !
		$this->parameters = $parameters;	//je mets dans ma propriete, le contenu de $parameters de la page parameters.php.
	
	}

// des lors qu'on créé un objet Config, $parameters contient les infos du fichier parameters.php
//Au moment où j'instancie cette classe, je récupère le fichier parameters.php, et je stocke tous les paramètres de mon application dans la propriété $parameters.

//vu que $parameters est en protected, on aurait du avoir un getter et un setter mais comme je n'ai besoin que du getter:
		public function getParametersConnect(){	
		return $this->parameters['connect'];
		// Cette fonction retourne seuleemnt les informations de connexion qui me seront utilises au moment de la connexion à la BDD
	
	}
}
// $config= new Config;
// echo '<pre>';
// print_r($config->getParametersConnect());
// echo '</pre>';

/*
Affiche:

Array
(
    [host] => localhost
    [dbname] => boutique
    [login] => root
    [password] => 
)
*/


