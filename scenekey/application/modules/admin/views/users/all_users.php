<style type="text/css">
input[type=button].publish  {
    background-color: orangered;
    border: none;
    border-radius: 5px;
    padding: 5px 5px;
    color: #FFFFFF;
    margin: 10px;
    font-size: 15px;
    text-transform: capitalize;
}
.inner_div {
    margin: auto;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 200px;
    height: 300px;
	background: url('../../../../images/ajax-loader-large.gif') center no-repeat;
    z-index: 999999;
    background-size: 100px;
}
.input-xlarge.focused.parsley-validated.has-error{
	border : 1px solid #A94442 !important;
}
</style>
<div id="content" class="span10">

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>index.php/admin/administration/home">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/administration/users/<?php echo $user_type;?>"><?php echo "User (".ucfirst($user_type).")"; ?></a></li>
    </ul>

    <div class="row-fluid sortables">       
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon star"></i><span class="break"></span><?php echo "User (".ucfirst($user_type).")"; ?></h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
            <!--<form method="post" id="eventForm">
				<div class="row-fluid">
					<div class="">
						<div class="dataTables_filter" id="DataTables_Table_0_filter">
							   
							<select name="search_city" id="search_city">
								<option value="">Select City</option>
								
							</select>
						
							<select name="search_category" id="search_category">
								<option value="">Select Category</option>
								
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
            </form>-->
			
			<div id="ajaxdata"></div>
                          
		</div>
            
            
	</div><!--/div-->

    </div><!--/row-->
    <div class="span12"><div class="dataTables_info" id="DataTables_Table_0_info"></div></div>
    

</div><!--/.fluid-container-->



	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
    
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sending Email</h4>
				</div>
				<div class="modal-body">
					
					<div id="showMessage" class=""></div>
					
					<form class="form-horizontal" role="form" id="send_email_touser" method="post">
						<div class="control-group">
							<label class="control-label">To</label>
							<div class="controls">
								<input type="text" name="to" id="to_email" class="input-xlarge focused parsley-validated">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Subject</label>
							<div class="controls">
								<input type="text" name="subject" id="subject" class="input-xlarge focused parsley-validated">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Email Body</label>
							<div class="controls">
								<textarea name="body" id="body" class="input-xlarge focused parsley-validated"></textarea>
							</div>
						</div>
						<div class="form-actions">
							<input type="button" value="Send" id="send_email" onclick="send_email_to_user()" class="btn btn-primary" name="submit">
						</div>
					</form>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
      
		</div>
  </div>
  





<script type="text/javascript">
jQuery(document).ready(function($){
    ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_user_list/".$user_type; ?>');
    $("#search_city , #search_category, #publish_category").on("change",function(){
        ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_user_list/".$user_type; ?>');
    });
    $("#submit_search").on("click",function(){
       ajax_fun('<?php echo base_url()."index.php/admin/administration/ajax_user_list/".$user_type; ?>'); 
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
                url: "<?php echo base_url()."index.php/admin/administration/update_venue_status_"; ?>", 
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
    });
    
});


function send_email_to_user()
{
	var subject = $("#subject").val();
	var body = $("#body").val();
	
	if(subject == ''){
		$("#subject").addClass('has-error');
		return false;
	} else {
		$("#subject").removeClass('has-error');
	}
	
	if(body == ''){
		$("#body").addClass('has-error');
		return false;
	} else {
		$("#body").removeClass('has-error');
	}
	
	$("#send_email").attr("disabled", true);
	$("#send_email").val('Sending...');
	
	var formdata = $( "#send_email_touser" ).serialize();
	$.post( "<?php echo base_url()."index.php/admin/administration/sendEmail"; ?>", formdata ,function( data ) {
		
		$("#showMessage").addClass("alert alert-success");
		$("#showMessage").text("Email has been sent.");
		$("#send_email").val('Send');
	
		setTimeout(function(){
			$("#myModal").modal('hide');
			$("#showMessage").removeClass("alert alert-success");
			$("#showMessage").html("");
			$("#send_email").removeAttr("disabled");
		},3000);
		
		
	});
	return false;
}

function select_all_checkbox(ch)
{
	if(ch.checked) {
		// Iterate each checkbox
		$('.selectMe').each(function() {
			this.checked = true;
		});
	} else {
		$('.selectMe').each(function() {
			this.checked = false;
		});
	}
}

function getEmailBox()
{
	var atLeastOneIsChecked = $('.selectMe:checked').length;
	
	if(atLeastOneIsChecked == 0){
		alert('Please select at lease one checkbox');
	} else {
		var allVals = [];
		$('.selectMe:checked').each(function() {
			allVals.push($(this).val());
		});
		$('#to_email').val(allVals);
		$("#myModal").modal();
	}
	
}

function ajax_fun(page)
{
    $.ajax({
        url:page,
        type: "POST",             
        data:{page:page,'search_city':$("#search_city").val(),'search_category':$("#search_category").val(),'publish_category':$("#publish_category").val(),'search_keyword':$("#search_keyword").val()},      
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