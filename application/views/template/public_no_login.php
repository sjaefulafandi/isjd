<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISJD</title>
<script type="text/javascript">
var base_url="<?php echo base_url();?>";
</script>	
<head>
  <link href="<?php echo base_url()?>assets/images/isjd_logo3.ico" rel="shortcut icon" >
  
  <link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url()?>assets/css/jurnalpdii.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url()?>assets/css/token-input.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url()?>assets/css/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo base_url()?>assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/plugins/timeline/timeline.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/daterangepicker.css" rel="stylesheet">


    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet">
  
  </head>
<!-- Bootstrap -->
	
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
	<!--<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.autocomplete.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/ajaxfileupload.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.confirm.js"></script>
	<script src="<?php echo base_url()?>assets/js/plugin/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugin/morris/morris.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/daterangepicker.js"></script>
	
	<script src="<?php echo base_url()?>assets/js/jquery.knob.js"></script>
 	<script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>
 	<script src="<?php echo base_url()?>assets/js/jquery.tokeninput.js"></script>
	<script src="<?php echo base_url()?>assets/js/jurnalpdii.js"></script>
	
<body>
	<!-- Modal -->	
	<div class="modal fade bs-example-modal-sm" id="myModalDetail" name="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalDetail" aria-hidden="true">
	  <div class="modal-dialog modal-sm-12" id="modaltarget" name="modaltarget">
	  </div>
	 
	</div>
	<!-- baris ke satu -->
	
    <div class="row-fluid row-font-size row-no-gutter col-sm-12 " >
		<div class="col-sm-1 " ></div>
		<div class="col-sm-10" id="header_logo" >
	    		<div class="col-sm-11 " >
	    		<img src="<?php echo base_url();?>assets/images/isjd_logo1.png"></img>
	    		</div>
	    		<!--<div class="col-sm-1 text-right " >
	    		<img src="<?php echo base_url();?>assets/images/Logo_LIPI.jpg" height="50"></img>
	    		</div>
	    		<div class="col-sm-1 text-right " >
	    		
	    		 <img src="<?php echo base_url();?>assets/images/twh_logo3.jpg" height="50"></img> 
	    		</div> --->
	    </div>
	    <div class="col-sm-1" ></div>
    </div>
    <!-- baris ke dua -->
    
    <div class="row-fluid row-font-size row-no-gutter col-sm-12 " >
		<div class="col-sm-1 " ></div>
		<div class="col-sm-10"  >
			<br>
	            <?php echo $content_header;?>
	     </div>
	    <div class="col-sm-1" ></div>
    </div>
    <!-- baris report-->
	
	 <div class="row-fluid row-font-size row-no-gutter col-sm-12 " >
		<div class="col-sm-1 " ></div>
		<div class="col-sm-10 " align="justify" >
			<br>
			<?php echo $content_worksheet;?>
			<br><br>
		</div>
	    <div class="col-sm-1" ></div>
    </div>
    
	<!-- baris ke dua -->
   
	<div class="row-fluid row-font-size row-no-gutter col-sm-12 " >
		<div class="col-sm-1 " ></div>
		  <div class="col-sm-10 " align="justify">
					<?php echo $search_bar;?>
	    </div>
	  <div class="col-sm-1" ></div>
  </div>                                       
	
	<div class="row-fluid row-font-size row-no-gutter col-sm-12 " >
		<div class="col-sm-1 " ></div>
	  <div class="col-sm-10 " align="justify">
				<?php echo $content_report;?>
    </div>
    <div class="col-sm-1" ></div>
  </div>   
	
	<!-- baris footer-->
	<div class="row-fluid row-font-size row-no-gutter col-sm-12 " >
		<div class="col-sm-1" ></div>
		<div class="col-sm-10 " ><br></br>
			<small>
	    	Pusat Dokumentasi dan Informasi Ilmiah (PDII - LIPI), Jl. Jend. Gatot Subroto No. 10 Jakarta 12710 Telp. 021-5733465 ext 3508, 3501 | Fax. 021-5733467
			</small>
	    </div>
	    <div class="col-sm-1 " ></div>
    </div>
	
	
<div style="display:none" class="divmask" >&nbsp;</div>

 </body>
