<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright   Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage  Libraries
 * @category    Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */

class CI_Pagination {

    var $base_url				= ''; // The page we are linking to
    var $prefix					= ''; // A custom prefix added to the path.
    var $prefixid				= ''; // A custom prefix id added to the path.
    var $suffix					= ''; // A custom suffix added to the path.
    var $page					= '';

    var $total_rows				= ''; // Total number of items (database results)
    var $per_page				= 12; // Max number of items you want shown per page
    var $num_links				=  5; // Number of "digit" links to show before/after the currently viewed page
    var $cur_page				=  1; // The current page being viewed
    var $first_link				= '&lsaquo; First';
    var $next_link				= ''; // '&nbsp;';
    var $prev_link				= ''; // '&nbsp;';
    var $last_link				= 'Last &rsaquo;';
    var $uri_segment			= 3;
    var $full_tag_open			= '';
    var $full_tag_close			= '';
    var $first_tag_open			= '';
    var $first_tag_close		= '';
    var $last_tag_open			= '';
    var $last_tag_close			= '';
    var $first_url				= ''; // Alternative URL for the First Page.
    var $cur_tag_open			= '<strong>';
    var $cur_tag_close			= '</strong>';
    var $next_tag_open			= '';
    var $next_tag_close			= '';
    var $prev_tag_open			= '';
    var $prev_tag_close			= '';
    var $num_tag_open			= '';
    var $num_tag_close			= '';
    var $page_query_string		= FALSE;
    var $query_string_segment 	= 'per_page';
    var $display_pages			= TRUE;
    var $anchor_class			= '';
    var $anchor_prev_id			= '';
    var $anchor_prev_class		= '';
    var $anchor_next_id			= '';
    var $anchor_next_class		= '';
    var $current_page			= '';
    var $content_tag_open   	= '';
    var $content_tag_close  	= '';
    var $filter    				= '';
    var $basepath_link      	= '';

    /**
     * Constructor
     *
     * @access	public
     * @param	array	initialization parameters
     */
    public function __construct($params = array())
    {
        if (count($params) > 0)
        {
            $this->initialize($params);
        }

        if ($this->anchor_class != '')
        {
            $this->anchor_class = 'class="'.$this->anchor_class.'" ';
        }

        log_message('debug', "Pagination Class Initialized");
    }

    // --------------------------------------------------------------------

    /**
     * Initialize Preferences
     *
     * @access	public
     * @param	array	initialization parameters
     * @return	void
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
     * @access	public
     * @return	string
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
        $CI =& get_instance();

        if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
        {
            if ($CI->input->get($this->query_string_segment) != 0)
            {
                $this->cur_page = $CI->input->get($this->query_string_segment);

                // Prep the current page - no funny business!
                $this->cur_page = (int) $this->cur_page;
            }
        }
        else
        {
            //if ($CI->uri->segment($this->uri_segment) != 0)
            if ($this->page != 0)
            {
                $this->cur_page = $this->page;

                // Prep the current page - no funny business!
                $this->cur_page = (int) $this->cur_page;
            }
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

        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

        // Is pagination being used over GET or POST?  If get, add a per_page query
        // string. If post, add a trailing slash to the base URL if needed
        if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
        {
            $this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
        }
			else
        {
            $this->base_url = rtrim($this->base_url, '/') .'/';
        }

        // And here we go...
        $output = '';
        $output_prev_link = '';
        $output_next_link = '';
        $build_pagination['link_next'] = '';
        $build_pagination['link_prev'] = '';

        // Render the "First" link
        if  ($this->first_link !== FALSE AND $this->cur_page > ($this->num_links + 1))
        {
            $first_url = ($this->first_url == '') ? $this->base_url : $this->first_url;
        }

        // Render the "previous" link
        if  ($this->prev_link !== FALSE AND $this->cur_page != 1)
        {
            $i = $uri_page_number - 1;

            if ($i == 0 && $this->first_url != '')
            {
                $build_pagination['link_prev'] = $this->first_url;
            }
				else
            {
                $i = ($i == 0) ? '' : $i.$this->suffix;
                $build_pagination['link_prev'] = site_url($this->basepath_link.'/'.$i).$this->filter;
            }
        }
        
        // Render the pages
        if ($this->display_pages !== FALSE)
        {
            // Write the digit links
            for ($loop = $start -1; $loop <= $end; $loop++)
            {
                $i = ($loop * $this->per_page) - $this->per_page;

                if ($i >= 0)
                {
                    if ($this->cur_page == $loop)
                    {
                        $build_pagination['pages'][$loop]['id']       = $loop;
                        $build_pagination['pages'][$loop]['link']     = 'javascript:void(0);';
                        $build_pagination['pages'][$loop]['selected'] = 1;
                    }
						else
                    {
                        $n = ($i == 0) ? '1' : $loop;

                        if ($n == '' && $this->first_url != '')
                        {
                            $build_pagination['pages'][$loop]['id']       = $loop;
                            $build_pagination['pages'][$loop]['link']     = $this->first_url;
                            $build_pagination['pages'][$loop]['selected'] = 1;
                        }
							else
                        {
                            $n = ($n == '') ? '' : $n.$this->suffix;
                            
                            $build_pagination['pages'][$loop]['id']       = $loop;
                            $build_pagination['pages'][$loop]['link']     = site_url($this->basepath_link.'/'.$loop).$this->filter;
                            $build_pagination['pages'][$loop]['selected'] = 0;
                        }
                    }
                }
            }
        }

        // Render the "next" link
        if ($this->next_link !== FALSE AND $this->cur_page < $num_pages)
        {
            $build_pagination['link_next'] = site_url($this->basepath_link.'/'.($this->cur_page + 1)).$this->filter;
        }

        // Render the "Last" link
        if ($this->last_link !== FALSE AND ($this->cur_page + $this->num_links) < $num_pages)
        {
            $i = $num_pages;
        }

        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);

        //New        
        $build_pagination['evidence'] = 'Page '.$this->cur_page.' from '.$num_pages.'';

        return $build_pagination;
    }

}
// END Pagination Class

/* End of file Pagination.php */
/* Location: ./system/libraries/Pagination.php */