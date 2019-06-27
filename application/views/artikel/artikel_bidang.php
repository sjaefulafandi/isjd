  <div class="col-sm-12">
  	<br>
      <div class="input-group col-sm-12">
        <input class="form-control" value="<?php echo $keyword_text_artikel_bidang;?>" placeholder="Search" id="keyword_text_artikel_bidang" name="keyword_text_artikel_bidang" type="text">
        <div class="input-group-btn">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          	<span id="mydropdowndisplay">Kategori</span> <span class="caret"></span>
          	<button onclick="artikel_bidang_search();" class="btn btn-default" type="button">
        		<i class="fa fa-search fa-fw"></i> 
          </button>
          <ul class="dropdown-menu" id="mydropdownmenu">
          	<li value="Kategori"><a href="#" value="Kategori">Kategori</a></li>
          	<?php 
          	$selected='';
          	foreach ($q_category->result() as $r_q_category)
          	{
          	echo '<li value="'.$r_q_category->id_category.'"><a href="#">('.$r_q_category->jum_artikel.') '.$r_q_category->name_cat.'</a></li>';
            }
            ?>
          </ul>
         
        </div><!-- /btn-group -->
      </div>
  </div>
<div class="row-fluid col-sm-12 text-right">
  	<br>	
  		 <input id="mydropwodninput" name="mydropwodninput" type="hidden" value="<?php echo $namabidang;?>" >
          <input id="mydropwodninputid" name="mydropwodninputid" type="hidden" value="<?php echo $bidang;?>">

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
  					foreach ($query_artikel_bidang->result() as $row_artikel ){
  					?>
  					<tr>
  						<td>
  							<a href="#" data-toggle="modal" onclick="viewdetailartikel('<?php echo $row_artikel->id_jurnal;?>')" data-target="#myModalDetail">
  							<i class="fa fa-search"></i>
  						</a>
  						</td>
  						<td align="justify">
  							<?php 
                $findstring=strtolower($keyword_text_artikel_bidang);
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

<script>
$(document).ready(function() {
	$('#mydropdowndisplay').text('<?php echo $namabidang;?>');

});
$('#mydropdownmenu > li').click(function(e){
  e.preventDefault();
  var selected = $(this).text();
  var idselected = $(this).val();
  $('#mydropwodninput').val(selected);
  $('#mydropwodninputid').val(idselected);

  $('#mydropdowndisplay').text(selected);
});
function artikel_bidang_search(){
	var bidang=$('#mydropwodninputid').val();
	var namabidang=$('#mydropwodninput').val();
	var keyword_text_artikel_bidang=$('#keyword_text_artikel_bidang').val();
		$('.divmask').show();
		$('#paneltargetbidang').empty();
		$('#paneltargetbidang').load(base_url+'index.php/Artikel/get_artikel_bidang/'+keyword_text_artikel_bidang+'/'+bidang,{"keyword_text_artikel_bidang":keyword_text_artikel_bidang,"bidang":bidang,"namabidang":namabidang},function (data){
			$('.divmask').hide();
			});

}
</script>