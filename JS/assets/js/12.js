
//                  LE DOM

// Le DOM est une interface de développement en JS pour HTML
// Grace au DOM, je vais être en mesure d'accéder, modifier mon HTML.

// L'objet "document": c'est le point d'entrée vers mon contenu HTML.

// Chaque page, chargée dans mon navigateur à un objet "document".



// Question: Comment puis-je faire pour récupérer 
// les différentes informations de ma page HTML ? c'est la fonction document.getElementById.

// document.getElementById() est une fonction qui va permettre 
// de récupérer un élément HTML à partir de son identifiant unique: ID

var bonjour = document.getElementById("bonjour");
console.log(bonjour);

// document.write(bonjour); // ca ne fonctionne pas car on est entrain d essayer de recuperer une balise...




//                  document.getElementsByClassName

// document.getElementsByClassName() est une fonction qui va permettre 
// de récupérer un ou plusieurs éléments (une liste) HTML à partir de 
// leur classe.

var contenu =document.getElementsByClassName("contenu");
console.log(contenu);

// -- Me renvie un tableau JS avec mes éléments HTML (Collection HTML).




//                  document.getElementsByTagName

// document.getElementsByTagName() est une fonction qui va permettre 
// de RECUPERER un ou plusieurs éléments (une liste) HTML A PARTIR DE
// leur * nom de balise *.  (Bref, en gros, comme en css.)


// le DOM c est notre page HTML

// ex:

var span = document.getElementsByTagName('span');
console.log(span);



