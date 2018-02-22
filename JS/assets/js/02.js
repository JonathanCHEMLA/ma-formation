// -- Déclarer un Tableau Numérique  (ou  tableau indexé)

//soit on écrit:
var monTableau=[];

//soit on peut aussi écrire:
var myArray =new Array;

monTableau[0]="Adeline";
monTableau[1]="Hugo";
monTableau[2]="Arnaud";

console.log(monTableau); //Affiche toutes les données.
console.log(monTableau[0]); //Adeline
console.log(monTableau[2]); //Arnaud

var NosPrenoms = ["Hana", "John","Maxime",65,"Jonathan",true];
console.log(NosPrenoms);

// -- Déclarer et Affecter des Valeurs à un Objet.
// ⛔️PAS DE TABLEAU ASSOCIATIF en JAVASCRIPT !!!!! ca s'appelle UN OBJET !⛔️

var Coordonnee = {
    prenom  :   "Hugo",
    nom     :   "LIEGEARD",
    age     :   28
};

// pour vider la console.
console.clear(); 

console.log(Coordonnee);
console.log(Coordonnee['prenom']);
console.log(Coordonnee.nom);



// -- Je vais créer 2 tableaux numériques.
var listeDePrenoms=["Hugo","Rodrique","Kristie"];
var listeDeNoms=["LIEGEARD","NOUEL","SOUKAI"];

// --Je vais créer un tableau à 2 dimensions à partir de mes 2 tableaux.
var Annuaire = [ listeDePrenoms, listeDeNoms ];

// --Afficher un Nom et un Prenom sur ma page HTML:
document.write(  Annuaire[0][1] );
document.write( " " );
document.write(  Annuaire[1][1] );



/*----------------------------------------------------------------\
|                   EXERCICE :-)                                  |
|   ~   ~   ~   ~   ~   ~   ~   ~   ~   ~   ~   ~   ~   ~   ~   ~ |
|   Créez un Tableau à 2 dimensions appelé                        | 
|    "AnnuaireDesStagiaires" qui contiendra                       |
|toutes les coordonnées pour chaque stagiaire.                    |
|                                                                 |
|Ex: Nom, Prénom,Tel                                              |
\----------------------------------------------------------------*/

/*Ce que j'ai tapé:

var listeDePrenoms=["Hugo","Rodrique","Kristie"];
var listeDeNoms=["LIEGEARD","NOUEL","SOUKAI"];
var listeDeTelephones=["0102030405","0605040302","0769543214"]

var NomPrenom=[ listeDePrenoms, listeDeNoms,listeDeTelephones ]
// --Je vais créer un tableau à 2 dimensions à partir de mes 2 tableaux.
var AnnuaireDesStagiaires = [ NomPrenom, listeDeTelephones ]; 
*/

var AnnuaireDesStagiaires=[
    {prenom: "Hugo",    nom: "LIEGEARD",    tel: "0783 97 15 15"},
    {prenom: "Adeline", nom: "CLERE",       tel: "XXXX XX XX XX"},
    {prenom: "John",    nom: "GARCIA",      tel: "XXXX XX XX XX"},    
];

/**
 * Le fait d'avoir des objets dans un tableau indexé, nous avons mis en place le format JSON
 */

console.log(AnnuaireDesStagiaires);
console.log(AnnuaireDesStagiaires[0].prenom);   //affiche Hugo
console.log(AnnuaireDesStagiaires[1].prenom);   //affiche Adeline

/*****************************************************************************************************/

// -- Exemple de tableau 3D

var Contacts = [

    {
        prenom      : "Hugo",
        nom         : "LIEGEARD",
        coordonnees : {
                        email       :   "wf3@hl-media.fr",
                        tel         : {
                                      fixe  : "0596 108 328",
                                      fax   : "0596 108 632",
                                      port  : "0783 97 15 15"
                                  },
                          adresse : {
                                        ville   : "Ducos",
                                        cp      : "97224",
                                        region  : "Martinique",
                                        pays    : {
                                                    codepays : "FR",
                                                    nompays  : "France"
                                                   }
                                    }
                      }
    },

    {
        prenom      : "John",
        nom         : "GARCIA",
        coordonnees : {
                        email       :   "john.garcia@hl-media.fr",
                        tel         : {
                                      fixe  : "0596 108 328",
                                      fax   : "0596 108 632",
                                      port  : "0783 XX XX XX"
                                  },
                          adresse : {
                                        ville   : "Fort de France",
                                        cp      : "97200",
                                        region  : "Martinique",
                                        pays    : {
                                                    codepays : "FR",
                                                    nompays  : "France"
                                                   }
                                    }
                      }
    },

    {
        prenom      : "Nicolas",
        nom         : "DUROCHER",
        coordonnees : {
                        email       :   "nicolas.durocher@hl-media.fr",
                        tel         : {
                                      fixe  : "0596 108 328",
                                      fax   : "0596 108 632",
                                      port  : "0783 XX XX XX"
                                  },
                          adresse : {
                                        ville   : "Le Lamentin",
                                        cp      : "97232",
                                        region  : "Martinique",
                                        pays    : {
                                                    codepays : "FR",
                                                    nompays  : "France"
                                                   }
                                    }
                      }
    },

];

console.log(Contacts);
console.log(Contacts[2].coordonnees.adresse.pays.nompays);

/* -------------------------------
        AJOUTER UN ELEMENT
-------------------------------- */

var Couleurs = ['Rouge', 'Jaune', 'Vert'];

//  -- Si je souhaite ajouter un élément dans mon tableau
// -- Je fait appel à la fonction push() qui me renvoi le NOMBRE d'éléments.
console.clear();
console.log(Couleurs);	//affiche: Array(3)


// selon le site TOUTJAVASCRIPT.COM: tableau.push() Ajoute de nouveaux éléments EN FIN de tableau
// Tab.push("qqchose") ajoute "qqchose" au Tab et retourne DANS UNE VARIABLE le nouveau nbre d'éléments dans le Tab.(Jonathan)

var nombreElementsDeMonTableau = Couleurs.push('Orange');	
console.log(Couleurs);	//affiche les 4 noms de couleur:["Rouge, "Jaune", "Vert", "Orange"]
console.log(nombreElementsDeMonTableau);	//affiche: 4


// -- NB : La fonction unshift() permet d'ajouter un ou plusieurs éléments EN DEBUT de tableau.
nombreElementsDeMonTableau = Couleurs.unshift('Cerise');	
console.log(Couleurs);	//affiche les 5 noms de couleur:["Cerise", "Rouge", "Jaune", "Vert", "Orange"]
console.log(nombreElementsDeMonTableau);	//affiche: 5

/* --------------------------------------------
    RECUPERER ET SORTIR LE DERNIER ELEMENT
--------------------------------------------- */

// La fonction pop() me permet de supprimer un ou plusieurs éléments de mon tableau et d'en récupérer la valeur. Je peux accessoirement récupérer cette valeur dans une variable.


// tab.pop() retourne DANS UNE VARIABLE le dernier élément  & supprime ce dernier element du tableau. (Jonathan)

var monDernierElement = Couleurs.pop();  // Tab.pop() récupère le dernier élément & sort ce dernier element du tableau.
console.log(Couleurs);	//affiche Array(4):["Cerise", "Rouge", "Jaune", "Vert"]
console.log(monDernierElement);	//affiche: "orange"

// -- La même chose est possible avec le premier élément en utilisant la fonction shift();
var monPremierElement = Couleurs.shift(); // Tab.shift() récupère le premier élément & sort ce premier element du tableau.	
console.log(Couleurs);	//affiche les 4 noms de couleur:["Rouge, "Jaune", "Vert"]
console.log(monPremierElement);	//affiche: "Cerise"


// -- NB: La fonction splice() vous permet de faire sortir un ou plusieurs éléments de votre tableau.


/* --------------------------------------------
    COMPTER LE NOMBRE D ELEMENTS DANS LE TABLEAU
--------------------------------------------- */

/*
var leNombre=Couleurs.length;
console.log(leNombre);	//retourne 3
*/
/*json l un des format les + populaire pour communiquer sur le web au travers des API */