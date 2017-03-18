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
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" parsley-validate>
                    <fieldset>
                      
                        <div class="control-group">
                            <label class="control-label" for="UserTypeSelection">User Role <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <select id="adminUserType" name="userType" label="User Type" parsley-required="true">
                                    <optgroup label="Current Profile Type">
                                        <option value="<?php echo $userRecord->user_type_id; ?>"><?php echo $userRecord->utype_name; ?></option>
                                    <optgroup label="Other Types">
                                        <?php
                                        if (!empty($this->data['fetchAllusertypes'])) {
                                            $i = 1;
                                            foreach ($this->data['fetchAllusertypes'] as $row) {
                                                ?>
                                                <option value="<?php echo $row->utype_id; ?>"><?php echo $row->utype_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="UserFirstName">First Name <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input type="text" name="userFirstName" class="input-xlarge focused" id="focusedInput" parsley-required="true" label="First Name" value="<?php echo $userRecord->user_first_name; ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="UserLastName">Last Name <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input type="text" name="userLastName" class="input-xlarge focused" id="focusedInput" parsley-required="true" label="Last Name" value="<?php echo $userRecord->user_last_name; ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userEmail">Email <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input type="text" name="userEmail" class="input-xlarge focused" id="focusedInput" parsley-required="true" label="Email" value="<?php echo $userRecord->user_email; ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userContactNum">Contact <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userContactNum" value="<?php echo $userRecord->user_contact; ?>" parsley-required="true" label="Contact Number">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userLoginName">User Login Name <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userLoginName" value="<?php echo $userRecord->user_login_name; ?>" parsley-required="true" label="User Name">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userLoginPassword">Password </label>
                            <div class="controls">
                                <a href="<?php echo base_url(); ?>admin/frontusers/ChangePassword/<?php echo $this->cm->idEncrypt($userRecord->user_id);?>/?type=<?php echo $this->cm->idEncrypt(2); ?>" class="btn">Change Password</a>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userImage">User Image</label>
                            <div class="controls">
                                <?php if ($userRecord->user_image == '') { ?>
                                    <img src="<?php echo base_url(); ?>adminMediaStyle/img/avatar.jpg" height="100" width="100">
                                <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>uploads/users/<?php echo $userRecord->user_image; ?>" height="100" width="100">
                                <?php } ?>
                                <a href="<?php echo base_url(); ?>admin/frontusers/ChangeImage/<?php echo $this->cm->idEncrypt($userRecord->user_id);?>/?type=<?php echo $this->cm->idEncrypt(2); ?>" class="btn">Change Image</a>
                            </div>
                        </div> 

                        <div class="control-group">
                            <label class="control-label" for="StatusSelection">Status <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <select id="cityStatus" name="status" parsley-required="true" label="Status">
                                    <optgroup label="Current Status">
                                        <?php
                                        if ($userRecord->user_status == '0') {
                                            echo '<option value="0">Inactive</option>';
                                        } elseif ($userRecord->user_status == '1') {
                                            echo '<option value="1">Active</option>';
                                        } elseif ($userRecord->user_status == '-1') {
                                            echo '<option value="-1">Deleted</option>';
                                        } else {
                                            echo 'Not Define';
                                        }
                                        ?>
                                    <optgroup label="Other Status">
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