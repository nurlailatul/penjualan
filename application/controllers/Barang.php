<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends BaseController
{

    protected $module = "barang";
    protected $title = "Data Barang";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_barang");
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

        $this->databarang();

        $this->render("index");
    }

    function databarang()
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

            if($this->input->get("orderby", TRUE)){
              $parameters['orderby'] = $orderby = $this->input->get("orderby", TRUE);
            }

            $this->data['filter'] = (object)$parameters;
        }

        $param = array();
        $param['fields'] = $array_fields_filter;
        $param['filter'] = $parameters;

        // config paging
        $this->load->library('paging');
        $total_data = $this->m_barang->get_data_barang(true, null, null, $param);
        //$total_data = 1500;
        $url = site_url('barang/index');
        $per_page = 30;
        $uri_segment = 3;

        $this->data['link_paging'] = $this->paging->set_paging2($url, $total_data, $per_page, $uri_segment);
        if ($this->uri->segment($uri_segment)) {
            $this->cur_page = $page = ($this->uri->segment($uri_segment));
        } else {
            $this->cur_page = $page = 0;
        }
        // end config paging

        $data = $this->m_barang->get_data_barang(null, $page, $per_page, $param);
        $this->data['data'] = $data;
        $this->data['total_data'] = $total_data;
        $this->data['uri_segment'] = $this->uri->segment($uri_segment);
    }
    public function create_edit($id = NULL)
    {
        $this->hasPermission('create','update');
        $this->data['halaman'] = (isset($id)) ? 'Edit '.$this->title : 'Tambah '.$this->title;
        $breadcrumb = array(
            array( 'page' => $this->title, 'link' => 'barang' )
        );
        $this->data['breadcrumb'] = $breadcrumb;

        if($this->input->post("nama")){
            if(isset($id) && $id != null) {
                $status = $this->proses_insert_edit_barang($id);
                $proses = 'diubah';
                if ($status) {
                    $is_success = true;
                } else {
                    $is_success = false;
                }
            } else {
                $status = $this->proses_insert_edit_barang();
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

            redirect('barang/index');

        }
        else {

            if(isset($id) && $id != 'null') {
                $this->data['id_data'] = $id;
                $param = array();
                $param['id_barang'] = $id;
                $edit = $this->m_barang->get_data_barang(null, null, null, $param);
                if(!empty($edit)) {
                    $edit = $edit[0];
                    $this->data['edit'] = $edit;
                }
            }

            $this->render('create_edit');

        }
    }

    function proses_insert_edit_barang($id = null)
    {
        // Declare table fields
        $array_fields = array('kode','nama','harga_beli','harga_reseller','harga_umum','stok','deskripsi');

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

        // Convert noniman_penghasilan format from 123.234 to 123234
        if(!empty($harga_beli)) {
            $parameters['harga_beli'] = str_replace(',', '.', str_replace('.', '', $harga_beli));
        } else {
            unset($parameters['harga_beli']);
        }
        if(!empty($harga_reseller)) {
            $parameters['harga_reseller'] = str_replace(',', '.', str_replace('.', '', $harga_reseller));
        } else {
            unset($parameters['harga_reseller']);
        }
        if(!empty($harga_umum)) {
            $parameters['harga_umum'] = str_replace(',', '.', str_replace('.', '', $harga_umum));
        } else {
            unset($parameters['harga_umum']);
        }

        // Process Data
        if(isset($id) && $id != null) {
            // Update Data
            $catatan = $this->input->post("catatan", TRUE);
            $result = $this->m_barang->update_barang($id, $parameters);
            $result = $this->m_barang->insert_barang_history($id, $catatan);
        }
        else {
            // Insert Data
            $result = $this->m_barang->insert_barang($parameters);
        }

        return $result;
    }

    function hapus($id_barang)
    {
        $this->hasPermission('delete');
        $parameters['is_active'] = '0';
        $result = $this->m_barang->update_barang($id_barang, $parameters);
        $result = $this->m_barang->insert_barang_history($id_barang, 'hapus');

        $activity = 'dihapus';
        if ($result) {
            $this->session->set_flashdata('msg', $this->title." berhasil ".$activity."!");
        } else {
            $this->session->set_flashdata('msgw', $this->title." gagal ".$activity."!");
        }
        redirect('barang/index');
    }

    public function detail($id)
    {
        if($this->hasPermission('read')) {
            $this->SethasPermissionAct();
            $data = $this->data;
            $data['halaman'] = 'Detail ' . $this->title;

            $param = array();
            $param['id_barang'] = $id;
            $detail = $this->m_barang->get_data_barang(null, null, null, $param);
            if (!empty($detail))
                $data['detail'] = $detail[0];
            $this->load->view($this->module . '/detail', $data);
        }
    }

    /*public function update_barang_history()
    {
      $this->db->trans_begin();
      $notIn = $this->db->query("SELECT * FROM `barang` WHERE id_barang NOT IN (SELECT id_barang FROM barang_history) AND is_active = '1'");

      $total = 0; $inserted = 0;
      foreach ($notIn->result() as $r){
        $total++;
        $last_data = array();
        foreach ($r as $k => $r){
          $last_data[$k] = $r;
        }
        $last_data['catatan'] = 'insert';

        $sql = $this->db->insert('barang_history', $last_data);
        if($sql)
          $inserted++;
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        echo 'Gagal. Total Data '.$total;
      } else {
        $this->db->trans_commit();
        echo 'Berhasil. Total Data Ditambahkan'.$inserted;
      }
    }*/

    public function update_detail_pembelian()
    {
      $this->db->trans_begin();
      $detail = $this->db->query("SELECT * FROM trans_pembelian_detail");

      $total = 0; $updated = 0;
      foreach ($detail->result() as $r){
        $total++;
        $id_barang = $r->id_barang;
        $history = $this->db->query("SELECT id_history FROM barang_history WHERE id_barang = ? ORDER BY id_history DESC LIMIT 1", array($id_barang))->row();

        if(!empty($history)) {
          $id_history = $history->id_history;
          $update = $this->db->query("UPDATE trans_pembelian_detail SET id_barang_history = ? WHERE id_barang = ? AND id_trans = ?", array($id_history, $id_barang, $r->id_trans));
          if($update)
            $updated++;
        }

      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        echo 'Gagal. Total Data '.$total;
      } else {
        $this->db->trans_commit();
        echo 'Berhasil. Total Data Terupdate'.$updated;
      }
    }

    function sql()
    {
      $string = "(4, 21, 4, 5, '105000.00'),
(4, 22, 6, 10, '105000.00'),
(4, 26, 10, 5, '105000.00'),
(4, 29, 13, 10, '105000.00'),
(4, 30, 14, 2, '105000.00'),
(4, 35, 21, 3, '225000.00'),
(4, 38, 25, 10, '105000.00'),
(4, 40, 27, 8, '300000.00'),
(4, 44, 32, 15, '175000.00'),
(4, 55, 44, 3, '185000.00'),
(4, 14, 65, 12, '55000.00'),
(4, 76, 73, 5, '100000.00'),
(4, 77, 74, 20, '21000.00'),
(4, 78, 75, 2, '180000.00'),
(4, 79, 76, 3, '105000.00'),
(4, 80, 77, 24, '42000.00'),
(4, 81, 78, 56, '42000.00'),
(4, 82, 79, 10, '72000.00'),
(4, 83, 80, 5, '140000.00'),
(4, 84, 81, 2, '68000.00'),
(24, 18, 60, 1, '285000.00'),
(24, 86, 83, 1, '110000.00'),
(27, 89, 86, 6, '75000.00'),
(28, 53, 42, 30, '14000.00'),
(28, 62, 52, 10, '85000.00'),
(28, 90, 87, 30, '12000.00'),
(28, 91, 88, 10, '38000.00'),
(28, 92, 89, 12, '30000.00'),
(29, 37, 23, 1, '255000.00'),
(29, 16, 98, 2, '280000.00'),
(29, 104, 102, 1, '235000.00'),
(30, 47, 36, 7, '170000.00'),
(30, 48, 37, 2, '230000.00'),
(30, 50, 39, 3, '110000.00'),
(30, 87, 84, 21, '20000.00'),
(30, 101, 99, 4, '115000.00'),
(30, 102, 100, 6, '195000.00'),
(30, 105, 103, 20, '110000.00'),
(30, 106, 104, 20, '14000.00'),
(31, 21, 4, 5, '105000.00'),
(31, 22, 6, 10, '105000.00'),
(31, 29, 13, 10, '105000.00'),
(31, 38, 25, 15, '105000.00'),
(31, 96, 93, 7, '260000.00'),
(31, 103, 101, 5, '115000.00'),
(32, 60, 50, 50, '29000.00'),
(32, 109, 107, 12, '65000.00'),
(32, 110, 108, 50, '10000.00'),
(33, 89, 86, 5, '75000.00'),
(33, 124, 122, 3, '115000.00'),
(34, 54, 43, 10, '7000.00'),
(34, 62, 52, 10, '85000.00'),
(34, 71, 68, 10, '38000.00'),
(34, 116, 114, 10, '95000.00'),
(34, 120, 118, 10, '30000.00'),
(34, 121, 119, 10, '45000.00'),
(34, 122, 120, 14, '17000.00'),
(34, 123, 121, 20, '3000.00'),
(34, 125, 123, 3, '150000.00'),
(35, 58, 48, 50, '14000.00'),
(35, 63, 53, 20, '28000.00'),
(35, 126, 124, 49, '14000.00'),
(36, 48, 37, 4, '230000.00'),
(36, 50, 39, 6, '110000.00'),
(36, 51, 40, 10, '85000.00'),
(36, 101, 99, 2, '115000.00'),
(36, 102, 100, 4, '195000.00'),
(36, 128, 126, 8, '160000.00'),
(36, 129, 127, 25, '38000.00'),
(37, 47, 36, 10, '170000.00'),
(37, 50, 39, 5, '110000.00'),
(37, 101, 99, 6, '115000.00'),
(37, 130, 128, 2, '30000.00'),
(38, 29, 13, 10, '105000.00'),
(38, 35, 21, 4, '225000.00'),
(38, 38, 25, 25, '105000.00'),
(39, 85, 82, 3, '68000.00'),
(39, 12, 129, 10, '102000.00'),
(39, 131, 130, 25, '35000.00'),
(40, 55, 44, 3, '185000.00'),
(40, 103, 101, 5, '115000.00'),
(40, 11, 131, 15, '40000.00'),
(41, 53, 42, 100, '14000.00'),
(41, 112, 110, 10, '27000.00'),
(41, 133, 135, 20, '32000.00'),
(41, 134, 136, 10, '72000.00'),
(41, 135, 137, 10, '25000.00'),
(42, 52, 41, 2, '14000.00'),
(42, 105, 103, 20, '110000.00'),
(43, 45, 33, 20, '170000.00'),
(43, 46, 35, 2, '165000.00'),
(43, 136, 138, 57, '105000.00'),
(44, 47, 36, 5, '170000.00'),
(44, 64, 54, 20, '8000.00'),
(44, 99, 96, 15, '20000.00'),
(44, 102, 100, 2, '195000.00'),
(44, 128, 126, 2, '160000.00'),
(44, 129, 127, 1, '38000.00'),
(44, 156, 159, 15, '18000.00'),
(45, 76, 73, 5, '100000.00'),
(45, 157, 160, 12, '115000.00'),
(46, 46, 35, 2, '165000.00'),
(46, 55, 44, 3, '185000.00'),
(46, 136, 138, 43, '105000.00'),
(46, 154, 157, 10, '100000.00')";

      $exp1 = explode("),", $string);
      foreach ($exp1 as $r)
      {
        $exp2 = explode(",", $r);
        echo $exp2[0].', '.$exp2[1].', '.$exp2[3].'), <br>';
      }
    }
}