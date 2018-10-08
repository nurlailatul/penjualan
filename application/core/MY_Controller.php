<?php

class BaseController extends CI_Controller {

    protected $template = "app";
    protected $module = "";
    protected $data = array();

    public function __construct() {

        parent::__construct();
        $this->load->library('Global_function');
        $this->load->library('global_variable');
        $this->load->model('m_global');
        $app_name = 'Sistem Informasi Toko';
        $this->session->set_userdata("r_app_name", $app_name);
        $this->data['app_name'] = $app_name;

        $this->data['url_param'] = $_SERVER['QUERY_STRING'];

        if($this->input->get())
            $this->data['is_filter'] = true;

        $userId = $this->session->userdata('r_userId');
        $idGroup = $this->session->userdata("r_idGroup");

        if (uri_string() == "" && $this->input->post("login-button") != null) { // login form submit
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $this->data["user_temp"] = $username;
            $this->data["pass_temp"] = $password;

            $result = $this->db->query("SELECT u.id_user, u.real_name, u.email, u.id_group, lg.nama_group  
                      FROM user u
                      JOIN login_group lg ON u.id_group = lg.id_group AND lg.is_active = '1' 
                      WHERE (u.email = ? OR u.username = ?) 
                      AND u.password = SHA2(?, 256) 
                      AND u.is_active = 1", array($username,$username, $password));

            if ($result->num_rows() == 0) {
                $this->data["errorMessage"] = "Login gagal, cek kembali akun login Anda!";
                $this->template = "login";
                $this->render("login");
            } else {
                $row = $result->first_row();

                $this->session->set_userdata("r_username", $username);
                $this->session->set_userdata("r_realName", $row->real_name);
                $this->session->set_userdata("r_email", $row->email);

                $this->session->set_userdata("r_userId", $row->id_user);
                $this->session->set_userdata("r_idGroup", $row->id_group);
                $this->session->set_userdata("r_groupName", $row->nama_group);

                $this->get_list_akses_modul_of_group();
                $this->setUserData();

            }
        } else if (!$userId && uri_string() == "") { // Accessing index page and there is no user session (login form state)
            redirect(site_url()."/login/pendataan");
        } else if (!$idGroup && (uri_string() == "login/pendataan" || uri_string() == "login/pemantauan")) { // Accessing index page and there is no user session (login form state)
            $this->template = "login";

            $appname = $this->uri->segment(2);
            $this->session->set_userdata("r_app_name",$appname);
            if ($this->input->get("access_without_login") == "true") {
                $this->data["errorMessage"] = "Session anda telah berakhir, silahkan login kembali untuk masuk ke dashboard.";
            } else if ($this->input->get("logout") == "true") {
                $this->data["successMessage"] = "Anda telah keluar.";
            } else if ($this->input->get("forgot_password") == "true") {
                $this->data["successMessage"] = "Password anda berhasil diperbarui. Silahkan login dengan password baru.";
            } else if ($this->input->get("no_module") == "true") {
                $this->data["errorMessage"] = "Maaf modul untuk group tersebut belum tersedia. 
                                        Silahkan login menggunakan role lain.";
            }

            $this->render("login");
        } else if (!$userId && !in_array(uri_string(), array("", "forgot_password", "forgot_password_reset", "logout", "frontend/galeri")
            ) && (explode('/',uri_string())[0] != 'frontend')) { // Accessing user page and there is no user session
            redirect("?access_without_login=true");
        } else if ($userId != null && $idGroup != null) { // Accessing user page and there is user session
            $this->setUserData();
            $this->SethasPermissionAct();
        }


        if (is_array($this->input->get())) {
            foreach ($this->input->get() as $key => $value) {
                $this->data[$key] = $value;
            }
        }

        if (is_array($this->input->post())) {
            foreach ($this->input->post() as $key => $value) {
                if ($key == "description" || $key == "email" || $key == "is_active" || $key == "is_soft_delete" || $key == "username" || $key == "real_name") {
                    $this->data[$key . "Input"] = $value;
                } else {
                    $this->data[$key] = $value;
                }
            }
        }
    }

    protected function setUserData() {
        $this->data["userId"] = $this->session->userdata("r_userId");
        $this->data["username"] = $this->session->userdata("r_username");
        $this->data["realName"] = $this->session->userdata("r_realName");
        $this->data["email"] = $this->session->userdata("r_email");
        $this->data["idGroup"] = $this->session->userdata("r_idGroup");
        $this->data["groupName"] = $this->session->userdata("r_groupName");
        $this->data["userMenus"] = $this->session->userdata("r_userMenus");
    }

    protected function unSetUserData() {
        $this->session->unset_userdata("r_userId");
        $this->session->unset_userdata("r_username");
        $this->session->unset_userdata("r_realName");
        $this->session->unset_userdata("r_email");
        $this->session->unset_userdata("r_idGroup");
        $this->session->unset_userdata("r_groupName");
        $this->session->unset_userdata("r_userMenus");
    }

    protected function render($filename = null, $sub_folder = null) {

        $template = $this->load->view("template/" . $this->template, $this->data, true);

        $content = $this->load->view(($this->module != "" ? $this->module . "/" : "index/").(isset($sub_folder) ? $sub_folder. "/" : "") . $filename, $this->data, true);

        exit(str_replace("{CONTENT}", $content, $template));
    }

    function get_list_akses_modul_of_group()
    {
        if (!empty($this->session->userdata("r_idGroup"))) {
            $result = $this->db->query("SELECT DISTINCT nama_modul, hak_akses 
                                FROM akses_group_modul 
                                WHERE id_group = ? 
                                ORDER BY nama_modul", array($this->session->userdata("r_idGroup")));

            $userMenus = array();
            foreach ($result->result() as $row) {
                $userMenus[] = $row->nama_modul . "." . $row->hak_akses;
            }
            $this->session->set_userdata("r_userMenus", $userMenus);
        }
    }

    protected function SethasPermissionAct(){
        $this->data['readAct'] = true;
        $this->data['readActOwn'] = true;
        $this->data['createAct'] = true;
        $this->data['createActOwn'] = true;
        $this->data['updateAct'] = true;
        $this->data['updateActOwn'] = true;
        $this->data['deleteAct'] = true;
        $this->data['deleteActOwn'] = true;

        $permRead= $this->module."."."read";
        $permReadOwn= $this->module."."."read own";
        $permCreate= $this->module."."."create";
        $permCreateOwn= $this->module."."."create own";
        $permUpdate= $this->module."."."update";
        $permUpdateOwn= $this->module."."."update own";
        $permDelete= $this->module."."."delete";
        $permDeleteOwn= $this->module."."."delete own";

        if (in_array($permRead, $this->data["userMenus"]) == 0 ) {
            $this->data['readAct'] = false;
        }
        if (in_array($permReadOwn, $this->data["userMenus"]) == 0 ) {
            $this->data['readActOwn'] = false;
        }
        if (in_array($permCreate, $this->data["userMenus"]) == 0 ) {
            $this->data['createAct'] = false;
        }
        if (in_array($permCreateOwn, $this->data["userMenus"]) == 0 ) {
            $this->data['createActOwn'] = false;
        }
        if (in_array($permUpdate, $this->data["userMenus"]) == 0 ) {
            $this->data['updateAct'] = false;
        }
        if (in_array($permUpdateOwn, $this->data["userMenus"]) == 0 ) {
            $this->data['updateActOwn'] = false;
        }
        if (in_array($permDelete, $this->data["userMenus"]) == 0 ) {
            $this->data['deleteAct'] = false;
        }
        if (in_array($permDeleteOwn, $this->data["userMenus"]) == 0 ) {
            $this->data['deleteActOwn'] = false;
        }
    }

    protected function hasPermission($PermName1 = "", $PermName2 = "", $PermName3 = "", $PermName4 = "")
    {
        if ($this->module != NULL && $this->module != 'index') {
            $hasPermission = $this->process_hasPermission($PermName1, $PermName2, $PermName3, $PermName4);
            if (!$hasPermission) {
                $message = "Maaf, Anda tidak memiliki akses ke halaman ini.";
                echo "<script language=javascript>alert('$message');window.history.back();</script>";
                die();
            } else {
                return true;
            }
        }
    }

    protected function checkHasPermission($PermName1 = "", $PermName2 = "", $PermName3 = "", $PermName4 = "")
    {
        if ($this->module != NULL && $this->module != 'index') {
            $hasPermission = $this->process_hasPermission($PermName1, $PermName2, $PermName3, $PermName4);
            return $hasPermission;
        } else {
            return true;
        }
    }

    protected function process_hasPermission($PermName1 = "", $PermName2 = "", $PermName3 = "", $PermName4 = ""){
        $hasPermission = false;
        for($i=1; $i <= 4; $i++){
            if(in_array($this->module .'.'.${'PermName'.$i}, $this->data["userMenus"]) != 0) {
                $hasPermission = true;
                break;
            }
        }
        if(!$hasPermission){
            // Set for own (Read own, update own, delete own)
            for($i=1; $i <= 4; $i++){
                if(in_array($this->module .'.'.${'PermName'.$i}.' own', $this->data["userMenus"]) != 0) {
                    $hasPermission = true;
                    break;
                }
            }
        }
        return $hasPermission;
    }

}
