<?php $siteUrl = base_url(); ?>
<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/admin/administration/home">
                            <i class="icon-bar-chart"></i>
                            <span class="hidden-tablet"> Dashboard</span>
                        </a>
                    </li>
                    <!--<li>
                        <a class="dropmenu" href="#">
                            <i class="halflings-icon white star-empty"></i>
                            <span class="hidden-tablet">Artist </span>
                        </a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/add_event">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Add New Artist</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/artists_list">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Artist</span>
                                </a>
                            </li>
                             
                        </ul>	
                    </li>-->
                    <li>
                        <a class="dropmenu" href="#">
                            <i class="halflings-icon white user"></i>
                            <span class="hidden-tablet">Users</span>
                        </a>
						<ul>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/add_user">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Add New User</span>
                                </a>
                            </li>
							<li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/users/all">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Users</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/users/promoter">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Promoter</span>
                                </a>
                            </li>
							<li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/users/social">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Social User</span>
                                </a>
                            </li>
							<li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/users/performer">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Performer</span>
                                </a>
                            </li>
							<li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/users/dummyuser">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Dummy User</span>
                                </a>
                            </li>
                             
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#">
                            <i class="halflings-icon white th-large"></i>
                            <span class="hidden-tablet">Events </span>
                        </a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/add_event">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Add New Event</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/all_events">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Events</span>
                                </a>
                            </li>
                             
                        </ul>	
                    </li>

                    <li>
                        <a class="dropmenu" href="#">
                            <i class=" halflings-icon white globe"></i>
                            <span class="hidden-tablet">Venues</span>
                        </a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/vanues_list">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Venue</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/add_vanues">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Add New Venue</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/vanues_categories_list">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Venue Categories</span>
                                </a>
                            </li>
                             
                        </ul>	
                    </li>
					
					 <li>
                        <a  href="<?php echo base_url(); ?>index.php/admin/administration/registerd_vanues">
                            <i class=" halflings-icon white globe"></i>
                            <span class="hidden-tablet">Registred Venues</span>
                        </a>
                       <!-- <ul>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/registerd_vanues">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Registred Venue List</span>
                                </a>
                            </li>

                        </ul>	-->
                    </li>
							 <li>
                        <a  href="<?php echo base_url(); ?>index.php/admin/administration/active_events">
                            <i class=" halflings-icon white globe"></i>
                            <span class="hidden-tablet">Active Events</span>
                        </a>
                       <!-- <ul>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/registerd_vanues">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Registred Venue List</span>
                                </a>
                            </li>

                        </ul>	-->
                    </li>
                    <li>
                        <a class="dropmenu" href="#">
                            <i class=" halflings-icon white globe"></i>
                            <span class="hidden-tablet">Locations</span>
                        </a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>index.php/admin/administration/city_list">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Cities</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo base_url(); ?>admin/administration/states_list">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All States</span>
                                </a>
                            </li>
                        </ul>	
                    </li>
					
					     <li>
                        <a class="" href="<?php echo base_url(); ?>index.php/admin/administration/changelocation">
                            <i class=" halflings-icon white globe"></i>
                            <span class="hidden-tablet">Change my Locations</span>
                        </a>
               
                    </li>
                 <!--   <li>
                        <a class="dropmenu" href="#">
                            <i class="halflings-icon white user"></i>
                            <span class="hidden-tablet">Front Users</span>
                        </a>
                    </li>		 
                    <li>
                        <a class="dropmenu" href="#">
                            <i class=" halflings-icon white retweet"></i>
                            <span class="hidden-tablet">Forum</span>
                        </a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php //echo base_url('admin/forum/allforumCategoriesList'); ?>">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Categories</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url('admin/forum/addforumTopics'); ?>">
                                    <i class="halflings-icon white plus"></i>
                                    <span class="hidden-tablet">Add Topic</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url('admin/forum/allforumTopicsList'); ?>">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Topics</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url('admin/forum/allforumTopicsPostsList'); ?>">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Topics Posts</span>
                                </a>
                            </li>
                        </ul>	
                    </li>
                    <li>
                        <a class="dropmenu" href="#">
                            <i class=" halflings-icon white globe"></i>
                            <span class="hidden-tablet">Locations</span>
                        </a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/locations/allCountryList">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Country</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/locations/allStateList">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All State</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/locations/allCityList">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All City</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/locations/allCityAreaList">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All City Area</span>
                                </a>
                            </li>
                        </ul>	
                    </li>
                    <li>
                         <a class="dropmenu" href="#">
                            <i class="halflings-icon white briefcase"></i>
                            <span class="hidden-tablet">Plans</span>
                        </a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/planmaster/addNewPlan">
                                    <i class="halflings-icon white plus"></i>
                                    <span class="hidden-tablet">Add Plan</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/planmaster/allPlansList">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Plans</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/planmaster/allDeletedPlansList">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Deleted Plans</span>
                                </a>
                            </li>
                        </ul>	
                    </li>
                    <li>
                         <a class="dropmenu" href="#">
                            <i class="halflings-icon white eye-open"></i>
                            <span class="hidden-tablet">Advertisement</span>
                        </a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/allothers/addNewAdvertisement">
                                    <i class="halflings-icon white plus"></i>
                                    <span class="hidden-tablet">Add Advertisement</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/allothers/allAdvertisementsList">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">All Advertisements</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php //echo base_url(); ?>admin/allothers/allDeletedAdvertisementsList">
                                    <i class="halflings-icon white list"></i>
                                    <span class="hidden-tablet">Deleted Advertisements</span>
                                </a>
                            </li>
                        </ul>	
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-folder-open"></i>
                            <span class="hidden-tablet"> File Manager</span>
                        </a>
                    </li>-->
                </ul>
            </div>
        </div>
        <!-- end: Main Menu -->