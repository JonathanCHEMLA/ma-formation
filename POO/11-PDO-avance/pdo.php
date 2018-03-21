<?php

//-----------1ERE METHODE :
//$pdo = new PDO('mysql:host=localhost;dbname=entreprise','root' ,'');
//$pdo = new PDO('mysql:dbname=entreprise;host=localhost','root' ,'');	ca fonctionne pareil!

//Erreur volontaire de requête :
//$resultat = $pdo -> query('dfsdfsd');	//----------> ca n'affiche aucun résultat ni message d'erreur.



//-----------2EME METHODE :
//connexion avec mode erreur warning :
//$pdo = new PDO('mysql:host=localhost;dbname=entreprise','root' ,'', array(
//	PDO::ATTR_ERRMODE =>PDO::ERRMODE_WARNING
//));

//erreur volontaire de requête :
//$resultat = $pdo -> query('dfsdfsd');	//Warning: PDO::query(): SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'dfsdfsd' at line 1 in C:\xampp\htdocs\formateur\ma-formation\POO\11-PDO-avance\pdo.php on line 18.  
//A SAVOIR :  Un site avec une erreur SQL est un site Piratable. 

//A SAVOIR : ON DOIT AVOIR 2 serveurs: un serveur de prod' et un de dev'


//-----------3EME METHODE :
//les exceptions: je ne laisse plus le serveur afficher les erreurs ! que soit PHP ou SQL.
$pdo = new PDO('mysql:host=localhost;dbname=entreprise','root' ,'',array( 
PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
));

try{
	//erreur volontaire de requête:
	$resultat = $pdo -> query('dfsdfsd');
}
catch(PDOException $e){
	//on peut mettre ici, par exemple notre page 404.
	//les 7 lignes ci dessous ne doivent pas etre sur notre site de prod'
	echo '<div style="color: white; background: red; padding: 10px">';
		echo 'Erreur SQL : <br>';
		echo 'Code: '. $e->getCode() .'<br>';
		echo 'Message: '. $e->getMessage() .'<br>';
		echo 'Fichier: '. $e->getFile() .'<br>';
		echo 'Ligne: '. $e->getLine() .'<br>';	
	echo '</div>';

	
	$f =fopen('error.txt', 'a');
	// Créer un fichier error.txt
	$ligne= 'Erreur SQL : ' . date('d/m/Y'). '-' . 'code :' .$e -> getCode() . '-' . '192.168.01.01';
	fwrite($f, $ligne. "\r\n");
	//header('location:404.php')

	}
// avec cette 3e methode je ne laisse pas le serveur gerer les erreurs. Je prends le controle de cette gestion d'affichage
// des qu'il y a des bugs, je suis content d'etre informe des erreurs sur mon site de prod'
// l'avantage c'est qu'on peut etre en prod', et ACCEDER aux erreurs, dans notre fichier txt, SANS QUE ces erreurs apparaissent sur notre site en prod'.
	// $f =fopen('error.txt', 'a');
		//Créer un fichier error.txt
	// $ligne= 'Erreur SQL : ' . date('d/m/Y'). '-' . 'code :' .$e -> getCode() . '-' . '192.168.01.01';
	// fwrite($f, $ligne. "\r\n");
	// header('location:404.php')


//tout notre code doit etre dans le try{}	
	
// POUR INFO: avec un vpn l'ip change. Grace à l'ip qui change, on est moins trouvable.






try{
						// Avec le Marqueur ':'  :
	$prenom='Amandine';
	$nom='Thoyer';
	
		//méthode 1 :
	$resultat=$pdo-> prepare("SELECT * FROM employes WHERE prenom= :prenom AND nom= :nom");
	$resultat-> bindValue(':nom',$nom, PDO::PARAM_STR);
	$resultat-> bindValue(':prenom',$prenom, PDO::PARAM_STR);
	$resultat-> execute();
	//bindParam c'est pareil que bindValue.
	
		//méthode 2 : recommendé pour l'utilisation de "requêtes dynamiques"
	$resultat=$pdo-> prepare("SELECT * FROM employes WHERE prenom= :prenom AND nom= :nom");
	$resultat-> execute( Array(
		':nom'=> $nom,
		'prenom'=> $prenom
	));
		//méthode 3: par la simple récupération du contenu de POST
		$resultat=$pdo-> prepare("SELECT * FROM employes WHERE prenom= :prenom AND nom= :nom");
	$resultat-> execute($_POST);	// a condition d'avoir verifie au prealable ce qu'on a dans post, et a condition que le submit n'ait pas de name
	
	
	
	
						// Avec le Marqueur '?' ( marqueur non nominatif ) :
		// Attention a l'ordre de prenom et nom!
	$resultat=$pdo-> prepare("SELECT * FROM employes WHERE prenom= ? AND nom= ?");
	$resultat-> execute( Array(
		$prenom,	
		$nom
	));
	
	
	//autre exemple d'utilisation du marqueur non nominatif:
	
	
		$resultat = $pdo -> prepare("INSERT INTO employes (prenom, nom, sexe, salaire, date_embauche, service) VALUES (?, ?, ?, ?, CURDATE(), ?)");
	$resultat -> execute(array(
		'Yakine',
		'Hamida',
		'm',
		'5000',
		'Informatique'
	));
	
	
	
	
	
	
	
	
}