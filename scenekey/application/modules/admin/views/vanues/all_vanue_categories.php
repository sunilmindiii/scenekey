<div id="content" class="span10">

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>index.php/admin/administration/home">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="<?php echo base_url(); ?>admin/propertysettings/allSaleProperties">All Venues Categories</a></li>
    </ul>

    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon star"></i><span class="break"></span>All Venues Categories</h2>
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
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        if ($vanuesCategories) {
                            $i = 1;
                            foreach ($vanuesCategories as $row) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $row->category; ?></td>
                                    <td class="center"  id="td<?php echo $i; ?>">
                                        <?php
                                        if ($row->status == '1') {
                                            $status = "Active";
                                            ?>
                                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->category_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'category')"><span class="label label-success"><?php echo $status; ?></span></a>
                                            <?php
                                        } elseif ($row->status == '0') {
                                            $status = "Inactive";
                                            ?>
                                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->category_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'category')"><span class="label label-error"><?php echo $status; ?></span></a>
                                            <?php
                                        } elseif ($row->status == '-1') {
                                            $status = "Deleted";
                                            ?>
                                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->category_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'category')"><span class="label label-error"><?php echo $status; ?></span></a>
                                        <?php } ?>
                                    </td>
                                    <td class="center" id="td<?php echo $i; ?>">
                                        <a class="btn btn-success" href="<?php echo base_url(); ?>">
                                            <i class="halflings-icon white zoom-in" title="Full Detail"></i>  
                                        </a>
                                        <a class="btn btn-info" href="<?php echo base_url(); ?>">
                                            <i class="halflings-icon white edit" title="Update Detail"></i>  
                                        </a>
                                        <a class="btn btn-danger" href="javascript:void(0)" onclick="dataDelete('<?php echo base64_encode($this->cm->idEncrypt($row->category_id) . ',category'); ?>')">
                                            <i class="halflings-icon white trash" title="Delete"></i> 
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>            
            </div>
        </div><!--/span-->

    </div><!--/row-->

</div><!--/.fluid-container-->
