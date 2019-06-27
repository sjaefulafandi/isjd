<?php 
$r_data=$q_data->row();
?>
	
					  T: <span class="badge" style="color:#87CEEB;background-color:#eee;" >
				<?php echo number_format($r_data->jumlah_artikel);?>
</span>
						<i class="fa fa-search fa-fw"></i> :<span class="badge" style="color:#ffec03;background-color:#eee;" >
						<?php echo number_format($r_data->jumlah_baca);?>
						</span>
						<i class="fa fa-download fa-fw"></i>:<span class="badge" style="color:green;background-color:#eee;">
						<?php echo number_format($r_data->jumlah_download);?>
						</span>
						
						<div style="position:relative;width:350px;margin:autho;top:10px">
							
							<div style="position:absolute;left:60px;top:60px">
								 <!-- <input class="knob" data-width="170" data-fgColor="#ffec03" data-skin="tron" value="75" data-thickness=".1">  -->
							<input type="text" value="<?php echo $r_data->jumlah_download;?>" data-width="80" data-fgColor="green" data-thickness=".3" data-displayInput="false" class="downloaded" data-entryid="your_dataentry_id" >
									<script>
									    $(function() {
									    	$(".downloaded").knob( {
									    			'min':0,
										    	    'max':<?php echo $r_data->jumlah_artikel;?>,
										    	     release : function (value) {
									                   // alert(this.$.attr('data-entryid')); 
									                    alert("release : " + value);
									                },
									    	});
									    	

									    });
									</script>	
										
							</div>
							
							<div style="position:absolute;left:35px;top:35px">
								 <!-- <input class="knob" data-width="170" data-fgColor="#ffec03" data-skin="tron" value="75" data-thickness=".1">  -->
							<input type="text" value="<?php echo $r_data->jumlah_baca;?>" data-width="130" data-fgColor="#ffec03" data-thickness=".3" data-displayInput="false" class="viewed">
									<script>
									    $(function() {
									    	$(".viewed").knob( {'min':0,
										    	    'max':<?php echo $r_data->jumlah_artikel;?>,
										    	    'readOnly':true
									    	});
									    });
									</script>	
										
							</div>
							<input type="text" value="<?php echo $r_data->jumlah_artikel;?>" data-width="200" data-fgColor="#87CEEB" data-thickness=".3" data-displayInput="false" class="total">
							<script>
							    $(function() {
							    	$(".total").knob({
							    	    'min':0,
							    	    'max':<?php echo $r_data->jumlah_artikel;?>,
							    	    'readOnly':true
							    	});
							    });
							</script>
						</div>