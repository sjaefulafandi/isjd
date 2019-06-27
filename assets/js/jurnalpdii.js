
$(document).ready(function(){
	
	loadchart('chart_viewed_downloaded');
});
function loadchart(charts)
{
	switch (charts)
	{
	case 'chart_viewed_downloaded':
		$('.divmask').show();
		$('#chart1').load(base_url+'index.php/Artikel/get_chart_viewed_downloaded',{},function (data){
			$('.divmask').hide();
			});
	break;
	}
}

$(function () {
    $(".btn-slide").click(function(){
  	 
  	  $("#panel").slideToggle("slow",function (){});
  	  $(".btn-slide").toggleClass("down");
  	});
  	$(".btn-slide-pembuka").click(function(){
  	 
  	  $("#panel-pembuka").slideToggle("slow",function (){});
  	  $(".btn-slide-pembuka").toggleClass("down");
  	});
    
}); 

//tab handle
function activaTab(tab){
	    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
	};
	
	function loadpanel(panel)
	{
		switch (panel)
		{
		case 'artikel':
			$('.divmask').show();
			$('#paneltarget').load(base_url+'index.php/Artikel/get_artikel',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'artikel_author':
			$('.divmask').show();
			$('#paneltargetauthor').load(base_url+'index.php/Artikel/get_artikel_author',{},function (data){
				$('.divmask').hide();
				});
		break;

		case 'artikel_bidang':
			$('.divmask').show();
			$('#paneltargetbidang').load(base_url+'index.php/Artikel/get_artikel_bidang/All/Kategori',{},function (data){
				$('.divmask').hide();
				});
		break;

		
		// case per direktori
		case 'Judul':
			$('.divmask').show();
			$('#Judul').load(base_url+'index.php/Jurnal/get_jurnal',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'Subjek':
			$('.divmask').show();
			$('#Subjek').load(base_url+'index.php/Jurnal/get_jurnal_subjek',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'Penerbit':
			$('.divmask').show();
			$('#Penerbit').load(base_url+'index.php/Jurnal/get_jurnal_penerbit',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'ISSN':
			$('.divmask').show();
			$('#ISSN').load(base_url+'index.php/Jurnal/get_jurnal_issn',{},function (data){
				$('.divmask').hide();
				});
		break;

		//user public
		case 'dPembayaran':
			$('.divmask').show();
			$('#dPembayaran').load(base_url+'index.php/user_public/show_kuota_detail',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'dInformasi':
			$('.divmask').show();
			$('#dInformasi').load(base_url+'index.php/user_public/show_informasi_tarif',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'dRekamjejak':
			$('.divmask').show();
			$('#dRekamjejak').load(base_url+'index.php/user_public/show_history_user',{},function (data){
				$('.divmask').hide();
				});
		break;
		case 'dKomplain':
			$('.divmask').show();
			$('#dKomplain').load(base_url+'index.php/user_public/show_komplain_user',{},function (data){
				$('.divmask').hide();
				});
		break;

		case 'dProfile':
			$('.divmask').show();
			$('#dProfile').load(base_url+'index.php/user_public/show_user_profile',{},function (data){
				$('.divmask').hide();
				});
		break;

		// penerbit
		case 'pdashboard':
			$('.divmask').show();
			$('#pdashboard').load(base_url+'index.php/admin_penerbit/show_dashboard',{},function (data){
				$('.divmask').hide();
				});

		break;

		case 'pdata':
			$('.divmask').show();
			$('#pdata').load(base_url+'index.php/admin_penerbit/show_artikel_per_tahun',{},function (data){
				$('.divmask').hide();
				});

		break;

		case 'pdatasubjek':
			$('.divmask').show();
			$('#pdatasubjek').load(base_url+'index.php/admin_penerbit/show_artikel_per_subjek',{},function (data){
				$('.divmask').hide();
				});

		break;

		case 'pdataprofil':
			$('.divmask').show();
			$('#pdataprofil').load(base_url+'index.php/admin_penerbit/change_profil',{},function (data){
				$('.divmask').hide();
				});

		break;

		case 'pdatabidang':
			$('.divmask').show();
			$('#pdatabidang').load(base_url+'index.php/admin_penerbit/show_artikel_per_bidang',{},function (data){
				$('.divmask').hide();
				});

		break;

		}// enf of swich case load panel

	} // end of function loadpanel

// user public handling
function add_kuota_form(id_tarif_download){
			$('#modaltarget').load(base_url+'index.php/user_public/show_kuota_form/'+id_tarif_download,{},function (data){
				});	
	}//end of kuota form

// form daftar user 
function loadformdaftar(){
		$('#infousers').load(base_url+'index.php/user_public/get_form_user_registration/',{},function (data){
			});		
}//end of load form daftar

//registrasi
function saveformdaftar(){
	$("#user_public_submission_form").validate
	({
	 	rules:{
	 		nama_lengkap:"required",
	 		emails:{
	 			required:true,
	 			email:true
	 		},
	 		passwords:{
	 			required:true,
	 			minlength:5
	 		}
	 	},
	 	messages :{
	 		nama_lengkap:"Mohon nama lengkap anda diisi",
	 		emails:"Masukkan email dengan benar",
	 		passwords:{
	 			required:"Password tidak boleh kosong",
	 			minlength:"Panjang password paling sedikit 5 karakter"
	 		}
	 	},
	 	
	 	submitHandler: function(form) {
            form.submit();
        }
 	}); // end of validate

}//end saveformdaftar

function add_komplain(){
	$('modaltarget').empty();
	$('#modaltarget').load(base_url+'index.php/user_public/show_komplain_form/',{},function (data){});	
}//end add_komplain
function add_komplain_detail_form(id_user_complain){
	$('modaltarget').empty();
	//alert(id_user_complain);
	$('#modaltarget').load(base_url+'index.php/user_public/show_komplain_detail_form',{"id_user_complain":id_user_complain},function (data){});	
}//ennd of add_komplain_detail_form
function refresh_komplain(){
	loadpanel('dKomplain');
	$('#myModalDetail').modal('hide');
} // end refresh_komplain


/*
handle export xls file
*/
function exportexceluserall(){
		
		var r = confirm("Apakah anda akan mendownload data User ??");
		if (r == true) {
		    //alert ('hai');
		   	$('#myModalDetailArtikel').modal('hide');
		   	//window.open(base_url+'index.php/admin/get_xls_users/');

		    //alert('haa');
		} else {
		    $('#myModalDetailArtikel').modal('hide');
		    
		    //$('#modaladmin').modal('hide');

		}
}// end of exportuserall