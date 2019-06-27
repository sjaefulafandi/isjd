<script type="text/javascript">
	function findlogkomplaindetail(id_user_complain){
		var keyword_text_komplain_detail_user=$('#keyword_text_komplain_detail_user').val();
		if (keyword_text_komplain_detail_user==''){
			var keyword_text_komplain_detail_user='All';
		}
		$('.divmask').show();
		$('#modaltarget').empty();
		$('#modaltarget').load(base_url+'index.php/user_public/show_komplain_detail/'+keyword_text_komplain_detail_user+'/'+id_user_complain,{"keyword_text_komplain_detail_user":keyword_text_komplain_detail_user,"id_user_complain":id_user_complain},function (data){
			$('.divmask').hide();
			});
	}
</script>
<div class="modal-content" >
		    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Komplain Detail</b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	
	<div class="modal-body" id="modal_komplain_detail" >
		<div class="row">
			<div class="row-fluid" align="right">
			<a href="#" data-toggle="modal" onclick="add_komplain_detail_form(<?php echo $id_user_complain;?>);" data-target="#myModalDetail">
				<i class="fa fa-plus fa-fw"></i> Detail Komplain </a></li>
			</a>
		</div>
			<div class="panel panel-default"  >
			<div class="panel-heading">
		  		<div class="row">
		  		<div class="col-sm-7">
		  			Total Data : <span class="badge"><?php echo number_format($total_rows);?></span>
				
		  		</div>
		  		<div class="col-sm-5">
		    		<div class="input-group input-group-sm">
		      			<input type="text" class="form-control" value="<?php echo $keyword_text_komplain_detail_user;?>" id="keyword_text_komplain_detail_user" placeholder="Search for...">
		      			<span class="input-group-btn">
		        		<button onclick="findlogkomplaindetail(<?php echo $id_user_complain;?>);" class="btn btn-default" type="button">
		        		<i class="fa fa-search fa-fw"></i> 
		        		
		        		</button>
		      			</span>
		    		</div><!-- /input-group -->
		  		</div><!-- /.col-lg-6 -->
		  		</div>
		  	</div>
		  	<div class="panel-body" id="paginglogview">
					<table width="100%" id="log_view_search">
		  					<tr>
		  						<th >No</th>
		  						<th> Detail Thread Komplain</th>
		  						<th> Tanggal </th>
		  						<th> Status to Komplain</th>
		  					</tr>
		  					<?php 
		  					$no_urut=$offset+1;
		  					foreach ($q_log_komplain_detail->result() as $r_q_log_komplain_detail ){
		  					
		  					echo '<tr>';
		  						echo 	'<td>'.$no_urut.'</td>';
		  						echo 	'<td>'.$r_q_log_komplain_detail->deskripsi_thread.'</td>';
		  						echo 	'<td>'.$r_q_log_komplain_detail->tanggal_thread.'</td>';
		  						echo 	'<td>';if($r_q_log_komplain_detail->action_to_status == '0'){echo 'open';}else{echo 'close';};echo '</td>';
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
		</div>
	</div>
	<div class="row-fluid modal-footer">
			 	<button type="button" class="btn btn-default btn-xs" onclick="refresh_komplain();" >Close</button>
			      
	</div>
	
</div>