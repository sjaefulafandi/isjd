
<script>
  function tampilkan_laporan_anggota(){
    var tanggal_pilih=$('#reportrange span').html();
    var jk=$('input[name=jk]:checked').val();
       
    $('#target_hasil_laporan_penerbit').load(base_url+'index.php/admin_penerbit/detail_laporan_penerbit',{"tanggal_pilih":tanggal_pilih,"jk":jk},function (data){});
    
  }

  
</script>
<div class="row-fluid">
Laporan Download Artiel / User untuk artikel yang diterbitkan
</div>
<div class="row-fluid">
  <div class="row-fluid col-lg-12">
    <div class="col-lg-3">
      <input type="radio" id="jk1" name="jk" value="download_artikel" data-error="#error_jk" checked >Artikel
        <input type="radio" id="jk2" name="jk" value="download_user" data-error="#error_jk"> User
    
    </div>
    <div class="col-lg-7">
       
       <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
          <i class="fa fa-calendar"></i>&nbsp;
          <span ></span> <b class="caret"></b>
      </div>
    </div>
    <div class="row-fluid col-lg-1">
      <input type="button" value="cari" onclick="tampilkan_laporan_anggota()">
    </div>  
  </div>
  
  <div class="row-fluid" id="target_hasil_laporan_penerbit">
  </div>
</div>
 
<script type="text/javascript">
 function cb(start, end) {
        $('#reportrange span').html(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    }
    cb(moment().subtract(29, 'days'), moment());

    $('#reportrange').daterangepicker({
        ranges: {
           'Hari Ini': [moment().subtract(0, 'days'), moment().subtract(0, 'days')],
           'Sejak Kemarin': [moment().subtract(1, 'days'), moment().subtract(0, 'days')],
           '7 Hari Terakhit': [moment().subtract(6, 'days'), moment()],
           '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
           'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
           'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

</script>
  </div>
  
</div> <!-- end of row -->
  