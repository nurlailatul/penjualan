<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_pembelian extends BaseController
{

    protected $module = "report_pembelian";
    protected $title = "Report Pembelian";
    protected $per_page = 30;
    protected $uri_segment = 3;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_report_pembelian");
        $this->load->library('paging');
    }
    
    public function index()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title.' Per Hari';
        //$this->data['sidebar'] = 'collapsed';

        // Start of get data for filter

        $this->data['data_supplier'] = $this->m_global->get_data_supplier();

        $parameters = array();
        $filter_periode = set_filter_periode($this->input->get("periode", TRUE));
        $parameters['periode'] = $filter_periode['periode'];
        if($filter_periode['status'] == false){
            $this->session->set_flashdata('msgw', "Periode yang Anda masukkan melebihi batas maksimal, Periode diubah menjadi 7 hari terakhir!");
        }
        if($this->input->get("orderby", TRUE)){
            $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
        }
        if($this->input->get("supplier", TRUE)){
            $parameters['supplier'] = $this->input->get("supplier", TRUE);
        }
        if($this->input->get("groupby", TRUE)){
            $groupby = $this->input->get("groupby", TRUE);

            if($groupby != 'tanpa')
                $this->data['groupby'] = $groupby;

            if($groupby == 'supplier'){
                if(!(isset($orderby) && $orderby == 'nama-desc')){
                    $orderby = 'nama-asc';
                }
            }
            elseif(isset($groupby) && $groupby == 'tanggal'){
                if(!(isset($orderby) && $orderby == 'tgl-asc')){
                    $orderby = 'tgl-desc';
                }
            }
            $parameters['orderby'] = $orderby;
        }
        if($this->input->get("minimum", TRUE)){
            $parameters['minimum'] = clear_number_format($this->input->get("minimum", TRUE));
        }
        if($this->input->get("maximum", TRUE)){
            $parameters['maximum'] = clear_number_format($this->input->get("maximum", TRUE));
        }
        if($this->input->get("min_laba", TRUE)){
            $parameters['min_laba'] = clear_number_format($this->input->get("min_laba", TRUE));
        }
        if($this->input->get("max_laba", TRUE)){
            $parameters['max_laba'] = clear_number_format($this->input->get("max_laba", TRUE));
        }

        $this->data['filter'] = (object)$parameters;
        // End of get data for filter

        // config paging
        $total_data = $this->m_report_pembelian->get_transaksi_per_hari_supplier(true, $parameters);
        //$total_data = 1500;
        $url = site_url('report_pembelian/index');
        $per_page = $this->per_page;
        $uri_segment = $this->uri_segment;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_report_pembelian->get_transaksi_per_hari_supplier(false, $parameters, $page, $per_page);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);

        if($page+1 == 1) {
            $this->data['page'] = $page + 1;
        } else {
            $a = $page/$per_page + 1;
            $this->data['page'] = $a;
        }

        $this->render("index");
    }
}