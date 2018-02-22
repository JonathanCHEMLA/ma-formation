/* --
    CONSIGNE : A partir du tableau fourni, vous devez mettre en place un système d'authentification. 
    Après avoir demandé à votre utilisateur son EMAIL et MOT DE PASSE, et après avoir vérifié ses informations, 
    vous lui souhaiterez la bienvenue avec son nom et prénom (document.write);
            
    En cas d'échec, vous afficherez une ALERT pour l'informer de l'erreur.  
-- */

var BaseDeDonnees = [
    {'prenom':'Hugo','nom':'LIEGEARD','email':'wf3@hl-media.fr','mdp':'wf3'},
    {'prenom':'Rodrigue','nom':'NOUEL','email':'rodrigue@hl-media.fr','mdp':'wf3'},
    {'prenom':'Nathanael','nom':'DORDONNE','email':'nathanael.d@hl-media.fr','mdp':'wf3'}
];

/*************** Ce que j'ai proposé comme solution *****************/
//demander le mail et le mdp
//var emailSaisi=prompt("Votre Email SVP","");
//var mdpSaisi=prompt("Votre Mdp SVP","***");

//parcourir la bdd et récuperer les mdp et mail
//var nbreInscrits=BaseDeDonnees.length;

//function estInscrit(mail,mdp){
//    for(let i=0;i<nbreInscrits;i++)
//    {
//        var inscrit=BaseDeDonnees[i];
//    //controler que l un et l autre existent dans la bdd
//        if(mail==inscrit.email && mdp==inscrit.mdp)
//        {
//            // on accueille le visiteur
//            document.write("bonjour Mr " + inscrit.nom + " " + inscrit.prenom);
//            //return {nom: inscrit.nom, prenom: inscrit.prenom};
//            return 'ok';
//        }
//        else
//        {
            
//        }
//    }

//}


// //on crée une foncion qui controle que l'USER est inscrit

// if(!estInscrit(emailSaisi,mdpSaisi))
// // il n'existe pas 
//{ 
//    alert("Vous n'existez pas dans la base !");
//}

/******************CORRECTION DU PROF********************* */
 // -- LesFlemards.js
 function l(e) {
     console.log(e);
 }

 function w(f) {
     document.write(f);
 }

 // -- Déclaration de Variable
 // -- EstCeQueLeMailEstDansLeTableau = faux;
 var isEmailInArray = false;

 // -- 1. Demander à l'utilisateur son email
 var email   = prompt('Bonjour, Quel est votre email ?','<Saisissez votre email>');
 var mdp     = prompt('votre mot de passe ?','<Saisissez votre mot de passe>');

 // -- 2. Parcourir l'ensemble des données de mon tableau
 for(let i = 0 ; i < BaseDeDonnees.length ; i++) {
	//Je passe en revue les individus.
	var individu=BaseDeDonnees[i];
    if(email === individu.email && mdp === individu.mdp ) {

         // -- J'ai trouvé une correspondance dans ma BDD
         isEmailInArray = true;
         w('Bonjour ' + individu.prenom + ' !');

         // -- Je stop la boucle for, j'ai trouvé ce que je cherche...
         break;

     }

 }

 if(!isEmailInArray) {
     alert('ATTENTION, Email / Mot de Passe incorrect !');
 }




