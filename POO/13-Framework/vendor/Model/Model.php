<?php


namespace Model;
//tous mes models seront dans des dossiers physiques differents mais dans le meme modele.

use PDO, Manager\PDOManager;

class Model
{
	private $db;	// cette propriete contiendra notre objet PDO
//de 13 a 22 ca me sert juste a me connecter a la BDD	
	public function __construct(){

		$this->db = PDOManager::getInstance()->getPdo();	// PDOManager::getInstance() est seul moyen d'utiliser l'objet d'un design-Patern singleton
		// Lorsque j'instancie un objet Model (ou un enfant(heritié) de cette classe), la fonction construct() se lance, crée un objet PDO (grâce à PDOManager) et le stocke dans la propriété $db.
		//a chaque fois que l'internaute lance une action en rapport avec la bdd,on crée un objet produitController,et donc qu'on crée un objet produitModel, puis on crée un nouvel objet PDO
	}	// Bref, à chaque action en rapport avec la Bdd, un objet PDO est créé.
	
	public function getDb(){
		return $this-> db;	//me retourne l'objet pdo, stocké dans $Db
	}
	
	public function getTableName(){
		// pour pouvoir executer un "select * from ..." il nous faut extraire d'abord le nom de la table:
				// get_called_class() contient: Model\ProduitModel
				//get_called_class() est une fct qui me retourne le nom de la class dans laquelle nous sommes. (ex: nous somme dans la classe Produit: ->donc:Model\ProduitModel:  --> ''Produit''-->produit)
		$table= strtolower(str_replace(array('Model\\', 'Model'), '', get_called_class()));
		return $table;// $table=produit dans notre exemple.
		//return 'produit';	//on a tapé cette ligne et mis la ligne du dessus en commentaire, juste pour le test. 
		
		// Au moment ou je ferai appel à cette methode, je serai dans la classe ProduitModel, ou MembreModel ou CommandeModel etc...
		// Et donc cette fonction est capable de récupérer le nom de la classe et d'en extraire le nom de la table correspondante.
	}

		//---------------------------------
		//     REQUETES GENERIQUES :
		//---------------------------------
		
	// récupère toutes les infos d'une table et ce, peut importe l'entite dans la quelle je suis: produit, membre ou commande:
	public function findAll(){
		$requete = "SELECT * FROM " . $this -> getTableName();
		// $requete = "SELECT * FROM produit";
		
		$resultat = $this->getDb()->query($requete);
		//en general on ecrit:   $resultat = $pdo -> query("SELECT * FROM produit");
		
		$resultat-> setFetchMode(PDO::FETCH_CLASS, 'Entity\\'. $this->getTableName());
		/*
		setFetchMode() permet d'instancier un objet (dans notre cas, un objet Entity\Produit), en prenant les résultats de notre requete et en affectant les valeurs dans les propriétés de mes objets. Pour que cela fonctionne sans accroc, il faut ABSOLUMENT que les noms des champs dans les tables correspondent aux noms des proprietes dans les objets/ Entity (POPO)
		
		$objet = new Entity\Produit;
		$objet-> titre = 'mon super produit'
		$objet -> id_produit =12
		etc...
		*/
		
		/**A SAVOIR:
		* fetch(), seul c'est pareil que fetch both: ca retourne 1 array, qui sera à la fois numérique et associatif: [1,'Nom','Laborde']
		* fetchAll() retourne un Array de plusieurs Array: [0][1,'Nom','Laborde'],[1][1,'Nom','Laborde'],...
		faire un "fetchAll(fetch_Assoc)" revient au même que d'ecrire " while( $resultat->fetch(fetch_Assoc) ) "
		* PDO::fetch_Assoc retourne 1 array : ['Nom', 'Laborde']		
		* PDO::fetch Obj retourne un objet orphelin --> ca sert à rien !
		* PDO::fetch_class retourne un objet, de la classe (que je lui précise en second parametre) 
		* ENFIN,"fetchAll(PDO::fetch_class)" nous retourne, 1 ARRAY, dans lequel, chaque employé(par exemple) sera rangé un OBJET. -> Bref, on obtient un Array de +eurs Objets.
		*/
		
		
		$donnees = $resultat->fetchAll();//Notre fetchAll() va contenir un tableau d'objets, a cause du FETCH_CLASS du dessus. si on avait mis fetchAll(PDO::FETCH_ASSOC), dans l'ARRAY, on aurait récupéré des array au lieu d'objets
		if(!$donnees){
			return False;
		}
		else{
			return $donnees;	//retourne un objet PDO STATEMENT
		}
	}
	
	//récupère les infos d'une table en fonction de l'Id:
	public function find ($id){
		  $requete = "SELECT * FROM " . $this-> getTableName() . " WHERE id_" . $this->getTableName() . "=:id";
		//$requete = "SELECT * FROM produit WHERE id_produit = :id"
				
		$resultat= $this->getDb()->prepare($requete);
		$resultat->bindValue(':id', $id, PDO::PARAM_INT);
		$resultat->execute();
		
		$resultat->setFetchMode(PDO::FETCH_CLASS,'Entity\\' . $this->getTableName());	//signifie que je lui demande de ranger le resultat(contenu dans $resultat) de ma requete dans un tableau d'objets.
		
		$donnees = $resultat->fetch();//fetch et non fetchAll car je ne recois qu'un seul resultat
		if(!$donnees){
			return False;
		}
		else{
			return $donnees;	//retourne un objet PDO STATEMENT
		}
		
	}

	// Méthode générique pour supprimer un enregistrement
	public function delete($id){
		$requete = "DELETE FROM " . $this -> getTableName() . ' WHERE id_' . $this -> getTableName() . ' = :id';
		
		$resultat = $this -> getDb() -> prepare($requete);
		$resultat -> bindValue(':id', $id, PDO::PARAM_INT);	
		
		return $resultat -> execute();
	}
	
	//Méthode générique pour modifier un enregistrement avec la requete UPDATE
	public function update($id, $infos){
		$newValues = '';
		$first = FALSE; 
		foreach($infos as $key => $value){
			if($first == FALSE){
				$newValues .= " $key = :$key ";
				$first = TRUE;
			}
			else{
				$newValues .= ", $key = :$key ";
			}
		}

		$requete = "UPDATE " . $this -> getTableName() ." set " . $newValues . " WHERE id_". $this -> getTableName() . "=:id";

		//echo $requete; 
		$resultat = $this -> getDb() -> prepare($requete);
		$infos['id'] = $id;
		// la ligne ci-dessous est pour ajouter notre id passé en parametre dans l'array de la méthode execute(); 
 		return $resultat -> execute($infos);
	}
	
	//Méthode générique pour ajouter un enregistrement
	public function register($infos){	
	

		echo $this->getTableName();	
		echo $infos['pseudo'];		
		exit;
		$requete = 'INSERT INTO ' . $this -> getTableName() . ' (' . implode(', ', array_keys($infos)) . ') VALUES (' . ":" . implode(", :", array_keys($infos)) . ')';

		//echo $requete; 
		
		$resultat = $this -> getDb() -> prepare($requete);
		
		if($resultat -> execute($infos)){
			return $this -> getDb() -> lastInsertId();
		}
		else{
			return false;
		}

	}
	
}