<?php

class M_report_pembelian extends CI_Model {

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

        if(isset($filter['supplier'])) {
            $item = $filter['supplier'];
            if (!empty($item)) {
                $query .= " AND id_supplier IN ? ";
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

    function get_transaksi_per_hari_supplier($is_count = false, $filter = array(), $start = null, $limit = null)
    {
        if($is_count) {
            $kolom = " COUNT(view) as jml ";
        } else {
            $kolom = ' v.*, nama ';
        }

        $query = "SELECT $kolom
                FROM v_pembelian_supplier_per_hari v 
                JOIN supplier s ON v.id_supplier = s.id_supplier 
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

}
