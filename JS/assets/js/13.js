
//    LA MANIPULATION DES CONTENUS


// function l(e) {
//     console.log(e)
// }

l = e => console.log(e);
// Nouvelle Syntaxe ECMA 6 avec les fonctions fléchées
// https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Fonctions/Fonctions_fl%C3%A9ch%C3%A9es



// -- je souhaite récupérer mon lien Google ; comment procéder ?
var google = document.getElementById('google');
l(google);

// -- Maintenant, je souhaite ACCEDER aux informations de ce lien...

    // -- A : Le lien vers lequel pointe la balise
    l(google.href);

    // -- B: l'iD de la Balise
    l(google.id);

    // -- C: la classe de la Balise
    l(google.className);

    // --D : Le texte de la Balise
    l(google.textContent);


    

// Maintenant, je souhaite MODIFIER LE CONTENU de mon lien !
// comme une variable classique, je vais simplement venir affecter
// une nouvelle valeur à mon "textContent".


google.textContent= "Mon lien vers GoOoOgle !";



// Ajouter un élément dans la page HTML

// Nous allons utiliser 2 méthodes :
// 1. la fonction document.createElement() va permettre de générer
// un nouvel élément dans le DOM; que je pourrai modifier par la suite
// avec les méthodes que nous venons de voir...

// PS : Ce nouvel élément est placé en mémoire... dans le naviguateur
// mais il n est present que dans le navig; pas sur ma page

// -- Définition de l'élément

var span = document.createElement('span');

//--si je souhaite lui donner un ID
span.id = "MonSpan";

// -- Si je souhaite lui attribuer du contenu
span.textContent ="Mon Beau Texte en JS !";

// -- Comment AJOUTER/AFFICHER l'élément dans le page ?
google.appendChild(span);



/* --------------------------------------------------------------------
 Exercice

En partant du travail déjà réalisé sur la page,
créez directement dans la page une balise <h1></h1> ayant comme contenu :
"Titre de mon Article".

Dans cette balise, vous créerez un lien vers une url de votre choix.
Bonus: Ce lien sera de couleur rouge et non souligné.

----------------------------------------------------------------------*/


// var h1 = document.createElement('H1');

// h1.textContent= "Titre de mon Article";


// var body = document.getElementsByTagName('body');
// //console.log(body);

// body.appendChild(h1);


/****************************Correction de Hugo *************************/

// -- Création de la balise h1
var h1 = document.createElement('h1');

// -- Création de la balise a
var a = document.createElement('a');

// -- Titre de mon Article
a.textContent = "Titre de mon Article";

// -- Je donne un lien à mon lien
a.href="#";

// -- Je met mon lien a, dans mon h1			
h1.appendChild(a);							// ! A NE PAS OUBLIER CETTE LIGNE

// -- Je met mon h1 dans la page
document.body.appendChild(h1);

//  -- Je veux que mon lien soit de couleur rouge
a.style.color = "red";

 // -- Je veux que mon lien ne soit pas souligné
 a.style.textDecoration = "none";

 /********************************************************************* */
