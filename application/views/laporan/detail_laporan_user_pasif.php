
<script>
function get_xls_user_pasif(group_user,group_user_text){
	//alert(tanggal_end);

	var form = document.createElement("form");
	form.setAttribute("method", "post");
	form.setAttribute("action", base_url+"index.php/admin/get_xls_user_pasif");

	form.setAttribute("target", "view");

	var hiddenField3 = document.createElement("input"); 
	hiddenField3.setAttribute("type", "hidden");
	hiddenField3.setAttribute("name", "group_user");
	hiddenField3.setAttribute("value", group_user);
	form.appendChild(hiddenField3);
	document.body.appendChild(form);

	var hiddenField4 = document.createElement("input"); 
	hiddenField4.setAttribute("type", "hidden");
	hiddenField4.setAttribute("name", "group_user_text");
	hiddenField4.setAttribute("value", group_user_text);
	form.appendChild(hiddenField4);
	document.body.appendChild(form);
	window.open('', 'view');

	form.submit();

	//window.open(base_url+'index.php/admin/get_xls_kuota','TheWindow');
	//window.open('', 'TheWindow');
	//document.getElementById('TheForm').submit();
	//$('#debug').load(base_url+'index.php/admin/get_xls_kuota/',{"tanggal_start":tanggal_start,"tanggal_end":tanggal_end},function (data){
	//		});
}
</script>

<div>
	<a href="#" onclick="get_xls_user_pasif('<?php echo $group_user;?>','<?php echo $group_user_text;?>')" >
			<i class="fa fa-file-excel-o fa-fw"></i> Exports </a></li>
			<div id="debug"></div>
		</a>
</div>
<div class="row-fluid">

	<table class="table table-bordered table-hover table-striped">
		<thead >
			<th>No</th>
			<th>User Id</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>email</th>
			<th>Tanggal Persetujuan</th>
		</thead>
		<tbody>
		<?php
		$no=1;
		$total_nominal=0;
		$total_kuota=0;
		foreach ($q_kuota_transfer->result() as $row_kuota_transfer){

			echo '<tr>';
		        echo '<td>'.$no.'</td>';
		        echo '<td>'.$row_kuota_transfer->user_public_id.'</td>';
		        echo '<td>'.$row_kuota_transfer->user_public_name.'</td>';
		        echo '<td>'.$row_kuota_transfer->alamat.'</td>';
	            echo '<td>'.$row_kuota_transfer->emails.'</td>';
	            echo '<td>'.$row_kuota_transfer->date_approval_convert.'</td>';

		    echo '</tr>';
	    $no++;
	    }

		?>
		</tbody>
	</table>
</div>	
