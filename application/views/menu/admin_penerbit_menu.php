<script type="text/javascript">
    
    function laporandownload_penerbit(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin_penerbit/laporan_download',{},function (data){
            $('.divmask').hide();
            });

    }

    function view_data_direktori_penerbit(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin_penerbit/view_data_direktori',{},function (data){
            $('.divmask').hide();
            });        
    }
</script>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?php echo base_url();?>index.php/admin_penerbit"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                   
                    <li>
                        <a href="#" onclick="laporandownload_penerbit();">Download</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-database fa-fw"></i> Data<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                   
                    <li>
                        <a href="#" onclick="view_data_direktori_penerbit();">Jurnal</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
           
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>