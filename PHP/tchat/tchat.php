<?php
	/*
	EXERCICE: Espace de dialogue 
	
	1.			Modélisation et création de :
	la BDD tchat
	table: commentaire
			id_commentaire	// INT(11) PK -AI			(pk signifie primary key,ai signifie auto increment)
			pseudo			// VARCHAR (20)
			message			//TEXT
			date_Enregistrement		//DATETIME
			
	2.			connection à la BDD
	
	3.			Création du formulaire HTML(pour l'ajout de messages)
	
	4.			Controle de récupération des données saisies en PHP
	
	5.			Requete SQL d'enregistrement
	
	6.			Affichage des messages
	
	*/
	
$pdo = new PDO("mysql:host=localhost;dbname=tchat", 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::
MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') );



//INSERTION
if($_POST)
{
	foreach($_POST as $indice => $valeur)
	{
		$_POST[$indice] = htmlspecialchars(strip_tags($valeur));
		// EN clair, comme j'ai créé, avec le prepare, des boites, appellés "marqueurs nominatifs", lorsqu'un user malveillant 		
		// htmlspecialchars() combiné à strip_tags(),rend inofensif les saisies malveillantes de l'user. L'injection sql, qui detourne le comportement initial de la requete, est stoppée par le "prepare".
		
		//Prepare fait en sorte qu'on ne puisse plus ensuite faire de requetes SQL, lorsqu'il est combiné avec les 2 fonctions précitées (a savoir: htmlspecialchars ET STRIP_TAGS).
		//Preparer la requete SQL permet d'eviter les injections SQL qui detournent le comportement initial de la requete.
		// les marqueurs nominatifs ':pseudo' et ':message' peuvent se comparer à des boites ou sont stockées les données.
		//htmlspecialchars() permet de RENDRE INOFFENSIVES les balises HTML			si l'on voit des balises, on les insere dans la bdd mais on ne les interprete pas.
		//htmlentities() permet de CONVERTIR les balises en entités HTML ex: "<" devient "&lt"  ;   ">" devient "&gt"
		//strip_tags() permet de SUPPRIMER les balises HTML		ex: si on essaie de rentrer:  "<div>mon contenu</div>"	 la base ne va enregistrer que : "mon contenu"  sans enregister les balises <....>   



	}
	
	if(isset($_POST["pseudo"]) and isset($_POST["message"]) and !empty($_POST["pseudo"]) and !empty($_POST["message"]) )
	{
		//echo $madate=date("Y-m-d H:i:s");	// Attention:  Ne pas oublier de mettre les "" à l'intérieur de date("").  !!!!! Et Attention aussi a mettre la date au format Englais pour que la date s'enregistre: Y-m-d
		//$resultat = $pdo->exec("INSERT INTO commentaire(pseudo, date_Enregistrement, message) VALUES('$_POST[pseudo]','$madate','$_POST[message]')");
		
		//Correction du prof:
		//$req="INSERT INTO commentaire(pseudo, date_Enregistrement, message) VALUES('$_POST[pseudo]','$madate','$_POST[message]')";
		//$resultat = $pdo->exec($req);
		//echo $req;
		
		$resultat = $pdo->prepare("INSERT INTO commentaire(pseudo, date_Enregistrement, message) VALUES(:pseudo,NOW(),:message)");
		$resultat->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
		$resultat->bindValue(':message',$_POST['message'], PDO::PARAM_STR);
		
		$resultat->execute();
		
		echo '<div style="background:green; padding: 10px; text-align:center; border-radius:5px;width:200px;">vous etes bien enregistré !</div><br>';	// ATTENTION à bien mettre:          style = "...."
	}
	else
	{
		echo '<div style="background:red; padding: 10px; text-align:center; border-radius:5px;width:200px;">Veuillez remplir tous les champs!</div><br>';	// ATTENTION à bien mettre:          style = "...."
	}
}

//AFFICHAGE
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_Enregistrement,'%d/%m/%Y') AS dateFR, DATE_FORMAT(date_Enregistrement,'%H:%i:%s') AS heureFR  FROM commentaire order by date_Enregistrement DESC");
echo '<legend><h2>' . $resultat->rowCount() . ' commentaire(s)</h2></legend>';
while ($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)) 
{
	//CE QUE J'AI FAIT et qui fonctionne:				// Ma boucle while parcoure la table commentaire, ligne par ligne. 
    //foreach($commentaire as $indice=>$valeur)	 	//  ATTENTION! Ma boucle FOREACH parcoure l'ensemble des valeurs de ma ligne tandis que dans le code du prof, il appelle chaque champ separement.
    //{
    //    echo $indice.' : ' . $valeur . '<br>';
    //}
    //echo '<hr>';
	
	//CE QUE LE PROF A FAIT et qui a un rendu plus design
	//echo '<pre>'; print_r($commentaire); echo '</pre>';
	echo '<div class="message">';
		echo '<div class="titre">Par : ' . $commentaire["pseudo"] . ',le ' . $commentaire["dateFR"] . ' à ' . $commentaire["heureFR"] . '</div>';
		echo '<div class="contenu">' . $commentaire["message"] . '</div>';
	echo '</div><hr>';
}


// A SAVOIR: si un petit malin tape dans le champ message, ou le champ pseudo  des balises style ou des balises script:
//<style>
//body{display: none;}
//</style>

//ou

//<script type="text/javascript">
//var point = true;
//while(point == true)
//alert("bonjour");
//</script>

// on pourrait aussi insérer, mal-intentionnellement, dans le champ message:

//ok'); DELETE FROM commentaire; (
// INSERT INTO commentaire(pseudo, date_Enregistrement, message)VALUES( '' , NOW() , 'ok' ); DELETE FROM commentaire; (')		
// A SAVOIR : il faut, pour que ca fonctionne et donc que ca supprime tous les commentaires, 
//1- que la requete ne soit pas presente dans un autre ordre, comme par ex: pseudo, message, date_Enregistrement
//2- que ce bout de code [A savoir :ok'); DELETE FROM commentaire; ( ] soit colle dans le champ message et non pseudo.

// le resultat est que ca fait peter mon code.

// pour parer à ce type de pratique, utiliser STRIP_TAGS


?>
<!DOCTYPE html>
<html>
	<head>
		<title>TCHAT</title>
		<link rel="stylesheet" href="style.css">
		<style>
			label{
				float:left;
				width: 95px;
				font-style:italic;
				font-family: calibri;
			}
		</style>
	</head>
<body>	
	<H1>Enregistrez votre commentaire</h1>
	<form method="post" action="">
	<!-- method:cmt vont circuler les données.  Action: URL de destination -->
		<label for="pseudo">Pseudo</label>
		<input type="text" placeholder="pseudo" name="pseudo" id="pseudo"><br><br>
		<label for="message">Message</label>
		<textarea id="message" name="message"></textarea><br><br>
		<input type="submit" name="submit" value="Transmettre"> 
	</form>
</body>
<html>