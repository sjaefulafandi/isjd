<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Nama Controller	: Public_no_login
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 4 Mei 2015
 * Penjelasan		: 
 * 1. Menangani halaman daring untuk semua pengguna tanpa harus login
 */
class public_no_login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_artikel');
		$this->load->model('model_jurnal');
	}
	
	function index()

	{
		$data['jum_user_public_baru']=$this->user_public_baru();
		$query_artikel=$this->model_artikel->get_data_artikel('All');
		$query_jurnal=$this->model_jurnal->get_data_jurnal('All');
		
		/* 
		  artikel per tahun
		*/
		$this_year=date("Y");
		$prev_this_year=$this_year-0;
		$query=$this->model_artikel->get_count_artikel_per_year($prev_this_year,$this_year);
	
		
		$data_kata_pembuka['total_row']=$query_artikel->num_rows();
		$data_kata_pembuka['total_row_jurnal']=$query_jurnal->num_rows();

		$this->template->set_template('public_no_login');
		$this->template->write_view('content_header','menu/user_public_menu',$data);
		$this->template->write_view('content_report','public/small_report');
		$this->template->write_view('search_bar','public/search_bar');
		$this->template->write_view('content_worksheet','public/kata_pembuka',$data_kata_pembuka);
		$this->template->render();
	}
	function index_direktori(){
		$data['jum_user_public_baru']=$this->user_public_baru();
		
		$this->template->set_template('public_no_login_direktori');
		$this->template->write_view('content_header','menu/user_public_menu',$data);
		$this->template->write_view('content_comment','public/kata_pembuka_direktori');
		$this->template->write_view('content_worksheet','public/search_bar_direktori');
		$this->template->render();	
	}

	function dashboard(){
		$data['jum_user_public_baru']=$this->user_public_baru();
		
		$this->template->set_template('public_no_login_dashboard');
		$this->template->write_view('content_header','menu/user_public_menu',$data);
		$this->template->write_view('content_report','public/full_report');
		$this->template->render();	
	}
	
	function user_public_baru(){
		$this->load->model('model_users_admin');//info user baru
		$q_user_baru=$this->model_users_admin->find_user_public_need_approve();
		$row_user_baru=$q_user_baru->num_rows();
		return $row_user_baru;


	}

	function public_logout(){
	$this->session->sess_destroy();
	$this->index();
	//redirect (base_url().'index.php/Public_no_login');
	}


	
	
}
?>