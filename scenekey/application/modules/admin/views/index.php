<noscript>
<div class="alert alert-block span10">
    <h4 class="alert-heading">Warning!</h4>
    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
</div>
</noscript>

<!-- start: Content -->
<div id="content" class="span10">


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>

    <div class="row-fluid">

        <!--<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
                <div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
                <div class="number">854<i class="icon-arrow-up"></i></div>
                <div class="title">visits</div>
                <div class="footer">
                        <a href="#"> read full report</a>
                </div>	
        </div>
        <div class="span4 statbox green" onTablet="span6" onDesktop="span4">
            <div class="left-dasktop-option-icon">678<i class="icon-home "></i></div>
            <div class="left-dasktop-option-title">Active Properties</div>
            <div class="number">123<i class="icon-home"></i></div>
            <div class="title">Inactive Properties</div>
            <div class="footer">
                <a href="#"> read full report</a>
            </div>
        </div>
        <div class="span4 statbox blue noMargin" onTablet="span6" onDesktop="span4">
            <div class="left-dasktop-option-icon">678<i class="icon-arrow-up"></i></div>
            <div class="left-dasktop-option-title">Active Projects</div>
            <div class="number">982<i class="icon-arrow-down"></i></div>
            <div class="title">Inactive Projects</div>
            <div class="footer">
                <a href="#"> read full report</a>
            </div>
        </div>
        <div class="span4 statbox purple" onTablet="span6" onDesktop="span4">
            <div class="left-dasktop-option-icon">678<i class="icon-user "></i></div>
            <div class="left-dasktop-option-title">Active Users</div>
            <div class="number">218 <?php //echo $activUsers;?><i class="black icon-user "></i></div>
            <div class="title">Inactive Users</div>
            <div class="footer">
                <a href="#"> All Users</a>
            </div>
        </div>	-->

    </div>		

    <?php /*?><div class="row-fluid">

        <div class="box black span4" onTablet="span6" onDesktop="span4">
            <div class="box-header">
                <h2><i class="halflings-icon white home"></i><span class="break"></span>New Builders</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list metro">
                    <?php
                    if (!empty($this->data['userData1'])) {
                        foreach ($this->data['userData1'] as $row) {
                            ?>
                            <li class="gray">
                                <a href="#">
                                    <?php if ($row->user_image == '') { ?>
                                        <img class="avatar" src="<?php echo base_url(); ?>adminMediaStyle/img/avatar.jpg" >
                                    <?php } else { ?>
                                        <img class="avatar" src="<?php echo base_url(); ?>adminMediaStyle/images/frontUsers/<?php echo $row->user_image; ?>">
                                    <?php } ?>
                                </a>
                                <strong>Name: <?php echo $row->user_first_name . ' ' . $row->user_last_name; ?></strong> <br>
                                <strong>From:</strong> <?php echo $row->city_name . ', ' . $row->state_name; ?><br>
                                <strong>Number:</strong> <?php echo $row->user_contact; ?>  

                            </li>
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </div><!--/span-->

        <div class="box black span4" onTablet="span6" onDesktop="span4">
            <div class="box-header">
                <h2><i class="halflings-icon white signal"></i><span class="break"></span>New Brokers</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list metro">
                    <?php
                    if (!empty($this->data['userData2'])) {
                        foreach ($this->data['userData2'] as $row) {
                            ?>
                            <li class="gray">
                                <a href="#">
                                    <?php if ($row->user_image == '') { ?>
                                        <img class="avatar" src="<?php echo base_url(); ?>adminMediaStyle/img/avatar.jpg" >
                                    <?php } else { ?>
                                        <img class="avatar" src="<?php echo base_url(); ?>adminMediaStyle/images/frontUsers/<?php echo $row->user_image; ?>">
                                    <?php } ?>
                                </a>
                                <strong>Name: <?php echo $row->user_first_name . ' ' . $row->user_last_name; ?></strong> <br>
                                <strong>From:</strong> <?php echo $row->city_name . ', ' . $row->state_name; ?><br>
                                <strong>Number:</strong> <?php echo $row->user_contact; ?>  

                            </li>
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </div><!--/span-->

        <div class="box black span4" onTablet="span6" onDesktop="span4">
            <div class="box-header">
                <h2><i class="halflings-icon white user"></i><span class="break"></span>New Individuals</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list metro">
                    <?php
                    if (!empty($this->data['userData3'])) {
                        foreach ($this->data['userData3'] as $row) {
                            ?>
                            <li class="gray">
                                <a href="#">
                                    <?php if ($row->user_image == '') { ?>
                                        <img class="avatar" src="<?php echo base_url(); ?>adminMediaStyle/img/avatar.jpg" >
                                    <?php } else { ?>
                                        <img class="avatar" src="<?php echo base_url(); ?>adminMediaStyle/images/frontUsers/<?php echo $row->user_image; ?>">
                                    <?php } ?>
                                </a>
                                <strong>Name: <?php echo $row->user_first_name . ' ' . $row->user_last_name; ?></strong> <br>
                                <strong>From:</strong> <?php echo $row->city_name . ', ' . $row->state_name; ?><br>
                                <strong>Number:</strong> <?php echo $row->user_contact; ?>  

                            </li>
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </div><!--/span-->

    </div><?php */?>

    <div class="row-fluid">	

        <a class="quick-button metro blue span3">
            <i class="icon-star"></i>
            <p>Artist</p>
            <!--<span class="badge">13</span>-->
        </a>
        <a class="quick-button metro purple span3">
            <i class="icon-user"></i>
            <p>Users(<?php echo $user_count[0]['usercount'];?>)</p>
           <!-- <span class="badge">237</span>-->
        </a>
        <a class="quick-button metro red span3">
            <i class="icon-map-marker"></i>
            <p>Vanue</p>
            <!--<span class="badge">46</span>-->
        </a>
        <a class="quick-button metro black span3">
            <i class="icon-globe"></i>
            <p>Locations</p>
        </a>
       <!-- <a class="quick-button metro pink span2">
            <i class="icon-group"></i>
            <p>Forum</p>
            <span class="badge">88</span>
        </a>
        <a class="quick-button metro green span2">
            <i class="icon-magnet"></i>
            <p>Visits</p>
            <span class="badge">555</span>
        </a>-->

        <div class="clearfix"></div>

    </div><!--/row-->


