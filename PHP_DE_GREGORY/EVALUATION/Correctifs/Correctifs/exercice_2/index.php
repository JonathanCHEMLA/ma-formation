<?php
/**
### Enoncé de l'exercice 2 ###

Créer une fonction permettant de convertir un montant en euros vers un montant en dollars américains.

Cette fonction prendra deux paramètres : 
- Le montant de type int ou float
- La devise de sortie (uniquement EUR ou USD). 

Si le second paramètre est "USD", le résultat de la fonction sera, par exemple : 
	1 euro = 1.085965 dollars américains

Il faut effectuer les vérifications nécessaires afin de valider les paramètre
**/


// Pour forcer l'UTF-8
header('Content-Type: text/html; charset=utf-8');

/**
 * Convertisseur de devises
 * @param int|float $amount Le montant à convertir
 * @param string $currency La devise de sortie
 * @return Le montant converti
 */
function convertEurosDollars($amount, $currency = 'EUR'){

	$currencyAvailable = ['EUR', 'USD']; // La liste des devises disponibles
	$dollar = 1.085965; // La valeur d'un euro en dollar américain.. Le taux peut avoir changer depuis :-)

	if(!is_int($amount) && !is_float($amount)){ // Vérification du type (int ou float) du montant
		trigger_error('Le montant n\'est pas de type numérique', E_USER_WARNING);
		return false;
	}
	elseif(!in_array($currency, $currencyAvailable)) { // Vérification de la devise
		trigger_error('La devise est inconnue', E_USER_WARNING);
		return false;
	}
	else {

		// On effectue nos calculs nécessaires en fonction de la devise
		switch ($currency) {
			case 'USD':
				$calc = $amount * $dollar;
				$result = $amount . ' euro(s) = '.$calc.' dollar(s) américain(s)';
			break;
			
			case 'EUR';
				$calc = $amount / $dollar;
				$result = $amount . ' dollar(s) américain(s) = '.$calc.' euro(s)';
			break;
		}
		// On retourne le resultat;
		return $result;
	}
}

// Affichage du résultat
echo convertEurosDollars(1, 'USD');