<?php  if ($performer) { ?>
<table class="table table-striped table-bordered bootstrap-datatable datatables">
    <thead>
        <tr>
            <th>S. No.</th>
            <th>Name</th>
        </tr>
    </thead>   
    <tbody>
        <?php 
		
        
            $i = 1;
            foreach ($performer as $row) {
                ?>
                <tr>
					<td><?php echo $i; ?></td>
                    <td class="center"><?php if(!empty($row->artist_name)) echo $row->artist_name; else echo "<i>User's name not found</i>"; ?></td>
                    
                    <!--<td class="center" id="td<?php echo $i; ?>">
                        <a class="btn btn-success" href="<?php echo base_url()."index.php/admin/administration/vanues_details/".$this->cm->idEncrypt($row->userid); ?>">
                            <i class="halflings-icon white zoom-in" title="Full Detail"></i>  
                        </a>
                        <a class="btn btn-info" href="<?php echo base_url(); ?>">
                            <i class="halflings-icon white edit" title="Update Detail"></i>  
                        </a>
                        <a class="btn btn-danger" href="javascript:void(0)" onclick="dataDelete('<?php echo base64_encode($this->cm->idEncrypt($row->userid) . ',venue'); ?>')">
                            <i class="halflings-icon white trash" title="Delete"></i> 
                        </a>
                    </td>-->
                    
                </tr>
                <?php
                $i++;
            }
        
        ?>
    </tbody>
</table>
<?php }else{ echo "No Data Found";}?> 
<div class="span12 center"><div class="dataTables_paginate paging_bootstrap pagination" id="pagination">
			<?php echo $pagination; ?></div></div>