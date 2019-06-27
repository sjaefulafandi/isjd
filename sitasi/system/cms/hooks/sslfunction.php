<?php

if ( ! function_exists('force_ssl'))
{
    function force_ssl()
    {
		$CI =& get_instance();
        if ( ! $CI->input->server('HTTPS'))
        {
			$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
			if ($_SERVER['SERVER_PORT'] != 443) 
				redirect($CI->uri->uri_string());
        }
    }
}
 
if ( ! function_exists('unforce_ssl'))
{
	function unforce_ssl()
	{
		$CI =& get_instance();
        if ($CI->input->server('HTTPS'))
		{
			$CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);
			if ($_SERVER['SERVER_PORT'] == 443)
				redirect($CI->uri->uri_string());
        }
	}
}

function redirect_sslfunction() {
	
    $CI =& get_instance();
    $class = $CI->router->fetch_class();
    $method = $CI->router->fetch_method();

//     $sslclasses = array('admin');
    $ssl = array('users/login');
    $partial =  array('login','registration');

//     if(in_array($class, $sslclasses) OR in_array("$class/$method", $ssl)) {
    if(in_array("$class/$method", $ssl)) {
    	force_ssl();
    } else if(in_array($class,$partial)) {
       return;
    } else {
       unforce_ssl();
    }
}

?>
