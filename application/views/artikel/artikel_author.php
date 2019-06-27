<script type="text/javascript">
	function test_author(){
		var keyword_text_author=$('#keyword_text_author').val();
		$('.divmask').show();
		$('#paneltargetauthor').empty();
		$('#paneltargetauthor').load(base_url+'index.php/Artikel/get_artikel_author',{"keyword_text_author":keyword_text_author},function (data){
			$('.divmask').hide();
			});
	}
		function viewdetailartikelauthor(id_jurnal){
			$('#modaltargetauthor').load(base_url+'index.php/Artikel/get_artikel_single/'+id_jurnal,{},function (data){
				});		
	}

</script>

<!-- Modal -->	
		<div class="modal fade bs-example-modal-sm" id="myModalDetailArtikelatuhor" tabindex="-1" role="dialog" aria-labelledby="myModalDetailArtikelauthor" aria-hidden="true">
		  <div class="modal-dialog modal-sm-12" id="modaltargetauthor">
		  </div>
		</div>

  		<div class="row-fluid  col-sm-12">
  		<br>
  			<div class="input-group input-group-sm">
      			<input type="text" class="form-control" value="<?php echo $keyword_text_author;?>" id="keyword_text_author" placeholder="Search for...">
      			<span class="input-group-btn">
        		<button onclick="test_author();" class="btn btn-default" type="button">
        		<i class="fa fa-search fa-fw"></i> 
        		</button>
      			</span>
    		</div><!-- /input-group -->
  			
  		</div>
  	
  	<div class="row-fluid col-sm-12 text-right">
  	<br>	
  			Total Data : <span class="badge"><?php echo number_format($total_rows);?></span>
	
  	</div>
  	<div class="row-fluid col-sm-12" id="pagingartikelauthor">
			<table width="auto" id="artikel_search">
  					<tr>
  						<td ></td>
  						<td>Author / Judul</td>
  					</tr>
  					<?php 
  					$no_urut=$offset+1;
  					$this->load->model('model_artikel');
  					foreach ($query_artikel_author->result() as $row_artikel_author ){
  					?>
  					<tr>
  						<td>
  						</a>
  						</td>
  						<td align="justify">
  							<?php echo $row_artikel_author->authorname;?>
  							
  							<?php 
  								$query_author_artikel_detail=$this->model_artikel->get_data_author_artikel_detail_info($row_artikel_author->author_id);
  								foreach ($query_author_artikel_detail->result() as $row_query_author_artikel_detail)
  								{
  									?>
  									<br><a href="#" data-toggle="modal" onclick="viewdetailartikelauthor('<?php echo $row_query_author_artikel_detail->id_jurnal;?>')" data-target="#myModalDetailArtikelatuhor">
  									<i class="fa fa-search"></i><?php echo $row_query_author_artikel_detail->title?>
  									</a>
  									<?php 
  								}
  							?>
  						</td>
  					</tr>
  					<?php 
  					$no_urut++;
  					}?>
  					
  				</table>
  		
	</div> <!-- end of panel body -->
  	<div class="row-fluid  col-sm-12">
  		<?php echo $this->jquery_pagination->create_links();?>
  	</div>
  	

