<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Nama Controller	: Jurnal
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 6 Juli 2015
 * Penjelasan		: 
 */
class Jurnal extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_jurnal');
		$this->load->model('model_artikel');
		$this->load->library('Jquery_pagination');
	}

	function get_jurnal($keyword_text="All",$jenis='judul',$offset = 0)
	{
		if ($this->input->post("keyword_text")<>'')
		{
			$keyword_text=$this->input->post("keyword_text");
			$jenis=$this->input->post("jenis");	
		}
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text = str_replace('%20',' ',$keyword_text);
		$data['keyword_text']=$keyword_text;
		$data['jenis']=$jenis;
		$query_jurnal=$this->model_jurnal->get_data_jurnal($keyword_text,$jenis);
		$config['base_url'] = site_url().'/Jurnal/get_jurnal/'.$keyword_text.'/'.$jenis;
		$config['uri_segment']=5;
		switch ($jenis) {
			case 'judul':
				$config['div'] = "#Judul";
				break;
			case 'Subjek':
			$config['div'] = "#target_infos";
			break;
			case 'penerbit':
			$config['div'] = "#target_info_p";
			break;
		}


		$config['total_rows'] = $query_jurnal->num_rows();
		$data['total_rows']=$query_jurnal->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['query_jurnal']=$this->model_jurnal->get_data_jurnal_per_page( $limit, $offset,$keyword_text,$jenis);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		$this->load->view('jurnal/jurnal_view',$data);

	}

	function get_jurnal_single($id_jurnal){
		$query_jurnal=$this->model_jurnal->get_jurnal_detail($id_jurnal);
		$data['query_jurnal']=$query_jurnal;
		$data['id_jurnal']=$id_jurnal;
				
		$this->load->view('jurnal/jurnal_view_single_no_modal',$data);
		//$this->get_info_artikel_jurnal($id_jurnal);

	}
	function get_info_artikel_jurnal($id_jurnal)
	{
		$q_artikel_jurnal=$this->model_jurnal->get_artikel_jurnal($id_jurnal);
		$data['id_jurnal']=$id_jurnal;
		$data['q_artikel_jurnal']=$q_artikel_jurnal;
		$this->load->view('jurnal/jurnal_artikel_view',$data);
	}	

	//jurnal per subjek
	function get_jurnal_subjek($keyword_text="All",$jenis='Subjek',$offset = 0){

		if ($this->input->post("keyword_text")<>'')
		{
			$keyword_text=$this->input->post("keyword_text");
			$jenis=$this->input->post("jenis");	

		}
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text = str_replace('%20',' ',$keyword_text);
		$data['keyword_text']=$keyword_text;

		$query_jurnal_subjek=$this->model_jurnal->get_data_jurnal_subjek($keyword_text);
		$config['base_url'] = site_url().'/Jurnal/get_jurnal_subjek/'.$keyword_text.'/'.$jenis;
		$config['uri_segment']=5;
		$config['div'] = "#Subjek";
		
		$config['total_rows'] = $query_jurnal_subjek->num_rows();
		$data['total_rows']=$query_jurnal_subjek->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['query_jurnal_subjek']=$this->model_jurnal->get_data_jurnal_subjek_per_page( $limit, $offset,$keyword_text);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		$this->load->view('jurnal/jurnal_subjek_view',$data);

	}
	//jurnal per penebit
	function get_jurnal_penerbit($keyword_text="All",$jenis='Penerbit',$offset = 0){

		if ($this->input->post("keyword_text")<>'')
		{
			$keyword_text=$this->input->post("keyword_text");
			$jenis=$this->input->post("jenis");	

		}
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text = str_replace('%20',' ',$keyword_text);
		$data['keyword_text']=$keyword_text;

		$query_jurnal_penerbit=$this->model_jurnal->get_data_jurnal_penerbit($keyword_text);
		$config['base_url'] = site_url().'/Jurnal/get_jurnal_penerbit/'.$keyword_text.'/'.$jenis;
		$config['uri_segment']=5;
		$config['div'] = "#Penerbit";
		
		$config['total_rows'] = $query_jurnal_penerbit->num_rows();
		$data['total_rows']=$query_jurnal_penerbit->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['query_jurnal_penerbit']=$this->model_jurnal->get_data_jurnal_penerbit_per_page( $limit, $offset,$keyword_text);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		$this->load->view('jurnal/jurnal_penerbit_view',$data);

	}
	//jurnal per issn
	function get_jurnal_issn($keyword_text="All",$jenis='issn',$offset = 0){

		if ($this->input->post("keyword_text")<>'')
		{
			$keyword_text=$this->input->post("keyword_text");
			$jenis=$this->input->post("jenis");	

		}
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text = str_replace('%20',' ',$keyword_text);
		$data['keyword_text']=$keyword_text;

		$query_jurnal_issn=$this->model_jurnal->get_data_jurnal_issn($keyword_text);
		$config['base_url'] = site_url().'/Jurnal/get_jurnal_issn/'.$keyword_text.'/'.$jenis;
		$config['uri_segment']=5;
		$config['div'] = "#ISSN";
		
		$config['total_rows'] = $query_jurnal_issn->num_rows();
		$data['total_rows']=$query_jurnal_issn->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['query_jurnal_issn']=$this->model_jurnal->get_data_jurnal_issn_per_page( $limit, $offset,$keyword_text);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		$this->load->view('jurnal/jurnal_issn_view',$data);

	}	
}
?>