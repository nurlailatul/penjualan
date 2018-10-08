
$(".foto_kondisi_awal_1").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/foto_kondisi_awal_1",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".foto_kondisi_awal_1").on('filebatchuploadsuccess', function (event, data) {
    $('#info_foto_kondisi_awal_1').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_1').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_1').html('');
    $('#info_foto_kondisi_awal_1').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_foto_kondisi_awal_1').html(out);
        $('#info_foto_kondisi_awal_1').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_foto_kondisi_awal_1').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_foto_kondisi_awal_1').fadeIn('slow');
    }
});


$(".foto_kondisi_awal_2").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/foto_kondisi_awal_2",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".foto_kondisi_awal_2").on('filebatchuploadsuccess', function (event, data) {
    $('#info_foto_kondisi_awal_2').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_2').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_2').html('');
    $('#info_foto_kondisi_awal_2').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_foto_kondisi_awal_2').html(out);
        $('#info_foto_kondisi_awal_2').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_foto_kondisi_awal_2').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_foto_kondisi_awal_2').fadeIn('slow');
    }
});


$(".foto_kondisi_awal_3").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/foto_kondisi_awal_3",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".foto_kondisi_awal_3").on('filebatchuploadsuccess', function (event, data) {
    $('#info_foto_kondisi_awal_3').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_3').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_3').html('');
    $('#info_foto_kondisi_awal_3').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_foto_kondisi_awal_3').html(out);
        $('#info_foto_kondisi_awal_3').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_foto_kondisi_awal_3').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_foto_kondisi_awal_3').fadeIn('slow');
    }
});


$(".gambar_denah").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/gambar_denah",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".gambar_denah").on('filebatchuploadsuccess', function (event, data) {
    $('#info_gambar_denah').fadeOut('slow');
    $('#info_error_gambar_denah').fadeOut('slow');
    $('#info_error_gambar_denah').html('');
    $('#info_gambar_denah').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_gambar_denah').html(out);
        $('#info_gambar_denah').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_gambar_denah').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_gambar_denah').fadeIn('slow');
    }
});


$(".gambar_tampak_depan").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/gambar_tampak_depan",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".gambar_tampak_depan").on('filebatchuploadsuccess', function (event, data) {
    $('#info_gambar_tampak_depan').fadeOut('slow');
    $('#info_error_gambar_tampak_depan').fadeOut('slow');
    $('#info_error_gambar_tampak_depan').html('');
    $('#info_gambar_tampak_depan').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_gambar_tampak_depan').html(out);
        $('#info_gambar_tampak_depan').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_gambar_tampak_depan').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_gambar_tampak_depan').fadeIn('slow');
    }
});


$(".gambar_tampak_kiri").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/gambar_tampak_kiri",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".gambar_tampak_kiri").on('filebatchuploadsuccess', function (event, data) {
    $('#info_gambar_tampak_kiri').fadeOut('slow');
    $('#info_error_gambar_tampak_kiri').fadeOut('slow');
    $('#info_error_gambar_tampak_kiri').html('');
    $('#info_gambar_tampak_kiri').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_gambar_tampak_kiri').html(out);
        $('#info_gambar_tampak_kiri').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_gambar_tampak_kiri').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_gambar_tampak_kiri').fadeIn('slow');
    }
});


$(".gambar_tampak_kanan").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/gambar_tampak_kanan",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".gambar_tampak_kanan").on('filebatchuploadsuccess', function (event, data) {
    $('#info_gambar_tampak_kanan').fadeOut('slow');
    $('#info_error_gambar_tampak_kanan').fadeOut('slow');
    $('#info_error_gambar_tampak_kanan').html('');
    $('#info_gambar_tampak_kanan').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_gambar_tampak_kanan').html(out);
        $('#info_gambar_tampak_kanan').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_gambar_tampak_kanan').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_gambar_tampak_kanan').fadeIn('slow');
    }
});


$(".gambar_tampak_belakang").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/gambar_tampak_belakang",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".gambar_tampak_belakang").on('filebatchuploadsuccess', function (event, data) {
    $('#info_gambar_tampak_belakang').fadeOut('slow');
    $('#info_error_gambar_tampak_belakang').fadeOut('slow');
    $('#info_error_gambar_tampak_belakang').html('');
    $('#info_gambar_tampak_belakang').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_gambar_tampak_belakang').html(out);
        $('#info_gambar_tampak_belakang').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_gambar_tampak_belakang').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_gambar_tampak_belakang').fadeIn('slow');
    }
});


$(".gambar_potongan_melintang").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/gambar_potongan_melintang",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".gambar_potongan_melintang").on('filebatchuploadsuccess', function (event, data) {
    $('#info_gambar_potongan_melintang').fadeOut('slow');
    $('#info_error_gambar_potongan_melintang').fadeOut('slow');
    $('#info_error_gambar_potongan_melintang').html('');
    $('#info_gambar_potongan_melintang').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_gambar_potongan_melintang').html(out);
        $('#info_gambar_potongan_melintang').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_gambar_potongan_melintang').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_gambar_potongan_melintang').fadeIn('slow');
    }
});


$(".gambar_potongan_memanjang").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/gambar_potongan_memanjang",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".gambar_potongan_memanjang").on('filebatchuploadsuccess', function (event, data) {
    $('#info_gambar_potongan_memanjang').fadeOut('slow');
    $('#info_error_gambar_potongan_memanjang').fadeOut('slow');
    $('#info_error_gambar_potongan_memanjang').html('');
    $('#info_gambar_potongan_memanjang').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_gambar_potongan_memanjang').html(out);
        $('#info_gambar_potongan_memanjang').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_gambar_potongan_memanjang').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_gambar_potongan_memanjang').fadeIn('slow');
    }
});


// DOK 007

$(".foto_kondisi_awal_perspektif").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/foto_kondisi_awal_perspektif",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".foto_kondisi_awal_perspektif").on('filebatchuploadsuccess', function (event, data) {
    $('#info_foto_kondisi_awal_perspektif').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_perspektif').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_perspektif').html('');
    $('#info_foto_kondisi_awal_perspektif').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_foto_kondisi_awal_perspektif').html(out);
        $('#info_foto_kondisi_awal_perspektif').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_foto_kondisi_awal_perspektif').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_foto_kondisi_awal_perspektif').fadeIn('slow');
    }
});

$(".foto_kondisi_awal_dalam_rumah").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_pict/"+jenis_dok+"/foto_kondisi_awal_dalam_rumah",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".foto_kondisi_awal_dalam_rumah").on('filebatchuploadsuccess', function (event, data) {
    $('#info_foto_kondisi_awal_dalam_rumah').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_dalam_rumah').fadeOut('slow');
    $('#info_error_foto_kondisi_awal_dalam_rumah').html('');
    $('#info_foto_kondisi_awal_dalam_rumah').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_foto_kondisi_awal_dalam_rumah').html(out);
        $('#info_foto_kondisi_awal_dalam_rumah').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_foto_kondisi_awal_dalam_rumah').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_foto_kondisi_awal_dalam_rumah').fadeIn('slow');
    }
});

//DOK 008
//dokumen
$(".filepath_dokumen_rab").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_dok/"+id_penerima_bantuan+"/"+jenis_dok+"/filepath_dokumen_rab",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['pdf','doc','docx','xls','xlsx'],
    maxFileCount: 1
});
$(".filepath_dokumen_rab").on('filebatchuploadsuccess', function (event, data) {
    $('#info_doc_draft_rab').fadeOut('slow');
    $('#info_doc_error_draft_rab').fadeOut('slow');
    $('#info_doc_error_draft_rab').html('');
    $('#info_doc_draft_rab').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

    
        $('#info_doc_draft_rab').html(out);
        $('#info_doc_draft_rab').fadeIn('slow');
        
    } else {
        $('#info_error_doc_draft_rab').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_doc_draft_rab').fadeIn('slow');
    }
});

$(".filepath_dokumen_bv").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_dok/"+id_penerima_bantuan+"/"+jenis_dok+"/filepath_dokumen_bv",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['pdf','doc','docx','xls','xlsx'],
    maxFileCount: 1
});
$(".filepath_dokumen_bv").on('filebatchuploadsuccess', function (event, data) {
    $('#info_doc_draft_bv').fadeOut('slow');
    $('#info_doc_error_draft_bv').fadeOut('slow');
    $('#info_doc_error_draft_bv').html('');
    $('#info_doc_draft_bv').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

    
        $('#info_doc_draft_bv').html(out);
        $('#info_doc_draft_bv').fadeIn('slow');
        
    } else {
        $('#info_error_doc_draft_bv').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_doc_draft_bv').fadeIn('slow');
    }
})
//Hardcopy
$(".filepath_hardcopy_rab").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_dok/"+id_penerima_bantuan+"/"+jenis_dok+"/filepath_hardcopy_rab",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['pdf','doc','docx','png','jpg','jpeg'],
    maxFileCount: 1
});
$(".filepath_hardcopy_rab").on('filebatchuploadsuccess', function (event, data) {
    $('#info_doc_draft_rab').fadeOut('slow');
    $('#info_doc_error_draft_rab').fadeOut('slow');
    $('#info_doc_error_draft_rab').html('');
    $('#info_doc_draft_rab').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

    
        $('#info_doc_draft_rab').html(out);
        $('#info_doc_draft_rab').fadeIn('slow');
        
    } else {
        $('#info_error_doc_draft_rab').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_doc_draft_rab').fadeIn('slow');
    }
});

$(".filepath_hardcopy_bv").fileinput({
    uploadUrl: base_url+"kegiatan/dokumen_penerima_bantuan/upload_file_dok/"+id_penerima_bantuan+"/"+jenis_dok+"/filepath_hardcopy_bv",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['pdf','doc','docx','png','jpg','jpeg'],
    maxFileCount: 1
});
$(".filepath_hardcopy_bv").on('filebatchuploadsuccess', function (event, data) {
    $('#info_doc_draft_bv').fadeOut('slow');
    $('#info_doc_error_draft_bv').fadeOut('slow');
    $('#info_doc_error_draft_bv').html('');
    $('#info_doc_draft_bv').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

    
        $('#info_doc_draft_bv').html(out);
        $('#info_doc_draft_bv').fadeIn('slow');
        
    } else {
        $('#info_error_doc_draft_bv').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_doc_draft_bv').fadeIn('slow');
    }
});