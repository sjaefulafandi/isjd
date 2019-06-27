<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template 
| group to make active.  By default there is only one group (the 
| "default" group).
|
*/
$template['active_template'] = 'public_no_login';

/*
|--------------------------------------------------------------------------
| Explaination of template group variables
|--------------------------------------------------------------------------
|
| ['template'] The filename of your master template file in the Views folder.
|   Typically this file will contain a full XHTML skeleton that outputs your
|   full template or region per region. Include the file extension if other
|   than ".php"
| ['regions'] Places within the template where your content may land. 
|   You may also include default markup, wrappers and attributes here 
|   (though not recommended). Region keys must be translatable into variables 
|   (no spaces or dashes, etc)
| ['parser'] The parser class/library to use for the parse_view() method
|   NOTE: See http://codeigniter.com/forums/viewthread/60050/P0/ for a good
|   Smarty Parser that works perfectly with Template
| ['parse_template'] FALSE (default) to treat master template as a View. TRUE
|   to user parser (see above) on the master template
|
| Region information can be extended by setting the following variables:
| ['content'] Must be an array! Use to set default region content
| ['name'] A string to identify the region beyond what it is defined by its key.
| ['wrapper'] An HTML element to wrap the region contents in. (We 
|   recommend doing this in your template file.)
| ['attributes'] Multidimensional array defining HTML attributes of the 
|   wrapper. (We recommend doing this in your template file.)
|
| Example:
| $template['default']['regions'] = array(
|    'header' => array(
|       'content' => array('<h1>Welcome</h1>','<p>Hello World</p>'),
|       'name' => 'Page Header',
|       'wrapper' => '<div>',
|       'attributes' => array('id' => 'header', 'class' => 'clearfix')
|    )
| );
|
*/

/*
|--------------------------------------------------------------------------
| Default Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

/*
 * Konfigurasi template berikut adalah untuk halaman web tanpa login
 * 
 */
//public

$template['public_no_login']['template']='template/public_no_login.php';
$template['public_no_login']['regions']= array (
'content_header',
'content_report',
'search_bar',
'content_worksheet'
);
$template['public_no_login']['parser'] = 'parser';
$template['public_no_login']['parser_method'] = 'parse';
$template['public_no_login']['parse_template'] = FALSE;

//public dashboard

$template['public_no_login_dashboard']['template']='template/public_no_login_dashboard.php';
$template['public_no_login_dashboard']['regions']= array (
'content_header',
'content_report'
);
$template['public_no_login_dashboard']['parser'] = 'parser';
$template['public_no_login_dashboard']['parser_method'] = 'parse';
$template['public_no_login_dashboard']['parse_template'] = FALSE;

//admin template

$template['admin_template']['template']='template/admin_template.php';
$template['admin_template']['regions']= array (
'content_header',
'content_menu',
'content_worksheet'
);
$template['admin_template']['parser'] = 'parser';
$template['admin_template']['parser_method'] = 'parse';
$template['admin_template']['parse_template'] = FALSE;

//admin public_no_lgin_direktori
$template['public_no_login_direktori']['template']='template/public_no_login_direktori.php';
$template['public_no_login_direktori']['regions']= array (
'content_header',
'content_comment',
'content_worksheet',
);
$template['public_no_login_direktori']['parser'] = 'parser';
$template['public_no_login_direktori']['parser_method'] = 'parse';
$template['public_no_login_direktori']['parse_template'] = FALSE;





/* End of file template.php */
/* Location: ./system/application/config/template.php */