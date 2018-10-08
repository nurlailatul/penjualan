<?php

class M_supplier extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_supplier($is_count = null, $start = null, $limit = null, $filter = array()) {
        if(isset($is_count)){
            $kolom = " COUNT(id_supplier) as jumlah ";
        } else {
            $kolom = " s.*, u.real_name ";
        }
        $query = "SELECT $kolom FROM supplier s JOIN user u ON s.last_modified_user = u.id_user WHERE s.is_active = '1' ";

        $param = array();
        $result = $this->whereHandler($query, $param, $filter);
        $query = $result['query'];
        $param = $result['param'];

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

        if(isset($filter['id_supplier'])) {
            $item = $filter['id_supplier'];
            if (isset($item) && !empty($item)) {
                $query .= " AND id_supplier = ? ";
                $param[] = $item;
            }
        }
        if(isset($filter['filter']['nama'])) {
            $item = $filter['filter']['nama'];
            if (isset($item) && !empty($item)) {
                $query .= " AND (nama LIKE ? OR alamat LIKE ? OR no_telp LIKE ? OR keterangan LIKE ?)";
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

    function insert_supplier($param) {
        $this->db->trans_begin();
        $this->db->insert('supplier', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $id_supplier = $this->db->insert_id();
            $this->db->trans_commit();
            return $id_supplier;
        }
    }

    function insert_supplier_history($id_supplier, $catatan) {
        $this->db->trans_begin();

        $result = $this->db->query("SELECT * FROM supplier WHERE id_supplier = ?",$id_supplier)->row();
        $last_data = array();
        foreach ($result as $k => $r){
            $last_data[$k] = $r;
        }
        $last_data['catatan'] = $catatan;

        $this->db->insert('supplier_history', $last_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function update_supplier($id_supplier, $param) {
        $this->db->trans_begin();
        $id_user = $this->session->userdata('r_userId');
        $this->db->set('last_modified_user', $id_user);
        $this->db->set('last_modified_time', 'NOW()', FALSE);
        $this->db->where('id_supplier', $id_supplier);
        $this->db->update('supplier', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $id_supplier;
        }
    }

}