<div class="row-fluid" >
  <form id="user_public_submission_form" method="post" action="#">
  <div class="row">
    <div class="col-sm-12"> Form Daftar Peserta</div>
  </div>
  <div class="row">
    <div class="col-sm-8"> Nama Lengkap
      <input type="input" class="form-control input-sm" id="nama_lengkap" name="nama_lengkap" required minlength="2">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8"> Alamat
      <input type="input" class="form-control input-sm" id="alamat" name="alamat" required minlength="10">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4"> No Telephone/Handphone
      <input type="input" class="form-control input-sm" id="hp" name="hp" required minlength="7">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8"> Email
    <input type="input" class="form-control input-sm " id="emails" name="emails">
    </div>
  </div>
 
  <div class="row">
    <div class="col-sm-8"> Jenis Kelamin <br>
    <label for="jk1"></label>
    Laki-laki <input type="radio" id="jk1" name="jk" value="L" data-error="#error_jk" required >
    Perempuan <input type="radio" id="jk2" name="jk" value="P" data-error="#error_jk">
    <div id="error_jk"></div>
    </div>
  </div>
 
 <div class="row">
    <div class="col-sm-8"> Kota
    <input type="input" class="form-control input-sm " id="kota" name="kota" required >
    
    </div>
  </div>
   <div class="row">
    <div class="col-sm-8"> Institusi
    <input type="input" class="form-control input-sm " id="institusi" name="institusi" required >
    
    </div>
  </div>  
  <div class="row">
    <div class="col-sm-8"> Kelompok User
    <select id="user_groups" class="form-control input-sm">
      
      <?php
      // print_r($user_group);
      foreach ($user_group->result() as $row_user_group)
      {
        echo '<option value="'.$row_user_group->id_user_group.'">'.$row_user_group->user_group;//echo $row_user_group->user_group.'<br>';
      }
      ?>
      </select>
  
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4"> User Name
    <input type="input" id="user_name" name="user_name" class="form-control input-sm" required minlength="2" >
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4"> Password
      <input type="password" id="passwords" name="passwords" class="form-control input-sm">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4"> Re-Password
      <input type="password" id="password2" name="password2" class="form-control input-sm">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8"><br>
      <input type="submit" class="btn btn-primary btn-xs" id="btn_submit" value="Kirim">
    </div>
  </div>
</form>
</div>

<script>
//$("#commentForm").validate();
$(document).ready(function(){
	 $("#user_public_submission_form").validate({
    ignore:""
	 	,rules: {
				passwords :{
					required:true,
					minlength:5
				},
			    password2: {
			      equalTo: "#passwords"
			    },
			    emails:{
			    	required:true,
			    	email:true
			    },
          kota:{
            required:true
          },
          institusi:{
            required:true
          },
          alamat:{
            required:true,
            minlength:10
          },
          hp:{
            required:true,
            minlength:7,
            number:true
          }

  		},
  		messages :{
	 		nama_lengkap:{
	 			required:"Mohon nama lengkap anda diisi",
	 			minlength:"panjang minimal 2 karakter"
	 		},
	 		emails:"Masukkan email dengan benar",
	 		passwords:{
	 			required:"Password tidak boleh kosong",
	 			minlength:"Panjang password paling sedikit 5 karakter"
	 		},
	 		user_name:{
	 			required:"Mohon user name anda diisi",
	 			minlength:"panjang minimal 2 karakter"
	 		},
	 		password2:{
	 			equalTo:"Ketik ulang password anda"
	 		},
      alamat:{
        required:"Mohon isikan alamat anda",
        minlength:"Panjang alamat paling sedikit 10 karakter"
      },
	 		jk:{
	 			required:"Isikan jenis kelamin anda "
	 		},
      kota:{
        required:"Isikan kota anda"
      },
      kota:{
        required:"Isikan Institusi anda"
      },
      hp:{
        required:"Mohon isikan nomor yang dapat dihubungi",
        minlength:"Panjang minimal 7 angka",
        number:"Masukkan Angka dengan benar"

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
        var nama_lengkap=$('#nama_lengkap').val();
  	    var emails=$('#emails').val();
        var user_id=$('#user_name').val();
        var passwords=$('#passwords').val();
        var password2=$('#password2').val();
        var user_groups=$('#user_groups option:selected').val();
        var kota=$('#kota').val();
        var institusi=$('#institusi').val();
        
        var jk=$('input[name=jk]:checked').val();
        var alamat=$('#alamat').val();
        var hp=$('#hp').val();
         $('#infousers').load(base_url+'index.php/user_public/save_user_public/',{"nama_lengkap":nama_lengkap,"emails":emails,"user_id":user_id,"passwords":passwords,"user_groups":user_groups,"kota":kota,"institusi":institusi,"jk":jk,"alamat":alamat,"hp":hp},function (data){}); 
          return false ;//alert('hat');
      }//end of function submit_handler
	 });

	
/*
	$('#autocomplete').autocomplete({
	    serviceUrl: base_url+'index.php/user_public/show_kabupaten_kota_auto',
	    onSelect: function (suggestion) {
	        //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
	    }
	});

*/
 //$(document).ready(function() {
      $("#kota").tokenInput(base_url+'index.php/user_public/show_kabupaten_kota_auto',{
        method:"post",
        hintText: "Masukkan nama kota yang anda cari",
        noResultsText: "Data Tidak ada",
        searchingText: "proses...",
        tokenLimit: 1

      });
  //});


}); 

</script>