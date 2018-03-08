<?php

/**********************************************************************************/
//Déclaration de ma FONCTION DE CONVERSION 'convertir':

function convertir($montant,$devise)
{
	If(strtoupper($devise)=='EUR')
	{
		$euro= 0.805607025 * $montant;
		return $montant." dollar = " . $euro . " euros";
	}
	else
	{
		$dollar=1.2413 * $montant;
		return $montant." euro = " . $dollar . " dollars américains";
	}
}

/**********************************************************************************/
//Déclaration de mes variables:

$somme_a_convertir=1;
$devise_souhaitee="usd";

/**********************************************************************************/

//On teste que la somme soit bien un entier ou un float:
if(gettype($somme_a_convertir)==="integer" || gettype($somme_a_convertir)==="double")
{
	//on teste que la devise est seulement europeenne ou américaine:
	if(strtoupper($devise_souhaitee)==="EUR" || strtoupper($devise_souhaitee)==="USD")
	{
		//Appel de ma fonction
		echo convertir($somme_a_convertir,$devise_souhaitee);
	}
	else
	{
		echo 'Vous ne pouvez choisir que la devise EUR ou USD';
	}

}
else
{
	echo 'La somme à convertir est erronée';
}	

?>