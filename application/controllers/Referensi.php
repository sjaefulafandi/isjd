<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Nama Controller	: Referensi
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 2 Juli 2015
 * Penjelasan		: 
 * 
 */
class Referensi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_referensi');
		$this->load->library('Validations');
		$this->validations->check_user_admin_session_is_there();
	}
	
	function show_tarif()
	{
		//$this->check_user_session_is_there();

		$q_tarif_download_aktif=$this->model_referensi->show_tarif('1');
		$q_tarif_download_non_aktif=$this->model_referensi->show_tarif('0');
		$data['q_tarif_download_aktif']=$q_tarif_download_aktif;
		$data['q_tarif_download_non_aktif']=$q_tarif_download_non_aktif;

		$this->load->view('referensi/tarif',$data);
	}
	function show_tarif_form(){

		$q_group_user=$this->model_referensi->get_user_group();
		$data['q_group_user']=$q_group_user;

		$this->load->view('referensi/tarif_form',$data);
	}
	function save_tarif(){
		$harga=$this->input->post('harga');
		$konversidownload=$this->input->post('konversidownload');
		$selgroupmember=$this->input->post('selgroupmember');
		$optjenistarif=$this->input->post('optjenistarif');
		//apakah ada tarif dengan schema yang sama, 
		$q_old_tarif=$this->model_referensi->get_tarif_download($harga,$konversidownload,$selgroupmember,$optjenistarif,'1');
		if ($q_old_tarif->num_rows()==1){
			//jika sama persis schema lama pakai, schema baru set menjadi inactive
			$this->model_referensi->save_tarif_download($harga,$konversidownload,$selgroupmember,$optjenistarif,'0');
		}else{
			$q_old_tarif=$this->model_referensi->get_tarif_download($harga,$konversidownload,$selgroupmember,$optjenistarif,'0');
			if ($q_old_tarif->num_rows()==1){
				//jika terdapat tarif dengan jenis tarifnya , aktifkan data yang baru
				$r_q_old_tarif=$q_old_tarif->row();
				//update yang lama menjadi 0
				$this->model_referensi->update_tarif_download_default($r_q_old_tarif->id_tarif_download);
				//insert yang baru
				$this->model_referensi->save_tarif_download($harga,$konversidownload,$selgroupmember,$optjenistarif,'1');
			}else{
				// insert yang baru
				$this->model_referensi->save_tarif_download($harga,$konversidownload,$selgroupmember,$optjenistarif,'1');
			}	
		}
		
	}

	function show_group_user(){
		$q_group_user=$this->model_referensi->get_user_group();
		$data['q_group_user']=$q_group_user;
		$this->load->view('referensi/group_user',$data);
	}

	function save_group_user_data(){
		$nama_group_user=$this->input->post('nama_group_user');

		$this->model_referensi->save_group_user($nama_group_user);

	}
	
	function show_group_user_form(){
		$this->load->view('referensi/group_user_form');
	}

	function show_kota(){
		$q_kota=$this->model_referensi->get_kota();
		$data['q_kota']=$q_kota;
		$this->load->view('referensi/kota',$data);
	}

	function show_kota_form(){
		$this->load->view('referensi/kota_form');
	}

	function save_kota_data(){
		$nama_kota=$this->input->post('nama_kota');
		$this->model_referensi->save_kota($nama_kota);	
	}
	function test_load_view(){
		$this->load->view('welcome_message');
	}


}
?>