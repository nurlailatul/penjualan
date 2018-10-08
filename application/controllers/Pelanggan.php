<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends BaseController
{

    protected $module = "pelanggan";
    protected $title = "Data Pelanggan";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_pelanggan");
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

        $this->datapelanggan();

        $this->render("index");
    }

    function datapelanggan()
    {
        $parameters = array();

        if($this->input->get("nama", TRUE)){
            $parameters['nama'] = $this->input->get("nama", TRUE);
        }
        if($this->input->get()){
            $parameters['is_reseller'] = $this->input->get("is_reseller", TRUE);
        }
        if($this->input->get("is_reseller", TRUE) == 'all'){
            unset($parameters['is_reseller']);
        }

        if($this->input->get("orderby", TRUE)){
          $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
        }
        $this->data['filter'] = (object)$parameters;

        // config paging
        $this->load->library('paging');
        $total_data = $this->m_pelanggan->get_data_pelanggan(true, null, null, $parameters);
        //$total_data = 1500;
        $url = site_url('pelanggan/index');
        $per_page = 30;
        $uri_segment = 3;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_pelanggan->get_data_pelanggan(null, $page, $per_page, $parameters);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);
    }
    public function create_edit($id = NULL)
    {
        $this->hasPermission('create','update');
        $this->data['halaman'] = (isset($id)) ? 'Edit '.$this->title : 'Tambah '.$this->title;
        $breadcrumb = array(
            array( 'page' => $this->title, 'link' => 'pelanggan' )
        );
        $this->data['breadcrumb'] = $breadcrumb;

        if($this->input->post("nama")){
            if(isset($id) && $id != null) {
                $status = $this->proses_insert_edit_pelanggan($id);
                $proses = 'diubah';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            } else {
                $status = $this->proses_insert_edit_pelanggan();
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

            redirect('pelanggan/index');

        }
        else {

            $this->data['data_reseller'] = $this->m_global->get_data_reseller();
            if(isset($id) && $id != 'null') {
                $this->data['id_data'] = $id;
                $param = array();
                $param['id_pelanggan'] = $id;
                $edit = $this->m_pelanggan->get_data_pelanggan(null, null, null, $param);
                if(!empty($edit))
                    $this->data['edit'] = $edit[0];
            }

            $this->render('create_edit');

        }
    }

    function proses_insert_edit_pelanggan($id = null)
    {
        // Declare table fields
        $array_fields = array('nama','is_reseller','id_upline','alamat','no_telp','keterangan');

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

        // Unset Upline if value is 0
        if(isset($id_upline) && $id_upline == '0')
            $parameters['id_upline'] = NULL;

        // Process Data
        if(isset($id) && $id != null) {
            // Update Data
            $result = $this->m_pelanggan->update_pelanggan($id, $parameters);
        }
        else {
            // Insert Data
            $result = $this->m_pelanggan->insert_pelanggan($parameters);
        }

        return $result;
    }

    function hapus($id_pelanggan)
    {
        $this->hasPermission('delete');
        $parameters['is_active'] = '0';
        $result = $this->m_pelanggan->update_pelanggan($id_pelanggan, $parameters);

        $activity = 'dihapus';
        if ($result) {
            $this->session->set_flashdata('msg', $this->title." berhasil ".$activity."!");
        } else {
            $this->session->set_flashdata('msgw', $this->title." gagal ".$activity."!");
        }
        redirect('pelanggan/index');
    }

    public function detail($id)
    {
        if($this->hasPermission('read')) {
            $this->SethasPermissionAct();
            $data = $this->data;
            $data['halaman'] = 'Detail ' . $this->title;

            $param = array();
            $param['id_pelanggan'] = $id;
            $detail = $this->m_pelanggan->get_data_pelanggan(null, null, null, $param);
            if (!empty($detail))
                $data['detail'] = $detail[0];
            $this->load->view($this->module . '/detail', $data);
        }
    }
}