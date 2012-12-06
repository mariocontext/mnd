

var myDeviceWidth = $(window).width();

if (myDeviceWidth <= 600) {

$('#header-nav ul li').first().prepend("<li><a href='#' class='nav-toggler'>+ Open Navigation </a></li>");
$('#header-nav ul li a').css("display","none");
$('#header-nav ul li a.nav-toggler').css("display","block");

$('.nav-toggler').toggle(function() {
	$('#header-nav ul li a').css("display","block");
	$('#header-nav ul li a').not('.nav-toggler').show("slow");
	$(this).html("- Close Navigation");
	
}, function() {
	$('#header-nav ul li a').css("display","block");
	$('#header-nav ul li a').not('.nav-toggler').hide("slow");
	$(this).html("+ Open Navigation");

	}
);



} else {

	// do nothing

}

