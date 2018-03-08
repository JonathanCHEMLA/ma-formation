
$(document).ready(function(){

	var menu_parcours			= $('#menu_parcours');
	var bouton_parcours			= $('#bouton_parcours');
	var parcours				= $('#parcours');
	var mon_parcours_cache		= $('#mon_parcours_cache');	

	
	$('#mon_parcours_cache').hide();

	
menu_parcours.on("click",function(){
	
	$('#mon_parcours_cache').show();
	$('#mon_parcours_cache').style.display="block";	
	
	//window.location.replace("index.php");

	});

bouton_parcours.on("click",function(){
	
	$('#mon_parcours_cache').show();
	$('#mon_parcours_cache').style.display="block";	
	
	//window.location.replace("index.php");

	});



	
});
