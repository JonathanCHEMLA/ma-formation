$(document).ready(function () {

	$("#btn-menu").click(function (e) {
		e.preventDefault();
		if(!$(this).hasClass('activo')) {
			$(this).addClass('activo');
			$("#menu-container").show("slide", {direction: "left"}, 100);
			$("#btn-menu-left").removeClass('activo');
			$("#btn-menu-left").css({"display": "inline"});
		}
	});


	$("#btn-menu-left").click(function (e) {
		e.preventDefault();
		if(!$(this).hasClass('activo')) {
			$(this).addClass('activo');
			$("#menu-container").hide("slide", {direction: "left"}, 100);
			$("#btn-menu").css({"display": "inline"});
			$("#btn-menu").removeClass('activo');
		}
	});

	$(window).resize(function () {
		if($(document).width() > 568) {
			$("#menu-container").show("slide", {direction: "left"}, 100);
			$("#btn-menu").removeClass('activo');
			$("#btn-menu").css({"display": "none"});
			$("#btn-menu-left").removeClass('activo');
			$("#btn-menu-left").css({"display": "none"});
		} else {
			$("#menu-container").hide("slide", {direction: "left"}, 100);
			$("#btn-menu").css({"display": "inline"});
			$("#btn-menu").removeClass('activo');
			$("#btn-menu-left").removeClass('activo');
		}
	});
});