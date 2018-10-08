<?php

class M_pelanggan extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_pelanggan($is_count = null, $start = null, $limit = null, $filter = array()) {
        if(isset($is_count)){
            $kolom = " COUNT(id_pelanggan) as jumlah ";
        } else {
            $kolom = " s.*, u.real_name, p.nama as nama_reseller ";
        }
        $query = "SELECT $kolom FROM pelanggan s JOIN user u ON s.last_modified_user = u.id_user 
                LEFT JOIN pegawai p ON s.id_upline = p.id_pegawai 
                WHERE s.is_active = '1' ";

        $param = array();
        $result = $this->whereHandler($query, $param, $filter);
        $query = $result['query'];
        $param = $result['param'];

        if(!$is_count) {
          if (!empty($filter) && isset($filter['orderby'])) {
            $item = str_replace("-", " ", $filter['orderby']);
            $query .= " ORDER BY $item";
          } else
            $query .= " ORDER BY created_time DESC";
        }

        if (isset($limit)){
            $query .= " LIMIT $start , $limit";
        }

        $result = $this->db->query($query, $param);
        if(isset($is_count)){
            return $result->row()->jumlah;
        } else
            return $result->result();
    }

    function whereHandler($query, $param, $filter) {

        if(isset($filter['id_pelanggan'])) {
            $item = $filter['id_pelanggan'];
            if (isset($item) && !empty($item)) {
                $query .= " AND s.id_pelanggan = ? ";
                $param[] = $item;
            }
        }
        if(isset($filter['is_reseller'])) {
            $item = $filter['is_reseller'];
            if (isset($item) && $item != '') {
                $query .= " AND s.is_reseller = ? ";
                $param[] = $item;
            }
        }
        if(isset($filter['nama'])) {
            $item = $filter['nama'];
            if (isset($item) && !empty($item)) {
                $query .= " AND (s.nama LIKE ? OR s.alamat LIKE ? OR s.no_telp LIKE ? OR s.keterangan LIKE ?)";
                $param[] = "%" . $item . "%";
                $param[] = "%" . $item . "%";
                $param[] = "%" . $item . "%";
                $param[] = "%" . $item . "%";
            }
        }

        $result['query'] = $query;
        $result['param'] = $param;
        return $result;
    }

    function insert_pelanggan($param) {
        $this->db->trans_begin();
        $this->db->insert('pelanggan', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $id_pelanggan = $this->db->insert_id();
            $this->db->trans_commit();
            return $id_pelanggan;
        }
    }

    function insert_pelanggan_history($id_pelanggan, $catatan) {
        $this->db->trans_begin();

        $result = $this->db->query("SELECT * FROM pelanggan WHERE id_pelanggan = ?",$id_pelanggan)->row();
        $last_data = array();
        foreach ($result as $k => $r){
            $last_data[$k] = $r;
        }
        $last_data['catatan'] = $catatan;

        $this->db->insert('pelanggan_history', $last_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function update_pelanggan($id_pelanggan, $param) {
        $this->db->trans_begin();
        $id_user = $this->session->userdata('r_userId');
        $this->db->set('last_modified_user', $id_user);
        $this->db->set('last_modified_time', 'NOW()', FALSE);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->update('pelanggan', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $id_pelanggan;
        }
    }

}