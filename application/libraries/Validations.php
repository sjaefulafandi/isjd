<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validations {

    function check_user_admin_session_is_there()
    {
    	$CI =& get_instance();
    	
    		//$CI->load->library('session');
    	
    	if ($CI->session->userdata('user_id')==NULL) 
		{
				//exit();
				//$array_items = array('username' => '', 'email' => '');
				//$CI->session->unset_userdata($array_items);
				$CI->session->sess_destroy();
				$string=$CI->load->view('temp_for_logout_admin','',TRUE);
				die($string);
		}
    }

    function check_user_session_is_there()
    {
    	$CI =& get_instance();
    	if ($CI->session->userdata('user_public_id')==NULL) 
		{
				$CI->session->sess_destroy();
				$string=$CI->load->view('temp_for_logout','',TRUE);
				die($string);
		}
    }
}

/* End of file Someclass.php */