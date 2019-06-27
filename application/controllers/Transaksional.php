<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Nama Controller	: Admin
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 4 Mei 2015
 * Penjelasan		: 
 * 
 */
class Transaksional extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_transaksional');
		$this->load->library('Validations');
		$this->validations->check_user_admin_session_is_there();
	} // end of ___construct
	
	function show_transaksional_kuota(){

		$q_transaksi_kuota=$this->model_transaksional->get_user_kuota();
		$data['q_transaksi_kuota']=$q_transaksi_kuota;
		$this->load->view('transaksional/show_transaksi',$data);

	}
} // end of class Transaksional