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
  
  <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url()?>assets/css/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/css/plugins/metisMenu/metisMenu.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo base_url()?>assets/css/plugins/morris/morris.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/plugins/timeline/timeline.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/daterangepicker.css" rel="stylesheet">

    
    

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url()?>assets/css/sb-admin-2.css" rel="stylesheet">

    
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.confirm.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jurnalpdii_admin.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/daterangepicker.js"></script>
    
    <script src="<?php echo base_url()?>assets/js/plugin/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugin/morris/morris.js"></script>

    <script src="<?php echo base_url()?>assets/js/plugin/metisMenu/metisMenu.min.js"></script>
    
    
    <script src="<?php echo base_url()?>assets/js/jquery.knob.js"></script>
    <script src="<?php echo base_url()?>assets/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
  
  </head>
<!-- Bootstrap -->

<body>
<!-- Modal -->  
<div class="modal fade bs-example-modal-sm" id="myModalDetailArtikel" tabindex="-1" role="dialog" aria-labelledby="myModalDetailArtikel" aria-hidden="true">
  <div class="modal-dialog modal-sm-12" id="modaladmin">
  </div>
</div>

<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../masuk">ISJD Admin</a>
            </div>
            <!-- /.navbar-header -->
            <?php echo $content_header;?>
            <?php echo $content_menu;?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php echo $content_worksheet;?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	
	
<div style="display:none" class="divmask" >&nbsp;</div>

 </body>
 </html>