<?php

namespace Model;

use PDO;

Class ProduitModel extends Model
{
	// Tout le code de model est ICI
	// je n'ai aps beosin d'un require car j'ai fait un extends.
	//et j'ai pas besoin non plus d'une use car je suis dans le meme tiroir
	
	public function getAllProduit(){
		return $this->findAll();
	}
	
	public function getProduitById($id){
		return $this->find($id);		
	}
	
	public function updateProduit($id,$infos){
		return $this->update($id,$infos);
	}
	
	public function deleteProduit($id){
		return $this->delete($id);
	}
	
	public function registerProduit($infos){
		return $this->register($infos);
	}
	
	
	public function getAllCategorie(){
		$requete= "SELECT DISTINCT categorie FROM produit";
		$resultat= $this->getDb()->query($requete);
		
		//la non utilisation de setFechMode fait qu'on recupére un array. c'est pourquoi, dans notre view, on n'appelle pas $categorie-> mais $cat['categorie'].
		$donnees= $resultat->fetchAll();
		
		if(!$donnees){
			return FALSE;
		}
		else{
			return $donnees;
		}
	}
	
	public function getAllProduitByCategorie($cat){
		$requete= "SELECT * FROM produit WHERE categorie =:cat";
		$resultat= $this->getDb()->prepare($requete);
		$resultat->bindValue(':cat',$cat,PDO::PARAM_STR);
		$resultat->execute();
		
		$resultat->setFetchMode(PDO::FETCH_CLASS, 'Entity\Produit');
		
		$donnees = $resultat->fetchAll();
		
		if(!$donnees){
			return FALSE;
		}
		else{
			return $donnees;
		}		
	}
	
	public function getProduitBySearch($term){
		$term='%' . $term .'%';
		
		$requete ="
		SELECT *
		FROM produit
		WHERE titre LIKE :term
		OR description LIKE :term
		OR categorie LIKE :term
		OR taille LIKE :term
		OR prix LIKE :term
		";
		
		$resultat= $this->getDb()->prepare($requete);
		$resultat->bindValue(':term',$term,PDO::PARAM_STR);
		$resultat->execute();
		
		$resultat->setFetchMode(PDO::FETCH_CLASS, 'Entity\Produit');
		
		$donnees = $resultat->fetchAll();
		
		if(!$donnees){
			return FALSE;
		}
		else{
			return $donnees;
		}			
	}
	
	public function getProduitsSimilaires($id,$categorie,$prix,$taille,$public){

		$prixMaxi=$prix + 0.3 * $prix;
		$prixMini=$prix - 0.3 * $prix;
		$requete="SELECT * FROM produit WHERE categorie=".$categorie." AND taille=".$taille." AND public=".$public." And id_produit not in (SELECT id_produit FROM produit where id_produit=".$id. ") AND prix BETWEEN ".$prixMini. " AND ".$prixMaxi." ORDER BY prix LIMIT 0,3";

		
		$resultat= $this->getDb()->prepare($requete);
		$resultat->bindValue(':term',$term,PDO::PARAM_STR);
		$resultat->execute();
		
		$resultat->setFetchMode(PDO::FETCH_CLASS, 'Entity\Produit');
		
		$donnees = $resultat->fetchAll();
		
		if(!$donnees){
			return FALSE;
		}
		else{
			return $donnees;
		}	
	}
	
}

