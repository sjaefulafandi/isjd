<script type="text/javascript">
	function advance(){
		var keyword_text=$('#keyword_text2').val();
		var tahun=$('#tahun option:selected').val();
		var nama_journal=$('#keyword_text3').val();
        
		$('.divmask').show();
		$('#paneltarget').empty();
		$('#paneltarget').load(base_url+'index.php/Artikel/get_artikel_adv',{"keyword_text":keyword_text,"tahun":tahun,"nama_journal":nama_journal},function (data){
			$('.divmask').hide();
			 $('#myModalDetail').modal('hide');
			});
	}
</script>

<div class="modal-content">
		    
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<i class="fa fa-quote-left fa-fw"></i> 
	Pencarian Lebih
<i class="fa fa-quote-right fa-fw"></i> 
</div>
<div class="modal-body">
	<div class="input-group input-group-sm">
		<input type="text" class="form-control" value="" id="keyword_text2" placeholder="Search for...">
		<span class="input-group-btn">
			<button onclick="advance();" class="btn btn-default" type="button">
				<i class="fa fa-search fa-fw"></i> 

			</button>
		</span>
		
	</div><!-- /input-group -->
	<br>
	<div class="col-sm-1">
	Tahun :
	</div>
	<div class="col-sm-2" >
			<?php 
				$year = date('Y');
			?>
			<select id="tahun">
				<?php

					for ($i=1990;$i<2100;$i++)
					{
						$selected="";
						if ($i==$year) $selected="selected"; 

						echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';

					}
				?>		
			</select>
	</div>
	<div class="col-sm-3">
		Nama Journal :
	</div>
	<div class="col-sm-5" >
		<input type="text" class="form-control" value="" id="keyword_text3" placeholder="Search for...">
	</div>
	
</div>
<div class="row-fluid modal-footer">
		      
</div>
</div>
