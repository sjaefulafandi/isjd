<?php
echo '<b>Author ( jumlah terbaca) </b><br>';
$urutan=1;
foreach ($q_author_terbaca->result() as $r_q_author_terbaca)
{
	echo $urutan.'.&nbsp;('.$r_q_author_terbaca->jumbaca.')&nbsp;&nbsp;'.trim($r_q_author_terbaca->authorname).'<br>';
$urutan++;
}
?>