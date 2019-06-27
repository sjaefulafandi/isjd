
$(document).ready(function(){
	
	//loadchart('chart_viewed_downloaded');
});

/*
handle export xls file
*/
function executedownload(jenisdownload){
		
		//var r = confirm("Apakah anda akan mendownload data User ??");
		//if (r == true) {
		switch (jenisdownload)
		{
		case 'userall':
		    $('#myModalDetailArtikel').modal('hide');
	   		window.open(base_url+'index.php/admin/get_xls_users');

		   break;
		}	
		//} else {
		 //   $('#myModalDetailArtikel').modal('hide');
		    
		    //$('#modaladmin').modal('hide');

		//}
		
		
}// end of exportuserall

function loaddownload(jenisdownload)
	{
		switch (jenisdownload)
		{
		case 'userall':
			//$('.divmask').show();
			//$('#paneltarget').load(base_url+'index.php/Artikel/get_artikel',{},function (data){
			//	$('.divmask').hide();
			//	});
			$('#modaladmin').load(base_url+'index.php/admin/test_load',{},function (data){});
			
		break;
		}
	}

function activaTabAdmin(tab){
	    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
	};
	
	function loadpaneladmin(panel)
	{
		switch (panel)
		{
		case 'la_anggota_per_group':
			$('.divmask').show();
			$('#la_anggota_per_group').load(base_url+'index.php/admin/laporan_anggota',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'la_kuota_per_group':
			$('.divmask').show();
			$('#la_kuota_per_group').load(base_url+'index.php/admin/laporan_kuota',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'la_download_per_group':
			$('.divmask').show();
			$('#la_download_per_group').load(base_url+'index.php/admin/laporan_download',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'la_gender_per_group':
			$('.divmask').show();
			$('#la_gender_per_group').load(base_url+'index.php/admin/laporan_gender',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'la_kota_per_group':
			$('.divmask').show();
			$('#la_kota_per_group').load(base_url+'index.php/admin/laporan_user_kota',{},function (data){
				$('.divmask').hide();
				});
		break;
		//laporan artikel
		case 'la_artikel_baca_download':
			$('.divmask').show();
			$('#la_artikel_baca_download').load(base_url+'index.php/admin/laporan_artikel_baca_download',{},function (data){
				$('.divmask').hide();
				});
		break;
		//la_user_pasif
		case 'la_user_pasif':
			$('.divmask').show();
			$('#la_user_pasif').load(base_url+'index.php/admin/laporan_user_pasif',{},function (data){
				$('.divmask').hide();
				});
		break;
		}
		
	}