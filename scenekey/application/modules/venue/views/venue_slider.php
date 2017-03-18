<html>
<head>

<!-- //for-mobile-apps -->
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
<!-- js -->
<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
</head>
<body onload="javscript:toggleFullScreen()">
<style>
body {
    background: #000;
}
.pull-right {
    color: black;
}
.slider-venue{
height:100% !important}
</style>

<script src="<?php echo base_url(); ?>js/fullscreen.js"> </script>

	<div class="banner-bottom" style="padding:0px;">
		
        <div class="container">
        <div style="" class="slider-venue">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="position:relative">
        	
  <!-- Indicators -->
  <!-- Wrapper for slides -->
  <a href="<?php echo base_url()."index.php/venue?venue_city=".$city; ?>" class="pull-right">X</a> 
  <a href="javascript:void(0);" id="fullscren" onclick="toggleFullScreen()">Full screen ON/OFF</a>   
  <div style="width:70%; margin:auto">

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="position:relative">
      	
  <!-- Indicators -->
  <!-- Wrapper for slides -->
  <div class="carousel-inner white_text minheight" id="inner_slider_div" role="listbox" style="margin-top:10px;">
   <?php if(!empty($next_event_time)){ echo $next_event_time; }?>
  <?php $i=1;
  foreach($images as $subdata){
  if($i==1){
	  if($subdata['type']=='Comment'){
		echo '<div class="item text active">'.$subdata['feed'].'</div>';  
	  }
	  else{
	echo '<div class="item active"><img src="http://209.208.79.95/~scenkey/screenkey/upload/'.$subdata['feed'].'" alt="..." class="rerere"></div>';  	  
	  }
  }else{
	  	 
	if($subdata['type']=='Comment')
		{
				echo '<div class="item text">'.$subdata['feed'].'</div>';
  
	    }
   else 
       {
        echo '<div class="item"><img src="http://209.208.79.95/~scenkey/screenkey/upload/'.$subdata['feed'].'" alt="..." class="rerere"></div>';
       }
	
	}$i++;
			}
  ?>
  </div>
</div>
<div class="position_fix3">
         <div class="text-center">
            <div class="text-center">             
            <p><a href=""><img src="<?php echo base_url()."images/a1.jpg";?>" style="width:80px"></a></p>
            <p style="color:#fff">Playhouse Channel</p>
            </div>
    	</div>
</div> 


<div class="position_fix4">
         <div class="text-center">
            <div class="text-center">             
            <p><a href=""><img src="<?php echo base_url()."images/a1.jpg";?>" style="width:80px"></a></p>
            <p style="color:#fff">Playhouse Channel</p>
            </div>
    	</div>
</div> 


<div class="position_fix1">

         <div class="text-center">
            <div class="text-center">             
            <p><a href=""><img src="<?php echo base_url()."images/app_logo.png";?>" style="width:100px"></a></p><br>
            <p><a href=""><img src="<?php echo base_url()."images/app.png";?>" style="width:120px"></a></p>
            </div>
    	</div>
</div> 

<div class="position_fix2">

         <div class="text-center">
            <div class="text-center">             
            <p><a href=""><img src="<?php echo base_url()."images/app_logo.png";?>" style="width:100px"></a></p><br>
            <p><a href=""><img src="<?php echo base_url()."images/app.png";?>" style="width:120px"></a></p>
            </div>
    	</div>
</div> 
</div>
<!-- //banner-bottom -->
<script src="<?php echo base_url(); ?>js/bootstrap.js"> </script>
<script>
jQuery(document).ready(function($) {
	//jQuery("#fullscren").trigger('click');

	
  jQuery('#carousel-example-generic').carousel({  pause: false,  interval: 10000});
  jQuery("#fullscren").on("click",function(){
	  	//jQuery("#fullscren").hide();	
		setTimeout(function(){
	  	jQuery("#fullscren").hide();
}, 1000);

   });

  
});

jQuery.addEventListener('keydown', function(e) {
  if (e.keyCode == 13 || e.keyCode == 70) { // F or Enter key
    toggleFullScreen();
	jQuery("#fullscren").show();

  }
}, false);
/*
jQuery(document).keyup(function(e) {
  if (e.keyCode == 27) {
	  jQuery("#fullscren").toggle();}
  // esc
});
*/
</script>
</body></html>