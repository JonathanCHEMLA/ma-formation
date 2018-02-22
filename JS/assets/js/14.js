
/*-----------------------------------------------------------------
                           LES EVENEMENTS

    les evenements vont me permettre de déclencher une fonction, 
    c'est a dire une série d'instructions, suite à une action de
    mon utilisateur...

    OBJECTIF : Etre en mesure de capturer ces évènements afin 
    d'executer une fonction.

    Les Evenements   : MOUSE (souris)
        click        : au clic sur un élément
        mousseenter  : au survol de la souris au dessus de la 
                        zone d'un élement.
        mouseleave   : losque la souris sort de cette zone
        mouseover    : fait mouseenter et mouseleave

    Les Evenements   : KEYBOARD (clavier)
        keydown      : une touche du clavier est enfoncée;
        keyup        : une touche du clavier a été relachée.

    Les Evenements   : WINDOW (Fenêtre)    
        scroll       : défilement de la fenêtre
        resize       : redimentionnement de la fenêtre.    

    Les Evenements   : FORM (Formulaire)    
        change       : pour les éléments <input>, <select> et <textarea> 
                       LORSQU ON SORT LE FOCUS DU CHAMP
        submit       : à l'envoi (soumission) du formulaire  
        input        : pour capter la saisie d'un user sur un champ 
                       <input> EN TEMPS REEL

    ###########  LES ECOUTEURS D EVENEMENTS  ############

    Pour attacher un événement à un élément, ou autrement dit,
    pour déclarer un écouteur d'évenement qui se chargera de
    déclencher une fonction, je vais utiliser la syntaxe suivante:

-----------------------------------------------------------------*/

var p  = document.getElementById('MonParagraphe');

// -- Je souhaite que mon paragraphe soit rouge au clic de la souris.

function changerLaCouleurEnRouge(){
    p.style.color = "red";
}

p.addEventListener('click',changerLaCouleurEnRouge);


/* -------------------------------------------------------------\
|                       EXERCICE PRATIQUE                       |
| A l'aide de javascript, créez un champ "input" type text avec |
| un ID unique. Affichez ensuite dans une alerte, la saisie de  |
| l'utilisateur.                                                |
|______________________________________________________________*/


/****************Ce que j'ai tenté ******************************/
/*
// creation de l'input

var input = document.createElement("input");
// attribution d un ID
input.id="MonId";
input.placeholder="ton contenu ici!";

// affichage dans la page
document.body.appendChild(input);
var bool= false;
// recupere le contenu du Id, saisi par l'user


if(idSaisi)
{var idSaisi=document.getElementById(input);
    input.addEventListener('onchange',test());
    //return alert(idSaisi);
    bool=true;
}
*/
/********************** Correction de Hugo **********************/

// -- Création du champ input
var input = document.createElement('input');
document.body.appendChild(p);

// -- Attribution d'un Attribut
input.setAttribute('type', 'text');
input.setAttribute('placeholder', 'Saisissez un Contenu...');


//input.type="text";				// POUR INFO, CA FONCTIONNE AUSSI
//input.placeholder="Saisissez un Contenu.";	//FONCTIONNE EGALEMENT
//console.log(input.type);
//console.log(input.placeholder);


//-- Attribution d'un ID
input.id = "MonID"; // pareil que input.setAttribute('id' , 'MonID');

// -- Ajout dans la page
document.body.appendChild(input);

function voirLaSaisieDeMonInput() {
    console.log(input.value);
    alert(input.value);
}

input.addEventListener('change', voirLaSaisieDeMonInput);
