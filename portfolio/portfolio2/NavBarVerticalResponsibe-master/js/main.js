$(document).ready(function() {

	//Para mostrar el menu cuando le demos click al botón
	$("#btn-menu").click(function() {
		if($(this).hasClass("fa-bars")) {
			$(this).removeClass("fa-bars");
			$(this).addClass("fa-times");
			$(".navegation .menu").css({"left": "0px", "height": "100%"});
			$(".navegation").css({"width": "100%", "background": "rgba(0, 0, 0, .3)"});
		} else {
			$(this).removeClass("fa-times");
			$(this).addClass("fa-bars");
			$(".navegation .menu").css({"left": "-300px"});
			$(".navegation").css({"width": "0%", "background": "rgba(0, 0, 0, .0)"});
			$(".submenu").css({"left": "-300px"});
		}
	});
	//Para ocultar el menu cuando demos click en el boton de usuario
	$("#btn-user").click(function(e) {
		e.preventDefault();
		$(".navegation").css({"width": "0%", "background": "rgba(0, 0, 0, .0)"});
		$(".navegation .menu").css({"left": "-300px"});
		$("#btn-menu").removeClass("fa-times");
		$("#btn-menu").addClass("fa-bars");
		$(".submenu").css({"left": "-300px"});
	});

	//Para mostrar los submenus
	$(".navegation .menu > .item-submenu a").click(function() {
		var positionMenu = $(this).parent().attr("submenu");
		$(".item-submenu[submenu="+positionMenu+"] .submenu").css({"left": "0px"});
	});

	//Para ocultar los submenus
	$(".navegation .menu li.go-back").click(function() {
		$(".submenu").css({"left": "-300px"});
	});

	//Para que los enlaces <a> no activen su evento de redirección
	$(".navegation a").click(function(e) {
		if($(this).parent().hasClass("item-submenu") 
			|| $(this).parent().hasClass("go-back") || $(this).parent().hasClass("title-menu")) {
			e.preventDefault();
		}
	});

	//Para que el menú desaparezca cuando se cambie la pantalla
	$(window).resize(function() {
		$(".navegation").css({"width": "0%", "background": "rgba(0, 0, 0, .0)"});
		$(".navegation .menu").css({"left": "-300px"});
		$("#btn-menu").removeClass("fa-times");
		$("#btn-menu").addClass("fa-bars");
		$(".submenu").css({"left": "-300px"});
	});
});