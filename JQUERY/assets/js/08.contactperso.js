



/**
 * 
 *  <!-----------------------------------------------------------------------/
        CONSIGNE : 
        1. Créer un Formulaire HTML permettant le 
        remplissage d'une Fiche de Contact : Nom, Prénom,
        Email et le Téléphone.
        
        2. Après vérification des informations, vous
        ajouterez le nouveau contact dans un tableau de 
        contacts.
        
        3. Vous afficherez ensuite l'ensemble des contacts
        du tableau sur votre page HTML à la suite de votre
        formulaire. (Vous utiliserez une <table>)
        
        4. BONUS : Utilisation de Notification, Local Storage et Bootstrap.
    \---------------------------------------------------------------------->
 * 
 * 
 * 
 * 
 * 
 * 
 * Validate email function with regular expression
 *
 * https://paulund.co.uk/regular-expression-to-validate-email-address
 * If email isn't valid then return false
 *
 * @param email
 * @return Boolean
 */
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
//   déclaration d'un tableau de membres, vide
 var membres=[];
// -- Initialisation de jQuery

$(() => {

// -- Ecouter a quel moment est soumis notre formulaire
// En JS : document.getElementById('contact').addEventListener('submit', MaFonctionAExecuter);
$('#contact').on('submit', e => 
{

    // -- Neutraliser la redirection HTML5
    e.preventDefault();
  
// -- Initialisation dans le cas ou il a deja envoye son form incomplet
    // supprime la class has-error de la balise <div class="col-md-8">
    $('#contact .has-error').removeClass('has-error');  
    // supprime completement <p class="text-danger">,
    //généré en cas d'erreur de l'user
    $('#contact .text-danger').remove(); 

    //on cache par defaut les 2 encadrés( erreur et succès)
    $('.alert-success').hide(); 
    $('.alert-danger').remove();
       
    // -- Déclarer les variables à vérifier
    var nom     = $('#nom');
    var prenom  = $('#prenom');
    var email   = $('#email');        
    var tel     = $('#tel');

    // -- 1. Vérification du Nom
    if(nom.val().length === 0) 
    {
        // encadré en rouge
        nom.parent().addClass('has-error');
        // Message d'erreur sous l'encadré
        // le paragraphe sera rajouté au parent, en dernier
        $('<p class="text-danger">N\'oubliez pas de saisir votre nom</p>').appendTo(nom.parent());
    } 
    else 
    {
        // encadré en vert
        nom.parent().addClass('has-success');
    }

    // -- 2. Vérification du Prénom
    if(prenom.val().length === 0) 
    {
        prenom.parent().addClass('has-error');
        $('<p class="text-danger">N\'oubliez pas de saisir votre prénom</p>').appendTo(prenom.parent());
    } 
    else 
    {
        prenom.parent().addClass('has-success');
    }

    // -- 3. Vérification du Mail
    if(!validateEmail(email.val())) 
    {
        email.parent().addClass('has-error');
        $('<p class="text-danger">Vérifiez votre adresse email</p>')
            .appendTo(email.parent());
    } 
    else 
    {
        email.parent().addClass('has-success');
    }

    // -- 4. Vérification du Numéro de Téléphone
    if(!validateTel(tel.val())) 
    {
        tel.parent().addClass('has-error');
        $('<p class="text-danger">Vérifiez votre numéro de téléphone</p>')
        .appendTo(tel.parent());
    } 
    else 
    {
        tel.parent().addClass('has-success');
    }
 
  

// -- Je vérifie si mon formulaire comporte des erreurs.
    if($('#contact').find('.has-error').length === 0) 
    {
    // LE FORMULAIRE EST COMPLET

        var existe=false;
            

        if(membres.length>=1){
            for(let i = 0 ; i < membres.length ; i++) 
            {
                if( email.val() == membres [i].email ) 
                {   
                    existe=true;
                    alert(existe);    
                           
                }
            }
        }
        
        //if membres.length>=1){alert(membres[0].email);}
        if(!existe)
        {  
            alert('tu es rentré. voici email.val:' + email.val());
            let membre = {
            nom        : nom.val(),
            prenom     : prenom.val(),
            email      : email.val(),
            tel        : tel.val()
        }; 

        console.log("voici l'ojet:" + membre.nom);  
        console.log(membre);                  
        membres.push(membre);
        console.log("voici le tableau d'ojet:" + membre.nom);               
        console.log(membres);     
        
        $('div').show();  
        
/////////////////////////////////////////////////////////////////
        $('tbody tr').remove();

        for(let i=0; i < membres.length ; i++){
        $('tbody').append("<tr><td>" 
            + membres[i].nom + "</td><td>" 
            + membres[i].prenom + "</td><td>"
            + membres[i].email + "</td><td>" 
            + membres[i].tel + "</td></tr>");
        }      



    }
         
} 
        if(existe || $('#contact').find('.has-error').length > 0)
        {
            //$('.alert-danger').remove();
            $('#contact').prepend(`
                <div class="alert alert-danger">
                    Nous n'avons pas été en mesure de valider votre
                    demande. Vérifiez vos informations.
                </div>
            `);
        }    

    });
});