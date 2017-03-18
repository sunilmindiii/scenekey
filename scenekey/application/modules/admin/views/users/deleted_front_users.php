<div id="content" class="span10">

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>index.php/administration/home">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Deleted Users</a></li>
    </ul>

    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon star"></i><span class="break"></span>All Deleted Users</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>User Type</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>From</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        if (!empty($this->data['allDeletedFrontUsers'])) {
                            $i = 1;
                            foreach ($this->data['allDeletedFrontUsers'] as $row) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $row->user_first_name.' '.$row->user_last_name; ?></td>
                                    <td class="center">
                                        <?php if($row->user_image == ''){?>
                                        <img src="<?php echo base_url(); ?>adminMediaStyle/img/avatar.jpg" height="50" width="50">
                                        <?php }else{?>
                                        <img src="<?php echo base_url(); ?>adminMediaStyle/images/frontUsers/<?php echo $row->user_image; ?>" height="50" width="50">
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $row->utype_name; ?></td>
                                    <td><?php echo $row->user_email; ?></td>
                                    <td><?php echo $row->user_contact; ?></td>
                                    <td class="center"><?php echo $row->city_name.', '.$row->state_name.', '.$row->country_Name;?></td>
                                    <td class="center" id="td<?php echo $i;?>">
                                        <?php
                                        if ($row->user_status == '1') {
                                            $status = "Active";
                                            ?>
                                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->user_id); ?>', '<?php echo $row->user_status; ?>', '<?php echo $i; ?>','user')"><span class="label label-success"><?php echo $status; ?></span></a>
                                            <?php
                                        } elseif ($row->user_status == '0') {
                                            $status = "Inactive";
                                            ?>
                                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->user_id); ?>', '<?php echo $row->user_status; ?>', '<?php echo $i; ?>','user')"><span class="label label-error"><?php echo $status; ?></span></a>
                                            <?php
                                        } elseif ($row->user_status == '-1') {
                                            $status = "Deleted";
                                            ?>
                                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->user_id); ?>', '<?php echo $row->user_status; ?>', '<?php echo $i; ?>','user')"><span class="label label-error"><?php echo $status; ?></span></a>
                                        <?php } ?>
                                    </td>
                                    <td class="center">
                                        <a class="btn btn-success" href="<?php echo base_url(); ?>admin/frontusers/viewIndividualUserFullDetail/<?php echo $this->cm->idEncrypt($row->user_id); ?>">
                                            <i class="halflings-icon white zoom-in" title="Full Detail"></i> 
                                        </a>
                                        <a class="btn btn-danger" href="javascript:void(0)" onclick="dataDelete('<?php echo base64_encode($this->cm->idEncrypt($row->user_id).',user'); ?>')">
                                            <i class="halflings-icon white trash" title="Delete Permanent"></i> 
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>            
            </div>
        </div><!--/span-->

    </div><!--/row-->

</div><!--/.fluid-container-->
<?php $this->load->view('admin/changeStatus'); ?>