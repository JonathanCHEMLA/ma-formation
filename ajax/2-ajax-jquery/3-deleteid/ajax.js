$(document).ready(function(){

// 1. ej clique sur le bouton
    $('#submit').on("click",function(event)
    { 
        event.preventDefault(); //annule le comportement habituel du bouton submit
        fct_ajax();


    });
 
    function fct_ajax(){

        var id=$('#personne').find(':selected').val();
         
        //autre methode qui fonctionne avec la derniere version jquery: var id=$('#personne').val();
            //en js on tapait avant :var id = personne.options[personne.selectedIndex].value;
		
        $.post('ajax.php',{'id': id},retour,'json')                 
    }   

    function retour(reponse)
    {
        var prenom=$('#personne').find(':selected').text();
        $('#employes').html(reponse.liste_a_jour);
        $('#resultat').html('employé '+ prenom + ' supprimé');
    }
}); //fin du document ready(JS)