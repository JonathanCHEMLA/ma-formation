// function openMenu(){
//   console.log("si");
//   $("#Menu").css("display", "none");
//   $("#MenuBar").css("display", "block");
// };

$(document).ready(function(){
    $("#menu").click(function(event){
      event.preventDefault();
      // console.log("si");
      $("#Menu").toggle("slow");//.css("display", "none");
      // $("#MenuBar").css("display", "block");
      $("#MenuBar").toggle("slow");
        });
    $("#tache").click(function(event){
      event.preventDefault();
      // console.log("si");
      $("#MenuBar").toggle("slow");//.css("display", "none");
      // $("#Menu").css("display", "block");
      $("#Menu").toggle("slow");

        });
});
