<script type="text/javascript">
function group_user_form(){
	$('#modaladmin').load(base_url+'index.php/Referensi/show_group_user_form/',{},function (data){
	});
}
</script>
<div class="row-fluid">

	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">Group User</h1>
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<div class="row-fluid" align="right">
		<a href="#" data-toggle="modal" onclick="group_user_form();" data-target="#myModalDetailArtikel">
			<i class="fa fa-plus fa-fw"></i> Group User </a></li>
		</a>
	</div>
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<th width='10'>No</th>
			<th>Group User</th>
		</thead>
		<?php
			$no=1;
			foreach ($q_group_user->result() as $r_q_group_user) {
				echo '<tr>';
					echo '<td>'.$no.'</td>';
					echo '<td>'.$r_q_group_user->user_group.'</td>';
				echo '</tr>';
			$no++;
			}
		?>

	</table>

</div>