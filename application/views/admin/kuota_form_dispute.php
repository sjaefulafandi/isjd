<div class="modal-content">
	<form method="post" action="#" enctype="multipart/form-data" id="kuota_dispute_form">
		    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Add Kuota Dispute</b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	
	<div class="modal-body">
		
		<div class="form-group form-group-sm" >
			<input type="input" value="<?php echo $user_public_id;?>" id="user_public_id" name="user_public_id" class="form-control input-sm" >
			<div class="row">
		    	<div class="col-sm-4"> Kuota <br>
		    		<input type="input" id="kuota" name="kuota" class="form-control input-sm" >
		    	</div>
		  	</div>
			<div class="row">
		    
				<div class="col-sm-12"> Jenis Kuota <br>
				    <label for="jk1"></label>
				    Tambah <input type="radio" id="tb1" name="tb" value="positif" data-error="#error_tb" required >
				    Kurang <input type="radio" id="tb2" name="tb" value="negatif" data-error="#error_tb"><br>
				</div>
			</div>
			
			<div class="row">
				    <div id="error_tb"></div>
			
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
	$("#kuota_dispute_form").validate({
	    rules: {
				kuota:{required:true},
				tb:{required:true},

			},
			  		messages :{
	 		kuota:{required:"Jumlah Kuota tidak terisi"},
	 		tb:{required:"Isikan Tambah atau Kurang "}
      	},
	 	submitHandler: function(form) {
	         //alert ('hai');
	        var kuota=$('#kuota').val();
	        var tb=$('input[name=tb]:checked').val();
	        var user_public_id=$('#user_public_id').val();
	        $('#modaladmin').load(base_url+'index.php/admin/save_kuota_dispute/',{"kuota":kuota,"tb":tb,"user_public_id":user_public_id},function (data){
	        	$('#myModalDetailArtikel').modal('hide');
	        	
	        });
	        return false ;//alert('hat');
      	}//end of function submit_handler
	});

});
</script>
