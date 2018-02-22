/*---------------------------------------
            LES CONDITIONS 🙏🏻
---------------------------------------*/

var MajoriteLegaleFR = 18;

if(14 >= MajoriteLegaleFR){
    alert('Bienvenue !');
 } 
 // le ELSE n'est pas obligatoire...  
 else{
     alert('Google');
 }


/* -------------------------------
          EXERCICE 
Créer une fonction permettant de vérifier l'age d'un visiteur (prompt).
S'il a la majorité légale, alors je lui souhaite la bienvenue, 
sinon, je fait une redirection sur Google après lui avoir signalé le soucis.
-------------------------------- */

// -1 declaration des variables
var MajoriteLegaleFR = 18;
var AgeUser
// Declaration de la fonction qui verifie l'age du visiteur
function ControleAge(Age)
{

    if(Age>=MajoriteLegaleFR)
    {
        // 2a je lui souhaite la bienvenue
         alert('Bienvenue !');
    }
    else
    {
        // 2b il est redirige sur Google  
        document.location.href="http://www.google.com";
    }

}
//2 on fait un prompt
AgeUser=prompt("Bonjour, quel age avez-vous?","<j'ai 18 ans>");

// 3 on appelle la fonction 
ControleAge(AgeUser);



/**                         CORRECTION DU PROF                            **/



//-- 1. Déclarer la Majorité Légale
var MajoriteLegaleFR = 18;

// -- 2. Créer une fonction pour demande son age.

function verifierAge(age) {
    if(age >= MajoriteLegaleFR) {
        return true;
    } else {
        return false;
    }
}

// -- 3. Je demande a l'utilisateur son age
var age = parseInt( prompt("Bonjour, Quel age avez-vous ?","<Saisissez votre Age>") );

// -- 4. Vérification de l'age de l'utilisateur...
if(verifierAge(age)) {
    // -- 4a. J'affiche un message de bienvenue
    alert("Bienvenue sur mon site internet réservé pour les majeurs...");
    document.write('0_0 !!!');
}
else {
    // -- 4b. J'effectue une redirection
    document.location.href = "http://fr.lmgtfy.com/?q=Majorit%C3%A9+L%C3%A9gale+en+France";
}


/*--------------------------------------------------------------------------------
                        LES OPERATEURS DE COMPARAISON      
---------------------------------------------------------------------------------*/

// L'opérateur de comparaison "==" signifie: Egal à...
// Il permet de vérifier que 2 variables sont identiques.

// L'opérateur de comparaison "===" signifie:
// Strictement Egal à...
// Il va comparer la valeur et le type. ex: 20 et "20".

// L'opérateur de comparaison "!=" : Différent de...
// L'opérateur de comparaison "!==" : Strictement Différent de...


/* -------------------------------
            EXERCICE :
J'arrive sur un Espace Sécurisé au moyen 
d'un email et d'un mot de passe.

Je doit saisir mon email et mon mot de passe afin d'être authentifié sur le site.

En cas d'échec une alert m'informe du problème.
Si tous se passe bien, un message de bienvenue m'accueil.
-------------------------------- */

// -- BASE DE DONNEES
var email, mdp;
email = "wf3@hl-media.fr";
mdp = "wf3";

// 1 Declaration de variables
var emailSaisi = prompt("Indiquez-moi votre Email","<user@domaine.fr>");
var mdpSaisi = prompt("Quel est votre Mot de passe ?","<***>");

// 3 Test de l'Email et du mot de passe
if(emailSaisi==email){

    if(mdpSaisi==mdp){
    //3b message de bienvenue        
          document.write("Bienvenue !");
    }
    else{
        //3a alert    
        alert("Votre Mdp ou votre Email sont incorrects");
    }
}
else
{
    //3a alert    
    alert("Votre Mdp ou votre Email sont incorrects");
}



/**                         CORRECTION DU PROF                            **/
var email, mdp;

email = "wf3@hl-media.fr";
mdp = "wf3";

function monUtilisateurEstCorrect(emailUser, mdpUser) {
    if(emailUser === email && mdpUser === mdp) {
        return true;
    } else {
        return false;
    }
}

var emailUser = prompt("Bonjour, Quel est votre email ?","<Saisissez votre email>");
var mdpUser = prompt("votre mot de passe ?","<Saisissez votre mot de passe>");

if(monUtilisateurEstCorrect(emailUser,mdpUser)) {
    alert('Bienvenue ' + emailUser);
} else {
   alert('ATTENTION, email/mot de passe incorrect.');
}



/*------------------------------------------------------------------------
                        LES OPERATEURS LOGIQUES                      
-------------------------------------------------------------------------*/

//                  L'opérateur ET: && ou AND 

// si la combinaison email user et email correspond, ET que la combinaison
// mdpUser et mdp correspond.

//  --> Dans cette condition, les 2 doivent OBLIGATOIREMENT correspondre
//  pour être validée.
// Ex. if(emailUser==email && mdpUser==mdp){...}



//                  L'opérateur OU: || ou OR 

// si la combinaison email user et email correspond, ET/OU que la combinaison
// mdpUser et mdp correspond.

//  --> Dans cette condition, AU MOINS L'UNE DES 2 doit correspondre
//  pour être validée.
// Ex. if(emailUser==email || mdpUser==mdp){...}



//                  L'opérateur '!' ou NOT

// L'opérateur "!" signifie le CONTRAIRE DE... ou NOT

// var monUtilisateurEstApprouve=true;
// if(!monUtilisateurEstApprouve){...}
// Mon Utilisateur n'est pas approuvé.

// Reviens à écrire :
// if(monUtilisateurEstApprouve==false){...}



