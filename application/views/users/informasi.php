<table class="table table-bordered table-hover table-striped">
	<?php
	$r_user_group=$q_user_group->row();
	echo '<tr><th colspan="4"> Info Tarif untuk '.$r_user_group->user_group.'</td></tr>';
	echo '<tr>';
		echo 	'<th> Jenis tarif</th>';
		echo 	'<th> Harga </th>';
		echo 	'<th> Kuota Download </th>';
		echo 	'<th> Form Bukti Transfer</th>';
	echo '</tr>';
	
	foreach ($q_tarif_download->result() as $r_q_tarif_download)
	{
		echo '<tr>';
		echo 	'<th>'.$r_q_tarif_download->jenis_tarif.'</td>';
		echo 	'<th>'.number_format($r_q_tarif_download->harga).'</td>';
		echo 	'<th>'.number_format($r_q_tarif_download->harga_to_download).'</td>';
		echo 	'<th><a href="#" data-toggle="modal" onclick="add_kuota_form('.$r_q_tarif_download->id_tarif_download.');" data-target="#myModalDetail"><i class="fa fa-plus fa-fw"></i> Kuota</a></li></a></th>';
		echo '</tr>';
	}
	?>
</table>