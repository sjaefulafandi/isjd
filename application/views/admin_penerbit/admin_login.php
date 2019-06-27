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
    
    

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url()?>assets/css/sb-admin-2.css" rel="stylesheet">
  
  </head>
<!-- Bootstrap -->

<body>
	<div class='row-fluid'>
		<div class="col-sm-4"></div>
		<div class="col-sm-6">	
			<table>
				<tr>
					<td>
						<br><br><br><br><br>
						<blockquote >
						<h5>
						
						Selamat datang, Penerbit (IDJS)
						
						<small >Terimakasih, Tim - IDJS </small> <br>

						</h5>
						</blockquote>
						<!-- <div ><i class="fa fa-users fa-1x"></i> Anggota Baru (<?php echo $row_user_baru;?>)</div> -->
                        

						<form class="form-inline" action="<?php echo base_url()?>index.php/admin_penerbit/check_user" method="post">
							 <input type="text" class="form-control input-sm" name="user_id" placeholder="put your user id">
							 <input type="password" class="form-control input-sm" name="passwords" placeholder="put your password">
							 <button class="btn btn-primary btn-xs" type="submit">Log In</button>
							 <a href="#" data-toggle="tooltip" title="user id & password are same as you log in to your computer"><i class="icon-info-sign"></i></a>
							<br>
							<?php if ($error_users!=""){?>
						    <div class="alert alert-warning">
						    	<button type="button" class="close" data-dismiss="alert">&times;</button>
						    	<strong>Warning!</strong> <?php echo $error_users;?>.
						    </div>
						    <?php }//end if error users?>
						    
							</form>
						    
					</td>
				</tr>
			</table>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.confirm.js"></script>
	
	<script src="<?php echo base_url()?>assets/js/plugin/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugin/morris/morris.js"></script>

    <script src="<?php echo base_url()?>assets/js/plugin/metisMenu/metisMenu.min.js"></script>
    
	
	<script src="<?php echo base_url()?>assets/js/jquery.knob.js"></script>
	<script src="<?php echo base_url()?>assets/js/sb-admin-2.js"></script>
 	<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
	
<div style="display:none" class="divmask" >&nbsp;</div>

 </body>
 </html>