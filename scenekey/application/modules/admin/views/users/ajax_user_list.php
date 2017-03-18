<?php  if ($users) { ?>
<table class="table table-striped table-bordered bootstrap-datatable datatables">
    <thead>
        <tr>
            <th><input type="checkbox" id="select_all" onclick="select_all_checkbox(this)" /></th>
            <th>S. No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>   
    <tbody>
        <?php 
		
        
            $i = $startFrom;
            foreach ($users as $row) {
                ?>
                <tr>
					<td><input type="checkbox" class="selectMe" value="<?php echo $row->userEmail; ?>" /></td>
					<td><?php echo $i; ?></td>
                    <td class="center"><?php if(!empty($row->fullname)) echo $row->fullname; else echo "<i>User's name not found</i>"; ?></td>
                    <td class="center"><?php echo $row->userEmail; ?></td>
					<td class="center">
						<a class="btn" href="<?php echo base_url()."index.php/admin/administration/vanues_details/".$this->cm->idEncrypt($row->userid); ?>">
						<?php 
							if(!empty($row->userImage)){ 
								echo '<img src="'.base_url().'upload/'.$row->userImage.'" height="100" width="100" />';
							}else{
								echo '<img src="'.base_url().'adminMediaStyle/img/no-image.jpg" height="100" width="100" />';
							}
						?>
						</a>
					
					</td>
                    <td class="center"  id="td<?php echo $i; ?>">
                        <?php
                        if ($row->userStatus == '1') {
                            $status = "Active";
                            ?>
                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->userid); ?>', '<?php echo $row->userStatus; ?>', '<?php echo $i; ?>', 'venue')"><span class="label label-success"><?php echo $status; ?></span></a>
                            <?php
                        } elseif ($row->userStatus == '0') {
                            $status = "Inactive";
                            ?>
                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->userid); ?>', '<?php echo $row->userStatus; ?>', '<?php echo $i; ?>', 'venue')"><span class="label label-error"><?php echo $status; ?></span></a>
                            <?php
                        } ?>
                    </td>
                    <td class="center" id="td<?php echo $i; ?>">
                        <a class="btn btn-success" href="<?php echo base_url()."index.php/admin/administration/vanues_details/".$this->cm->idEncrypt($row->userid); ?>">
                            <i class="halflings-icon white zoom-in" title="Full Detail"></i>  
                        </a>
                        <a class="btn btn-info" href="<?php echo base_url(); ?>">
                            <i class="halflings-icon white edit" title="Update Detail"></i>  
                        </a>
                        <a class="btn btn-danger" href="javascript:void(0)" onclick="dataDelete('<?php echo base64_encode($this->cm->idEncrypt($row->userid) . ',venue'); ?>')">
                            <i class="halflings-icon white trash" title="Delete"></i> 
                        </a>
                    </td>
                    
                </tr>
                <?php
                $i++;
            }
        
        ?>
    </tbody>
</table>


<button type="submit" class="btn btn-default" onclick="getEmailBox()">Send Email</button>


<?php }else{ echo "No Data Found";}?> 
<div class="span12 center"><div class="dataTables_paginate paging_bootstrap pagination" id="pagination">
			<?php echo $pagination; ?></div></div>