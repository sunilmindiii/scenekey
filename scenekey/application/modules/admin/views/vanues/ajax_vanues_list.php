<?php  if ($vanues) { ?>
<input type="hidden" id="pageNo" value="<?php echo $page; ?>" />
<table class="table table-striped table-bordered bootstrap-datatable datatables">
    <thead>
        <tr>
            <th>Venue</th>
            <th>Name</th>
            <th>Address</th>
            <th>Added On  <span id="sort_by_date" onclick="sortVenue()" data-sort-by="added_at" class="glyphicon glyphicon-envelope"></span></th>
            <th>Source</th>
            <th>Actions</th>
            <th>Publish</th>
        </tr>
    </thead>   
    <tbody>
        <?php 
		
        
            $i = 1;
            foreach ($vanues as $row) {

                //echo "<pre>";print_r($row);
                ?>
                <tr>
                    <td class="center">
						<a class="btn" href="<?php echo base_url()."index.php/admin/administration/vanues_details/".$this->cm->idEncrypt($row->venue_id); ?>">
						<?php 
							if(!empty($row->venue_image)){ 
								echo '<img src="'.base_url().'images/venue/'.$row->venue_image.'" height="100" width="100" />';
							}else{
								echo '<img src="'.base_url().'/img/defaultvenue.png" height="100" width="100" />';
							}
						?>
						</a>
					
					</td>
                    <td class="center"><?php echo $row->venue_name; ?></td>
                    <td class="center"><?php if($row->venue_address){echo $row->venue_address;}
					    else{
						//echo $row->venue_city.' '.$row->venue_state;
						$lat=$row->venue_lat;
						$lon=$row->venue_long;
   $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".
            $lat.",".$lon."&sensor=false";
   $json = @file_get_contents($url);
   $data = json_decode($json);
   $status = $data->status;
   $address = $row->venue_city.' '.$row->venue_state;
   if($status == "OK"){
      $address = $data->results[0]->formatted_address;
    }
   echo $address;
  

						} ?>
						
						
						</td>
                   
                    <td><?php
                        $phpdate =$row->venue_added_at;
                        $mysqldate = $phpdate;
                        echo $mysqldate;
                        ?></td>
                    
					<!--<td class="center"  id="td<?php echo $i; ?>">
                        <?php
                        if ($row->status == '1') {
                            $status = "Active";
                            ?>
                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->venue_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'venue')"><span class="label label-success"><?php echo $status; ?></span></a>
                            <?php
                        } elseif ($row->status == '0') {
                            $status = "Inactive";
                            ?>
                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->venue_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'venue')"><span class="label label-error"><?php echo $status; ?></span></a>
                            <?php
                        } elseif ($row->status == '-1') {
                            $status = "Deleted";
                            ?>
                            <a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->venue_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'venue')"><span class="label label-error"><?php echo $status; ?></span></a>
                        <?php } ?>
                    </td>-->
					
					<td class="center"  id="td<?php echo $i; ?>">
                        <?php
                        if ($row->venue_created_by == '1') {
                            echo "Four Square";
                        } elseif ($row->venue_created_by == '2') {
                            echo "Bands in town";
                        } elseif ($row->venue_created_by == '3') {
                            echo "Admin";
							} ?>
                    </td>
					
                    <td class="center" id="td<?php echo $i; ?>">
                        <a class="btn btn-success" href="<?php echo base_url()."index.php/admin/administration/vanues_details/".$this->cm->idEncrypt($row->venue_id); ?>">
                            <i class="halflings-icon white zoom-in" title="Full Detail"></i>  
                        </a>
                 
                        <a class="btn btn-danger" href="javascript:void(0)" onclick="dataDelete('<?php echo base64_encode($this->cm->idEncrypt($row->venue_id) . ',venue'); ?>')">
                            <i class="halflings-icon white trash" title="Delete"></i> 
                        </a>
                    </td>
                    <td>
					<?php if($row->publish==1){?>
                        <input type="button" class="publish success" v_id="<?php echo $this->cm->idEncrypt($row->venue_id); ?>" pub="<?php echo $row->publish; ?>" value="Map" />
					<?php } else {?>
			         <input   type="button" class="publish" v_id="<?php echo $this->cm->idEncrypt($row->venue_id); ?>" pub="<?php echo $row->publish; ?>" value="Map" />

					<?php }?>

					</td>
                    <td>
                       <?php if($row->is_show_home==1){?>
                        <input type="button" class="is_home success" v_id="<?php echo $this->cm->idEncrypt($row->venue_id); ?>" pub="<?php echo $row->is_show_home; ?>" value="Browser" />
                    <?php } else {?>
                     <input   type="button" class="is_home" v_id="<?php echo $this->cm->idEncrypt($row->venue_id); ?>" pub="<?php echo $row->is_show_home; ?>" value="Browser" />

                    <?php }?> 


                    </td>
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