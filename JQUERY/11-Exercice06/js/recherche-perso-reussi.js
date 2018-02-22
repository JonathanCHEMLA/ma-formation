
// -- On est en attente de jQuery:
$(function(){

    /*------------------------------------------------------------------------------*/
        // -- 1. Récupération des Géolocalisés:
    $.getJSON('https://jsonplaceholder.typicode.com/users', function(geolocalise) {
        
    /*------------------------------------------------------------------------------*/
    
        // -- 2. Declaration de ma fonction:
        function correspond(saisie,i){
      
            let nom     =       geolocalise[i].name;
            let surnom  =       geolocalise[i].username;
            let email   =       geolocalise[i].email;
            let tel     =       geolocalise[i].phone;
                        
                    // on interroge les 4 attributs ci-dessous, pour savoir s'il existe une correspondance avec ce qui a été saisi:

            // la saisie est transformée en minuscule:
        saisie=saisie.toLowerCase();
                                // on interroge les 4 attributs ci-dessous, pour savoir s'il existe une correspondance avec ce qui a été saisi:
                                var existenom = nom.search(saisie);
                                var existesurnom = surnom.search(saisie);
                                var existeemail = email.search(saisie);
                                var existetel = tel.search(saisie);
            // la saisie est transformée en MAJUSCULE:                      
        saisie=saisie.toUpperCase();                        
                                // on interroge les 4 attributs ci-dessous, pour savoir s'il existe une correspondance avec ce qui a été saisi:
                                var existeNOM = nom.search(saisie);
                                var existeSURNOM = surnom.search(saisie);
                                var existeEMAIL = email.search(saisie);
                                var existeTEL = tel.search(saisie); 
            // la première lettre saisie est transformée en MAJUSCULE:                       
        saisie=saisie.charAt(0).toUpperCase() + saisie.substring(1).toLowerCase();    
                                var existeNom = nom.search(saisie);
                                var existeSurnom = surnom.search(saisie);
                                var existeEmail = email.search(saisie);
                                var existeTel = tel.search(saisie);   

            if(saisie==""){
            // le input est vide:    
                return false
            }

                        //on teste chacun des 4 attributs, en "minuscule", "majuscule" et "capitalise": 
            if( existeNom==-1 && existeSurnom==-1 && existeEmail==-1 &&existeTel==-1   &&   existeNOM==-1 && existeSURNOM==-1 && existeEMAIL==-1 &&existeTEL==-1   &&   existenom==-1 && existesurnom==-1 && existeemail==-1 &&existetel==-1 )
            // on ne trouve pas de correspondance entre la saisie de l'utilisateur et la collection JSON disponible:
            {
                return false
            }
            else    
            { 
            // on trouve une correspondance:   
                return true
            }
        }
    
    /*------------------------------------------------------------------------------*/
    
        // 3. Démarrage de l'action JS lors de la saisie EN TEMPS REEL de l'user
       
            // lorsque l'user tape qq chose dans le input, on recherche, en temps réel, la liste des géolocalisés correspondants:
            $("#search").on("input", function(){
       
            //initialisation de ma page:
            //__________________________
    
                //on vide la liste des contacts précédemment affichés:
                $('.membre').remove();
                // on vide le champ input:
                let saisie="";
    
            // on récupère la saisie de l'user:
            saisie  =   $(this).val(); 

            // on parcourt la collection de contacts:
            for(let i=0;i<geolocalise.length;i++){   
                if(correspond(saisie,i))
                {// affichage du géolocalisé correspondant à la saisie de l'user:
                    $(`
                    <div class="membre">
                        <div class="membre_informations">
                            <p>Nom Complet :${geolocalise[i].name}      </p>
                            <p>Username :   ${geolocalise[i].username}  </p>
                            <p>Email :      ${geolocalise[i].email}     </p>
                            <p>Téléphone :  ${geolocalise[i].phone}     </p>
                        </div>
                    </div>
                    `).appendTo($('.resultat'));
                    let keyword = $(this).val(); 
                    $('.membre_informations').unmark().mark(keyword);                
                }     //end if      
            } //end For
        });   //end on. INUPUT       
    });//end $.getJson   
});   
    
    