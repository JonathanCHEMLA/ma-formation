
//J'écoute l'action "clic" sur le bouton qui porte l'id action
document.getElementById('action').addEventListener('click',loadDoc);

function loadDoc()
{
    //alert('je suis appelée');

    //je crée un objet xhttp
    var xhttp = new XMLHttpRequest();

    //je teste le changement de l'etat
    xhttp.onreadystatechange = function()
    {
    
        if( xhttp.readyState == 4 && xhttp.status == 200 )
        {
            //4: il y a 4 etapes d'envoi (de 0 a 4, 0 etant l'etat "NON ENVOYE") ma page est totalement chargée
            //200: 200 c'est le code transmis lorsqu'il n'y a pas d'erreur sinon c'est une page erreur 404.
            
            //en cas de changement:
            document.getElementById('demo').innerHTML = xhttp.responseText;
            // xhttp.responseText contient le contenu du fichier.txt
            // document.getElementById('demo').innerHTML va remplacer le contenu existant
        
        }
    } 
            //on effectue ce changement
    xhttp.open("GET","fichier.txt",true);    //c'est la methode d'envoi //true: oui c est un mode asynchrone 
    xhttp.send();   //j'ouvre une connection en txt en get, puis j'envoie. Ce qui entraine que le readystate passe de 0 a 4. puis, if du dessus s'execute.

}//on lance la page est on fait clickdroit/inspecteur/Network


