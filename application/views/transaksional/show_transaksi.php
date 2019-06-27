
<script>

	function update_approval_transfer(id_transaksi)
	{
		$('#modaladmin').load(base_url+'index.php/admin/approve_transaksi_detail/'+id_transaksi,{"id_user_public_quota":id_transaksi},function (data){});	
	
	}
</script>
<div class="row-fluid">

	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">Transaksi Kuota</h1>
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<div class="row-fluid">
		<table class="table table-bordered table-hover table-striped">
			<tr>
				<th>No</th>

				<th>Jenis Transaksi</th>
				<th>User</th>
				<th>Tanggal Transfer</th>
				<th>Nominal Transfer</th>
				<th>Konversi Kuota</th>
				<th></th>
			</tr>
		<?php
		$no_urut=1;
		foreach ($q_transaksi_kuota->result() as $r_q_transaksi_quota)

		{
			echo '<tr>';
				echo '<td>'.$no_urut.'</td>';
				switch ($r_q_transaksi_quota->bonus_or_not){
					case '0':
							{
								$info_jenis_kuota='Transfer';
							}
					break;
					case '1':
							{
								$info_jenis_kuota='Komplain/Dispute';	
							}
					break;
					case '2':
							{
								$info_jenis_kuota='Bonus';
							}
					break;
				}
				echo '<td>'.$info_jenis_kuota.'</td>';
				echo '<td>'.$r_q_transaksi_quota->user_public_id.'</td>';
				echo '<td>'.$r_q_transaksi_quota->date_transfer.'</td>';
				echo '<td>'.$r_q_transaksi_quota->nominal_transfer.'</td>';
				echo '<td>'.$r_q_transaksi_quota->transfer_convert_quota.'</td>';
				echo '<td>';
				if ($r_q_transaksi_quota->approval_convert_by ==NULL or $r_q_transaksi_quota->approval_convert_by =='') 
				{
					echo '&nbsp;<a href="#" data-toggle="modal" onclick="update_approval_transfer('.$r_q_transaksi_quota->id_user_public_quota.')" data-target="#myModalDetailArtikel" title="persetujuan"><i class="fa fa-question"></i></a>';
				}else{
					echo '<i class="fa fa-check"></i>';	
				}
				echo '</td>';
			echo '</tr>';
		$no_urut ++;
		}// end of foreach 
		?>
		</table>
	</div>
	
</div> <!-- end of row -->
