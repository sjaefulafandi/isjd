<div class="modal-content" >
	<form method="post" action="#" id="penerbit_format">
		    
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<i class="fa fa-quote-left fa-fw"></i> 
			<b>Penerbit Form</b>
			<i class="fa fa-quote-right fa-fw"></i> 
		</div>
		<div class="modal-body" style="font-size:12px">
			<div class="row-fluid" >
				<div class="row">
					<div class="col-sm-8"> Nama Penerbit<br>
						<input type="input" class="form-control input-sm" id="nama_penerbit" name="nama_penerbit" required>
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

	$("#penerbit_format").validate({
    	rules: {
			nama_penerbit:{required:true}
  		},
  		messages :{
	 		nama_penerbit:{required:"Isikan Nama Penerbit"}
      	},
	  	submitHandler: function(form) {
	  	var nama_penerbit=$('#nama_penerbit').val();
  	    	
	  	$("#modaladmin").load(base_url+'index.php/Referensi/save_penerbit_data/',{"nama_penerbit":nama_penerbit},function (data){refpenerbit();$('#myModalDetailArtikel').modal('hide');});
		 return false ;	          
     	}//end of function submit_handler
	 });

});
</script>