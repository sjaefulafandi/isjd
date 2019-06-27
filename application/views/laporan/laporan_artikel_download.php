
<script>
	function tampilkan_laporan_artikel_download(){
		var tanggal_pilih=$('#reportrange_ar_d span').html();
		$('#target_hasil_laporan_download').load(base_url+'index.php/admin/detail_laporan_artikel_download',{"tanggal_pilih":tanggal_pilih},function (data){});
	}

	
</script>
<div class="row-fluid col-lg-12">

		<div class="col-lg-5"> Rentang Tanggal :
			 <div id="reportrange_ar_d" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
			    <i class="fa fa-calendar"></i>&nbsp;
			    <span ></span> <b class="caret"></b>
			</div>
		</div>
		<div class="col-lg-2"><br>
			<input type="button" value="cari" onclick="tampilkan_laporan_artikel_download()">
		</div>
</div>
	

 <div class="row-fluid" id="target_hasil_laporan_download">
</div>

<script type="text/javascript">
 function cb(start, end) {
        $('#reportrange_ar_d span').html(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    }
    cb(moment().subtract(29, 'days'), moment());

    $('#reportrange_ar_d').daterangepicker({
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
  