
  			<table  width="100%" id="log_komplain">
  					<tr>
                <td colspan="3">
                    <?php 
                    foreach ($row_q_total_artikel_s->result() as $r_row_q_total_artikel_s ){
                      echo  $r_row_q_total_artikel_s->deskriptor.' <br>(Total Artikel :'.$r_row_q_total_artikel_s->jumlah_artikel.')';
            
                    }
                    ?>
                </td>
            </tr>
            <tr>
  						<th> No </th>
  						<th> Tahun</th>
  						<th> Jumlah Artikel</th>
  					</tr>
  					<?php 
  					$no_urut=1;
  					foreach ($row_q_total_artikel->result() as $r_row_q_total_artikel ){
  					
  					echo '<tr>';
  						echo 	'<td>';
  						echo 	$no_urut.'</td>';
  						echo 	'<td >'.$r_row_q_total_artikel->year.'</td>';
  						echo 	'<td >'.$r_row_q_total_artikel->jumlah_artikel_per_tahun.'</td>';
  					echo '</tr>';

  					$no_urut++;
  					}?>
  					
  			</table>
  	
