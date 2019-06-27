	<script type="text/javascript">
  function findjurnalISSN(){
    var keyword_text=$('#keyword_texti').val();
    $('.divmask').show();
    $('#ISSN').empty();
    $('#ISSN').load(base_url+'index.php/Jurnal/get_jurnal_issn',{"keyword_text":keyword_text,"jenis":'issn'},function (data){
    $('.divmask').hide();
      
      });
  }
  function viewdetailjurnalISSN(issn){
      $('#target_info_i').empty();
      $('.divmask').show();
      $('#target_info_i').load(base_url+'index.php/Jurnal/get_jurnal/',{"keyword_text":issn,"jenis":'issn'},function (data){
      $('.divmask').hide();
        });   
  }
   

</script>
  	<div class="row-fluid  col-sm-12">
      <div class="row-fluid">
      <br>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" value="<?php echo $keyword_text;?>" id="keyword_texti" placeholder="Search for...">
            <span class="input-group-btn">
            <button onclick="findjurnalISSN();" class="btn btn-default" type="button">
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
              <td>ISSN / Jumlah Jurnal</td>
            </tr>
            <?php 
            $no_urut=$offset+1;
            foreach ($query_jurnal_issn->result() as $row_jurnal_issn ){
            ?>
            <tr>
              <td>
                <!--- <a href="#" data-toggle="modal" onclick="viewdetailjurnal('<?php echo $row_jurnal->id_direktori;?>')" data-target="#myModalDetail">
                <i class="fa fa-search"></i>
              --> 
              <a href="#" onclick="viewdetailjurnalISSN('<?php echo $row_jurnal_issn->issn;?>')">
                <i class="fa fa-search"></i>
              </a>
              </td>
              <td align="justify">
                <?php 
                $findstring=strtolower($keyword_text);
                $jurnalstring=strtolower($row_jurnal_issn->issn);
                //echo $findstring.';'.$jurnalstring;
                $jurnalreplace=str_replace($findstring,'<span class="label label-info" style="font-size:12px">'.$findstring.'</span>',$jurnalstring);
                echo ucfirst($jurnalreplace).'/'.$row_jurnal_issn->jum_jurnal; 
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

    </div>

    <!-- detail information-->
   
    <div class="row-fluid  col-sm-12">
      <div class="row-fluid" id="target_info_i">
        <br><br>
        Informasi dari jurnal per issn yang dapat anda dapatkan
      </div>

    </div>
    