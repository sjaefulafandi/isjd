<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Nama Controller	: Admin
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 	// Total baca jurnal artikel
		$q_total_baca_artikel=$this->model_admin_penerbit->get_total_baca_jurnal($this->session->userdata('id_penerbit'));
		$row_q_total_baca_artikel=$q_total_baca_artikel->row();
		$r_total_baca_artikel=$row_q_total_baca_artikel->total_baca;
		$r_total_download_artikel=$row_q_total_baca_artikel->total_download;
		$datadashboard['r_total_baca_artikel']=$r_total_baca_artikel;
		$datadashboard['r_total_download_artikel']=$r_total_download_artikel;
		: 4 Mei 2015
 * Penjelasan		: 
 * 
 */
class admin_penerbit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_admin_penerbit');
		$this->load->model('model_users_admin');
		$this->load->model('model_users_public');
		$this->load->model('model_artikel');
		$this->load->library('Validations');
		$this->load->library('Jquery_pagination');
	}
	

	function show_dashboard()
	{
		// total jurnal artikel
		$q_total_artikel=$this->model_admin_penerbit->get_total_jurnal($this->session->userdata('user_public_id'));
		$row_q_total_artikel=$q_total_artikel->num_rows();
		$datadashboard['row_q_total_artikel']=$row_q_total_artikel;		

		
		
		// Total baca jurnal artikel
		$q_total_baca_artikel=$this->model_admin_penerbit->get_total_baca_jurnal($this->session->userdata('user_public_id'));
		$row_q_total_baca_artikel=$q_total_baca_artikel->row();
		$r_total_baca_artikel=$row_q_total_baca_artikel->total_baca;
		$r_total_download_artikel=$row_q_total_baca_artikel->total_download;
		$datadashboard['r_total_baca_artikel']=$r_total_baca_artikel;
		$datadashboard['r_total_download_artikel']=$r_total_download_artikel;

		// jum user interact to artikel

		$q_total_user_penerbit_artikel=$this->model_admin_penerbit->get_penerbit_users_download($this->session->userdata('user_public_id'));
		$r_q_total_user_penerbit_artikel=$q_total_user_penerbit_artikel->num_rows();
		$datadashboard['r_q_total_user_penerbit_artikel']=$r_q_total_user_penerbit_artikel;		


		
		$this->load->view('dashboard/admin_penerbit_dashboard',$datadashboard);
	}

	function show_artikel_per_tahun(){
		$q_total_artikel=$this->model_admin_penerbit->get_total_jurnal_per_tahun($this->session->userdata('user_public_id'));
		$row_q_total_artikel=$q_total_artikel;
		$datadashboard['row_q_total_artikel']=$row_q_total_artikel;	

		$q_total_artikel_s=$this->model_admin_penerbit->get_total_jurnal_per_subjek($this->session->userdata('user_public_id'));
		$row_q_total_artikel_s=$q_total_artikel_s;
		$datadashboard['row_q_total_artikel_s']=$row_q_total_artikel_s;	


		$this->load->view('admin_penerbit/penerbit_jurnal_per_tahun',$datadashboard);	

	}

	function show_artikel_per_subjek(){
		$q_total_artikel=$this->model_admin_penerbit->get_total_jurnal_per_subjek($this->session->userdata('user_public_id'));
		$row_q_total_artikel=$q_total_artikel;
		$datadashboard['row_q_total_artikel']=$row_q_total_artikel;	

		$this->load->view('admin_penerbit/penerbit_jurnal_per_subjek',$datadashboard);	

	}

	function show_artikel_per_bidang(){
		$q_total_artikel=$this->model_admin_penerbit->get_artikel_per_bidang($this->session->userdata('user_public_id'));
		$row_q_total_artikel=$q_total_artikel;
		$datadashboard['row_q_total_artikel']=$row_q_total_artikel;	

		$this->load->view('admin_penerbit/penerbit_jurnal_per_bidang',$datadashboard);	

	}

	function change_profil(){
		$data['sukses']='not ok';
		$data['password_baru']='';
		$data['password_lama']='';
		
		$this->load->view('users/myprofile_penerbit',$data);
	}

	function detail_laporan_penerbit(){
		$jk=$this->input->post('jk');
		$tanggal_pilih=$this->input->post('tanggal_pilih');

		//$tanggal_pilih=$this->input->post('tanggal_pilih');
		$range_tanggal=explode("/", trim($tanggal_pilih));
		if ($jk=='download_artikel'){
			$data['jk']=$jk;
			$data['range_tanggal']=$range_tanggal;
			$id_penerbit=$this->session->userdata('user_public_id');
		
			$this->load->view('laporan/detail_laporan_penerbit_download_artikel',$data);
		}else{
			$data['jk']=$jk;
			$data['range_tanggal']=$range_tanggal;
			$id_penerbit=$this->session->userdata('user_public_id');
		
			$this->load->view('laporan/detail_laporan_penerbit_download_user',$data);
		}
	}

	//penerbit user download
	function detail_laporan_penerbit_anggota(){
		$this->validations->check_user_admin_session_is_there();
		$tanggal_pilih=$this->input->post('tanggal_pilih');
		$group_user=$this->input->post('selgroupmember');

		$range_tanggal=explode("/", trim($tanggal_pilih));


		$q_kuota_transfer=$this->model_users_admin->range_jum_user($range_tanggal[0],$range_tanggal[1],$group_user);

		$data['q_kuota_transfer']=$q_kuota_transfer;
		$data['range_tanggal']=$range_tanggal;
		$data['group_user']=$group_user;
		$this->load->view('laporan/detail_laporan_anggota',$data);

	}

	function get_xls_laporan_penerbit_download_artikel(){
		
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Penerbit');
		//set cell A1 content with some text
		$id_penerbit=$this->session->userdata('user_public_id');
		$q_subject=$this->model_admin_penerbit->get_total_jurnal_per_subjek($id_penerbit);
		$r_subject=$q_subject->row();

		$this->excel->getActiveSheet()->setCellValue('A1', 'Laporan Artikel Download');
		//change the font size
		$this->excel->getActiveSheet()->setCellValue('A2', 'Jurnal ');
		$this->excel->getActiveSheet()->setCellValue('B2', $r_subject->judul);
		$this->excel->getActiveSheet()->setCellValue('A3', 'Penerbit');
		$this->excel->getActiveSheet()->setCellValue('B3', $r_subject->penerbit);


		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$tanggal_start=$this->input->post('tanggal_start');
		$tanggal_end=$this->input->post('tanggal_end');
		

		$q_kuota_transfer=$this->model_admin_penerbit->range_jum_download_per_artikel($tanggal_start,$tanggal_end,$id_penerbit);
		//echo Sql;
		//
		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'Title');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Tanggal');
		$this->excel->getActiveSheet()->setCellValue('D4', 'Jumlah');
		
		
		$start_row=5;
		$no=1;
		$total_kuota=0;
		foreach ($q_kuota_transfer->result() as $r_q_kuota_transfer)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $no);
			$this->excel->getActiveSheet()->setCellValue('B'.$start_row,  $r_q_kuota_transfer->title);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row, $r_q_kuota_transfer->tanggal);
			$this->excel->getActiveSheet()->setCellValue('D'.$start_row, $r_q_kuota_transfer->jumlah);
		
			
		$total_kuota=$total_kuota + $r_q_kuota_transfer->jumlah;
		$start_row++;
		$no++;
		}
		$posisi_row_total=$start_row;
		$this->excel->getActiveSheet()->setCellValue('A'.$posisi_row_total, 'Total');
		$this->excel->getActiveSheet()->getStyle('A'.$posisi_row_total)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A'.$posisi_row_total.':C'.$posisi_row_total);
		
		$this->excel->getActiveSheet()->setCellValue('D'.$posisi_row_total, $total_kuota);		
		
		
		$filename='Laporan_penerbit_download_artikel_per_tanggal.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}

	function get_xls_laporan_penerbit_download_user(){
		
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Penerbit');
		//set cell A1 content with some text
		$id_penerbit=$this->session->userdata('user_public_id');
		$q_subject=$this->model_admin_penerbit->get_total_jurnal_per_subjek($id_penerbit);
		$r_subject=$q_subject->row();

		$this->excel->getActiveSheet()->setCellValue('A1', 'Laporan User Download');
		//change the font size
		$this->excel->getActiveSheet()->setCellValue('A2', 'Jurnal ');
		$this->excel->getActiveSheet()->setCellValue('B2', $r_subject->judul);
		$this->excel->getActiveSheet()->setCellValue('A3', 'Penerbit');
		$this->excel->getActiveSheet()->setCellValue('B3', $r_subject->penerbit);


		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:F1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$tanggal_start=$this->input->post('tanggal_start');
		$tanggal_end=$this->input->post('tanggal_end');
		

		$q_kuota_transfer=$this->model_admin_penerbit->range_jum_download_per_user($tanggal_start,$tanggal_end,$id_penerbit);
		//echo Sql;
		//
		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Email');
		$this->excel->getActiveSheet()->setCellValue('D4', 'Group');
		$this->excel->getActiveSheet()->setCellValue('E4', 'Kota');
		$this->excel->getActiveSheet()->setCellValue('F4', 'Tanggal');
		$this->excel->getActiveSheet()->setCellValue('G4', 'Jumlah');
		
		
		$start_row=5;
		$no=1;
		$total_kuota=0;
		foreach ($q_kuota_transfer->result() as $r_q_kuota_transfer)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $no);
			$this->excel->getActiveSheet()->setCellValue('B'.$start_row,  $r_q_kuota_transfer->user_public_name);
			$this->excel->getActiveSheet()->setCellValue('C'.$start_row,  $r_q_kuota_transfer->emails);
			$this->excel->getActiveSheet()->setCellValue('D'.$start_row,  $r_q_kuota_transfer->user_group);
			$this->excel->getActiveSheet()->setCellValue('E'.$start_row,  $r_q_kuota_transfer->kabupaten_kota);
			$this->excel->getActiveSheet()->setCellValue('F'.$start_row, $r_q_kuota_transfer->tanggal);
			$this->excel->getActiveSheet()->setCellValue('G'.$start_row, $r_q_kuota_transfer->jumlah);
		
			
		$total_kuota=$total_kuota + $r_q_kuota_transfer->jumlah;
		$start_row++;
		$no++;
		}
		$posisi_row_total=$start_row;
		$this->excel->getActiveSheet()->setCellValue('A'.$posisi_row_total, 'Total');
		$this->excel->getActiveSheet()->getStyle('A'.$posisi_row_total)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A'.$posisi_row_total.':F'.$posisi_row_total);
		
		$this->excel->getActiveSheet()->setCellValue('G'.$posisi_row_total, $total_kuota);		
		
		
		$filename='Laporan_penerbit_download_user_per_tanggal.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	//end of penerbit


}