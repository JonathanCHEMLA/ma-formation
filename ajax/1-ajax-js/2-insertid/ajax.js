// c'est le fichier js qui appelle le fichier php.

//j'attend que mon document soit complemtement charge avantr de faire ce qui il a au milieu
document.addEventListener("DOMContentLoaded",function(event){

    document.getElementById('submit').addEventListener("click",function(event){
        
        event.preventDefault(); //annule le comportement habituel du bouton submit
        monajax();

    });

    function monajax(){
//estceque l'obj existe dans la fenetre dans laquelle je me trouve dans le navigateur(c'est pour testé si je suis sur ie qui repondra false.)
    
        if( window.XMLHttpRequest) r = new XMLHttpRequest();
        else r=new ActiveXObject('Microsoft.XMLHTTP');   // c est le nom de l'objet ajax pour IE

        var personne=document.getElementById('personne').value;
        var parameters= "personne=" + personne; // equivalent a ce qui est envoye au get: ?a=truc&b=tac

        r.open("POST","ajax.php",true); //ouverture en methode POST vers ajax.php
        //je dois envoyer à ajax.php le ligne ci-dessous, en entetes pour qu'il sache que c est un form que nous lui envoyons pour que derriere on utilise $_POST("")
        r.setRequestHeader("Content-type","application/x-www-form-urlencoded")  //cmme j'utilise la methode POST, je doit taper cette ligne
        r.send(parameters);
        //pour info: je suis en POST pour recuperer et exploiter mes parametres grace a php
        
        r.onreadystatechange = function(){
            if( r.readyState == 4 && r.status== 200){
                document.getElementById('resultat').innerHTML = "employé '" + personne + "' ajouté!";
                
                document.getElementById('personne').value='';//cette ligne me vide le champ
            }
        }
    }
}); //fin du document ready(JS)