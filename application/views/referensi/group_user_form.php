<div class="modal-content" >
	<form method="post" action="#" id="group_user_format">
		    
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<i class="fa fa-quote-left fa-fw"></i> 
			<b>Group User Form</b>
			<i class="fa fa-quote-right fa-fw"></i> 
		</div>
		<div class="modal-body" style="font-size:12px">
			<div class="row-fluid" >
				<div class="row">
					<div class="col-sm-8"> Nama Group User <br>
						<input type="input" class="form-control input-sm" id="nama_group_user" name="nama_group_user" required>
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
<script>
$(document).ready(function(){

	$("#group_user_format").validate({
    	rules: {
			nama_group_user:{required:true}
  		},
  		messages :{
	 		nama_group_user:{required:"Isikan Nama Group User"}
      	},
	  	submitHandler: function(form) {
	  	var nama_group_user=$('#nama_group_user').val();
  	    	
	  	$("#modaladmin").load(base_url+'index.php/Referensi/save_group_user_data/',{"nama_group_user":nama_group_user},function (data){groupuser();$('#myModalDetailArtikel').modal('hide');});
		 return false ;	          
     	}//end of function submit_handler
	 });

});
</script>