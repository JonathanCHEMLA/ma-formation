<?php
echo '<h2>01. PDO : Connexion BDD </h2>';
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// arguments : 1 (serveur + bdd), 2(identifiant), 3 (mdp), 4 (options)
// PDO est une classe prédéfinie en PHP permettant de se connecter à une base de données. Cette classe possède ses propres propriétés et méthodes

echo '<pre>'; var_dump($pdo); echo '</pre>';
// $pdo représente un objet issu de la classe PDO permettant d'être connecté à la BDD et de pouvoir formuler des requêtes SQL.

echo '<pre>'; print_r(get_class_methods($pdo)); echo '</pre>';// get_class_methods est une fonction prédéfinie permettant d'afficher les méthodes issu de la classe PDO via l'objet

echo '<h2>02. PDO : EXEC - INSERT, UPDATE, DELETE </h2>';
// Formuler une requete vous permettant de vous insérer dans la table employé 
// INSERT 
// $resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire)VALUES('Grégory', 'LACROIX', 'm', 'informatique', '2018-02-26', 15000)");
//echo "Nombre d'enregistrement affecté par l'insert : $resultat<br>";

// UPDATE 
// modification du salaire de l'employé 350 par 1200
$resultat = $pdo->exec("UPDATE employes SET salaire = 1200 WHERE id_employes = 350");
echo "Nombre d'enregistrement affecté par la modification : $resultat<br>";

// DELETE
// Exo : réaliser le script permettant de supprimer l'employé 350 
$resultat = $pdo->exec("DELETE FROM employes WHERE id_employes = 350");
echo "Nombre d'enregistrement affecté par la suppression : $resultat<br>";

/*
EXEC() est une méthode issu de la classe PDO permettant de formuler et d'executer des requêtes SQL
exec() est utilisé pour la formulation de requêtes ne retournant pas de résultat
exec() renvoie le nombre de lignes affectées par la requête
*/

echo '<h2>03. PDO : QUERY - SELECT + FETCH_ASSOC (1 seul résultat)</h2>';
$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes = 699");
// Lorsqu'on execute une requete de selection via la méthode query() sur l'objet PDO :
// Succés : on obtient un autre objet issu d'une autre class PDOStatement. ce objet a donc des mérthodes et propriétés différents !! 
// Echec : boolean FALSE
// $resultat est inexploitable en l'état, nous devons lui associer une méthode , fetch(PDO::FETCH_ASSOC) qui permet de rendre le résultat exploitable sous forme de tableau ARRAY

echo '<pre>'; var_dump($resultat); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($resultat)); echo '</pre>';

$employe = $resultat->fetch(PDO::FETCH_ASSOC); // pour un tableau indexé avec le nom des champs
echo $employe['prenom'];
//$employe = $resultat->fetch(PDO::FETCH_BOTH); // index à la fois numériquement etg avec le nom des champs

//$employe = $resultat->fetch(PDO::FETCH_OBJ); // retourne un objet avec le noms des champs comme propriété public, on va pointer avec la flèche pour afficher la valeur de la propriété 
//echo $employe->nom;

echo '<pre>'; print_r($employe); echo '</pre>';
// Exo : afficher les données à l'aide d'un affichage conventionnel
foreach($employe as $indice => $valeur)
{
	echo $indice . ' : ' . $valeur . '<br>'; 
}

echo '<h2>04. PDO : QUERY - WHILE + FETCH_ASSOC (plusieurs résultats)</h2>';

$resultat = $pdo->query("SELECT * FROM employes");
echo '<pre>'; var_dump($resultat); echo '</pre>';
echo 'Nombre d\'employe(s) : ' . $resultat->rowCount() . "<br>"; // rowCount() est une méthode issu de la classe PDOStatement qui permet de compter le nombre de ligne retournées par la requête de selection

while($contenu = $resultat->fetch(PDO::FETCH_ASSOC)) // pour chaque tour de boucle while, la variable $contenu contient un tableau ARRAY par employé, tant qu'il y a des employés la boucle tourne
{
	//echo '<pre>'; print_r($contenu); echo '</pre>';
	foreach($contenu as $indice => $valeur)
	{
		echo $indice . ' : ' . $valeur . '<br>'; // on passe en revue les tableaux ARRAY de chaque employé
	}
	echo '<hr>';
}

// Attention, il n'y a pas un tableau avec tout les enregistrements dedans mais un tableau ARRAY par enregistrement, un ARRAY par employé!!
// votre requête sort plusieurs résultats ? : une boucle !!
// votre requete ne doit sortir qu'un seul et unique résultat ? : pas de boucle 
// votre requete ne sort qu'un seul résultat et peu potentiellement en sortir plusieurs ? : une boucle!!!

echo '<h2>05. PDO : QUERY - FETCHALL + FETCH_ASSOC</h2>';
$resultat = $pdo->query("SELECT * FROM employes");
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>';
// Exo : afficher successivement les données de tout les employés à l'aide de boucle et avec un affichage conventionnel
foreach($donnees as $indice => $valeur)
{
	foreach($valeur as $index => $value)
	{
		echo $index . ' : ' . $value . '<br>'; 
	}
	echo '<hr>';
}

echo '<h2> 06. PDO : QUERY - FETCH + BDD </h2>';
// Exercice : Afficher la liste des base de données. puis la mettre dans une liste ul li
$resultat = $pdo->query("SHOW DATABASES");
echo '<pre>'; var_dump($resultat); echo '</pre>';



echo '<ul>';
while($bdd = $resultat->fetch(PDO::FETCH_ASSOC))
{
	//echo '<pre>'; print_r($bdd); echo '</pre>';
	echo '<li>' . $bdd['Database'] . '</li>'; 
}
echo '</ul>';

echo '<div class="test">Test</div>';

echo '<h2>07. PDO : QUERY - TABLE </h2>';
$resultat = $pdo->query("SELECT * FROM employes");

echo '<table border=1><tr>';
for($i = 0; $i < $resultat->columnCount(); $i++) // columnCount() est une méthode issu de la classe PDOStatement qui retourne le nombre de champs/colonnes de la table, tant qu'il y a des colonnes, on boucle
{
	$colonne = $resultat->getColumnMeta($i); // getColumnMeta() est une méthode issu de la classe PDOStatement qui recolte les informations des champs/colonnes de la table, pour chaque tour de boucle, $colonne contient un tableau ARRAY avec les infos d'une colonne
	//echo '<pre>'; print_r($colonne); echo '</pre>';
	echo '<td>' . $colonne['name'] . '</td>'; // on va crocheter à l'indice 'name' pour afficher le nom des colonnes
}
echo '</tr>';
while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) // on associe la méthode fecth() au résultat, $ligne contient un tableau ARRAY avec les informations d'un employé à chaque tour de boucle
{
	echo '<tr>'; // on crée une nouvelle du tabeau pour chaque employé
	foreach($ligne as $informations) // passe en revue le tableau ARRAY d'un employé
	{
		echo '<td>' . $informations . '</td>'; // on affiche successivement les valeurs dans des cellules
	}
	echo '</tr>';
}
echo '</table>';
// on ne peut associer 2 fois la même méthode sur le même résultat, on ne pas associer 2 fecth(PDO::FETCH_ASSOC) sur le même résultat

echo '<h2>08. PDO : PREPARE + BINDVALUE + EXECUTE </h2>';

$nom = "Quittard";
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
// Préparation de la requête :
// soulage le serveur et la BDD à l'execution, previens pour les injections SQL et les failles XSS
// ':nom' est un marqueur nominatif, on prépare le requête mais on ne l'execute pas

echo '<pre>'; print_r($resultat); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($resultat)); echo '</pre>';

$resultat->bindValue(':nom', $nom, PDO::PARAM_STR); // bindValue() est une méthode permettant d'associer une valeur au marqueur ':nom'. nom du marqueur/valeur du marqueur/type de données

$resultat->execute(); // execution de la requete
// on formule la requête une seule fois à tout moment dans le script nous pouvons l'executer.

$donnees = $resultat->fetch(PDO::FETCH_ASSOC); // une fois executé, on associe une méthode pour rendre le résultat exploitable
echo '<pre>'; print_r($donnees); echo '</pre>';
//------------------------------------------------------
$resultat->bindValue(':nom', 'LACROIX', PDO::PARAM_STR); // on associe une nouvelle valeur au marqueur

$resultat->execute();// execution de la requete

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>';
//-------------------------------------------------------












