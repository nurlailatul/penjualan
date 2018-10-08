<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends BaseController {

    protected $template = "app";

    public function __construct() {
        parent::__construct();
        $this->load->model('m_index');
        $this->load->model('m_global');
        $this->load->library('global_variable');
        $this->load->library('email_handler');

    }

    public function index() {
        $this->data['halaman'] = "Beranda";

        $idGroup = $this->session->userdata('r_idGroup');
        if(!$idGroup || $idGroup == null){
            redirect('login');
        }

        /*$data = $this->db->query("SELECT * FROM kegiatan_ruswa
                WHERE is_active = 1")->result();*/
        $this->data['data_kegiatan'] = array ( 0 => array( 'id_kegiatan_ruswa' => '1', 'nama' => 'RUMAH TAPAK TIPE 36', 'kecamatan' => 'SIDAYU', 'sasaran' => 'a. Meningkatnya pengembangan kebijakan dan koordinasi pelaksanaan kebijakan, penyusunan kebijakan, program dan anggaran, kerjasama, data dan informasi serta evaluasi kinerja pengembangan perumahan, dan b. Terwujudnya keswadayaan masyarakat untuk peningkatan kualitas dan pembangunan rumah/hunian yang layak bagi 70.000 Masyarakat Berpenghasilan Rendah (MBR) dalam lingkungan yang aman, sehat, teratur dan serasi.', 'manfaat' => 'Tujuan Direktorat Rumah Swadaya merupakan rumusan kondisi yang hendak dituju di akhir perode perencanaan. Tujuan Direktorat Rumah Swadaya pada tahun 2016 adalah menurunkan angka kekurangan rumah (backlog) melalui Pembangunan Baru sebesar 20.000 unit dan penurunan jumlah Rumah Tidak Layak Huni melalui Peningkatan Kualitas sebesar 50.000 unit.', 'keluaran' => 'a. Meningkatkan pengembangan kebijakan dan koordinasi pelaksanaan kebijakan untuk mendorong terciptanya iklim yang kondusif dalam pembangunan perumahan, termasuk dukungan kebijakan penyediaan perumahan bagi masyarakat berpenghasilan rendah. b. Menyelenggarakan penyediaan perumahan untuk memenuhi kebutuhan hunian yang layak, melalui fasilitasi pembangunan baru dan peningkatan kualitas rumah layak huni. c. Meningkatkan peran pemerintah daerah dan pemangku kepentingan lainnya dalam pembangunan perumahan.', 'keterangan' => NULL, 'estimasi_tanggal_mulai' => '2018-01-12', 'estimasi_tanggal_selesai' => '2018-09-12', 'last_modified_user' => '1', 'last_modified_time' => '2018-04-03 13:52:46', 'is_active' => '1', ), 1 => array( 'id_kegiatan_ruswa' => '2', 'nama' => 'RUMAH TINGGAL TUNGGAL SEDERHANA', 'kecamatan' => 'BENJENG', 'sasaran' => 'Mewujudkan rencana teknik dan standarisasi di bidang penyelenggaraan bantuan rumah swadaya 1. Menyiapkan penyusunan rencana teknik di bidang penyelenggaraan bantuan rumah swadaya 2. Menyiapkan penyusunan standarisasi di bidang penyelenggaraan bantuan rumah swaday ', 'manfaat' => 'Rencana Strategis Direktorat Rumah Swadaya merupakan penjabaran dari. Renstra Direktorat Jenderal Penyediaan Perumahan 2015 – 2019 yang diharapkan menjadi kerangka acuan dan pedoman pelaksanaan dalam penyusunan kebijakan, perencanaan, program dan anggaran serta kegiatan tahunan bidang', 'keluaran' => 'Menyiapkan fasilitasi pendataan dan verifikasi data backlog rumah swadaya dan Rumah Tidak Layak Huni di bidang penyelenggaraan bantuan rumah swadaya. 1. Menyiapkan fasilitasi pendataan backlog rumah swadaya dan Rumah Tidak Layak Huni dibidang penyelenggaraan bantuan rumah swadaya 2. Menyiapkan verifikasi data backlog rumah swadaya dan Rumah Tidak Layak Huni di bidang penyelenggaraan bantuan rumah swadaya', 'keterangan' => NULL, 'estimasi_tanggal_mulai' => '2018-01-12', 'estimasi_tanggal_selesai' => '2018-09-12', 'last_modified_user' => '1', 'last_modified_time' => '2018-04-03 13:55:57', 'is_active' => '1', ), 2 => array( 'id_kegiatan_ruswa' => '3', 'nama' => 'RUMAH KOPPEL 25 UNIT', 'kecamatan' => 'BUNGAH', 'sasaran' => 'Menyiapkan fasilitasi pemberdayaan masyarakat hasil pendataan dan fasilitasi akses kemitraan untuk mendapat bantuan di bidang penyelenggaraan bantuan rumah swadaya.', 'manfaat' => 'Terwujudnya keswadayaan masyarakat untuk peningkatan kualitas dan pembangunan rumah/hunian yang layak bagi 70.000 Masyarakat Berpenghasilan Rendah (MBR) dalam lingkungan yang aman, sehat, teratur dan serasi', 'keluaran' => '1. Menyiapkan fasilitasi pemberdayaan masyarakat hasil pendataan backlog rumah swadaya dan Rumah Tidak Layak Huni 2. Menyiapkan fasilitasi akses kemitraan untuk mendapat bantuan di bidang penyelenggaraan bantuan rumah swadaya', 'keterangan' => NULL, 'estimasi_tanggal_mulai' => '2018-01-12', 'estimasi_tanggal_selesai' => '2018-09-12', 'last_modified_user' => '1', 'last_modified_time' => '2018-04-03 13:55:57', 'is_active' => '1', ));

        $this->render("index");
    }

    public function login($appname = null){
        $this->template = "login";

        if ($this->input->get("access_without_login") == "true") {
            $this->data["errorMessage"] = "Session anda telah berakhir, silahkan login kembali untuk masuk ke dashboard.";
        } else if ($this->input->get("logout") == "true") {
            $this->data["successMessage"] = "Anda telah keluar.";
        } else if ($this->input->get("forgot_password") == "true") {
            $this->data["successMessage"] = "Password anda berhasil diperbarui. Silahkan login dengan password baru.";
        }

        $this->render("login");
    }

    public function profile() {
        $this->data["changePassword"] = $this->input->post("change_password");
        if ($this->input->post("submit-button")) {
            if ($this->input->post("username") == null || $this->input->post("username") == "") {
                $this->data["errorUsernameMessage"] = "Username tidak boleh kosong";
            }
            if ($this->input->post("email") == null || $this->input->post("email") == "") {
                $this->data["errorEmailMessage"] = "Email tidak boleh kosong";
            }

            if ($this->input->post("change_password") != null && $this->input->post("change_password") == 1) {
                if ($this->input->post("password") == null || $this->input->post("password") == "") {
                    $this->data["errorPasswordMessage"] = "Password tidak boleh kosong";
                }

                if ($this->input->post("confirm") == null || $this->input->post("confirm") == "") {
                    $this->data["errorConfirmMessage"] = "Konfirmasi password tidak boleh kosong";
                } else if ($this->input->post("confirm") != null && $this->input->post("confirm") != "" && $this->input->post("password") != $this->input->post("confirm")) {
                    $this->data["errorConfirmMessage"] = "Konfirmasi Password tidak sesuai dengan Password baru";
                }
            }

            $checkPasswowrd = $this->db->query("SELECT id_user FROM user WHERE id_user = ? AND password = SHA2(?, 256)", array($this->session->userdata("r_userId"), $this->input->post("password_old")))->num_rows();
            if($checkPasswowrd == 0){
                $this->data["errorPasswordOldMessage"] = "Password lama tidak sesuai";
            }

            if (!isset($this->data["errorUsernameMessage"]) && !isset($this->data["errorEmailMessage"]) && !isset($this->data["errorPasswordMessage"]) && !isset($this->data["errorConfirmMessage"]) && !isset($this->data['errorPasswordOldMessage'])) {
                $status = false;
                if ($this->input->post("change_password") != null && $this->input->post("change_password") == 1) {
                    
					$data = array(
						$this->input->post("email"), 
						$this->input->post("real_name"), 
						$this->input->post("password"), 
						$this->session->userdata("r_userId")
						);
					
					$status = $this->m_index->update_my_account($data, true);
                    $this->session->set_userdata("r_realName", $this->input->post("real_name"));
					
                } else {
					
					$data = array(
						$this->input->post("email"), 
						$this->input->post("real_name"), 
						$this->session->userdata("r_userId")
						);
					
					$status = $this->m_index->update_my_account($data, false);
                    $this->session->set_userdata("r_realName", $this->input->post("real_name"));
					
				}

                if ($status) {
                    $this->data["successMessage"] = "Profile berhasil diperbarui";
                } else {
                    $this->data["errorMessage"] = "Update Profile Gagal, silahkan coba lagi.";
                }
            } else {
                $this->data["errorMessage"] = "Gagal melakukan update profile, silahkan periksa informasi pada field di bawah ini.";
            }
        }

        $my_account = $this->m_index->my_account(intval($this->session->userdata("r_userId")));
		$this->data["detail"] = array(
			"id" => $my_account->id_user,
			"group" => $my_account->group,
			"real_name" => $my_account->real_name,
			"username" => $my_account->username,
			"email" => $my_account->email,
		);

        $this->render("profile");
    }

    public function forgot_password() {
        $this->template = "login";

        if ($this->input->post("reset-button")) {
            $result = $this->db->query("SELECT id_user FROM user WHERE email = ? AND is_active = '1'", array($this->input->post("email")));

            if ($result->num_rows() == 0) {
                $personil = $this->db->query("SELECT id_personil FROM personil WHERE email = ? AND is_active = '1'", array($this->input->post("email")));

                if ($personil->num_rows() == 0) {
                    $this->data["errorMessage"] = "Email tidak ditemukan/tidak valid.";
                } else {
                    $status = $this->db->query("INSERT INTO reset_password (email, reset_code, request_time) VALUES (?, SHA2(CAST(RAND() AS CHAR), 256), NOW())", array($this->input->post("email")));

                    if ($status) {
                        $result = $this->db->query("SELECT reset_code, request_time, email FROM reset_password WHERE email = ? ORDER BY request_time DESC LIMIT 1", array($this->input->post("email")));

                        if ($result->num_rows() > 0) {
                            $row = $result->first_row();

                            $requestTime = set_indo_date($row->request_time) . " pukul " . get_time_from_timestamp($row->request_time) . " WIB";
                            $resetUrl = site_url("forgot_password_reset?token=" . $row->reset_code . "&email=" . $this->input->post("email"));

                            $emailContent = $this->load->view("index/forgot_password_email", array("resetUrl" => $resetUrl, "username" => $row->email, "requestTime" => $requestTime), true);

                            $status = $this->send_email_aktifasi($row->email, "Reset Password", $emailContent);

                            if ($status) {
                                $statusReset = $this->db->query("UPDATE reset_password SET sent_time = NOW() WHERE email = ? AND reset_time IS NULL", array($row->email));

                                if ($statusReset) {
                                    $this->data["successMessage"] = "Instruksi untuk reset password telah dikirim ke email anda.";
                                } else {
                                    $this->data["errorMessage"] = "Gagal memperbarui reset sent time, silahkan coba lagi.";
                                }
                            } else {
                                $this->data["errorMessage"] = "Gagal mengirim reset code ke email anda, silahkan coba lagi.";
                            }
                        } else {
                            $this->data["errorMessage"] = "Gagal membuat reset code, silahkan coba lagi.";
                        }
                    } else {
                        $this->data["errorMessage"] = "Fail to create reset code, please try again.";
                    }
                }
            } else {
                $status = $this->db->query("INSERT INTO reset_password (email, reset_code, request_time) VALUES (?, SHA2(CAST(RAND() AS CHAR), 256), NOW())", array($this->input->post("email")));

                if ($status) {
                    $result = $this->db->query("SELECT a.reset_code, a.request_time, a.email, b.email FROM reset_password a INNER JOIN user b ON a.email = b.email WHERE a.email = ? ORDER BY a.request_time DESC LIMIT 1", array($this->input->post("email")));

                    if ($result->num_rows() > 0) {
                        $row = $result->first_row();

                        $requestTime = set_indo_date($row->request_time) . " pukul " . get_time_from_timestamp($row->request_time) . " WIB";
                        $resetUrl = site_url("forgot_password_reset?token=" . $row->reset_code . "&email=" . $this->input->post("email"));

                        $emailContent = $this->load->view("index/forgot_password_email", array("resetUrl" => $resetUrl, "username" => $row->email, "requestTime" => $requestTime), true);

                        $status = $this->send_email_aktifasi($row->email, "Reset Password", $emailContent);

                        if ($status) {
                            $statusReset = $this->db->query("UPDATE reset_password SET sent_time = NOW() WHERE email = ? AND reset_time IS NULL", array($row->email));

                            if ($statusReset) {
                                $this->data["successMessage"] = "Instruksi untuk reset password telah dikirim ke email anda.";
                            } else {
                                $this->data["errorMessage"] = "Gagal memperbarui reset sent time, silahkan coba lagi.";
                            }
                        } else {
                            $this->data["errorMessage"] = "Gagal mengirim reset code ke email anda, silahkan coba lagi.";
                        }
                    } else {
                        $this->data["errorMessage"] = "Gagal membuat reset code, silahkan coba lagi.";
                    }
                } else {
                    $this->data["errorMessage"] = "Fail to create reset code, please try again.";
                }
            }
        }

        $this->render("forgot_password");
    }

    public function forgot_password_reset() {
        $this->template = "login";

        $this->data["token"] = $this->input->get("token");

        if ($this->input->post("reset-button") != null) {
            if ($this->input->post("email") == "") {
                $this->data["errorEmailMessage"] = "Email harus diisi.";
            } else if ($this->input->post("password") == "") {
                $this->data["errorPasswordMessage"] = "Password harus diisi.";
                $this->data["pass1_temp"] = $this->input->post("password");
                $this->data["pass2_temp"] = $this->input->post("confirm");
            } else if ($this->input->post("password") != $this->input->post("confirm")) {
                $this->data["errorConfirmPasswordMessage"] = "Konfirmasi Password tidak sesuai dengan password baru.";
                $this->data["pass1_temp"] = $this->input->post("password");
                $this->data["pass2_temp"] = $this->input->post("confirm");
            } else {
                $check = $this->db->query("SELECT email FROM user WHERE email = ? AND is_active = '1'", array($this->input->post("email")));

                if ($check->num_rows() == 0) {
                    $personil = $this->db->query("SELECT email FROM personil WHERE email = ? AND is_active = '1'", array($this->input->post("email")));

                    if ($personil->num_rows() == 0) {
                        $table = null;
                    } else {
                        $table = "personil";
                    }
                } else {
                    $table = "user";
                }

                if ($table != null) {
                    $result = $this->db->query("SELECT email FROM reset_password WHERE reset_code = ? AND email = ? ORDER BY request_time DESC LIMIT 1", array($this->input->get("token"), $this->input->post("email")));

                    if ($result->num_rows() == 0) {
                        $this->data["errorEmailMessage"] = "Gagal mem-verifikasi email dan token, harap pastikan email yang anda masukkan sudah benar.";
                    } else {
                        $statusReset = $this->db->query("UPDATE reset_password SET reset_time = NOW() WHERE email = ? AND reset_time IS NULL", array($this->input->post("email")));

                        if ($statusReset) {
                            $statusChangePassword = $this->db->query("UPDATE " . $table . " SET password = SHA2(?, 256) WHERE email = ?", array($this->input->post("password"), $this->input->post("email")));

                            if ($statusChangePassword) {
                                $this->data["successMessage"] = "Password berhasil diperbarui, silahkan kembali untuk login menggunakan password baru anda.";
                                redirect("?forgot_password=true");
                            } else {
                                $this->data["errorEmailMessage"] = "Gagal me-reset password, silahkan coba reset lagi <a href='" . site_url("forgot_password") . "'>disini</a> untuk mendapat link reset password baru.";
                            }
                        } else {
                            $this->data["errorEmailMessage"] = "Gagal flag reset password, silahkan coba lagi.";
                            $this->data["pass1_temp"] = $this->input->post("password");
                            $this->data["pass2_temp"] = $this->input->post("confirm");
                        }
                    }
                } else {
                    $this->data["errorEmailMessage"] = "Maaf, email anda tidak dapat ditemukan pada database. Mungkin telah dihapus oleh Admin.";
                }
            }

            $this->render("forgot_password_reset");
        } else {
            if ($this->input->get("token") == null || $this->input->get("token") == "") {
                exit("Token kosong.");
            } else {
                $result = $this->db->query("SELECT email FROM reset_password WHERE reset_code = ? AND reset_time IS NULL ORDER BY request_time DESC LIMIT 1", array($this->input->get("token")));

                if ($result->num_rows() == 0) {
                    exit("Token tidak valid");
                } else {
                    $this->render("forgot_password_reset");
                }
            }
        }
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function send_email_aktifasi($recipient, $subyek, $message) {
        date_default_timezone_set('Asia/Jakarta');

        $data = array('recipient' => $recipient, 'subyek' => $subyek, 'message' => $message);
        $options = array(
            'http' => array(
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($this->email_handler->url(), false, $context);

        if (strpos($result, "email sent!") == true) {
            return true;
        } else {
            return false;
        }

        /*
          $CI = & get_instance();
          $CI->config->load('email');
          $sender = $CI->config->item('smtp_user');
          $this->email->from($sender, 'Admin Si Mia Cerdas'); //reply to
          $this->email->to($recipient);
          $this->email->subject($subyek);
          $this->email->message($message);
          return $this->email->send();
         */
    }

    public function get_option() {
        $data['data'] = $this->session->userdata("r_optionGroup");
        $this->load->view('index/option', $data);
    }

    public function set_group($id_group) {
        $cek = $this->db->query("SELECT * FROM akses_group_modul WHERE id_group = ?",array($id_group));

        if($cek->num_rows() == 0){
            $this->session->unset_userdata("r_userId");
            $this->session->unset_userdata("r_username");
            $this->session->unset_userdata("r_realName");
            $this->session->unset_userdata("r_email");
            $this->session->unset_userdata("r_creationTime");
            $this->session->unset_userdata("r_isActive");
            redirect("login?no_module=true");
        }
        else {
            $groups = $this->db->query("SELECT lg.id_group, lg.nama_group
                                        FROM login_group lg
                                        WHERE lg.id_group = ?", array($id_group))->first_row();


            $this->session->set_userdata("r_idGroup", $id_group);
            $this->session->set_userdata("r_groupName", $groups->nama_group);
            $this->session->unset_userdata("r_optionGroup");
            $this->get_list_akses_modul_of_group();
            $this->setUserData();
            redirect("index");
        }
    }

    public function ganti_group($id) {
        $query = $this->db->query("SELECT lg.* FROM login_group lg WHERE lg.is_active = '1' AND lg.id_group = ?", $id);
        $result = $query->row();

        $this->session->unset_userdata("r_idGroup");
        $this->session->unset_userdata("r_groupName");

        $this->session->set_userdata("r_idGroup", $result->id_group);
        $this->session->set_userdata("r_groupName", $result->nama_group);
        $this->get_list_akses_modul_of_group();
        $this->setUserData();

        redirect();
    }

    public function logout() {
        $this->unSetUserData();

        redirect("login/pendataan");
    }

}
