<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends BaseController {

    protected $module = "user";
    protected $title = "User";
	protected $per_page = 20;

    public function __construct() {
        parent::__construct();
		$this->load->model('m_user', 'model');
    }

    public function index()
    {
        $this->hasPermission('read');
        $this->data['halaman'] = $this->title;
        $this->data['data_user_group'] = $this->model->role_user();
		
		$total = $this->model->data_user(true);
		
		//CONFIG PAGINATION
        $this->load->library('pagination');

        $base_url = site_url('unit/user/index');
		$per_page = $this->per_page;

        $settings = $this->config->item('pagination');

        $settings["base_url"]           = $base_url;
        $settings['total_rows']         = $total;
        $settings['per_page']           = $per_page;
        $settings['reuse_query_string'] = FALSE;
        if (count($_GET) > 0)
            $settings['suffix'] = '?' . http_build_query($_GET, '', "&");

        $settings['first_url']          = $settings['base_url'] . '?' . http_build_query($_GET);
        $settings['uri_segment']        = 4;

        if ($this->uri->segment(4)) {
            $this->cur_page = $page = ($this->uri->segment(4));
        } else {
            $this->cur_page = $page = 0;
        }

        $this->pagination->initialize($settings);
        $this->data['link_paging']  = $this->pagination->create_links();

        $this->data['per_page']     = $per_page;
        $this->data['data']         = $this->model->data_user(false, $per_page, $page);
        //END CONFIG PAGINATION

        $this->render("index");
    }

    function create_edit($id = null)
    {
        $this->hasPermission('create','update');
		$halaman = 'Buat ';
		
		if($id != null){
			$detail = $this->model->data_user(false, null, null, $id);		
			$data['detail'] = $detail;
			$data['id'] = $id;
			$halaman = 'Edit ';
		}
		
        $data['halaman'] = $halaman . $this->title;
		$data['role_list'] = $this->model->role_user();
		
        $this->load->view('user/create_edit', $data);
    }
	
	function save(){
        $this->hasPermission('create','update');
		$callback = 'unit/user';
		
		if($this->input->post()){
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$role = $this->input->post('role');
			$changepass = $this->input->post('change_password');
			$pass = $this->input->post('pass');
			$vpass = $this->input->post('vpass');
			$id = $this->input->post('editId');
			
			if($this->input->post('callback')){
				$callback = $this->input->post('callback');
			}
			
			$isOverriden = false;
			$isValid = false;
			
			$data = array(
				"username" => $username,
				"email" => $email,
				"password" => $pass,
				"id_user" => $id,
				"role" => $role,
				"changepass" => $changepass,
			);
			
			if($id){
				$errorInfo = 'diperbarui';
				$isChange = false;
				
				if($changepass){
					if(!$pass || !$vpass){
						$this->session->set_flashdata('warning_modal', 'Jika ingin merubah password, field password tidak boleh kosong!');
						$isOverriden = true;
					} else if($pass != $vpass){
						$this->session->set_flashdata('warning_modal', 'Konfirmasi Password tidak sesuai dengan Password Baru!');
						$isOverriden = true;
					} else {
						$isValid = true;
						$isChange = true;
					}
				} else {
					$isValid = true;
				}
				
				$check_email = $this->model->check_user('email', $email, $id);
				
				if($check_email > 0){
					$this->session->set_flashdata('warning_modal', 'Email yang Anda pilih telah digunakan oleh Orang lain. Silahkan pilih alternatif lain.');
					$isOverriden = true;
					$isValid = false;
				}
				
				if($isValid){
					$status = $this->model->save_user($data, true, $isChange);
				}
			} else { // CREATE	
				$errorInfo = 'disimpan';
				if(!$pass || !$vpass){
					$this->session->set_flashdata('warning_modal', 'Password tidak boleh Kosong!');
					$isOverriden = true;
				} else if($pass != $vpass){
					$this->session->set_flashdata('warning_modal', 'Konfirmasi Password tidak sesuai dengan nilai Password User!');
					$isOverriden = true;
				} else {
					$isValid = true;
				}
				
				$check_email = $this->model->check_user('email', $email);
				$check_username = $this->model->check_user('username', $username);
				
				$error = '';
				if($check_email > 0){
					$error = 'Email';
				} else if($check_username > 0){
					$error = 'Username';
				}
				
				if($error != ''){
					$this->session->set_flashdata('warning_modal', $error . ' yang Anda pilih telah digunakan oleh Orang lain. Silahkan pilih alternatif lain.');
					$isOverriden = true;
					$isValid = false;
				}
				
				if($isValid){
					$status = $this->model->save_user($data);
				}
			}
			
			if ($status) {
				$this->session->set_flashdata('msg', "Data ".$this->title." berhasil ".$errorInfo."!");
			} else {
				if(!$isOverriden){
					$this->session->set_flashdata('msgw', "Data ".$this->title." gagal ".$errorInfo."!");
				}
			}
		}
		
		$this->session->set_flashdata('temp_data', $data);
		
		redirect($callback);
	}

    function hapus($id)
    {
        $this->hasPermission('delete');
        $status = $this->model->delete($id);;

        if ($status) {
            $this->session->set_flashdata('msg', $this->title." berhasil dihapus!");
        } else {
            $this->session->set_flashdata('msgw', $this->title." gagal dihapus!");
        }
        redirect('unit/user');

    }

}
