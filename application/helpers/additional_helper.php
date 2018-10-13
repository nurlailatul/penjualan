<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('set_currency_format'))
{
    function set_currency_format($number = 0)
    {
        // Parameter Input : 1000000.00
        // Return Output : 1.000.000
        return number_format($number, 0, ',', '.');
    }
}
if ( ! function_exists('clear_number_format'))
{
    function clear_number_format($str)
    {
        // Parameter Input : 1.000.000
        // Return Output : 1000000
        return str_replace(',', '.', str_replace('.', '', $str));
    }
}
if ( ! function_exists('set_html_entities'))
{
    function set_html_entities($str)
    {
        return htmlentities($str, ENT_QUOTES | ENT_DISALLOWED | ENT_XML1, "UTF-8");
    }
}

if ( ! function_exists('set_indo_date')) {
    function set_indo_date($tanggal)
    {
        // Parameter Input : YYYY-MM-DD
        // Return Output : 01 Januari 2018 or 0000-00-00
		if ($tanggal == "--") {
			return "";
		}

        $bulan = array(1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        if ($tanggal == null || empty($tanggal)) {
            return "";
        } else {
            $split = explode('-', $tanggal);
            if (count($split) > 0) {
                $tanggal = substr($split[2], 0, 2);
                if ($split[1] == "00") {
                    return $tanggal . ' ' . $split[1] . ' ' . $split[0];
                } else {
                    return $tanggal . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
                }
            } else {
                return "0000-00-00";
            }
        }
    }
}

if ( ! function_exists('set_indo_time')) {
    function set_indo_time($tanggal = null)
    {
        // Parameter Input : YYYY-MM-DD hh:mm:ss
        // Return Output : 01 Januari 2018 12:00 or NULL
        if ($tanggal != '0000-00-00 00:00:00' && $tanggal != NULL) {
            $bulan = array(1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $split = explode('-', $tanggal);
            $tanggal = substr($split[2], 0, 2);
            $jam = substr($split[2], 3, 5);
            return $tanggal . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0] . ' ' . $jam;
        } else
            return NULL;
    }
}

if ( ! function_exists('set_database_datetime_format')) {
    function set_database_datetime_format($date = null)
    {
        // Parameter Input : DD-MM-YYYY hh:mm
        // Return Output : YYYY-MM-DD hh:mm

        $tahun = substr($date, 6,4);
        $bulan = substr($date, 3,2);
        $tgl = substr($date, 0,2);
        $waktu = substr($date, 11);
        $new_format = $tahun.'-'.$bulan.'-'.$tgl.' '.$waktu;

        return $new_format;
    }
}

if ( ! function_exists('set_indo_datetime_format')) {
    function set_indo_datetime_format($date = null)
    {
        // Parameter Input : YYYY-MM-DD hh:mm:ss
        // Return Output : DD-MM-YYYY hh:mm

        $tahun = substr($date, 0,4);
        $bulan = substr($date, 5,2);
        $tgl = substr($date, 8,2);
        $waktu = substr($date, 11);
        $new_format = $tgl.'-'.$bulan.'-'.$tahun.' '.$waktu;

        return $new_format;
    }
}

if ( ! function_exists('get_day_from_date')) {
    function get_day_from_date($date = null)
    {
        // Parameter Input : YYYY-MM-DD
        // Return Output : Senin (Day Name in Indo)
        $month = date('D', strtotime($date));
        $monthList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        return $monthList[$month];
    }
}

if ( ! function_exists('get_month_from_date')) {
    function get_month_from_date($date = null)
    {
        // Parameter Input : YYYY-MM-DD
        // Return Output : Januari (Day Name in Indo)
        $day = date('M', strtotime($date));
        $dayList = array(
            'jan' => 'Januari',
            'Feb' => 'Februari',
            'Mar' => 'Maret',
            'Apr' => 'April',
            'May' => 'Mei',
            'Jun' => 'Juni',
            'Jul' => 'Juli',
            'Aug' => 'Agustus',
            'Sep' => 'September',
            'Oct' => 'Oktober',
            'Nov' => 'November',
            'Dec' => 'Desember',
        );
        return $dayList[$day];
    }
}

if ( ! function_exists('get_time_from_timestamp')) {
    function get_time_from_timestamp($tanggal = null)
    {
        // Parameter Input : YYYY-MM-DD hh:mm:ss
        // Return Output : hh:mm:ss
        if ($tanggal == null || empty($tanggal)) {
            return "00:00:00";
        } else {
            $split = explode(' ', $tanggal);
            return $split[1];
        }
    }
}

if ( ! function_exists('get_file_extension')) {
    function get_file_extension($filepath)
    {
        // Parameter Input : files/namafile.txt
        // Return Output : txt
        return pathinfo($filepath, PATHINFO_EXTENSION);
    }
}

if ( ! function_exists('get_filename_from_path')) {
    function get_filename_from_path($filepath)
    {
        // Parameter Input : files/namafile.txt
        // Return Output : namafile
        $array = explode("/",$filepath);
        $jml = count($array);
        return ucfirst($array[$jml-1]);
    }
}

if ( ! function_exists('handle_file_upload_dok_penerima')) {
    function handle_file_upload_dok_penerima($id_penerima_bantuan, $dokumen_type, $id_dokumen, $is_hardcopy = null)
    {
        $field_name = 'file';
        if (isset($is_hardcopy))
            $field_name .= '_hardcopy';
        $file = $_FILES[$field_name]['tmp_name'];
        $result = array();
        if (!empty($file)) {
            $path = 'files/dok_penerima/' . $id_penerima_bantuan . '/' . $dokumen_type . '/';
            if (isset($is_hardcopy))
                $path .= 'hardcopy/';
            $location = FCPATH . '/' . $path;
            $config['upload_path'] = $location;
            if (!file_exists($location)) {
                mkdir($location, 0775, true);
            }
            $file_name = date('YmdHis') . '_dok_penerima_' . $dokumen_type;
            if (isset($is_hardcopy))
                $file_name .= '_hardcopy';
            $file_name .= '_' . $id_dokumen;
            $config['file_name'] = $file_name;
            $config['upload_path'] = $path;
			if (isset($is_hardcopy)) {
				$config['allowed_types'] = 'pdf|doc|docx|png|jpg|jpeg|png';
			} else if (!isset($is_hardcopy) && $dokumen_type != '009') {
				$config['allowed_types'] = 'pdf|doc|docx';
			} else if (!isset($is_hardcopy) && $dokumen_type == '009') {
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			}

            $config['max_size'] = '2048'; // 2 MB
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $ci =& get_instance();
            $ci->load->library('upload', $config);

            if ($ci->upload->do_upload($field_name)) { //jika upload berhasil
                $data_upload = $ci->upload->data();

                $result['data'] = $data_upload;
                $result['path'] = $path;
                $result['filename'] = $data_upload['file_name'];
            }
        }
        return $result;
    }
}

if ( ! function_exists('handle_file_upload')) {
    function handle_file_upload($field_name = null, $allowed_extension = null)
    {
        // This function upload file and store it in temporary directory
        // After use this function, it recommend to use move_and_rename_file function
        if(!isset($field_name))
            $field_name = 'file';

        $file = $_FILES[$field_name]['tmp_name'];
        $result = array();
        if (!empty($file)) {
            $path = 'files/temporary/';         // temporary folder
            $location = FCPATH . '/' . $path;
            $config['upload_path'] = $location;
            if (!file_exists($location)) {
                mkdir($location, 0775, true);
            }
            $file_name = 'file_temp_'.date('YmdHis');
            $config['file_name'] = $file_name;
            $config['upload_path'] = $path;

            if(!isset($allowed_extension))
                $allowed_extension = 'pdf|doc|docx|xls|xlsx|jpg|jpeg|png';
            $config['allowed_types'] = $allowed_extension;

            $config['max_size'] = '2048'; // 2 MB
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $ci =& get_instance();
            $ci->load->library('upload', $config);

            if ($ci->upload->do_upload($field_name)) { //jika upload berhasil
                $data_upload = $ci->upload->data();

                $result['data'] = $data_upload;
                $result['path'] = $path;
                $result['filename'] = $data_upload['file_name'];
            }
        }
        return $result;
    }
}

if ( ! function_exists('move_and_rename_file')) {
    function move_and_rename_file($old_filepath, $new_directory, $new_filename)
    {
        // Parameter input => (files/temporary/filename.ext, files/new_dir, new_filename)
        // Parameter output => array('status'=> true, 'filepath' => 'files/new_dir/new_filename.ext');

        if (!file_exists($new_directory))
            mkdir($new_directory, 0775, true);

        $ext = get_file_extension($old_filepath);
        $new_filepath = $new_directory.'/'.$new_filename.'.'.$ext;

        if(copy($old_filepath,$new_filepath)) {
            unlink($old_filepath);
            return array('status'=> true, 'filepath' => $new_filepath);
        }
        else {
            return array('status'=> false, 'filepath' => $old_filepath);
        }
    }
}


if ( ! function_exists('get_nama_jabatan_desa_kelurahan')) {
    function get_nama_jabatan_desa_kelurahan($nama_skpd)
    {
        // Parameter Input : Desa Balongpanggang
        // Return Output : Kepala Desa
        if (strpos('Desa', $nama_skpd) == false) {
            $jabatan_desa = 'Kepala Desa';
        } else {
            $jabatan_desa = 'Lurah';
        }
        return $jabatan_desa;
    }
}


if ( ! function_exists('get_nama_jenis_desa_kelurahan')) {
    function get_nama_jenis_desa_kelurahan($nama_skpd)
    {
        // Parameter Input : Desa Balongpanggang
        // Return Output : Desa
        if (strpos('Desa', $nama_skpd) == false) {
            $nama_jenis = 'Desa';
        } else {
            $nama_jenis = 'Kelurahan';
        }
        return $nama_jenis;
    }
}

if ( ! function_exists('get_list_months')) {
    function get_list_months()
    {
        $lists = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

        return $lists;
    }
}

if ( ! function_exists('get_list_years')) {
    function get_list_years()
    {
        $lists = array(date('Y', strtotime('-1 year')), date('Y'), date('Y', strtotime('+1 year')));

        return $lists;
    }
}

if ( ! function_exists('clear_kecamatan_string')) {
    function clear_kecamatan_string($kecamatan)
    {
        // Parameter Input : Kecamatan Balongpanggang
        // Return Output : Balongpanggang
        $kecamatan = strtolower($kecamatan);
        if (strpos($kecamatan, 'kecamatan') >= 0) {
            $kecamatan = str_replace('kecamatan ','',$kecamatan);
        }
        $kecamatan = ucwords($kecamatan);
        return $kecamatan;
    }
}

if ( ! function_exists('clear_desa_kel_string')) {
    function clear_desa_kel_string($desa_kel)
    {
        // Parameter Input : Desa Balongpanggang
        // Return Output : Balongpanggang
        $desa_kel = strtolower($desa_kel);
        if (strpos($desa_kel, 'desa') >= 0) {
            $desa_kel = str_replace('desa ','',$desa_kel);
        } else
        if (strpos($desa_kel, 'kelurahan') >= 0) {
            $desa_kel = str_replace('kelurahan ','',$desa_kel);
        }
        $desa_kel = ucwords($desa_kel);
        return $desa_kel;
    }
}

if ( ! function_exists('set_lainnya')) {
    function set_lainnya($object, $object_lainnya)
    {
        // Parameter Input : $detail->material_pondasi, $detail->material_pondasi_lainnya
        // Return Output : material_pondasi
        if(empty($object) && empty($object_lainnya)){
            $result = '-';
        } else {
            if(($object == 'Lainnya')){
                if(empty($object_lainnya))
                    $result = '-';
                else
                    $result = $object_lainnya;
            }
            else
                $result = $object;
        }
        return $result;
    }
}

if ( ! function_exists('set_if_empty')) {
    function set_if_empty($value)
    {
        // Parameter Input : $detail->material_pondasi
        // Return Output : if not empty => $detail->material_pondasi   or if empty => '-'
        $result = !empty($value) ? $value: '-';
        return $result;
    }
}

if ( ! function_exists('concat_two_string')) {
    function concat_two_string($string1, $string2)
    {
        // Parameter Input : $detail->material_pondasi, $detail->catatan_material_pondasi
        // Return Output : if not empty => $detail->material_pondasi $detail->catatan_material_pondasi   or if empty => '-'
        if(empty($string1) && empty($string2)){
            $result = '-';
        } else {
            $result = $string1.' '.$string2;
        }
        return $result;
    }
}

if ( ! function_exists('concat_two_string_excel')) {
    function concat_two_string_excel($string1, $string2)
    {
        // Parameter Input : $detail->material_pondasi, $detail->catatan_material_pondasi
        // Return Output : if not empty => $detail->material_pondasi \n $detail->catatan_material_pondasi   or if empty => '-'
        if(empty($string1) && empty($string2)){
            $result = '-';
        } else {
            $result = $string1."\n".$string2;
        }
        return $result;
    }
}

if ( ! function_exists('convert_image_size_to_cm')) {
    function convert_image_size_to_cm($image_filepath = '', $maxWidth_cm = 0)
    {
        // Parameter Input : files/image_name.jpg, 5
        // Return Output : array('width' => 4, 'height' => 5)  => in cm
        $pixel_cm = 0.02645833; // 1 cm = 0.02645833 pixel

        list($realWidth_pixel, $realHeight_pixel) = getimagesize($image_filepath);
        $realHeight_cm = $realHeight_pixel * $pixel_cm;
        $realWidth_cm = $realWidth_pixel * $pixel_cm;
        $scale = $maxWidth_cm / $realWidth_cm;
        $result['width'] = $realWidth_cm * $scale;
        $result['height'] = $realHeight_cm * $scale;

        return $result;
    }
}

if ( ! function_exists('convert_date_range')) {
    function convert_date_range($daterange)
    {
        // Parameter Input : 2018-07-01 - 2018-07-20
        // Return Output : array('from_date' => 2018-07-01, 'to_date' => 2018-07-20)
        $date = urldecode($daterange);
        $from = substr($date, 0, 10);
        $result['from_tgl'] = substr($from, 8, 2);
        $result['from_bln'] = substr($from, 5, 2);
        $result['from_thn'] = substr($from, 0, 4);
        $to = substr($date, 13);
        $result['from_tgl'] = substr($to, 8, 2);
        $result['from_bln'] = substr($to, 5, 2);
        $result['from_thn'] = substr($to, 0, 4);

        return $result;
    }
}

if ( ! function_exists('set_icon_status_transaksi_pembelian')) {
    function set_icon_status_transaksi_pembelian($status)
    {
        $icon = 'times'; $color = 'danger'; // BATAL
        if($status == 'PESAN'){
            $icon = 'flag'; $color = 'warning';
        }
        if($status == 'DIBAYAR'){
            $icon = 'money'; $color = 'primary';
        }
        if($status == 'SELESAI'){
            $icon = 'check'; $color = 'success';
        }

        return array('icon' => $icon, 'color' => $color);
    }
}

if ( ! function_exists('set_icon_status_transaksi_penjualan')) {
    function set_icon_status_transaksi_penjualan($status)
    {
        $icon = 'times'; $color = 'danger'; // BATAL
        if($status == 'PESAN'){
            $icon = 'flag'; $color = 'warning';
        }
        if($status == 'PROSES'){
            $icon = 'spinner'; $color = 'primary';
        }
        if($status == 'SELESAI'){
            $icon = 'check'; $color = 'success';
        }

        return array('icon' => $icon, 'color' => $color);
    }
}

if ( ! function_exists('set_icon_status_pembayaran_penjualan')) {
    function set_icon_status_pembayaran_penjualan($status)
    {
        $icon = 'times'; $color = 'danger'; // BATAL
        if($status == 'MENUNGGU'){
            $icon = 'flag'; $color = 'warning';
        }
        if($status == 'SEBAGIAN'){
            $icon = 'cube'; $color = 'primary';
        }
        if($status == 'LUNAS'){
            $icon = 'check'; $color = 'success';
        }

        return array('icon' => $icon, 'color' => $color);
    }
}

if ( ! function_exists('set_icon_status_pengiriman_penjualan')) {
    function set_icon_status_pengiriman_penjualan($status)
    {
        $icon = 'times'; $color = 'danger'; // GAGAL
        if($status == 'MENUNGGU'){
            $icon = 'flag'; $color = 'warning';
        }
        if($status == 'PROSES'){
            $icon = 'spinner'; $color = 'primary';
        }
        if($status == 'SAMPAI'){
            $icon = 'check'; $color = 'success';
        }

        return array('icon' => $icon, 'color' => $color);
    }
}

if ( ! function_exists('set_filter_periode')) {
    function set_filter_periode($periode)
    {
        if ($periode) {
            $check = check_filter_periode_range($periode);
            if(!$check){
                $tanggal_from = date('d-m-Y', strtotime('-7 day'));
                $tanggal_to = date("d-m-Y");
                $periode = $tanggal_from.' - '.$tanggal_to;
            }
            return array('status' => $check, 'periode' => $periode);
        } else {
            $tanggal_from = date('d-m-Y', strtotime('-6 day'));
            $tanggal_to = date("d-m-Y");
            return array('status' => true, 'periode' => $tanggal_from.' - '.$tanggal_to);
        }
    }
}

if ( ! function_exists('decode_filter_periode')) {
    function decode_filter_periode($periode)
    {
        if ($periode) {
            $periode = urldecode($periode);
            $tanggal_from = substr($periode,0,10);
            $tanggal_to = substr($periode,13);
            $tanggal_from = date("Y-m-d", strtotime($tanggal_from));
            $tanggal_to = date("Y-m-d", strtotime($tanggal_to));
            $result['tanggal_from'] = $tanggal_from;
            $result['tanggal_to'] = $tanggal_to;
            return $result;
        } else
            return FALSE;
    }
}

if ( ! function_exists('check_filter_periode_range')) {
    function check_filter_periode_range($periode)
    {
        $periode = urldecode($periode);
        $tanggal_from = substr($periode,0,10);
        $tanggal_to = substr($periode,13);
        $tanggal_from = strtotime(date("Y-m-d", strtotime($tanggal_from)));
        $tanggal_to = strtotime(date("Y-m-d", strtotime($tanggal_to)));
        $datediff = $tanggal_to - $tanggal_from;
        $datediff = round($datediff / (60*60*24));
        if($datediff <= 366)
            return TRUE;
        else
            return FALSE;
    }
}
