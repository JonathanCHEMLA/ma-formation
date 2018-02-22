/*--------------------------------
LES SELECTEURS D'ENFANTS JQUERY
---------------------------------*/

                                    // APPRENDRE PAR COEUR


$(() => {
    l=e => console.log(e);

    // -- Je souhaite selectionner toutes les div de ma page
    l($("div"));

    // -- Je souhaite selectionner la balise nav de ma page
    l($("nav"));

    // -- Je souhaite tous les éléments descendants directs (enfants) qui sont dans nav
    l($("nav").children());    
    
    // -- Parmi ces descendants, uniquement les éléments "ul"
    l($("nav").children('ul'));  
    
    // -- Je souhaite récupérer tous les éléments "li" de mon "ul"
    l($("nav").children('ul').find('li'));  

    // -- Je souhaite récupérer uniquement le 2eme élément de mes "ul"
    l($("nav").find('li').eq(1));
    
    // -- Je souhaite connaitre le voisin immédiat de ma nav
    l($("nav").next());         
    l($("nav").next().next());      // Le voisin du voisin..
    l($("nav").prev());             // Le voisin d'avant

    // -- LES PARENTS
    l($("nav").parent());             // Le voisin d'avant

});
