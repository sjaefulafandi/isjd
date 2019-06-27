<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Nama Controller	: Artikel
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 4 Mei 2015
 * Penjelasan		: 
 * 1. Menangani halaman daring untuk semua pengguna tanpa harus login
 */
class Artikel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_artikel');
		$this->load->model('model_users_public');
		$this->load->library('Jquery_pagination');
		$this->load->library('Validations');
	}
	
	function get_artikel($keyword_text="All",$offset = 0)
	{
		if ($this->input->post("keyword_text")<>'')
		{
			$keyword_text=$this->input->post("keyword_text");	
		}
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text = str_replace('%20',' ',$keyword_text);
		$data['keyword_text']=$keyword_text;
		$query_artikel=$this->model_artikel->get_data_artikel($keyword_text);
		$config['base_url'] = site_url().'/Artikel/get_artikel/'.$keyword_text;
		$config['div'] = "#paneltarget";
		
		$config['total_rows'] = $query_artikel->num_rows();
		$data['total_rows']=$query_artikel->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['query_artikel']=$this->model_artikel->get_data_artikel_per_page( $limit, $offset,$keyword_text);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		$this->load->view('artikel/artikel_view2',$data);
		
	}

	function get_artikel_adv($keyword_text="All",$tahun=1900,$nama_journal="All",$offset = 0)
	{
		if ($this->input->post("keyword_text")<>'')
		{
			$keyword_text=$this->input->post("keyword_text");
			$tahun=$this->input->post("tahun");
			$nama_journal=$this->input->post("nama_journal");	
		}

		if ($nama_journal=='') $nama_journal='All';

		//$keyword_text=htmlencode($keyword_text);
		$keyword_text = str_replace('%20',' ',$keyword_text);
		$nama_journal = str_replace('%20',' ',$nama_journal);
		
		$data['keyword_text']=$keyword_text;
		$data['tahun']=$tahun;
		$data['nama_journal']=$nama_journal;

		$query_artikel=$this->model_artikel->get_data_artikel_adv($keyword_text,$tahun,$nama_journal);
		$config['uri_segment']=6;
		$config['base_url'] = site_url().'/Artikel/get_artikel_adv/'.$keyword_text.'/'.$tahun.'/'.$nama_journal;
		$config['div'] = "#paneltarget";
		
		$config['total_rows'] = $query_artikel->num_rows();
		$data['total_rows']=$query_artikel->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['query_artikel']=$this->model_artikel->get_data_artikel_per_page_adv( $limit, $offset,$keyword_text,$tahun,$nama_journal);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		$this->load->view('artikel/artikel_view2',$data);
		
	}

	function get_artikel_author($keyword_text_author="All",$offset = 0)
	{
		if ($this->input->post("keyword_text_author")<>'')
		{
			$keyword_text_author=$this->input->post("keyword_text_author");	
		}
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text_author = str_replace('%20',' ',$keyword_text_author);
		$data['keyword_text_author']=$keyword_text_author;
		$query_artikel_author=$this->model_artikel->get_data_author_artikel($keyword_text_author);
		$config['base_url'] = site_url().'/Artikel/get_artikel_author/'.$keyword_text_author;
		$config['div'] = "#paneltargetauthor";
		
		$config['total_rows'] = $query_artikel_author->num_rows();
		$data['total_rows']=$query_artikel_author->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['query_artikel_author']=$this->model_artikel->get_data_author_artikel_per_page( $limit, $offset,$keyword_text_author);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		$this->load->view('artikel/artikel_author',$data);
		
	}

	function get_artikel_bidang($keyword_text_artikel_bidang="All",$bidang,$offset = 0){
		$q_category=$this->model_artikel->get_category();
		$data['q_category']=$q_category;

		if ($bidang!='Kategori'){
		$q_category_single=$this->model_artikel->get_category_single($bidang);
		$r_q_qategory_single=$q_category_single->row();

		//echo '<br><br>'.$r_q_qategory_single->jum_artikel.' '.$r_q_qategory_single->name_cat;
		$namabidang='('.$r_q_qategory_single->jum_artikel.') '.$r_q_qategory_single->name_cat;
	}else{
		$namabidang='Kategori';
	}
		if ($this->input->post("keyword_text_artikel_bidang")<>'')
		{
			$keyword_text_artikel_bidang=$this->input->post("keyword_text_artikel_bidang");	
			$bidang=$this->input->post('bidang');
			$namabidang=$this->input->post('namabidang');
		}

		$data['bidang']=$bidang;
		$data['namabidang']=$namabidang;
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text_artikel_bidang = str_replace('%20',' ',$keyword_text_artikel_bidang);
		$data['keyword_text_artikel_bidang']=$keyword_text_artikel_bidang;
		$query_artikel_bidang=$this->model_artikel->get_data_artikel_bidang($keyword_text_artikel_bidang,$bidang);
		$config['base_url'] = site_url().'/Artikel/get_artikel_bidang/'.$keyword_text_artikel_bidang.'/'.$bidang;
		$config['uri_segment']=5;
		
		$config['div'] = "#paneltargetbidang";

		$config['total_rows'] = $query_artikel_bidang->num_rows();
		$data['total_rows']=$query_artikel_bidang->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['query_artikel_bidang']=$this->model_artikel->get_data_artikel_bidang_per_page( $limit, $offset,$keyword_text_artikel_bidang,$bidang);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		
		$this->load->view('artikel/artikel_bidang',$data);
	}

	function get_artikel_single($id)
	{
		$user_public_id=$this->session->userdata('user_public_id');
		
		
		// 1. update hit count ( off )
		// 2. if users login then save the histori search
		$user_id=$this->session->userdata('user_public_id');
		if ($user_id <>'')
		{
		$this->validations->check_user_session_is_there();
		$this->model_artikel->add_count_hit_artikel($id,$user_id);
		}

		//$this->model_users_public->log_user_public_view($user_public_id,$id);
		
		// 3. Check are download quota is available
		if ($user_public_id<>''){
			$query_saldo_quota=$this->model_users_public->check_user_public_quota($user_public_id);
			$row_saldo_quota=$query_saldo_quota->row();
			$data['saldo_quota']=$row_saldo_quota->saldo_quota_download;
		  $data['blm_login']='no';
		} else {
			$data['saldo_quota']=0;
			$data['blm_login']='yes';
		
		}
		
		/*
		 * show detail data
		 */
		$query_artikel=$this->model_artikel->get_data_artikel_single($id);
		$data['query_artikel']=$query_artikel;
		
		/*
		 * show data author
		 */
		$query_author_artikel=$this->model_artikel->get_data_author_artikel_detail($id);
		$data['query_author_artikel']=$query_author_artikel;
		
		$this->load->view('artikel/artikel_view_single',$data);	
	}
	//detail artikel , from direktori
	function get_artikel_number_year_volume($number,$year,$volume,$id_direktori){
		$q_artikel_number_year_volume=$this->model_artikel->get_list_artikel_number_year_volume($number,$year,$volume,$id_direktori);
		$data['q_artikel_number_year_volume']=$q_artikel_number_year_volume;
		$data['number']=$number;
		$data['year']=$year;
		$data['volume']=$volume;
		$this->load->view('artikel/artikel_number_year_volume',$data);
	}
	function get_chart_viewed_downloaded(){
		$data['q_data']=$this->model_artikel->get_compotition_count_viewed_downloaded();
		$this->load->view('dashboard/chart_viewed_downloaded',$data);
	}

	function get_user_public_count_all()
	{
		$q_user_public_count=$this->model_users_public->get_user_public_all();
		$r_user_public_count=$q_user_public_count->row();
		$data['total_users']=$r_user_public_count->total_users;

		$q_user_public_group_count=$this->model_users_public->get_count_user_public_group();
		$data['total_users_group']=$q_user_public_group_count;		
		
		$this->load->view('dashboard/count_user_public',$data);
	}

	function get_chart_artikel_per_tahun(){
		$this_year=date("Y");
		$prev_this_year=$this_year-8;
		$query=$this->model_artikel->get_count_artikel_per_year($prev_this_year,$this_year);
			$q=$query->result();
			$q_json=json_encode($q);
			//echo $q_json;
			//echo 'haiaisdfad';
		$data['q_json']=$q_json;
		$this->load->view('dashboard/chart_count_artikel',$data);	
		//return $q_json;
	}

	function get_penerbit_terbaca(){
		$q_penerbit_terbaca=$this->model_artikel->get_penerbit_terbaca();
		$data['q_penerbit_terbaca']=$q_penerbit_terbaca;
		$this->load->view('dashboard/penerbit_terbaca',$data);
	}

	function get_author_terbaca(){
		$q_author_terbaca=$this->model_artikel->get_author_terbaca();
		$data['q_author_terbaca']=$q_author_terbaca;
		$this->load->view('dashboard/author_terbaca',$data);
	}

	function get_chart_artikel_per_tahun_line(){
		$this_year=date("Y");
		$prev_this_year=$this_year-8;
		$query=$this->model_artikel->get_count_artikel_per_year_line($prev_this_year,$this_year);
			$q=$query->result();
			$q_json=json_encode($q);
			//echo $q_json;
		$data['q_json_line']=$q_json;
		$data['filter']="Seluruhnya";
		$this->load->view('dashboard/chart_count_artikel_line',$data);	
		//return $q_json;
	}
	function get_chart_artikel_per_tahun_line_search(){
	    $keyword_text="All";
		if ($this->input->post("keyword_text")<>'')
		{
			$keyword_text=$this->input->post("keyword_text");	
		}
    
    $this_year=date("Y");
		$prev_this_year=$this_year-8;
		$query=$this->model_artikel->get_count_artikel_per_year_line_search($prev_this_year,$this_year,$keyword_text);
			$q=$query->result();
			$q_json=json_encode($q);
			//echo $q_json;
		$data['q_json_line']=$q_json;
		$data['filter']=$keyword_text;
		$this->load->view('dashboard/chart_count_artikel_line',$data);	
		//return $q_json;
	}

	function get_chart_baca_donlot_artikel_per_tahun_bar(){
		$this_year=date("Y");
		$prev_this_year=$this_year-8;
		$query=$this->model_artikel->get_sum_baca_artikel_per_year_line($prev_this_year,$this_year);
			$q=$query->result();
			$q_json=json_encode($q);
		$data['q_json_line']=$q_json;
		$this->load->view('dashboard/chart_sum_baca_donlot_artikel_line',$data);	
		//return $q_json;
	}

	function get_total_baca_donlot(){
		$q_total_baca_donlot=$this->model_artikel->get_total_baca_donlot();
		$r_q_total_baca_donlot=$q_total_baca_donlot->row();
		$data['hitung_baca']=$r_q_total_baca_donlot->hitung_baca;
		$data['hitung_download']=$r_q_total_baca_donlot->hitung_download;
		$this->load->view('dashboard/chart_baca_download',$data);
	}


	function show_detail_chart_line($year){
		$q_chart_artikel_per_month=$this->model_artikel->get_count_artikel_per_month($year);
		$q=$q_chart_artikel_per_month->result();
		$q_json_month=json_encode($q);
		
		$data['tahun']=$year;
		$data['q_json_line_month']=$q_json_month;
		
		$this->load->view('dashboard/detail_chart_line',$data);
	}
	
	function get_file_to_donwload($id_artikel){

		//$query_artikel=$this->model_artikel->get_data_author_artikel_detail($id_artikel);
		//$row_artikel=$query_artikel->row();
		$this->validations->check_user_session_is_there();

		$query_artikel=$this->model_artikel->get_data_artikel_single($id_artikel);
		$user_id=$this->session->userdata('user_public_id');
		// handle download count
		$this->model_artikel->add_count_download_artikel($id_artikel,$user_id);

		$row_artikel=$query_artikel->row();
		$file_name=$row_artikel->fullteks;
		$file_name=str_replace(' ', '%20', $file_name);

		$file_url =base_url().'file_download/'.$file_name;

		
		$data['file_url']=$file_url;
		$data['file_name']=$file_name;

		switch(strtolower(substr(strrchr($row_artikel->fullteks, '.'), 1))) {
		case 'pdf': $mime = 'application/pdf'; break;
		case 'zip': $mime = 'application/zip'; break;
		case 'jpeg':
		case 'jpg': $mime = 'image/jpg'; break;
		default: $mime = 'application/force-download';
		}
		$data['mime']=$mime;


		$this->load->view('download/download',$data);
	}
	

	function adv_search(){
		$this->load->view('artikel/adv_search');
	}
}
?>
