$(document).ready(function(){

    affiche_employes();

    $('#submit').on('click',function(event){
        event.preventDefault();
        ajax_insert();
    })

// 1 appel ajax pour afficher les employes
    function affiche_employes(){
        
        $.post('ajax.php',{'action':'affichage'},affiche,'json');

        function affiche(reponse){
                $('#employes').html(reponse.resultat);
        }
    }





    function ajax_insert(){

        var parameters=$('#myform').serialize();
        /**
         * parameters peut avoir 2 formats:
         * 1-nomchamp1=valeur1&nomchamp2=valeur2&nomchamp3=valeur3
         * 2-{'nomchamp1':'valeur1','nomchamp2':'valeur2','nomchamp3':'valeur3'}
         */


        $.post('ajax.php',parameters,ajoute,'json');  //c'est pas {parameters} car parameters est deja au format GET. C'est soit GET, soit {JSON} qu'on envoie.
        //serialize est une fonction qui récupère tous vos champs du formulaire et les écrit au format "GET":
        // ex:action=insert&nom=Chemla&prenom=Jonathan&sexe=m&service=...

        function ajoute(employe){
           if(employe.validation == "ok")   // si 'ajax.php' nous valide l'enregistrement de cet employé alors:
           {
                affiche_employes(); 
                $("#myform").trigger("reset");  // trigger = declencheur
                // en JQUERY, il fait appel au déclencheur de l'evenement 'reset' d'un formulaire.
           }
        }
    }
}); //fin du document ready(JS)