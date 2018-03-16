$(document).ready( function (){

    $('#action').on('click',function(){
        $.ajax({
            url:'fichier.txt',
            dataType: 'text',
            success:function( retourne_le_contenu_du_fichier_txt ){ //success est un abrege de jquery pour "si tout ce passe bien c'est a dire que status=200 et readyStat=4"
            // on ecrit dans la div, ayant l'id "demo", la reponse.
            $("#demo").html( retourne_le_contenu_du_fichier_txt ); }
        });

    });
//autre notation possible: $('#action').click(function(){})

});