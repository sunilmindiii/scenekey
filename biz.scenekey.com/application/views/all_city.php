<!-- banner-bottom -->
	
<div class="light_blue">
    <div class="page1">

	    <div class="container min-h">

			<div class="banner-bottom">
				<div class="container">
					<div class="banner-bottom-grids">
						<div class="text-center banner-bottom-grids" style="font-size: 25px;"><b>Engage your crowd by streaming your live Venue Channel!</b></div>
						<div class="text-center banner-bottom-grids" style="font-size: 25px;"><b>Select your city to begin!</b></div>

						<?php $i=1; foreach($cities as $city){ if($i>6){$i=1;} ?>
							<div class="col-md-4 banner-bottom-grid">
								<a href="<?php echo base_url()."index.php/home/venue_view/".$city->city; ?>">
								    <?php if(isset($city->cityimage) && !empty($city->cityimage)){?> 
									 <img class="img-responsive venue_view" src="<?php echo "http://69.28.75.158/scenekey/images/city/".$city->cityimage; ?>" alt="<?php echo $city->city; ?>">
						<?php }
						else {?>
						<img class="img-responsive venue_view" src="<?php echo base_url()."assets/images/default_venue.png"; ?>" alt="<?php echo $city->city; ?>">

						<?php }
						?>
									<div class="captn">
										<h4><?php echo $city->city."(".$city->state.")" ;?></h4>
									</div>
								</a>
							</div>
						<?php $i++; }   ?>
					</div>
				</div>
			<?php echo $links; ?>
			</div>
		</div>
	</div>
</div>
<!-- //banner-bottom -->
