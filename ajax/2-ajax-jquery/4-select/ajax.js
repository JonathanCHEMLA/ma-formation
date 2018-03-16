$(document).ready(function(event){

    maj();                              //notre fonction s'execute à la ligne 3 et à la ligne 5. suite du commentaire à la ligne 25

    $('#personne').on('change',maj);    //notre fonction s'execute à la ligne 3 et à la ligne 5. suite du commentaire à la ligne 25

    function maj(){

        /* je récupère l'id du prénom choisi */
        var id=$('#personne').find('selected').val();

        $.post('ajax.php',{'id':id},reception,'json');

        function reception( donnees ){
            if(donnees.validation=="ok"){
                /* j affiche les infos de la personne dans ma div resultat */
                $('#resultat').html(donnees.resultat);
            }
        }
    }
}); //fin du document ready(JS)



// la difference entre 'maj()' et 'maj'     : c'est que pour 'maj' du change si on avait mis les (), la fct se serait 
// executée sans attendre le change sur '#personne'.

// autre maniere de faire pour que la fct maj() ne s'execute que sous condition:
//              $('#personne').on('change',function(){
//                  maj();
//              }); 
