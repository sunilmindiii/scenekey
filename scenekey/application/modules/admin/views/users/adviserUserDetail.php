<!-- start: Content -->
<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>admin/administration/home">Home</a>
            <i class="icon-angle-right"></i> 
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="<?php echo base_url(); ?>admin/frontusers/allAdvisers">All Adviser Users</a>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">User Detail</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>User Full Details</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" parsley-validate>
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="UserTypeSelection"><strong>User Role</strong></label>
                            <div class="controls">
                                <?php echo $userRecord->utype_name; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="UserFirstName"><strong>First Name</strong> </label>
                            <div class="controls">
                                <?php echo $userRecord->user_first_name; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="UserLastName"><strong>Last Name</strong> </label>
                            <div class="controls">
                                <?php echo $userRecord->user_last_name; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userEmail"><strong>Email</strong></label>
                            <div class="controls">
                                <?php echo $userRecord->user_email; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userContactNum"><strong>Contact</strong></label>
                            <div class="controls">
                                <?php echo $userRecord->user_contact; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="CountrySelection"><strong>Country</strong></label>
                            <div class="controls">
                                <?php echo $userRecord->country_Name; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="StateSelection"><strong>State</strong></label>
                            <div class="controls">
                                <?php echo $userRecord->state_name; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="CitySelection"><strong>City</strong></label>
                            <div class="controls">
                                <?php echo $userRecord->city_name; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userLoginName"><strong>User Login Name</strong> </label>
                            <div class="controls">
                                <?php echo $userRecord->user_login_name; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="userImage"><strong>User Image</strong></label>
                            <div class="controls">
                                <?php if ($userRecord->user_image == '') { ?>
                                    <img src="<?php echo base_url(); ?>/adminMediaStyle/img/avatar.jpg" height="100" width="100">
                                <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>/adminMediaStyle/images/admins/<?php echo $userRecord->user_image; ?>" height="100" width="100">
                                <?php } ?>
                            </div>
                        </div> 

                        <div class="control-group">
                            <label class="control-label" for="StatusSelection"><strong>Status</strong> </label>
                            <div class="controls">
                                <?php
                                if ($userRecord->user_status == '0') {
                                    echo 'Inactive';
                                } elseif ($userRecord->user_status == '1') {
                                    echo 'Active';
                                } elseif ($userRecord->user_status == '-1') {
                                    echo 'Deleted';
                                } else {
                                    echo 'Not Define';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="<?php echo base_url(); ?>admin/frontusers/allIndividuals" class="btn">
                                Back
                            </a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!--/span-->

    </div><!--/row-->

</div><!--/.fluid-container-->