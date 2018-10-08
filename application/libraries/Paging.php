<?php
/*
 * Robby Adnan F.
 */
class paging
{
    protected $CI;
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('pagination');
    }

    public function set_paging($url, $total, $per_page, $uri_segment){
        $settings = $this->CI->config->item('pagination');
        $settings["base_url"] = $url;
        $settings['total_rows'] = $total;
        $settings['per_page'] = $per_page;
        $settings['reuse_query_string'] = FALSE;
        if (count($_GET) > 0)
            $settings['suffix'] = '?' . http_build_query($_GET, '', "&");

        $settings['first_url'] = $settings['base_url'] . '?' . http_build_query($_GET);
        $settings['uri_segment'] = $uri_segment;
        $this->CI->pagination->initialize($settings);
        return $this->CI->pagination->create_links();
    }
    
    public function set_paging2($url, $total, $per_page, $uri_segment){
        $settings = $this->CI->config->item('pagination');
        $settings["base_url"] = $url;
        $settings['total_rows'] = $total;
        $settings['per_page'] = $per_page;
        $settings['reuse_query_string'] = FALSE;
        if (count($_GET) > 0)
            $settings['suffix'] = '?' . http_build_query($_GET, '', "&");

        $settings['first_url'] = $settings['base_url'] . '?' . http_build_query($_GET);
        $settings['uri_segment'] = $uri_segment;

        $settings['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $settings['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $settings['next_link'] = '<i class="fa fa-angle-right"></i>';
        $settings['prev_link'] = '<i class="fa fa-angle-left"></i>';
        $settings['num_tag_open'] = "<li class='btn-paging'>";
        $settings['num_tag_close'] = ' </li>';
        $settings['next_tag_open'] = "<li class='btn-paging'>";
        $settings['prev_tag_close'] = ' </li>';
        $settings['prev_tag_open'] = "<li class='btn-paging'>";
        $settings['first_tag_open'] = "<li class='btn-paging'>";
        $settings['first_tag_close'] = ' </li>';
        $settings['last_tag_open'] = "<li class='btn-paging'>";
        $settings['last_tag_close'] = ' </li>';
        $settings['next_tag_close'] = ' </li>';
        $settings['cur_tag_open'] = "<li class='active btn-paging'><a>";
        $settings['cur_tag_close'] = ' </a></li>';

        $this->CI->pagination->initialize($settings);
        return $this->CI->pagination->create_links();
    }
}