
<script>
function get_xls_laporan_anggota_link(tanggal_start,tanggal_end,group_user,group_user_text){
	//alert(tanggal_end);
	//alert('hai');
	var form = document.createElement("form");
	form.setAttribute("method", "post");
	form.setAttribute("action", base_url+"index.php/admin/get_xls_laporan_anggota");

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

	var hiddenField3 = document.createElement("input"); 
	hiddenField3.setAttribute("type", "hidden");
	hiddenField3.setAttribute("name", "group_user");
	hiddenField3.setAttribute("value", group_user);
	form.appendChild(hiddenField3);
	document.body.appendChild(form);

	var hiddenField4 = document.createElement("input"); 
	hiddenField3.setAttribute("type", "hidden");
	hiddenField3.setAttribute("name", "group_user_text");
	hiddenField3.setAttribute("value", group_user_text);
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
	<a href="#" onclick="get_xls_laporan_anggota_link('<?php echo $range_tanggal[0];?>','<?php echo $range_tanggal[1];?>','<?php echo $group_user;?>','<?php echo $group_user_text;?>')" >
			<i class="fa fa-file-excel-o fa-fw"></i> Exports </a></li>
			<div id="debug"></div>
		</a>
</div>
<div class="row-fluid">

	<table class="table table-bordered table-hover table-striped">
		<thead>
			<th>No</th>
			<th>Tanggal Register</th>
			<th>Jumlah Laki</th>
			<th>Jumlah Perempuan</th>
			<th>Sub Total</th>
		</thead>
		<tbody>
		<?php
		$no=1;
		$total_kuota_laki=0;
		$total_kuota_perempuan=0;
		$total=0;
		foreach ($q_kuota_transfer->result() as $row_kuota_transfer){
		$sub_total=0;
			echo '<tr>';
		        echo '<td width="5">'.$no.'</td>';
		        echo '<td>'.$row_kuota_transfer->tanggal.'</td>';
		        echo '<td align="right">'.number_format($row_kuota_transfer->jum_user_public_laki).'</td>';
		$sub_total=$row_kuota_transfer->jum_user_public_laki+$row_kuota_transfer->jum_user_public_perempuan;
		        echo '<td align="right">'.number_format($row_kuota_transfer->jum_user_public_perempuan).'</td>';
		        echo '<td align="right">'.$sub_total.'</td>';
		    echo '</tr>';
	    $no++;
	    $total_kuota_laki=$total_kuota_laki+$row_kuota_transfer->jum_user_public_laki;
	    $total_kuota_perempuan=$total_kuota_perempuan+$row_kuota_transfer->jum_user_public_perempuan;
	    $total=$total+$sub_total;
		}

		?>
		<tr>
				<td colspan="2">Total</td>
				<td align="right"><?php echo number_format($total_kuota_laki);?></td>
				<td align="right"><?php echo number_format($total_kuota_perempuan);?></td>
				<td align="right"><?php echo number_format($total);?></td>
		</tr>
		</tbody>
	</table>
</div>	
