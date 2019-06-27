
<?php
echo '<b>Top 10 Penerbit ( jumlah terbaca) </b><br>';
$urutan=1;
foreach ($q_penerbit_terbaca->result() as $r_q_penerbit_terbaca)
{
	echo $urutan.'.&nbsp;('.$r_q_penerbit_terbaca->jumbaca.')&nbsp;&nbsp;'.$r_q_penerbit_terbaca->penerbit.'<br>';
$urutan++;
}

?>