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