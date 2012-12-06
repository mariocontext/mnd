  $(document).ready(function(){
    // Target your .container, .wrapper, .post, etc.
    $("#main-content-container").fitVids();
  });

  var myWindowWidth = $(window).width();

  if (myWindowWidth <= 600) {

  	// makes c5 layout areas fill horiz space
	$(".ccm-layout-table .ccm-layout-col").css("width", "100%");

}