<div class="modal-content">
		    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>		
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Info</b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	<div class="modal-body">
			<div class="row">
				<div class="col-sm-10"> 
					Apakah anda ingin mendownload <b><?php echo $info;?></b>
				</div>
			</div>
			
	</div>
	<div class="row-fluid modal-footer">
		<button type="button" class="btn btn-default btn-xs" onclick="executedownload('<?php echo $jenisdownload;?>');" >Ya </button>
	 	<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
		      
	</div>
</div>