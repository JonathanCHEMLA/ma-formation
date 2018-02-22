$(function(){
// Sur notre "Formulaire", placer un écouteur(BIND) qui éxécutera, au "submit":
    $( "#MonFormulaire" ).bind( "submit", function(event) {
            
        event.preventDefault(); //preventDefault()

        $( "#MonFormulaire" ).hide(1000);
        
        p=document.createElement("p");  //document
        // le . signifie dans. ex: le innerHTML qui se trouve dans p
        p.innerHTML="Bonjour " + $("#nomcomplet").val();    //val();

        $("body").append(p);        //$('body')

        })           

});

/*
//FONCTION QUI CREE DES PARAGRAPHES DANS MA PAGE HTML
function appendText() {
    var txt1 = "<p>Text.</p>";               // Create element with HTML  
    var txt2 = $("<p></p>").text("Text.");   // Create with jQuery
    var txt3 = document.createElement("p");  // Create with DOM
    txt3.innerHTML = "Text.";
    $("body").append(txt1, txt2, txt3);      // Append the new elements 
}    
*/