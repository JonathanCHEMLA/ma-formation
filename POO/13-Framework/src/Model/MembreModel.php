<?php

namespace Model;

use PDO;

Class MembreModel extends Model
{
	public function getMembreByPseudo($pseudo){
		$requete="SELECT * FROM membre WHERE pseudo= :pseudo";
		$resultat= $this->getDb()->prepare($requete);
		$resultat->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
		$resultat->execute();
		
		$resultat->setFetchMode(PDO::FETCH_CLASS, 'Entity\Membre');	//c'est ici qu'on va voir si on a un probleme avec nos getter et nos setter
		
		$donnees = $resultat->fetch();
		
		if(!$donnees){
			return FALSE;
		}
		else{
			return $donnees;
		}		
	}
	
	public function registerMembre($infos){	//$infos contient la totalité des données que l'user a saisies dans le formulaire d'inscription
		return $this->register($infos);		
	}
	
	public function getMembreById($id){
		return $this->find($id);
	}
	
	public function getAllMembre(){
		return $this->findAll();
	}
	
	public function updateMembre($id, $infos){
		return $this->update($id, $infos);
	}
	
	public function deleteMembre($id){
		return $this->delete($id, $infos);
	}

}