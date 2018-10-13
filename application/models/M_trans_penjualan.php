<?php

class M_trans_penjualan extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_trans_penjualan($is_count = null, $start = null, $limit = null, $filter = array()) {
        if(isset($is_count)){
            $kolom = " COUNT(b.id_trans) as jumlah ";
        } else {
            $kolom = " b.*, p.nama as pelanggan, u.real_name, id_pengiriman, waktu_pengiriman, waktu_sampai, jenis_ekspedisi, no_resi, k.biaya_pengiriman, g.nama as nama_kurir, je.nama as jenis_ekspedisi, v.biaya_penjualan, v2.tot_harga_jual ";
        }
        $query = "SELECT $kolom FROM trans_penjualan b 
                    JOIN pelanggan p ON b.id_pelanggan = p.id_pelanggan
                    LEFT JOIN user u ON b.last_upd_user = u.id_user 
                    LEFT JOIN pengiriman_trans_penjualan k on b.id_trans = k.id_trans
                    LEFT JOIN jenis_ekspedisi je ON k.jenis_ekspedisi = je.id_jenis
                    LEFT JOIN pegawai g ON k.id_kurir = g.id_pegawai
                    JOIN v_trans_penjualan_total_all v ON b.id_trans = v.id_trans
                    JOIN v_trans_penjualan_total v2 ON b.id_trans = v2.id_trans
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

        if(isset($filter['jenis_transaksi'])) {
            $item = $filter['jenis_transaksi'];
            if (!empty($item)) {
                $query .= " AND jenis_transaksi = ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['pelanggan'])) {
            $item = $filter['pelanggan'];
            if (!empty($item)) {
                $query .= " AND b.id_pelanggan IN ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['kurir'])) {
            $item = $filter['kurir'];
            if (!empty($item)) {
                $query .= " AND k.id_kurir IN ? ";
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

        if(isset($filter['status_pembayaran'])) {
            $item = $filter['status_pembayaran'];
            if (!empty($item) && $item != 'all') {
                $query .= " AND status_pembayaran = ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['status_pengiriman'])) {
            $item = $filter['status_pengiriman'];
            if (!empty($item) && $item != 'all') {
                $query .= " AND status_pengiriman = ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['minimum']) || isset($filter['maximum'])) {

            $minimum = $maximum = 0;
            if (isset($filter['minimum']))
                $minimum = $filter['minimum'];

            if(isset($filter['minimum']) && !isset($filter['maximum'])) {
                // Lebih Dari
                $query .= " AND total_harga > ? ";
                $param[] = $minimum;
            } else {
                if (isset($filter['maximum']))
                    $maximum = $filter['maximum'];

                $query .= " AND total_harga BETWEEN ? AND ? ";
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
        $query = "SELECT t.*, b.id_history, b.id_barang, b.nama as nama_barang, 
                IF(p.jenis_transaksi = 'RESELLER', b.harga_reseller, b.harga_umum) as harga_satuan,  
                IF(p.jenis_transaksi = 'RESELLER', jumlah_pax * b.harga_reseller, jumlah_pax * b.harga_umum) as total, 
                IF(p.jenis_transaksi = 'RESELLER', b.harga_reseller - b.harga_beli, b.harga_umum - b.harga_beli) as laba, 
                b.kode
                FROM trans_penjualan_detail t
                JOIN trans_penjualan p ON t.id_trans = p.id_trans 
                  JOIN barang_history b ON t.id_barang_history = b.id_history
                WHERE t.id_trans = ?";
        $param = array($id_trans);
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function get_data_pengiriman_trans_penjualan($id_trans = null, $id_pengiriman = null)
    {
        $query = "SELECT p.*, je.nama as nama_ekspedisi, g.nama as nama_pegawai FROM pengiriman_trans_penjualan p 
                JOIN jenis_ekspedisi je ON p.jenis_ekspedisi = je.id_jenis
                LEFT JOIN pegawai g ON p.id_kurir = g.id_pegawai 
                WHERE 1 ";
        $param = array();
        if(isset($id_trans)){
            $query .= " AND p.id_trans = ? ";
            $param[] = $id_trans;
        }
        if(isset($id_pengiriman)){
            $query .= " AND p.id_pengiriman = ? ";
            $param[] = $id_pengiriman;
        }
        $sql = $this->db->query($query, $param);

        return $sql->row();
    }

    function get_data_pembayaran_trans_penjualan($id_trans = null, $id_pembayaran = null)
    {
        $query = "SELECT p.* FROM pembayaran_trans_penjualan p WHERE 1 ";
        $param = array();
        if(isset($id_trans)){
            $query .= " AND p.id_trans = ? ";
            $param[] = $id_trans;
        }
        if(isset($id_pembayaran)){
            $query .= " AND p.id_pembayaran = ? ";
            $param[] = $id_pembayaran;
        }
        $query .= " ORDER BY id_pembayaran DESC ";
        $sql = $this->db->query($query, $param);

        return $sql->row();
    }

    function get_data_trans_process($id_trans)
    {
        $query = "SELECT t.*, u.real_name 
                FROM proses_trans_penjualan t
                LEFT JOIN user u ON t.id_user = u.id_user
                WHERE id_trans = ?";
        $param = array($id_trans);
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function get_data_jenis_ekspedisi($id_jenis = null)
    {
        $query = "SELECT * 
                FROM jenis_ekspedisi
                WHERE is_active = '1'";
        $param = array();
        if(isset($id_jenis)){
            $query .= " AND id_jenis = ? ";
            $param[] = $id_jenis;
        }
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function check_trans_is_finished($id_trans)
    {
      $sql = $this->db->query("SELECT status_transaksi FROM trans_penjualan WHERE id_trans = ?", $id_trans)->row();

      if($sql->status_transaksi == 'SELESAI')
        return FALSE;
      else
        return TRUE;
    }

    function insert_trans_penjualan($param) {
        $this->db->trans_begin();

        if($param['pelanggan_baru'] != ''){
            // Insert Pelanggan baru
            $param_supp = array('nama' => $param['pelanggan_baru']);
            $this->db->insert('pelanggan', $param_supp);
            $param['id_pelanggan'] = $this->db->insert_id();
        }
        unset($param['pelanggan_baru']);

        $id_history = $param['id_history'];
        $jumlah_pax = $param['jumlah_pax'];
        unset($param['id_history']);
        unset($param['jumlah_pax']);

        $this->db->insert('trans_penjualan', $param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to insert trx_penjualan
        }

        $id_trans = $this->db->insert_id();

        // Insert transaksi_detail while update stock
        foreach ($id_history as $k => $r){
            $data_barang = $this->db->query("SELECT id_barang  
              FROM barang_history b 
              WHERE b.id_history = ?", $r)->row();

            $stok = $this->db->query("SELECT stok FROM stok_barang sb 
              WHERE sb.id_barang = ? 
              ORDER BY sb.tgl DESC LIMIT 1", array($data_barang->id_barang))->row();

            $stok = $stok->stok;
            $jml_pax = $jumlah_pax[$k];
            if($stok < $jml_pax)
                $jml_pax = $stok;

            $param_detail = array(
                'id_trans' => $id_trans,
                'id_barang_history' => $r,
                'jumlah_pax' => $jml_pax
            );

            $this->db->insert('trans_penjualan_detail', $param_detail);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE; // Failed to insert detail trx
            }

            // Update Stok

            // Insert to Trans_stok_barang
            $param_stok = array(
                'id_barang' => $data_barang->id_barang,
                'jenis_transaksi' => 'TAMBAH TRANSAKSI PENJUALAN',
                'id_trans' => $id_trans,
                'keluar' => $jml_pax);

            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->set('created_time', 'NOW()', FALSE);
            $this->db->insert('trans_stok_barang', $param_stok);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE; // Failed to insert trans_stok_barang
            }
        }

        // Insert process
        $id_user = $this->session->userdata('r_userId');
        $param_proses = array(
            'id_trans' => $id_trans,
            'id_user' => $id_user
        );
        $this->db->insert('proses_trans_penjualan', $param_proses);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to insert proses trans_penjualan
        }

        $this->db->trans_commit();
        return $id_trans;
    }

    function update_trans_penjualan($id_trans, $param) {
        $this->db->trans_begin();

        if($param['pelanggan_baru'] != ''){
            // Insert Supplier baru
            $param_supp = array('nama' => $param['pelanggan_baru']);
            $this->db->insert('pelanggan', $param_supp);
            $param['id_pelanggan'] = $this->db->insert_id();
        }
        unset($param['pelanggan_baru']);

        $id_history = $param['id_history'];
        $jumlah_pax = $param['jumlah_pax'];
        unset($param['id_history']);
        unset($param['jumlah_pax']);

        $id_user = $this->session->userdata('r_userId');
        $this->db->set('last_upd_user', $id_user);
        $this->db->set('last_upd_time', 'NOW()', FALSE);
        $this->db->where('id_trans', $id_trans);
        $this->db->update('trans_penjualan', $param);

        // Update transaksi_detail while calculate update stock

        // Delete that not in
        $notIn = $this->db->query("SELECT t.*, bh.id_barang FROM trans_penjualan_detail t 
        JOIN barang_history bh on t.id_barang_history = bh.id_history 
        WHERE id_trans = ? AND id_barang_history NOT IN ?",array($id_trans, $id_history))->result();
        foreach ($notIn as $r){
            $jml_pax = $r->jumlah_pax;
            // Insert to Trans_stok_barang
            $param_stok = array(
                'id_barang' => $r->id_barang,
                'jenis_transaksi' => 'UBAH TRANSAKSI PENJUALAN',
                'id_trans' => $id_trans,
                'masuk' => $jml_pax);

            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->set('created_time', 'NOW()', FALSE);
            $this->db->insert('trans_stok_barang', $param_stok);

            $this->db->query("DELETE FROM trans_penjualan_detail WHERE id_trans = ? AND id_barang_history = ?",array($id_trans, $r->id_barang_history));
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to delete that not in
        }

        foreach ($id_history as $k => $r){

            $data_lama = $this->db->query("SELECT * FROM trans_penjualan_detail WHERE id_trans = ? AND id_barang_history = ?",array($id_trans, $r))->row();

            $b_history = $this->db->query("SELECT id_barang FROM barang_history WHERE id_history = ?", $r)->row();
            $jml_pax = $jumlah_pax[$k];
            $old_jml_pax = $data_lama->jumlah_pax;

            //Check stok
            $stok = $this->db->query("SELECT * FROM stok_barang WHERE id_barang = ? ORDER BY tgl DESC LIMIT 1", $b_history->id_barang)->row();
            $jml_stok = $stok->stok;
            $stok_before_last_add = $jml_stok + $old_jml_pax;

            if($stok_before_last_add < $jml_pax) {
              // Out of stok
              $this->db->trans_rollback();
              return FALSE; // Out of stok
            }

            // Store it first
            $param_detail = array(
                'id_trans' => $id_trans,
                'id_barang_history' => $r,
                'jumlah_pax' => $jml_pax
            );

            if(empty($data_lama))
                $this->db->insert('trans_penjualan_detail', $param_detail);
            else{
                $this->db->where(array('id_trans' => $id_trans, 'id_barang_history' => $r));
                $this->db->update('trans_penjualan_detail', $param_detail);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE; // Failed to update detail trx
            }

            // Update Stok
            if($data_lama->jumlah_pax != $jml_pax) {

                // Insert to Trans_stok_barang
                $param_stok = array(
                    'id_barang' => $b_history->id_barang,
                    'jenis_transaksi' => 'UBAH TRANSAKSI PENJUALAN',
                    'id_trans' => $id_trans);

                $perubahan = (int)$data_lama->jumlah_pax - (int)$jml_pax;
                if($perubahan > 0){ // Jumlah Pax lama lebih dari jumlah pax batu
                    $param_stok['masuk'] = abs($perubahan); // Tambah stok
                } else {
                    $param_stok['keluar'] = abs($perubahan); // Kurangi stok
                }

                $this->db->set('created_date', 'NOW()', FALSE);
                $this->db->set('created_time', 'NOW()', FALSE);
                $this->db->insert('trans_stok_barang', $param_stok);

            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE; // Failed to update stok
            }

        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to update trx
        }

        $this->db->trans_commit();
        return $id_trans;
    }

    function ubah_status_trans_penjualan($id, $status) {
        $this->db->trans_begin();


        if($status == '5') { // DIBATALKAN
            $list_item = $this->get_data_trans_detail($id);
            foreach ($list_item as $r) {
                $param_stok = array(
                    'id_barang' => $r->id_barang,
                    'jenis_transaksi' => 'UBAH TRANSAKSI PENJUALAN',
                    'id_trans' => $id,
                    'masuk' => $r->jumlah_pax,
                    'keterangan' => 'PEMBATALAN TRANSAKSI');

                $this->db->set('created_date', 'NOW()', FALSE);
                $this->db->set('created_time', 'NOW()', FALSE);
                $this->db->insert('trans_stok_barang', $param_stok);
            }
        }

        $id_user = $this->session->userdata('r_userId');
        $this->db->set('id_status', $status);
        $this->db->set('last_upd_user', $id_user);
        $this->db->set('last_upd_time', 'NOW()', FALSE);
        $this->db->where('id_trans', $id);
        $this->db->update('trans_penjualan');

        $param = array(
            'id_trans' => $id,
            'id_user' => $id_user,
            'id_status' => $status
        );
        $this->db->insert('proses_trans_penjualan', $param);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to update status
        } else {
            $this->db->trans_commit();
            return $id;
        }
    }

    function insert_pengiriman_trans_penjualan($id_trans, $param) {
        $check = $this->db->query("SELECT * FROM pengiriman_trans_penjualan WHERE id_trans = ?", $id_trans);
        if($check->num_rows() == 0) {
            $this->db->trans_begin();
            $this->db->insert('pengiriman_trans_penjualan', $param);
            $id_pengiriman = $this->db->insert_id();

            $this->update_status_trans_penjualan($id_trans);

            if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();
              return FALSE; // Failed to insert pengiriman
            } else {
              $this->db->trans_commit();
              return $id_pengiriman;
            }
        } else {
            return FALSE; // Trx already have pengiriman data
        }
    }

    function insert_pembayaran_trans_penjualan($param) {
        $this->db->trans_begin();
        $this->db->insert('pembayaran_trans_penjualan', $param);
        $id_pembayaran = $this->db->insert_id();

        $id_trans = $param['id_trans'];
        $this->update_status_trans_penjualan($id_trans);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to insert pembayaran data
        } else {
            $this->db->trans_commit();
            return $id_pembayaran;
        }
    }

    function update_pengiriman_trans_penjualan($id_trans, $id_pengiriman, $param) {
        $this->db->trans_begin();
        $id_user = $this->session->userdata('r_userId');
        $this->db->set('last_modified_user', $id_user);
        $this->db->set('last_modified_time', 'NOW()', FALSE);
        $this->db->where('id_pengiriman', $id_pengiriman);
        $this->db->update('pengiriman_trans_penjualan', $param);

        $this->update_status_trans_penjualan($id_trans);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to update pengiriman data
        } else {
            $this->db->trans_commit();
            return $id_pengiriman;
        }
    }

    function update_pembayaran_trans_penjualan($id_pembayaran, $param) {
        $this->db->trans_begin();
        $id_user = $this->session->userdata('r_userId');
        $this->db->set('last_modified_user', $id_user);
        $this->db->set('last_modified_time', 'NOW()', FALSE);
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->update('pembayaran_trans_penjualan', $param);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to update pembayaran data
        } else {
            $this->db->trans_commit();
            return $id_pembayaran;
        }
    }

    function update_status_trans_penjualan($id_trans)
    {
        $utama = $this->db->query("SELECT t.*, biaya_penjualan FROM trans_penjualan t JOIN v_trans_penjualan_total_all v ON t.id_trans = v.id_trans WHERE t.id_trans = ?", $id_trans)->row();

        $pembayaran = $this->db->query("SELECT * FROM pembayaran_trans_penjualan WHERE id_trans = ?", $id_trans)->result();
        $pengiriman = $this->db->query("SELECT * FROM pengiriman_trans_penjualan WHERE id_trans = ?", $id_trans)->row();

        $status_transaksi_new = $status_transaksi = $utama->status_transaksi;
        $status_pembayaran_old = $utama->status_pembayaran;
        $status_pengiriman_old = $utama->status_pengiriman;

        // SET STATUS PEMBAYARAN
        $biaya_penjualan = $utama->biaya_penjualan;
        if($status_transaksi == 'BATAL')
            $status_pembayaran_new = 'BATAL';
        else if(empty($pembayaran))
            $status_pembayaran_new = 'MENUNGGU';
        else {
            $paid = 0;
            foreach ($pembayaran as $r){
                $paid += $r->nominal;
            }
            if($paid < $biaya_penjualan)
                $status_pembayaran_new = 'SEBAGIAN';
            else
                $status_pembayaran_new = 'LUNAS';

        }

        // SET STATUS PENGIRIMAN
        if($status_transaksi == 'BATAL')
            $status_pengiriman_new = 'GAGAL';
        else if(empty($pengiriman))
            $status_pengiriman_new = 'MENUNGGU';
        else {
            if($pengiriman->waktu_sampai != NULL)
                $status_pengiriman_new = 'SAMPAI';
            else
                $status_pengiriman_new = 'PROSES';
        }

        // SET STATUS_TRANSAKSI
        if($status_transaksi != 'BATAL') {
            if ($status_pembayaran_new == 'LUNAS' && $status_pengiriman_new == 'SAMPAI')
                $status_transaksi_new = 'SELESAI';
            elseif ($status_pembayaran_new == 'MENUNGGU' && $status_pengiriman_new == 'MENUNGGU')
                $status_transaksi_new = 'PESAN';
            else
                $status_transaksi_new = 'PROSES';
        }

        if($status_pengiriman_new != $status_transaksi
        || $status_pembayaran_new != $status_pembayaran_old
        || $status_pengiriman_new != $status_pengiriman_old)
        {
            // INSERT TO PROSES_TRANS_PENJUALAN
            $id_user = $this->session->userdata('r_userId');
            $param = array(
                'status_transaksi' => $status_transaksi_new,
                'status_pembayaran' => $status_pembayaran_new,
                'status_pengiriman' => $status_pengiriman_new
            );
            $this->db->set("id_trans", $id_trans, FALSE);
            $this->db->set("waktu_proses", 'NOW()', FALSE);
            $this->db->set("id_user", $id_user, FALSE);
            $this->db->insert("proses_trans_penjualan", $param);

            $this->db->set('last_upd_user', $id_user, FALSE);
            $this->db->set('last_upd_time', 'NOW()', FALSE);
            $this->db->where("id_trans", $id_trans);
            $this->db->update("trans_penjualan", $param);
        }
    }

    function delete_pembayaran_trans_penjualan($id_pembayaran, $id_trans)
    {
        $this->db->trans_begin();
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->delete('pembayaran_trans_penjualan');

        $this->update_status_trans_penjualan($id_trans);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE; // Failed to update delete pembayaran data
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}
