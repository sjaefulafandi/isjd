<script type="text/javascript">

function close_to_logout(){

	 $('#myModalDetailArtikel').modal('hide');
	 window.location=base_url+'index.php/public_no_login/public_logout';
}
</script>
<div class="modal-content">
		    
	<div class="modal-header">
		<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Waktu Sesi Penggunaan Aplikasi</b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	<div class="modal-body">
		<div class="form-group form-group-sm" id="user_public_submission_form" role="form" >
	
			<div class="row">
				<div class="col-sm-10"> Mohon maaf batasan waktu sesi anda untuk aplikasi ini telah habis, 
					anda dapat melanjutkan sesi anda dengan menekan tombol berikut.
					<button type="button" class="btn btn-default btn-xs" onclick="close_to_logout()" data-dismiss="modal">Keluar</button>

				</div>
			</div>
		</div>	
	</div>
	<div class="row-fluid modal-footer">
	 			      
	</div>
</div>
