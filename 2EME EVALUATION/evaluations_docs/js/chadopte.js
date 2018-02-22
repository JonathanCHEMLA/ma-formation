
// -- Initialisation de jQuery
$(function(){ 



/*-- ----------------------------------------------------
        ECOUTE ET NEUTRALISATION DE LA REDIRECTION
------------------------------------- ------------------*/
    // -- Ecouter a quel moment est soumis notre formulaire
    $('#formulaire').on('submit', e => {
        // -- Neutraliser la redirection HTML5
        e.preventDefault();
 
        
/*-- ----------------------------------------------------
        RE-INITIALISATION DU FORMULAIRE
------------------------------------- ------------------*/
        // -- Supprimer les différentes erreurs
        $('#formulaire .has-error').removeClass('has-error');
        $('#formulaire .text-danger').remove();
        $('#formulaire .alert-danger').remove();

/*-- ----------------------------------------------------
        DECLARATION DES VARIABLES
------------------------------------- ------------------*/
        // -- Déclarer les variables à vérifier
        var sel1     = $('#sel1');
        var comment  = $('#comment');


/*-- ----------------------------------------------------
        CONTROL DE LA SAISIE CORRECTE DU FORMULAIRE
------------------------------------- ------------------*/

/*-- ----------------------------------------------------------------
            PARTIE 1:COLORATION VERTE OU ROUGE
            DE LA BORDURE DE L INPUT SUIVANT 
            QUE LE CHAMP EST REMPLI OU NON
---------------------------------------------------------------------*/
        // -- Vérification de chaque champ
            // -- 1. Vérification du Nom du chat
            if(sel1.val()==="-Sélectionnez-") {
                // l'ajout de la classe HAS-ERROR crée une bordure rouge (une fois le formulaire validé)
                sel1.parent().addClass('has-error');
                // le <p> s'inscrit, dans le parent du input(nom) ,sous le input(nom)
                $('<p class="text-danger">Vous n\'avez pas choisi de chat</p>').appendTo(sel1.parent());
            } else {
                // l'ajout de la classe HAS-SUCCESS crée une bordure verte (une fois le formulaire validé)
                sel1.parent().addClass('has-success');
            }

            // -- 2. Vérification du Commentaire 
            if(comment.val().length === 0) {
                comment.parent().addClass('has-error');
                $('<p class="text-danger">N\'oubliez pas de nous laisser votre message votre message</p>').appendTo(comment.parent());
            } else {
                // l'ajout de la classe HAS-SUCCESS crée une bordure verte (une fois le formulaire validé)
                comment.parent().addClass('has-success');
            }

/*-- ----------------------------------------------------------------
            PARTIE 2:MESSAGE D ERREUR OU DE SUCCES ENVOYE
            A L UTILISATEUR. EN CAS DE SUCCES, LE FORMULAIRE
            DISPARAIT.
---------------------------------------------------------------------*/


        // -- Je vérifie si mon formulaire comporte des erreurs.
        if($('#formulaire').find('.has-error').length === 0) {

            $('#formulaire').replaceWith(`
                <div class="alert alert-success">
                    Votre demande a bien été envoyée !
                    Nous vous répondrons dans les meilleurs délais.
                </div>
            `);

        } else {

            $('#formulaire').prepend(`
                <div class="alert alert-danger">
                    Nous n'avons pas été en mesure de valider votre
                    demande. Vérifiez vos informations.
                </div>
            `);

        } //end if

    });//end eventListener

/*---------------------------------------------------------------------------------------------------------*/
   // ca fonctionne pas mais j'ai tenté d'inverser les 2 div.
    $( window ).resize(function() {
        alert("coucou");
        let largeur = $(window).width();

        $('.projecteur').prepend($('#formulaire'));
    

 /********************************************************************************************************/   

})// fin