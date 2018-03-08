<?php
// ne pas ecrire sur la ligne php du dessus
//-----------------------------------------FONCTION DEBUG
function debug($var, $mon_mode=1)	//notre 2e parametre ne doit pas NECESSAIREMENT etre renvoyé, car, par defaut, il a une valeur à 1. Al'inverse du 1er parametre qui n'a pas de valeur attribuée par défaut.
{
	echo '<div style="background:orange; padding:5px; float: center; clear both;">';
		$trace=debug_backtrace();		//fonction prédéfinie retournant un tableau ARRAY contenant des informations telles que la ligne et le fichier où est exécutée la fonction	
		//echo '<pre>'; print_r($trace); echo '</pre>';
		//echo '<hr>';
		
		$trace=array_shift($trace);
		//echo '<pre>'; print_r($trace); echo '</pre>';
		echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].<hr>";
		if($mon_mode === 1)
		{
			echo '<pre>'; print_r($var); echo '</pre>';
		}
		else
		{
			echo '<pre>'; var_dump($var); echo '</pre>';	//un tableau peut etre teste aussi avec un var_dump
		}
	
	echo '</div>';
}

//debug();


//-----------------------------------------
function internauteEstConnecte()	// cette fonction indique si le membre est connecté ou non
{	
	if(!isset($_SESSION['membre']))		//si l'indice membre, dans le fichier session, n'est pas défini, c'est que l'internaute n'est pas passé par la page connexion.
	{
		return false;
	}
	else
	{
		return true;
	}
}


//-----------------------------------------
function internanuteEstConnecteEtEstAdmin()
{// cette fonction m'indique si le membre est admin
	if(internauteEstConnecte() && $_SESSION["membre"]["status"]==1)	//si la session du membre est définie et que son statut est à 1, cela veut dire qu'il est admin. on retourne alors true
	{
		return true;
	}
	else
	{
		return false;
	}
}

//--------------PANIER

//-----------------------------------------
//on crée cette fonction pour ajouter un produit dans le panier (page panier.php)

//les informations de notre panier SONT TOUJOURS A STOCKER dans SESSION et non pas dans notre BDD
function creationDuPanier() 
{
	if(!isset($_SESSION['panier']))	// si l'indice panier dans la session n'est pas défini, c'est que l'internaute n'a pas ajouté de produit dans le panier. Dans ce cas, on crée le panier dans notre session
	{	//on rentre dans le if seulement si l'internaute n'a pas ajouté de produits dans le panier. Donc on ne rentre dans cette condition QUE LA PREMIERE FOIS
		$_SESSION['panier'] =array();		//je crée un indice 'panier' et cet indice 'panier' c'est un tableau !, que j'insere dans ma session
		$_SESSION['panier']['titre'] =array();
		$_SESSION['panier']['id_produit'] =array();
		$_SESSION['panier']['quantite'] =array();	// je créer dans ma session, dans mon tableau 'panier', je crée 4 autres paniers :un tableau de quantite, de prix, titre et id_produit
		$_SESSION['panier']['prix'] =array();
	//  Nous créons un tableau pour chaque indice car nous pouvons avoir plusieurs produits dans le panier (ok)
	}
}

//------------------------------------------
function ajouterProduitDansPanier($titre,$id_produit,$quantite,$prix)
//Fonction utilisateur recevant 4 arguments qui seront conservés dans la session 'panier'
{
	creationDuPanier();	// on contrôle si le panier existe ou non dans la session 
	
	// A chaque fois que l'internaute ajoute un produit dans son panier, je controle si le panier est crée ou pas. si n'est pas crée je le crée et je lui attribue un nouvel indice pour le titre,id_produit,qte,prix. 
	//si il a deja crée un panier alors je cherche à quel indice se trouve l'id_produit
	//SI l'id_produit, que l'internaute vient d'ajouter au panier, existe deja dans la session alors je cherche à quel indice cet id_produit se trouve. (dans la meme SESSION,)
	
	//array_search prend une valeur et retour l'indice du tableua ou se trouve cette valeur.
	$position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']);	
	//Grace à la fonction prédéfinie "Array_search", on contrôle si l'id_produit, que l'internaute vient d'ajouter au panier, existe déjà  dans la session ou pas encore(c'est à dire: que c'est son premier ajout dans le panierà). S'il existe alors on va chercher à quel indice id_produit se trouve dans le panier.    
	
	
	//cherche dans le tableua id-produit si l'id que j'envoi se trouve ou non deja dans le tableua//on cherche ... pour lequel l'id_produit est celui que j'ai reçu en paramètre, dans ma fction ajouterProduitDansPanier
	//echo $position_produit;		//si $position_produit est different de false alors c'est que l'id_produit est deja existant. Il retourne l'indice de l'id_produit trouvé. On changera alors seulement la quantité
	
	if($position_produit !==false)	//si $position_produit est differente de false alors cela signifie que $position_produit CONTIENT L'INDICE id_produit ET NOUS RETOURNE CET INDICE id_produit déjà existant dans le panier.
	{
		$_SESSION['panier']['quantite'][$position_produit] += $quantite;	//on change la quantite à l'indice trouvé
	}
	else	// ??l'indice prodiot n'exuiste pas encore dans la session donc on va stocker les informations aux differents indices ??
	{
	
	$_SESSION['panier']['titre'][]=$titre;	//les [] vides permettent de créer par défaut des indices numériques pour les données
	$_SESSION['panier']['id_produit'][]=$id_produit;	
	$_SESSION['panier']['quantite'][]=$quantite;
	$_SESSION['panier']['prix'][]=$prix;
	}
}

//POUR MIEUX COMPRENDRE A QUOI SERVENT LES 2 FONCTIONS CI-DESSUS voici le visuel : -----------------

//voici le contenu de ma session (le 1er ARRAY etant mon tableau SESSION:

/*
Array
(
    [membre] => Array
        (
            [id_membre] => 6
            [pseudo] => daddouche
            [nom] => CHEMLA
            [prenom] => Jonathan
            [email] => jonathanchemla55@gmail.com
            [civilite] => f
            [ville] => PANTIN
            [code_postal] => 93500
            [adresse] => 1 6 rue jules Auffret
            [status] => 1
        )

    [panier] => Array
        (
            [titre] => Array
                (
                    [0] => chemise longue
                )

            [id_produit] => Array
                (
                    [0] => 13
                )

            [quantite] => Array
                (
                    [0] => 1
                )

            [prix] => Array
                (
                    [0] => 20
                )

        )

)
*/




//-----------------------------------------------------
function montantTotal()
{
	$total=0;
	for($i=0; $i < count($_SESSION['panier']['id_produit']); $i++)	//parcourt tous les produits du panier, de la session. 
	{
		$total += $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i];	//on multiplie et incrémente notre $total:  addition de "qté * prix" pour chaque indice, c'est à dire pour chaque produit. 
	}	
	return round($total,2);// on retourne le resultat arrondi à 2 chiffres après la virgule.
} 


//------------------------------------------------------en rapport avec panier.php
function retirerProduitDuPanier($id_produit_a_supprimer)
{	// cette function permet de reorganiser mes produits restant en supprimant les espaces vides et en faisant REMONTER les articles du panier.
	$position_produit=array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']);
	//grace a la fonction definie Array_search, on va chercher a quel indice se trouve le produit à supprimer dans la SESSION 'panier'
	
	if($position_produit !==false)	// position_produit retourne soit false, soit 0,1,2,.. bref, l'indice du produit à retirer de la SESSION 'panier'
	{//si la variable position_produit retourne une valeur differente de false, cela veut dire qu'un indice a bien été trouvé dans la session 'panier'.
		array_splice($_SESSION['panier']['id_produit'], $position_produit,1);
		array_splice($_SESSION['panier']['titre'], $position_produit,1);
		array_splice($_SESSION['panier']['quantite'], $position_produit,1);
		array_splice($_SESSION['panier']['prix'], $position_produit,1);
		//aray_splice permet de supprimer une ligne dans le tableau session et elle remonte les indices inferieurs du tableau aux indices superieurs du tableau. Bref, si je supprime un produit à l'indice 4, les produits apres l'indice 4 remonteront tous d'un indice. Cela permet de reorganiser le tableau panier dans la session et de ne pas avoir de trou, d'indices vides dans le tableau.
	}
	
}