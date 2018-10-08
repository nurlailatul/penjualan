<?php

class Global_variable {

    function get_stok_opname(){
        //JANGAN DIUBAH-UBAH. KARENA INI BERPENGARUH KE INSERT STOK OPNAME
        $array = array(
            array('jenis' => 'dropping', 'nama_jenis' => 'Dropping'),
            array('jenis' => 'rusak', 'nama_jenis' => 'Rusak'),
            array('jenis' => 'siap_digunakan', 'nama_jenis' => 'Siap digunakan'),
            array('jenis' => 'terpakai_baru', 'nama_jenis' => 'Terpakai karena baru'),
            array('jenis' => 'terpakai_duplikat', 'nama_jenis' => 'Terpakai karena duplikat'),
            array('jenis' => 'dipinjam', 'nama_jenis' => 'Dipinjam dari cabang lain'),
            array('jenis' => 'dipinjamkan', 'nama_jenis' => 'Dipinjamkan ke cabang lain'),
            array('jenis' => 'kebutuhan_bln_dpn', 'nama_jenis' => 'Estimasi kebutuhan bulan depan')
        );

        return $array;
    }
}