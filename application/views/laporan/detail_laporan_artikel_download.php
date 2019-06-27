
<script>
function get_xls_artikel_download(tanggal_start,tanggal_end){
	//alert(tanggal_end);

	var form = document.createElement("form");
	form.setAttribute("method", "post");
	form.setAttribute("action", base_url+"index.php/admin/get_xls_artikel_download");

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
	<a href="#" onclick="get_xls_artikel_download('<?php echo $range_tanggal[0];?>','<?php echo $range_tanggal[1];?>')" >
			<i class="fa fa-file-excel-o fa-fw"></i> Export </a></li>
			<div id="debug"></div>
		</a>
</div>
<div class="row-fluid">

	<table class="table table-bordered table-hover table-striped">
		<thead >
			<th>No</th>
			<th>Artikel</th>
			<th>Jumlah Download</th>
			<th>Jumlah Baca</th>
			<th>Sub Total</th>
		</thead>
		<tbody>
		<?php
		$no=1;
		$total_download=0;
		$total_baca=0;
		$total=0;
		foreach ($q_jum_download->result() as $row_q_jum_download){
			$sub_total=0;
			echo '<tr>';
		        echo '<td>'.$no.'</td>';
		        //echo '<td>'.$row_q_jum_download->tanggal.'</td>';
		        echo '<td>'.$row_q_jum_download->title.'</td>';
		        echo '<td align="right">'.$row_q_jum_download->jum_download.'</td>';
		        echo '<td align="right">'.$row_q_jum_download->jum_baca.'</td>';
		    	$sub_total=$row_q_jum_download->jum_download+$row_q_jum_download->jum_baca;
		    	echo '<td align="right">'.$sub_total.'</td>';
		    echo '</tr>';

	    $no++;
	    $total_download=$total_download+ $row_q_jum_download->jum_download;
	    $total_baca=$total_baca+ $row_q_jum_download->jum_baca;
	    $total=$total+$sub_total;

	   }

		?>
		<tr>
				<td colspan="2">Total</td>
				<td align="right"><?php echo number_format($total_download);?></td>
				<td align="right"><?php echo number_format($total_baca);?></td>
				<td align="right"><?php echo number_format($total);?></td>

		</tr>
		</tbody>
	</table>
</div>	
