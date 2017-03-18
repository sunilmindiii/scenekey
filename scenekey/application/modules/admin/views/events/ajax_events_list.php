<?php  if ($events) { ?>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Vanue</th>
			<th>Artist</th>
			<th>Date</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>   
	<tbody>
		<?php
		if ($events) {
			$i = 1;
			foreach ($events as $row) {
				?>
				<tr>
					<td class="center"><?php echo $row->event_name; ?></td>
					<td class="center"><?php echo $row->venue_name; ?></td>
					<td class="center"><?php echo $row->artist_name; ?></td>
					<td class="center"><?php echo $row->event_date; ?></td>
					<td class="center"  id="td<?php echo $i; ?>">
						<?php
						if ($row->status == '1') {
							$status = "Active";
							?>
							<a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->event_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'category')"><span class="label label-success"><?php echo $status; ?></span></a>
							<?php
						} elseif ($row->status == '0') {
							$status = "Inactive";
							?>
							<a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->event_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'category')"><span class="label label-error"><?php echo $status; ?></span></a>
							<?php
						} elseif ($row->status == '-1') {
							$status = "Deleted";
							?>
							<a href="javascript:void(0)" onclick="changeStatus('<?php echo $this->cm->idEncrypt($row->event_id); ?>', '<?php echo $row->status; ?>', '<?php echo $i; ?>', 'category')"><span class="label label-error"><?php echo $status; ?></span></a>
						<?php } ?>
					</td>
					<td class="center" id="td<?php echo $i; ?>">
						<a class="btn btn-success" href="<?php echo base_url(); ?>">
							<i class="halflings-icon white zoom-in" title="Full Detail"></i>  
						</a>
						<?php /*<a class="btn btn-info" href="<?php echo base_url(); ?>">
							<i class="halflings-icon white edit" title="Update Detail"></i>  
						</a>*/?>
						<a class="btn btn-danger" href="javascript:void(0)" onclick="dataDelete('<?php echo base64_encode($this->cm->idEncrypt($row->event_id) . ',category'); ?>')">
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
<?php }else{ echo "No Data Found";}?> 
<div class="span12 center">
	<div class="dataTables_paginate paging_bootstrap pagination" id="pagination">
			<?php echo $pagination; ?>
	</div>
</div>   