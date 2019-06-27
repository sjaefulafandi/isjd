<div class="modal-content" >
	<form method="post" action="#" id="tarif_form">
		    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Tarif Form</b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	<div class="modal-body" style="font-size:12px">
		
		<div class="row-fluid" >
			
			<div class="row">
				<div class="col-sm-8"> Group Member
					<div class="form-group">
						<select class="form-control" id="selgroupmember" name="selgroupmember">
							<?php
							foreach ($q_group_user->result() as $r_q_group_user)
								{
							?>
								<option value="<?php echo $r_q_group_user->id_user_group;?>"><?php echo $r_q_group_user->user_group;?></option>
							<?php
								} //end of loop q_group_user
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8"> Jenis Tarif <br>
					<label class="radio-inline">
						<input type="radio" id="optjenistarif1" name="optjenistarif" data-error="#error_optjenistarif" value="platinum" required>Platinum
					</label>
					<label class="radio-inline">
						<input type="radio" id="optjenistarif2" name="optjenistarif" data-error="#error_optjenistarif" value="gold">Gold
					</label>
					<label class="radio-inline">
						<input type="radio" id="optjenistarif3" name="optjenistarif" data-error="#error_optjenistarif" value="silver">Silver
					</label>
					<label class="radio-inline">
						<input type="radio" id="optjenistarif4" name="optjenistarif" data-error="#error_optjenistarif" value="bronze">Bronze
					</label>
					<div id="error_optjenistarif"></div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-sm-4"> Harga <br>
					<input type="input" class="form-control input-sm" id="harga" name="harga" required>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4"> Konversi Download <br>
					<input type="input" class="form-control input-sm" id="konversidownload" name="konversidownload" required>
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
//$("#commentForm").validate();
$(document).ready(function(){

	$("#tarif_form").validate({
    rules: {
			optjenistarif:{required:true}
			,harga :{digits:true}
			,konversidownload:{digits:true}
  		},
  		messages :{
	 		optjenistarif:{
	 			required:"Mohon dipilih jenis tarif"
	 		},
	 		harga:{
	 			required:"Harga tarif tidak boleh kosong",
	 			digits:"Isikan Angka"
	 		},
	 		konversidownload:{
	 			required:"Konversi kuota download",
	 			digits:"Isikan Angka"
	 		}
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
	  		
        var harga=$('#harga').val();
  	    var konversidownload=$('#konversidownload').val();
        var selgroupmember=$('#selgroupmember option:selected').val();
        var optjenistarif=$('input[name=optjenistarif]:checked').val();
        
         $('#modaladmin').load(base_url+'index.php/Referensi/save_tarif/',{"harga":harga,"konversidownload":konversidownload,"selgroupmember":selgroupmember,"optjenistarif":optjenistarif},function (data){tarif();$('#myModalDetailArtikel').modal('hide');});
          
          //$('#myModalDetailArtikel').modal('hide');
          return false ;//alert('hat');
      }//end of function submit_handler
	 });

});
</script>