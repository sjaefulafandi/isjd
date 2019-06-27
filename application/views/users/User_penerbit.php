<?php
if ($sukses=='ok'){
?>
<script type="text/javascript">

	$(document).ready(function(){
		activaTab('pdashboard');
		loadpanel('pdashboard');
	});
	

</script>
	<br>
	<div class="row-fluid">
		<div class="col-sm-6">
			Selamat Datang Penerbit <?php echo $this->session->userdata('user_name');?><br>
			Untuk logout klik <a href="<?php echo base_url().'index.php/user_public/log_out_user_public';?>"> logout </a><br>
			<!-- group user anda adalah <?php echo $this->session->userdata('user_group');?> -->
			
		</div>
		<div class="col-sm-6">
			<ul class="nav nav-tabs">
				<li ><a href="#pdashboard" data-toggle="tab" onclick="activaTab('pdashboard');loadpanel('pdashboard');" > <i class="fa fa-file fa-fw"></i> Dashboard</a></li>
			    <li ><a href="#pdata" data-toggle="tab" onclick="activaTab('pdata');loadpanel('pdata');"> <i class="fa fa-search fa-fw"></i> Subjek</a></li>
			    <li ><a href="#pdatabidang" data-toggle="tab" onclick="activaTab('pdatabidang');loadpanel('pdatabidang');"> <i class="fa fa-cube fa-fw"></i> Bidang</a></li>
			    <li ><a href="#pdatasubjek" data-toggle="tab" onclick="activaTab('pdatasubjek');loadpanel('pdatasubjek');"> <i class="fa fa-bar-chart-o fa-fw"></i> Report</a></li>
			    <li ><a href="#pdataprofil" data-toggle="tab" onclick="activaTab('pdataprofil');loadpanel('pdataprofil');"> <i class="fa fa-user fa-fw"></i> Profil</a></li>
			</ul>
			<div class="tab-content" id="tabs">
				<div class="tab-pane" id="pdashboard" name="pdashboard"></div>
			    <div class="tab-pane" id="pdata" name="pdata"></div>
			    <div class="tab-pane" id="pdatabidang" name="pdatabidang"></div>
			    <div class="tab-pane" id="pdatasubjek" name="pdatasubjek"></div>
			    <div class="tab-pane" id="pdataprofil" name="pdataprofil"></div>
			    
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