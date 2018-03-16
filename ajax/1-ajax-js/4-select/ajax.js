document.addEventListener("DOMContentLoaded",function(event){

    // ce ajax c'est pour le 1er affichage, tant qu'on n'apas fait de change dans notre select
    ajax();

// 1. je change la liste selectionnable
    document.getElementById('personne').addEventListener("change",function(event){ 
        //event.preventDefault(); //annule le comportement habituel du bouton submit
        ajax();

    });

    function ajax(){
//estceque l'obj existe dans la fenetre dans laquelle je me trouve dans le navigateur(c'est pour testé si je suis sur ie qui repondra false.)
    
		//LES 2 LIGNES CI DESSOUS PERMETTENT SIMPLEMENT D UTILISER AJAX SUR TOUS LES NAVIGATEURS (Y COMPRIS IE)
        if( window.XMLHttpRequest) r = new XMLHttpRequest();
        else r=new ActiveXObject('Microsoft.XMLHTTP');   // c est le nom de l'objet ajax pour IE

		// ici on l'ecrit en 2 lignes (contrairement au dossier précedent) car on fait un select. Or sa value ne se trouve pas dans la meme balise
        var personne=document.getElementById('personne');
		///options est un attribut de la balise <select>. (ex: si le 3e de la liste, qui est Thomas, est selectionné, alors personne.selectedIndex est égal à 2 & sa value est 415) (voir la table employes si besoin...)
		var id = personne.options[personne.selectedIndex].value;
		
        var parameters= "id=" + id; // equivalent a ce qui est envoye au get: ?a=truc&b=tac
        
		r.open("POST","ajax.php",true); //ouverture en methode POST vers ajax.php
        //je dois envoyer à ajax.php le ligne ci-dessous, en entetes pour qu'il sache que c est un form que nous lui envoyons pour que derriere on utilise $_POST("")
        r.setRequestHeader("Content-type","application/x-www-form-urlencoded") 
        
// 2. J'envoie à mon fichier php, le prenom que l'internaute a selectionné et qui a été placé dans parametre
		r.send(parameters);
        //pour info: je suis en POST pour recuperer et exploiter mes parametres grace a php
        
        r.onreadystatechange = function(){
            if( r.readyState == 4 && r.status== 200){
                // il fait un delete mais aussi il renvoie une reponse au format JSON.
				//je récupère la réponse du fichier PHP (une fois la suppression effectuée) au format JSON.
				
// r.responseText va contenir le "json_encode($tab)" de mon fichier js.
// 5. Je traite ma réponse. Etant donné que js ne peut exploiter JSON sur une seule ligne, il va devoir la découper.
				
				var obj = JSON.parse(r.responseText);
				
				//ce console.log de ma variable "obj" est visible dans notre console
				console.log(obj);	
				
                //exploiter obj
                if( obj.validation == "ok"){
                    document.getElementById('resultat').innerHTML=obj.resultat;
                }
            }
        }
    }
}); //fin du document ready(JS)