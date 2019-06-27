<script type="text/javascript">
	function test(){
		var keyword_text=$('#keyword_text').val();
		$('.divmask').show();
		$('#paneltarget').empty();
		$('#paneltarget').load(base_url+'index.php/Artikel/get_artikel',{"keyword_text":keyword_text},function (data){
			$('.divmask').hide();
			});
	}
		function viewdetailartikel(id_jurnal){
			$('#modaltarget').load(base_url+'index.php/Artikel/get_artikel_single/'+id_jurnal,{},function (data){
				});		
	}
    function downloadok(id_jurnal){

       //$('#dialog-box-info').load(base_url+'index.php/Artikel/get_file_to_donwload/'+id_jurnal,{},function (data){
      //});
      alert('hai'+id_jurnal);
    }



</script>

<!-- Modal -->	
		<div class="modal fade bs-example-modal-sm" id="myModalDetailArtikel" tabindex="-1" role="dialog" aria-labelledby="myModalDetailArtikel" aria-hidden="true">
		  <div class="modal-dialog modal-sm-12" id="modaltarget">
		  </div>
		</div>

<div class="panel panel-default"  >
	<div class="panel-heading">
  		<div class="row">
  		<div class="col-sm-7">
  			Total Data : <span class="badge"><?php echo number_format($total_rows);?></span>
		
  		</div>
  		<div class="col-sm-5">
    		<div class="input-group input-group-sm">
      			<input type="text" class="form-control" value="<?php echo $keyword_text;?>" id="keyword_text" placeholder="Search for...">
      			<span class="input-group-btn">
        		<button onclick="test();" class="btn btn-default" type="button">
        		<i class="fa fa-search fa-fw"></i> 
        		
        		</button>
      			</span>
    		</div><!-- /input-group -->
  		</div><!-- /.col-lg-6 -->
  		</div>
  	</div>
  	<div class="panel-body" id="pagingartikel">
			<table width="auto" id="artikel_search">
  					<tr>
  						<td ></td>
  						<td>Judul/ Kategori</td>
  					</tr>
  					<?php 
  					$no_urut=$offset+1;
  					foreach ($query_artikel->result() as $row_artikel ){
  					?>
  					<tr>
  						<td>
  							<a href="#" data-toggle="modal" onclick="viewdetailartikel('<?php echo $row_artikel->id_jurnal;?>')" data-target="#myModalDetailArtikel">
  							<i class="fa fa-search"></i>
  						</a>
  						</td>
  						<td align="justify">
  							<?php echo str_replace($keyword_text,'<span class="label label-info">'.$keyword_text.'</span>',$row_artikel->title);?> / <?php echo $row_artikel->name_cat;?>
  						</td>
  					</tr>
  					<?php 
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


