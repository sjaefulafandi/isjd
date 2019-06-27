	<script type="text/javascript">
  function findjurnal(){
    var keyword_text=$('#keyword_text').val();
    $('.divmask').show();
    $('#Judul').empty();
    $('#Judul').load(base_url+'index.php/Jurnal/get_jurnal',{"keyword_text":keyword_text,"jenis":'judul'},function (data){
    $('.divmask').hide();
      
      });
  }
  /*function viewdetailjurnal(id_jurnal){
      $('#target_info').load(base_url+'index.php/Jurnal/get_jurnal_single/'+id_jurnal,{},function (data){
        });   
  }
   */

</script>
<?php if ($jenis=='judul'){?>
<script type="text/javascript">
    function viewdetailjurnal(id_jurnal){
      $('.divmask').show();
    
      $('#target_info').load(base_url+'index.php/Jurnal/get_jurnal_single/'+id_jurnal,{},function (data){
           $('#jurnal_artikel_info').load(base_url+'index.php/Jurnal/get_info_artikel_jurnal/'+id_jurnal,{},function (data){});
      $('.divmask').hide();
        });   
    }
</script>
<?php } ?>

<?php if ($jenis=='subjek'){?>

<script type="text/javascript">
    function viewdetailjurnal(id_jurnal){
      $('.divmask').show();
      $('#target_info_ss').load(base_url+'index.php/Jurnal/get_jurnal_single/'+id_jurnal,{},function (data){
           $('#jurnal_artikel_infos').load(base_url+'index.php/Jurnal/get_info_artikel_jurnal/'+id_jurnal,{},function (data){});
      
      $('.divmask').hide();
      });   
    }  
</script>

<?php }?>  

<?php if ($jenis=='penerbit'){?>

<script type="text/javascript">
    function viewdetailjurnal(id_jurnal){
      $('.divmask').show();
      $('#target_info_sp').load(base_url+'index.php/Jurnal/get_jurnal_single/'+id_jurnal,{},function (data){
            $('#jurnal_artikel_infosp').load(base_url+'index.php/Jurnal/get_info_artikel_jurnal/'+id_jurnal,{},function (data){});
     
       $('.divmask').hide(); 
        });   
    }      
</script>

<?php } ?>

<?php if ($jenis=='issn'){?>

<script type="text/javascript">
    function viewdetailjurnal(id_jurnal){
      $('.divmask').show();
      $('#target_info_si').load(base_url+'index.php/Jurnal/get_jurnal_single/'+id_jurnal,{},function (data){
            $('#jurnal_artikel_infosi').load(base_url+'index.php/Jurnal/get_info_artikel_jurnal/'+id_jurnal,{},function (data){});
    
       $('.divmask').hide(); 
        });
    }   
</script>

<?php }?>  

    <?php 
    /*if ($jenis=='judul'){
      echo '<div class="row-fluid  col-sm-5">';
    }else{
      echo '<div class="row-fluid  col-sm-12">';
    }*/
    ?>
    <div class="row-fluid  col-sm-12">
      <div class="row-fluid">
      <br>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" 
            <?php if ($jenis<>'judul'){ echo 'readonly';} ?>
            value="<?php echo $keyword_text;?>" id="keyword_text" placeholder="Search for...">
            <span class="input-group-btn">
            <button onclick="findjurnal();" class="btn btn-default" type="button">
            <i class="fa fa-search fa-fw"></i> 
            
            </button>
            </span>
        </div><!-- /input-group -->
      </div>
        
    
	<div class="row-fluid col-sm-12 text-right">
          <br>  
          Total Data : <span class="badge"><?php echo number_format($total_rows);?></span>
    
      </div>
      <div class="row-fluid col-sm-12" id="pagingjurnal">
        <table width="auto" id="jurnal_search">
              <tr>
                <td ></td>
                <td>jurnal / ISSN / Jumlah Artikel</td>
              </tr>
              <?php 
              $no_urut=$offset+1;
              foreach ($query_jurnal->result() as $row_jurnal ){
              ?>
              <tr>
                <td>
                  <!--- <a href="#" data-toggle="modal" onclick="viewdetailjurnal('<?php echo $row_jurnal->id_direktori;?>')" data-target="#myModalDetail">
                  <i class="fa fa-search"></i>
                --> 
                <a href="#" onclick="viewdetailjurnal('<?php echo $row_jurnal->id_direktori;?>')">
                  <i class="fa fa-search"></i>
                </a>
                </td>
                <td align="justify">
                  <?php 
                  $findstring=strtolower($keyword_text);
                  $jurnalstring=strtolower($row_jurnal->judul);
                  //echo $findstring.';'.$jurnalstring;
                  $jurnalreplace=str_replace($findstring,'<span class="label label-info" style="font-size:12px">'.$findstring.'</span>',$jurnalstring);
                  echo ucfirst($jurnalreplace);?> / 
                  <?php echo $row_jurnal->issn;?> /
                  <?php echo $row_jurnal->jum_artikels;?>
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
<?php 
      if ($jenis=='subjek'){
    ?>
    <div class="row-fluid  col-sm-12">
      <div class="row-fluid" id="target_info_ss">
        <br><br>
        Informasi dari jurnal subjek yang dapat anda dapatkan
      </div>

    </div>
    <div class="row-fluid  col-sm-12">
    
     <div class="col-sm-11"  id="jurnal_artikel_infos"></div>

  </div>  


    <?php
      }
    ?>
    
    <?php 
      if ($jenis=='penerbit'){
    ?>
    <div class="row-fluid  col-sm-12">
      <div class="row-fluid" id="target_info_sp">
        <br><br>
        Informasi dari jurnal Penerbit yang dapat anda dapatkan
      </div>

    </div>
<div class="row-fluid  col-sm-12">
    
     <div class="col-sm-11"  id="jurnal_artikel_infosp"></div>

  </div>  
    <?php
      }
    ?>
     <?php 
      if ($jenis=='issn'){
    ?>
    <div class="row-fluid  col-sm-12">
      <div class="row-fluid" id="target_info_si">
        <br><br>
        Informasi dari journal issn yang dapat anda dapatkan
      </div>

    </div>
     <div class="row-fluid  col-sm-12">
    
     <div class="col-sm-11"  id="jurnal_artikel_infosi"></div>

  </div>  

    <?php
      }
    ?>
    <?php 
    if ($jenis=='judul'){

      ?>
    <!-- detail information-->
    <div class="row-fluid  col-sm-12">
      <div class="col-sm-1">
     </div>
    
      <div class="col-sm-11" id="target_info">
        <br><br>
        Informasi dari jurnal yang dapat anda dapatkan
      </div>

    </div>
  <div class="row-fluid  col-sm-12">
      <div class="col-sm-1">
     </div>
    
      <div class="col-sm-11"  id="jurnal_artikel_info">

  </div>  

    </div>
      
  
    <?php }?>
	
	
    