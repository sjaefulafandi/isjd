<script type="text/javascript">
function tarif_form(){
	$('#modaladmin').load(base_url+'index.php/Referensi/show_tarif_form/',{},function (data){
	});
}
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Kota</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div>
	<a href="#" data-toggle="modal" onclick="tambah_kota();" data-target="#myModalDetailArtikel">
			<i class="fa fa-plus fa-fw"></i> Kota </a></li>
		</a>
</div>
<div class="row">

	<table class="table table-bordered table-hover table-striped">
		<thead>
			<th>No</th>
			<th>Nama Kota</th>
		</thead>
		<tbody>
		<?php
		$no=1;
		foreach ($q_kota->result() as $r_q_kota){

			echo '<tr>';
		        echo '<td width="10">'.$no.'</td>';
		        echo '<td>'.$r_q_kota->kabupaten_kota.'</td>';
		       
	        echo '</tr>';
	    $no++;
		}

		?>
		</tbody>
	</table>
</div>	
