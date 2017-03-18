<div id="content" class="span10">

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>index.php/admin/administration/home">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="<?php echo base_url(); ?>admin/propertysettings/allSaleProperties">All Artists</a></li>
    </ul>

    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon star"></i><span class="break"></span>All Artists</h2>
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
                        </tr>
                    </thead>   
                    <tbody>
                        <?php //print_r($this->data['artists']); die();
                        if ($this->data['artists']) {
                            $i = 1;
                            foreach ($this->data['artists'] as $row) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $row->artist_name; ?></td>
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
