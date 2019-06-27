<div class="modal-content" >
	<form method="post" action="#" id="kota_format">
		    
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<i class="fa fa-quote-left fa-fw"></i> 
			<b>Kota Form</b>
			<i class="fa fa-quote-right fa-fw"></i> 
		</div>
		<div class="modal-body" style="font-size:12px">
			<div class="row-fluid" >
				<div class="row">
					<div class="col-sm-8"> Nama Kota <br>
						<input type="input" class="form-control input-sm" id="nama_kota" name="nama_kota" required>
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

	$("#kota_format").validate({
    	rules: {
			nama_kota:{required:true}
  		},
  		messages :{
	 		nama_kota:{required:"Isikan Nama Kota"}
      	},
	  	submitHandler: function(form) {
	  	var nama_kota=$('#nama_kota').val();
  	    	
	  	$("#modaladmin").load(base_url+'index.php/Referensi/save_kota_data/',{"nama_kota":nama_kota},function (data){kota();$('#myModalDetailArtikel').modal('hide');});
		 return false ;	          
     	}//end of function submit_handler
	 });

});
</script>