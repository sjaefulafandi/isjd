<script type="text/javascript">
function viewjurnalartikeldetailmodal(number,year,volume,id_direktori){
	$('#modaltarget').load(base_url+'index.php/Artikel/get_artikel_number_year_volume/'+number+'/'+year+'/'+volume+'/'+id_direktori,{},function (data){
				});		
}
</script>
<?php 
echo 'No/Tahun/Volume/Jumlah Artikel <br>';
foreach ($q_artikel_jurnal->result() as $r_q_artikel_jurnal)
{
	echo "<a href=\"#\" data-toggle=\"modal\" onclick=\"viewjurnalartikeldetailmodal('".$r_q_artikel_jurnal->number."','".$r_q_artikel_jurnal->year."','".$r_q_artikel_jurnal->volume."',".$id_jurnal.")\" data-target=\"#myModalDetail\"><i class=\"fa fa-search\"></i>";
	echo $r_q_artikel_jurnal->number.'/'.$r_q_artikel_jurnal->year.'/'.$r_q_artikel_jurnal->volume.'/'.$r_q_artikel_jurnal->jum_artikel;
	echo '</a><br>';
}
;?>