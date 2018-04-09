<style>
	h2{
		margin: 0;
		font-size: 15px;
		background: #dedede;
		text-align: center;
		padding: 10px;
	}
</style>
<h2>Ecriture et affichage</h2>
<!-- nous pouvons écrire du HTML dans un fichier ayant l'extension PHP, l'inverse n'est pas possible -->
<?php
echo 'Bonjour'; // echo est une instruction qui nous permet d'effectuer un affichage, on peux le traduire par 'affiche moi'
echo '<h3>Bonjour</h3>';
// on peut également y mettre du HTML,  si on observe le code source, vous ne verrez pas le PHP car le langage est interprété
echo '<hr><h2>Commentaires</h2>';
?>
<strong>Bonjour</strong><!-- nous voyans qu'il est également possible de fermer et ré-ouvrir php pour mélanger du code html&PHP -->
<?= "Allo" ?><!-- le = remplce le echo -->

<?php
echo 'texte'; // ceci est un commentaire sur une seule ligne
echo 'texte'; /*
ceci est un commentaire sur plusieurs lignes
*/
echo 'texte'; # ceci est un commentaire sur une seule ligne
print 'Nous sommes mercredi'; // print est une autre instruction d'affichage. Il n'y a pas de différence entre echo et print
// Vous n'êtes pas obligé de fermer la balise php "? >" si sur la page nous codons seulement du PHP
//----------------------------------------------
echo '<hr><h2>Variables : types / Déclaration / affectation </h2>';
// une variable est un espace nommé permettant de conserver une valeur
// on déclare toujours une varaible avec le signe dolla '$' suivi du nom de la variable
// ex : $a2 -> ok ----- $2a -> erreur, jamais de chiffre aprés le signe dollar, pas d'accent, pas d'espace
$a = 127; //affectation de la valeur 127 dans la variable nommé "a"
echo gettype($a); // gettype() est une fonction prédéfinie dans le code PHP permettant de voir le type d'une variable. il s'agit d'un entier : integer.
echo '<br>';
$b = 1.5;
echo gettype($b); // un nombre à virgule : double
echo '<br>';
$c = "une chaine";
echo gettype($c); // une chaine de caractère : string
echo '<br>';
$d = '127';
echo gettype($d); // avec les quotes, le type retourné est une chaine de caractères ; string
echo '<br>'; 
$e = true;
echo gettype($e); // boolean
echo '<br>'; 
$f = false;
echo gettype($f); // boolean
echo '<br>'; 

//-----------------------------------------------
echo '<hr><h2> concaténation  </h2>';
$x = "bonjour";
$y = " tout le monde";
echo $x . $y . "<br>"; // point de concaténation que l'on peux traduire par "suivi de"
echo "$x $y <br>"; // entre guillemets, les variables sont évaluées
echo '$x $y <br>'; // entre quote, c'est une chaine de caractères, les variables ne sont pas évaluées
echo 'aujourd\'hui'; // avec les simple quote, si nous envoyons une chaine de caractère avec un apostrophe, cela génère une erreure, nous sommes obligé de placer un antislash '\' pour préciser que c'est une apostrophe
echo "aujourd'hui<br>";
echo "Hey ! " . $x . $y; // concaténation texte et variable
echo "<br>" , "coucou" , "<br>"; // concaténation avec une virgule (la virgule et le point de concaténation sont similaires)

//----------------------------------------------
echo '<hr><h2>Concaténation lors de l\'affectation</h2>';
$prenom1 = "Grégory"; 
$prenom1 = "Andrei";
echo $prenom1 . '<br>'; // cela remplace Grégory par Andrei

$prenom2 = "Grégory";
$prenom2 .= " Andrei";
echo $prenom2; // cela ajoute Andrei sans remplacer la valeur Grégory grace à l'opérateur '.='

//-----------------------------------------------
echo '<hr><h2>Constante et constante magique</h2>';
// une constante tout comme une variable permet de conserver une valeur, mais comme son nom l'indique, elle est constante!! c'est à dire que l'on ne pourra la modifier durant l'execution du script. contrairement à une variable, qui elle peut varier !!
define("CAPITALE", "Paris"); // par convention, une constante se déclare toujours en majuscule
echo CAPITALE . "<br>"; // affichage de la constante

// define("CAPITALE", "Rome"); /!\ erreur, on ne peut pas modifier une constante déja définie

// constante magique 
echo __FILE__ . '<br>'; // chemin  complet vers le fichier
echo __LINE__ . '<br>'; // affiche le numéro de la ligne

//---------------------------------------------------------
// Exercice variables : afficher bleu-blanc-rouge (avec les tirets) en mettant chaque couleur dans une variable
$bleu = "bleu";
$blanc = "blanc";
$rouge = "rouge";
echo $bleu . '-' . $blanc . '-' . $rouge . '<br>';
echo "$bleu-$blanc-$rouge<br>";

//---------------------------------------------------------
echo '<hr><h2>Opérateurs arithmétiques</h2>';
$a = 10; $b = 2;
echo $a + $b . "<br>"; // affiche 12
echo $a - $b . "<br>"; // affiche 8
echo $a * $b . "<br>"; // affiche 20
echo $a / $b . "<br>"; // affiche 5

// opération/affectation
$a = 10; $b = 2;
$a += $b; // equivaut à $a = $a + $b
echo $a . "<br>"; // affiche 12 
$a -= $b; // equivaut à $a = $a - $b
echo $a . "<br>"; // affiche 10
$a *= $b; // equivaut à $a = $a * $b
echo $a . "<br>"; // affiche 20
$a /= $b; // equivaut à $a = $a / $b
echo $a . "<br>"; // affiche 10

//--------------------------------------------
echo '<hr><h2>structure conditionnelle (if / else)</h2>';
// isset et empty
$var1 = 0;
$var2 = "";
if(empty($var2))
{
	echo '0, vide ou non définie<br>';
}
// empty test si une variable à la valeur de '0', si elle est vide ou si elle n'est pas définie
if(isset($var2))
{
	echo "var2 existe et est définie par rien<br>";
}
// isset test l'existance d'une variable, si elle existe, si elle est déclarée, si elle est définie
if(isset($var2) && !empty($var2))
{
	echo '$var2 existe et n\est pas vide';
}

// opérateur de comparaison
/*
= 	est égal à / affectation
==  comparaison de la valeur
=== comparasion de la valeur et du type
>	strictement supérieur à
< 	strictement inférieur à
=> 	supérieur ou égal à
=<	inférieur ou égal à 
!=	différent de
! 	n'est pas
&& AND et
|| OR ou 
XOR ou  exclusif
*/

$a = 10; $b = 5; $c = 2;
if($a > $b) // si A est supérieur à B
{
	echo "A est bien supérieur à B<br>";
}
else // cas par défaut, dans tout les autres cas, on tombe dans la condition else
{
	echo "Non c'est B qui est supérieur à A<br>";
}
//------------------------------------------------
if($a > $b && $b > $c)
{
	echo "OK pour les 2 conditions<br>";
}
if($a == 9 || $b > $c)
{
	echo "ok pour au moins l'une des 2 conditions<br>";
}
else
{
	echo "Nous sommes dans le else";
}
//-----------------------------------------------
$a = 10; $b = 5; $c = 2;
if($a == 10)
{
	echo "1 - A est égal à 10<br>";
}
elseif($b == 5)
{
	echo "2 - B est égal à 5<br>";
}
else
{
	echo "3 - tout le monde a faux<br>";
}
// si la première condition est respectée, avec le elseif stop le script malgrés que la duxième condition soit respectée. On peut declarer une condition avec plusieurs elseif, en revanche il n'y a qu'un seul cas par défaut "else"

//---------------------------------------------------
// condition exculsive
if($a == 10 XOR $b == 6)
{
	echo "ok condition exclusive<br>"; // si les 2 conditions sont bonne ou si les conditions sont mauvaises, nous ne rentrons pas ici
}

//---------------------------------------------------
// forme contractée : 2ème possibilité d'écriture d'un if
echo ($a == 10) ? "A est égal à 10<br>" : "A n'est pas égal à 10";
// le ? remplace le if et les 2 points ':' remplace le else
	
//---------------------------------------------------
// comparaison
$vara = 1;
$varb = "1";
if($vara === $varb)
{
	echo "il s'agit de la même chose";
}
// Avec la présence du triple égal, la condition n'est pas respectée car les valeurs sont les même mais les types sont différents.
// Avec le double égal, le test fonctionne puisque les valeurs sont les même.
// == comparaison de la valeur
// === comparaison de la valeur et du type

//---------------------------------------------------
echo '<hr><h2>condition switch</h2>';
$couleur = "jaune";
switch($couleur)
{
	case 'bleu': 
	echo "Vous aimez le bleu";
	break;
	
	case 'rouge': 
	echo "Vous aimez le rouge";
	break;
	
	case 'vert': 
	echo "Vous aimez le vert";
	break;
	
	default:
	echo "vous n'aimez rien<br>";
	break;
}
// les case représente les différents dans lesquel nous poouvons potentiellement tomber, break stop  l'execution du script si un des cas est vérifié
// si aucun des cas n'est vérifié, nous tombons dans le cas par défaut "default"

// Exercice : pouvez vous faire la même chose que le switch avec des if/else?
$couleur = "jaune";

if($couleur == "bleu")
{
	echo "Vous aimez le bleu<br>";
}
elseif($couleur == "rouge")
{
	echo "Vous aimez le rouge<br>";
}
elseif($couleur == "vert")
{
	echo "Vous aimez le vert<br>";
}
else{
	echo "vous n'aimez rien<br>";
}
//--------------------------------------------------------
echo "<h2>Fonctions prédéfinie : traitement des chaines </h2>";
// une fonction prédéfinie permet de réaliser un traitement spécifique
echo "Date: ";
echo date("d/m/y") . "<br>"; // exemple de fonction prédéfinie retournant la date du jour. 
// lorsqu'on utilise une fonction prédéfinie, il faut toujours se poser la question : quels paramètres doit on envoyer à la fonction et surtout savoir ce qu'elle retourne
// toujours penser à consulter la documentation

//---------------------------------------------------------
$email1 = "glx78@free.fr";
echo strpos($email1, "@"); // retourne la position du caractère "@" dans la chaine de caractère
// strpos est une fonction prédéfinie permettant de trouver un caractère spécifique dans une chaine  
/*
	arguments : 
	1 - nous devons lui fournir la chaine dans laquelle nous souhaitons chercher
	2 - nous lui dennons l'information à  chercher
*/
echo '<br>';
$email2 = "bonjour";
echo strpos($email2, "@"); // cette ligen ne sort rien pourtant il y a bien quelque chose à l'intérieur : FALSE!!
var_dump(strpos($email2, "@")); // Grace à var_dump on aperçoit le FALSE si le caractère "@" n'est pas trouvé. var_dump est donc une instruction d'affichage améliorée, on l'utilise régulièrement en phase de developpement
echo '<br>';
//---------------------------------------------------------
$phrase = "Mettez du texte à cet endroit";
echo iconv_strlen($phrase); // affiche 29
/*
iconv_strlen() est une fonction prédéfinie permettant de retourner la taille d'une chaine
Succés : INT 
Echec : boolean  FALSE
Contexte : nous pourrons l'utiliser pour savoir si le pseudo et le mdp lors d'une inscription ont des tailles conformes
*/
echo '<br>';
//-----------------------------------------------------------
$texte = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu dui sed neque varius hendrerit. Nullam id sollicitudin purus. Ut ac lorem non tortor vulputate aliquam. In ut nisl venenatis, dapibus odio in, vestibulum lacus.";
echo substr($texte, 0, 20) . "...<a href=''> Lire la suite </a>"; 
/* 
	substr() est une fonction prédéfinie permettant de retouner une partie de la chaine
	arguments : 
	1 - la chaine à couper
	2 - la postion de début
	3 - la postion de fin
	contexte : sur certains articles, on a une accroche puis un lien permettant de voir le reste de l'article
*/

echo "<h2>Fonctions utilisateur </h2>";
// Les fonctions qui ne sont prédéfinies dans le langage sont déclarés puis executé par l'utilisateur
function separation() // déclaration d'une fonction prévu pour ne pas recevoir d'arguments
{
	echo "<hr><hr><hr>"; // voici une simple fonction permettant de tirer 3 trait sur la page web
}

separation(); // execution de la fonction 

//---------------------------------------------------
// fonctions avec arguments : les arguments sont des paramètres fournis à la fonction et lui permettent de compléter ou de modifier son comportement initiazl prévu
// on peut affecter une valeur par défaut à la variable de réception, dans ce cas à l execution, il n'est pas nécessaire de lui envoyer un argument si l'on veut afficher sa valeur par defaut
function bonjour($qui = "Grégory") // $qui ne sort pas de null part. Cela permet de pervoir un argument , il s'agit d'une variable de réception
{
	echo "Bonjour $qui <br>";
}

bonjour("Pierre"); // si la fonction reçoit un argument, il faut lui envoyer un argument
$prenom = "Andrei";
bonjour($prenom); // l'argument peut être une variable

//---------------------------------------------------
function joursemaine()
{
	$jour = "Jeudi"; // variable déclaré dans l'espace locale, c'est à dire à l'intérieur de la fonction 
	return $jour . "<br>"; // une finction peut retourner un résultat, c'est pour cela que l'on utilise le mot clé "return", à ce moment la on sort de ma fonction et tout le code déclaré aprés ne sera pas executé
	echo 'ALLO'; // ne sort pas à cause du "return"
}

echo joursemaine();
echo $jour;// /!\ ne fonctionne pas car cette variable n'est connu qu'à l'intérieur de la fonction
$recup = joursemaine(); // on récupère
echo $recup; // on affiche

//------------------------------------------------------
$pays = "France<br>"; // variable déclarée dans l'espace global, c'est à dire à l'exetèrieur d'une fonction, c'est l'espace par défaut 
function affichagePays()
{
	global $pays; // pour importer une variable déclarée en global vers l'espace local, nous devons utiliser le mot clé "global"
	echo $pays;
}
affichagePays(); // execution de la fonction
// on ne peut pas déclarer 2 fois une fonction avec le même nom.

//------------------------------------------------------
function appliqueTva($nombre)
{
	return $nombre*1.2;
}

echo appliqueTva(500) . "<br>";

// Exercice : Pourriez-vous améliorer cette fonction afin que l'on puisse calculé un nombre avec les taux de notre choix (19,6%, 5.5%, 7%)

function appliqueTva2($nombre, $taux = 20) // argument initialisé par defaut à 20%
{
	return $nombre*(1+$taux/100);
}

echo appliqueTva2(500) . "<br>"; // $taux a une valeur par defaut donc à l'execution, il n'est pas nécessaire de lui envoyer un 2ème argument
echo appliqueTva2(500, 5.5) . "<br>"; // le 2ème argument "5.5" ecrase la valeur par défaut de la variable $taux
echo appliqueTva2(500, 19.6) . "<br>";
echo appliqueTva2(500, 7) . "<br>";

//------------------------------------------------------
meteo("hiver", 0); // on peux executer une fonction avant de l'avoir déclaré
function meteo($saison, $temperature)
{
	echo "Nous sommes en $saison et il fait $temperature degre(s)<br>";
}

// Exercice : gérer le S de degré avec des if/else
	
function exoMeteo($saison, $temperature)
{
	echo "Nous sommes en $saison et il fait $temperature";
	if($temperature > 1 || $temperature < -1)
	{
		echo " degrés<br>";
	}
	else
	{
		echo " degré<br>";
	}
}

exoMeteo("hiver", 0);
exoMeteo("hiver", 1);
exoMeteo("hiver", -1);
exoMeteo("hiver", -15);
exoMeteo("hiver", 15);

//-------------------------------------------------------
echo "<h2>Boucle : structure itérative </h2>";
$i = 0; // valeur de départ
while($i < 3) // tant que la variable $i est inférieur à 3
{
	echo "$i---"; // pour chaque tour de boucle, on affiche la valeur de $i suivi de 3 tirets '---'
	$i++; // equivaut à $i = $i + 1; l'incrémentation du "compteur" est effectuée à chaque tour de boucle
}

echo '<br>';
// Exercice : faites en sorte ne pas avoir les tirets à la fin : 0---1---2
$j = 0;
while($j < 3)
{
	if($j == 2)
		echo $j . "<br>"; // je ne rentre qu'une seule fois ici
	else
		echo "$j---"; // dans tout les autre cas, on tombe dans le else
	$j++; // incrémentation
}
// quand il n y a qu'une seul instruction dans un if , else : les accolades sont facultatives, neammoins il est conseillé de les inscrire quand on débute

//-----------------------------------------------------------------
// boucle for
for($j = 0; $j < 16; $j++) // valeur de départ; condition d'entrée; incrémentation 
{
	
	echo $j . "<br>";
}

// Exercice : afficher 30 options via une boucle
echo '<select>';
echo '<option>1</option>';
echo '<option>2</option>';
echo '<option>3</option>';
echo '<option>4</option>';
echo '<option>5</option>';
echo '</select><br>';

echo '<select>';
for($i = 0; $i < 31; $i++)
{
	echo "<option>$i</option>";
}
echo '</select>';
//--------------------------------------------------------

// Exercice : Faites une boucle de 0 à 9 sur la même ligne dans un tableau  HTML
echo '<table>'; // décalration du tableau
	echo '<tr>'; // déclaration d'une ligne
		echo '<td>'; // déclaration d'une cellule
		echo '</td>';
	echo '</tr>';
echo '</table>';

echo '<table border=1><tr>';
for($i = 0; $i < 10; $i++)
{
	echo "<td>$i</td>";
}
echo '</tr></table><br>';

// Exercice : Faites la même chose en allant de 0 à 99 sur plusieurs lignes sans faire 10 boucles
$z = 0;
echo '<table border=1>';
for($ligne = 0; $ligne < 10; $ligne++)
{
	echo '<tr>';
	for($cellule = 0; $cellule < 10; $cellule++) // tant que ligne est à zéro, cellule s'incrémente 10 fois, ligne est à 1, cellule s'incrémente 10 fois etc..
	{
		echo '<td>' . $z . '</td>'; // $z ne reviens jamais à 0 puisqu'on l'incrémente à chaque tour de boucle
		$z++; // $z = $z + 1;
	}
	echo '</tr>';
}
echo '</table><br>';

echo '<table border=1>';
for($ligne = 0; $ligne < 10; $ligne++)
{
	echo '<tr>';
	for($cellule = 0; $cellule < 10; $cellule++)
	{
		echo '<td>' . (10 * $ligne + $cellule) . '</td>';
		$z++; // $z = $z + 1;
	}
	echo '</tr>';
}
echo '</table>';	

echo "<h2>Boucle : tableau de données ARRAY </h2>";

$liste = array("Grégory","John","Andrei","Adeline");
echo $liste; // /!\ attention erreur, on ne peux pas afficher les données d'un tableau avec une instruction d'affichage classique
echo '<pre>'; var_dump($liste); echo '</pre>';
echo '<pre>'; print_r($liste); echo '</pre>';
// var_dump et print_r sont des instructions d'affichage améliorées. pre est une balise HTML permettant de formater le texte, cela nous permet de mettre en forme la sortie du print_r
// contexte : lorsqu'on récupère des informations en BDD, nous les retouverons sous forme d'ARRAY

//---------------------------------------------------------
echo "<h2>Boucle : boucle foreach pour les tableaux de données ARRAY </h2>";
$tab[] = "France";
$tab[] = "Italie";
$tab[] = "Espagne";
$tab[] = "Portugal";
$tab[] = "Angleterre";
$tab[] = "Suisse"; // autre moyen de déclarer un tableau ARRAY, à l'aide des crochets '[]'

echo '<pre>'; print_r($tab); echo '</pre>';

// Exercice : tenter de sortir "italie" en passant par le tableau ARRAY sans faire un echo "italie"

echo $tab[1] . '<hr>'; // on va crocheter à l'indice 1 du tableau de données ARRAY

foreach($tab as $info) // le mot AS fait partie du langage et est obligatoire. $info vient parcourir la colonne des valeurs du tableau de données ARRAY, pour chaque de boucle , elle possède une valeur différente
{
	echo $info . "<br>"; // on affiche successivement les éléments du tableau
}
echo '<hr>';
//------------------------------------------------------
foreach($tab as $indice => $info) // quand il y a 2 variables, la 1ère parcours la colonne des indices et la 2ème parcours la colonne des valeurs
{
	echo $indice . ' => ' . $info . '<br>'; // on affiche successivement l'indice en finction de la valeur		
}

$couleur = array("j" => "jaune", "r" => "rouge", "v" => "vert", "b" => "bleu"); // il est possible de définir les indices du tableau de donnée ARRAY
echo '<pre>'; print_r($couleur); echo '</pre>';

// Exercice : afficher successivement les données (indice, valeur) du tableau représenté par la variable $couleur

foreach($couleur as $indice => $valeur)
{
	echo $indice . ' => ' . $valeur . '<br>'; 
}

echo 'Taille du tableau : ' . count($couleur) . "<br>"; // affiche 4 
echo 'Taille du tableau : ' . sizeof($couleur) . "<br>"; // siezof est pareil que count pas de différence, ce sont des fonctions prédéfinies permettant de rertouner la taille du tableau

echo implode("-", $couleur); // implode() est une fonction prédéfinie qui rassemble les éléments d'un tableau en une chaine (séparé par un symbole)

echo "<h2> tableau de données ARRAY mutidimensionnel </h2>";

$tab_multi = array(
				0 => array("prenom" => "Grégory", "nom" => "Lacroix"),
				1 => array("prenom" => "Adeline", "nom" => "Clere")
			);

echo '<pre>'; print_r($tab_multi); echo '</pre>';
// Exercice : tenter de sortir "Clere" en passant par les tableaux ARRAY et sans faire de echo "Clere"	

echo $tab_multi[1]["nom"] . '<hr>';

// Exercice : extraire les valeurs des tableaux multi à l'aide de boucle	
						
foreach($tab_multi as $indice1 => $tableau)
{
	echo implode("-", $tableau) . '<br>';
	echo '<hr>';
}
//---------------------------------------
												
foreach($tab_multi as $indice1 => $tableau)
{
	foreach($tableau as $indice2 => $valeur)
	{
		echo $indice2 . ' : ' . $valeur . "<br>";
	}
	echo '<hr>';
}

foreach($tab_multi as $indice1 => $valeur)
{
	foreach($valeur as $indice2 => $valeur2)
	{
		echo $indice2 . ' - ' . $valeur2;
	}
}

echo '<h2>Classe et objet</h2>';
// un objet est un autre type de données. Un peu à la manière d'un ARRAY, il permet de regrouper des informations.
// cependant cela va beaucoup plus loin car on peux y déclarer des variables (appelés : propriétés) mais aussi des fonctions (appelés : méthodes)

class Etudiant
{
	public $prenom = "Grégory"; // public permet de préciser que l'élément sera visible de partout (il y a aussi protected et private)
	public $age = 25; // déclaration d'une propriété public
	public function pays() // déclaration d'une fonction public
	{
		return "France";
	}
}

$objet = new Etudiant(); // new est un mot clé permettant d'instancier la classe et d'en faire un objet. C'est ce qui nous permet de le deployer afin que l'on puisse s'en servir. On se sert de ce qui est dans la classe via l'objet
echo '<pre>'; var_dump($objet); echo '</pre>';
echo $objet->prenom . '<br>'; // nous pouvons piocher dans un ARRAY avec les criochets, nous devons piocher dans un OBJET avec une flèche
echo $objet->age . '<br>';
echo $objet->pays() . '<br>'; // appel d'une méthode toujours avec une parenthèse















		

	


















