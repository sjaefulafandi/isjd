<script type="text/javascript">
						$(document).ready(function(){
							Morris.Line({
						        element: 'line-example',
						        data:<?php echo $q_json_line;?>,
						        xkey: 'year',
						        ykeys: ['value'],
						        labels: ['Value']
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
<b>Jumlah Artikel per Tahun [<?php echo $filter;?>]</b>
<div id="line-example" style="height: 230px;"></div>

	