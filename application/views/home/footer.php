<footer id="ft_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ft">						
					<ul>
						<li><a href=""><i class="fa fa-facebook"></i></a></li>
						<li><a href=""><i class="fa fa-twitter"></i></a></li>
						<li><a href=""><i class="fa fa-instagram"></i></a></li>
						<li><a href=""><i class="fa fa-google"></i></a></li>
					</ul>					
				</div>
				<ul class="copy_right">
					<li>UNJ Mengajar &copy; 2017</li>
				</ul>					
			</div>	
		</div>
	</div>
</footer>
<!-- End footer Section -->

<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
        <script src="<?php echo base_url("assets/js/vendor/jquery-1.11.3.min.js") ?>"></script>

<script src="<?php echo base_url("assets/js/isotope.pkgd.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/jquery-ui.js") ?>"></script>
<script src="<?php echo base_url("assets/js/appear.js") ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.counterup.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/waypoints.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/owl.carousel.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/showHide.js") ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.nicescroll.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.easing.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/scrolling-nav.js") ?>"></script>
<script src="<?php echo base_url("assets/js/plugins.js") ?>"></script>
<!-- Google Map js -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
	function initialize() {
	  var mapOptions = {
		zoom: 14,
		scrollwheel: false,
		center: new google.maps.LatLng(-6.194170, 106.878730)
	  };
	  var map = new google.maps.Map(document.getElementById('googleMap'),
		  mapOptions);
	  var marker = new google.maps.Marker({
		position: map.getCenter(),
		animation:google.maps.Animation.BOUNCE,
		icon: 'img/map-marker.png',
		map: map
	  });
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script src="<?php echo base_url("assets/js/main.js") ?>"></script>

<script src="showHide.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function(){


   $('.show_hide').showHide({			 
		speed: 1000,  // speed you want the toggle to happen	
		easing: '',  // the animation effect you want. Remove this line if you dont want an effect and if you haven't included jQuery UI
		changeText: 1, // if you dont want the button text to change, set this to 0
		showText: 'View',// the button text to show when a div is closed
		hideText: 'Close' // the button text to show when a div is open
					 
	}); 


});

</script>
<script>
    jQuery(document).ready(function( $ ) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>

<script>

  //Hide Overflow of Body on DOM Ready //
$(document).ready(function(){
    $("body").css("overflow", "hidden");
});

// Show Overflow of Body when Everything has Loaded 
$(window).load(function(){
    $("body").css("overflow", "visible");        
    var nice=$('html').niceScroll({
	cursorborder:"5",
	cursorcolor:"#00AFF0",
	cursorwidth:"3px",
	boxzoom:true, 
	autohidemode:true
	});

});
</script>



    </body>
</html>