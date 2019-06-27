<div class="modal-content">
		    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Progress Komplain Detail Form </b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
				<form method="post" action="#" enctype="multipart/form-data" id="komplain_progress_detail">
	
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
				
				<input type="hidden" name="id_user_complain" id="id_user_complain" value="<?php echo $id_user_complain;?>">
				<div class="col-sm-12">Deskripsi Komplain
					<textarea rows="5" class="form-control" id="comment_complain" name="comment_complain" required></textarea>
				</div>
				<div class="col-sm-8"> Status <br>
					<label class="radio-inline">
						<input type="radio" id="statuskomplain1" name="statuskomplain" data-error="#error_statukomplain" value="1" required>Close
					</label>
					<label class="radio-inline">
						<input type="radio" id="statuskomplain2" name="statuskomplain" data-error="#error_statukomplain" value="0">Open
					</label>
				</div>
				<div id="error_statukomplain"></div>

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
	$('#komplain_progress_detail').validate({
	    rules: {
				comment_complain:{required:true}
				,status_komplain:{required:true}
				},
  		messages :{
	 		comment_complain:{required:"Deskripi komplain tidak terisi"}
	 		,statuskomplain:{required:"Status Komplain harus dipilih"}
      	},
	 	errorPlacement: function(error, element) {
	      var placement = $(element).data('error');
	      if (placement) {
	        $(placement).append(error)
	      } else {
	        error.insertAfter(element);
	      }
	    },
	 	submitHandler: function(form) {
	         //alert ('hai');
	        var comment_complain=$('#comment_complain').val();
	        var statuskomplain=$('input[name=statuskomplain]:checked').val();
	        var id_user_complain=$('#id_user_complain').val();


	        $('#modaladmin').load(base_url+'index.php/admin/save_komplain_detail/',{"comment_complain":comment_complain,"statuskomplain":statuskomplain,"id_user_complain":id_user_complain},function (data){
	        	viewadmincomplaindetail(id_user_complain);
	        	//loadpanel('dKomplain');
	        	//$('#myModalDetail').modal('hide');
	        	
	        });
	        return false ;//alert('hat');
      	}//end of function submit_handler
	});

});
</script>
