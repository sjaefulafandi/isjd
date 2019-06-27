<script type="text/javascript">
function searchpenerbit(){
		var keyword_text=$('#keyword_text').val();
		$('.divmask').show();
		$('#pagingpenerbit').empty();
		$('#pagingpenerbit').load(base_url+'index.php/Referensi/show_penerbit',{"keyword_text":keyword_text},function (data){
			$('.divmask').hide();
			});
	}
function tambah_penerbit(){
	$('#modaladmin').load(base_url+'index.php/Referensi/penerbit_form/',{},function (data){
	});
}
</script>
<div id="pagingpenerbit">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Penerbit</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row-fluid  col-sm-12">
  		
  			<div class="input-group input-group-sm">
      			<input type="text" class="form-control" value="<?php echo $keyword_text;?>" id="keyword_text" placeholder="Search for...">
      			<span class="input-group-btn">
        		<button onclick="searchpenerbit();" class="btn btn-default" type="button">
        		<i class="fa fa-search fa-fw"></i> 
        		
        		</button>
      			</span>
    		</div><!-- /input-group -->
  			
  		</div>
<div class="row-fluid">

	<a href="#" data-toggle="modal" onclick="tambah_penerbit();" data-target="#myModalDetailArtikel">
			<i class="fa fa-plus fa-fw"></i> Penerbit </a></li>
		</a>
</div>
<div class="row" >

	<table class="table table-bordered table-hover table-striped">
		<thead>
			<th>No</th>
			<th>Nama Penerbit</th>
			<th>User Name Default</th>
			<th>User Name Edited</th>

		</thead>
		<tbody>
		<?php
		$no=$offset+1;
		foreach ($query_penerbit->result() as $r_q_penerbit){

			echo '<tr>';
		        echo '<td width="10">'.$no.'</td>';
		        echo '<td>'.$r_q_penerbit->penerbit.'('.$r_q_penerbit->id_penerbit.')</td>';
		       	echo '<td>'.$r_q_penerbit->user_id_penerbit_default.'</td>';
		       	echo '<td>'.$r_q_penerbit->user_id_penerbit_edited.'</td>';
	        echo '</tr>';
	    $no++;
		}

		?>
		</tbody>
	</table>
	<div class="row-fluid  col-sm-12">
  		<?php echo $this->jquery_pagination->create_links();?>
  	</div>
  	
</div>	
</div>
