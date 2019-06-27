<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $row_user_baru;?></div>
                        <div>Anggota Baru!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left" onclick="user_baru();">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-download fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $row_download_artikel;?></div>
                        <div>Baru Diunduh !</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $row_quota_download;?></div>
                        <div>Order Kuota!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left" onclick="kuota();">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comment fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $row_q_amount_open_komplain;?></div>
                        <div>Komplain !</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left" onclick="user_komplain();">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row-fluid">
                    <div class="col-sm-3" id="chart1"></div>
                    <div class="col-sm-5" id="chart2"></div>
                    <div class="col-lg-4" id="chart3"></div>
                </div>
            </div>
            
        </div>
    </div>
     <div class="col-lg-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row-fluid">
                    <div class="col-sm-3" id="chart4"></div>
                    <div class="col-sm-5" id="chart5"></div>
                    <div class="col-lg-4" id="chart6"></div>
                    
                </div>
            </div>
            
        </div>
    </div>
     
</div>
                  

<script type="text/javascript">
$(document).ready(function(){

    loadchartadmin('chart_viewed_downloaded');
    loadchartadmin('chart_count_line');
    loadchartadmin('penerbit_baca');
    loadchartadmin('chart_count');
    loadchartadmin('author_baca');
    loadchartadmin('baca_download');


  
    });
function loadchartadmin(charts)
{
    
    switch (charts)
    {
    case 'chart_viewed_downloaded':
        $('.divmask').show();
        //$('#chart1').load(base_url+'index.php/Artikel/get_chart_viewed_downloaded',{},function (data){
            $('#chart1').load(base_url+'index.php/Artikel/get_user_public_count_all',{},function (data){
            $('.divmask').hide();
            });
    break;
    
    case 'chart_count_line':
        $('.divmask').show();
        $('#chart2').load(base_url+'index.php/Artikel/get_chart_artikel_per_tahun_line',{},function (data){
            $('.divmask').hide();
            });
    break;
    case 'penerbit_baca':
        $('.divmask').show();
        $('#chart3').load(base_url+'index.php/Artikel/get_penerbit_terbaca',{},function (data){
            $('.divmask').hide();
            });
    break;
    case 'author_baca':
        $('.divmask').show();
        $('#chart4').load(base_url+'index.php/Artikel/get_author_terbaca',{},function (data){
            $('.divmask').hide();
            });
    break;
    
    case 'chart_count':
        $('.divmask').show();
        $('#chart5').load(base_url+'index.php/Artikel/get_chart_baca_donlot_artikel_per_tahun_bar',{},function (data){
            $('.divmask').hide();
            });
    break;
    
    case 'baca_download':
        $('.divmask').show();
        $('#chart6').load(base_url+'index.php/Artikel/get_total_baca_donlot',{},function (data){
            $('.divmask').hide();
            });
    break;
    }
}

</script>
