<?php // include('header.php'); ?>
<style type="text/css">
    body {
    font-family: "Montserrat",sans-serif !important;
    font-size: 100%;
}
</style>
<div class="light_blue">
    <div class="page1">
        <div class="container" style="line-height: 50px; ">
            <div class="col-xs-12 col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1">
                <div class="margin15p">
                    
                    <div class="white_bg_main">
                    <!--        <div class="well">
                    <div class="row">
                    <div class="col-md-5 col-md-5">
                    <input type="text" placeholder="business Name" class="form-control">
                    </div>
                    <div class="col-md-5 col-md-5">
                    <input type="text" placeholder="Near" class="form-control">
                    </div>
                    <div class="col-md-2 col-md-2">
                    <a class="btn btn-scenkey" href=""><i class="fa fa-search"></i> Get Start</a>
                    </div>
                    </div>
                    </div>
                    -->
                        
                    <?php foreach ($records as $venue) { ?>
                    <div class="box_content" >
                         
                        <div class="col-md-2 col-sm-2">


                            <?php if (empty($venue->venue_image)) { ?>
                                <img class="img-responsive" src="<?php echo base_url(); ?>assets/image/default.jpg">
                            <?php }else{?> 
                                <img class="img-responsive" src="<?php echo base_url(); ?>assets/image/<?php echo $venue->venue_image ?>">
                            <?php } ?>
                            <h3>Name: <?php echo $venue->venue_name; ?></h3>
                        </div>
                        <div class="col-md-5 col-sm-5">

                            
                            <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <small> <?php echo $venue->rating_count; ?> Review</small></p>
                            <h3>Venue lat: <?php echo $venue->venue_lat; ?></h3>
                            <h3>Venue long: <?php echo $venue->venue_long; ?> </h3>
                            <h3>venue_country: <?php echo $venue->venue_country; ?> </h3>
                        </div>
                        
                        <div class="col-md-3 col-sm-3" >
                            <h3>Addres:  <?php echo $venue->venue_address; ?></h3>
                            <h3> City:  <?php echo $venue->venue_city; ?></h3>
                   

                            <h3> State:  <?php echo $venue->venue_state; ?></h3>
                   
                        </div> 
                        

                    </div>        
                    <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //banner-bottom -->
