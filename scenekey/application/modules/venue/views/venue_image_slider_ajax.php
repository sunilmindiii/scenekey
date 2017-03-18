
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>slider_assets/include/css/main.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/fonts/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.transitions.css">
	
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>slider_assets/include/css/normalize.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.theme.css">-->

	
	<?php //echo $imgCount.'======'.$prevCount;?>
	
	
	
	
	
	<div class="container-fluid bg-re">
		<div class="row">
			<div class="user-wrapper">
				<div id="owl-user" class="owl-carousel">
				
					<?php
					
					if(!empty($images)){
						
						foreach($images as $subdata){
							//echo "===>".$subdata['event_id'];
							if(isset($subdata['type']) && $subdata['type']=='Comment'){
								?>

							<div class="item">
								<!--user profile image-->
									<div class="u-detail" >
										<div class="pro-img" style="background:url(<?php echo base_url(); ?>upload/<?php echo $subdata['userImage']; ?>)"></div>
										<h4>
											<?php 
											$name = explode(" ",$subdata['fullname']); 
											echo $name[0];
											?>
										</h4>
										<p><span><?php echo date("h:i a", strtotime($subdata['date'])); ?></span></p>
									</div>
							</div>
							<?php
								} elseif(isset($subdata['type']) && $subdata['type']=='Picture') {
								
								?>
								<div class="item">
									<!--user profile image-->
									<div class="u-detail" >
										<div class="pro-img" style="background:url(<?php echo base_url(); ?>upload/<?php echo $subdata['userImage']; ?>)"></div>
										<h4>
											<?php 
											$name = explode(" ",$subdata['fullname']); 
											echo $name[0];
											?>
										</h4>
										<p><span><?php echo date("h:i a", strtotime($subdata['date'])); ?></span></p>
									</div>
								</div>
							<?php
								
							} else {
								?>
							<div class="item">
									<!--user profile image-->
									<div class="u-detail" >
										<div class="pro-img" style="background:url(<?php echo base_url(); ?>images/venue/<?php echo $subdata['venue_image']; ?>) no-repeat;background-size:cover;background-position: center;"></div>
										<h4><?php echo !empty($subdata['venue_name']) ? $subdata['venue_name'] : 'Los Angeles'  ?></h4>
										<p><span><?php //echo date("ha Y-M-d", strtotime($subdata['date'])); ?></span></p>
									</div>
								</div>
							<?php }
						}
					}
				?>
				</div> 
			</div>
		
		
			<div class="provision vertical-ali">
				<div id="owl-demo" class="owl-carousel">
					
					<?php
					
					if(!empty($images)){
					
						foreach($images as $subdata){
							
							if(isset($subdata['type']) && $subdata['type']=='Comment'){
								?>
								<div class="item">
									<div  style="position:absolute;width:100%; height:100%; background:rgba(0,0,0,0.5);"></div>
									<div class="text-slide vertical-align blur"  style="background:url(<?php echo base_url(); ?>upload/<?php echo $subdata['userImage']; ?>) no-repeat;background-size:cover;background-position:left center;">
										<div  style="position:absolute;width:100%; height:100%; background:rgba(0,0,0,0.5);top: 0;
    left: 0;"></div>
										<!--<i class="fa fa-quote-left fist-i"></i>-->
										<h2 >"<?php echo $subdata['feed']; ?>"</h2>
										<!--<i class="fa fa-quote-right"></i>-->
									</div>
									
									
								</div>
								<?php
							} elseif(isset($subdata['type']) && $subdata['type']=='Picture') {
								?>
								<div class="item" style="background:url(<?php echo base_url(); ?>upload/<?php echo $subdata['feed']; ?>) no-repeat;background-size:cover;background-position:left center;">
									
									
								</div>
								<?php
								
							} else {
								?>
								<!--when there is no feeds-->
								<div class="item">
									
									<?php
									if(!empty($subdata['venue_image'])):
									?>
									
									<div class="blur text-slide vertical-align " style="background:url(<?php echo base_url(); ?>images/venue/<?php echo $subdata['venue_image']; ?>) no-repeat;background-size:cover;background-position:left center;">
									<?php 
									else:
									?>
									
									<div class="blur text-slide vertical-align">
									<?php endif;?>
									<div  style="position:absolute;width:100%; height:100%; background:rgba(0,0,0,0.5);top: 0;
    left: 0;"></div>
										<h2>"Event Starting Soon"</h2>
									</div>
									
								</div>
								
								<?php
							}
						}
					} else {
						
					}
					
					?>
					
				</div>

			</div>
			
			<div class="left-top">
				<a href="#"><img src="<?php echo base_url();?>slider_assets/include/img/app-logo.png" alt=""/></a>    
			</div>

		</div>
	</div>
	
	<div id="backtonormalsceen" class="close-x"><span>X</span></div>
	
	<script src="<?php echo base_url(); ?>js/fullscreen.js"> </script>
	<script src="<?php echo base_url(); ?>slider_assets/include/js/owl.carousel.js"></script>
	
	
	<script type="text/javascript">
	
	var speed = 5000;
	<?php if(isset($eventCheck)) : ?>
		speed = false;
	<?php endif; ?>
	
	$(document).ready(function() {
		var owl = $("#owl-demo");
		owl.owlCarousel({
			autoPlay:speed,
			navigation : false,
			singleItem : true,
			pagination:	false,
			// stopOnHover : true,
			transitionStyle : "fadeUp"
		});
		
		var owluser = $("#owl-user");
		owluser.owlCarousel({
			autoPlay:speed,
			navigation : false,
			singleItem : true,
			pagination:	false,
			// stopOnHover : true,
			transitionStyle : "backSlide"
		});
		
		
		<?php if($imgCount > $prevCount):?>
		
		owl.data('owlCarousel').goTo(<?php echo $imgCount; ?>); 
		owluser.data('owlCarousel').goTo(<?php echo $imgCount; ?>); 

		<?php endif;?>
		//#1f9796
		
		$("body").mousemove(function(e){
			$('.close-x').css({"background": "#1f9796"});
		});
		
		$('body').mousestop(function() {
			$('.close-x').css({"background": "#fff"});
		})
	  
		$("#backtonormalsceen").click( function(){
			goBackToVenue();
		});
		
		
	 
	});
	
	document.addEventListener("mozfullscreenchange", function () {
		if (document.mozFullScreen) {
			isFullScreen();
		} else {
			notFullScreen();
		}
	}, false);
	
	$(document).keyup(function(e) {
		
		if (e.keyCode == 27) { // escape key maps to keycode `27`
			goBackToVenue();
		}
		
	});
	
	function exitFullscreen() {
	  if(document.exitFullscreen) {
		document.exitFullscreen();
	  } else if(document.mozCancelFullScreen) {
		document.mozCancelFullScreen();
	  } else if(document.webkitExitFullscreen) {
		document.webkitExitFullscreen();
	  }
	}
	
	function goBackToVenue()
	{
		$("#wait").html('<strong>Please Wait...</strong>');
			var url = "<?php echo base_url();?>index.php/venue/deleteFile?name=<?php echo $file;?>";
			$.get(url, function(data) {
				
				//window.location.href = "http://209.208.79.95/~scenkey/screenkey/index.php/venue?venue_city=<?php echo $_GET['venue_city'];?>";
				
				exitFullscreen();
				$(".header").show();
				$(".banner").show();
				$(".banner-bottom").show();
				$(".footer").show();
				
				//clear the timer set
				clearTimeout(refreshImg);
				$("body").css({"background": "#fff"});
				$('div#ajaxContents').html('');
				
				if(navigator.appName == "Microsoft Internet Explorer")
					window.document.execCommand('Stop');
				else
					window.stop();
				
				//window.location.href = "http://209.208.79.95/~scenkey/screenkey/index.php/venue?venue_city=<?php echo $_GET['venue_city'];?>";
				
			});
			
	}
	
	</script>