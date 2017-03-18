<style type="text/css">
    body {
    font-family: "Montserrat",sans-serif !important;
    font-size: 100%;
    }
.captn h4 {
    font-size: 1.4em  !important;
}
</style>
<div class="light_blue">
    <div class="page1">
   
		<div class="container">

			<div class="banner-bottom">
        <div class="container min-h">
			<div class="banner-bottom-grids">
			
						<div class="col-md-2 banner-bottom-grid">
								<a href="#">
									<?php 
									if(isset($records[0]->cityimage) && !empty($records[0]->cityimage)){?>
									<img class="img-responsive" src="<?php echo "http://69.28.75.158/scenekey/images/city/".$records[0]->cityimage; ?>" alt="<?php echo str_replace('%20',' ',$this->uri->segment(3)); ?>">
	
									<?php } else {?>
									<img class="img-responsive" src="<?php echo base_url()."assets/images/default_venue.png"; ?>" alt="<?php echo str_replace('%20',' ',$this->uri->segment(3)); ?>">
									<?php } ?>
									<div class="captn">
										<?php echo str_replace('%20',' ',$this->uri->segment(3)) ?>
									</div>
								</a>
							</div>
                    <?php if($records){?>
						<h2 class="text-center" style="clear:both;font-size: 45px;"><b><div style="text-transform: uppercase; font-size: 36px;">Launch your channel</div>
                        </b></h2>

						<?php foreach ($records as $venue){ ?>
						      <?php $href = base_url()."index.php/home/venuelogin/"; 
                            if(($this->session->userdata('email'))){
                                $href = base_url()."index.php/home/show_venue/". $venue->venue_id; 
                            } ?>

							<div class="col-md-4 banner-bottom-grid">
				<div class="dslider_show" onclick="getStatus('<?php echo $venue->venue_id; ?>')">

								<a href="javascript:void(0)">
							    <?php if (empty($venue->venue_image)) {?>
                                   <img class="img-responsive venue_view" src="<?php echo base_url(); ?>assets/image/default_venue.png">
                                <?php }else{?> 
                                    <img class="img-responsive venue_view" src="http://69.28.75.158/scenekey/images/venue/<?php echo $venue->venue_image ?>">
                                <?php } ?>
									
									<div class="captn">
										<h4><?php echo $venue->venue_name ;?></h4>
									</div>
								</a>
							</div>
														</div>

						<?php }}
						else {
						echo '<h2 class="text-center" style="clear: both; font-size: 40px; padding: 50px;"><b><div style="text-transform: uppercase; font-size: 30px;"> We are sorry, no channel were found.</div>
                        </b></h2>';	
						}
						?>

					</div>

           <!--<div class="  col-md-10 col-sm-offset-1 col-md-offset-1">

                <div class="white_bg_main">
                    <?php $sn=$sn;foreach ($records as $venue) { ?>
                        <div class="box_content">
                            <div class="col-md-2 col-sm-2">
                                <?php if (empty($venue->venue_image)) { ?>
                                   <img class="img-responsive" src="<?php echo base_url(); ?>assets/image/default.jpg">
                                <?php }else{?> 
                                    <img class="img-responsive" src="<?php echo base_url(); ?>assets/image/<?php echo $venue->venue_image ?>">
                                <?php } ?>
                                </div>

                            <div class="col-md-10 nopadding">
                                <div class="col-md-1 col-sm-2">
                                    <h3><?php echo $sn; ?>.</h3>
                                </div>
                           
                                <div class="col-md-5 col-sm-5">
                                    <h3><?php echo $venue->venue_name; ?></h3>
                                    <p><i class="fa fa-star"></i><i class="fa fa-star" style="color:gray;"></i><i class="fa fa-star" style="color:gray;"></i><i class="fa fa-star" style="color:gray;"></i><i class="fa fa-star" style="color:gray;"></i> <small> <?php echo $venue->rating_count; ?> Review</small></p>
                                </div>

                                <div class="col-md-3 col-sm-3">
                                    <p><small><?php echo $venue->venue_address; ?></small></p>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <a href="<?php echo base_url()."index.php/home/show_venue/". $venue->venue_id;?>" >
                                    <input type="button" value="View Profile"  />
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php $sn++;} ?>
                    <nav>
                     <p><?php echo $links; ?></p>
                     
                    </nav>
                </div>
            </div>-->
        </div>
							                     <p><?php echo $links; ?></p>

        <br/>
    </div>
</div>
 </div>
</div>
<!-- //banner-bottom -->


 
<div class="loader-container hideLoader" id="show_loader">
	<div class='loader'>
		<div class='loader--dot'></div>
		<div class='loader--dot'></div>
		<div class='loader--dot'></div>
		<div class='loader--dot'></div>
		<div class='loader--dot'></div>
		<div class='loader--dot'></div>
		<div class='loader--text'></div>
	</div>
</div>

<div id="ajaxContents" style="background-color:#fff;"> </div>




<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/loader.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>slider_assets/include/css/main.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/fonts/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.transitions.css">

<script src="<?php echo base_url(); ?>slider_assets/include/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>js/mousestop.js"> </script>
<script src="<?php echo base_url(); ?>slider_assets/include/js/owl.carousel.js"></script>

	<?php 
	$href=0;
	if((!$this->session->userdata('email'))){
             $href = '1';//base_url()."index.php/home/venuelogin/"; 
                   } ?>
<script type="text/javascript">

	//$(window).ready(function(){
		
	

	var refreshImg;

	function getStatus(id) {
		
			var chk_login='<?php echo $href;?>';
		if(chk_login==1){
	  window.location.href = "<?php echo base_url().'index.php/home/venuelogin/' ?>";
		} else {
			 // window.location.href = "<?php   echo base_url();?>index.php/home/venueImage?id="+id;
	
			
		$(".header").hide();
		$(".banner").hide();
		$(".banner-bottom").hide();
		$(".footer").hide();
		$('#show_loader').removeClass("hideLoader");
		$('#show_loader').addClass("showLoader");
		var url = "<?php echo base_url();?>index.php/home/venueImage?id="+id;
		$.post(url, function(data) {
			 $('#show_loader').removeClass("showLoader");
			 $('#show_loader').addClass("hideLoader");
			
		}).done(function(data) {
			

			$('div#ajaxContents').html(data);
	
		  })
		  .fail(function() {
		  })
		  .always(function() {
			  $('#show_loader').removeClass("showLoader");
			  $('#show_loader').addClass("hideLoader");
		});
		
	
		
		var elem = document.body; // Make the body go full screen.
		requestFullScreen(elem);
                
		$("body").css({"background": "#fff url('<?php echo base_url();?>slider_assets/include/img/logo-re.png') repeat scroll 0 0"});
		$("body").css({"height": "100%"});
		$("body").css({"width": "100%"});
		
		refreshImg = setTimeout("getStatus("+id+")",60000);
	}
	
	}
	function requestFullScreen(element) {
			var chk_login='<?php echo $href;?>';
		if(chk_login==1){
	  window.location.href = "<?php echo base_url().'index.php/home/venuelogin/' ?>";
		}else {
		// Supports most browsers and their versions.
		var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullscreen;

		if (requestMethod) { // Native full screen.
			requestMethod.call(element);
		} else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
			var wscript = new ActiveXObject("WScript.Shell");
			if (wscript !== null) {
				wscript.SendKeys("{F11}");
			}
		}
	}
	}
	
	
	//});



</script>


<script type="text/javascript">
var count=1;
$(document).ready(function($){
	$("#loadmore").click(function(){
		var current = $(this);
		$.ajax({
			url: "<?php echo base_url()."index.php/home/loadMore"; ?>", 
			type: "POST",             
			data:{city:'<?php echo $this->input->get('venue_city'); ?>',count:count,limit:2},      
			cache: false,        
			beforeSend: function() {
			    current.html("<div class='inner_div'></div> Load More");
			},               
			success: function(data){
				count++;
				$(".inner_div").remove();
				current.parent().prev().append(data);
			}
		});
	});
	/*$("#close_slider").click(function(){
		$(this).parent().hide();
	});
	$(".slider_show").on("click",function(){
		
		//toggleFullScreen();
		var current = $(this);
		$.ajax({
			url: "<?php echo base_url()."index.php/venue/venueImage"; ?>", 
			type: "POST",             
			data:{id:current.attr('v_id')},      
			cache: false,        
			beforeSend: function() {
				$("#inner_slider_div").html("<div class='slider_inner_div'></div>");
				$(".slider_div").show();
			},               
			success: function(data){
				console.log(data);
				
				if(data=='0'){
					
					$("#inner_slider_div").html("<div class='slider_inner_div' style='color:#fff'>NO image found</div>");
					setTimeout(function(){$(".slider_div").hide();},'2000');
					//
				}else{
					
					$("#inner_slider_div").html(data);
					//sliders();
					$("#inner_slider_div").carousel();
					//$("#inner_slider_div div").eq(0).addClass('active');
					//$('#carousel-example-generic').carousel({  pause: false, interval: 4500});
					
				}
				
			}
		});
	});*/
});
</script>

