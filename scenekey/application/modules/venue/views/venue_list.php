<div class="banner-bottom">
	<div class="container">
		<div class="vanue_name">
			<h2 class="text-center">Venues</h2>
			<?php $i=11; 
			foreach($venue as $city){ if($i>16){$i=11;}
			?>
				<div class="col-md-4 vanue_name">
					<div class="dslider_show" onclick="getStatus('<?php echo $city->venue_id; ?>')">
					<?php if(!empty($city->venue_image)){ ?>
					<img class="img-responsive" src="<?php echo base_url()."images/venue/".$city->venue_image; ?>" alt="<?php echo $city->venue_name;?>">
					<?php }else{ ?>
						<img class="img-responsive" src="<?php echo base_url()."images/".$i.".jpg"; ?>" alt="<?php echo $city->venue_name;?>">
					<?php } ?>
					<div class="captn">
						<h4><?php echo $city->venue_name;?></h4>
					</div>
					</div>
				</div>
				<?php $i++; } ?>
			<div class="clearfix"> </div>
			<div class="col-md-12" >
				<button type="button" id="loadmore" class="btn btn-primary">Load More</button>
			</div>
		</div>
	</div>
</div>

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

<script type="text/javascript">

	//$(window).ready(function(){
		
	

	var refreshImg;

	function getStatus(id) {
		
		$(".header").hide();
		$(".banner").hide();
		$(".banner-bottom").hide();
		$(".footer").hide();
		$('#show_loader').removeClass("hideLoader");
		$('#show_loader').addClass("showLoader");
		var url = "<?php echo base_url();?>index.php/venue/venueImage?id="+id;
		$.post(url, function(data) {
			// $('#show_loader').removeClass("hideLoader");
			// $('#show_loader').addClass("showLoader");
			//$('#show_loader').addClass("hideLoader");
			//alert('block');
		}).done(function(data) {
			// $('#show_loader').removeClass("hideLoader");
			
			$('div#ajaxContents').html(data);
			
			// $('#show_loader').removeClass("showLoader");
			// $('#show_loader').addClass("hideLoader");
			//alert('none');
			//alert( "second success" );
		  })
		  .fail(function() {
			//alert( "error" );
		  })
		  .always(function() {
			  $('#show_loader').removeClass("showLoader");
			  $('#show_loader').addClass("hideLoader");
			//alert( "finished" );
		});
		
		
		
		/*$.post( "example.php", function() {
		  alert( "success" );
		})
		  .done(function() {
			alert( "second success" );
		  })
		  .fail(function() {
			alert( "error" );
		  })
		  .always(function() {
			alert( "finished" );
		});*/
		
		
		
		
		
		
		var elem = document.body; // Make the body go full screen.
		requestFullScreen(elem);
                
		$("body").css({"background": "#fff url('<?php echo base_url();?>slider_assets/include/img/logo-re.png') repeat scroll 0 0"});
		$("body").css({"height": "100%"});
		$("body").css({"width": "100%"});
		
		refreshImg = setTimeout("getStatus("+id+")",60000);
	}

	function requestFullScreen(element) {
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
	
	
	//});



</script>


<script type="text/javascript">
var count=1;
jQuery(document).ready(function($){
	$("#loadmore").click(function(){
		var current = $(this);
		$.ajax({
			url: "<?php echo base_url()."index.php/venue/loadMore"; ?>", 
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