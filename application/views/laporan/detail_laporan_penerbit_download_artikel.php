
<script>
function get_xls_laporan_penerbit_download_artikel_link(tanggal_start,tanggal_end){
	//alert(tanggal_end);
	//alert('hai');
	var form = document.createElement("form");
	form.setAttribute("method", "post");
	form.setAttribute("action", base_url+"index.php/admin_penerbit/get_xls_laporan_penerbit_download_artikel");

	form.setAttribute("target", "view");

	var hiddenField = document.createElement("input"); 
	hiddenField.setAttribute("type", "hidden");
	hiddenField.setAttribute("name", "tanggal_start");
	hiddenField.setAttribute("value", tanggal_start);
	form.appendChild(hiddenField);
	document.body.appendChild(form);

	var hiddenField2 = document.createElement("input"); 
	hiddenField2.setAttribute("type", "hidden");
	hiddenField2.setAttribute("name", "tanggal_end");
	hiddenField2.setAttribute("value", tanggal_end);
	form.appendChild(hiddenField2);
	document.body.appendChild(form);

	form.submit();

	//window.open(base_url+'index.php/admin/get_xls_kuota','TheWindow');
	//window.open('', 'TheWindow');
	//document.getElementById('TheForm').submit();
	//$('#debug').load(base_url+'index.php/admin/get_xls_kuota/',{"tanggal_start":tanggal_start,"tanggal_end":tanggal_end},function (data){
	//		});
}
</script>

<div>
	<a href="#" onclick="get_xls_laporan_penerbit_download_artikel_link('<?php echo $range_tanggal[0];?>','<?php echo $range_tanggal[1];?>','<?php echo $jk;?>')" >
			<i class="fa fa-file-excel-o fa-fw"></i> Laporan Artikel </a></li>
			<div id="debug"></div>
		</a>
</div>
	
