<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package        CodeIgniter
 * @author        ExpressionEngine Dev Team
 * @copyright    Copyright (c) 2006, EllisLab, Inc.
 * @license        http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Pagination
 * @author        ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/libraries/pagination.html
 */
class Ajax_pagination {

    var $base_url            = ''; // The page we are linking to
    var $total_rows          = ''; // Total number of items (database results)
    var $per_page             = 2; // Max number of items you want shown per page
    var $num_links            =  2; // Number of "digit" links to show before/after the currently viewed page
    var $cur_page             =  ''; // The current page being viewed
    var $first_link           = '&lsaquo;&lsaquo;';
    var $next_link            = ' &rsaquo; ';
    var $prev_link            = ' &lsaquo; ';
    var $last_link            = '&rsaquo;&rsaquo;';
    var $uri_segment        = 3;
    var $full_tag_open        = '<div class="pagination pagination-small" ><ul>';
    var $full_tag_close        = '</ul></div>';
    var $first_tag_open        = '<li>';
    var $first_tag_close    	= '</li>';
    var $last_tag_open        = '<li>';
    var $last_tag_close        = '</li>';
    var $cur_tag_open        = '<li>';
    var $cur_tag_close        = '</li>';
    var $next_tag_open        = '<li>';
    var $next_tag_close        = '</li>';
    var $prev_tag_open        = '<li>';
    var $prev_tag_close        = '</li>';
    var $num_tag_open        = '';
    var $num_tag_close        = '';
    //ADDED BY GIN2
    var $div                = '';
    var $postVar             = '';

    /**
     * Constructor
     *
     * @access    public
     * @param    array    initialization parameters
     */
    function Ajax_pagination($params = array())
    {
        if (count($params) > 0)
        {
            $this->initialize($params);        
        }
        
        log_message('debug', "Pagination Class Initialized");
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Initialize Preferences
     *
     * @access    public
     * @param    array    initialization parameters
     * @return    void
     */
    function initialize($params = array())
    {
        if (count($params) > 0)
        {
            foreach ($params as $key => $val)
            {
                if (isset($this->$key))
                {
                    $this->$key = $val;
                }
            }        
        }
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Generate the pagination links
     *
     * @access    public
     * @return    string
     */    
    function create_links()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0)
        {
           return '';
        }

        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);

        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1)
        {
            return '';
        }

        // Determine the current page number.        
        //$CI =& get_instance();    
//        if ($CI->uri->segment($this->uri_segment) != 0)
//        {
//            $this->cur_page = $CI->uri->segment($this->uri_segment);
//            
//            // Prep the current page - no funny business!
//            $this->cur_page = (int) $this->cur_page;
//        }
        
        //Modified
        // Determine the current page number.        
        $CI =& get_instance();
        $var = 0;
        if($CI->input->post($this->postVar)):
            $var = $CI->input->post($this->postVar);
            settype($var, "integer");
        endif;
            
        if ($var !== 0)
        {
            $this->cur_page = $var;
            
            // Prep the current page - no funny business!
            $this->cur_page = (int) $this->cur_page;
        }

        $this->num_links = (int)$this->num_links;
        
        if ($this->num_links < 1)
        {
            show_error('Your number of links must be a positive number.');
        }
                
        if ( ! is_numeric($this->cur_page))
        {
            $this->cur_page = 0;
        }
        
        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $this->total_rows)
        {
            $this->cur_page = ($num_pages - 1) * $this->per_page;
       
        }
        
        $uri_page_number = $this->cur_page;
        $this->cur_page = floor(($this->cur_page/$this->per_page) + 1);

        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') .'/';
		$output='';
 	         // And here we go...
        
        // Render the "First" link
        
        if  ($this->cur_page > $this->num_links)
        {
            $link = $this->my_link_to_remote($this->base_url, $this->first_link, $this->div, NULL);
            //$output .= $this->first_tag_open.'<a >base_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;
            $output .= $this->first_tag_open.$link.$this->first_tag_close;
       		 
        }

        // Render the "previous" link
        if  ($this->cur_page != 1)
        {
            $i = $uri_page_number - $this->per_page;
            if ($i == 0){ 
                $i = '';
                $pars = NULL;
            } else {
                $pars = array($this->postVar=>$i);
            }
            $link = $this->my_link_to_remote($this->base_url, $this->prev_link, $this->div, $pars);
            //$output .= $this->prev_tag_open.'<a >base_url.$i.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
            $output .= $this->prev_tag_open.$link.$this->prev_tag_close;
        
        }
		
        // Write the digit links
        for ($loop = $start -1; $loop <= $end; $loop++)
        {
            $i = ($loop * $this->per_page) - $this->per_page;
                   
            if ($i >= 0)
            {
                if ($this->cur_page == $loop)
                {
                    //$output .= $this->cur_tag_open.'<a href="#" class="active">'.$loop.'</a>'.$this->cur_tag_close; // Current page
                    $output .= '<li class="active"><a href="#" >'.$loop.'</a></li>'; // Current page
                    //print $output;
                }
                else
                {
                    $n = ($i == 0) ? '' : $i;
                    if($n !== ''){
                        $pars = array($this->postVar=>$n);
                    } else {
                        $pars = NULL;
                    }


                    $link = $this->my_link_to_remote($this->base_url, $loop, $this->div, $pars);
                    //$output .= $this->num_tag_open.'<a >base_url.$n.'">'.$loop.'</a>'.$this->num_tag_close;
                    $output .= '<li>'.$link.'</li>';
					//$output .= $link;
					//print $output;
                }
            }
            
        }

        // Render the "next" link
        if ($this->cur_page < $num_pages)
        {
            $pars = array($this->postVar=>($this->cur_page * $this->per_page));
            $link = $this->my_link_to_remote($this->base_url, $this->next_link, $this->div, $pars);
            //$output .= $this->next_tag_open.'<a >base_url.($this->cur_page * $this->per_page).'">'.$this->next_link.'</a>'.$this->next_tag_close;
            $output .= $this->next_tag_open.$link.$this->next_tag_close;
        }

        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages)
        {
            $i = (($num_pages * $this->per_page) - $this->per_page);
            $pars = array($this->postVar=>$i);
            $link = $this->my_link_to_remote($this->base_url, $this->last_link, $this->div, $pars);
            //$output .= $this->last_tag_open.'<a >base_url.$i.'">'.$this->last_link.'</a>'.$this->last_tag_close;
            $output .= $this->last_tag_open.$link.$this->last_tag_close;
        }

        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
		
		
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open.$output.$this->full_tag_close;
        
        return $output;        
    }
    
    function my_link_to_remote($url, $text, $div, $pars=array()){
        //$html ="<nav>";
        //$html .="<ul class=\"pagination\">";
        if($pars !== NULL):
	        foreach($pars as $k=>$v):
	            $par = $k.":".$v;
	        
	           endforeach;  
			
	        /*   $html = "<a href=\"#\"  onclick=\"new Ajax.Updater('$div','$url',{method: 'post', parameters:{".$par.",ajaxp:1}, evalScripts:true}); return false;\" >$text</a>";
	        else:
	        $html = "<a href=\"#\"  onclick=\"new Ajax.Updater('$div','$url',{method: 'post', parameters:{ajaxp:1}, evalScripts:true}); return false;\" >$text</a>";
	        endif; */
	        
	         //<li><a href="#">Prev</a></li>
		    //<li><a href="#">1</a></li>
		    //<li><a href="#">2</a></li>
		    //<li><a href="#">3</a></li>
		    //<li><a href="#">4</a></li>
		    //<li><a href="#">5</a></li>
		    //<li><a href="#">Next</a></li>
		   
			
			 $html = "<a href=\"#\"  onclick=\"$('#$div').load('$url',{".$par."}); return false;\" >$text</a>";
        else:
        	$html  ="<a href=\"#\"  onclick=\"$('#$div').load('$url',{}); return false;\" >$text</a>";
        endif;
		
        //$html .="</ul>";
        //$html .="</nav>";
		//echo 'html : '.$html;

		

    return $html;
    }
}
// END Pagination Class
?>  