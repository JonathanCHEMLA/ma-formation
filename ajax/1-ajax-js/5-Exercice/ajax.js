document.addEventListener("DOMContentLoaded",function(event){

    affiche_employes();

    document.getElementById('submit').addEventListener('click',function(event){
        event.preventDefault();
        
        ajax_insert();
    })

// 1 appel ajax pour afficher les employes
    function affiche_employes(){
        
        // 2 je creer l'objet AJAX
        if( window.XMLHttpRequest) r = new XMLHttpRequest();
        else r=new ActiveXObject('Microsoft.XMLHTTP');   // c est le nom de l'objet ajax pour IE

        // 2 je mets, si besoin, des parametres associés à cet objet AJAX:
        var parameters="action=affichage"

        // j'ouvre mon fichier php
        r.open("POST","ajax.php",true); 
        r.setRequestHeader("Content-type","application/x-www-form-urlencoded") 
        // 3 j'envoie mon  objet avec ses eventuels parametres.
        r.send(parameters);
        r.onreadystatechange = function(){
            if( r.readyState == 4 && r.status== 200){
        // 5 si ca s'est bien passé, je recupere la reponse. et je la mets,cette reponse dans obj
                var obj = JSON.parse(r.responseText);
        // 6 actions
                document.getElementById('employes').innerHTML=obj.resultat;

            }      //bref, je vais avoir une reponse: r.responseText   et cette reponse est stockee dans obj  puis dans obj, on recupere (obj.resultat) uner chaine qu'on rempli avec un tableau d'employes
        }
    }





    function ajax_insert(){
        //appel ajax pour inserer un employe
        if( window.XMLHttpRequest) r = new XMLHttpRequest();
        else r=new ActiveXObject('Microsoft.XMLHTTP');   // c est le nom de l'objet ajax pour IE

        //ce que j'envoie a php:
        var nom= document.getElementById('nom').value;
        var prenom= document.getElementById('prenom').value;
        var sexe= document.getElementById('sexe').value;
        var service= document.getElementById('service').value;
        var date_emb= document.getElementById('date_embauche').value;
        var salaire= document.getElementById('salaire').value;

        var parameters="action=insertion&nom=" + nom + "&prenom=" + prenom + "&sexe=" + sexe + "&service=" + service + "&date_emb=" + date_emb + "&salaire=" + salaire 

        // j'ouvre mon fichier php
        r.open("POST","ajax.php",true); 
        r.setRequestHeader("Content-type","application/x-www-form-urlencoded") 
        // 3 j'envoie mon  objet avec ses eventuels parametres.
        r.send(parameters);
        r.onreadystatechange = function(){
            if( r.readyState == 4 && r.status== 200){
        // 5 si ca s'est bien passé, je recupere la reponse. et je la mets,cette reponse dans obj
                var obj = JSON.parse(r.responseText);
                // 6 actions
                if( obj.validation == "ok"){
                    affiche_employes();
					//pour vider d'un coup tous les champs du formulaire
					document.getElementById("myform").reset();
                }
            }
    // ce ajax c'est pour le 1er affichage, tant qu'on n'apas fait de change dans notre select

//estceque l'obj existe dans la fenetre dans laquelle je me trouve dans le navigateur(c'est pour testé si je suis sur ie qui repondra false.)
    
		//LES 2 LIGNES CI DESSOUS PERMETTENT SIMPLEMENT D UTILISER AJAX SUR TOUS LES NAVIGATEURS (Y COMPRIS IE)
 
    
        }
    }

}); //fin du document ready(JS)