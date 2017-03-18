
<!DOCTYPE HTML>
<html>
	<head>
		<title>Scenekey</title>
		
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-blue.min.css">
		<link href='<?php echo base_url(); ?>assets/css/style.css' rel='stylesheet' type='text/css' media="all"/>
		<link href='<?php echo base_url(); ?>assets/css/main.css' rel='stylesheet' type='text/css' media="all"/>

		<link href='<?php echo base_url(); ?>assets/css/font-awesome.css' rel='stylesheet' type='text/css' media="all"/>
		<link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?php echo base_url(); ?>assets/image/fav.png" rel="icon">

	
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!--all city icon link-->
		<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- end city icon -->		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<script src="<?php echo base_url(); ?>slider_assets/include/js/jquery-1.11.3.js"></script>
				<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/move-top.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/easing.js"></script>
		
	
	</head>
	 <body onload="document.refresh();"> 
	<style>.logo_text {
    color: #fff;
    float: right;
    font-family: cursive;
    padding: 11px;
}</style>	
	<!---start-wrap---->
		<!---start-header---->
		<div class="header">
			<div class="wrap">
				<div class="logo">
					<a href="http://scenekey.com"><img src="<?php echo base_url(); ?>assets/image/logo.png"></a><h4 class="logo_text">For Event Hosts</h4>
				</div>
				<div class="top-nav">
					<ul>
						<?php if(!$this->session->userdata('email')){ ?>

							<li class="active"><a href="<?php echo base_url(); ?>index.php/home/venuelogin" class="
								scroll">Login </a></li>
						<?php }else{?>
							<li class="active"><a href="<?php echo base_url(); ?>index.php/home/logout" class="scroll">Logout</a></li>
						<?php }?>

							<!--<li class="active"><a href="#about" class="scroll">How It Works</a></li>-->
							<!-- <li class="active"><a href="#Join" class="scroll">Join the Experience</a></li> -->
							<!--<li class="active"><a href="#contact" class="scroll">Contact</a></li>-->
					</ul>
				</div>
				
			</div>
		<!---//End-header---->
		</div>
<script>
$(window).bind("pageshow", function(event) {
if (event.originalEvent.persisted) {
location.reload(); 
//window.history.back();
		}
});
</script>