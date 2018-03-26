<?php

namespace Controller;

Class MembreController extends Controller
{
	public function profil(){
		$membre = $_SESSION['membre'];	
		
			$params= array(
			'membre'=>$membre,
			'title' =>'profil de ' . $membre['pseudo']
		);
		return $this->render('layout.html','profil.html',$params);
	}
	
		public function inscription(){
		
		$erreur = '';		
		
		if($_POST)
		{
			if($this->getModel()->getMembreByPseudo($_POST['pseudo']))
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Pseudo indisponible !!</div>';
			}
			if(strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 20)
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">taille de pseudo non valide !!</div>';
			}
			if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20)
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">taille de nom non valide !!</div>';
			}
			if(strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20)
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">taille de prenom non valide !!</div>';
			}
			if(!is_numeric($_POST['code_postal']) || strlen($_POST['code_postal']) !== 5)
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Code postal non valide !!</div>';
			}
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Format Email non valide !!</div>';
			}
			foreach($_POST as $indice => $valeur)
			{
				$_POST[$indice] = strip_tags($valeur);
			}
			
			if(empty($erreur))
			{
				if($this->getModel()->registerMembre($_POST)){
					$erreur .= '<div class="alert alert-success col-md-8 col-md-offset-2 text-center">Vous êtes inscrit sur notre site Web !! <a href="'.$this->url .'"connexion" class="alert-link">Cliquez ici pour vous connecter</a></div>';
				}
			}
		}
		
		$params=array(
			'erreur'=>$erreur,
			'title'=>'Inscription'
		);
		
		return $this->render('layout.html','inscription.html', $params);
	}
	
	public function connexion(){
		$erreur='';
		if($_POST)
		{
			$membre = $this->getModel()->getMembreByPseudo($_POST['pseudo']);
			if($membre)
			{
				if($membre->getMdp() == $_POST['mdp'])
				{
					$this->createSessionMembre($membre);
					header("location:". $this->url ."membre/profil");// le pseudo, le mdp étant correct, nous l'envoyons sur son profil
				}
				else
				{
					$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Erreur de MDP</div>';
				}
			}
			else
			{
				$erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2">Erreur de pseudo</div>';
			}
			
			
		}
		$params= array(
			'erreur'=>$erreur,
			'title' =>'connexion'
		);
		return $this->render('layout.html','connexion.html',$params);
		
	}
	
	public function createSessionMembre($membre){
		print_r($membre);

		$_SESSION['membre']['id_membre'] = $membre->getId_membre();
		$_SESSION['membre']['pseudo'] = $membre->getPseudo();
		$_SESSION['membre']['prenom'] = $membre->getPrenom();
		$_SESSION['membre']['nom'] = $membre->getNom();	
		$_SESSION['membre']['email'] = $membre->getEmail();
		$_SESSION['membre']['ville'] = $membre->getVille();
		$_SESSION['membre']['adresse'] = $membre->getAdresse();
		$_SESSION['membre']['code_postal'] = $membre->getCode_Postal();
		$_SESSION['membre']['status'] = $membre->getStatus();	
		$_SESSION['membre']['civilite'] = $membre->getCivilite();
	}
	
	public function deconnexion(){}
	
	public function newsletter(){}
	
	public function parrainer(){}
	
	public function supprimerCompte(){}
	
	public function updateProfil(){}
	
	
}