<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Scenkey</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>slider_assets/include/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>slider_assets/include/css/normalize.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/fonts/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.theme.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>slider_assets/include/css/owl.transitions.css">
</head>

<body>
	
	

	<div id="ajaxContents" style="background-color:#fff;"> </div>
	
	
	<script src="<?php echo base_url(); ?>slider_assets/include/js/jquery-1.11.3.js"></script>
	<script src="<?php echo base_url(); ?>slider_assets/include/js/owl.carousel.js"></script>
	<script src="<?php echo base_url(); ?>slider_assets/include/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>js/fullscreen.js"> </script>
	

	<script type="text/javascript">
	$(document).ready(function() {
	  var owl = $("#owl-demo, #owl-user");
	  owl.owlCarousel({
		autoPlay:3000,
		navigation : false,
		singleItem : true,
		pagination:	false,
		transitionStyle : "fade"
	  });
	 
	});
	
	</script>
	<script type="text/javascript">
	//getStatus();
	function getStatus() {
		//var url = '<?php echo urldecode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>';
		var url = '<?php echo base_url();?>index.php/venue/test?id=43380';
		$.post(url, function(data) {
			$('div#ajaxContents').html(data);
		});
		//setTimeout("getStatus()",5000);
	}
	</script>

</body>
</html>
