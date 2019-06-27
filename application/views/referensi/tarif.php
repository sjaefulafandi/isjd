<script type="text/javascript">
function tarif_form(){
	$('#modaladmin').load(base_url+'index.php/Referensi/show_tarif_form/',{},function (data){
	});
}
</script>
<div class="row-fluid">

	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">Tarif Download Dokumen</h1>
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<div class="row-fluid" align="right">
		<a href="#" data-toggle="modal" onclick="tarif_form();" data-target="#myModalDetailArtikel">
			<i class="fa fa-plus fa-fw"></i> Tarif Aktif </a></li>
		</a>
	</div>

	<table class="table table-bordered table-hover table-striped">
		<thead>
			<th>No</th>
			<th>Group User</th>
			<th>Jenis Tarif</th>
			<th>Harga</th>
			<th>Download</th>
			<th>Tanggal</th>
			<th>Status</th>
		
		</thead>
		<?php
		$no=1; 
		foreach ($q_tarif_download_aktif->result() as $r_q_tarif_download_aktif)
		{

			echo "<tr>";
				echo "<td>".$no."</td>";
				echo "<td>".$r_q_tarif_download_aktif->user_group."</td>";
				echo "<td align=\"center\">".$r_q_tarif_download_aktif->jenis_tarif."</td>";
				echo "<td align=\"right\">".number_format($r_q_tarif_download_aktif->harga)."</td>";
				echo "<td align=\"right\">".$r_q_tarif_download_aktif->harga_to_download."</td>";
				echo "<td align=\"right\">".$r_q_tarif_download_aktif->tanggal_update."</td>";
				echo "<td>".$r_q_tarif_download_aktif->status_tarif."</td>";
			echo "</tr>";
		$no++;
		}
		?>
	</table>
</div>
<div>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">Tarif (Non Aktif) Download Dokumen</h1>
	    </div>
	    <!-- /.col-lg-12 -->
	</div>


	<table class="table table-bordered table-hover table-striped">
		<thead>
			<th>No</th>
			<th>Group User</th>
			<th>Jenis Tarif</th>
			<th>Harga</th>
			<th>Download</th>
			<th>Tanggal</th>
			<th>Status</th>
		
		</thead>
		<?php
		$no=1; 
		foreach ($q_tarif_download_non_aktif->result() as $r_q_tarif_download_non_aktif)
		{

			echo "<tr>";
				echo "<td>".$no."</td>";
				echo "<td>".$r_q_tarif_download_non_aktif->user_group."</td>";
				echo "<td>".$r_q_tarif_download_non_aktif->jenis_tarif."</td>";
				echo "<td>".$r_q_tarif_download_non_aktif->harga."</td>";
				echo "<td>".$r_q_tarif_download_non_aktif->harga_to_download."</td>";
				echo "<td>".$r_q_tarif_download_non_aktif->tanggal_update."</td>";
				echo "<td>".$r_q_tarif_download_non_aktif->status_tarif."</td>";
			echo "</tr>";
		$no++;
		}
		?>
	</table>	
</div>	