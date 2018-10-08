<?php

class M_report_penjualan extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function whereHandler2($query, $param, $filter) {

        if(isset($filter['periode'])) {
            $item = $filter['periode'];
            if (!empty($item)) {
                $periode = decode_filter_periode($item);
                if($periode){
                    $query .= " AND tgl BETWEEN ? AND ? ";
                    $param[] = $periode['tanggal_from'].' 00:00:00';
                    $param[] = $periode['tanggal_to'].' 23:59:59';
                }
            }
        }

        if(isset($filter['reseller'])) {
            $item = $filter['reseller'];
            if (!empty($item)) {
                $query .= " AND id_reseller IN ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['pelanggan'])) {
            $item = $filter['pelanggan'];
            if (!empty($item)) {
                $query .= " AND id_pelanggan IN ? ";
                $param[] = $item;
            }
        }

        if(isset($filter['is_reseller'])) {
            $item = $filter['is_reseller'];
            $query .= " AND is_reseller = ? ";
            $param[] = $item;
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

        if(isset($filter['min_laba']) || isset($filter['max_laba'])) {

            $min_laba = $max_laba = 0;
            if (isset($filter['min_laba']))
                $min_laba = $filter['min_laba'];

            if(isset($filter['min_laba']) && !isset($filter['max_laba'])) {
                // Lebih Dari
                $query .= " AND laba_reseller > ? ";
                $param[] = $min_laba;
            } else {
                if (isset($filter['max_laba']))
                    $max_laba = $filter['max_laba'];

                $query .= " AND laba_reseller BETWEEN ? AND ? ";
                $param[] = $min_laba;
                $param[] = $max_laba;
            }
        }

        $result['query'] = $query;
        $result['param'] = $param;
        return $result;
    }

    function get_transaksi_per_hari($is_count = false, $filter = array(), $start = null, $limit = null)
    {
        if($is_count) {
            $kolom = " COUNT(tgl) as jml ";
        } else {
            $kolom = ' * ';
        }

        $query = "SELECT $kolom
                FROM v_penjualan_per_hari
                WHERE 1 ";

        $param = array();
        if(!empty($filter)) {
            $result = $this->whereHandler2($query, $param, $filter);
            $query = $result['query'];
            $param = $result['param'];
        }

        if(!empty($filter) && isset($filter['orderby'])) {
            $item = str_replace("-", " ", $filter['orderby']);
            $query .= " ORDER BY $item";
        } else
            $query .= " ORDER BY tgl DESC";

        if (isset($limit)){
            $query .= " LIMIT $start , $limit";
        }

        $sql = $this->db->query($query, $param);
        if($is_count)
            return $sql->row()->jml;
        else
            return $sql->result();
    }

    function get_transaksi_per_hari_reseller($is_count = false, $filter = array(), $start = null, $limit = null)
    {
        if($is_count) {
            $kolom = " COUNT(view) as jml ";
        } else {
            $kolom = ' v.*, nama ';
        }

        $query = "SELECT $kolom
                FROM v_penjualan_pelanggan_per_hari v 
                JOIN pelanggan p ON v.id_pelanggan = p.id_pelanggan
                WHERE 1 ";

        $param = array();
        if(!empty($filter)) {
            $result = $this->whereHandler2($query, $param, $filter);
            $query = $result['query'];
            $param = $result['param'];
        }

        if(!empty($filter) && isset($filter['orderby'])) {
            $item = str_replace("-", " ", $filter['orderby']);
            $query .= " ORDER BY $item";
        } else
            $query .= " ORDER BY tgl DESC";

        if (isset($limit)){
            $query .= " LIMIT $start , $limit";
        }

        $sql = $this->db->query($query, $param);
        if($is_count)
            return $sql->row()->jml;
        else
            return $sql->result();
    }

    function get_transaksi_per_reseller($is_count = false, $filter = array(), $start = null, $limit = null)
    {
        if($is_count) {
            $kolom = " COUNT(DISTINCT id_reseller) as jml ";
        } else {
            $kolom = ' id_reseller, nama,
                  SUM(tot_laba) as tot_laba, SUM(tot_penjualan) as tot_penjualan ';
        }

        $query = "SELECT $kolom
                FROM v_penjualan_reseller_per_hari v 
                JOIN pelanggan p ON v.id_reseller = p.id_pelanggan
                WHERE 1 ";

        $param = array();
        if(!empty($filter)) {
            $result = $this->whereHandler2($query, $param, $filter);
            $query = $result['query'];
            $param = $result['param'];
        }

        if(!$is_count)
            $query .= " GROUP BY 1,2 ";

        if(!empty($filter) && isset($filter['orderby'])) {
            $item = str_replace("-", " ", $filter['orderby']);
            $query .= " ORDER BY $item";
        } else
            $query .= " ORDER BY nama ASC";

        if (isset($limit)){
            $query .= " LIMIT $start , $limit";
        }

        $sql = $this->db->query($query, $param);
        if($is_count)
            return $sql->row()->jml;
        else
            return $sql->result();
    }

    function get_transaksi_per_hari_pelanggan($is_count = false, $filter = array(), $start = null, $limit = null)
    {
        if($is_count) {
            $kolom = " COUNT(view) as jml ";
        } else {
            $kolom = ' * ';
        }

        $query = "SELECT $kolom
                FROM v_penjualan_pelanggan_per_hari
                WHERE 1 ";

        $param = array();
        if(!empty($filter)) {
            $result = $this->whereHandler2($query, $param, $filter);
            $query = $result['query'];
            $param = $result['param'];
        }

        if(!empty($filter) && isset($filter['orderby'])) {
            $item = str_replace("-", " ", $filter['orderby']);
            $query .= " ORDER BY $item";
        } else
            $query .= " ORDER BY tgl DESC";

        if (isset($limit)){
            $query .= " LIMIT $start , $limit";
        }

        $sql = $this->db->query($query, $param);
        if($is_count)
            return $sql->row()->jml;
        else
            return $sql->result();
    }

    function get_transaksi_per_pelanggan($is_count = false, $filter = array(), $start = null, $limit = null)
    {
        if($is_count) {
            $kolom = " COUNT(DISTINCT id_pelanggan) as jml ";
        } else {
            $kolom = ' id_pelanggan, nama,
                  SUM(total_harga) as total_harga, SUM(diskon) as diskon,
                  SUM(biaya_tambahan) as biaya_tambahan, SUM(biaya_pembatalan) as biaya_pembatalan,
                  SUM(biaya_pengiriman) as biaya_pengiriman ';
        }

        $query = "SELECT $kolom
                FROM v_penjualan_per_pelanggan
                WHERE 1 ";

        $param = array();
        if(!empty($filter)) {
            $result = $this->whereHandler2($query, $param, $filter);
            $query = $result['query'];
            $param = $result['param'];
        }

        if(!$is_count)
            $query .= " GROUP BY 1,2 ";

        if(!empty($filter) && isset($filter['orderby'])) {
            $item = str_replace("-", " ", $filter['orderby']);
            $query .= " ORDER BY $item";
        } else
            $query .= " ORDER BY nama ASC";

        if (isset($limit)){
            $query .= " LIMIT $start , $limit";
        }

        $sql = $this->db->query($query, $param);
        if($is_count)
            return $sql->row()->jml;
        else
            return $sql->result();
    }
}
