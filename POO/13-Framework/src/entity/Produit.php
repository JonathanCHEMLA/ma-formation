<?php
//src/Entity/Produit.php

namespace Entity; 

class Produit
{
	private $id_produit;
	private $reference;
	private $categorie;
	private $titre;
	private $description;
	private $couleur;
	private $taille;
	private $public;
	private $photo;
	private $prix;
	private $stock;
	
	/**
	* Id_membre
	*
	*/
	public function getId_Produit(){
		return $this -> id_produit;
	}
	
	public function setId_Produit($id){
		$this -> id_produit = $id;
	}
	
	
	/**
	* reference
	*
	*/
	public function getReference(){
		return $this -> reference;
	}
	
	public function setReference($ref){
		$this -> reference = $ref;
	}
	
	/**
	* categorie
	*
	*/
	public function getCategorie(){
		return $this -> categorie;
	}
	
	public function setCategorie($cat){
		$this -> categorie = $cat;
	}
	
	/**
	* titre
	*
	*/
	public function getTitre(){
		return $this -> titre;
	}

	public function setTitre($titre){
		$this -> titre = $titre;
	}
	
	/**
	* Description
	*
	*/
	public function getDescription(){
		return $this -> description;
	}

	public function setDescription($desc){
		$this -> description = $desc;
	}

	/**
	* couleur
	*
	*/	
	public function getCouleur(){
		return $this -> couleur;
	}

	public function setCouleur($couleur){
		$this -> couleur = $couleur;
	}

	/**
	* Taille
	*
	*/
	public function getTaille(){
		return $this -> taille;
	}
	
	public function setTaille($taille){
		$this -> taille = $taille;
	}

	/**
	* public
	*
	*/
	public function getPublic(){
		return $this -> public;
	}

	public function setPublic($public){
		$this -> public = $public;
	}
	
	/**
	* Photo
	*
	*/
	public function getPhoto(){
		return $this -> photo;
	}
	
	public function setPhoto($photo){
		$this -> photo = $photo;
	}

	/**
	* prix
	*
	*/
	public function getPrix(){
		return $this -> prix;
	}
	public function setPrix($prix){
		$this -> prix = $prix;
	}

	/**
	* public
	*
	*/
	public function getStock(){
		return $this -> stock;
	}
	
	public function setStock($stock){
		$this -> stock = $stock;
	}
}


