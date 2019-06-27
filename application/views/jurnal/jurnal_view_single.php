
<script type="text/javascript">
$(document).ready(function(){
	var id_jurnal=<?php echo $id_jurnal;?>;
		 $('#jurnal_artikel_info').load(base_url+'index.php/Jurnal/get_info_artikel_jurnal/'+id_jurnal,{},function (data){});
	});//end of document ready
</script>

<?php
$row_jurnal=$query_jurnal->row();
?>

<div class="modal-content">
		    
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<i class="fa fa-quote-left fa-fw"></i> 
<b><?php echo $row_jurnal->judul?></b>
<i class="fa fa-quote-right fa-fw"></i> 
</div>
<div class="modal-body">
	<div class="row">
	<table id="jurnal_search">
		<tr>
			<td>ISSN</td>
			<td><?php echo $row_jurnal->issn?></td>
		</tr>
		
		<tr>
			<td width="150px">Penerbit</td>
			<td><?php echo $row_jurnal->penerbit;?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?php echo $row_jurnal->alamat;?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td><?php echo $row_jurnal->tahun;?></td>
		</tr>
		<tr>
			<td>Deskriptor</td>
			<td><?php echo $row_jurnal->deskriptor;?></td>
		</tr>
		<tr>
			<td>Frekuensi</td>
			<td><?php echo $row_jurnal->frekuensi;?></td>
		</tr>
	</table>
	</div>
	Artikel :
	<div class="row" id="jurnal_artikel_info">

	</div>	

</div>
<div class="row-fluid modal-footer">
 <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
		      
</div>
</div>
