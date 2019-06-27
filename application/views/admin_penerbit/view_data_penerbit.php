
<script>
function get_xls_penerbit_download_link(tanggal_start,tanggal_end){
	//alert(tanggal_end);

	var form = document.createElement("form");
	form.setAttribute("method", "post");
	form.setAttribute("action", base_url+"index.php/admin_penerbit/get_xls_download");

	form.setAttribute("target", "view");

	var hiddenField = document.createElement("input"); 
	hiddenField.setAttribute("type", "hidden");
	hiddenField.setAttribute("name", "tanggal_start");
	hiddenField.setAttribute("value", tanggal_start);
	form.appendChild(hiddenField);
	document.body.appendChild(form);

	var hiddenField2 = document.createElement("input"); 
	hiddenField2.setAttribute("type", "hidden");
	hiddenField2.setAttribute("name", "tanggal_end");
	hiddenField2.setAttribute("value", tanggal_end);
	form.appendChild(hiddenField2);
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
	<a href="#" onclick="get_xls_penerbit_download_link('<?php echo $range_tanggal[0];?>','<?php echo $range_tanggal[1];?>')" >
			<i class="fa fa-file-excel-o fa-fw"></i> Export </a></li>
			<div id="debug"></div>
		</a>
</div>
<div class="row-fluid">

	<table class="table table-bordered table-hover table-striped">
		<thead >
			<th>No</th>
			<th>Judul Direktori</th>
			<th>User</th>
			<th>Jumlah Download</th>
		</thead>
		<tbody>
		<?php
		$no=1;
		$total_download=0;
		$total_kuota=0;
		foreach ($q_jum_download->result() as $row_q_jum_download){

			echo '<tr>';
		        echo '<td>'.$no.'</td>';
		        echo '<td>'.$row_q_jum_download->tanggal.'</td>';
		        echo '<td>'.$row_q_jum_download->user_public_id.'</td>';
		        echo '<td align="right">'.$row_q_jum_download->jum_download.'</td>';
		    echo '</tr>';
	    $no++;
	    $total_download=$total_download+ $row_q_jum_download->jum_download;
	   }

		?>
		<tr>
				<td colspan="3">Total</td>
				<td align="right"><?php echo number_format($total_download);?></td>
		</tr>
		</tbody>
	</table>
</div>	
