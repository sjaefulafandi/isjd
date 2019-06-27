
<script>
	function tampilkan_laporan_user_pasif(){
		var tanggal_pilih=$('#reportrange_up span').html();
		var selgroupmember=$('#selgroupmember_up option:selected').val();
		var selgroupmember_text=$('#selgroupmember_up option:selected').text();
		

		$('#target_user_pasif').load(base_url+'index.php/admin/detail_laporan_user_pasif',{"tanggal_pilih":tanggal_pilih,"selgroupmember":selgroupmember,"selgroupmember_text":selgroupmember_text},function (data){});
	}

	
</script>
<div class="row-fluid col-lg-12">
			<div class="col-lg-3"> Group Anggota :
				<select class="form-control" id="selgroupmember_up" name="selgroupmember_up">
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
	
		<div class="row-fluid col-lg-2"><br>
			<input type="button" value="cari" onclick="tampilkan_laporan_user_pasif()">
		</div>
	<br><br><br>
	

</div>
 <div class="row-fluid" id="target_user_pasif"></div>
<script type="text/javascript">
 function cb(start, end) {
        $('#reportrange_up span').html(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    }
    cb(moment().subtract(29, 'days'), moment());

    $('#reportrange_up').daterangepicker({
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
  