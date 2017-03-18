<?php
if (isset($_GET['success'])) {
    echo '<script> alert("User added sucessfully!");</script>';
} else if (isset($_GET['error'])) {
    echo '<script> alert("Try Again!");</script>';
}
?>
<!-- Check Email registered on Not Start -->
<script type="text/javascript" src="<?php echo base_url() ?>adminMediaStyle/customJS/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#adminUserType").change(function(){
        $(this).find("option:selected").each(function(){
            /* if($(this).attr("value")>="4" && $(this).attr("value")<="6"){   // It can be also like.*/
            if($(this).attr("value")=="4" || $(this).attr("value")=="5" || $(this).attr("value")=="6"){
                $("#otherDetails,#extraAddFields").show();
            }
            else{
                $("#otherDetails").hide();
            }
        });
    }).change();
});
</script>
<script>
    jQuery(document).ready(function () {

        jQuery("#userEmailRegistration").keyup(function () {
            var a = jQuery(this).val();
            var b = jQuery('#adminUserType: option:selected').val();
            jQuery.ajax({
                url: "process/check_email.php",
                type: "POST",
                data: {email: a, utype: b},
                async: true}).done(function (data) {
                if (data == 0)
                {
                    jQuery(isEmailExists).text("Email already used !!!");
                    InputEmail.value = "";
                }
                else
                {
                    jQuery(isEmailExists).text("");
                }
            });
        });
    });
</script>
<!-- Check Email registered on Not Start -->
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
            <a href="#">New User Registration Form</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>New User Registration</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" parsley-validate>
                    <fieldset>
                        <!-- There is Four profile types of front end users and each has different Permission and 
                                authorities according to the the profile type. 
                            User Profile Types :
                             
                             * Individual    = An individual user can create profile for uploading his property details.
                             * Builder       = Builder can register and after registration he/she can upload his project/Property details.
                             * Broker        = Broker can register and after registration he/she can upload Property details.
                             * Adviser       = Adviser will work as part of eperty site and he/she will provide legal advice to the Users on Behalf of eperty. 
                        -->
                        <h2>Personal Details</h2>
                        <div class="control-group">
                            <label class="control-label" for="UserTypeSelection">User Role<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <select id="adminUserType" name="userType" label="User Type" parsley-required="true">
                                    <option value="">Select</option>
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
                                <input type="text" name="userFirstName" class="input-xlarge focused" id="focusedInput" parsley-required="true" label="First Name">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="UserLastName">Last Name <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input type="text" name="userLastName" class="input-xlarge focused" id="focusedInput" parsley-required="true" label="Last Name">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userEmail">Email <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input type="text" name="userEmail" class="input-xlarge focused" id="userEmailRegistration" parsley-required="true" label="Email">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userContactNum">Contact <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userContactNum" parsley-required="true" label="Contact Number">
                            </div>
                        </div>
                        <div id="otherDetails" style="display: none;">
                        <div class="control-group">
                            <label class="control-label" for="aboutUser">About User <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <textarea class="input-xlarge focused" id="focusedInput" name="aboutUser" ></textarea>
                            </div>
                        </div>
                            
                        <div class="control-group">
                            <label class="control-label" for="userSite">User Organisation </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge focused" id="focusedInput" name="userOrganisation" />
                            </div>
                        </div>
                            
                        <div class="control-group">
                            <label class="control-label" for="userSite">User Designation </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge focused" id="focusedInput" name="userDesignation" />
                            </div>
                        </div>
                            
                        <div class="control-group">
                            <label class="control-label" for="userSite">User Website/Blog Link </label>
                            <div class="controls">
                                <input type="url" class="input-xlarge focused" id="focusedInput" name="userSite" />
                            </div>
                        </div>
                        </div>
                        <h2>Location Details</h2>
                        <!-- include location page Start -->
                        <?php $this->load->view('locations/countryStateCity'); ?>

                        <div class="control-group">
                            <label class="control-label" for="CountrySelection">Country<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <select id="country" name="country" parsley-required="true" label="Country">
                                    <option value="">Select</option>
                                    <?php
                                    if (!empty($this->data['countries'])) {
                                        foreach ($this->data['countries'] as $row) {
                                            ?>
                                            <option value="<?php echo $row->country_id; ?>"><?php echo $row->country_Name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="StateSelection">State<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <select id="state" name="state" parsley-required="true" label="State Name">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="CitySelection">City<span class="required-field-color">*</span></label>
                            <div class="controls">
                                <select id="city" name="city" parsley-required="true" label="City Name">
                                    <option value="">Select</option>

                                </select>
                            </div>
                        </div>

                        <!-- include location page End -->
                        <div id="extraAddFields" style="display: none;">
                         <div class="control-group">
                            <label class="control-label" for="userAddress">User Address </label>
                            <div class="controls">
                                <textarea class="input-xlarge focused" id="focusedInput" name="userAddress" ></textarea>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="userAddressZIP">Postal Code/ZIP </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge focused" id="focusedInput" name="userAddressZIP" /></textarea>
                            </div>
                        </div>
                        </div>
                        <h2>Login Details</h2>
                        <div class="control-group">
                            <label class="control-label" for="userLoginName">User Login Name <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="text" name="userLoginName" parsley-required="true" label="User Name">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userLoginPassword">Password <span class="required-field-color">*</span></label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="password" name="userLoginPassword" parsley-required="true" label="Password">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userConfirmPassword">Confirm Password <span class="required-field-color">*</span></label>					<div class="controls">
                                <input class="input-xlarge focused" id="focusedInput" type="password" name="userConfirmPassword" parsley-required="true" label="Confirom Password">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userImage">User Image</label>
                            <div class="controls">
                                <input class="input-file uniform_on" id="fileInput" type="file" name="userImage" accept="image/*" parsley-required="true" label="User Image">
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