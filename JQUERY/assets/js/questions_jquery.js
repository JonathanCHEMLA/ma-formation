
/*********************************************************************************************************************************************************************** */
EXO 8

function reinitialisationDuFormulaire(){
    //il existe plusieurs methodes possibles:
    // -- en jQuery
    $('#contact').trigger('reset');	// trigger est une procedure stockée qui est executée automatiquement... J ai pas compris ??: on peut pas ecrire directement:".reset()" ?! pourtant on l'a ecrit 5 ligne en dessous...? quesqu il nous apporte en plus ce trigger ? 
    $('#contact').get(0).reset();   //deja expliqué, mais pas entendu	// cmt se fait-il que l'element 0 de mon formulaire soit ce que je viens de taper? et prq le formul. est un tableau d objet(je dis ca a cause du get) ?	
    $('#contact .form-control').val('');   //tous les input du formulaire(sauf le bouton) ont une class "form-control". pb:ca ne faut que vider les champs
    // -- en javascript
    document.getElementById('contact').reset();
}


EXO 9

// -- 1. Une requète AJAX Simple
$.ajax('http://geoip.nekudo.com/api/')  //le function(resultat) est la fct de callback de la fct $.ajax n'est-ce oas?
.done(function(resultat) {     // [...] a abouti, et que le serveur a recupere mes donnees alors la fct function, dans le done est automatiquement appelee
	console.log(resultat);      // et les données du serveur sont accessible dans la variable resultat. le serveur envoie a ma fct les données au format json
	console.log(resultat.ip)
});//$ : jquery    // url de l'api que l'on veut interroger pour recuperer les données du serveur quand une requete [...]
que signifie "$."  
$.ajax() est la notation utilisee pour faire une requete AJAX




EXO 10

$.each(articles, function(indice,articles){    //$.each(  	que signifie le $. ? et ou est passé le mot for? c'est bien une boucle foreach???



