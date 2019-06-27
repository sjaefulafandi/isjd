
<div class="modal-content">
		    
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<i class="fa fa-quote-left fa-fw"></i> 
<b>Daftar Artikel <?php echo 'Nomor:'.$number.'; Tahun :'.$year.'; Volume :'.$volume ;?></b>
<i class="fa fa-quote-right fa-fw"></i> 
</div>
<div class="modal-body">
	<table id="artikel_search">
		<th>No</th>
		<th>Title</th>
		<th>Penerbit</th>
		<th>Kode Panggil</th>
		<?php 
		$no_urut=1;
		foreach ($q_artikel_number_year_volume->result() as $r_q_artikel_number_year_volume)
		{
			echo "<tr>";
				echo "<td>".$no_urut."</td>";
				echo "<td>".$r_q_artikel_number_year_volume->title."</td>";
				echo "<td>".$r_q_artikel_number_year_volume->penerbit."</td>";
				echo "<td>".$r_q_artikel_number_year_volume->kodepanggil."</td>";
			echo "</tr>";
		$no_urut++;
		}
		?>
	</table>
</div>
<div class="row-fluid modal-footer">
 <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
		      
</div>
</div>
