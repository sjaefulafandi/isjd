<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user_public extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_users_public');
		$this->load->model('model_referensi');
		$this->load->library('Jquery_pagination');
		$this->load->library('Validations');
		//$this->validations->check_user_session_is_there();
	}

	function check_user_public(){

		if ($this->session->userdata('user_public_id')==NULL){
			$user_public_id=$this->input->post('user_public_id');
			$password=md5($this->input->post('password'));
			$data['user_public_id']=$user_public_id;
			$data['hit_by_user']='ok';
			$data['password']=$password;
		}else{
			$user_public_id=$this->session->userdata('user_public_id');
			$password=$this->session->userdata('user_password');
			$data['hit_by_user']='nok';
			$data['user_public_id']=$user_public_id;
			$data['password']=$password;
		}

		$jenis_user=$this->input->post('jenis_user');

		if ($jenis_user=='publik')
		{
			$query_user_public=$this->model_users_public->check_user_public_exist($user_public_id,$password);
			if ($query_user_public->num_rows()>0)
			{
				$row_user_public=$query_user_public->row();
				//$this->session->sess_create();
				$newdata = array(
						'user_public_id'=>$user_public_id,
						'user_name'  => $row_user_public->user_public_name,
						'user_password'=>$password,
						'user_group'=>$row_user_public->id_user_group,
						'jenis_user'=>$jenis_user,
						'logged_in' => TRUE
	               );

				$this->session->set_userdata($newdata);
				
				$data['sukses']='ok';
				
				$this->load->view('users/user_public',$data);
			}else{
				$data['sukses']='not ok';
				//$data['user_public_id']=$user_public_id;
				$this->load->view('users/user_public',$data);
			}
		}else{
			//hai
			
			
			$query_user_public=$this->model_users_public->get_user_issn($user_public_id);
			//echo 'adf'.$user_public_id.'////';

			if ($query_user_public->num_rows()>0 and $user_public_id!='')
			{
				$row_user_public=$query_user_public->row();
				
				if ($row_user_public->issn_password!= NULL  )
				{
				//$row_user_public->issn_password==md5($password)
				//$this->session->sess_create();
					//echo $this->input->post('password');

					if ($row_user_public->issn_password==$password)
					{
						$newdata = array(
						'user_public_id'=>$user_public_id,
						'user_name'  => $user_public_id,
						'user_password'=>$password,
						'user_group'=>$user_public_id,
						'jenis_user'=>$jenis_user,
						'logged_in' => TRUE
				               );

							$this->session->set_userdata($newdata);
							$data['sukses']='ok';
							$this->load->view('users/User_penerbit',$data);

					}else{
						//echo 'aasdd';
						$data['sukses']='not ok';
						//$data['user_public_id']=$user_public_id;
						$this->load->view('users/user_public',$data);		
					}
				}else //check password null or not
				{
					//save password that new entrance	
					if ($this->input->post('password') !='')
					{
						$this->model_users_public->insert_password_issn($user_public_id,$password);
					}
					$newdata = array(
						'user_public_id'=>$user_public_id,
						'user_name'  => $user_public_id,
						'user_password'=>$password,
						'user_group'=>$user_public_id,
						'jenis_user'=>$jenis_user,
						'logged_in' => TRUE
	               );

				$this->session->set_userdata($newdata);
				$data['sukses']='ok';
				$this->load->view('users/User_penerbit',$data);

				}
			}else{
				//echo 'a';
				$data['sukses']='not ok';
				//$data['user_public_id']=$user_public_id;
				$this->load->view('users/user_public',$data);
			}


		}
	} //end of function check_user_public
	
	function log_out_user_public(){
		$this->session->sess_destroy();
		redirect (base_url().'index.php/public_no_login');
	} // end of function log_out_user_public

	function get_form_user_registration(){
		//$this->validations->check_user_session_is_there();

		$query_data_users=$this->model_referensi->get_user_group();

		$data['user_group']=$query_data_users;
		$this->load->view('users/Form_users_public',$data);
	} // end of function get_form_user_registration
	
	function save_user_public(){
		//$this->validations->check_user_session_is_there();

		$nama_lengkap=$this->input->post('nama_lengkap');
		$emails=$this->input->post('emails');
		$user_id=$this->input->post('user_id');
		$user_groups=$this->input->post('user_groups');
		$passwords=$this->input->post('passwords');
		$password2=$this->input->post('password2');
		$kota=$this->input->post('kota');
		$institusi=$this->input->post('institusi');
		$jk=$this->input->post('jk');
		$alamat=$this->input->post('alamat');
		$hp=$this->input->post('hp');
		
		$passwords=md5($passwords);
		$this->model_users_public->save_user_public($nama_lengkap,$emails,$user_id,$user_groups,$passwords,$kota,$institusi,$jk,$alamat,$hp);
		$data['info']='Data Anda telah tersimpan dan segera kami lakukan data proses';
		$this->load->view('konfirm_result',$data);	
		
	}

	/*
	kuota function handling
	*/
	function show_kuota_detail(){
			$this->validations->check_user_session_is_there();

		
			$query_kuota=$this->model_users_public->show_kuota($this->session->userdata('user_public_id'));
			$data_kuota['query_kuota']=$query_kuota;
			$data_kuota['jum_used_kuota']=$this->used_kuota($this->session->userdata('user_public_id'));
			
			$this->load->view('public/show_kuota',$data_kuota);
		
	}//end of show_kuota_detail

	function show_kuota_form($id_tarif_download){
		$this->validations->check_user_session_is_there();
		
			//clean up , transfer temp by delete kuota with 0  (no bonus field) but 0 kuota
			$this->model_users_public->cleanup_kuota_temp($this->session->userdata('user_public_id'));

			$q_tarif_plan=$this->model_referensi->show_tarif('1',$this->session->userdata('user_group'),$id_tarif_download);	
			$r_q_tarif_plan=$q_tarif_plan->row();

			$nominal_transfer=$r_q_tarif_plan->harga;
			$konvert_download=$r_q_tarif_plan->harga_to_download;
			
			$data['nominal_transfer']=$nominal_transfer;
			$data['konvert_download']=$konvert_download;

			$this->load->view('public/kuota_form',$data);
		
	} // end of show_kuota_form

	function upload(){
		$this->validations->check_user_session_is_there();
		// Only accept files with these extensions
		
			$whitelist = array('jpg', 'jpeg', 'png', 'gif');
			$name      = null;
			$error     = 'Terjadi kesalahan jenis file yang anda upload';
			$kode      ='';
			if (isset($_FILES)) {
				if (isset($_FILES['file'])) {
					$upload_dir= 'upload/';
					$tmp_name = $_FILES['file']['tmp_name'];
					$name     = basename($_FILES['file']['name']);
					$error    = $_FILES['file']['error'];
					
					if ($error === UPLOAD_ERR_OK) {
						$extension = pathinfo($name, PATHINFO_EXTENSION);
						if (!in_array($extension, $whitelist)) {
							$error = 'Invalid file type uploaded.';
						} else {
							
							$kode=md5(date("d m Y h:i:s"));
							$name =$kode.'.'.$extension;
							$target= $upload_dir.$name;

							move_uploaded_file($tmp_name, $upload_dir.$name);
							$this->model_users_public->save_temp_upload($this->session->userdata('user_public_id'),$target);

						}
					}
				}
			}
			echo json_encode(array(
				'name'  => $name,
				'error' => $error,
				'kode_transfer' => $kode,
			));
			die();
		
	} // end of upload

	function save_kuota(){
		$this->validations->check_user_session_is_there();

		$user_public_id=$this->session->userdata('user_public_id');
		$harga=$this->input->post('harga');
		$konversidownload=$this->input->post('konversidownload');
		$kodeuploads=$this->input->post('kodeuploads');

		$this->model_users_public->update_kuota_info($harga,$konversidownload,$user_public_id,$kodeuploads);
	} // end of save_kuota

	function used_kuota($user_public_id){
		//$user_public_id=$this->session->userdata('user_public_id');
		$q_used_quota=$this->model_users_public->get_used_kuota_per_user($user_public_id);
		$query_kuota=$this->model_users_public->show_saldo_kuota($user_public_id);

		$r_q_used_quota=$q_used_quota->row();
		$r_query_quota=$query_kuota->row();
		$string=$r_q_used_quota->jum_used_kuota.'/'.$r_query_quota->saldo_quota_download;

		return $string;
	}



	/****** kuota functions handling bottom line *****/
	
	function show_kabupaten_kota_auto(){

		$q=$this->input->post('q');
		$q_kota_kabupaten=$this->model_referensi->show_kota_kabupaten($q);
		foreach($q_kota_kabupaten->result() as $result)
			{
			$suggestions[] = array(
			"id" => $result->id_kabupaten_kota,
			"name" => $result->kabupaten_kota
			);
		}

		echo json_encode($suggestions);
		die();
	} // end of show_kabupaten_kota_auto
	
	//show informasi kuota
	function show_informasi_tarif(){
		
		//get user profile
		$this->validations->check_user_session_is_there();
			$q_user_group=$this->model_referensi->get_user_group($this->session->userdata('user_group'));
			$data['q_user_group']=$q_user_group;
			//get tarif plan
			$q_tarif_download=$this->model_referensi->show_tarif('1',$this->session->userdata('user_group'));
			$data['q_tarif_download']=$q_tarif_download;

			$this->load->view("users/informasi",$data);
		
	}//end of show_informasi_tarif

	//show history
	function show_history_user($keyword_text_view_user="All",$offset = 0){
		$this->validations->check_user_session_is_there();

			if ($this->input->post("keyword_text_view_user")<>'')
			{
				$keyword_text_view_user=$this->input->post("keyword_text_view_user");
			}
			//$keyword_text=htmlencode($keyword_text);
			$keyword_text_view_user = str_replace('%20',' ',$keyword_text_view_user);
			$data['keyword_text_view_user']=$keyword_text_view_user;
			$q_log_view_download=$this->model_users_public->get_log_view_download($keyword_text_view_user);
			$config['base_url'] = site_url().'/user_public/show_history_user/'.$keyword_text_view_user;
			$config['div'] = "#dRekamjejak";
			
			$config['total_rows'] = $q_log_view_download->num_rows();
			$data['total_rows']=$q_log_view_download->num_rows();
			$data['offset']=$offset;
		    $config['per_page'] = $this->config->item('per_page');
		    $limit=$this->config->item('per_page');
			
		    $data['q_log_view_download']=$this->model_users_public->get_log_view_download_per_page( $limit, $offset,$keyword_text_view_user);
			//$data['show_dismantle']='no';
			
			$this->jquery_pagination->initialize($config);
			$this->load->view('users/history_view_download',$data);
		
	}

	/*
	Komplain handling
	*/
	function show_komplain_user($keyword_text_komplain_user="All",$offset = 0){
		
		$this->validations->check_user_session_is_there();
			if ($this->input->post("keyword_text_komplain_user")<>'')
			{
				$keyword_text_komplain_user=$this->input->post("keyword_text_komplain_user");
			}
			//$keyword_text=htmlencode($keyword_text);
			$keyword_text_komplain_user = str_replace('%20',' ',$keyword_text_komplain_user);
			$data['keyword_text_komplain_user']=$keyword_text_komplain_user;
			$q_log_komplain=$this->model_users_public->get_log_komplain($keyword_text_komplain_user);
			$config['base_url'] = site_url().'/user_public/show_komplain_user/'.$keyword_text_komplain_user;
			$config['div'] = "#dKomplain";
			
			$config['total_rows'] = $q_log_komplain->num_rows();
			$data['total_rows']=$q_log_komplain->num_rows();
			$data['offset']=$offset;
		    $config['per_page'] = $this->config->item('per_page');
		    $limit=$this->config->item('per_page');
			
		    $data['q_log_komplain']=$this->model_users_public->get_log_komplain_per_page( $limit, $offset,$keyword_text_komplain_user);
			//$data['show_dismantle']='no';
			
			$this->jquery_pagination->initialize($config);
			$this->load->view('users/komplain_view',$data);
		

	}//end of function show_komplain_user

	//form komplain
	function show_komplain_form(){
		$this->validations->check_user_session_is_there();

		$this->load->view('public/komplain_form');
	} //end of show_komplain_form

	function save_komplain(){
		$this->validations->check_user_session_is_there();

		$comment_complain=$this->input->post('comment_complain');
		$user_public_id=$this->session->userdata('user_public_id');
		$id_complain=$this->input->post('id_complain');
		$this->model_users_public->save_komplain($comment_complain,$user_public_id,$id_complain);
	} //end of save_komplain

	function show_komplain_detail($keyword_text_komplain_detail_user="All",$id_user_complain,$offset = 0){
		
		$this->validations->check_user_session_is_there();
		//$id_user_complain=$this->input->post('id_user_complain');
		$data['id_user_complain']=$id_user_complain;

		if ($this->input->post("keyword_text_komplain_detail_user")<>'')
		{
			$keyword_text_komplain_detail_user=$this->input->post("keyword_text_komplain_detail_user");
		}
		//$keyword_text=htmlencode($keyword_text);
		$keyword_text_komplain_detail_user = str_replace('%20',' ',$keyword_text_komplain_detail_user);
		$data['keyword_text_komplain_detail_user']=$keyword_text_komplain_detail_user;
		$q_log_komplain_detail=$this->model_users_public->get_log_komplain_detail($keyword_text_komplain_detail_user,$id_user_complain);
		$config['base_url'] = site_url().'/user_public/show_komplain_detail/'.$keyword_text_komplain_detail_user.'/'.$id_user_complain;
		$config['div'] = "#modaltarget";
		$config['uri_segment']=5;
		
		$config['total_rows'] = $q_log_komplain_detail->num_rows();
		$data['total_rows']=$q_log_komplain_detail->num_rows();
		$data['offset']=$offset;
	    $config['per_page'] = $this->config->item('per_page');
	    $limit=$this->config->item('per_page');
		
	    $data['q_log_komplain_detail']=$this->model_users_public->get_log_komplain_detail_per_page( $limit, $offset,$keyword_text_komplain_detail_user,$id_user_complain);
		//$data['show_dismantle']='no';
		
		$this->jquery_pagination->initialize($config);
		//$this->load->view('users/komplain_view',$data);

		$this->load->view('public/komplain_detail',$data);
	} // end of show_komplain_detail

	function show_komplain_detail_form(){
		$this->validations->check_user_session_is_there();

		$data['id_user_complain']=$this->input->post('id_user_complain');


		$this->load->view('public/komplain_detail_form',$data);
	} //end of show_komplain_detail_form

	function save_komplain_detail(){
		$this->validations->check_user_session_is_there();

		$comment_complain=$this->input->post('comment_complain');
		$user_public_id=$this->session->userdata('user_public_id');
		$statuskomplain=$this->input->post('statuskomplain');
		$id_user_complain=$this->input->post('id_user_complain');

		$this->model_users_public->save_komplain_detail($comment_complain,$user_public_id,$statuskomplain,$id_user_complain);

	} // end of save_komplain_detail

	function get_user_all_public()
	{
		$q_user_all=$this->model_users_public->get_user_public_all();
	}
	function show_user_profile()
	{
		$this->validations->check_user_session_is_there();
		
		$data['sukses']='not ok';
		$data['password_baru']='';
		$data['password_lama']='';
		
		$this->load->view('users/myprofile',$data);
	}
	function user_change_password()
	{
		$this->validations->check_user_session_is_there();
		$user_public_id=$this->session->userdata('user_public_id');
		$password_lama=$this->input->post('password_lama');
		$password_lama_md5=md5($password_lama);

		$password_baru=$this->input->post('password_baru');
		$password_baru_md5=md5($password_baru);


		$q_user_exist=$this->model_users_public->check_user_public_exist($user_public_id,$password_lama_md5);

		if ($q_user_exist->num_rows() > 0)
		{
			$data['sukses']='ok';
			$data['password_baru']=$password_baru;
			$data['password_lama']=$password_lama;
			$this->model_users_public->update_user_password($user_public_id,$password_lama_md5,$password_baru_md5);
			$this->load->view('users/myprofile',$data);		
		}else{
			$data['sukses']='not ok';
			$data['password_baru']=$password_baru;
			$data['password_lama']=$password_lama;
			$this->load->view('users/myprofile',$data);
		}

	}
	
	function user_penerbit_change_password(){
		$this->validations->check_user_session_is_there();
		$user_public_id=$this->session->userdata('user_public_id');
		$password_lama=$this->input->post('password_lama');
		$password_lama_md5=md5($password_lama);

		$password_baru=$this->input->post('password_baru');
		$password_baru_md5=md5($password_baru);


		$q_user_exist=$this->model_users_public->check_user_penerbit_exist($user_public_id,$password_lama_md5);

		if ($q_user_exist->num_rows() > 0)
		{
			$data['sukses']='ok';
			$data['password_baru']=$password_baru;
			$data['password_lama']=$password_lama;
			$this->model_users_public->update_user_penerbit_password($user_public_id,$password_lama_md5,$password_baru_md5);
			$this->load->view('users/myprofile_penerbit',$data);		
		}else{
			$data['sukses']='not ok';
			$data['password_baru']=$password_baru;
			$data['password_lama']=$password_lama;
			$this->load->view('users/myprofile_penerbit',$data);
		}		
	}
}// end of class user_public
?>