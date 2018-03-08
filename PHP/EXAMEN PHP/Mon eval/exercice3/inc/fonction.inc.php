<?php

//-----------------------------------------FONCTION DEBUG
function debug($var, $mon_mode=1)	
{
	echo '<div style="background:orange; padding:5px; float: center; clear both;">';
		$trace=debug_backtrace();		//fonction prédéfinie retournant un tableau ARRAY contenant des informations telles que la ligne et le fichier où est exécutée la fonction	
		
		$trace=array_shift($trace);

		echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].<hr>";
		if($mon_mode === 1)
		{
			echo '<pre>'; print_r($var); echo '</pre>';
		}
		else
		{
			echo '<pre>'; var_dump($var); echo '</pre>';	
		}
	
	echo '</div>';
}



/