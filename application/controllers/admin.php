<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Nama Controller	: Admin
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 4 Mei 2015
 * Penjelasan		: 
 * 
 */
class admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_users_admin');
		$this->load->model('model_users_public');
		$this->load->model('model_referensi');
		$this->load->model('model_artikel');
		$this->load->library('Validations');
		$this->load->library('Jquery_pagination');
	}
	

	function index(){
		if ($this->session->userdata('user_id')<>NULL){

			$this->after_login();
		}else{
			$this->session->sess_destroy();
			$this->load_login_form();	
		}
	}
	function load_login_form($error_users=NULL){
		$data['error_users']=$error_users;
		//info user baru
		$q_user_baru=$this->model_users_admin->find_user_public_need_approve();
		$row_user_baru=$q_user_baru->num_rows();
		$data['row_user_baru']=$row_user_baru;

		$this->load->view('admin/admin_login',$data);
		
	}

	function after_login(){
		//find new user
		$this->validations->check_user_admin_session_is_there();

		$q_user_baru=$this->model_users_admin->find_user_public_need_approve();
		$row_user_baru=$q_user_baru->num_rows();
		$datadashboard['row_user_baru']=$row_user_baru;

		//finde new download
		$q_download_artikel=$this->model_artikel->get_new_download_artikel();
		$row_download_artikel=$q_download_artikel->num_rows();
		$datadashboard['row_download_artikel']=$row_download_artikel;

		//find quota approval
		$q_quota_download=$this->model_users_public->get_detail_quota_approval();
		$row_quota_download=$q_quota_download->num_rows();
		$datadashboard['row_quota_download']=$row_quota_download;

		//find amount of complain
		$q_amount_open_komplain=$this->model_users_admin->get_amount_open_komplain();
		$row_q_amount_open_komplain=$q_amount_open_komplain->num_rows();
		$datadashboard['row_q_amount_open_komplain']=$row_q_amount_open_komplain;

	
		$this->template->set_template('admin_template');
		$this->template->write_view('content_header','menu/admin_menu_header',$datadashboard);
		$this->template->write_view('content_menu','menu/admin_menu');
		$this->template->write_view('content_worksheet','dashboard/admin_dashboard',$datadashboard);
		$this->template->render();
	}

	function check_user(){
		$user_id=$this->input->post('user_id');
		$passwords=$this->input->post('passwords');
		$query_user_admin=$this->model_users_admin->check_user_admin($user_id,$passwords);
		//print_r($query_user_admin);
		if ($query_user_admin->num_rows()>0)
		{
			$row_user_admin=$query_user_admin->row();
			$newdata = array(
					'user_id'=>$user_id,
					'nama_lengkap'  => $row_user_admin->nama_lengkap,
					'id_level'=>$row_user_admin->id_level,
					'logged_in' => TRUE
               );

			$this->session->set_userdata($newdata);
			
			$data['sukses']='ok';
			$this->after_login();
		}else{
			$this->load_login_form('masukkan user id & password dengan benar, atau hubungi administrator');		
		}

	}
	function admin_logout(){
		$this->session->sess_destroy();
		redirect (base_url().'index.php/admin');
	}

	function show_user_baru(){
		$this->validations->check_user_admin_session_is_there();

		$q_user_baru=$this->model_users_admin->find_user_public_need_approve();
		$data['q_user_baru']=$q_user_baru;
		 
		$this->load->view('admin/admin_user',$data);
	}

	function approve_user_baru($user_id){
		$this->validations->check_user_admin_session_is_there();

		$user_approval=$this->session->userdata('user_id');
		$this->model_users_admin->user_public_approve($user_id,$user_approval);
		echo 'Disetujui';
		
		//model_user_admin 49
		//$data['info']='Disetujui';
		//$this->load->view('users/konfirm_result',$data);
	}
	function not_approve_user_baru($user_id){
		$this->validations->check_user_admin_session_is_there();

		$user_approval=$this->session->userdata('user_id');
		$this->model_users_admin->user_public_not_approve($user_id,$user_approval);
		echo 'Tidak disetujui';
		
		//model_user_admin 115
		//$data['info']='Disetujui';
		//$this->load->view('users/konfirm_result',$data);
	}
	
	function show_user_all(){
		$this->validations->check_user_admin_session_is_there();

		$q_user_public=$this->model_users_admin->get_user_public();
		$data['q_user_public']=$q_user_public;
		$this->load->view('admin/admin_user_all',$data);

	}

	//laporan anggota
	function laporan_anggota_idx(){
		$this->validations->check_user_admin_session_is_there();
		
		$q_group_user=$this->model_referensi->get_user_group();

		$data['q_group_user']=$q_group_user;

		$this->load->view('admin/laporan_anggota_idx',$data);

	}//end if laporan angoota

	function laporan_anggota(){
		$this->validations->check_user_admin_session_is_there();
		
		$q_group_user=$this->model_referensi->get_user_group();

		$data['q_group_user']=$q_group_user;

		$this->load->view('admin/laporan_anggota',$data);

	}//end if laporan angoota


	//
	function detail_laporan_anggota(){
		$this->validations->check_user_admin_session_is_there();
		$tanggal_pilih=$this->input->post('tanggal_pilih');
		$group_user=$this->input->post('selgroupmember');
		$group_user_text=$this->input->post('selgroupmember_text');

		$range_tanggal=explode("/", trim($tanggal_pilih));


		$q_kuota_transfer=$this->model_users_admin->range_jum_user($range_tanggal[0],$range_tanggal[1],$group_user);

		$data['q_kuota_transfer']=$q_kuota_transfer;
		$data['range_tanggal']=$range_tanggal;
		$data['group_user']=$group_user;
		$data['group_user_text']=$group_user_text;
		$this->load->view('laporan/detail_laporan_anggota',$data);

	}


	function get_xls_laporan_anggota(){
		$this->validations->check_user_admin_session_is_there();

		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Anggota');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Laporan Registrasi Anggota');
		//change the font size

		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:E1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$tanggal_start=$this->input->post('tanggal_start');
		$tanggal_end=$this->input->post('tanggal_end');
		$group_user=$this->input->post('group_user');
		$group_user_text=$this->input->post('group_user_text');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Rentang Tanggal');
		$this->excel->getActiveSheet()->mergeCells('A2:B2');
		$this->excel->getActiveSheet()->setCellValue('C2', $tanggal_start);
		$this->excel->getActiveSheet()->setCellValue('D2', $tanggal_end);

		$this->excel->getActiveSheet()->setCellValue('A3', 'Group Anggota');
		$this->excel->getActiveSheet()->mergeCells('A3:B3');
		$this->excel->getActiveSheet()->setCellValue('C3', $group_user_text);
		$this->excel->getActiveSheet()->mergeCells('C3:D3');
		

		$q_kuota_transfer=$this->model_users_admin->range_jum_user($tanggal_start,$tanggal_end,$group_user);
		//echo Sql;
		//
		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'Tanggal ');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Laki-Laki');
		$this->excel->getActiveSheet()->setCellValue('D4', 'Perempuan');
		$this->excel->getActiveSheet()->setCellValue('E4', 'Sub Total');
		$start_row=5;
		$no=1;
		$total_kuota_laki=0;
		$total_kuota_perempuan=0;
		$total_kuota=0;
		foreach ($q_kuota_transfer->result() as $r_q_kuota_transfer)
		{
		$sub_total=$r_q_kuota_transfer->jum_user_public_laki + $r_q_kuota_transfer->jum_user_public_perempuan;
			$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $no);
			$this->excel->getActiveSheet()->setCellValue('B'.$start_row, $r_q_kuota_transfer->tanggal);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $r_q_kuota_transfer->jum_user_public_laki);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $r_q_kuota_transfer->jum_user_public_perempuan);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $sub_total);
		
		$total_kuota_laki=$total_kuota_laki + $r_q_kuota_transfer->jum_user_public_laki;
		$total_kuota_perempuan=$total_kuota_perempuan + $r_q_kuota_transfer->jum_user_public_perempuan;
		$total_kuota=$total_kuota+$sub_total;
		$start_row++;
		$no++;
		}
		$posisi_row_total=$start_row;
		$this->excel->getActiveSheet()->setCellValue('A'.$posisi_row_total, 'Total');
		$this->excel->getActiveSheet()->getStyle('A'.$posisi_row_total)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A'.$posisi_row_total.':B'.$posisi_row_total);
		
		$this->excel->getActiveSheet()->setCellValue('C'.$posisi_row_total, $total_kuota_laki);
		$this->excel->getActiveSheet()->setCellValue('D'.$posisi_row_total, $total_kuota_perempuan);
		$this->excel->getActiveSheet()->setCellValue('E'.$posisi_row_total, $total_kuota);

		
		
		$filename='Laporan_anggota_per_tanggal.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}

	


	// function generate file excel untuk data user public
	function get_xls_users(){
		$this->validations->check_user_admin_session_is_there();
		/*
			simple way using export xls library
		
		$this->load->library('export');
		$q_user_public=$this->model_users_admin->xls_user_public_all();
		$this->export->to_excel($q_user_public, 'Daftar_Seluruh_Member'); 
		*/

		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='just_some_random_name.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}



	//test load before open
	function test_load(){
		$data['info']='Data All Users';
		$data['jenisdownload']='userall';
		$this->load->view('konfirm_download',$data);
	}


	// user komplain

	function show_komplain_user($keyword_text_komplain_user="All",$status="All",$offset = 0){
		
		$this->validations->check_user_admin_session_is_there();
			if ($this->input->post("keyword_text_komplain_user")<>'')
			{
				$keyword_text_komplain_user=$this->input->post("keyword_text_komplain_user");
			}

			//$keyword_text=htmlencode($keyword_text);
			$keyword_text_komplain_user = str_replace('%20',' ',$keyword_text_komplain_user);
			$data['keyword_text_komplain_user']=$keyword_text_komplain_user;
			$q_log_komplain=$this->model_users_admin->get_log_komplain($keyword_text_komplain_user,$status);
			$config['base_url'] = site_url().'/admin/show_komplain_user/'.$keyword_text_komplain_user;
			$config['div'] = "#dKomplain";
			
			$config['total_rows'] = $q_log_komplain->num_rows();
			$data['total_rows']=$q_log_komplain->num_rows();
			$data['offset']=$offset;
		    $config['per_page'] = $this->config->item('per_page');
		    $limit=$this->config->item('per_page');
			
		    $data['q_log_komplain']=$this->model_users_admin->get_log_komplain_per_page( $limit, $offset,$keyword_text_komplain_user,$status);
			//$data['show_dismantle']='no';
			
			$this->jquery_pagination->initialize($config);
			$this->load->view('admin/komplain_view',$data);
		

	}//end of function show_komplain_user

	function show_komplain_detail($keyword_text_komplain_detail_user="All",$id_user_complain,$offset = 0){
		
		$this->validations->check_user_admin_session_is_there();
		//$id_user_complain=$this->input->post('id_user_complain');
		$data['id_user_complain']=$id_user_complain;

		if ($this->input->post("keyword_text_komplain_detail_user")<>'')
		{
			$keyword_text_komplain_detail_user=$this->input->post("keyword_text_komplain_detail_user");
		}
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text_komplain_detail_user = str_replace('%20',' ',$keyword_text_komplain_detail_user);
		$data['keyword_text_komplain_detail_user']=$keyword_text_komplain_detail_user;
		$q_log_komplain_detail=$this->model_users_admin->get_log_komplain_detail($keyword_text_komplain_detail_user,$id_user_complain);
		$config['base_url'] = site_url().'/admin/show_komplain_detail/'.$keyword_text_komplain_detail_user.'/'.$id_user_complain;
		$config['div'] = "#modaltarget";
		$config['uri_segment']=5;
		
		$config['total_rows'] = $q_log_komplain_detail->num_rows();
		$data['total_rows']=$q_log_komplain_detail->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['q_log_komplain_detail']=$this->model_users_admin->get_log_komplain_detail_per_page( $limit, $offset,$keyword_text_komplain_detail_user,$id_user_complain);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		//$this->load->view('users/komplain_view',$data);

		$this->load->view('admin/komplain_detail',$data);
	} // end of show_komplain_detail
	//form komplain
	function show_admin_komplain_detail_form(){
		$this->validations->check_user_admin_session_is_there();

		$data['id_user_complain']=$this->input->post('id_user_complain');


		$this->load->view('admin/komplain_detail_form',$data);
	} //end of show_komplain_detail_form

	function save_komplain_detail(){
		$this->validations->check_user_admin_session_is_there();

		$comment_complain=$this->input->post('comment_complain');
		$user_admin_id=$this->session->userdata('user_id');
		$statuskomplain=$this->input->post('statuskomplain');
		$id_user_complain=$this->input->post('id_user_complain');

		$this->model_users_admin->save_admin_komplain_detail($comment_complain,$user_public_id,$statuskomplain,$id_user_complain);

	} // end of save_komplain_detail

	//transaksional
	function approve_transaksi_detail($id_user_public_quota){
		$this->validations->check_user_admin_session_is_there();

		$data['id_user_public_quota']=$id_user_public_quota;
		$this->load->view('admin/konfirm_transaksi',$data);

	}

	function save_transaksi_detail($id_user_public_quota)
	{
		$user_approval=$this->session->userdata('user_id');
		$this->model_users_admin->update_user_public_quota($id_user_public_quota,$user_approval);
	}

	function add_quota_dispute_form($user_public_id){
		$this->validations->check_user_admin_session_is_there();
		$data['user_public_id']=$user_public_id;
		$this->load->view('admin/kuota_form_dispute',$data);
	}
	function save_kuota_dispute(){
		$user_approval=$this->session->userdata('user_id');
		
		$kuota=$this->input->post('kuota');
		$tb=$this->input->post('tb');
		$user_public_id=$this->input->post('user_public_id');
		$this->model_users_admin->save_user_public_kuota_dispute($kuota,$tb,$user_public_id,$user_approval);

	}
	function laporan_kuota(){
		$this->validations->check_user_admin_session_is_there();
		
		$q_group_user=$this->model_referensi->get_user_group();
		$data['q_group_user']=$q_group_user;

		$this->load->view('laporan/laporan_kuota',$data);
	}
	function detail_laporan_kuota(){
		$this->validations->check_user_admin_session_is_there();
		$tanggal_pilih=$this->input->post('tanggal_pilih');
		$group_user=$this->input->post('selgroupmember');
		$group_user_text=$this->input->post('selgroupmember_text');
		$range_tanggal=explode("/", trim($tanggal_pilih));


		$q_kuota_transfer=$this->model_users_admin->kuota_transfer($range_tanggal[0],$range_tanggal[1],$group_user);

		$data['q_kuota_transfer']=$q_kuota_transfer;
		$data['range_tanggal']=$range_tanggal;
		$data['group_user']=$group_user;
		$data['group_user_text']=$group_user_text;
		$this->load->view('laporan/detail_laporan_kuota',$data);
	}

	function get_xls_kuota(){
		$this->validations->check_user_admin_session_is_there();

		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Kuota');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Laporan Kuota Anggota');
		//change the font size

		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:G1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$tanggal_start=$this->input->post('tanggal_start');
		$tanggal_end=$this->input->post('tanggal_end');
		$group_user=$this->input->post('group_user');
		$group_user_text=$this->input->post('group_user_text');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Rentang Tanggal');
		$this->excel->getActiveSheet()->mergeCells('A2:B2');
		$this->excel->getActiveSheet()->setCellValue('C2', $tanggal_start);
		$this->excel->getActiveSheet()->setCellValue('D2', $tanggal_end);

		$this->excel->getActiveSheet()->setCellValue('A3', 'Group Anggota');
		$this->excel->getActiveSheet()->mergeCells('A3:B3');
		$this->excel->getActiveSheet()->setCellValue('C3', $group_user_text);
		$this->excel->getActiveSheet()->mergeCells('C3:D3');

		$q_kuota_transfer=$this->model_users_admin->kuota_transfer($tanggal_start,$tanggal_end,$group_user);
		//echo Sql;
		//
		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'Use Id');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Tanggal Disetujui');
		$this->excel->getActiveSheet()->setCellValue('D4', 'Disetujui Oleh');
		$this->excel->getActiveSheet()->setCellValue('E4', 'Tanggal Transfer');
		$this->excel->getActiveSheet()->setCellValue('F4', 'Nominal Transfer');
		$this->excel->getActiveSheet()->setCellValue('G4', 'Kuota');

		$start_row=5;
		$no=1;
		$total_nominal=0;
		$total_kuota=0;
		foreach ($q_kuota_transfer->result() as $r_q_kuota_transfer)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $no);
			$this->excel->getActiveSheet()->setCellValue('B'.$start_row, $r_q_kuota_transfer->user_public_id);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $r_q_kuota_transfer->date_approval_convert);
			$this->excel->getActiveSheet()->setCellValue('D'.$start_row, $r_q_kuota_transfer->approval_convert_by);
			$this->excel->getActiveSheet()->setCellValue('E'.$start_row, $r_q_kuota_transfer->date_transfer);
			$this->excel->getActiveSheet()->setCellValue('F'.$start_row, $r_q_kuota_transfer->nominal_transfer);
			$this->excel->getActiveSheet()->setCellValue('G'.$start_row, $r_q_kuota_transfer->transfer_convert_quota);			
		$total_nominal=$total_nominal+$r_q_kuota_transfer->nominal_transfer;
		$total_kuota=$total_kuota + $r_q_kuota_transfer->transfer_convert_quota;
		$start_row++;
		$no++;
		}
		$posisi_row_total=$start_row;
		$this->excel->getActiveSheet()->setCellValue('A'.$posisi_row_total, 'Total');
		$this->excel->getActiveSheet()->getStyle('A'.$posisi_row_total)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A'.$posisi_row_total.':E'.$posisi_row_total);
		
		$this->excel->getActiveSheet()->setCellValue('F'.$posisi_row_total, $total_nominal);
		$this->excel->getActiveSheet()->setCellValue('G'.$posisi_row_total, $total_kuota);		
		
		
		$filename='Laporan_kuota.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}

	function laporan_download(){
		$this->validations->check_user_admin_session_is_there();
		
		$this->load->view('laporan/laporan_download');
	}

	function detail_laporan_download(){
		$this->validations->check_user_admin_session_is_there();
		$tanggal_pilih=$this->input->post('tanggal_pilih');

		$range_tanggal=explode("/", trim($tanggal_pilih));


		$q_jum_download=$this->model_users_admin->range_jum_download(trim($range_tanggal[0]),trim($range_tanggal[1]));

		$data['q_jum_download']=$q_jum_download;
		$data['range_tanggal']=$range_tanggal;
		$this->load->view('laporan/detail_laporan_download',$data);
	}

	function get_xls_download(){
		$this->validations->check_user_admin_session_is_there();

		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Download');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Laporan Download');
		//change the font size

		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$tanggal_start=$this->input->post('tanggal_start');
		$tanggal_end=$this->input->post('tanggal_end');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Rentang Tanggal');
		$this->excel->getActiveSheet()->mergeCells('A2:B2');
		$this->excel->getActiveSheet()->setCellValue('C2', $tanggal_start);
		$this->excel->getActiveSheet()->setCellValue('D2', $tanggal_end);


		$q_jum_download=$this->model_users_admin->range_jum_download(trim($tanggal_start),trim($tanggal_end));
		
		//
		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'Tanggal Download');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Anggota');
		$this->excel->getActiveSheet()->setCellValue('D4', 'Jumlah Download');
		
		$start_row=5;
		$no=1;
		$total_download=0;
		foreach ($q_jum_download->result() as $r_q_jum_download)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $no);
			$this->excel->getActiveSheet()->setCellValue('B'.$start_row, $r_q_jum_download->tanggal);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $r_q_jum_download->user_public_id);
			$this->excel->getActiveSheet()->setCellValue('D'.$start_row, $r_q_jum_download->jum_download);
			
		$total_download=$total_download+$r_q_jum_download->jum_download;
		$start_row++;
		$no++;
		}
		$posisi_row_total=$start_row;
		$this->excel->getActiveSheet()->setCellValue('A'.$posisi_row_total, 'Total');
		$this->excel->getActiveSheet()->getStyle('A'.$posisi_row_total)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A'.$posisi_row_total.':C'.$posisi_row_total);
		
		$this->excel->getActiveSheet()->setCellValue('D'.$posisi_row_total, $total_download);
		
		
		$filename='Laporan_download.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}

	function laporan_gender(){
		$this->validations->check_user_admin_session_is_there();
		
		$this->load->view('laporan/laporan_gender');
	}
	function laporan_user_kota(){
		$this->validations->check_user_admin_session_is_there();

		$q_group_user=$this->model_referensi->get_user_group();
		$data['q_group_user']=$q_group_user;

		
		$this->load->view('laporan/laporan_user_kota',$data);	
	}
	function detail_laporan_anggota_kota(){
		$this->validations->check_user_admin_session_is_there();
		$tanggal_pilih=$this->input->post('tanggal_pilih');
		$group_user=$this->input->post('selgroupmember');
		$group_user_text=$this->input->post('selgroupmember_text');

		$range_tanggal=explode("/", trim($tanggal_pilih));


		$q_kuota_transfer=$this->model_users_admin->range_jum_user_kota($range_tanggal[0],$range_tanggal[1],$group_user);

		$data['q_kuota_transfer']=$q_kuota_transfer;
		$data['range_tanggal']=$range_tanggal;
		$data['group_user']=$group_user;
		$data['group_user_text']=$group_user_text;
		$this->load->view('laporan/detail_laporan_anggota_kota',$data);

	}

	function get_xls_laporan_anggota_kota(){
		$this->validations->check_user_admin_session_is_there();

		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Anggota');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Laporan Anggota Per Kabupaten/Kota');
		//change the font size

		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:C1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$tanggal_start=$this->input->post('tanggal_start');
		$tanggal_end=$this->input->post('tanggal_end');
		$group_user=$this->input->post('group_user');
		$group_user_text=$this->input->post('group_user_text');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Rentang Tanggal');
		$this->excel->getActiveSheet()->mergeCells('A2:B2');
		$this->excel->getActiveSheet()->setCellValue('C2', $tanggal_start.'/'.$tanggal_end);
		
		$this->excel->getActiveSheet()->setCellValue('A3', 'Group Anggota');
		$this->excel->getActiveSheet()->mergeCells('A3:B3');
		$this->excel->getActiveSheet()->setCellValue('C3', $group_user_text);
		

		$q_kuota_transfer=$this->model_users_admin->range_jum_user_kota($tanggal_start,$tanggal_end,$group_user);
		//echo Sql;
		//
		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'Kabupaten/Kota');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Jumlah');
		
		$start_row=5;
		$no=1;
		$total_kuota=0;
		foreach ($q_kuota_transfer->result() as $r_q_kuota_transfer)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $no);
			$this->excel->getActiveSheet()->setCellValue('B'.$start_row, $r_q_kuota_transfer->kabupaten_kota);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $r_q_kuota_transfer->jum_user_public);
		$total_kuota=$total_kuota + $r_q_kuota_transfer->jum_user_public;
		$start_row++;
		$no++;
		}
		$posisi_row_total=$start_row;
		$this->excel->getActiveSheet()->setCellValue('A'.$posisi_row_total, 'Total');
		$this->excel->getActiveSheet()->getStyle('A'.$posisi_row_total)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A'.$posisi_row_total.':B'.$posisi_row_total);
		
		$this->excel->getActiveSheet()->setCellValue('C'.$posisi_row_total, $total_kuota);		
		
		
		$filename='Laporan_anggota_kota.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}

	//laporan anggota
	function laporan_artikel_idx(){
		$this->validations->check_user_admin_session_is_there();
		
		$this->load->view('admin/laporan_artikel_idx');

	}//end if laporan angoota

	function laporan_artikel_baca_download(){
		$this->load->view('laporan/laporan_artikel_download');		
	}

	function detail_laporan_artikel_download(){
		$this->validations->check_user_admin_session_is_there();
		$tanggal_pilih=$this->input->post('tanggal_pilih');
		$group_user=$this->input->post('selgroupmember');
		$range_tanggal=explode("/", trim($tanggal_pilih));


		$q_jum_download=$this->model_users_admin->range_jum_artikel_download($range_tanggal[0],$range_tanggal[1]);

		$data['q_jum_download']=$q_jum_download;
		$data['range_tanggal']=$range_tanggal;
		$this->load->view('laporan/detail_laporan_artikel_download',$data);
	}

	function get_xls_artikel_download(){
		$this->validations->check_user_admin_session_is_there();

		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Download');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Laporan Artikel Download');
		//change the font size

		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:E1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$tanggal_start=$this->input->post('tanggal_start');
		$tanggal_end=$this->input->post('tanggal_end');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Rentang Tanggal :'.$tanggal_start.'/'.$tanggal_end);
		$this->excel->getActiveSheet()->mergeCells('A2:C2');


		$q_jum_download=$this->model_users_admin->range_jum_artikel_download(trim($tanggal_start),trim($tanggal_end));
		
		//
		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'Artikel');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Jumlah Download');
		$this->excel->getActiveSheet()->setCellValue('D4', 'Jumlah baca');
		$this->excel->getActiveSheet()->setCellValue('E4', 'Sub Total');
		
		$start_row=5;
		$no=1;
		$total_download=0;
		$total_baca=0;
		$total=0;
		foreach ($q_jum_download->result() as $r_q_jum_download)
		{
			$sub_total=0;
			$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $no);
			$this->excel->getActiveSheet()->setCellValue('B'.$start_row, $r_q_jum_download->title);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $r_q_jum_download->jum_download);
			$this->excel->getActiveSheet()->setCellValue('D'.$start_row, $r_q_jum_download->jum_baca);
			$sub_total=$r_q_jum_download->jum_baca + $r_q_jum_download->jum_download;
			$this->excel->getActiveSheet()->setCellValue('E'.$start_row, $sub_total);
			
		$total_download=$total_download+$r_q_jum_download->jum_download;
		$total_baca=$total_baca + $r_q_jum_download->jum_baca;
		$total=$total + $sub_total ;
		$start_row++;
		$no++;
		}
		$posisi_row_total=$start_row;
		$this->excel->getActiveSheet()->setCellValue('A'.$posisi_row_total, 'Total');
		$this->excel->getActiveSheet()->getStyle('A'.$posisi_row_total)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A'.$posisi_row_total.':B'.$posisi_row_total);
		
		$this->excel->getActiveSheet()->setCellValue('C'.$posisi_row_total, $total_download);
		$this->excel->getActiveSheet()->setCellValue('D'.$posisi_row_total, $total_baca);
		$this->excel->getActiveSheet()->setCellValue('E'.$posisi_row_total, $total);
		
		$filename='Laporan_artikel_download.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}

	function laporan_user_pasif()
	{
		$this->validations->check_user_admin_session_is_there();

		$q_group_user=$this->model_referensi->get_user_group();
		$data['q_group_user']=$q_group_user;

		
		$this->load->view('laporan/laporan_user_pasif',$data);
	}
	function detail_laporan_user_pasif()
	{
		$this->validations->check_user_admin_session_is_there();
		$group_user=$this->input->post('selgroupmember');
		$group_user_text=$this->input->post('selgroupmember_text');
		
		/*$tanggal_pilih=$this->input->post('tanggal_pilih');
		$range_tanggal=explode("/", trim($tanggal_pilih));
		*/

		//$q_kuota_transfer=$this->model_users_admin->get_user_pasif($range_tanggal[0],$range_tanggal[1],$group_user);

		$q_kuota_transfer=$this->model_users_admin->get_user_pasif($group_user);

		$data['q_kuota_transfer']=$q_kuota_transfer;
		//$data['range_tanggal']=$range_tanggal;
		$data['group_user']=$group_user;
		$data['group_user_text']=$group_user_text;

		$this->load->view('laporan/detail_laporan_user_pasif',$data);
	
	}
	function get_xls_user_pasif(){
		$this->validations->check_user_admin_session_is_there();

		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Anggota');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Laporan Anggota Pasif');
		//change the font size

		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:F1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$group_user=$this->input->post('group_user');
		$group_user_text=$this->input->post('group_user_text');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Group Anggota');
		$this->excel->getActiveSheet()->mergeCells('A2:B2');
		$this->excel->getActiveSheet()->setCellValue('C2', $group_user_text);
		

		$q_kuota_transfer=$this->model_users_admin->get_user_pasif($group_user);
		//echo Sql;
		//
		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'User ID');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('D4', 'Alamat');
		$this->excel->getActiveSheet()->setCellValue('E4', 'Email');
		$this->excel->getActiveSheet()->setCellValue('F4', 'Tanggal Persetujuan');
		$start_row=5;
		$no=1;
		$total_kuota=0;
		foreach ($q_kuota_transfer->result() as $r_q_kuota_transfer)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $no);
			$this->excel->getActiveSheet()->setCellValue('B'.$start_row, $r_q_kuota_transfer->user_public_id);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $r_q_kuota_transfer->user_public_name);
			$this->excel->getActiveSheet()->setCellValue('D'.$start_row, $r_q_kuota_transfer->alamat);
			$this->excel->getActiveSheet()->setCellValue('E'.$start_row, $r_q_kuota_transfer->emails);
			$this->excel->getActiveSheet()->setCellValue('F'.$start_row, $r_q_kuota_transfer->date_approval_convert);
		$start_row++;
		$no++;
		}
		
		$filename='Laporan_anggota_pasif.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
		
	}


}