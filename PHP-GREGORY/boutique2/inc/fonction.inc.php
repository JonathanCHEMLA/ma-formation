<?php
//---------- Fonction debug_backtrace
function debug($var, $mode = 1)
{
	echo '<div style="background: orange; padding: 5px;">';
	$trace = debug_backtrace();// Fonction prédéfinie retournat un tableau Array contenant des informations tel que la ligne et le fichier où est executé la fonction.
	//echo '<pre>';print_r($trace); echo '</pre>';
	$trace = array_shift($trace);// extrait la première valeur d'un tableau et la retourne, en raccourcissant le tableau d'un élément 
	//echo '<pre>';print_r($trace); echo '</pre>';
	echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line]. <hr>";
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

//----------------------------------- 
function internauteEstConnecte()
{// cette fonction m'indique si le membre est connecté
	if(!isset($_SESSION['membre'])) // si la session "membre" est non définie(elle ne peut être que définie si nous sommes passées par la page de connexion avec le bon mdp)
	{
		return false;
	}
	else
	{
		return true;
	}
}

//----------------------------------
function internauteEstConnecteEtEstAdmin()
{// cette fonction m'indique si le membre est admin
	if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) // si la session du membre est définie, nous regardons si il est admin, si c'est le cas, nous retournons true
	{
		return true;
	}
	else
	{
		return false;
	}
}

//------------------ PANIER --------------------------//
function creationDuPanier()
{
	if(!isset($_SESSION['panier']))
	{
		$_SESSION['panier'] = array();
		$_SESSION['panier']['titre'] = array();
		$_SESSION['panier']['id_produit'] = array();
		$_SESSION['panier']['quantite'] = array();
		$_SESSION['panier']['prix'] = array();
	}
}

//----------------------------------------
function ajouterProduitDansPanier($titre,$id_produit,$quantite,$prix)
{
	creationDuPanier();
	
	$position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']);
	
	//echo $position_produit;
	
	if($position_produit !== false)
	{
		$_SESSION['panier']['quantite'][$position_produit] += $quantite;
	}
	else
	{	
		$_SESSION['panier']['titre'][] = $titre;
		$_SESSION['panier']['id_produit'][] = $id_produit;
		$_SESSION['panier']['quantite'][] = $quantite;
		$_SESSION['panier']['prix'][] = $prix;	
	}
}

//---------------------------
function montantTotal()
{
	$total = 0;
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
	{
		$total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
	}
	return round($total,2);
}

//--------------------------
function retirerProduitDuPanier($id_produit_a_supprimer)
{
	$position_produit = array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']);
	
	if($position_produit !== false)
	{
		array_splice($_SESSION['panier']['titre'], $position_produit,1);	
		array_splice($_SESSION['panier']['id_produit'], $position_produit,1);	
		array_splice($_SESSION['panier']['quantite'], $position_produit,1);	
		array_splice($_SESSION['panier']['prix'], $position_produit,1);	
	}
}











