<script type="text/javascript">
function konfirmdownload(id_jurnal){
	
	var r = confirm("Kuota Download anda akan berkurang");
	if (r == true) {
	    //alert ('hai');
	   	$('#myModalDetailArtikel').modal('hide');
	   	window.open(base_url+'index.php/Artikel/get_file_to_donwload/'+id_jurnal);

	    //alert('haa');
	} else {
	    $('#myModalDetailArtikel').modal('hide');

	}

  }
  
function login_paksa(){
  $('#modal-content').modal('hide');
  $('#myModalDetail').modal('hide');
 
  $('.btn-slide').click();  
}

</script>

<?php
$row_artikel=$query_artikel->row();
?>

<div class="modal-content">
		    
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<i class="fa fa-quote-left fa-fw"></i> 
<b><?php echo $row_artikel->title?></b>
<i class="fa fa-quote-right fa-fw"></i> 
</div>
<div class="modal-body">
	<table id="artikel_search">
		<tr>
			<td width="150px">Pengarang</td>
			<td>
				<?php 
				foreach ($query_author_artikel->result() as $row_author_artikel)
				{
					echo $row_author_artikel->author_ke.'.&nbsp;&nbsp;'.$row_author_artikel->authorname.'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Sumber</td>
			<td><?php echo $row_artikel->judul;?></td>
		</tr>
		<tr>
			<td>Penerbit</td>
			<td><?php echo $row_artikel->penerbit;?></td>
		</tr>
		<tr>
			<td>Kode Panggil</td>
			<td><?php echo $row_artikel->kodepanggil?></td>
		</tr>
		<tr>
			<td>Tahun Artikel</td>
			<td><?php echo $row_artikel->year;?></td>
		</tr>
		<tr>
			<td>Volume / No / Halaman</td>
			<td><?php echo $row_artikel->volume?>/<?php echo $row_artikel->number?>/<?php echo $row_artikel->halaman?></td>
		</tr>
		<tr>
			<td>Kata Kunci</td>
			<td><?php echo $row_artikel->deskriptor?></td>
		</tr>
		<tr>
			<td>Sari</td>
			<td align="justify"><?php echo $row_artikel->sari?></td>
		</tr>
		<tr>
			<td>Abstrak</td>
			<td align="justify"><?php echo $row_artikel->abstract?></td>
		</tr>
		<tr>
			<td>Fullteks</td> 
			<td align="justify"><?php echo $row_artikel->fullteks?></td>
		</tr>
		<tr>
			<td>Telah dilihat / Unduh</td>
			<td><span class="badge"><?php echo $row_artikel->hitungbaca?></span>/<span class="badge"><?php echo $row_artikel->hitungdonlot?></span>
			</td>
		</tr>
		<tr>
			<td>Unduh</td>
			<td>
				<?php if ( $saldo_quota > 0){
				?>
				sisa kuota download anda adalah " <?php echo $saldo_quota;?> ",jika anda ingin mendownload klik icon berikut
				<a href="#" onclick="konfirmdownload(<?php echo $row_artikel->id_jurnal;?>)">
				<i class="fa fa-download fa-fw">

				</i>
				</a>
				
				<?php } else{
				  if ($blm_login=='yes'){ 
          ?>
      	<!-- <div class="row-fluid" id="panel_paksa" >    
      <div id="loginpart" >
				<br>
				 <div class="well form-group" style="height:150px">
				Silahkan anda Sign In :<br> 
					Publik <input type="radio" id="j_user1" name="j_user_paksa" value="publik" checked >
    				Penerbit <input type="radio" id="j_user2" name="j_user_paksa" value="penerbit" >

							<input type="text" id="user_public_id_paksa" class="form-control input-sm" size="35" placeholder="Id User"> 
							<input type="password" id="password_paksa"  class="form-control input-sm" size="35" placeholder="Password"> 
							<button onclick="masuk_paksa();" class="btn btn-primary btn-xs" type="button">Sign In</button>
				  <br> Lupa Password Anda ?? 			
				</div>
			</div>
			</div>                         -->
			     Anda harus <a href="#" onclick="login_paksa()">login</a> terlebih dahulu
          <?php 
          }else{
          echo 'Mohon Maaf, kouta download anda telah habis, Terimakasih.';
          
          } 
				} 

				?>
			</td>
		</tr>
		
	</table>
</div>
<div class="row-fluid modal-footer">
 <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
		      
</div>
</div>
