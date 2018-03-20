$(document).ready(function(){

    $('#joueur').hide();

    $('#debut').on('click',function(){

        $('#debut').hide();
        $.post('ajax.php',{'action':'debut'},function(retour){
            if (retour.valid=="ok"){
                $('#resultat').empty().append(retour.resultat);
            }
        },'json');
        $('#joueur').show();
        $('#propo').focus();

    })


    $('#envoi').on('click',function(event){

        event.preventDefault();
        var propo = $('#propo').val();
        $.post('ajax.php',{'action':'analyse','propo':propo},function(retour){
            if (retour.valid=="ok"){
                $('#resultat').append(retour.resultat);
                if (retour.reinit == 'ok')
                {       
                     $('#joueur').hide();
                    $('#debut').show();
                }
            }
        },'json');

        $('#propo').val('').focus();
    });


}); //FIN DU DR