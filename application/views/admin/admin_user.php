<script type="text/javascript">
function approval_user(user_id_to_approve){
	$('#approval_act'+user_id_to_approve).load(base_url+'index.php/admin/approve_user_baru/'+user_id_to_approve,{},function (data){
	});
	//controller admin 112
}
</script>

<script type="text/javascript">
function not_approval_user(user_id_to_approve){
	$('#approval_act'+user_id_to_approve).load(base_url+'index.php/admin/not_approve_user_baru/'+user_id_to_approve,{},function (data){
	});
}
</script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data User Baru</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>No</th>
		<th>Nama Lengkap</th>
		<th>User Id</th>
		<th>Jenis Kelamin</th>
		<th>Kota</th>
		<th>Tanggal Registrasi</th>
		<th>Persetujuan</th>
	</thead>
	<tbody>
	<?php
	$no=1;
	foreach ($q_user_baru->result() as $row_user_baru){

		echo '<tr>';
	        echo '<td>'.$no.'</td>';
	        echo '<td>'.$row_user_baru->user_public_name.'</td>';
	        echo '<td>'.$row_user_baru->user_public_id.'</td>';
	        echo '<td>'.$row_user_baru->jenis_kelamin.'</td>';
	        echo '<td>'.$row_user_baru->kabupaten_kota.'</td>';
	        echo '<td>'.$row_user_baru->user_public_date_register.'</td>';
	        echo "<td id=\"approval_act".$row_user_baru->user_public_number."\">
	        	<button onclick=\"approval_user('".$row_user_baru->user_public_number."')\" class=\"btn btn-default\" type=\"button\">
	        	Ya ?
	        	</button> 
				<button onclick=\"not_approval_user('".$row_user_baru->user_public_number."')\" class=\"btn btn-default\" type=\"button\">
	        	Tidak ?
	        	</button> 
	        </td>"; 
			
        echo '</tr>';
    $no++;
	}

	?>
	