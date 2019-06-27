<head>
	  <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo base_url()?>assets/css/plugins/morris/morris.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/plugins/timeline/timeline.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/datepicker.css" rel="stylesheet">
</head>
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Detail Chart <?php echo $tahun;?></b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	
	<div class="modal-body">
			<script type="text/javascript">
						$('#myModalChart').on('shown.bs.modal', function (e) {
							//$( "#chart_per_month" ).empty(); 
							 setTimeout(function() {
							 $( "#chart_per_month" ).empty(); 
								var myChart = new Morris.Line({
								element: 'chart_per_month',
								data: <?php echo $q_json_line_month;?>,
								xkey: 'month',
								ykeys: ['value'],
								parseTime:false,
								labels: ['Value'],
								});
							}, 1200); // set timeout
							

						});	
						/*$(document).ready(function(){
							Morris.Line({
						        element: 'chart_per_month',
						        data:<?php echo $q_json_line_month;?>,
						        xkey: 'month',
						        ykeys: ['value'],
						        labels: ['value']
						     });
						});
						 */ 
						</script>
			
				
						
			<div id="chart_per_month" style="height: 230px;"></div>	
	</div>
	<div class="row-fluid modal-footer">
		<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
			      
	</div>
</div>



