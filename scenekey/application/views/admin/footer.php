		</div><!--/.fluid-container-->
	<!-- end: Content -->
	</div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
</div>

<div class="clearfix"></div>
	
<footer>
	<p>
		<span style="text-align:left;float:left">
        	&copy; 2015 <a href="#" alt="Bootstrap_Metro_Dashboard"> New Dashboard</a>
        </span>
	</p>
</footer>
	
	<!-- start: JavaScript-->

		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery-1.9.1.min.js"></script>
		
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.ui.touch-punch.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/modernizr.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/bootstrap.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.cookie.js"></script>
	
		<!--<script src='<?php echo base_url(); ?>adminMediaStyle/js/fullcalendar.min.js'></script>-->
	
		<script src='<?php echo base_url(); ?>adminMediaStyle/js/jquery.dataTables.min.js'></script>

		<script src="<?php echo base_url(); ?>adminMediaStyle/js/excanvas.js"></script>
        
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.flot.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.flot.pie.js"></script>
	
    	<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.flot.stack.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.flot.resize.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.chosen.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.uniform.min.js"></script>
		
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.cleditor.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.noty.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.elfinder.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.raty.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.iphone.toggle.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.gritter.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.imagesloaded.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.masonry.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.knob.modified.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/jquery.sparkline.min.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/counter.js"></script>
	
		<script src="<?php echo base_url(); ?>adminMediaStyle/js/retina.js"></script>

		<script src="<?php echo base_url(); ?>adminMediaStyle/js/custom.js"></script>
	<!-- end: JavaScript-->
    
    <script>
		if ($.trim($('.successAdmsg').html()).length>0){
			$(".successAdmsg").show();
			setTimeout(function(){
				$("div.successAdmsg").fadeOut(1000);
			},3000);
		}
		
		if ($.trim($('.errorAdmsg').html()).length>0){
			$(".errorAdmsg").show();
			setTimeout(function(){
				$("div.errorAdmsg").fadeOut(1000);
			},3000);
		}
		else
		{
			$('.errorAdmsg').hide();
		}
	</script>
	
</body>
</html>
