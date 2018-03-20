//ce fichier et ajax.php ne s'executerons que si on est nous meme l'admin du tchat. Pour le monet c'est celui de fred

$(document).ready(function(){// pour s'assurer que le DOM est bien entierement chargée e que j'ai donc acces à tous les elements du DOM
  
//Initialisation du tchat
convertir_smiley();// pour que les smiley soient convertis, lorsque j'arrive pour la premiere fois sur la page
$('#message_tchat').scrollTop($('#message_tchat')[0].scrollHeight); //cela met l'ascensseur au plus bas de la hauteur de la div
var url='inc/ajax.php'; // url avec laquelle on va échanger en ajax
//var lastid=0;   // si j'ai pas d'autre info, je demarre a 0.
var timer=setInterval(affichage_message,5000);// intervalle de 5 secondes de vérification des messages
var timer_membre_connect=setInterval(affichage_membre_connecte,8000);//intervalle de vérification des membres

//fct qui s'occupe de rafraichir la fenetre des messages: "message tchat". c'est la grande fenetre rectangle
function affichage_message(){
    $.post(url,{'action':'affichage_message','lastid':lastid},function(donnees){

        if(donnees.validation=='ok'){
            $('#message_tchat').append(donnees.resultat);
            lastid=donnees.lastid;
            $('#message_tchat').scrollTop($('#message_tchat')[0].scrollHeight); 
            //cela met l'ascensseur au plus bas de la hauteur de la div
            convertir_smiley();
            //cela transforme les :) par l'image de smiley
        }
    },'json');
}
//fct qui s'occupe de rafraichir la fenetre des membres connectes: "liste membre connectes". Il se trouve a droite.
function affichage_membre_connecte(){

    $.post(url,{'action':'affichage_membre_connecte'},function(donnees){
        if(donnees.validation=='ok'){
            $('#liste_membre_connecte').empty().append(donnees.resultat);
            //on aurait pu aussi bien sur vider le formulaire avec .html(donnees.resultat)
        }
    },'json');
    //action c'est l'index et affichage_membre_connecte c'est la valeur    
}
//fct permettant l'ajout d'un message
// pour designer la 'form' qui se trouve dans la div '#formulaire_chate' dans index.php
$('#formulaire_chate form').submit(function(){

    // pour ne pas qu'il affiche le message pdt que je suis en train de le taper, je stoppe et redemarre:
    clearInterval(timer);

    var message=$('#formulaire_chate form input[name=message]').val(); //je recupere le texte du msg saisi
    $.post(url,{'action':'envoi_message','message':message},function(donnees){
        if(donnees.validation=='ok'){
            affichage_message();
            // je vide le contenu de l'input qui contient le msg et je met le curseur dans l'input
            $('#formulaire_chate form input[name=message]').val('').focus();
        }
    },'json');

    timer=setInterval(affichage_message,6000);  //reexecute la fct affichage_message toutes les 6 secondes
    //timer est un objet, au meme titre que l'objet pdo, et il contient le 'setinterval'.
    //return false;  c'est l'equivalent du prevent default: ca stoppe l'envoi du formulaire
    return false;

})
$(".smiley").on("click",function(event){
    //je stocke les messages en cours de saisie (dans la barre du tchat), dans une variable.
    var prevMsg=$("#message").val();
    //je recupere la valeur de l'attribut alt de l'image cliquée. je definis le message correspondant au smiley
    var emotiText=$(event.target).attr('alt');
    //le message est egal au texte saisi + smiley ajouté
    $('#message').val(prevMsg + emotiText);
    $('#message').focus();


});

function convertir_smiley(){
    //pour chaque paragraphe de message
    $('#message_tchat p').each(function(){
        //pour tous les smileys
        $('.smiley').each(function(){
        var symbole=$(this).attr('alt');
        var source=$(this).attr('src');
        //je vais convertir le symbole :)  en image
        var txtRemplace=$('#message_tchat').html().replace(symbole,'<img src="' + source +'">')
        $('#message_tchat').html( txtRemplace );
    });
});
}

$("#deconnexion").on("click",function(event){
    $.post(url,{'action':'deconnecter'},function(reponse){
    if(reponse.validation =="ok"){

        //en jquery, equivalent en php => header('location:connexion.php');
        $(location).attr('href','index.php');
        // location contient l'url sur laquelle on se trouve.
        //attr permet de pointer sur un des atributs de l'objet location (predefini, tel que window,document...)
        // l'attribut pointé est le href de l'url: on veut modifier l'url pour envoyer l'user vers index.php
    }
    },'json');
 });
})