<?php
if ($sukses=='ok'){
?>
<script type="text/javascript">
	
	$(document).ready(function(){
		activaTab('dInformasi');
		loadpanel('dInformasi');
	});
	

</script>

	<br>
	<div class="row-fluid">
		<div class="col-sm-6">
			Selamat Datang <?php echo $this->session->userdata('user_name');?><br>
			Untuk logout klik <a href="<?php echo base_url().'index.php/user_public/log_out_user_public';?>"> logout </a><br>
			<!-- group user anda adalah <?php echo $this->session->userdata('user_group');?> -->
			
		</div>
		<div class="col-sm-6">
			<ul class="nav nav-tabs">
				<li ><a href="#dInformasi" data-toggle="tab" onclick="activaTab('dInformasi');loadpanel('dInformasi');"> <i class="fa fa-file fa-fw"></i> Info Tarif</a></li>
			    <li ><a href="#dPembayaran" data-toggle="tab" onclick="activaTab('dPembayaran');loadpanel('dPembayaran');"> <i class="fa fa-download fa-fw"></i> Kuota</a></li>
			    <li><a href="#dRekamjejak" data-toggle="tab" onclick="activaTab('dRekamjejak');loadpanel('dRekamjejak');"> <i class="fa fa-pencil fa-fw"></i>Rekam Jejak</a></li>
			    <li><a href="#dKomplain" data-toggle="tab" onclick="activaTab('dKomplain');loadpanel('dKomplain');"> <i class="fa fa-comment-o fa-fw"></i>Komplain</a></li>
				<li><a href="#dProfile" data-toggle="tab" onclick="activaTab('dProfile');loadpanel('dProfile');"> <i class="fa fa-user fa-fw"></i>Profil</a></li>

			</ul>
			<div class="tab-content" id="tabs">
				<div class="tab-pane" id="dInformasi" name="dInformasi"></div>
			    <div class="tab-pane" id="dPembayaran" name="dPembayaran"></div>
			    <div class="tab-pane" id="dRekamjejak" name="dRekamjejak"> </div>
			    <div class="tab-pane" id="dKomplain" name="dKomplain"> </div>
			    <div class="tab-pane" id="dProfile" name="dProfile"> </div>
			</div>
		</div>
	</div>
	<br><br><br><br><br><br>
	
<?php } // end of else , check sukses 
else{ 
?>
<div class="row-fluid" >
	
<div class="row-fluid" >
	<div class="col-sm-4" id="loginpart" >
		<br>
		 <div class="well form-group" style="height:150px">
		Silahkan anda Sign In  Publik :<br>  

		Publik <input type="radio" id="jenis_user1" name="jenis_user" value="publik" checked >
    	Penerbit <input type="radio" id="jenis_user2" name="jenis_user" value="penerbit" >

					<input type="text" id="user_public_id" class="form-control input-sm" size="35" placeholder="Id User"> 
					<input type="password" id="password"  class="form-control input-sm" size="35" placeholder="Password"> 
					<button onclick="masuk();" class="btn btn-primary btn-xs" type="button">Sign In</button>
		 , Jika ingin <a href="#" onclick="loadformdaftar()">mendaftar</a>
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
<?php } // end of check user?>

<div class="row-fluid" >
	<?php 
//echo $user_public_id.'/.//'.$sukses;

	if ($user_public_id!='' and $sukses=='not ok'){

		?>
		<div class="col-sm-12 alert alert-warning">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Maaf , coba kembali isikan user id/password dengan benar </strong>
			</div>
		</div>
	<?php } //end else if , for check user login and password?>
</div>