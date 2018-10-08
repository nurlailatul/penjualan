<?php

class M_user extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function data_user($is_count = false, $limit = null, $start = null, $id = null)
    {
        if($is_count){
			$query = "SELECT COUNT(id_user) AS jumlah";
		} else {
			$query = "SELECT u.*, GROUP_CONCAT(ug.id_group SEPARATOR '|') AS id_grup, GROUP_CONCAT(lg.nama_group SEPARATOR '|') AS nama_grup, GROUP_CONCAT(lg.keterangan SEPARATOR '|') AS ket_grup";
		}
		
		$query .= " FROM user u ";
		
		if(!$is_count){
			$query .= " LEFT JOIN user_group ug ON u.id_user = ug.id_user 
						LEFT JOIN login_group lg ON ug.id_group = lg.id_group";
		}
		
		$query .= " WHERE u.is_active = '1'";
		
		$where = $this->where_handler($is_count);
		
		$query .= $where[0];
		$param = $where[1];
		
		if($id != null){
			$query .= " AND u.id_user = ? ";
			$param[] = $id;
		}

        if(!$is_count) {
            $query .= " GROUP BY u.id_user";
        }
		
		if (isset($limit)){ $query .= " LIMIT $start, $limit"; }
		
		$result = $this->db->query($query, $param);
		
		if($is_count){
			if(!empty($result->row())){
				return $result->row()->jumlah;
			} else {
				return 0;
			}
		} else {
			if($id != null){
				return $result->row();
			} else {
				return $result->result();
			}
		}
    }
	
	function where_handler($is_count = false){
		$query = '';
		$param = array();
		$nama = $this->input->get('uname');
		$group = $this->input->get('role');
		$uid = intval($this->input->get('uid'));
		
		if($nama){
			$query .= ' AND (username LIKE ? OR email LIKE ?)';
			$param[] = '%' . $nama . '%';
			$param[] = '%' . $nama . '%';
		}
		
		if($group && !$is_count){
			$isAll = false;
			foreach($group as $array_key=>$array_item)
			{
				if($group[$array_key] == 0)
				{
					$isAll = true;
					break;
				}
			}
			
			if(!$isAll){
				$query .= ' AND ug.id_group IN ?';
				$param[] = $group;
			}			
		}
		
		if($uid){
			$query .= ' AND u.id_user = ?';
			$param[] = $uid;
		}

        if(in_array("user.read own", $this->session->userdata("r_userMenus"))) {
            $id_user = $this->session->userdata("r_userId");
            $query .= ' AND u.id_user = ? ';
            $param[] = $id_user;
        }
		
		return array($query, $param);
	}
	
	function role_user(){
		$query = "SELECT * FROM login_group WHERE is_active = '1' ORDER BY id_group ASC";
		
		$result = $this->db->query($query);
		return $result->result();
	}
	
	function get_user_group($id_user){
		$query = "SELECT lg.id_group, lg.nama_group, lg.keterangan FROM user_group ug LEFT JOIN login_group lg ON ug.id_group = lg.id_group WHERE lg.is_active = '1' AND ug.id_user = ? ORDER BY ug.id_group ASC";
		
		$result = $this->db->query($query, $id_user);
		return $result->result();
	}
	
	function check_user($field, $value, $thisId = false){
		$param = array();
		$param[] = $value;
		
		$query = "SELECT COUNT(id_user) AS jumlah FROM user WHERE $field = ?";
		
		if($thisId){
			$query .= " AND id_user <> ?";
			$param[] = $thisId;
		}
		
		$result = $this->db->query($query, $param);
		return $result->row()->jumlah;
	}
	
	function save_user($data, $isEdit = false, $isPassword = false){
		$this->db->trans_begin();
		
		$param = array();
		
		$param[] = $data['username'];
		$param[] = $data['email'];
		$param[] = isset($data['real_name']) ? $data['real_name'] : null;
		$param[] = $this->session->userdata('r_userId');
		$param[] = $data['password'];
		
		if(!$isEdit){ // CREATE
			
			$query = "INSERT INTO user (username, email, real_name, last_modified_user, password) VALUES (?, ?, ?, ?, SHA2(?, 256))";
			
		} else {
			// COPY TO TABLE HISTORY
			$query = "SELECT * FROM user WHERE id_user = ?";
			
			$before = $this->db->query($query, $data['id_user'])->row();
			
			$copyparam = array();
			$copyparam[] = $before->id_user;
			$copyparam[] = $before->username;
			$copyparam[] = $before->email;
			$copyparam[] = $before->real_name;
			$copyparam[] = $before->password;
			$copyparam[] = $before->is_active;
			$copyparam[] = $before->last_modified_user;
			$copyparam[] = $before->last_modified_time;
			
			$query = "INSERT INTO user_history (id_user, username, email, real_name, password, is_active, last_modified_user, last_modified_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		
			$this->db->query($query, $copyparam);
			// END COPY
			
			if($isPassword){
				$query = "UPDATE user SET username = ?, email = ?, real_name = ?, last_modified_user = ?, password = SHA2(?, 256), is_active = '1', last_modified_time = NOW() WHERE id_user = ?";
				
				$param[] = $data['id_user'];
			} else {
				$query = "UPDATE user SET username = ?, email = ?, real_name = ?, is_active = '1', last_modified_user = ?, last_modified_time = NOW() WHERE id_user = ?";
				
				$this->update_last($param, $data['id_user']);
			}
		}
		
		$this->db->query($query, $param);
		
		if(!$isEdit){
			$id = $this->db->insert_id();
		} else {
			$id = $data['id_user'];
		}
		
		$query = "DELETE FROM user_group WHERE id_user = ?";
		
		$this->db->query($query, $id);
		
		foreach($data['role'] as $r){
			
			$param = array();
			$param[] = $id;
			$param[] = $r;
			
			$query = "INSERT INTO user_group (id_user, id_group) VALUES (?, ?)";
			
			$this->db->query($query, $param);
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
			return $id;
        }
	}
	
	function delete($id){
		$this->copyHistory($id); // COPY HISTORY FIRST
		
		$query = "UPDATE user SET is_active = '0', last_modified_user = ?, last_modified_time = NOW() WHERE id_user = ?";
		
		$param = array();
		$param[] = $this->session->userdata('r_userId');
		$param[] = $id;
		
		return $this->db->query($query, $param);
	}
	
	function copyHistory($id_user){
		$query = "SELECT * FROM user WHERE id_user = ?";
			
		$before = $this->db->query($query, $id_user)->row();
		
		$copyparam = array();
		$copyparam[] = $before->id_user;
		$copyparam[] = $before->username;
		$copyparam[] = $before->email;
		$copyparam[] = $before->real_name;
		$copyparam[] = $before->password;
		$copyparam[] = $before->is_active;
		$copyparam[] = $before->last_modified_user;
		$copyparam[] = $before->last_modified_time;
		
		$query = "INSERT INTO user_history (id_user, username, email, real_name, password, is_active, last_modified_user, last_modified_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	
		return $this->db->query($query, $copyparam);
	}
	
	function update_last(&$array, $value){
		array_pop($array);
		array_push($array, $value);     
	}
}
