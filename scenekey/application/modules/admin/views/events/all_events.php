<style>
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
</style>
<div id="content" class="span10">

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>index.php/admin/administration/home">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/administration/all_events">All Events</a></li>
    </ul>

    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon star"></i><span class="break"></span>All Events</h2>
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
                        
                            <select name="search_artist" id="search_artist">
                                <option value="">Select Artist</option>
                                <?php foreach($artists as $kcat => $vcat){
                                    if(!empty($vcat)){
                                   
                                        echo "<option value='".$vcat->artist_id."'>".$vcat->artist_name."</option>";                                        
                                } } ?>
                            </select>
                  
                            <input type="text" name="search_keyword" id="search_keyword" />
                            <button type="button" class="btn btn-default" id="submit_search">Submit</button>
                            
                       
                    </div>
                </div>
            </div>
            </form>
            <div id="ajaxdata">
                
            </div>
                          
            </div>
        </div><!--/span-->

    </div><!--/row-->

</div><!--/.fluid-container-->
<script type="text/javascript">
jQuery(document).ready(function($){
    
    ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_events_list"; ?>');
    $("#search_city , #search_artist").on("change",function(){
        ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_events_list"; ?>');
    });
    $("#submit_search").on("click",function(){
       ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_events_list"; ?>'); 
    });
    /*$("body").on("click",".paginationlink",function(e){
        //e.preventDefault();
        var current =   $(this);
        var href = current.attr("href");
        var page    =   href.substr(href.lastIndexOf('/') + 1);
        getAjaxCall(page);
        return false;
        //console.log(current.attr("href"));
    })
    $("body").on("click",".publish",function(){
        var current     =   $(this);
        //var venueId     =   current.attr('v_id');
        
            $.ajax({
                url: "<?php echo base_url()."index.php/admin/administration/update_venue_status"; ?>", 
                type: "POST",             
                data:{'venueid':current.attr('v_id'),'status':current.attr('pub')},      
                cache: false,                     
                success: function(data){
                    if(data==1){
                        current.attr('pub',1);
                        current.val("unpublish");
                    }else if(data==0){
                        current.attr('pub',0);
                        current.val("publish");                 
                    }
                }
            });
    });*/
    
});
function ajax_fun(page)
{
    $.ajax({
        //url: "<?php echo base_url()."index.php/admin/administration/ajax_vanue_list"; ?>", 
        url:page,
        type: "POST",             
        data:{page:page,'search_city':$("#search_city").val(),'search_artist':$("#search_artist").val(),'search_keyword':$("#search_keyword").val()},      
        cache: false,  
        beforeSend: function() {
                    $("#ajaxdata").html("<div class='inner_div'></div>");
                },                    
        success: function(data){
            $("#ajaxdata").html(data);
        }
    });
    return false;
}

</script>