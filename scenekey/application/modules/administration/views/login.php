<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- start: Meta -->
        <meta charset="utf-8">
        <title>Admin Login</title>
        <meta name="description" content="#">
        <meta name="author" content="#">
        <meta name="keyword" content="#">
        <!-- end: Meta -->
        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->

        <!-- start: CSS -->
        <link id="bootstrap-style" href="<?php echo base_url(); ?>adminMedia/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>adminMedia/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="<?php echo base_url(); ?>adminMedia/css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="<?php echo base_url(); ?>adminMedia/css/style-responsive.css" rel="stylesheet">
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
        <link rel="shortcut icon" href="<?php echo base_url(); ?>adminMedia/img/favicon.ico">
        <!-- end: Favicon -->
        
        <link rel="stylesheet" href="<?php echo base_url();?>adminMedia/css/parsley_validation.css" >
        <script src="<?php echo base_url()?>adminMedia/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo base_url()?>adminMedia/js/parsley.js"></script>

        <style type="text/css">
            body { background: url(<?php echo base_url(); ?>adminMedia/img/bg-login.jpg) !important; }
        </style>
    </head>
    <body>
        <div class="container-fluid-full">
            <div class="row-fluid">

                <div class="row-fluid">
                    <div class="login-box">
                      <!--  <div class="icons">
                            <a href="<?php //echo base_url('admin/administration/home'); ?>"><i class="halflings-icon home"></i></a>
                            <a href="#"><i class="halflings-icon cog"></i></a>
                        </div> -->
                        <h2>Login to your account</h2>
                        <form class="form-horizontal" method="post" name="loginForm" parsley-validate>
                            <fieldset>

                                <div class="input-prepend" title="Username">
                                    <span class="add-on"><i class="halflings-icon user"></i></span>
                                    <input name="username" id="username" type="text" class="input-large span10" placeholder="type username" parsley-required="true" label="Your Profile Email/Username"/>
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend" title="Password">
                                    <span class="add-on"><i class="halflings-icon lock"></i></span>
                                    <input name="password" id="password" type="password" class="input-large span10" placeholder="type password" parsley-required="true" label="Your Profile Login Password"/>
                                </div>
                                <div class="clearfix"></div>

                                <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>

                                <div class="button-login">	
                                    <input type="submit" class="btn btn-primary" name="submit" value="Login"/>
                                </div> <a href="<?php echo base_url('admin/administration/dashboard'); ?>">HOME VIEW</a>
                                <div class="clearfix"></div>
                        </form>
                        <hr>
                        <h3>Forgot Password?</h3>
                        <p>
                            No problem, <a href="<?php echo base_url('admin/administration/forgetPassword'); ?>">click here</a> to get a new password.
                        </p>	
                    </div><!--/span-->
                </div><!--/row-->

            </div><!--/.fluid-container-->

        </div><!--/fluid-row-->

        <!-- start: JavaScript-->

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery-1.9.1.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery-migrate-1.0.0.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery-ui-1.10.0.custom.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.ui.touch-punch.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/modernizr.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.cookie.js"></script>

        <script src='<?php echo base_url(); ?>adminMediaStyle/js/fullcalendar.min.js'></script>

        <script src='<?php echo base_url(); ?>adminMediaStyle/js/jquery.dataTables.min.js'></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/excanvas.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.flot.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.flot.pie.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.flot.stack.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.flot.resize.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.chosen.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.uniform.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.cleditor.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.noty.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.elfinder.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.raty.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.iphone.toggle.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.uploadify-3.1.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.gritter.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.imagesloaded.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.masonry.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.knob.modified.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.sparkline.min.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/counter.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/retina.js"></script>

        <script src="<?php echo base_url(); ?>adminMediaStyle/js/custom.js"></script>
        <!-- end: JavaScript-->

    </body>
</html>