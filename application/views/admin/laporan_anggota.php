
<script>
	function tampilkan_laporan_anggota(){
		var tanggal_pilih=$('#reportrange span').html();
		var selgroupmember=$('#selgroupmember option:selected').val();
		var selgroupmember_text=$('#selgroupmember option:selected').text();
		
		$('#target_hasil_laporan').load(base_url+'index.php/admin/detail_laporan_anggota',{"tanggal_pilih":tanggal_pilih,"selgroupmember":selgroupmember,"selgroupmember_text":selgroupmember_text},function (data){});
	}

	
</script>

<div class="row-fluid col-lg-12">
	<div class="col-lg-5"> Tanggal Register :<br>
		 <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
		    <i class="fa fa-calendar"></i>&nbsp;
		    <span ></span> <b class="caret"></b>
		</div>
	</div>
	<div class="col-lg-3"> Group Member :<br>
			<select class="form-control" id="selgroupmember" name="selgroupmember">
				<option value="0">Seluruhnya</option>
				<?php
				foreach ($q_group_user->result() as $r_q_group_user)
					{
				?>
					<option value="<?php echo $r_q_group_user->id_user_group;?>"><?php echo $r_q_group_user->user_group;?></option>
				<?php
					} //end of loop q_group_user
				?>
			</select>
	</div>
	<div class="col-lg-1"><br>
		<input type="button" value="cari" onclick="tampilkan_laporan_anggota()">
	</div>

</div>
<div class="row-fluid col-lg-12">
		
</div>
 <div class="row-fluid" id="target_hasil_laporan">
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
  