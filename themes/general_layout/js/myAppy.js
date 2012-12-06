// JavaScript Document


$(myAppy);

	function myAppy() {
		

		 
			 $('.myPoppy').mouseover(function(){
				 
 $(this).animate({"top": "-=30px", "easing": "easeout"
 }, "400", "linear");
 
 		 $(this).animate({"top": "+=30px", "easing": "easein"
 }, "400", "linear");
				 
			 		}
				);
		
			
				
		$(".nav-header a").mouseover(function() {
				
		var p = $(this);
		var position = p.position();
		var width = p.width();
		var center = width/2;
		var lefty = position.left;
		var finalpos = lefty + center;
		var marker = $("#myNavMarker");
		var markerpos = marker.position();
		
		
		$('#myNavMarker').css('top', 118);
		$('#myNavMarker').css('left', finalpos - 5);
		
		
		
				 $('#myNavMarker').animate({"top": "-=30px", "easing": "easein"
		 }, "400", "linear");
		 
				 $('#myNavMarker').animate({"top": "+=30px", "easing": "easein"
		 }, "400", "linear");
		 				
			}
			
		);		

}


