<?php
//------------- FONCTION DEBUG
function debug($var, $mode = 1)
{
	echo '<div style="background: orange; padding: 5px;">';
	$trace = debug_backtrace(); // fonction prédéfinie retournant un tableau ARRAY contenat des informations tel que la ligne et le fichier où est executé la fonction
	//echo '<pre>'; print_r($trace); echo '</pre>';
	$trace = array_shift($trace); // 
	//echo '<pre>'; print_r($trace); echo '</pre>';
	echo "Debug demandé dans la fichier : $trace[file] à la ligne $trace[line]. <hr>";
	if($mode === 1)
	{
		echo '<pre>'; print_r($var); echo '</pre>'; 
	}
	else
	{
		echo '<pre>'; var_dump($var); echo '</pre>';
	}
	echo '</div>';
}

//------------------------------------------
function internauteEstConnecte() // cette fonction indique si le membre est connecté
{
	if(!isset($_SESSION['membre'])) // si l'indice membre dans le fichier session n'est pas définit, c'est que l'internaute n'est pas passé par la page connexion
	{
		return false;
	}
	else
	{
		return true;
	}
}

//------------------------------------------
function internauteEstConnecteEtEstAdmin()
{ // cette fonction m'indique si le membre est admin
	if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) // si la session du memebre est définie et que son statut est à 1, cela veut dire qu'il est admin, on retourne true
	{
		return true;
	}
	else
	{
		return false;
	}
}

//-------------- PANIER -----------------//
function creationDuPanier()
{
	if(!isset($_SESSION['panier'])) // si l'indice panier dans la session n'est pas définie, c'est que ml'internaute n'a pas ajouté de produit dans le panier, donc on créer le panier dans la session
	{
		$_SESSION['panier'] = array(); 
		$_SESSION['panier']['titre'] = array(); // un tableau pour chaque indice, nous pouvons avoir plusieurs produits dans le panier
		$_SESSION['panier']['id_produit'] = array();
		$_SESSION['panier']['quantite'] = array();
		$_SESSION['panier']['prix'] = array();
	}
}

//--------------------------------------------
function ajouterProduitDansPanier($titre,$id_produit,$quantite,$prix) // fonction utilisateur recevant 4 arguments qui seront conservé dans la session 'panier'
{
	creationDuPanier(); // on contrôle si le panier existe ou non dans la session
	
	$position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']);
	// on contrôle grace à la fonction prédéfinie array_search si l'id_produit que l'internaute vient d'ajouter au panier, si il existe dèja dans la session et à quel indice il se trouve
	//echo $position_produit;
	
	if($position_produit !== false) // si position produit est différent de false, c'est à dire qu'il retourne l'indice de l'id_produit trouvé
	{
		$_SESSION['panier']['quantite'][$position_produit] += $quantite; // on change la quantite à l'indice trouvé
	}
	else // sinon, le produit n'existe pas dans la session, donc on stock les informations aux différents tableau
	{
		$_SESSION['panier']['titre'][] = $titre; // les [] vide permettent de créer par défaut des indices numérique pour les données
		$_SESSION['panier']['id_produit'][] = $id_produit;
		$_SESSION['panier']['quantite'][] = $quantite;
		$_SESSION['panier']['prix'][] = $prix;
	}
}

//--------------------------------
function montantTotal()
{
	$total = 0;
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) // la boucle tourne tant qu'il y a des id_produit dans la session
	{
		$total += $_SESSION['panier']['quantite'][$i]*$_SESSION['panier']['prix'][$i]; // on multiplie la quantité par le prix pour chaque indice
	}
	return round($total,2); // on retourne le resultat arrondi à 2 chiffres aprés la virgule
}

//----------------------------------------
function retirerProduitDuPanier($id_produit_a_supprimer)
{
	$position_produit = array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']); // grace à la fonction prédéfinie array_search(), on va chercher à quel indice se trouve le produit à supprimer dans la session 'panier'

	if($position_produit !== false) // si la variable $position_produit retourne une valeur différente de false, cela veut dire qu'un indice a bien été trouvé dans la session  'panier' 
	{
		// la fonction array_splice() permet de supprimer une ligne dans le tableau session, et elle remonte les indices inférieur du tableau aux indices supérieur du tableau, si je supprime un produit à l'inidice 4, tout les produit aprés l'indice 4 remontrons tous d'un indice
		// cela permet de réorganiser le tableau panier dans la session et de ne pas avoir d'indice vide 
		array_splice($_SESSION['panier']['titre'], $position_produit,1);
		array_splice($_SESSION['panier']['id_produit'], $position_produit,1);
		array_splice($_SESSION['panier']['quantite'], $position_produit,1);
		array_splice($_SESSION['panier']['prix'], $position_produit,1);
	}		
}

















