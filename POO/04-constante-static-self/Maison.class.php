<?php


class Maison
{
	//par default tous les éléments de la classe sont 'public' 
	public $couleur = 'blanc';				//appartient à l'objet
	public static $espaceTerrain = '500m2';	//...à la classe
	private $nbPorte=10;					// ...à l'objet
	private static $nbPiece =7;				//...à la classe	// cela revient au cas de la voiture qui aura "5 roues". et toutes les autres voitures auront 5 roues aussi dorénavant.
	const HAUTEUR = '10m';					//...à la classe
	//une constante s'ecrit tjrs en MAJUSCULE et sans '$'
	
	//on va pas faire le setter, on s'en fout, car on  l'a incrémenté:10
	public function getNbPorte(){			// ...à l'objet
		return $this->nbPorte;
	}
	
	public static function getNbPiece(){	//...à la classe
		return self::$nbPiece;
		//return Maison::$nbPiece;
	}
	
	
}
//-------------

//on a place la ligne ci dessous avant l'instanciation car il n'est pas necessaire de creer une instace pour exploiter cette donnée "espaceTerrain".
echo Maison::$espaceTerrain.'<br>';	// LA, il FAUT mettre le $
//echo Maison::$nbPiece . '<br>';	// ERREUR: j'essaie d'accéder à une propriété private (certe static) depuis l'extérieur de la classe

echo Maison::getNbPiece().'<br>';
echo Maison::HAUTEUR .'<br>';


$maison =new Maison();
echo $maison->couleur. '<br>';		//ATTENTION! couleur ne doit pas être précédé d'un '$'

//echo $maison->espaceTerrain;		// ERREUR: j'essaie d'acceder à un element de la class depuis l'objet SAUF QUE espaceTerrain APPARTIENT A LA CLASSE! PAS A L OBJET !	(voir les lignes 21-22) 

//echo $maison->nbPorte;			// ERREUR: j'essaie d'ccéder à un élémnt de l'objet via l'objet, mais sa visibilité ne permet pas d'y accéder à l'extérieur de la classe.
echo $maison->getNbPorte(). '<br>'; //Ok, j'accède à un élément private grâce au getter public.









/*
Commentaires :
	les différents Opérateurs:
		$objet -> = j'accède à l'élément,appartenant un objet, à l'extérieur de la classe
		$this ->  = j'accède à l'élément,appartenant un objet, à l'intérieur de la classe
		Class ::  = j'accède à l'élément,appartenant une classe, à l'extérieur de la classe
		self ::   = j'accède à l'élément,appartenant une classe, à l'intérieur de la classe
	2 questions à se poser: est-ce que c'est static ?
	-> oui:
		-est-ce que je suis à l'intérieur ou à l'extérieur de la classe?
		->intérieur: self:: ($)
		->extérieur: Class:: ($)
	-> non:
		-est-ce que je suis à l'intérieur ou à l'extérieur de la classe?	
		->intérieur: ($)this-> (pas de $)
		->extérieur: ($)objet-> (pas de $)		

	Static signifie qu'un élément appartient à la classe. Pour y accéder, on devra donc l'appeler par la classe( Class:: / self:: ). Une propriété static peut etre modifiée, mais dans ce cas cette modification est durable dans le code.
	
	const signifie qu'une propriété appartient à la classe et ne peut pas être modifiée.  (Bref, une seule petite différence entre const et public static: avec public static on pourrait eventuellemnt la modifier mais à priori ça n'est pas modifiable).
	
*/