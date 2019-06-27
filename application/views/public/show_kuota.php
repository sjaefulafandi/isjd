
<!-- <div class="row-fluid" align="right">
	<a href="#" data-toggle="modal" onclick="add_kuota_form();" data-target="#myModalDetailArtikel">
		<i class="fa fa-plus fa-fw"></i> Kuota</a></li>
	</a>
</div>
-->	
Kuota [ Terpakai / Total ] : <?php echo $jum_used_kuota;?>
<div class="row-fluid">
<table width="100%">
	<thead>
		<th>Jenis Kuota</th>
		<th>Nominal</th>
		<th>Tanggal</th>
		<th>Kuota</th>
		<th>Tanggal Persetujuan</th>

	</thead>
	<tbody>
<?php
	
	foreach ($query_kuota->result() as $row_kuota)

	{
		echo "<tr>";
		echo "<td>";
		switch ($row_kuota->bonus_or_not) {
			case '2':
				echo 'User Baru';# code...
				break;
			case '1':
				echo 'Komplain/Dispute';# code...
				break;
			case '0':
				echo 'Transfer';# code...
				break;
			
		}
		
		
		echo "</td>";
        echo '<td>'.number_format($row_kuota->nominal_transfer).'</td>';
        echo '<td>'.$row_kuota->date_transfer.'</td>';
        echo '<td>'.$row_kuota->transfer_convert_quota.'</td>';
        echo '<td>'.$row_kuota->date_approval_convert.'</td>';
           
		echo "</tr>";
	}
?>
	</tbody>
</table>
</div>