
/*---------------------------------------
            LES FONCTIONS  😜
---------------------------------------*/

//le code s execute mais seulement lorsqu on app la fct


/**Déclarer une fonction
 * NB: Cette fonction ne retourne aucune valeur
 * et ne prend pas de paramètres.
 */

function bonjour(){

    /**
     * Lors de l'appel de cette fonction, les instructions ci-dessous
     * seront executées...
     */

     alert('Bonjour !');
}

/**
 * Je vais appeler ma fonction "Bonjour" et déclencher ses instructions.
 */

 bonjour(); //les () servent à distinguer la fonction "bonjour", d'une variable.

 //les parametres st des variables.

 function ditBonjour(Prenom, Nom){
     document.write("<p>Bonjour <strong>" + Prenom + " " + Nom + "</strong></p>");
 }

// -- Appeler / Utiliser une fonction avec des paramètres.
 ditBonjour("Hugo", "LIEGEARD");



 /*-----------------------------------------------------------------------------------------
  Exercice:
  Créer une fonction permettant d'effectuer l'addition de deux nombres passés en paramètres.
  -----------------------------------------------------------------------------------------*/

function Addition(nb1, nb2){
    
    return nb1+nb2;
}

document.write("<p>" + Addition(3,9) + "</p>");

