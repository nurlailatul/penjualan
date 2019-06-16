<?php

class M_barang extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_barang($is_count = null, $start = null, $limit = null, $filter = array()) {
        if(isset($is_count)){
            $kolom = " COUNT(id_barang) as jumlah ";
        } else {
            $kolom = " b.*, u.real_name,
                  (SELECT stok FROM stok_barang sb WHERE sb.id_barang = b.id_barang ORDER BY sb.tgl DESC LIMIT 1) as stok ";
        }
        $query = "SELECT $kolom
                FROM barang b
                  LEFT JOIN user u ON b.last_modified_user = u.id_user
                WHERE b.is_active = '1' ";

        $param = array();
        $result = $this->whereHandler($query, $param, $filter);
        $query = $result['query'];
        $param = $result['param'];

        if(!$is_count) {
          if (!empty($filter) && isset($filter['filter']['orderby'])) {
            $item = str_replace("-", " ", $filter['filter']['orderby']);
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

        if(isset($filter['id_barang'])) {
            $item = $filter['id_barang'];
            if (isset($item) && !empty($item)) {
                $query .= " AND b.id_barang = ? ";
                $param[] = $item;
            }
        }
        if(isset($filter['filter']['nama'])) {
            $item = $filter['filter']['nama'];
            if (isset($item) && !empty($item)) {
                $query .= " AND (b.nama LIKE ? OR b.kode LIKE ? OR b.deskripsi LIKE ?)";
                $param[] = "%" . $item . "%";
                $param[] = "%" . $item . "%";
                $param[] = "%" . $item . "%";
            }
        }

        $result['query'] = $query;
        $result['param'] = $param;
        return $result;
    }

    function insert_barang($param) {
        $stok = $param['stok'];
        unset($param['stok']);

        $this->db->trans_begin();
        $this->db->insert('barang', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $id_barang = $this->db->insert_id();

            // Insert to Trans_stok_barang
            $param = array();
            $param['id_barang'] = $id_barang;
            $param['jenis_transaksi'] = 'TAMBAH BARANG';
            $param['masuk'] = $stok;

            $this->db->set('created_time', 'NOW()', FALSE);

            $this->db->insert('trans_stok_barang', $param);

            $this->insert_barang_history($id_barang, 'insert');

            if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();
              return FALSE;
            } else {
              $this->db->trans_commit();
              return TRUE;
            }
        }
    }

    function insert_barang_history($id_barang, $catatan) {
        $this->db->trans_begin();

        $result = $this->db->query("SELECT * FROM barang WHERE id_barang = ?",$id_barang)->row();
        $last_data = array();
        foreach ($result as $k => $r){
            $last_data[$k] = $r;
        }
        $last_data['catatan'] = $catatan;

        $this->db->insert('barang_history', $last_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function update_barang($id_barang, $param) {
        $stok = $param['stok'];
        unset($param['stok']);

        $this->db->trans_begin();
        $id_user = $this->session->userdata('r_userId');
        $this->db->set('last_modified_user', $id_user);
        $this->db->set('last_modified_time', 'NOW()', FALSE);
        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {

            // Update Stok_barang

            // Prepare Data

            $param = array();
            $param['id_barang'] = $id_barang;

            $data_stok = $this->db->query("SELECT stok FROM stok_barang WHERE id_barang = ? ORDER BY tgl DESC LIMIT 1", $id_barang);

            if($data_stok->num_rows() == 0){
                // Insert trans_stok_barang
                $param['jenis_transaksi'] = 'TAMBAH BARANG';
                $param['masuk'] = $stok;
                $this->db->insert('trans_stok_barang', $param);
            }
            else {
                // Check stok updated or not
                $stok_lama = $data_stok->row()->stok;
                if($stok != $stok_lama){
                    // if Updated
                    $param['jenis_transaksi'] = 'UBAH DATA BARANG';

                    $perubahan = (int)$stok_lama - (int)$stok;
                    if($perubahan > 0){ // Stok lama lebih dari stok baru
                        $param['keluar'] = abs($perubahan); // Kurangi stok
                    } else {
                        $param['masuk'] = abs($perubahan); // Tambah stok
                    }
                    $this->db->insert('trans_stok_barang', $param);
                }
            }

            $this->db->trans_commit();
            return $id_barang;
        }
    }

}