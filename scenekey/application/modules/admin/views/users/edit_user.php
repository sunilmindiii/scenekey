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
            <a href="<?php echo base_url(); ?>admin/frontusers/allIndividuals">All Individual Users</a>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Edit/Update Profile Form</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit/Update Profile</h2>
                
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" parsley-validate enctype="multipart/form-data" >
                    <fieldset>
                      
                        <div class="control-group">
                            <label class="control-label" for="UserTypeSelection">User Type <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <select id="adminUserType" name="userType" label="User Type" parsley-required="true">
                                    <option>Performer</option>
                                    <option>Social User</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="UserFirstName">Full Name <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input type="text" name="userFirstName" class="input-xlarge focused" id="focusedInput" parsley-required="true" label="First Name" value="<?php if(isset($userRecord->fullname)) echo $userRecord->fullname; ?>" />
                            </div>
                        </div>
                        

                        <div class="control-group">
                            <label class="control-label" for="userEmail">Email <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input type="text" name="userEmail" class="input-xlarge focused" id="focusedInput" parsley-required="true" label="Email" value="<?php if(isset($userRecord->userEmail)) echo $userRecord->userEmail; ?>" />
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="userImage">User Image</label>
                            <div class="controls">
                                <?php if (isset($userRecord->userImage)) { ?>
                                    <img src="<?php echo base_url(); ?>uploads/users/<?php echo $userRecord->userImage; ?>" height="100" width="100">
                                <?php } ?>
								<input type="file" name="userImage" id="userImage" />
								
                                <!--<a href="<?php echo base_url(); ?>admin/frontusers/ChangeImage/<?php echo $this->cm->idEncrypt($userRecord->user_id);?>/?type=<?php echo $this->cm->idEncrypt(2); ?>" class="btn">Change Image</a>-->
                            </div>
                        </div> 

                        <div class="control-group">
                            <label class="control-label" for="StatusSelection">Status <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <select id="cityStatus" name="status" parsley-required="true" label="Status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                </select>
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