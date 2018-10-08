/**
 * Created by Jelajah Tekno Indon on 16/01/2018.
 */

$(".import_file_foto").fileinput({
    uploadUrl: base_url+"peserta/peserta/upload_file/foto_peserta",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".import_file_foto").on('filebatchuploadsuccess', function (event, data) {
    $('#info_foto').fadeOut('slow');
    $('#info_error_foto').fadeOut('slow');
    $('#info_error_foto').html('');
    $('#info_foto').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'Uploaded file # ' + (key + 1) + ' - ' + fname + ' successfully.';
            filename = fname;
        });

        if($('#removefile_foto').length > 0){
            $('#removefile_foto').attr('checked', false);
        }
        $("#upload-summary table").show();
        $("#upload-summary-filename_foto").text(filename);
        $("#upload-summary-filesize_foto").text(response.size + "KB");
        $('#info_foto').html(out);
        $('#info_foto').fadeIn('slow');

    } else {
        $('#info_error_foto').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_foto').fadeIn('slow');
    }
});

$(".import_file_ktp").fileinput({
    uploadUrl: base_url+"peserta/peserta/upload_file/ktp_peserta",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".import_file_ktp").on('filebatchuploadsuccess', function (event, data) {
    $('#info_ktp').fadeOut('slow');
    $('#info_error_ktp').fadeOut('slow');
    $('#info_error_ktp').html('');
    $('#info_ktp').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'Uploaded file # ' + (key + 1) + ' - ' + fname + ' successfully.';
            filename = fname;
        });

        $("#upload-summary_ktp table").show();
        $("#upload-summary-filename_ktp").text(filename);
        $("#upload-summary-filesize_ktp").text(response.size + "KB");
        $('#info_ktp').html(out);
        $('#info_ktp').fadeIn('slow');
        if($('#removefile_ktp').length > 0){
            $('#removefile_ktp').attr('checked', false);
        }
    } else {
        $('#info_error_ktp').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_ktp').fadeIn('slow');
    }
});

$(".import_file_kk").fileinput({
    uploadUrl: base_url+"peserta/peserta/upload_file/kk_peserta",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".import_file_kk").on('filebatchuploadsuccess', function (event, data) {
    $('#info_kk').fadeOut('slow');
    $('#info_error_kk').fadeOut('slow');
    $('#info_error_kk').html('');
    $('#info_kk').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'Uploaded file # ' + (key + 1) + ' - ' + fname + ' successfully.';
            filename = fname;
        });

        $("#upload-summary_kk table").show();
        $("#upload-summary-filename_kk").text(filename);
        $("#upload-summary-filesize_kk").text(response.size + "KB");
        $('#info_kk').html(out);
        $('#info_kk').fadeIn('slow');
    } else {
        $('#info_error_kk').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_kk').fadeIn('slow');
    }
});

$(".import_file_visa").fileinput({
    uploadUrl: base_url+"peserta/peserta/upload_file/visa_peserta",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".import_file_visa").on('filebatchuploadsuccess', function (event, data) {
    $('#info_visa').fadeOut('slow');
    $('#info_error_visa').fadeOut('slow');
    $('#info_error_visa').html('');
    $('#info_visa').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'Uploaded file # ' + (key + 1) + ' - ' + fname + ' successfully.';
            filename = fname;
        });

        $("#upload-summary_visa table").show();
        $("#upload-summary-filename_visa").text(filename);
        $("#upload-summary-filesize_visa").text(response.size + "KB");
        $('#info_visa').html(out);
        $('#info_visa').fadeIn('slow');
    } else {
        $('#info_error_visa').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_visa').fadeIn('slow');
    }
});

$(".import_file_logo").fileinput({
    uploadUrl: base_url+"peserta/peserta/upload_file/logo_member",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['png'],
    maxFileCount: 1
});
$(".import_file_logo").on('filebatchuploadsuccess', function (event, data) {
    $('#info_logo').fadeOut('slow');
    $('#info_error_logo').fadeOut('slow');
    $('#info_error_logo').html('');
    $('#info_logo').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'Uploaded file # ' + (key + 1) + ' - ' + fname + ' successfully.';
            filename = fname;
        });

        $("#upload-summary_logo table").show();
        $("#upload-summary-filename_logo").text(filename);
        $("#upload-summary-filesize_logo").text(response.size + "KB");
        $('#info_logo').html(out);
        $('#info_logo').fadeIn('slow');
    } else {
        $('#info_error_logo').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_logo').fadeIn('slow');
    }
});

$(".import_file_paspor").fileinput({
    uploadUrl: base_url+"peserta/peserta/upload_file/paspor_peserta",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".import_file_paspor").on('filebatchuploadsuccess', function (event, data) {
    $('#info_paspor').fadeOut('slow');
    $('#info_error_paspor').fadeOut('slow');
    $('#info_error_paspor').html('');
    $('#info_paspor').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'Uploaded file # ' + (key + 1) + ' - ' + fname + ' successfully.';
            filename = fname;
        });

        $("#upload-summary_paspor table").show();
        $("#upload-summary-filename_paspor").text(filename);
        $("#upload-summary-filesize_paspor").text(response.size + "KB");
        $('#info_paspor').html(out);
        $('#info_paspor').fadeIn('slow');
    } else {
        $('#info_error_paspor').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_paspor').fadeIn('slow');
    }
});

$(".import_file_paspor2").fileinput({
    uploadUrl: base_url+"peserta/peserta/upload_file/paspor_peserta",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".import_file_paspor2").on('filebatchuploadsuccess', function (event, data) {
    $('#info_paspor2').fadeOut('slow');
    $('#info_error_paspor2').fadeOut('slow');
    $('#info_error_paspor2').html('');
    $('#info_paspor2').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'Uploaded file # ' + (key + 1) + ' - ' + fname + ' successfully.';
            filename = fname;
        });

        $("#upload-summary_paspor2 table").show();
        $("#upload-summary-filename_paspor2").text(filename);
        $("#upload-summary-filesize_paspor2").text(response.size + "KB");
        $('#info_paspor2').html(out);
        $('#info_paspor2').fadeIn('slow');
    } else {
        $('#info_error_paspor2').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_paspor2').fadeIn('slow');
    }
});