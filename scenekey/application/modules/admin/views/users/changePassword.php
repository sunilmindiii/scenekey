<?php
if (isset($_GET['success'])) {
    echo '<script> alert("User added sucessfully!");</script>';
} else if (isset($_GET['error'])) {
    echo '<script> alert("Try Again!");</script>';
}
?>
<!-- start: Content -->
<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>index.php/administration/home">Home</a>
            <i class="icon-angle-right"></i> 
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Change Password</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Change Password</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" id="changePassword" name="changePassword" method="post" parsley-validate>
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="userLoginPassword">Password <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput1" type="password" name="userLoginPassword" parsley-required="true" label="Password">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userConfirmPassword">Confirm Password <span class="required-field-color">*</span></label>					<div class="controls">
                                <input class="input-xlarge focused" id="focusedInput2" type="password" name="userConfirmPassword" parsley-required="true" label="Confirom Password">
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="submit" name="submit" class="btn btn-primary" value="Save" />
                            <button class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!--/span-->

    </div><!--/row-->

</div><!--/.fluid-container-->
