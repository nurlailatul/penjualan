<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_penjualan extends BaseController
{

    protected $module = "report_penjualan";
    protected $title = "Report Penjualan";
    protected $per_page = 30;
    protected $uri_segment = 3;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_report_penjualan");
        $this->load->library('paging');
    }

    public function get_last_date()
    {
      $sql = $this->db->query("SELECT DATE(MAX(waktu_transaksi)) tgl FROM trans_penjualan");
      return $sql->row()->tgl;
    }

    public function index()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title;
        //$this->data['sidebar'] = 'collapsed';

        // Start of get data for filter

        $parameters = array();
        $filter_periode = set_filter_periode($this->input->get("periode", TRUE));
        $parameters['periode'] = $filter_periode['periode'];
        if($filter_periode['status'] == false){
            $this->session->set_flashdata('msgw', "Periode yang Anda masukkan melebihi batas maksimal, Periode diubah menjadi 7 hari terakhir!");
        }
        if($this->input->get("orderby", TRUE)){
            $parameters['orderby'] = $this->input->get("orderby", TRUE);
        }
        if($this->input->get("minimum", TRUE)){
            $parameters['minimum'] = clear_number_format($this->input->get("minimum", TRUE));
        }
        if($this->input->get("maximum", TRUE)){
            $parameters['maximum'] = clear_number_format($this->input->get("maximum", TRUE));
        }

        $this->data['filter'] = (object)$parameters;

        // End of get data for filter

        // config paging
        $total_data = $this->m_report_penjualan->get_transaksi_per_hari(true, $parameters);
        //$total_data = 1500;
        $url = site_url('report_penjualan/index');
        $per_page = $this->per_page;
        $uri_segment = $this->uri_segment;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_report_penjualan->get_transaksi_per_hari(false, $parameters, $page, $per_page);
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

    public function by_hari_reseller()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title.' Berdasarkan Pelanggan Per Hari';
        //$this->data['sidebar'] = 'collapsed';

        // Start of get data for filter

        $this->data['data_reseller'] = $this->m_global->get_data_reseller();

        $parameters = array();
        $filter_periode = set_filter_periode($this->input->get("periode", TRUE));
        $parameters['periode'] = $filter_periode['periode'];
        if($filter_periode['status'] == false){
            $this->session->set_flashdata('msgw', "Periode yang Anda masukkan melebihi batas maksimal, Periode diubah menjadi 7 hari terakhir!");
        }
        if($this->input->get("orderby", TRUE)){
            $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
        }
        if($this->input->get("reseller", TRUE)){
            $parameters['reseller'] = $this->input->get("reseller", TRUE);
        }
        if($this->input->get("groupby", TRUE)){
            $groupby = $this->input->get("groupby", TRUE);

            if($groupby != 'tanpa')
                $this->data['groupby'] = $groupby;

            if($groupby == 'reseller'){
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

        if($this->input->get()) {
            $is_reseller = $this->input->get("is_reseller", TRUE);

            if ($is_reseller != 'all'){
                $this->data['is_reseller'] = $is_reseller;
                $parameters['is_reseller'] = $is_reseller;
            }
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
        $total_data = $this->m_report_penjualan->get_transaksi_per_hari_reseller(true, $parameters);
        //$total_data = 1500;
        $url = site_url('report_penjualan/by_hari_reseller');
        $per_page = $this->per_page;
        $uri_segment = $this->uri_segment;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_report_penjualan->get_transaksi_per_hari_reseller(false, $parameters, $page, $per_page);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);

        if($page+1 == 1) {
            $this->data['page'] = $page + 1;
        } else {
            $a = $page/$per_page + 1;
            $this->data['page'] = $a;
        }

        $this->render("by_hari_reseller");
    }

    public function by_reseller()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title.' Berdasarkan Pelanggan';
        //$this->data['sidebar'] = 'collapsed';

        // Start of get data for filter

        $this->data['data_reseller'] = $this->m_global->get_data_reseller();

        $parameters = array();
        $filter_periode = set_filter_periode($this->input->get("periode", TRUE));
        $parameters['periode'] = $filter_periode['periode'];
        if($filter_periode['status'] == false){
            $this->session->set_flashdata('msgw', "Periode yang Anda masukkan melebihi batas maksimal, Periode diubah menjadi 7 hari terakhir!");
        }
        if($this->input->get("orderby", TRUE)){
            $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
        }
        if($this->input->get("reseller", TRUE)){
            $parameters['reseller'] = $this->input->get("reseller", TRUE);
        }
        if($this->input->get("groupby", TRUE)){
            $groupby = $this->input->get("groupby", TRUE);

            if($groupby != 'tanpa')
                $this->data['groupby'] = $groupby;

            if($groupby == 'reseller'){
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

        if($this->input->get()) {
            $is_reseller = $this->input->get("is_reseller", TRUE);

            if ($is_reseller != 'all'){
                $this->data['is_reseller'] = $is_reseller;
                $parameters['is_reseller'] = $is_reseller;
            }
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
        $total_data = $this->m_report_penjualan->get_transaksi_per_reseller(true, $parameters);
        //$total_data = 1500;
        $url = site_url('report_penjualan/by_reseller');
        $per_page = $this->per_page;
        $uri_segment = $this->uri_segment;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_report_penjualan->get_transaksi_per_reseller(false, $parameters, $page, $per_page);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);

        if($page+1 == 1) {
            $this->data['page'] = $page + 1;
        } else {
            $a = $page/$per_page + 1;
            $this->data['page'] = $a;
        }

        $this->render("by_reseller");
    }

    public function by_hari_pelanggan()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title.' Berdasarkan Pelanggan Per Hari';
        //$this->data['sidebar'] = 'collapsed';

        // Start of get data for filter

        $this->data['data_pelanggan'] = $this->m_global->get_data_pelanggan();

        $parameters = array();
        $filter_periode = set_filter_periode($this->input->get("periode", TRUE));
        $parameters['periode'] = $filter_periode['periode'];
        if($filter_periode['status'] == false){
            $this->session->set_flashdata('msgw', "Periode yang Anda masukkan melebihi batas maksimal, Periode diubah menjadi 7 hari terakhir!");
        }
        if($this->input->get("orderby", TRUE)){
            $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
        }
        if($this->input->get("pelanggan", TRUE)){
            $parameters['pelanggan'] = $this->input->get("pelanggan", TRUE);
        }
        if($this->input->get("groupby", TRUE)){
            $groupby = $this->input->get("groupby", TRUE);

            if($groupby != 'tanpa')
                $this->data['groupby'] = $groupby;

            if($groupby == 'pelanggan'){
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

        $this->data['filter'] = (object)$parameters;
        // End of get data for filter

        // config paging
        $total_data = $this->m_report_penjualan->get_transaksi_per_hari_pelanggan(true, $parameters);
        //$total_data = 1500;
        $url = site_url('report_penjualan/by_hari_pelanggan');
        $per_page = $this->per_page;
        $uri_segment = $this->uri_segment;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_report_penjualan->get_transaksi_per_hari_pelanggan(false, $parameters, $page, $per_page);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);

        if($page+1 == 1) {
            $this->data['page'] = $page + 1;
        } else {
            $a = $page/$per_page + 1;
            $this->data['page'] = $a;
        }

        $this->render("by_hari_pelanggan");
    }

    public function by_pelanggan()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title.' Berdasarkan Pelanggan';
        //$this->data['sidebar'] = 'collapsed';

        // Start of get data for filter

        $this->data['data_pelanggan'] = $this->m_global->get_data_pelanggan();

        $parameters = array();
        $filter_periode = set_filter_periode($this->input->get("periode", TRUE));
        $parameters['periode'] = $filter_periode['periode'];
        if($filter_periode['status'] == false){
            $this->session->set_flashdata('msgw', "Periode yang Anda masukkan melebihi batas maksimal, Periode diubah menjadi 7 hari terakhir!");
        }
        if($this->input->get("orderby", TRUE)){
            $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
        }
        if($this->input->get("pelanggan", TRUE)){
            $parameters['pelanggan'] = $this->input->get("pelanggan", TRUE);
        }
        if($this->input->get("groupby", TRUE)){
            $groupby = $this->input->get("groupby", TRUE);

            if($groupby != 'tanpa')
                $this->data['groupby'] = $groupby;

            if($groupby == 'pelanggan'){
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

        $this->data['filter'] = (object)$parameters;
        // End of get data for filter

        // config paging
        $total_data = $this->m_report_penjualan->get_transaksi_per_pelanggan(true, $parameters);
        //$total_data = 1500;
        $url = site_url('report_penjualan/by_pelanggan');
        $per_page = $this->per_page;
        $uri_segment = $this->uri_segment;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_report_penjualan->get_transaksi_per_pelanggan(false, $parameters, $page, $per_page);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);

        if($page+1 == 1) {
            $this->data['page'] = $page + 1;
        } else {
            $a = $page/$per_page + 1;
            $this->data['page'] = $a;
        }

        $this->render("by_pelanggan");
    }
/*
    function edit_laba_reseller(){
        $this->db->trans_begin();
        $results = $this->db->query("SELECT d.*, t.jenis_transaksi FROM trans_penjualan_detail d JOIN trans_penjualan t on d.id_trans = t.id_trans");
        foreach ($results->result() as $r){

            $barang = $this->db->query("SELECT harga_beli, harga_reseller, harga_umum FROM barang WHERE id_barang = ?", $r->id_barang)->row();
            if($r->jenis_transaksi == 'RESELLER')
                $harga_satuan = $barang->harga_reseller;
            else
                $harga_satuan = $barang->harga_umum;

            $harga_beli = $barang->harga_beli;
            $laba = $harga_satuan - $harga_beli;

            $param = array();
            $param[] = $laba;
            $param[] = $r->id_trans;
            $param[] = $r->id_barang;
            $sql = $this->db->query("UPDATE trans_penjualan_detail SET laba_reseller = ? WHERE id_trans = ? AND id_barang = ?", $param);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'FAILED';
        } else {
            $this->db->trans_commit();
            echo 'SUCCESS';
        }
    }*/
}