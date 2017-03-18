
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>slider_assets/include/css/main.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/fonts/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.transitions.css">
	
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>slider_assets/include/css/normalize.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.theme.css">-->

	
	<?php //echo $imgCount.'======'.$prevCount;?>
	
	
	
	
	
	<style>
	.light_blue{display:none;}
	#bcWrap{display:none;}

	</style>
	<?php 
	
	
	//echo $imgCount.'======'.$prevCount;?>
	
	
	
	
	
	<div class="container-fluid bg-re">
		<div class="row">
			<div class="user-wrapper">
			<!--
<div class="item one" style="position: absolute; top: 0px;">
								
									<div class="u-detail" >
									<?php if(isset($images[0]['venue_image']) && $images[0]['venue_image']){																		
									$defaul_img=base_url().'scenekey/images/venue/'.$images[0]['venue_image'];                                    }
									else{
										$defaul_img=base_url().'assets/image/gray.png';
									}?>
										<div class="pro-img" style="background:url(<?php echo $defaul_img;?>) no-repeat;background-size:cover;background-position: center;"></div>
										<h4 class="venue_name_slider"><?php echo !empty($images[0]['venue_name']) ? $images[0]['venue_name'] : 'Los Angeles'  ?></h4>

									</div>
								</div>-->
				<div id="owl-user1" class="owl-carousel" style="<?php if(!isset($images[0]['type'])){ ?> display:block !important;<?php } ?> position: absolute; top: -330px;">
											
								<div class="item">
								
									<div class="u-detail" >
									<?php if(isset($images[0]['venue_image']) && $images[0]['venue_image']){																		
									$defaul_img='http://scenekey.com/scenekey/images/venue/'.$images[0]['venue_image'];                                    }
									else{
										$defaul_img=base_url().'assets/image/gray.png';
									}?>
										<div class="pro-img" style="background:url(<?php echo $defaul_img;?>) no-repeat;background-size:cover;background-position: center;"></div>
										<h4 class="venue_name_slider"><?php echo !empty($images[0]['venue_name']) ? $images[0]['venue_name'] : 'Los Angeles'  ?></h4>

									</div>
								</div>
					<?php
					
					if(!empty($images)){ 
					?>

						
						<?php foreach($images as $subdata){
							if(isset($subdata['type']) && $subdata['type']!=''){
								?>

							<div class="item">
								<!--user profile image-->
									<div class="u-detail" >
										<div class="pro-img" style="background:url(<?php echo 'http://scenekey.com/scenekey/'; ?>upload/<?php echo $subdata['userImage']; ?>)"></div>
										<h4>
											<?php 
											$name = explode(" ",$subdata['fullname']); 
											echo $name[0];
											?>
										</h4>
										<p><span><?php echo date("h:i A", strtotime($subdata['date'])); ?></span></p>
									</div>
							</div>
							<?php
								} /*elseif(isset($subdata['type']) && $subdata['type']=='Picture') {
								
								?>
								<div class="item">
									<!--user profile image-->
									<div class="u-detail" >
										<div class="pro-img" style="background:url(<?php echo 'http://69.28.75.158/scenekey/' ?>upload/<?php echo $subdata['userImage']; ?>)"></div>
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
								
							} */
						}
					}
				?>
				</div> 
			</div>
		
		
			<div class="provision vertical-ali">
				<div id="owl-demo" class="owl-carousel">

		
					          <div class="item">
									<div  style="position:absolute;width:100%; height:100%; background:rgba(0,0,0,0.5);"></div>
									<div class="text-slide vertical-align"  style="">
							        <div  style="position:absolute;width:100%; height:100%;top: 0;left: 0;"></div>
									<h2>Welcome to <?php echo @$images[0]['venue_name']?>! Join the fun! Share your pics & comments right here!</h2>
									</div>
																
								</div>
					<?php
					
					if(!empty($images)){

						foreach($images as $subdata){
							
							if(isset($subdata['type']) && $subdata['type']=='Comment'){
								?>
								<div class="item">
									<div  style="position:absolute;width:100%; height:100%; background:rgba(0,0,0,0.5);"></div>
									<div class="text-slide vertical-align"  style="">
			                         <div  style="position:absolute;width:100%; height:100%;top: 0;left: 0;"></div>
										<h2 ><?php echo $subdata['feed']; ?></h2>
									</div>
																
								</div>
								<?php
							} elseif(isset($subdata['type']) && $subdata['type']=='Picture') {
								?>
								<div class="item" style="background:url(<?php echo 'http://scenekey.com/scenekey/' ?>upload/<?php echo $subdata['feed']; ?>) no-repeat;background-size:cover;background-position:left center;">
									
									
								</div>
								<?php
								
							}
						}
					} 
					
					?>
					
				</div>

			</div>
			
			<div class="left-top">
				<a href="http://scenekey.com"><img src="<?php echo base_url();?>slider_assets/include/img/app-logo.png" alt=""/></a>    
			</div>

		</div>
	</div>
	<div id="backtonormalsceen" class="close-x"><span>X</span></div>
<script src="<?php echo base_url(); ?>js/fullscreen.js"> </script>
	<script src="<?php echo base_url(); ?>slider_assets/include/js/owl.carousel.js"></script>
	
	
	<script type="text/javascript">


	var speed = 15000;
	var single=false;
	var timeout = null;

$(document).on('mousemove', function() {
    if (timeout !== null) {
			$('.close-x').css({"background": "#1f9796"});
        clearTimeout(timeout);
    }

    timeout = setTimeout(function() {
			$('.close-x').css({"background": "#fff"});
    }, 1000);
});
	<?php //if(isset($eventCheck)) : ?>
		//speed = false;
	<?php //endif; ?>
	 var venue_id = '<?php echo $images[0]['venue_id'] ?>';
	$(document).ready(function() {
		<?php  if(!isset($images[0]['type'])){
			?>
			         setTimeout("getStatus("+venue_id+",1)",13000);

		<?php }?>
				var single=true;

		var owl = $("#owl-demo");
		owl.owlCarousel({
			autoPlay:speed,
			navigation : true,
			singleItem : true,
			pagination:	true,
			//stopOnHover : true,
			transitionStyle : "fadeUp",
	   afterMove : function(){
		   
        if(this.currentItem === this.maximumItem){
         setTimeout("getStatus("+venue_id+",1)",13000);
        }
      }
		});
	

		var owluser = $("#owl-user1");
		owluser.owlCarousel({
			autoPlay:speed,
			navigation : false,
			singleItem :true,
			pagination:	false,
			// stopOnHover : true,
			transitionStyle : "backSlide"
		});


		<?php if($imgCount > $prevCount):?>
		
		owl.data('owlCarousel').goTo(<?php echo $imgCount; ?>); 
		owluser.data('owlCarousel').goTo(<?php echo $imgCount; ?>); 

		<?php endif;?>
		//#1f9796
		
		//$("body").mousemove(function(e){
		$( "html" ).mouseover(function( event ) {
			//$('.close-x').css({"background": "#1f9796"});
		});
		
		$('html').mouseleave(function() {
			//$('.close-x').css({"background": "#fff"});
		})
	
		$("#backtonormalsceen").click( function(){
			//goBackToVenue();
			 location.reload(); 
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
			var url = "<?php echo base_url();?>index.php/home/deleteFile?name=<?php echo $file;?>";
			$.get(url, function(data) {
				
				
				
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
				
				
				
			});
			
	}
	
	</script>
	<script src="<?php echo base_url(); ?>slider_assets/include/js/bootstrap.min.js"></script>

