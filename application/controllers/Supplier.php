<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends BaseController
{

    protected $module = "supplier";
    protected $title = "Data Supplier";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_supplier");
    }

    public function index()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title;
        //$this->data['sidebar'] = 'collapsed';

        // Start of get data for filter

        $tanggal_to = date('d-m-Y', strtotime('+30 days'));
        $tanggal_from = date("d-m-Y");
        $this->data['periode'] = $tanggal_from . ' - ' . $tanggal_to;
        // End of get data for filter

        $this->datasupplier();

        $this->render("index");
    }

    function datasupplier()
    {
        $parameters = array();
        $array_fields_filter = array('kode','nama');
        
        if ($this->input->get()) {

            foreach ($array_fields_filter as $r) {
                if ($this->input->get('f_'.$r, TRUE) && !empty($this->input->get('f_'.$r, TRUE))) {
                    ${$r} = $this->input->get('f_'.$r, TRUE);
                }
            }

            foreach ($array_fields_filter as $r) {
                if (isset(${$r})) {
                    $parameters[$r] = ${$r};
                }
            }

            $this->data['filter'] = (object)$parameters;
        }

        $param = array();
        $param['fields'] = $array_fields_filter;
        $param['filter'] = $parameters;

        // config paging
        $this->load->library('paging');
        $total_data = $this->m_supplier->get_data_supplier(true, null, null, $param);
        //$total_data = 1500;
        $url = site_url('supplier/index');
        $per_page = 30;
        $uri_segment = 3;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_supplier->get_data_supplier(null, $page, $per_page, $param);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);
    }
    public function create_edit($id = NULL)
    {
        $this->hasPermission('create','update');
        $this->data['halaman'] = (isset($id)) ? 'Edit '.$this->title : 'Tambah '.$this->title;
        $breadcrumb = array(
            array( 'page' => $this->title, 'link' => 'supplier' )
        );
        $this->data['breadcrumb'] = $breadcrumb;

        if($this->input->post("nama")){
            if(isset($id) && $id != null) {
                $status = $this->proses_insert_edit_supplier($id);
                $proses = 'diubah';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            } else {
                $status = $this->proses_insert_edit_supplier();
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

            redirect('supplier/index');

        }
        else {

            if(isset($id) && $id != 'null') {
                $this->data['id_data'] = $id;
                $param = array();
                $param['id_supplier'] = $id;
                $edit = $this->m_supplier->get_data_supplier(null, null, null, $param);
                if(!empty($edit))
                    $this->data['edit'] = $edit[0];
            }

            $this->render('create_edit');

        }
    }

    function proses_insert_edit_supplier($id = null)
    {
        // Declare table fields
        $array_fields = array('nama','alamat','no_telp','keterangan');

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

        // Process Data
        if(isset($id) && $id != null) {
            // Update Data
            $result = $this->m_supplier->update_supplier($id, $parameters);
        }
        else {
            // Insert Data
            $result = $this->m_supplier->insert_supplier($parameters);
        }

        return $result;
    }

    function hapus($id_supplier)
    {
        $this->hasPermission('delete');
        $parameters['is_active'] = '0';
        $result = $this->m_supplier->update_supplier($id_supplier, $parameters);

        $activity = 'dihapus';
        if ($result) {
            $this->session->set_flashdata('msg', $this->title." berhasil ".$activity."!");
        } else {
            $this->session->set_flashdata('msgw', $this->title." gagal ".$activity."!");
        }
        redirect('supplier/index');
    }

    public function detail($id)
    {
        if($this->hasPermission('read')) {
            $this->SethasPermissionAct();
            $data = $this->data;
            $data['halaman'] = 'Detail ' . $this->title;

            $param = array();
            $param['id_supplier'] = $id;
            $detail = $this->m_supplier->get_data_supplier(null, null, null, $param);
            if (!empty($detail))
                $data['detail'] = $detail[0];
            $this->load->view($this->module . '/detail', $data);
        }
    }
}