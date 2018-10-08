<?php

class M_pegawai extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_pegawai($is_count = null, $start = null, $limit = null, $filter = array()) {
        if(isset($is_count)){
            $kolom = " COUNT(id_pegawai) as jumlah ";
        } else {
            $kolom = " s.*, u.real_name ";
        }
        $query = "SELECT $kolom FROM pegawai s JOIN user u ON s.last_modified_user = u.id_user WHERE s.is_active = '1' ";

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

        if(isset($filter['id_pegawai'])) {
            $item = $filter['id_pegawai'];
            if (isset($item) && !empty($item)) {
                $query .= " AND id_pegawai = ? ";
                $param[] = $item;
            }
        }
        if(isset($filter['filter']['nama'])) {
            $item = $filter['filter']['nama'];
            if (isset($item) && !empty($item)) {
                $query .= " AND (nama LIKE ? OR alamat LIKE ? OR no_telp LIKE ? OR keterangan LIKE ? OR jabatan LIKE ?)";
                $param[] = "%" . $item . "%";
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

    function insert_pegawai($param) {
        $this->db->trans_begin();
        $this->db->insert('pegawai', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $id_pegawai = $this->db->insert_id();
            $this->db->trans_commit();
            return $id_pegawai;
        }
    }

    function insert_pegawai_history($id_pegawai, $catatan) {
        $this->db->trans_begin();

        $result = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = ?",$id_pegawai)->row();
        $last_data = array();
        foreach ($result as $k => $r){
            $last_data[$k] = $r;
        }
        $last_data['catatan'] = $catatan;

        $this->db->insert('pegawai_history', $last_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function update_pegawai($id_pegawai, $param) {
        $this->db->trans_begin();
        $id_user = $this->session->userdata('r_userId');
        $this->db->set('last_modified_user', $id_user);
        $this->db->set('last_modified_time', 'NOW()', FALSE);
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->update('pegawai', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $id_pegawai;
        }
    }

}