<?php

//classe qui a ses propres proprietes et ses propres methodes

echo '<H2> 01. PDO: Connection BDD</h2>';
// mettre, entre les parentheses, le nom du serveur et la base de données
$pdo = new PDO("mysql:host=localhost;dbname=entreprise", 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::
MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') );

// arguments : 1(serveur + bdd), 2(identifiant), 3(mdp), 4 (options)
//pour plus d'info sur les options, taper sur google options pdo et regarder la doc de phpnet.

// PDO est une classe prédéfinie en PHP permettant de se connecter à une base de données. Cette classe possède ses propres propriétés et méthodes 

echo '<pre>'; var_dump($pdo); echo '</pre>';    // les :: c'est l'equivalent de -> . 
//On fait cette différence pour les objets que l'on crée nous meme avec (= new),    ( -> )
//et les objets déjà prédéfinis dans la classe PDO                                  ( :: )

//$pdo représente un objet issu de la classe pdo, permettant d'etre connecté a la base de données et de pouvoir formuler des requetes SQL

echo '<pre>'; print_r(get_class_methods($pdo)); echo '</pre>'; //get_class_methods est une fct, predefinie dans le code, ne faisant pas parti d'une classe, et nous permettant d'afficher toutes les methiodes issues de la classe pdo, via l'objet.


echo '<H2> 02. PDO: EXEC - INSERT, UPDATE, DELETE </h2>';

//INSERT
//$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche,salaire) VALUES('Jonathan','CHEMLA','m','commercial','2018-02-26',7000)"); // exec retourne le nbre de lignes qui ont ete affectées dans la bdd
//echo "Nombre d'enregistrements affectés par l'insert: $resultat <br>";

//UPDATE
//modification du salaire de l'employé 350 par 1200€
$resultat = $pdo->exec("UPDATE employes SET salaire= 5000 WHERE id_employes=350");
echo "Nombre d'enregistrements affectés par la modification: $resultat <br>";

//$pdo c'est un objet qu on a instancie qui permet de faire le lien avec la bdd.
// la fleche permet de piocher dans l'objet pour atteindre la methode issue de la classe.
// resultat =-1  lorsque la requete n'est pas bonne, 0 si aucune modif enregistrée(par ex, si la modif a deja enregistrée lors du precedent rafraichissement de la page)   1 si la ligne a bien ete modifiee.

//DELETE
// Exo : réaliser le script permettant de supprimer l'employe a 350.
$resultat = $pdo->exec("DELETE FROM employes WHERE id_employes=350");
echo "Nombre d'enregistrements affectés par la modification: $resultat <br>";


/*
EXEC() est une methode de la classe PDO permettant de formuler et d'executer des requêtes SQL
exec() est utilisé pour la formulation de requêtes ne retournant pas de résultat.
exec() renvoie le nombre de lignes affectées par la requête.
*/



echo '<H2> 03. PDO: QUERY - SELECT + FETCH_ASSOC(1 seul résultat) </h2>';


//exec est a utiliser quand il n'y a pas de retour
//query:              quand il y a un retour d'un jeu de résultats


$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes= 699");
//Lorsqu'on execute une requête de sélection via la méthode query() sur l'objet PDO:
//Succès: on obtient un autre objet, issu d'une autre classe : la classe PDOstatement. Cet objet a donc des méthodes et propriétés différentes!!
// Echec: boolean FALSE

//$resultat est inexploitable en l'état. Nous devons lui associer une méthode, feth(PDO::FETCH_ASSOC) qui permet de rendre le résultat exploitable sous forme de tableau ARRAY


echo '<pre>'; var_dump($resultat); echo '</pre>';
/*
object(PDOStatement)#2 (1) {
    ["queryString"]=>
    string(45) "SELECT * FROM employes WHERE id_employes= 699"
  }
*/
// au retour d'une requete de selection j'ai tjrs un objet

echo '<pre>'; print_r(get_class_methods($resultat)); echo '</pre>';

//$employe = $resultat->fetch(PDO::FETCH_ASSOC);      // j'obtiens ici $employe, qui est un TABLEAU issu de l'objet $resultat de la classe PDOStatement
//pour un tableau indexe avec le nom des champs
//$employe = $resultat->fetch(PDO::FETCH_BOTH);         // retourne aussi un TABLEAU
//pour un tableau indexe à la fois avec le nom des champs et numériquement
/*---------------------------------------------------------*/
$employe = $resultat->fetch(PDO::FETCH_OBJ);            // retourne cette fois-ci un objet
echo $employe->nom;
// retourne un objet avec le nom des champs comme propriété publique. On va pointer avec la fleche pour afficher la valeur de la propriété.
/*---------------------------------------------------------*/

echo '<pre>'; print_r($employe); echo '</pre>';
/*
Array
(
    [id_employes] => 699
    [prenom] => Julien
    [nom] => Cottet
    [sexe] => m
    [service] => secretariat
    [date_embauche] => 2007-01-18
    [salaire] => 1390
)
*/

//Exo: afficher les données à l'ide d'un affichage conventionnel(c est a dire: pas avec un print_r ou un var_dump)

foreach($employe as $indice => $valeur)     // FOREACH fonctionne aussi bien pour les tableaux Array que pour les objets à parcourir
{
    echo "$indice : $valeur <br>";
}

//echo implode("-",$employe); // ATTENTION !  lorsqu'on utilise implode(), ne pas oublier de mettre le ECHO devant implode


echo '<H2> 04. PDO: QUERY - WHILE + FETCH_ASSOC(plusieurs résultats) </h2>';


$resultat = $pdo->query("SELECT * FROM employes");
echo '<pre>'; var_dump($resultat); echo '</pre>';
echo 'Nombre d\'employe(s) : ' . $resultat ->rowcount() . "<br>";   // on aurait pu aussi faire un count(*) dans notre requete sql.
// rowcount() est une méthode issue de la classe PDOstatement qui permet de compter le nombre de lignes retournées par la requête de selection

while ($contenu = $resultat->fetch(PDO::FETCH_ASSOC))  //j'ai utilisé ici un print_r plutot qu'un var_dump car je sais que contenu sera un tableau et non un objet, car FETCH_ASSOC retourne tjrs un tableau et pas un objet
// pour chaque tour de boucle while, la variable $contenu contient un tableau Array par employé.
//tant qu'il y a des employés, la boucle tourne
{
    //  echo '<pre>'; print_r($contenu); echo '</pre>';
    foreach($contenu as $indice=>$valeur)
    {
        echo $indice.' : ' . $valeur . '<br>';
    }
    echo '<hr>';
}
// attention: Il n'ya pas un tableau avec tous les enregistrement mais 1 tableau Array par enregistrement, c'est a dire, un Array par employe.
// Notre requete sort plusieurs résultats?                                                  : Pensez à mettre une BOUCLE !!!
// Notre requete ne doit sortir qu'1 seul résultat?                                         :pas de boucle 
// Notre requete ne sort qu'un seul résultat et peut potentiellement en sortir plusieurs?   : une BOUCLE !!!

echo '<H2> 05. PDO: QUERY - FETCHALL + FETCH_ASSOC</h2>';
$resultat = $pdo->query("SELECT * FROM employes");
$donnees= $resultat->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>';

//Exo: Afficher successivement les donées de tous les employés à l'aide de boucle et avec un affichage conventionnel
echo '<pre>'; print_r(get_class_methods($resultat)); echo '</pre>';

$nb_employes=$resultat->rowcount();

for($i=0; $i<$nb_employes; $i++)		// ATTENTION a ne pas oublier le $ devant la variable i du for !!!
{
	foreach($donnees[$i] as $indice => $valeur)
	{
		echo "$indice => $valeur <br>";
	}
		echo '<hr>';
}
