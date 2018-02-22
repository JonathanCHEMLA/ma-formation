/* -----------------------------------------------------------------------
                    LA DISPOBILITE DE DOM 

A partir du moment ou mon DOM 'est à dire l ensemble de l'arborescence 
de ma page HTML est completement charge, je peut commencer à 
utiliser JQUERY.

Je vais mettre l'ensemble de mon code dans une fonction
cette fonction sera appellée AUTOMATIQUEMENT !!! par Jquery
lorsque le DOM sera entierement défini.

3 façons de faire:
-------------------------------------------------------------------------*/

//car les script sont executes a la fin.
//document est l objet contient notre dom

jQuery(document).ready(function() {     // ATTENTION A METTRE UN petit j et un GROS Q
    //SIGNIFIE QUE JQUERY EST PRET

    // --ici, le DOM est entierement chargé,
    //je peux procéder à mon code JS..;
});



// -- 2eme possibilite:
$(document).ready(function() {
    // --Ici, le DOM est entièrement chargé, je peux procéder à mon code JS...

});




// -- 3eme possibilite:
$(function() {
    // --Ici, le DOM est entièrement chargé, je peux procéder à mon code JS...
    alert("1. Bienvenue dans ce cours JQUERY !");
});




// -- 4eme possibilite: possibilité de ECMA 6. Mais ne fonctionne pas avec ts les navig.
$(()=> {
    alert("2. Bienvenue dans ce cours JQUERY !");   // ca fonctionne aussi.
    $('p').css('color','yellow');
    $('#TexteEnJquery').css('color','green').css('font-size','20px');
});


// -- JS :
document.getElementById('TexteEnJquery').innerHTML = "<strong>Mon texte en JS</strong>";

