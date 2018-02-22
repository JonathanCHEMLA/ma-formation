

//  -- Initialisation de jQuery (DOM READY)
$(function(){

// -- Tableau indexé d'objet Contact
var CollectionDeContacts = [];

            // DECLARATION DES FONCTIONS
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    var validateEmail = email => {
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var valid = emailReg.test(email);
    
        if(!valid) {
            return false;
        } else {
            return true;
        }
    }
    
    var validateTel = tel => {
        var telReg = new RegExp("(0|\\+33|0033)[1-9][0-9]{8}");
        var valid = telReg.test(tel);
    
        if(!valid) {
            return false;
        } else {
            return true;
        }
    }
    
/***************************************************************************************************************************************************************** */
// -- permet de verifier si un contact est deja present dans la collection de contact
    function unContactEstPresent(Contact) {

		// Je ne soupsonne pas le mal
        // -- Booleen qui indique la présence d'un contact dans ma collection
        let estPresent = false;

        // -- On parcourt le tableau à la recherche d'une correspondance
        for(let i = 0 ; i < CollectionDeContacts.length ; i++) {

            if(Contact.email === CollectionDeContacts[i].email) {
                // -- Si une correspondance est trouvé "estPresent" passe à VRAI (true)
                estPresent = true;
                // -- On arrête la boucle, plus besoin de poursuivre.
                break;
            }

        }

        // -- On retourne le booleen
        return estPresent;

    }

/****************************************************************************************************************************************************************** */

    function ajouterContact(Contact) {

        // -- Ajouter "Contact" dans "CollectionDeContacts"
        CollectionDeContacts.push(Contact);
        console.log(CollectionDeContacts);
        
        // -- On cache la phrase : Aucun Contact. Ou plus exactement, on cache le <TR>
        $('.aucuncontact').hide();

        // -- Mise à jour du HTML	// aller sur le site babel.js.io
        $(`
            <tr>
                <td>` + Contact.nom + `</td>
                <td>${Contact.prenom}</td>
                <td>${Contact.email}</td>
                <td>${Contact.tel}</td>
            </tr>
        `).appendTo($('#LesContacts > tbody'));
//  #LesContact > tbody:  c'est du css. Ca signifie que je selectionne tous les tbody qui sont enfant direct de #LesContact. pas les petits enfants donc.

        // -- Réinitialisation du Formulaire
        reinitialisationDuFormulaire();

        // -- Affiche une Notification
        $('.alert-contact').fadeIn().delay(4000).fadeOut();

//fadeIn c'est pour un fondu en apparition et fadeOut est pour un fondu en disparition 
    // il s'agit de l'information de succes dans l'inscription qui disparait au bout de 4 sec.

    }
/*********************************************************************************************************************************************************************** */
function reinitialisationDuFormulaire(){
    //il existe plusieurs methodes possibles:
    // -- en jQuery
    $('#contact').trigger('reset');	// trigger est une procedure stockée qui est executée automatiquement... J ai pas compris ??: on peut pas ecrire directement:".reset()" ?! pourtant on l'a ecrit 5 ligne en dessous...? quesqu il nous apporte en plus ce trigger ? 
    $('#contact').get(0).reset();   //deja expliqué, mais pas entendu	// cmt se fait-il que l'element 0 de mon formulaire soit ce que je viens de taper? et prq le formul. est un tableau d objet(je dis ca a cause du get) ?	
    $('#contact .form-control').val('');   //tous les input du formulaire(sauf le bouton) ont une class "form-control". pb:ca ne faut que vider les champs
    // -- en javascript
    document.getElementById('contact').reset();
}

/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

// -- Detection de la soumission de mon formulaire
$('#contact').on('submit', function(e){                    //   <-------------------- C est ici qu'on commence lorsque l'user clique sur le Submit; pas à $(function(){})

    // stopper la redirection de la page
    e.preventDefault();
 
   // ETAPE 1 : ON VERIFIE QUE LES CHAMPS SONT TOUS REMPLIS
    // --Récupération des champs à vérifier
    var prenom,nom,email,tel;
    nom     = $('#nom');
    prenom  = $('#prenom');
    email   = $('#email');
    tel     = $('#tel');

    // -- Vérification des informations
        //je ne soupsonne pas le mal
    let mesInformationsSontValides=true;
console.log(prenom.val());
        // -- Vérification du Prénom
        if(prenom.val().length === 0) {
            // -- Le champ est incorrect, car il n'a pas été rempli...
            mesInformationsSontValides = false;
        }

        // -- Vérification du Nom
        if(nom.val().length === 0) {
            // -- Le champ est incorrect, car il n'a pas été rempli...
            mesInformationsSontValides = false;
        }

        // -- Vérification du Mail
        if(!validateEmail(email.val())) {
            mesInformationsSontValides = false;
        }

        // -- Vérification du Tel
        if(!validateTel(tel.val())) {
            mesInformationsSontValides = false;
        }

/********************************************************************************************************************************************************* */
    if(mesInformationsSontValides){

        // -- Tout est correct
                                                    // ETAPE 2 : ON CREE UN OBJET "CONTACT" QUE L ON N INSERERA QUE S IL N EXISTE PAS DEJA DANS MON TABLEAU         
        let Contact= {
            //cle       //valeur
            nom     :   nom.val(),
            prenom  :   prenom.val(),
            email   :   email.val(),
            tel     :   tel.val()
        };

        /**       cela se crée en faisant:                                                /  *  *
         * Si le contact est présent dans la collection, on informe l'utilisateur 
         * Sinon, on peut procéder à la suite du traitement.
         */

                                                    // ETAPE 3 :  ON VERIFIE QUE LE CONTACT N EST PAS DEJA EXISTANT  
        if(unContactEstPresent(Contact)){
                                                    // ETAPE 4 :  S IL EXISTE DEJA, ON AFFICHE UN MSG D ERREUR ET ON RE-INITIALISE LE FORMULAIRE 
            reinitialisationDuFormulaire();
            alert('ATTENTION\nCecontact est déjà présent !');
        }else{
                                                     // ETAPE 5 :  ON AJOUTE LE "CONTACT" DANS LE TABLEAU, DECLARE TOUT EN HAUT             
            ajouterContact(Contact);
        }

    } else {

        // -- Tous les champs n'ont pas été rempli
        alert('ATTENTION\nVeuillez bien remplir tous les champs');  //          \n  c'est pour faire un saut de ligne,c'est la meme chose que <br>. 
    }
});

})