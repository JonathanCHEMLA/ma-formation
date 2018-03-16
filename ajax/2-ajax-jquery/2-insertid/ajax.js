$(document).ready(function(){
    $("#submit").on('click',function(event){
        event.preventDefault(); //annule le comportement du bouton submit
        ajax();
    });

    function ajax(){
        // JQUERY s'occupe lui-meme de tester si on est sur IE ou pas
        personne = $('#personne').val();

        //$.post(destination , parametres , function(){} ,format ); 
            // les 2 premiers parametres: c'est pour l'envoi
            // les 2 suivants:c'est pour le retour
        //$.post(à qui je l'envoie, avec quels parametres, ce que j'en fais, dans quel format je le reçois)

            // $.post : execute mon fichier php,
            // destination: qui s'appelle: le_nom.php
            // parametres: les parametres que j'envoie à php
            // function: le resultat de l'execution que je n'obtiens que si j'ai status à 200  et readuState à 4
            // format: format retourne par php, en resultat
        
        //premiere methode possible: la methode JSON:
        //$.post('ajax.php',{'personne' : personne, 'index': la_valeur, 'autreindex': autre_valeur}, )
        
        // autre methode possible: la methode AJAX:
        //$.post('ajax.php','personne='+personne, )

        $.post('ajax.php',{'personne' : personne}, toto,'json');

        //autre facon d'ecrire:
            //$.post('ajax.php',{'personne' : personne}, function(){
            //
            //  if(reponse.validation=="ok"){    
            //    $('#resultat').append('employe' +personne+ ' ajouté !');
            //    $('#personne').val(""); //je vide le champ personne
            //  }
            //
            //} ,'json');

        function toto(reponse){
            if(reponse.validation=="ok"){    
                $('#resultat').append('employe' + personne + ' ajouté !');
                $('#personne').val(""); //je vide le champ personne
            }
        }
    }
});