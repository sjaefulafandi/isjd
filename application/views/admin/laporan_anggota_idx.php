
<script>
$(document).ready(function() {
	activaTabAdmin('la_anggota_per_group');
	loadpaneladmin('la_anggota_per_group');

	});
</script>

<div class="row-fluid col-lg-12">
	        <h1 >Laporan Anggota</h1>
</div>

<div class="row-fluid col-lg-12">
		<ul class="nav nav-tabs">
			<li ><a href="#la_anggota_per_group" data-toggle="tab" onclick="activaTabAdmin('la_anggota_per_group');loadpaneladmin('la_anggota_per_group');"> <i class="fa fa-plus fa-fw"></i> Register</a></li>
			<li ><a href="#la_kuota_per_group" data-toggle="tab" onclick="activaTabAdmin('la_kuota_per_group');loadpaneladmin('la_kuota_per_group');"> <i class="fa fa-money fa-fw"></i> Transaksi</a></li>
			<li ><a href="#la_download_per_group" data-toggle="tab" onclick="activaTabAdmin('la_download_per_group');loadpaneladmin('la_download_per_group');"> <i class="fa fa-download fa-fw"></i> Download</a></li>
			<li ><a href="#la_kota_per_group" data-toggle="tab" onclick="activaTabAdmin('la_kota_per_group');loadpaneladmin('la_kota_per_group');"> <i class="fa fa-map-marker fa-fw"></i> Kota</a></li>
			<li ><a href="#la_user_pasif" data-toggle="tab" onclick="activaTabAdmin('la_user_pasif');loadpaneladmin('la_user_pasif');"> <i class="fa fa-user fa-fw"></i> Pasif </a></li>

			<!--- <li ><a href="#la_gender_per_group" data-toggle="tab" onclick="activaTabAdmin('la_gender_per_group');loadpaneladmin('la_gender_per_group');"> <i class="fa fa-female fa-fw"></i><i class="fa fa-male fa-fw"></i> Gender</a></li> -->
		</ul>
		<div class="tab-content" id="tabs">
			<div class="tab-pane" id="la_anggota_per_group" name="la_anggota_per_group"></div>
			<div class="tab-pane" id="la_kuota_per_group" name="la_kuota_per_group"></div>
			<div class="tab-pane" id="la_download_per_group" name="la_download_per_group"></div>
			<div class="tab-pane" id="la_kota_per_group" name="la_kota_per_group"></div>
			<div class="tab-pane" id="la_user_pasif" name="la_user_pasif"></div>
			<!--- <div class="tab-pane" id="la_gender_per_group" name="la_gender_per_group"></div> -->

		</div>
</div>

  