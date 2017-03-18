<div class="container">
	   <div class="login-box">
      <div class="login-logo">
        <a href=""><b>Venue login</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
     <!--   <p class="login-box-msg">Sign in to start your session</p> -->
       
                <?php if(!empty($error)){?>
                    <div class="alert alert-danger"><?php echo $error; ?> </div>
                <?php } ?>
       
        <form action="" method="post">

          <div class="form-group has-feedback">

            <input type="text" name="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
         
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <button style="line-height: 25px; " type="submit" class="btn btn-primary btn-block   btn-info">Sign In</button>
            </div><!-- /.col --> 
          </div>
          <div class="row">
            <div class="col-xs-6">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
         
            <div class="col-xs-6">
              <span style ="line-height: 45px;"> <a  href="<?php echo base_url(); ?>index.php/home/venue">Create Account</a></span>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
   </div> 