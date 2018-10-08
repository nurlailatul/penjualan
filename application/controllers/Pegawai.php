<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends BaseController
{

    protected $module = "pegawai";
    protected $title = "Data Pegawai";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_pegawai");
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

        $this->datapegawai();

        $this->render("index");
    }

    function datapegawai()
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
        $total_data = $this->m_pegawai->get_data_pegawai(true, null, null, $param);
        //$total_data = 1500;
        $url = site_url('pegawai/index');
        $per_page = 30;
        $uri_segment = 3;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_pegawai->get_data_pegawai(null, $page, $per_page, $param);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);
    }
    public function create_edit($id = NULL)
    {
        $this->hasPermission('create','update');
        $this->data['halaman'] = (isset($id)) ? 'Edit '.$this->title : 'Tambah '.$this->title;
        $breadcrumb = array(
            array( 'page' => $this->title, 'link' => 'pegawai' )
        );
        $this->data['breadcrumb'] = $breadcrumb;

        if($this->input->post("nama")){
            if(isset($id) && $id != null) {
                $status = $this->proses_insert_edit_pegawai($id);
                $proses = 'diubah';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            } else {
                $status = $this->proses_insert_edit_pegawai();
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

            redirect('pegawai/index');

        }
        else {

            $this->data['data_jabatan'] = $this->m_global->get_enum_values("pegawai", "jabatan");
            if(isset($id) && $id != 'null') {
                $this->data['id_data'] = $id;
                $param = array();
                $param['id_pegawai'] = $id;
                $edit = $this->m_pegawai->get_data_pegawai(null, null, null, $param);
                if(!empty($edit))
                    $this->data['edit'] = $edit[0];
            }

            $this->render('create_edit');

        }
    }

    function proses_insert_edit_pegawai($id = null)
    {
        // Declare table fields
        $array_fields = array('nama','jabatan','alamat','no_telp','keterangan');

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
            $result = $this->m_pegawai->update_pegawai($id, $parameters);
        }
        else {
            // Insert Data
            $result = $this->m_pegawai->insert_pegawai($parameters);
        }

        return $result;
    }

    function hapus($id_pegawai)
    {
        $this->hasPermission('delete');
        $parameters['is_active'] = '0';
        $result = $this->m_pegawai->update_pegawai($id_pegawai, $parameters);

        $activity = 'dihapus';
        if ($result) {
            $this->session->set_flashdata('msg', $this->title." berhasil ".$activity."!");
        } else {
            $this->session->set_flashdata('msgw', $this->title." gagal ".$activity."!");
        }
        redirect('pegawai/index');
    }

    public function detail($id)
    {
        if($this->hasPermission('read')) {
            $this->SethasPermissionAct();
            $data = $this->data;
            $data['halaman'] = 'Detail ' . $this->title;

            $param = array();
            $param['id_pegawai'] = $id;
            $detail = $this->m_pegawai->get_data_pegawai(null, null, null, $param);
            if (!empty($detail))
                $data['detail'] = $detail[0];
            $this->load->view($this->module . '/detail', $data);
        }
    }
}