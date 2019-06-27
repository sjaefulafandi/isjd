<script type="text/javascript">
	function test(){
		var keyword_text2=$('#keyword_text').val();
    alert(keyword_text2);
    $('.divmask').show();
		$('#paneltarget').empty();
		$('#paneltarget').load(base_url+'index.php/Artikel/get_artikel',{"keyword_text":keyword_text2},function (data){
			$('.divmask').hide();
			});
		$('#chart2').load(base_url+'index.php/Artikel/get_chart_artikel_per_tahun_line_search',{"keyword_text":keyword_text2},function (data){
			$('.divmask').hide();
			});
		$('#chart1').empty();
		$('#chart3').empty();
    	
	}
		function viewdetailartikel(id_jurnal){
			$('#modaltarget').load(base_url+'index.php/Artikel/get_artikel_single/'+id_jurnal,{},function (data){
				});		
	}

  function viewadvancesearch(){
    $('#modaltarget').load(base_url+'index.php/Artikel/adv_search/',{},function (data){
        }); 
  }

</script>


  		<div class="row-fluid  col-sm-12">
  		<br>
  			<div class="input-group input-group-sm">
      			<input type="text" class="form-control" value="<?php echo $keyword_text;?>" id="keyword_text" placeholder="Search for...">
            <span class="input-group-btn">
        		<button onclick="test();" class="btn btn-default" type="button">
        		<i class="fa fa-search fa-fw"></i> 
        		
        		</button>
      			</span>

    		</div><!-- /input-group -->
  		<br>
        <div class="col-sm-12" align="right">
          <a href="#" data-toggle="modal" onclick="viewadvancesearch()" data-target="#myModalDetail">
            Pencarian Detail

          </a>
        </div>
  		</div>
  	
  	<div class="row-fluid col-sm-12 text-right">
  	<br>	
  			Total Data : <span class="badge"><?php echo number_format($total_rows);?></span>
	
  	</div>
  	<div class="row-fluid col-sm-12" id="pagingartikel">
			<table width="auto" id="artikel_search">
  					<tr>
  						<td ></td>
  						<td>Judul / Kategori</td>
  					</tr>
  					<?php 
  					$no_urut=$offset+1;
  					foreach ($query_artikel->result() as $row_artikel ){
  					?>
  					<tr>
  						<td>
  							<a href="#" data-toggle="modal" onclick="viewdetailartikel('<?php echo $row_artikel->id_jurnal;?>')" data-target="#myModalDetail">
  							<i class="fa fa-search"></i>
  						</a>
  						</td>
  						<td align="justify">
  							<?php 
                $findstring=strtolower($keyword_text);
                $artikelstring=strtolower($row_artikel->title);
                //echo $findstring.';'.$artikelstring;
                $artikelreplace=str_replace($findstring,'<span class="label label-info" style="font-size:12px">'.$findstring.'</span>',$artikelstring);
                echo ucfirst($artikelreplace);?> / 
                <?php echo $row_artikel->name_cat;?>
  						  
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
  	

