<?php

www.monsite.com/index.php?class=membre&action=inscription
www.monsite.com/membre/inscription
$a = new Membre;
$a -> inscription();


www.monsite.com/index.php?class=membre&action=connexion
www.monsite.com/membre/connexion
$a = new Membre;
$a -> connexion();


www.monsite.com/index.php?class=membre&action=profil&id=12
www.monsite.com/membre/profil/12

$a = new Membre;
$a -> profil($_GET['id']);


class Membre{
	
	private $pseudo;
	private $mdp;
	private $prenom;
	private $nom;
	private $email;
	private $civilite;
	private $adresse;
	private $code_postal;
	private $ville;
	private $statut;
	
	public function inscription(){
		
		require('inscription.html');
		
		if($_POST){
			//INSERT
		}
		
	}

	public function connexion(){
		require('connexion.html');
		
		if($_POST){
			//header('location:profil');
		}
		
	}
	
	
	function profil($id){
		
		//SELECT * FROM membre WHERE id_membre = $id
		
		
	}
	
	
	
	
}