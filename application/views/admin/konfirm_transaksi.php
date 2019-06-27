<div class="modal-content">
	<form method="post" action="#" enctype="multipart/form-data" id="kuota_form">
		    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Persetujuan Transaksi</b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	
	<div class="modal-body">
		Apakah Transaksi ini sudah sesuai ???
		
	</div>
	<div class="row-fluid modal-footer">
		<button class="btn btn-default btn-xs" type="button" onclick="savetransaksi(<?php echo $id_user_public_quota;?>)" >Save & Close</button>
	 	<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Cancel & Close </button>
			      
	</div>
	</form>
</div>
<script >
	function savetransaksi(id_user_public_quota){

			 $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin/save_transaksi_detail/'+id_user_public_quota,{"id_user_public_quota":id_user_public_quota},function (data){
          	$('#myModalDetailArtikel').modal('hide');
          	});

		

	}
</script>