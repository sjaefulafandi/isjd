<div class="modal-content">
	<form method="post" action="#" enctype="multipart/form-data" id="komplain_form">
		    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Komplain Form</b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	
	<div class="modal-body">
		
		<div class="form-group form-group-sm" >
			
			<div class="row">
				<div class="col-sm-12">Deskripsi Komplain
					<textarea rows="5" class="form-control" id="comment_complain" name="comment_complain" required></textarea>
				</div>
				
			</div>
		</div>	
	</div>
	<div class="row-fluid modal-footer">
		<button class="btn btn-default btn-xs" type="submit" >Save & Close</button>
	 	<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
			      
	</div>
	</form>
</div>
<script >
$(document).ready(function() {
	$("#komplain_form").validate({
	    rules: {
				comment_complain:{required:true}
				},
  		messages :{
	 		comment_complain:{required:"Deskripi komplain tidak terisi"}
      	},
	 	submitHandler: function(form) {
	         //alert ('hai');
	        var comment_complain=$('#comment_complain').val();
	        $('#modaltarget').load(base_url+'index.php/user_public/save_komplain/',{"comment_complain":comment_complain},function (data){
	        	loadpanel('dKomplain');
	        	$('#myModalDetail').modal('hide');
	        	
	        });
	        return false ;//alert('hat');
      	}//end of function submit_handler
	});

});
</script>
