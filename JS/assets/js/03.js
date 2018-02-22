/*-----------------------------------
        LA CONCATENATION
------------------------------------*/


var DebutDePhrase       = "Aujourd'hui ";
var DateDuJour          = new Date();
var SuiteDePhrase       = ", sont présents : ";
var NombreDeStagiaires  = 12;
var FinDePhrase         =" stagiaires.<br>";


/**
 * Nous souhaitons maintenant, grâce à la concatenation, 
 * afficher tout ce texte en un seul morceau.
 */

/*
document.write(DebutDePhrase + DateDuJour + SuiteDePhrase + NombreDeStagiaires + FinDePhrase); 
// Affiche: Aujourd'hui Mon Jan 22 2018 09:53:25 GMT+0100 (Paris, Madrid), sont présents : 12 stagiaires.

document.write(DebutDePhrase + DateDuJour.getDate() + "/" + DateDuJour.getMonth()+ "/" + DateDuJour.getFullYear() + SuiteDePhrase + NombreDeStagiaires + FinDePhrase); 
//Aujourd'hui 22/0/2018, sont présents : 12 stagiaires
*/


document.write(DebutDePhrase + DateDuJour.getDate() + "/" + (DateDuJour.getMonth()+1)+ "/" + DateDuJour.getFullYear() + SuiteDePhrase + NombreDeStagiaires + FinDePhrase); 
//Aujourd'hui 22/1/2018, sont présents : 12 stagiaires

var phrase1 ="Je m'appelle ";
var phrase2 ="Hugo et j'ai ";
var age     =28;
var phrase3 =" ans !";

document.write(phrase1 + phrase2 + age + phrase3);

