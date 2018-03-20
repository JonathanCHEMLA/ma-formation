<?php


class Homme
{
	private $prenom;
	private $nom;	
	
	public function setPrenom($arg){
		if(is_string($arg) && strlen($arg)> 5 && strlen($arg<=30)){			//string/5/30
			$this->prenom=$arg;
			return true;
		}
		else{
			return false;
			echo 'Erreur dans le prenom';
		}
	}
	
	public function getPrenom(){
		return $this->prenom;	//this fait appel à l'objet dans lequel je me trouve
	}
	
}
$homme = new Homme();
$homme -> setPrenom($_POST['prenom']);
echo 'Bonjour ' . $homme -> getPrenom() . '!';


//on n'utilise plus la méthode procédurale: if(is_string($_POST['prenom']) && strlen($_POST['prenom'])> 5 && strlen($_POST['prenom'])<=30){ ... }

// l'interet est que tu delegue à une fonction. On est dans une equipe de developpeurs. on w de maniere collaborative

//on passe du procédural à l'objet:  procedural->procedural factorisé ->objet


/*
Commentaires :

pourquoi faire des getter et des setters ?
	- le php est un langage qui ne type pas ses variables. Donc "mettre une visibilité private aux propriétés, et créer les setters pour vérifier l'intégrité des données" EST UNE BONNE CONTRAINTE.	
	- Tout dev' qui voudra affecter une valeur devra OBLIGATOIREMENT passer par le setter.
	
	Setter : Affecter une valeur
	Getter : Récupérer une valeur
	
	- Nous aurons autant de setter et de getter que de propriétés private (pluggin getter/setter pour qu'il crée automatiquement nos getters et setters)
	
	$this représente l'objet en cours de manipulation.
*/

//sur le bon coin on aura 2 membres: membre1 et membre2. Ils correspondront à l'acheteur et au vendeur