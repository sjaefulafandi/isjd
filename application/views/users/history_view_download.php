<script type="text/javascript">
	function findlogview(){
		var keyword_text_view_user=$('#keyword_text_view_user').val();
		$('.divmask').show();
		$('#dRekamjejak').empty();
		$('#dRekamjejak').load(base_url+'index.php/user_public/show_history_user',{"keyword_text_view_user":keyword_text_view_user},function (data){
			$('.divmask').hide();
			});
	}
</script>
<div class="panel panel-default"  >
	<div class="panel-heading">
  		<div class="row">
  		<div class="col-sm-7">
  			Total Data : <span class="badge"><?php echo number_format($total_rows);?></span>
		
  		</div>
  		<div class="col-sm-5">
    		<div class="input-group input-group-sm">
      			<input type="text" class="form-control" value="<?php echo $keyword_text_view_user;?>" id="keyword_text_view_user" placeholder="Search for...">
      			<span class="input-group-btn">
        		<button onclick="findlogview();" class="btn btn-default" type="button">
        		<i class="fa fa-search fa-fw"></i> 
        		
        		</button>
      			</span>
    		</div><!-- /input-group -->
  		</div><!-- /.col-lg-6 -->
  		</div>
  	</div>
  	<div class="panel-body" id="paginglogview">
			<table width="auto" id="log_view_search">
  					<tr>
  						<th >No</th>
  						<th>Artikel </th>
  						<th>W. Lihat</th>
  						<th>W. Download</th>
  					</tr>
  					<?php 
  					$no_urut=$offset+1;
  					foreach ($q_log_view_download->result() as $r_q_log_view_download ){
  					
  					echo '<tr>';
  						echo 	'<td>'.$no_urut.'</td>';
  						echo 	'<td>'.$r_q_log_view_download->title.'</td>';
  						echo 	'<td >';if($r_q_log_view_download->view_check == NULL){echo '-';}else{echo $r_q_log_view_download->view_check;}; echo '</td>';
  						echo 	'<td>';if($r_q_log_view_download->download_check == NULL){echo '-';}else{echo $r_q_log_view_download->download_check;};echo '</td>';
					echo '</tr>';

  					$no_urut++;
  					}?>
  					
  				</table>
  		
	</div> <!-- end of panel body -->
  <div class="panel-footer">
  	<div class="row" id="footerdashboard">
  	<?php echo $this->jquery_pagination->create_links();?>
  	</div>
  </div>
</div>	<!-- panel default -->
