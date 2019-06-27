
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data User</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div>
	<a href="#myModalDetailArtikel" data-toggle="modal"  onclick="loaddownload('userall');">
			<i class="fa fa-file-excel-o fa-fw"></i> Export </a></li>
			<div id="debug"></div>
		</a>
</div>
<div class="row">

	<table class="table table-bordered table-hover table-striped">
		<thead>
			<th>No</th>
			<th>Nama Lengkap</th>
			<th>User Id</th>
			<th>Jenis Kelamin</th>
			<th>Kota</th>
			<th>HP</th>
			<th>Group User</th>
			<th>Tanggal Registrasi</th>
			<th>Tanggal Disetujui</th>
			<th>Disetujui Oleh</th>
			<th>Kuota</th>

		</thead>
		<tbody>
		<?php
		$no=1;
		foreach ($q_user_public->result() as $row_user_public){

			echo '<tr>';
		        echo '<td>'.$no.'</td>';
		        echo '<td>'.$row_user_public->user_public_name.'</td>';
		        echo '<td>'.$row_user_public->user_public_id.'</td>';
		        echo '<td>'.$row_user_public->jenis_kelamin.'</td>';
		        echo '<td>'.$row_user_public->kabupaten_kota.'</td>';
		        echo '<td>'.$row_user_public->hp.'</td>';
		        echo '<td>'.$row_user_public->user_group.'</td>';
		        echo '<td>'.$row_user_public->user_public_date_register.'</td>';
		        echo '<td>'.$row_user_public->user_public_date_approve.'</td>';
		        echo '<td>'.$row_user_public->user_public_approve_by.'</td>';
		        echo "<td>".$row_user_public->saldo_quota_download;
		        echo ' &nbsp; <a href="#" data-toggle="modal" onclick="add_quota_stock(\''.$row_user_public->user_public_id.'\')" data-target="#myModalDetailArtikel"><i class="fa fa-plus"></i>  ';
		        echo '/ &nbsp;<i class="fa fa-minus"></i> </a>';
		        echo "</td>";
	        echo '</tr>';
	    $no++;
		}

		?>
		</tbody>
	</table>
</div>	
<script>
	function add_quota_stock(user_public_id){
		$('.divmask').show();
		$('#modaladmin').empty();
		$('#modaladmin').load(base_url+'index.php/admin/add_quota_dispute_form/'+user_public_id,{},function (data){
			$('.divmask').hide();
			});
	}
</script>