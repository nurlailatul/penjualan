<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_file extends BaseController {

    protected $module = "";
    public function __construct() {
        parent::__construct();
    }

    public function index($sub_directory = null)
    {
        date_default_timezone_set('Asia/Jakarta');

        $directory = 'uploads';

        if(isset($sub_directory)){
            $directory .= '/'.$sub_directory;
        }
        $config['upload_path'] = $directory;
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|zip|xls|xlsx';
        $config['max_size'] = '100000';

        $this->load->library("upload", $config);

        $response = new stdClass();

        if ($this->upload->do_upload("file")) {
            $data = $this->upload->data();
            $ukuran = $data["file_size"];
            $path = $config['upload_path'];
            $exploded = explode(".", $data["file_name"]);
            $extension = end($exploded);

            $nama = date("Ymd") . "_" . date("His") . '.' . $extension;

            $newFullPath = dirname($data["full_path"]) . "/" . $nama;

            rename($data["full_path"], $newFullPath);

            $data["full_path"] = $newFullPath;

            $this->session->set_userdata("directory_file", $directory);
            $this->session->set_userdata("nama_file", $nama);

            /*$this->session->set_userdata("path_file", $path);
            $this->session->set_userdata("ukuran_file", $ukuran);
            $this->session->set_userdata("nama_origin", $data["file_name"]);
            $this->session->set_userdata("fileUploadPath", $data["full_path"]);
            $this->session->set_userdata("uploadExtension", $extension);
            $this->session->set_userdata("path_origin", dirname($data["full_path"]));*/
        } else {
            $response->errorMessage = $this->upload->display_errors();
        }

        echo json_encode($response);
    }
}
