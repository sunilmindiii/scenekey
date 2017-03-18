<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
		<div class="banner-bottom-grids">
			<h2 class="text-center">City</h2>
		<?php $i=1; 
		foreach($cities as $city){ if($i>6){$i=1;}
			?>
			<div class="col-md-4 banner-bottom-grid">
				<a href="<?php echo base_url()."index.php/venue?venue_city=".$city->city; ?>">
					<img class="img-responsive" src="<?php echo base_url()."images/".$i.".jpg"; ?>" alt="<?php echo $city->city; ?>">
					<div class="captn">
						<h4><?php echo $city->city; ?></h4>
					</div>
				</a>
			</div>
		<?php $i++; } ?>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //banner-bottom -->