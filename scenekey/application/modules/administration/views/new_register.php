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
            <a href="#">User Registration Forms</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>User Registration</h2>
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
                            <label class="control-label" for="UserTypeSelection">User Role</label>
                            <div class="controls">
                                <select id="adminUserType" name="userType">
                                    <option value="">Select</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Assistant</option>
                                    <option value="3">Author</option>
                                    <option value="4">Editor</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="UserFirstName">First Name<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userFirstName" label="First Name" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userLastName">Last Name<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userLastName" label="Last Name" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userEmail">Email<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userEmail" label="Email" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userContactNum">Contact<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userContactNum" label="Contact" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userState">State<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userState" label="State" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userCity">City<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userCity" label="City" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userLoginName">User Login Name<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userLoginName" label="User Name" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userLoginPassword">Password<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="password" name="userLoginPassword" label="Password" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userConfirmPassword">Confirom Password<span class="required-field-color">*</span></label>					<div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="password" name="userConfirmPassword" label="Confirom Password" parsley-required="true">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userImage">User Image</label>
                            <div class="controls">
                                <input class="input-file uniform_on" id="fileInput" type="file" name="userImage" label="User Image" parsley-required="true">
                            </div>
                        </div> 

                        <div class="form-actions">
                            <input type="submit" name="submit" class="btn btn-primary" value="Save changes" />
                            <button class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!--/span-->

    </div><!--/row-->

</div><!--/.fluid-container-->