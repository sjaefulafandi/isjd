<br>
<script type="text/javascript">
						$(document).ready(function(){
							Morris.Bar({
						        element: 'baca_donlot_bar',
						        data:<?php echo $q_json_line;?>,
						        xkey: 'year',
						        ykeys: ['baca','donlot'],
						        labels: ['Terbaca','Di Unduh']
						      }).on('click', function(i, row){
							  //console.log(i, row);
							  //alert (row.year+'/'+row.value);
							 // $('#myModalChart').modal('Show');
							 $('#myModalChart').modal({ show: true });
							  $('#myModalChartTarget').load(base_url+'index.php/Artikel/show_detail_chart_line/'+row.year,{},function (data){});
							  //$('#modal-id').modal({ show: false });
					      	});
						});
						  
						</script>

						<!-- Modal -->  
<div class="modal fade bs-example-modal-sm" id="myModalChart" tabindex="-1" role="dialog" aria-labelledby="myModalChart" aria-hidden="true">
  <div class="modal-dialog modal-sm-12" id="myModalChartTarget">
  </div>
</div>
<b>Jumlah Baca/Ter Unduh Artikel </b>
<div id="baca_donlot_bar" style="height: 230px;"></div>

	