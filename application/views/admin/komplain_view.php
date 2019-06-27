<script type="text/javascript">
	function findadminlogkomplain(){
		var keyword_text_komplain_user=$('#keyword_text_komplain_user').val();
		$('.divmask').show();
		$('#page-wrapper').empty();
		$('#page-wrapper').load(base_url+'index.php/admin/show_komplain_user',{"keyword_text_komplain_user":keyword_text_komplain_user},function (data){
			$('.divmask').hide();
			});
	}
	
	function viewadmincomplaindetail(id_user_complain){
		//$('#modeltarget').empty();
		$('#modaladmin').load(base_url+'index.php/admin/show_komplain_detail/All/'+id_user_complain,{"id_user_complain":id_user_complain},function (data){});	
	}
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Komplain</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default"  >
	<div class="panel-heading">
  		<div class="row">
  		<div class="col-sm-7">
  			Total Data : <span class="badge"><?php echo number_format($total_rows);?></span>
		
  		</div>
  		<div class="col-sm-5">
    		<div class="input-group input-group-sm">
      			<input type="text" class="form-control" value="<?php echo $keyword_text_komplain_user;?>" id="keyword_text_komplain_user" placeholder="Search for...">
      			<span class="input-group-btn">
        		<button onclick="findadminlogkomplain();" class="btn btn-default" type="button">
        		<i class="fa fa-search fa-fw"></i> 
        		
        		</button>
      			</span>
    		</div><!-- /input-group -->
  		</div><!-- /.col-lg-6 -->
  		</div>
  	</div>
  	<div class="panel-body" id="paginglogkomplain">
  			<table  width="100%" id="log_komplain">
  					<tr>
  						<th> No </th>
  						<th> Komplain</th>
  						<th> Tanggal</th>
  						<th> Tanggal Thread</th>
  						<th> Status</th>
  					</tr>
  					<?php 
  					$no_urut=$offset+1;
  					foreach ($q_log_komplain->result() as $r_q_log_komplain ){
  					
  					echo '<tr>';
  						echo 	'<td>';
  						echo 	$no_urut.'</td>';
  						echo 	'<td>';
  						echo 	'&nbsp;<a href="#" data-toggle="modal" onclick="viewadmincomplaindetail('.$r_q_log_komplain->id_user_complain.')" data-target="#myModalDetailArtikel"><i class="fa fa-search"></i></a>';
  						echo 	$r_q_log_komplain->complain_description;
  						echo 	'</td>';
  						echo 	'<td >'.$r_q_log_komplain->tanggal_complain.'</td>';
  						echo 	'<td >'.$r_q_log_komplain->tanggal_akhir_thread.'</td>';
  						echo 	'<td >'; if ($r_q_log_komplain->status_complain==0){echo 'open';}else{echo 'close';};echo '</td>';
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
