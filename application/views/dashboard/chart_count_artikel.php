
<script type="text/javascript">
						$(document).ready(function(){
						Morris.Donut({
					        element: 'donut-example',
					        data: <?php echo $q_json;?>,
					      //formatter: function (x) { return x }
							}).on('click', function(i, row){
							  //console.log(i, row);
							  alert (row.label+'/'+row.value);
							  // $('#modal-id').modal({ show: true });
					      });
						});
						
						</script>
						<div id="donut-example" style="height: 230px;"></div>
					</div>