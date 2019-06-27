<script type="text/javascript">

$(document).ready(function(){

	loadchart('chart_viewed_downloaded');
	loadchart('chart_count_line');
	loadchart('penerbit_baca');
	loadchart('chart_count');
	loadchart('author_baca');
	loadchart('baca_download');


	
	});

function loadchart(charts)
{
	
	switch (charts)
	{
	case 'chart_viewed_downloaded':
		$('.divmask').show();
		//$('#chart1').load(base_url+'index.php/Artikel/get_chart_viewed_downloaded',{},function (data){
			$('#chart1').load(base_url+'index.php/Artikel/get_user_public_count_all',{},function (data){
			$('.divmask').hide();
			});
	break;
	
	case 'chart_count_line':
		$('.divmask').show();
		$('#chart2').load(base_url+'index.php/Artikel/get_chart_artikel_per_tahun_line',{},function (data){
			$('.divmask').hide();
			});
	break;
	case 'penerbit_baca':
		$('.divmask').show();
		$('#chart3').load(base_url+'index.php/Artikel/get_penerbit_terbaca',{},function (data){
			$('.divmask').hide();
			});
	break;
	case 'author_baca':
		$('.divmask').show();
		$('#chart4').load(base_url+'index.php/Artikel/get_author_terbaca',{},function (data){
			$('.divmask').hide();
			});
	break;
	
	case 'chart_count':
		$('.divmask').show();
		$('#chart5').load(base_url+'index.php/Artikel/get_chart_baca_donlot_artikel_per_tahun_bar',{},function (data){
			$('.divmask').hide();
			});
	break;
	
	case 'baca_download':
		$('.divmask').show();
		$('#chart6').load(base_url+'index.php/Artikel/get_total_baca_donlot',{},function (data){
			$('.divmask').hide();
			});
	break;
	}
}

</script>
<div class="panel panel-default">
  <div class="panel-heading">
  	<div class="col-sm-4">
  		<i class="fa fa-bar-chart-o fa-fw"></i> Statistik
  	</div>
  	<div align="right">
  			<a href="<?php echo base_url().'index.php/public_no_login/dashboard';?>">Detail </a>
  	</div>	  				
  </div>

	<div class="panel-body" >
		<div class="row-fluid">
			<div class="col-sm-5" id="chart2"></div>
		</div>	<!-- end of row fluid panel body -->
		
    <div class="row-fluid">
			<div class="col-sm-5" id="chart2"></div>
			
      <div class="col-sm-3" id="chart1"></div>
			<div class="col-sm-4" id="chart3"></div>
		</div>	<!-- end of row fluid panel body -->
		
		<div class="row-fluid col-lg-12" >
			<div class="col-lg-3" id="chart4"></div>
			<div class="col-lg-6" id="chart5"></div>
			<div class="col-lg-3" id="chart6"></div>
			
					</div>
	</div> <!-- end of panel body -->
	  <div class="panel-footer">
	  	<div class="row" id="footerdashboard">

	  	</div>
	  </div>
</div>	<!-- panel default -->
	
