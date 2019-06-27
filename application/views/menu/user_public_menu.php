<script type="text/javascript">
	$(document).ready(function() {
		$('#panel').load(base_url+'index.php/user_public/check_user_public',{},function (data){});	
		});
	function masuk(){
		var user_public_id=$('#user_public_id').val();
		var password=$('#password').val();
		var jenis_user=$('input[name=jenis_user]:checked').val();

		$('#panel').empty;
		$('#panel').load(base_url+'index.php/user_public/check_user_public',{"user_public_id":user_public_id,"password":password,"jenis_user":jenis_user},function (data){});
		
	}
	  function masuk_paksa(){
		var user_public_id=$('#user_public_id_paksa').val();
		var password=$('#password_paksa').val();
		var jenis_user=$('input[name=j_user_paksa]:checked').val();

		$('#panel_paksa').empty;
		$('#panel_paksa').load(base_url+'index.php/user_public/check_user_public',{"user_public_id":user_public_id,"password":password,"jenis_user":jenis_user},function (data){});
		
	}
</script>

<i class="fa fa-home fa-fw"></i> <a href="<?php echo base_url();?>">ISJD </a>&nbsp;&nbsp;|
&nbsp;&nbsp;<i class="fa fa-database fa-fw"></i><a href="http://issn.pdii.lipi.go.id/">ISSN On Line </a>&nbsp;&nbsp;|
&nbsp;&nbsp;<i class="fa fa-folder-open fa-fw"></i><a href="<?php echo base_url();?>index.php/public_no_login/index_direktori">Direktori </a>&nbsp;&nbsp;|
<!--- &nbsp;&nbsp;<i class="fa fa-bookmark-o fa-fw"></i><a href="http://jurnal.pdii.lipi.go.id/index.php/Akreditasi-Online.html">Akreditasi </a>&nbsp;&nbsp;|
&nbsp;&nbsp;<i class="fa fa-flask fa-fw"></i><a href="http://jurnal.pdii.lipi.go.id/index.php/DSS-Jurnal.html">DSS Jurnal </a>&nbsp;&nbsp;|
&nbsp;&nbsp;<i class="fa fa-book fa-fw"></i><a href="http://jurnal.pdii.lipi.go.id/index.php/Thesaurus-Online.html">Thesaurus Online </a>&nbsp;&nbsp;|
&nbsp;&nbsp;<i class="fa fa-sort-numeric-asc fa-fw"></i><a href="http://jurnal.pdii.lipi.go.id/index.php/Sitasi-Indeks.html">Sitasi Index </a>&nbsp;&nbsp;| 
&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i> Anggota Baru ( <?php echo $jum_user_public_baru;?> )&nbsp;&nbsp;|
<a class="btn-slide" ><span class="fa fa-angle-right"></span>&nbsp;&nbsp;<i class="fa fa-user fa-fwd text-right"></i> Log In </a> -->

<div class="row-fluid" >
	<div id="panel" >
		<div class="row-fluid" >
			<div class="col-sm-4" id="loginpart" >
				<br>
				 <div class="well form-group" style="height:150px">
				Silahkan anda Sign In :<br> 
					Publik <input type="radio" id="j_user1" name="j_user" value="publik" checked >
    				Penerbit <input type="radio" id="j_user2" name="j_user" value="penerbit" >

							<input type="text" id="user_public_id" class="form-control input-sm" size="35" placeholder="Id User"> 
							<input type="password" id="password"  class="form-control input-sm" size="35" placeholder="Password"> 
							<button onclick="masuk();" class="btn btn-primary btn-xs" type="button">Sign In</button>
				 , Jika ingin <a href="#" onclick="loadformdaftar()">mendaftar (publik)</a>
				 <!-- <br> Lupa Password Anda ?? -->			
				</div>
			</div>
				<br>
			<div class="col-sm-8" >
				<div id="infousers" class="well" style="height:auto">
					Keuntungan dengan mendaftar :
					<ul>
						<li> Dengan mendaftar and akan mendapat kesempatan untuk dapat mengunduh (download)
							artikel-artikel yang ada dalam database kami </li>
						<li> Anda dapat menambahkan kuota download anda</li>
						<li> Anda dapat melihat artikel yang pernah anda cari ataupun download</li>
					</ul>
				</div>
			</div>
		</div>
	</div> <!-- end of div panel -->
</div>
		