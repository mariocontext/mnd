// JavaScript Document


$(myAppy);

	function myAppy() {

		// general bounce
		 
			 $('.myPoppy').mouseover(function(){
				 
		 $(this).animate({"top": "-=30px", "easing": "easeout"
 }, "400", "linear").animate({"top": "+=30px", "easing": "easein"
 }, "400", "linear");
				 
			 		}
				);
		
		//navMarker
				
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
		

		
		$('#myNavMarker').animate({"top": "-=30px", "easing": "easeout"
		 }, "400", "linear").animate({"top": "+=30px", "easing": "easein"
		 }, "400", "linear");
		 
		 				
			}
			

			
		);
		
		
		
		// mySlider
		
		 $('.mySlider').mouseover(function(){
				 
 $(this).animate({"left": "-=100px", "easing": "easeout"
 }, "400", "linear").animate({"left": "+=150px", "easing": "easein"
 }, "400", "linear").animate({"left": "-=150px", "easing": "easeout"
 }, "400", "linear");
				 
			 		}
				);
		
		//myMario

$("#myMario").append("<a href=\"\"><div id=\"myKey\"");

$("#myMario").mouseover(function() {
	
	$("#myKey").css('display','block');			

		}
);

$("#myMario").mouseleave(function() {
	
	$("#myKey").css('display','none');			

		}
);

function checkKey(e){
	
	
     switch (e.keyCode) {
        case 40:
		//down
             $("#myMario").animate({"top": "+=50px"
 }, "800", "linear")
            break;
        case 38:
		//up
            $("#myMario").animate({"top": "-=50px"
 }, "800", "linear")
            break;
        case 37:
		//left
			
            $("#myMario").animate({"left": "-=50px"
 }, "800", "linear").css('background-image', 'url("' + 'http://marionobledesign.com/themes/general_layout/images/marioSmallLeft.png' + '")');


            break;
        case 39:
		//right
        $("#myMario").animate({"left": "+=50px"
 }, "800", "linear").css('background-image', 'url("' + 'http://marionobledesign.com/themes/general_layout/images/marioSmallRight.png' + '")');
            break
			//other;
        default:
            //some action 
            }      
}

function stopKey(){
	$("#myMario").clearQueue();
	
}

if ($.browser.mozilla) {
    $(document).keypress (checkKey);
	$(document).keyup (stopKey);
} else {
    $(document).keydown (checkKey);
	$(document).keyup (stopKey);
}



				

}


