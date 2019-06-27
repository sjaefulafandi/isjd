
  			<table  width="100%" id="log_komplain">
  					<tr>
  						<th> No </th>
  						<th> Bidang</th>
  						<th> Jumlah Artikel</th>
  					</tr>
  					<?php 
  					$no_urut=1;
  					foreach ($row_q_total_artikel->result() as $r_row_q_total_artikel ){
  					
  					echo '<tr>';
  						echo 	'<td>';
  						echo 	$no_urut.'</td>';
  						echo 	'<td >'.$r_row_q_total_artikel->name_cat.'</td>';
              echo  '<td >'.$r_row_q_total_artikel->jum_artikel.'</td>';
              
  					echo '</tr>';

  					$no_urut++;
  					}?>
  					
  			</table>
  	
