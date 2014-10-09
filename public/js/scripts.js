function fader() {
		
	var $window = $(window);	
	screenResized();

	$window.scroll(function() {

		if(!$window.scrollTop()) {
			$( "#mainnav" ).addClass('opaque').removeClass('navbar-inverse');
			screenResized();								
		} else {
			$( "#mainnav" ).removeClass('opaque').addClass('navbar-inverse');
		}

	});

}

function screenResized() {

	var $window = $(window);
	
	if($window.width() < 768) {
		$( "#mainnav" ).addClass('navbar-inverse').removeClass('opaque');
	} else {
		$( "#mainnav" ).removeClass('navbar-inverse').addClass('opaque');
	}

}


	
$(document).ready(function() {

	$(window).resize(function() {
		fader();
	});	

	fader();

});