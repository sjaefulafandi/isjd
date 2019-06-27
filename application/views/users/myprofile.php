<div class="row-fluid col-sm-10" >
  	<form id="user_profile_form" method="post" action="#">
		 <div class="row">
		 	 Ganti Password 
		 <div class="row">
		    <div class="col-sm-4"> Password Lama
		          <input type="input" class="form-control input-sm" id="password_lama" value="<?php echo $password_lama;?>" name="password_lama" required minlength="2">
		    </div>
		    <div class="col-sm-4"> Password Baru
		      <input type="input" class="form-control input-sm" id="password_baru" value="<?php echo $password_baru;?>" name="password_baru" required minlength="2">
		    </div>
		    <div class="col-sm-2"> <br>
		      <input type="submit" class="btn btn-primary btn-xs" id="btn_submit" value="Ubah">
		    </div>
		  </div>

	</form>
</div>
<div class="row-fluid" >
	<?php 	if ($password_baru!='' and $sukses=='not ok'){	?>
		<div class="col-sm-12 alert alert-warning">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Maaf , coba kembali isikan password lama anda dengan benar </strong>
			</div>
		</div>
	<?php } //end else if , for check user login and password?>
	<?php 	if ($password_baru!='' and $sukses=='ok'){	?>
		<div class="col-sm-12 alert alert-warning">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Password Anda berhasil di ubah </strong>
			</div>
		</div>
	<?php } //end else if , for check user login and password?>

</div>
<script>
	
$(document).ready(function(){
	 $("#user_profile_form").validate({
    	ignore:""
	 	,rules: {
				password_lama :{
					required:true,
					minlength:2
					},
			    password_baru :{
					required:true,
					minlength:2
					}
  				}//end of rules
  		,messages :{
	 		password_lama:{
	 			required:"Password tidak boleh kosong",
	 			minlength:"Panjang password paling sedikit 2 karakter"
	 			},
	 		password_baru:{
	 			required:"Password tidak boleh kosong",
	 			minlength:"Panjang password paling sedikit 2 karakter"
	 			}

	 		} // end of messages
	 	,errorPlacement: function(error, element) {
	      	var placement = $(element).data('error');
		      if (placement) {
		        $(placement).append(error)
		      } else {
		        error.insertAfter(element);
		      }
	    	}// end of error
	  	,submitHandler: function(form) {
        	var password_lama=$('#password_lama').val();
        	var password_baru=$('#password_baru').val();

         	$('#dProfile').load(base_url+'index.php/user_public/user_change_password/',{"password_lama":password_lama,"password_baru":password_baru},function (data){}); 
          	return false ;//alert('hat');
      		}//end of function submit_handler
	 });
}); 
</script>
