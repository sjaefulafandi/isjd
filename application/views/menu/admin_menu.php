<script type="text/javascript">
    function user_baru(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin/show_user_baru',{},function (data){
            $('.divmask').hide();
            });

    }
    function user_komplain(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin/show_komplain_user',{},function (data){
            $('.divmask').hide();
            });

    }
    function user_all(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin/show_user_all',{},function (data){
            $('.divmask').hide();
            });

    }
    function tarif(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/Referensi/show_tarif',{},function (data){
            $('.divmask').hide();
            });        
    }
    function groupuser(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/Referensi/show_group_user',{},function (data){
            $('.divmask').hide();
            });        
    }
     function kota(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/Referensi/show_kota',{},function (data){
            $('.divmask').hide();
            });        
    }
    function kuota(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/Transaksional/show_transaksional_kuota',{},function (data){
            $('.divmask').hide();
            });           
    }
    function laporankuota(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin/laporan_kuota',{},function (data){
            $('.divmask').hide();
            });

    }
    function laporananggota(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin/laporan_anggota_idx',{},function (data){
            $('.divmask').hide();
            });

    }
    function laporandownload(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin/laporan_download',{},function (data){
            $('.divmask').hide();
            });

    }
    function laporanartikel(){
        $('.divmask').show();
        $('#page-wrapper').empty();
        $('#page-wrapper').load(base_url+'index.php/admin/laporan_artikel_idx',{},function (data){
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
                <a href="<?php echo base_url();?>index.php/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <!-- <li>
                        <a href="#" >Tarif</a>
                    </li>
                -->
                    <li>
                        <a href="#" onclick="laporanartikel();">Artikel</a>
                    </li>
                     <li>
                        <a href="#" onclick="laporananggota();">Anggota</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <li>
                <a href="#"><i class="fa fa-edit fa-fw"></i> Anggota<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#" onclick="user_baru();">Baru</a>
                    </li>
                    <li>
                        <a href="#" onclick="user_all();">Seluruh Anggota</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-comment fa-fw"></i> Komplain<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#" onclick="user_komplain();">Daftar Komplain</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <!--<li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Referensi<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#" onclick="tarif();">Tarif</a>
                    </li>
                    <li>
                        <a href="#" onclick="groupuser();">Group User</a>
                    </li>
                     <li>
                        <a href="#" onclick="kota();">Kota</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" onclick="kuota();"><i class="fa fa-wrench fa-fw"></i> Transaksi Kuota </a>
                
            </li>-->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>