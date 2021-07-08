document.addEventListener("DOMContentLoaded", function(){
		
		window.addEventListener('scroll', function() {
			
			var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
	       
			if (window.scrollY > 100 && width>767) {
				document.getElementById('bottomnav').classList.add('fixed-top');
			}else {
			 	document.getElementById('bottomnav').classList.remove('fixed-top');
			} 
		});
	});