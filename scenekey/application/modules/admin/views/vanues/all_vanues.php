<style type="text/css">
input[type=button].publish  {
    background-color: orangered;
    border: none;
    border-radius: 5px;
    padding: 7px 7px;
    color: #FFFFFF;
    font-size: 15px;
    text-transform: capitalize;
}

input[type=button].is_home  {
    background-color: orangered;
    border: none;
    border-radius: 5px;
    padding: 7px 7px;
    color: #FFFFFF;
    font-size: 15px;
    text-transform: capitalize;
}
.success {
  background-color:#00a300 !important;
}
.inner_div {
    margin: auto;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 200px;
    height: 300px;
   background: url('../../../images/ajax-loader-large.gif') center no-repeat;
    z-index: 999999;
    background-size: 100px;
}
.is_home_inner_div {
   
    width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
  text-align: center;
}
.is_home_inner_div  img{
    top:0;left:0; right:0; bottom:0;
position:absolute;
margin:auto
}
</style>
<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>index.php/admin/administration/home">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/administration/vanues_list">All Venues</a></li>
    </ul>

    <div class="row-fluid sortables">       
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon star"></i><span class="break"></span>All Venues</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
            <form method="post" id="eventForm">
            <div class="row-fluid">
                <div class="">
                    <div class="dataTables_filter" id="DataTables_Table_0_filter">
                        
                            <?php //echo "<pre>";print_r(array_unique($cities));echo "</pre>"; ?>
                           
                            <select name="search_city" id="search_city">
                                <option value="">Select City</option>
                                <?php foreach($cities as $kcity => $vcity){
                                    if(!empty($vcity->city)){
                                                              
                                        echo "<option value='".$vcity->city."'>".$vcity->city."</option>";
                                } }?>
                            </select>
                        
                            <select name="search_category" id="search_category">
                                <option value="">Select Category</option>
                                <?php foreach($vanue_category as $kcat => $vcat){
                                    if(!empty($vcat)){
                                   
                                        echo "<option value='".$vcat->category_id."'>".$vcat->category."</option>";                                        
                                } } ?>
                            </select>
                            <select name="publish_category" id="publish_category">
                                <option value="">Select One</option>
                                <option value="1">Publish</option>
                                <option value="0">Unpublish</option>
                            </select>
                            <input type="text" name="search_keyword" id="search_keyword" />
                            <button type="button" class="btn btn-default" id="submit_search">Submit</button>
                            
                       
                    </div>
                </div>
            </div>
            </form>
              <div class="is_home_inner_div" style="display:none">
                  <img src="../../../images/ajax-loader-large.gif" height="250px" width="150px">
              </div>  

            <div id="ajaxdata">
                
            </div>
                      
            </div>
            
            
        </div><!--/span-->

    </div><!--/row-->
    <div class="span12"><div class="dataTables_info" id="DataTables_Table_0_info"></div></div>
    

</div><!--/.fluid-container-->
<span id="sort_by" data-sort="desc"></span>

<script type="text/javascript">
jQuery(document).ready(function($){
    
    ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_vanue_list"; ?>');
    $("#search_city , #search_category, #publish_category").on("change",function(){
        ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_vanue_list"; ?>');
    });
    $("#submit_search").on("click",function(){
       ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_vanue_list"; ?>'); 
    });
    /*$("body").on("click",".paginationlink",function(e){
        //e.preventDefault();
        var current =   $(this);
        var href = current.attr("href");
        var page    =   href.substr(href.lastIndexOf('/') + 1);
        getAjaxCall(page);
        return false;
        //console.log(current.attr("href"));
    })*/
    $("body").on("click",".publish",function(){
        var current     =   $(this);
        //var venueId     =   current.attr('v_id');
        
            $.ajax({
                url: "<?php echo base_url()."index.php/admin/administration/update_venue_status"; ?>", 
                type: "POST",             
                data:{'venueid':current.attr('v_id'),'status':current.attr('pub')},      
                cache: false,  
                beforeSend: function(){
                   $(".is_home_inner_div").show();
                  },
                 				
                success: function(data){
			    $(".is_home_inner_div").hide();

                    if(data==1){
                        current.attr('pub',1);
                        current.addClass("success");
                    }else if(data==0){
                        current.attr('pub',0);
                       current.removeClass("success");                 
                    }
                }
            });
    });

    /*
         =======================
         vanue show in home ajax
         =======================
    */
     $("body").on("click",".is_home",function(){
        var current     =   $(this);
        var venueId     =   current.attr('v_id');

       // alert(venueId);
            $.ajax({
                url: "<?php echo base_url()."index.php/admin/administration/update_venue_status_ishome"; ?>", 
                type: "POST",             
                data:{'venueid':current.attr('v_id'),'is_home':current.attr('pub')},      
                 beforeSend: function(){
                   $(".is_home_inner_div").show();
                  },
                 
                success: function(data){
                      $(".is_home_inner_div").hide();
                    if(data==1){
                        current.attr('pub',1);
                        current.addClass("success");
                    }else if(data==0){
                        current.attr('pub',0);
                       current.removeClass("success");                 
                    }
                }
            });
    });
	
});

function sortVenue()
{
	var sort = $("#sort_by").data('sort');
	var sortBy = $("#sort_by_date").data('sort-by');
	
	
	
	var url = '<?php echo base_url()."index.php/admin/administration/ajax_vanue_list/"; ?>'+$("#pageNo").val();
	$.ajax({
        url: url, 
        type: "POST",             
    	data:{page:url,sort:sort,sortby:sortBy,'search_city':$("#search_city").val(),'search_category':$("#search_category").val(),'publish_category':$("#publish_category").val(),'search_keyword':$("#search_keyword").val()},     
        cache: false,  
        beforeSend: function() {
                    $("#ajaxdata").html("<div class='inner_div'></div>");
                },                    
        success: function(data){
            $("#ajaxdata").html(data);
			
			if(sort == 'desc'){
				$("#sort_by").data('sort','asc');
				$("#sort_by_date").html('<i class="halflings-icon chevron-down"></i>');
			} else {
				$("#sort_by").data('sort','desc');
				$("#sort_by_date").html('<i class="halflings-icon chevron-up"></i>');
			}
			
        }
    });
    return false;
	
	
}

function ajax_fun(page)
{
	var sort = $("#sort_by").data('sort');
	var sortBy = $("#sort_by_date").data('sort-by');
	
	
	
	
    $.ajax({
        //url: "<?php echo base_url()."index.php/admin/administration/ajax_vanue_list"; ?>", 
        url:page,
        type: "POST",             
        data:{page:page,'search_city':$("#search_city").val(),'search_category':$("#search_category").val(),'publish_category':$("#publish_category").val(),'search_keyword':$("#search_keyword").val()},      
        cache: false,  
        beforeSend: function() {
                    $("#ajaxdata").html("<div class='inner_div'></div>");
                },                    
        success: function(data){
            $("#ajaxdata").html(data);
			if(sort == 'desc'){
				$("#sort_by").data('sort','asc');
				$("#sort_by_date").html('<i class="halflings-icon chevron-down"></i>');
			} else {
				$("#sort_by").data('sort','desc');
				$("#sort_by_date").html('<i class="halflings-icon chevron-up"></i>');
			}
        }
    });
    return false;
}

</script>