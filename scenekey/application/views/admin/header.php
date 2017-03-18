<?php /*
if(empty($this->session->userdata('adminId'))) 
{  
	redirect(base_url('admin'));
} */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- start: Meta -->
<meta charset="utf-8">
<title>ADMIN</title>
<meta name="description" content="Bootstrap Metro Dashboard">
<meta name="author" content="Dennis Ji">
<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<!-- end: Meta -->
<!-- start: Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- end: Mobile Specific -->
<!-- start: CSS -->
<link id="bootstrap-style" href="<?php echo base_url(); ?>adminMediaStyle/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>adminMediaStyle/css/bootstrap-responsive.min.css" rel="stylesheet">
<link id="base-style" href="<?php echo base_url(); ?>adminMediaStyle/css/style.css" rel="stylesheet">
<link id="base-style-responsive" href="<?php echo base_url(); ?>adminMediaStyle/css/style-responsive.css" rel="stylesheet">
<link id="base-style-responsive" href="<?php echo base_url(); ?>adminMediaStyle/css/custom_extra.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
<!-- end: CSS -->

<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
<!-- start: Favicon -->
<!--<link rel="shortcut icon" href="<?php //echo base_url(); ?>adminMediaStyle/img/favicon.ico">-->
<link rel="shortcut icon" href="<?php echo base_url('meadiaStyle/assets/ico/favicon.ico'); ?>" type="image/x-icon">

<link rel="stylesheet" href="<?php echo base_url(); ?>adminMediaStyle/css/parsley_validation.css" >
<script src="<?php echo base_url() ?>adminMediaStyle/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url() ?>adminMediaStyle/js/parsley.js"></script>
<!-- end: Favicon -->
</head>
<body>
<!-- start: Header -->
<div class="navbar">
  <div class="navbar-inner">
    <div class="container-fluid"> 
    	<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse"> 
        	<span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
        </a> 
        <a class="brand" href="<?php echo base_url('admin/administration/home');?>"><span>Admin</span></a> 
      <!-- start: Header Menu -->
      <div class="nav-no-collapse header-nav">
        <ul class="nav pull-right">
          <!-- start: User Dropdown -->
          <li class="dropdown"> <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <i class="halflings-icon white user"></i> <?php echo $this->session->userdata('adminName').' ('.$this->session->userdata('userType').')'; ?> <span class="caret"></span> </a>
            <ul class="dropdown-menu">
              <li> <a href="<?php echo base_url();?>admin/administration/viewAdminUsersDetail/<?php echo $this->cm->idEncrypt($this->session->userdata('adminId')); ?>"> <i class="halflings-icon user"></i> Profile </a> </li>
              <li> <a href="<?php echo base_url();?>admin/administration/updateAdminUsersDetail/<?php echo $this->cm->idEncrypt($this->session->userdata('adminId')); ?>/?type=1"> <i class="halflings-icon wrench"></i> Setting </a> </li>
              <li> <a href="<?php echo base_url();?>admin/administration/logout"> <i class="halflings-icon off"></i> Logout </a> </li>
            </ul>
          </li>
          <!-- end: User Dropdown -->
        </ul>
      </div>
      <!-- end: Header Menu --> 
    </div>
  </div>
</div>
<!-- start: Header --> 

