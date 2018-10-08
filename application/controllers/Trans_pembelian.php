<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_pembelian extends BaseController
{

    protected $module = "trans_pembelian";
    protected $title = "Data Transaksi Pembelian";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_trans_pembelian");
    }

    public function index()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title;
        $this->data['paging_param'] = $this->uri->segment(3);
        //$this->data['sidebar'] = 'collapsed';

        // Start of get data for filter        
        $this->data['data_status_transaksi'] = $this->m_global->get_enum_values("trans_pembelian", "status_transaksi");
        $this->data['data_supplier'] = $this->m_global->get_data_supplier();
        // End of get data for filter

        $this->data['data_status'] = $this->m_global->get_enum_values("trans_pembelian","status_transaksi");

        $this->datatrans_pembelian();

        $this->render("index");
    }

    function datatrans_pembelian()
    {
        $parameters = array();
        if ($this->input->get()) {

            if($this->input->get("periode", TRUE)) {
                $filter_periode = set_filter_periode($this->input->get("periode", TRUE));
                $parameters['periode'] = $filter_periode['periode'];
            }

            if($this->input->get("maximum", TRUE)){
                $parameters['maximum'] = clear_number_format($this->input->get("maximum", TRUE));
            }

            if($this->input->get("minimum", TRUE)){
                $parameters['minimum'] = clear_number_format($this->input->get("minimum", TRUE));
            }

            if($this->input->get("status_transaksi", TRUE)){
                $parameters['status_transaksi'] = $this->input->get("status_transaksi", TRUE);
            }

            if($this->input->get("supplier", TRUE)){
                $parameters['supplier'] = $this->input->get("supplier", TRUE);
            }

            if($this->input->get("orderby", TRUE)){
              $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
            }

            $this->data['filter'] = (object)$parameters;
        }

        // config paging
        $this->load->library('paging');
        $total_data = $this->m_trans_pembelian->get_data_trans_pembelian(true, null, null, $parameters);
        //$total_data = 1500;
        $url = site_url('trans_pembelian/index');
        $per_page = 30;
        $uri_segment = 3;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_trans_pembelian->get_data_trans_pembelian(null, $page, $per_page, $parameters);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);
    }
    public function create_edit($id = NULL)
    {
        $this->hasPermission('create','update');
        $this->data['halaman'] = (isset($id)) ? 'Edit '.$this->title : 'Tambah '.$this->title;
        $breadcrumb = array(
            array( 'page' => $this->title, 'link' => 'trans_pembelian' )
        );
        $this->data['breadcrumb'] = $breadcrumb;

        if($this->input->post("waktu_transaksi")){
            if(isset($id) && $id != null) {
                $status = $this->proses_insert_edit_trans_pembelian($id);
                $proses = 'diubah';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            } else {
                $status = $this->proses_insert_edit_trans_pembelian();
                $proses = 'ditambahkan';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            }
            if($is_success)
                $this->session->set_flashdata('msg',$this->title . " berhasil " . $proses . "!");
            else
                $this->session->set_flashdata('msgw', $this->title." gagal ".$proses."!");

            $url_param = $_SERVER['QUERY_STRING'];
            $paging = '';
            if($this->input->get("paging"))
                $paging = $this->input->get("paging", TRUE);
            redirect('trans_pembelian/index/'.$paging.'?'.$url_param);

        }
        else {

            $this->data['data_supplier'] = $this->m_global->get_data_supplier();
            $this->data['data_barang'] = $this->m_global->get_data_barang();
            if(isset($id) && $id != 'null') {
                $this->data['id_data'] = $id;
                $param = array();
                $param['id_trans'] = $id;
                $edit = $this->m_trans_pembelian->get_data_trans_pembelian(null, null, null, $param);
                if(!empty($edit)) {
                    $edit = $edit[0];
                    $waktu_transaksi = set_indo_datetime_format($edit->waktu_transaksi);
                    $edit->waktu_transaksi = $waktu_transaksi;
                    $this->data['list_barang'] = $this->m_trans_pembelian->get_data_trans_detail($edit->id_trans);
                    $this->data['edit'] = $edit;
                }
            }

            $this->render('create_edit');

        }
    }

    function proses_insert_edit_trans_pembelian($id = null)
    {
        // Declare table fields
        $array_fields = array('id_supplier','supplier_baru','waktu_transaksi','biaya_tambahan','keterangan','id_history','jumlah_pax');

        // Store input into variable
        foreach ($array_fields as $r){
            ${$r} = $this->input->post($r, TRUE);
            if(${$r} == "")
                ${$r} = NULL;
        }

        // Store input variables in array
        $parameters = array();
        foreach ($array_fields as $r){
            $parameters[$r] = ${$r};
        }
        $this->data['edit'] = $parameters;

        // Convert biaya_tambahan format from 123.234 to 123234
        if(!empty($biaya_tambahan)) {
            $parameters['biaya_tambahan'] = str_replace(',', '.', str_replace('.', '', $biaya_tambahan));
        } else
            $parameters['biaya_tambahan'] = 0;

        // Convert Waktu Transaksi FROM DD-MM-YYYY hh:mm yo YYYY-MM-DD
        $new_format = set_database_datetime_format($waktu_transaksi);
        $parameters['waktu_transaksi'] = $new_format;

        // Process Data
        if(isset($id) && $id != null) {
            // Update Data
            $result = $this->m_trans_pembelian->update_trans_pembelian($id, $parameters);
        }
        else {
            // Insert Data
            $result = $this->m_trans_pembelian->insert_trans_pembelian($parameters);
        }

        return $result;
    }

    function hapus($id_trans)
    {
        $this->hasPermission('delete');
        $parameters['is_active'] = '0';
        $result = $this->m_trans_pembelian->insert_trans_pembelian_history($id_trans, 'hapus');
        $result = $this->m_trans_pembelian->update_trans_pembelian($id_trans, $parameters);

        $activity = 'dihapus';
        if ($result) {
            $this->session->set_flashdata('msg', $this->title." berhasil ".$activity."!");
        } else {
            $this->session->set_flashdata('msgw', $this->title." gagal ".$activity."!");
        }
        redirect('trans_pembelian/index');
    }

    public function detail($id)
    {
        if($this->hasPermission('read')) {
            $this->SethasPermissionAct();
            $data = $this->data;
            $data['halaman'] = 'Detail ' . $this->title;

            $param = array();
            $param['id_trans'] = $id;
            $detail = $this->m_trans_pembelian->get_data_trans_pembelian(null, null, null, $param);
            if (!empty($detail)) {
                $data['detail'] = $detail = $detail[0];
                $data['list_barang'] = $this->m_trans_pembelian->get_data_trans_detail($detail->id_trans);
            }
            $this->load->view($this->module . '/detail', $data);
        }
    }

    public function detail_process($id)
    {
        if($this->hasPermission('read')) {
            $this->SethasPermissionAct();
            $data = $this->data;
            $data['halaman'] = 'Riwayat Proses ' . $this->title;

            $data['data_process'] = $this->m_trans_pembelian->get_data_trans_process($id);

            $this->load->view($this->module . '/detail_process', $data);
        }
    }

    function ubah_status()
    {
        $this->hasPermission('update');
        if($this->input->post()){
            $id_trans = $this->input->post('id_trans');
            $new = $this->input->post('status');

            $ex = explode('|', $id_trans);

            foreach($ex as $x){
                $status = $this->m_trans_pembelian->ubah_status_trans_pembelian($x, $new);
            }

            if ($status) {
                $this->session->set_flashdata('msg', 'Status '.$this->title." telah berhasil diubah!");
            } else {
                $this->session->set_flashdata('msgw', 'Status '.$this->title." gagal diubah! Silahkan coba beberapa saat lagi.");
            }
        }

        $url_param = $_SERVER['QUERY_STRING'];
        $paging = '';
        if($this->input->get("paging"))
            $paging = $this->input->get("paging", TRUE);
        redirect('trans_pembelian/index/'.$paging.'?'.$url_param);

    }
}