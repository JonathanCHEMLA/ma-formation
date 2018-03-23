<?php

//le singleton est design Pattern: c'est à dire (template,modèle,design,c'est un MODELE DE CONCEPTION)
// c'est utilise lorsque plusieurs informaticiens sont confrontés à un meme probleme. 
//un design Pattern c'est une réponse trouvée par d'autre développeurs à une question que beaucoup de dev' se posent.


//"singleton" est le nom d'un design patern. le singleton repond a la question suivante:"cmt créer une classe qui ne soit instanciable 1 seule et unique fois. ex: connection à la BDD?"
/*---------------------------------------------------------------------------------------------*/
Class Singleton{
	
	private static $instance = NULL;	//propriété qui appartient à la classe, et qui contiendra un objet de cette mêm classe
	
	private function __construct(){		//signifie qu'on ne pourra plus créer d'objet avec la ligne 31
	//fonction private, donc instanciation impossible
	}
	private function __clone(){}		//Fonction private, donc clonage impossible
	
	public static function getInstance(){
		if(is_null(self::$instance)){
		//if(!self::$instance){
		//if(self::$instance == NULL){
		
		self::$instance =new Singleton;
		//self::$instance = new self;
		}
		return self::$instance;			//on retourne que $instance n'est plus NULL: il est égal à self::$instance
	}	
}
/*----------------------------------------------------------------------------------------------*/
//$singleton = new Singleton; // impossible

// fabr une class pour laquelle il n existe qu 1 seul objet. creer un seul objet. Bref c'est le chassis . On l'utilise pour l'utilisation qu'on veut en faire.



$singleton=Singleton::getInstance();
//$singleton2=Singleton::getInstance();

//echo '<pre>';
//var_dump($singleton);
//var_dump($singleton2);
//echo '</pre>';
/*
object(Singleton)#1 (0) {
}
object(Singleton)#1 (0) {
}
*/

//EN FAIT, ON A INSTANCIE 2 FOIS UN OBJET DE LA CLASSE, MAIS ON A RECUPERE 2 FOIS LE MEME OBJET.
//ex d'utilisation: pour être sur d'avoir toujours 1 seul personnage créé



//DE LA LIGNE 10 A 30, c'est le code du Singleton. 

//Pour exploiter ce singleton dans le cadre de l'obet PDO, il faut créer:
 //- dans la classe Singleton, une fonction:		
 public function getPdo($db,$host,$login,$mdp){ /*ici: $pdo = new PDO('mysql:host='.$host.';dbname='.$db.','.$login .','.$mdp.') */ } // getPdo ne sera pas static
 //- et hors de la classe, une instruction: 		
 $pdo = $singleton -> getPdo();
 



//static implique: 
		//appartient  à la classe  &    
		//quand elle modifiée, elle est modifiée durablement

//personne ne pourra faire un new singleton.
// est ce que la propr instance est null? oui! donc je met l'objet unique de la classe Singleton
 