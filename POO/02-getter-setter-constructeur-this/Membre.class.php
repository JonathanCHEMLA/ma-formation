<?php
//exercice: Au regard de cette classe, veuillez créer un Membre,lui affecter un pseudo et un email, et afficher ses infos.

 class Membre
 {
	private $pseudo;
	private $email;
	
	// Setter/Getter Pseudo
	public function setPseudo($pseudo){		// ATTENTION! c'est les setter qui ont un parametre
		$this->pseudo = $pseudo ;			// ATTENTION! on ne met pas $pseudo	
	}										// ATTENTION! mettre une majuscule au 2e mot de la methode
	public function getPseudo(){			// ATTENTION! l'argument est affecté à "$this->pseudo"
		return $this->pseudo;		
	}
	
	//Setter/Getter Email
	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
	}
 }
 //------------
 $membre1=new Membre;						//ATTENTION! Ne pas oublier le "$" avant l'objet.
 $membre1->setPseudo('Adeline');
 echo $membre1->getPseudo(). '</br>';  				//ATTENTION! Ne pas oublier le echo sinon ca ne s'affiche pas.
 $membre1->setEmail('dadd@dadd.fr');
 echo $membre1->getEmail(). '</br>';
 
 // les ternaires : Merci Quentin Chateaureynaud !
 
 
 echo 'Pseudo: ' . $membre1->getPseudo(). '</br>';
 echo 'Email : ' . $membre1->getEmail(). '</hr>';
 
 
 