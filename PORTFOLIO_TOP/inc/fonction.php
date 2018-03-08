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
