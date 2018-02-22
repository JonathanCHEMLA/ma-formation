/*--------------------------------------------
        LES SELECTEURS JQUERY
---------------------------------------------*/

// -- Format : $('selecteur');
// -- En jQuery, tous les sélecteurs CSS sont disponibles...

$(function(){
// -- DOM READY !

    l = e => console.log(e);

    // -- Sélectionner toutes les balises SPAN
    l(document.getElementsByName('span'));
    l($('span'));

    // -- Je veux selectionner mon Menu grace à son ID
    l(document.getElementById('span'));
    l($('#menu'));
    
    // -- Selectionner une classe...
    l(document.getElementsByClassName('span'));
    l($('.MaClasse'));    

        // -- Selectionner un...
    l($('[href="https://www.google.fr"]'));    

});