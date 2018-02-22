/*
 I. Créer un Tableau 3D "PremierTrimestre" contenant la moyenne d'un étudiant pour plusieurs matières.

    Nous auront donc pour un étudiant, sa moyenne à plusieurs matières.
    
    Par exemple : Hugo LIEGEARD : [ Francais : 12, Math : 19, Physique 4], ... etc
    
    **** Vous allez créez au minimum 5 étudiants ****

II. Afficher sur la page (à l'aide de document.write) pour chaque étudiant, la liste (ul et li) de sa moyenne à chaque matière, puis sa moyenne générale. 
*/

/***************1ERE PARTIE de ce que j'ai essayé de proposer***************/
// var Etudiant=[
// {
//     prenometudiant  :   'Hugo',
//     nometudiant     :   'LIEGEARD', 
//     matiere         : {  
//                     francais    :   {
//                                         moyennem    :   12,
//                                     },
//                     math        :   {
//                                         moyennem    :   19,
//                                     },
//                     physique    :   {
//                                         moyennem    :   4,
//                                     },                             
            
//                     }

// },

// ];

/***********************1ERE PARTIE correction du prof******************* */

/////  CONSEIL:  DANS UN OBJET, METTRE TOUT EN MINUSCULE !!!!!! ////////////

var PremierTrimestre = [

    {
        prenom  : "Hugo",
        nom     : "LIEGEARD",
        moyenne : {
            francais : 4,
            math     : 6,
            physique : 18
        }
    },
    {
        prenom  : "Maxime",
        nom     : "JOYES",
        moyenne : {
            francais : 4,
            math     : 5,
            physique : 12,
            svt      : 15
        }
    },
    {
        prenom  : "John",
        nom     : "GARCIA",
        moyenne : {
            francais : 4,
            math     : 13,
            physique : 12,
            espagnol : 19
        }
    },
    {
        prenom  : "Hana",
        nom     : "MATTEI",
        moyenne : {
            francais : 14,
            math     : 13,
            physique : 13,
            anglais  : 16
        }
    }

];


/**********2ERE PARTIE de ce que j'ai essayé de proposer************* */


// var nbr = PremierTrimestre.length;

// document.write("<ol>");
// for(let i=0 ; i < nbr ; i++){

//     document.write("<li>" + PremierTrimestre[i].nom + " " + PremierTrimestre[i].prenom + "</li>");

//     document.write("<li><ul>");

// //var nbr2 = 3;

// //    for(let j=0; j < nbr2 ;j++){
// //        document.write(PremierTrimestre[0].moyenne["francais"]);

// //    }

// document.write(PremierTrimestre[0].moyenne["francais"]);

    
//     PremierTrimestre[i].moyenne.forEach(afficheMoyenne);

//     function afficheMoyenne(valeur, j)
//     {
//         document.write("<li>" + PremierTrimestre[i].moyenne[j] + " " + PremierTrimestre[i].moyenne[j] + "</li>");
//     }

// console.log("</ul></li>");
// }
// console.log("</ol>");

//     //     function afficheMoyenne(valeur, cle)
//     //     {
//     //         console.log("<li> " + cle + " : " + valeur + " </li>");
//     //     }
 
// //     }
//     // console.log("</ul>");
// //console.log("</ol>");


// //PremierTrimestre.forEach(afficheMoyenne);



// //function afficheMoyenne(valeur, cle)
// //     {
// //         console.log("<li> " + cle + " : " + valeur + " </li>");

//     document.write(PremierTrimestre[0].moyenne["francais"]);

/************2EME PARTIE Correction de HUGO *********************/
 -- Les Flemards.js

 function l(e){
     console.log(e);
 }
 function w(e){
     document.write(e);
 }


 // -- Je souhaite afficher la liste de mes étudiants.
 w('<ol>');
 
 for(let i=0; i<PremierTrimestre.length; i++)
 {
     // -- On récupère l'objet Etudiant de l'Itération
     let Etudiant = PremierTrimestre[i];
	 
	 // -- on déclare 2 variables qui nous permettront de calculer la moyenne globale.
     var NombreDeMatiere=0, SommeDesNotes=0;

     w('<li>');
         w(Etudiant.prenom + ' ' + Etudiant.nom);
        
        w('<ul>');
			for(let matiere in Etudiant.moyenne)	
			//pour chaque matiere, se trouvant dans LA ...MOYENNE de MON ETUDIANT, J EXECUTE LE CODE entre{}
			// "matiere" est le nom que j'ai donne à ma variable. il contient la CLE, ex: "math"
			{
				// incrémentation et calcul simplifié pour nos 2 variables.
                NombreDeMatiere++;
				SommeDesNotes += Etudiant.moyenne[matiere];

				w('<li>');
					w(matiere + ':' + Etudiant.moyenne[matiere]);
				w('</li>');
				//  -- Fin de la boucle matière
            }
			 w('<li>');
				 w('<strong> Moyenne Générale : </strong>' + (SommeDesNotes/NombreDeMatiere).toFixed(2));
			 w('</li>');
		w('</ul>');
		
     w('</li>'); 
 }
 
 w('</ol>');


