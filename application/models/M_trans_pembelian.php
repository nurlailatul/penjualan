<?php

class M_trans_pembelian extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_trans_pembelian($is_count = null, $start = null, $limit = null, $filter = array()) {
        if(isset($is_count)){
            $kolom = " COUNT(b.id_trans) as jumlah ";
        } else {
            $kolom = " b.*, s.nama as supplier, u.real_name, v.biaya_pembelian ";
        }
        $query = "SELECT $kolom FROM trans_pembelian b 
                    JOIN supplier s on b.id_supplier = s.id_supplier
                    LEFT JOIN user u ON b.last_upd_user = u.id_user 
                    JOIN v_trans_pembelian_total v ON b.id_trans = v.id_trans
                    WHERE 1 ";

        $param = array();
        $result = $this->whereHandler($query, $param, $filter);
        $query = $result['query'];
        $param = $result['param'];

        if(!$is_count) {
          if (!empty($filter) && isset($filter['orderby'])) {
            $item = str_replace("-", " ", $filter['orderby']);
            $query .= " ORDER BY $item";
          } else
            $query .= " ORDER BY b.id_trans DESC";
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

        if(isset($filter['id_trans'])) {
            $item = $filter['id_trans'];
            if (isset($item) && !empty($item)) {
                $query .= " AND b.id_trans = ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['periode'])) {
            $item = $filter['periode'];
            if (!empty($item)) {
                $periode = decode_filter_periode($item);
                if($periode){
                    $query .= " AND DATE(waktu_transaksi) BETWEEN ? AND ? ";
                    $param[] = $periode['tanggal_from'].' 00:00:00';
                    $param[] = $periode['tanggal_to'].' 23:59:59';
                }
            }
        }

        if(isset($filter['supplier'])) {
            $item = $filter['supplier'];
            if (!empty($item)) {
                $query .= " AND b.id_supplier IN ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['status_transaksi'])) {
            $item = $filter['status_transaksi'];
            if (!empty($item) && $item != 'all') {
                $query .= " AND status_transaksi = ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['minimum']) || isset($filter['maximum'])) {

            $minimum = $maximum = 0;
            if (isset($filter['minimum']))
                $minimum = $filter['minimum'];

            if(isset($filter['minimum']) && !isset($filter['maximum'])) {
                // Lebih Dari
                $query .= " AND biaya_pembelian > ? ";
                $param[] = $minimum;
            } else {
                if (isset($filter['maximum']))
                    $maximum = $filter['maximum'];

                $query .= " AND biaya_pembelian BETWEEN ? AND ? ";
                $param[] = $minimum;
                $param[] = $maximum;
            }
        }

        $result['query'] = $query;
        $result['param'] = $param;
        return $result;
    }

    function get_data_trans_detail($id_trans)
    {
        $query = "SELECT t.*, b.id_barang, b.id_history, b.nama as nama_barang, b.harga_beli as harga_satuan, (jumlah_pax * b.harga_beli) as total 
                FROM trans_pembelian_detail t
                  JOIN barang_history b on t.id_barang_history = b.id_history
                WHERE id_trans = ?";
        $param = array($id_trans);
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function get_data_trans_process($id_trans)
    {
        $query = "SELECT t.*, u.real_name 
                FROM proses_trans_pembelian t
                  LEFT JOIN user u ON t.id_user = u.id_user
                WHERE id_trans = ?";
        $param = array($id_trans);
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function insert_trans_pembelian($param) {
        $this->db->trans_begin();

        if($param['supplier_baru'] != ''){
            // Insert Supplier baru
            $param_supp = array('nama' => $param['supplier_baru']);
            $this->db->insert('supplier', $param_supp);
            $param['id_supplier'] = $this->db->insert_id();
        }
        unset($param['supplier_baru']);

        $id_history = $param['id_history'];
        $jumlah_pax = $param['jumlah_pax'];
        unset($param['id_history']);
        unset($param['jumlah_pax']);

        $this->db->insert('trans_pembelian', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $id_trans = $this->db->insert_id();

        // Insert transaksi_detail while calculate update stock
        foreach ($id_history as $k => $r){
            $b_history = $this->db->query("SELECT id_barang FROM barang_history WHERE id_history = ?", $r)->row();
            $jml_pax = $jumlah_pax[$k];

            $param_detail = array(
                'id_trans' => $id_trans,
                'id_barang_history' => $r,
                'jumlah_pax' => $jml_pax,);

            $this->db->insert('trans_pembelian_detail', $param_detail);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            }

            // Update Stok

            // Insert to Trans_stok_barang
            $param_stok = array(
                'id_barang' => $b_history->id_barang,
                'jenis_transaksi' => 'TAMBAH TRANSAKSI PEMBELIAN',
                'id_trans' => $id_trans,
                'masuk' => $jml_pax);

            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->set('created_time', 'NOW()', FALSE);
            $this->db->insert('trans_stok_barang', $param_stok);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            }
        }

        // Insert process
        $id_user = $this->session->userdata('r_userId');
        $param_proses = array(
            'id_trans' => $id_trans,
            'id_user' => $id_user
        );
        $this->db->insert('proses_trans_pembelian', $param_proses);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return $id_trans;
    }

    function update_trans_pembelian($id_trans, $param) {
        $this->db->trans_begin();

        if($param['supplier_baru'] != ''){
            // Insert Supplier baru
            $param_supp = array('nama' => $param['supplier_baru']);
            $this->db->insert('supplier', $param_supp);
            $param['id_supplier'] = $this->db->insert_id();
        }
        unset($param['supplier_baru']);

        $id_history = $param['id_history'];
        $jumlah_pax = $param['jumlah_pax'];
        unset($param['id_history']);
        unset($param['jumlah_pax']);

        // Update transaksi_detail while calculate update stock

        // Delete that not in
        $notIn = $this->db->query("SELECT t.*, bh.id_barang FROM trans_pembelian_detail t 
                  JOIN barang_history bh on t.id_barang_history = bh.id_history 
                  WHERE id_trans = ? AND id_barang_history NOT IN ?",array($id_trans, $id_history))->result();
        foreach ($notIn as $r){
            $jml_pax = $r->jumlah_pax;
            // Insert to Trans_stok_barang
            $param_stok = array(
                'id_barang' => $r->id_barang,
                'jenis_transaksi' => 'UBAH TRANSAKSI PEMBELIAN',
                'id_trans' => $id_trans,
                'keluar' => $jml_pax);

            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->set('created_time', 'NOW()', FALSE);
            $this->db->insert('trans_stok_barang', $param_stok);

            $this->db->query("DELETE FROM trans_pembelian_detail WHERE id_trans_detail = ?",array($r->id_trans_detail));
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        foreach ($id_history as $k => $r){

            // Store it first
            $data_lama = $this->db->query("SELECT * FROM trans_pembelian_detail WHERE id_trans = ? AND id_barang_history = ?",array($id_trans, $r))->row();

            $b_history = $this->db->query("SELECT id_barang FROM barang_history WHERE id_history= ?", $r)->row();
            $jml_pax = $jumlah_pax[$k];

            $param_detail = array(
                'id_trans' => $id_trans,
                'id_barang_history' => $r,
                'jumlah_pax' => $jml_pax,
              );

            if(empty($data_lama))
                $this->db->insert('trans_pembelian_detail', $param_detail);
            else{
                $this->db->where(array('id_trans' => $id_trans, 'id_barang_history' => $r));
                $this->db->update('trans_pembelian_detail', $param_detail);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            }

            // Update Stok

            if($data_lama->jumlah_pax != $jml_pax) {

                // Insert to Trans_stok_barang
                $param_stok = array(
                    'id_barang' => $b_history->id_barang,
                    'jenis_transaksi' => 'UBAH TRANSAKSI PEMBELIAN',
                    'id_trans' => $id_trans);

                $perubahan = (int)$data_lama->jumlah_pax - (int)$jml_pax;
                if($perubahan > 0){ // Jumlah Pax lama lebih dari jumlah pax batu
                    $param_stok['keluar'] = abs($perubahan); // Kurangi stok
                } else {
                    $param_stok['masuk'] = abs($perubahan); // Tambah stok
                }

                $this->db->set('created_date', 'NOW()', FALSE);
                $this->db->set('created_time', 'NOW()', FALSE);
                $this->db->insert('trans_stok_barang', $param_stok);

            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            }

        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    function ubah_status_trans_pembelian($id, $status) {
        $this->db->trans_begin();

        if($status == '4') { // DIBATALKAN
            $list_item = $this->get_data_trans_detail($id);
            foreach ($list_item as $r) {
                $param_stok = array(
                    'id_barang' => $r->id_barang,
                    'jenis_transaksi' => 'UBAH TRANSAKSI PEMBELIAN',
                    'id_trans' => $id,
                    'keluar' => $r->jumlah_pax,
                    'keterangan' => 'PEMBATALAN TRANSAKSI');

                $this->db->set('created_date', 'NOW()', FALSE);
                $this->db->set('created_time', 'NOW()', FALSE);
                $this->db->insert('trans_stok_barang', $param_stok);

            }
        }
        $id_user = $this->session->userdata('r_userId');
        $this->db->set('status_transaksi', $status);
        $this->db->set('last_upd_user', $id_user);
        $this->db->set('last_upd_time', 'NOW()', FALSE);
        $this->db->where('id_trans', $id);
        $this->db->update('trans_pembelian');

        $param = array(
            'id_trans' => $id,
            'id_user' => $id_user,
            'status_transaksi' => $status
        );
        $this->db->insert('proses_trans_pembelian', $param);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $id;
        }
    }

}