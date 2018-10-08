<?php

class M_global extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_data_jenis($tabel, $kolom = null, $id = null)
    {
        if($kolom == null)
            $kolom = ' * ';
        $query = "SELECT ".$kolom." FROM $tabel WHERE is_active = ?";
        $parameters = array();
        $parameters[] = '1';

        if(isset($id)){
            $query .= " AND id_jenis = ? ";
            $parameters[] = $id;
        }
        $query .= " ORDER BY urutan";

        $sql = $this->db->query($query, $parameters);
        return $sql->result();
    }

    function get_enum_values( $table, $field )
    {
        $type = $this->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" );
        if(!empty($type)) {
            $type = $type->row(0)->Type;
            if (strpos($type,"enum") !== false) {
                preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
                $enum = explode("','", $matches[1]);
                return $enum;
            }
            else
                return null;
        }
        else
            return null;
    }

    function get_data_supplier( $id = null )
    {
        $query = "SELECT * FROM supplier WHERE is_active = '1' ";
        $param = array();
        if(isset($id)){
            $query .= " AND id_supplier = ? ";
            $param[] = $id;
        }
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function get_data_pelanggan( $id = null )
    {
        $query = "SELECT * FROM pelanggan WHERE is_active = '1' ";
        $param = array();
        if(isset($id)){
            $query .= " AND id_pelanggan = ? ";
            $param[] = $id;
        }
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function get_data_pegawai( $id = null )
    {
        $query = "SELECT * FROM pegawai WHERE is_active = '1' ";
        $param = array();
        if(isset($id)){
            $query .= " AND id_pegawai = ? ";
            $param[] = $id;
        }
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function get_data_kurir( $id = null )
    {
        $query = "SELECT * FROM pegawai WHERE is_active = '1' AND jabatan = 'Kurir' ";
        $param = array();
        if(isset($id)){
            $query .= " AND id_pegawai = ? ";
            $param[] = $id;
        }
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function get_data_reseller( $id = null )
    {
        $query = "SELECT * FROM pelanggan WHERE is_active = '1' AND is_reseller = '1' ";
        $param = array();
        if(isset($id)){
            $query .= " AND id_pegawai = ? ";
            $param[] = $id;
        }
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }

    function get_data_barang( $id = null )
    {
        $query = "SELECT h.*, (SELECT stok FROM stok_barang sb WHERE sb.id_barang = h.id_barang ORDER BY sb.tgl DESC LIMIT 1) as stok  FROM barang_history h JOIN barang b ON h.id_barang = b.id_barang
WHERE b.is_active = '1'  ";
        $param = array();
        if(isset($id)){
            $query .= " AND h.id_barang = ? ";
            $param[] = $id;
        }
        $query .= ' ORDER BY h.id_barang DESC, h.id_history DESC ';
        $sql = $this->db->query($query, $param);

        return $sql->result();
    }
}
