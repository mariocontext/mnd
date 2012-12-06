// JavaScript Document

$(init);

// score begins at zero
var score = 50; 

// run when ready
function init() {
	
	// look for score and feedback if they exist
	var cookieResults = readCookie('myScore'); 
	var cookieFeedback = readCookie('myFeedback');
	
	function checkSavedScore() {
	
		// if it doesn't exist, set to zero
		if(cookieResults == null) {
			
		score = 50;
		$(".feedback").html("You can do it!");
		
		} else {
			
		score = cookieResults;
		$(".feedback").html("You are " + cookieFeedback + " !");
	  
		}
	  
	  // send to double checking display
	  cookieDisplayArea()
	  
	  //update Score
	  updateScoreArea(score);

	}
	
	checkSavedScore();
	
	// adds markers to all anchor links or just in a specific area
	function addLinkMarkers() {
	
		$("#container a").addClass("actionlink");
		$("#container a:contains(r)").removeClass("actionlink");
		$("#container a:contains(r)").addClass("inactionlink");
		$('#container a').click(trigger);
	
	}

	addLinkMarkers();

	function trigger() {
        
		currentLink = $(this);
		// deactivates link by removing it when it's been clicked once per page
		if(currentLink.hasClass('actionlink')){
		$(this).removeClass('actionlink');
		$(this).addClass('inactionlink');
		score++;
		//update stats
		updateStats();
		
		} else if(currentLink.hasClass('inactionlink')) { 
		score--;
		//update stats
		updateStats();
		$(".feedback").html("Ouch!");
			
		} else {
		// make the link do nothing but default behavior
		}

	}
	
	function updateStats() {
		updateScoreArea(score);
		randomCompliment();
		createCookie('myScore',score,7); //lasts for 7 days
		currentScore = readCookie('myScore');
		cookieFeedback = readCookie('myFeedback');
		cookieDisplayArea();
	}
	
	function updateScoreArea(score) {
		$("#scoringArea").html(" SCORE <br />" + "<h4>" + score + "</h4>");
	}
	
	//possible score feedback based on levels reached
	/*
	function feedback(score) {
		switch(score) {	
		case 10: 
		$(".feedback").html("Your are amazing at" + score + "!");
		break;
		case 20: 
		$(".feedback").html("Your are fantastic at 20!");
		break;
		case 30: 
		$(".feedback").html("Your are magnificient at 30!");
		break;
		default:
		$(".feedback").html("You haVE GONE BEYOND!");
		}
	}
	*/
	
	// resets page and score
	function eraseScore() {
		eraseCookie('myScore');
		eraseCookie('myFeedback');
	}
	$("#eraser").click(eraseScore);
	
	// generates random compliment per point	
	var compliments = new Array("amazing", "fabulous", "uberhuman", "wowness", "ultimate", "majestic", "too cool");
	
	var insults = new Array("terriblicous", "atrociffic", "barbarous", "paraprazzi", "ignorantic", "unimpressive", "not goody");
	
	function randomCompliment() {
		
		if(score > 0) {

		feedbackProcessor(compliments)
		
		} else if(score < 0) {

		feedbackProcessor(insults)
			
		} else {
		createCookie('myFeedback', 0, 7); //lasts for 7 days
		$(".feedback").html("You are nada at " + score);
		}
	}
	
	function feedbackProcessor(collection) {
		
		someNumber = Math.random() * collection.length;
		termNumber = Math.ceil(someNumber) - 1;
		createCookie('myFeedback', collection[termNumber], 7); //lasts for 7 days
		$(".feedback").html("You are " + collection[termNumber] + " !");
		
	}
	
	// base cookie functions
	
	function cookieDisplayArea() {
		$(".cookieDisplay").html(cookieResults);
		$(".cookieDisplay").append(cookieFeedback);	
	}
	
	
	function createCookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}
	
	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	
	function eraseCookie(name) {
		createCookie(name,"",-1);
	}

			
	
} //end inti()
