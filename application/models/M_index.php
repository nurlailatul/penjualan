<?php

class M_index extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_stok_opname_all_cabang()
    {
        $this->load->model('M_global','global');
        $cabang_list = $this->global->get_cabang_list();

        $array = array();
        foreach ($cabang_list as $r){
            if($this->input->get("cabang")){
                $id_cabang = $this->input->get("cabang");
                if(in_array($r->id_cabang, $id_cabang) == false)
                    continue;
            }

            $datastok = $this->global->get_data_stok_opname($r->id_cabang);
            $jenis_stok = $this->global->get_stok_opname_type();
            $sub_array = array();
            $sub_array['nama_cabang'] = $r->nama_cabang;
            foreach ($jenis_stok as $t){
                $nama = $t['jenis'];
                if(empty($datastok))
                    $stok = '0';
                else
                    $stok = $datastok[$nama];

                $sub_array[$nama] = $stok;
            }
            $array[] = $sub_array;
        }

        return $array;
    }
	
	function my_account($userId){
		$param = array();
        $param[] = $userId;

        $result = $this->db->query("SELECT u.id_user, u.username, u.real_name, u.email 
        FROM user u 
        WHERE u.id_user = ?", $param);
		
		$base = $result->first_row();
		
		$result = $this->db->query("SELECT u.id_user, u.real_name, u.email, u.id_group, lg.nama_group, lg.keterangan  
                      FROM user u
                      JOIN login_group lg ON u.id_group = lg.id_group AND lg.is_active = '1' 
                      WHERE u.id_user = ?", $param);
		
		$group = $result->result();
		
		$result = new stdclass();
		$result->id_user = $base->id_user;
		$result->username = $base->username;
		$result->real_name = $base->real_name;
		$result->email = $base->email;
		$result->group = $group;
		
		return $result;
	}
	
	function update_my_account($data, $isPassword = false){
		if($isPassword){
			$query = "UPDATE user SET email = ?, real_name = ?, password = SHA2(?, 256) WHERE id_user = ?";
		} else {
			$query = "UPDATE user SET email = ?, real_name = ? WHERE id_user = ?";
		}
		
		$status = $this->db->query($query, $data);
		return $status;
	}
}
