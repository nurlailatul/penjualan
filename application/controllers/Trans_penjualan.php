<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_penjualan extends BaseController
{

    protected $module = "trans_penjualan";
    protected $title = "Data Transaksi Penjualan";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_trans_penjualan");
    }

    public function index()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title;
        $this->data['paging_param'] = $this->uri->segment(3);
        //$this->data['sidebar'] = 'collapsed';

        $this->data['data_status_transaksi'] = $this->m_global->get_enum_values("trans_penjualan", "status_transaksi");
        $this->data['data_status_pembayaran'] = $this->m_global->get_enum_values("trans_penjualan","status_pembayaran");
        $this->data['data_status_pengiriman'] = $this->m_global->get_enum_values("trans_penjualan","status_pengiriman");
        $this->data['data_reseller'] = $this->m_global->get_data_reseller();
        $this->data['data_pelanggan'] = $this->m_global->get_data_pelanggan();
        $this->data['data_kurir'] = $this->m_global->get_data_kurir();

        $this->datatrans_penjualan();

        $this->render("index");
    }

    function datatrans_penjualan()
    {
        $parameters = array();

        if ($this->input->get()) {

            if($this->input->get("periode", TRUE)) {
                $filter_periode = set_filter_periode($this->input->get("periode", TRUE));
                $parameters['periode'] = $filter_periode['periode'];
            }

            if($this->input->get("jenis_transaksi", TRUE)){
                if($this->input->get("jenis_transaksi", TRUE) != 'all') {
                    $parameters['jenis_transaksi'] = $this->input->get("jenis_transaksi", TRUE);
                }
            }

            if($this->input->get("reseller", TRUE)){
                $parameters['reseller'] = $this->input->get("reseller", TRUE);
            }

            if($this->input->get("pelanggan", TRUE)){
                $parameters['pelanggan'] = $this->input->get("pelanggan", TRUE);
            }

            if($this->input->get("kurir", TRUE)){
                $parameters['kurir'] = $this->input->get("kurir", TRUE);
            }

            if($this->input->get("maximum", TRUE)){
                $parameters['maximum'] = clear_number_format($this->input->get("maximum", TRUE));
            }

            if($this->input->get("minimum", TRUE)){
                $parameters['minimum'] = clear_number_format($this->input->get("minimum", TRUE));
            }

            if($this->input->get("status_pengiriman", TRUE)){
                $parameters['status_pengiriman'] = $this->input->get("status_pengiriman", TRUE);
            }

            if($this->input->get("status_pembayaran", TRUE)){
                $parameters['status_pembayaran'] = $this->input->get("status_pembayaran", TRUE);
            }

            if($this->input->get("status_transaksi", TRUE)){
                $parameters['status_transaksi'] = $this->input->get("status_transaksi", TRUE);
            }

            if($this->input->get("orderby", TRUE)){
              $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
            }

            $this->data['filter'] = (object)$parameters;
        }

        // config paging
        $this->load->library('paging');
        $total_data = $this->m_trans_penjualan->get_data_trans_penjualan(true, null, null, $parameters);
        //$total_data = 1500;
        $url = site_url('trans_penjualan/index');
        $per_page = 30;
        $uri_segment = 3;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_trans_penjualan->get_data_trans_penjualan(null, $page, $per_page, $parameters);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);
    }

    public function create_edit($id = NULL)
    {
        $this->hasPermission('create','update');
        $this->data['halaman'] = (isset($id)) ? 'Edit '.$this->title : 'Tambah '.$this->title;
        $breadcrumb = array(
            array( 'page' => $this->title, 'link' => 'trans_penjualan' )
        );
        $this->data['breadcrumb'] = $breadcrumb;

        if($this->input->post("waktu_transaksi")){
            if(isset($id) && $id != null) {
                $status = $this->proses_insert_edit_trans_penjualan($id);
                $proses = 'diubah';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            } else {
                $status = $this->proses_insert_edit_trans_penjualan();
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

            if($this->input->post("btn_submit") == 'save_print')
              $url_param .= '&cetak='.$status;

            redirect('trans_penjualan/index/'.$paging.'?'.$url_param);

        }
        else {

            $this->data['data_status_transaksi'] = $this->m_global->get_enum_values("trans_penjualan", "status_transaksi");
            $this->data['data_status_pembayaran'] = $this->m_global->get_enum_values("trans_penjualan","status_pembayaran");
            $this->data['data_status_pengiriman'] = $this->m_global->get_enum_values("trans_penjualan","status_pengiriman");
            $this->data['jenis_ekspedisi'] = $this->m_trans_penjualan->get_data_jenis_ekspedisi();

            $this->data['metode_pembayaran'] = $this->m_global->get_enum_values("pembayaran_trans_penjualan","metode_pembayaran");
            $this->data['jenis_transaksi'] = $this->m_global->get_enum_values("trans_penjualan","jenis_transaksi");
            $this->data['data_reseller'] = $this->m_global->get_data_reseller();
            $this->data['data_pelanggan'] = $this->m_global->get_data_pelanggan();
            $this->data['data_barang'] = $this->m_global->get_data_barang();
            if(isset($id) && $id != 'null') {
                // CHECK IS FINISHED
                //$check = $this->m_trans_penjualan->check_trans_is_finished($id);
                $check = TRUE;
                if(!$check) {
                  $url_param = $_SERVER['QUERY_STRING'];
                  $paging = '';
                  if($this->input->get("paging"))
                    $paging = $this->input->get("paging", TRUE);
                  redirect('trans_penjualan/index/'.$paging.'?'.$url_param);
                }

                $this->data['id_data'] = $id;
                $param = array();
                $param['id_trans'] = $id;
                $edit = $this->m_trans_penjualan->get_data_trans_penjualan(null, null, null, $param);
                if(!empty($edit)) {
                    $edit = $edit[0];
                    $waktu_transaksi = set_indo_datetime_format($edit->waktu_transaksi);
                    $edit->waktu_transaksi = $waktu_transaksi;
                    $this->data['list_barang'] = $this->m_trans_penjualan->get_data_trans_detail($edit->id_trans);
                    $this->data['edit'] = $edit;

                    $this->data['pengiriman'] = $this->m_trans_penjualan->get_data_pengiriman_trans_penjualan($id);
                    $this->data['pembayaran'] = $this->m_trans_penjualan->get_data_pembayaran_trans_penjualan($id)[0];
                }
            }

            $this->render('create_edit');

        }
    }

    public function create_edit_pengiriman($id_trans, $id_pengiriman = null)
    {
        $this->hasPermission('create','update');
        $this->data['halaman'] = (isset($id_pengiriman)) ? 'Edit Pengiriman '.$this->title : 'Tambah Pengiriman '.$this->title;
        $breadcrumb = array(
            array( 'page' => $this->title, 'link' => 'trans_penjualan' )
        );
        $this->data['breadcrumb'] = $breadcrumb;

        if($this->input->post("jenis_ekspedisi")){
            if(isset($id_pengiriman) && $id_pengiriman != null) {
                $status = $this->proses_insert_edit_pengiriman_trans_penjualan($id_trans, $id_pengiriman);
                $proses = 'diubah';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            } else {
                $status = $this->proses_insert_edit_pengiriman_trans_penjualan($id_trans);
                $proses = 'ditambahkan';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            }
            if($is_success)
                $this->session->set_flashdata('msg', 'Data Pengiriman '.$this->title . " berhasil " . $proses . "!");
            else
                $this->session->set_flashdata('msgw', 'Data Pengiriman '.$this->title." gagal ".$proses."!");

            $url_param = $_SERVER['QUERY_STRING'];
            $paging = '';
            if($this->input->get("paging"))
                $paging = $this->input->get("paging", TRUE);
            redirect('trans_penjualan/index/'.$paging.'?'.$url_param);

        }
        else {

            $this->data['id_trans'] = $id_trans;
            $this->data['jenis_ekspedisi'] = $this->m_trans_penjualan->get_data_jenis_ekspedisi();
            $this->data['data_pegawai'] = $this->m_global->get_data_pegawai();

            $param = array();
            $param['id_trans'] = $id_trans;
            $detail = $this->m_trans_penjualan->get_data_trans_penjualan(null, null, null, $param);
            if (!empty($detail)) {
                $this->data['detail'] = $detail = $detail[0];
                if($detail->status_transaksi == 'SELESAI')
                    $this->data['is_selesai'] = true;
            }

            if(isset($id_pengiriman) && $id_pengiriman != 'null') {
                $this->data['id_pengiriman'] = $id_pengiriman;
                $param = array();
                $param['id_pengiriman'] = $id_pengiriman;
                $edit = $this->m_trans_penjualan->get_data_pengiriman_trans_penjualan(null, $id_pengiriman);
                if(!empty($edit)) {
                    $edit = $edit;
                    if($detail->status_transaksi != 'SELESAI') {
                        $waktu_pengiriman = set_indo_datetime_format($edit->waktu_pengiriman);
                        $edit->waktu_pengiriman = $waktu_pengiriman;
                        if ($edit->waktu_sampai != NULL) {
                            $waktu_sampai = set_indo_datetime_format($edit->waktu_sampai);
                            $edit->waktu_sampai = $waktu_sampai;
                        }
                    }
                    $this->data['edit'] = $edit;
                }
            }

            $this->render('create_edit_pengiriman');

        }
    }

    public function create_edit_pembayaran($id_trans, $id_pembayaran = null)
    {
        $this->hasPermission('create','update');
        $this->data['halaman'] = 'Data Pembayaran '.$this->title;
        $breadcrumb = array(
            array( 'page' => $this->title, 'link' => 'trans_penjualan' )
        );
        $this->data['breadcrumb'] = $breadcrumb;

        if($this->input->post("waktu_pembayaran")){
            if(isset($id_pembayaran) && $id_pembayaran != null) {
                $status = $this->proses_insert_edit_pembayaran_trans_penjualan($id_pembayaran);
                $proses = 'diubah';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            } else {
                $status = $this->proses_insert_edit_pembayaran_trans_penjualan();
                $proses = 'ditambahkan';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            }
            if($is_success)
                $this->session->set_flashdata('msg', 'Data pembayaran transaksi penjualan berhasil ' . $proses . "!");
            else
                $this->session->set_flashdata('msgw', 'Data pembayaran transaksi penjualan gagal '.$proses."!");

            redirect('trans_penjualan/create_edit_pembayaran/'.$id_trans);

        }
        else {

            $this->data['id_trans'] = $id_trans;
            $this->data['metode_pembayaran'] = $this->m_global->get_enum_values("pembayaran_trans_penjualan","metode_pembayaran");

            $param = array();
            $param['id_trans'] = $id_trans;
            $detail = $this->m_trans_penjualan->get_data_trans_penjualan(null, null, null, $param);
            if (!empty($detail)) {
                $this->data['detail'] = $detail = $detail[0];
            }

            $this->data['data_pembayaran'] = $this->m_trans_penjualan->get_data_pembayaran_trans_penjualan($id_trans);

            if(isset($id_pembayaran) && $id_pembayaran != 'null') {
                $this->data['id_pembayaran'] = $id_pembayaran;
                $param = array();
                $param['id_pembayaran'] = $id_pembayaran;
                $edit = $this->m_trans_penjualan->get_data_pembayaran_trans_penjualan(null, $id_pembayaran);
                if(!empty($edit)) {
                    $edit = $edit[0];
                    $waktu_pembayaran = set_indo_datetime_format($edit->waktu_pembayaran);
                    $edit->waktu_pembayaran = $waktu_pembayaran;
                    $this->data['edit'] = $edit;
                }
            }

            $this->render('create_edit_pembayaran');

        }
    }

    function proses_insert_edit_trans_penjualan($id = null)
    {
        // Declare table fields
        $array_fields = array('jenis_transaksi','id_reseller','id_pelanggan','pelanggan_baru','waktu_transaksi','diskon','biaya_tambahan','biaya_pembatalan','keterangan','id_history','jumlah_pax');

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
        if(!empty($diskon)) {
            $parameters['diskon'] = str_replace(',', '.', str_replace('.', '', $diskon));
        } else
            $parameters['diskon'] = 0;
        if(!empty($biaya_pembatalan)) {
            $parameters['biaya_pembatalan'] = str_replace(',', '.', str_replace('.', '', $biaya_pembatalan));
        } else
            $parameters['biaya_pembatalan'] = 0;

        // Convert Waktu Transaksi FROM DD-MM-YYYY hh:mm yo YYYY-MM-DD
        $new_format = set_database_datetime_format($waktu_transaksi);
        $parameters['waktu_transaksi'] = $new_format;

        // Process Data
        if(isset($id) && $id != null) {
            unset($parameters['jenis_transaksi']);
            // Update Data
            $result = $this->m_trans_penjualan->update_trans_penjualan($id, $parameters);

            if($result){
              $id_pengiriman = $this->input->post("id_pengiriman", TRUE);
              $id_pembayaran = $this->input->post("id_pembayaran", TRUE);
              $result1 = $this->proses_insert_edit_pengiriman_trans_penjualan($id, $id_pengiriman);
              $result2 = $this->proses_insert_edit_pembayaran_trans_penjualan($id_pembayaran, $id);

              if(!$result1 || $result2)
                return FALSE;
            }
            else
              return FALSE;
        }
        else {
            // Insert Data
            $result = $this->m_trans_penjualan->insert_trans_penjualan($parameters);

            if($result){
              echo $result;
              $result1 = $this->proses_insert_edit_pengiriman_trans_penjualan($result);
              $result2 = $this->proses_insert_edit_pembayaran_trans_penjualan(NULL, $result);

              if(!$result1 || !$result2)
                return FALSE;
            }
            else
              return FALSE;
        }

        return $result;
    }

    function proses_insert_edit_pengiriman_trans_penjualan($id_trans, $id_pengiriman = null)
    {
        // Declare table fields
        $array_fields = array('waktu_pengiriman','jenis_ekspedisi','id_kurir','no_resi','biaya_pengiriman','catatan','waktu_sampai');
        if(!isset($id_trans))
          $array_fields[] = 'id_trans';

        // Store input into variable
        foreach ($array_fields as $r){
            ${$r} = $this->input->post($r, TRUE);
            if(${$r} == "")
                ${$r} = NULL;
        }

        // Store input variables in array
        $parameters = array();
        $parameters['id_trans'] = $id_trans;
        foreach ($array_fields as $r){
            $parameters[$r] = ${$r};
        }
        $this->data['edit'] = $parameters;

        // Convert biaya_pengiriman format from 123.234 to 123234
        if(!empty($biaya_pengiriman)) {
            $parameters['biaya_pengiriman'] = str_replace(',', '.', str_replace('.', '', $biaya_pengiriman));
        } else
            $parameters['biaya_pengiriman'] = 0;

        // Convert Waktu Pengiriman FROM DD-MM-YYYY hh:mm yo YYYY-MM-DD
        $new_format = set_database_datetime_format($waktu_pengiriman);
        $parameters['waktu_pengiriman'] = $new_format;
        if(!empty($waktu_sampai)){
            $new_format = set_database_datetime_format($waktu_sampai);
            $parameters['waktu_sampai'] = $new_format;
        }


        echo $id_trans;
        print_r($parameters);
        // Process Data
        if(isset($id_pengiriman) && $id_pengiriman != null) {
            // Update Data
            $result = $this->m_trans_penjualan->update_pengiriman_trans_penjualan($id_trans, $id_pengiriman, $parameters);
        }
        else {
            // Insert Data
            $result = $this->m_trans_penjualan->insert_pengiriman_trans_penjualan($id_trans, $parameters);
        }

        return $result;
    }

    function proses_insert_edit_pembayaran_trans_penjualan($id_pembayaran = null, $id_trans = null)
    {
        // Declare table fields
        $array_fields = array('waktu_pembayaran','metode_pembayaran','nominal','catatan');
        if(!isset($id_trans))
          $array_fields[] = 'id_trans';

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

        if(isset($id_trans)){
          $parameters['id_trans'] = $id_trans;
        }
        $this->data['edit'] = $parameters;

        // Convert biaya_pembayaran format from 123.234 to 123234
        if(!empty($nominal)) {
            $parameters['nominal'] = str_replace(',', '.', str_replace('.', '', $nominal));
        }

        // Convert Waktu Pembayaran FROM DD-MM-YYYY hh:mm yo YYYY-MM-DD
        $new_format = set_database_datetime_format($waktu_pembayaran);
        $parameters['waktu_pembayaran'] = $new_format;

        // Process Data
        if(isset($id_pembayaran) && $id_pembayaran != null) {
            // Update Data
            $parameters['id_trans'] = $this->input->post("id_trans", TRUE);
            $result = $this->m_trans_penjualan->update_pembayaran_trans_penjualan($id_pembayaran, $parameters);
        }
        else {
            // Insert Data
            $result = $this->m_trans_penjualan->insert_pembayaran_trans_penjualan($parameters);
        }

        return $result;
    }

    function hapus($id_trans)
    {
        $this->hasPermission('delete');
        $parameters['is_active'] = '0';
        $result = $this->m_trans_penjualan->insert_trans_penjualan_history($id_trans, 'hapus');
        $result = $this->m_trans_penjualan->update_trans_penjualan($id_trans, $parameters);

        $activity = 'dihapus';
        if ($result) {
            $this->session->set_flashdata('msg', $this->title." berhasil ".$activity."!");
        } else {
            $this->session->set_flashdata('msgw', $this->title." gagal ".$activity."!");
        }
        redirect('trans_penjualan/index');
    }

    public function cetak($id)
    {
        if($this->hasPermission('read')) {
            $this->SethasPermissionAct();
            $data['halaman'] = 'Detail ' . $this->title;

            $param = array();
            $param['id_trans'] = $id;
            $detail = $this->m_trans_penjualan->get_data_trans_penjualan(null, null, null, $param);
            if (!empty($detail)) {
                $data['detail'] = $detail = $detail[0];
                $data['list_barang'] = $this->m_trans_penjualan->get_data_trans_detail($detail->id_trans);
                $data['data_pembayaran'] = $this->m_trans_penjualan->get_data_pembayaran_trans_penjualan($detail->id_trans);
                $data['data_pengiriman'] = $this->m_trans_penjualan->get_data_pengiriman_trans_penjualan($detail->id_trans);
            }
            $this->load->view($this->module . '/cetak', $data);
        }
    }

    public function detail($id)
    {
        if($this->hasPermission('read')) {
            $this->SethasPermissionAct();
            $data = $this->data;
            $data['halaman'] = 'Detail ' . $this->title;

            $param = array();
            $param['id_trans'] = $id;
            $detail = $this->m_trans_penjualan->get_data_trans_penjualan(null, null, null, $param);
            if (!empty($detail)) {
                $data['detail'] = $detail = $detail[0];
                $data['list_barang'] = $this->m_trans_penjualan->get_data_trans_detail($detail->id_trans);
                $data['data_pembayaran'] = $this->m_trans_penjualan->get_data_pembayaran_trans_penjualan($detail->id_trans);
                $data['data_pengiriman'] = $this->m_trans_penjualan->get_data_pengiriman_trans_penjualan($detail->id_trans);
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

            $data['data_process'] = $this->m_trans_penjualan->get_data_trans_process($id);

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
                $status = $this->m_trans_penjualan->ubah_status_trans_penjualan($x, $new);
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
        redirect('trans_penjualan/index/'.$paging.'?'.$url_param);

    }

    function hapus_pembayaran($id_trans, $id_pembayaran)
    {
        $status = $this->m_trans_penjualan->delete_pembayaran_trans_penjualan($id_pembayaran, $id_trans);
        $subject = 'Data pembayaran transaksi penjualan';
        $proses = 'dihapus';
        if($status)
            $this->session->set_flashdata('msg',$subject. " berhasil " . $proses . "!");
        else
            $this->session->set_flashdata('msgw', $subject." gagal ".$proses."!");
        redirect('trans_penjualan/create_edit_pembayaran/'.$id_trans);
    }
}