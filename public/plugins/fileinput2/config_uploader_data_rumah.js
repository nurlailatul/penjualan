
$(".ktp").fileinput({
    uploadUrl: base_url+"data_rumah/upload_file/ktp",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".ktp").on('filebatchuploadsuccess', function (event, data) {
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
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
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
$(".kk").fileinput({
    uploadUrl: base_url+"data_rumah/upload_file/kk",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".kk").on('filebatchuploadsuccess', function (event, data) {
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
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_kk table").show();
        $("#upload-summary-filename_kk").text(filename);
        $("#upload-summary-filesize_kk").text(response.size + "KB");
        $('#info_kk').html(out);
        $('#info_kk').fadeIn('slow');
        if($('#removefile_kk').length > 0){
            $('#removefile_kk').attr('checked', false);
        }
    } else {
        $('#info_error_kk').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_kk').fadeIn('slow');
    }
});
$(".bukti_kepemilikan").fileinput({
    uploadUrl: base_url+"data_rumah/upload_file/bukti_kepemilikan",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".bukti_kepemilikan").on('filebatchuploadsuccess', function (event, data) {
    $('#info_bukti_kepemilikan').fadeOut('slow');
    $('#info_error_bukti_kepemilikan').fadeOut('slow');
    $('#info_error_bukti_kepemilikan').html('');
    $('#info_bukti_kepemilikan').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_bukti_kepemilikan table").show();
        $("#upload-summary-filename_bukti_kepemilikan").text(filename);
        $("#upload-summary-filesize_bukti_kepemilikan").text(response.size + "KB");
        $('#info_bukti_kepemilikan').html(out);
        $('#info_bukti_kepemilikan').fadeIn('slow');
        if($('#removefile_bukti_kepemilikan').length > 0){
            $('#removefile_bukti_kepemilikan').attr('checked', false);
        }
    } else {
        $('#info_error_bukti_kepemilikan').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_bukti_kepemilikan').fadeIn('slow');
    }
});
$(".foto_rumah").fileinput({
    uploadUrl: base_url+"data_rumah/upload_file/foto_rumah",
    uploadAsync: false,
    showPreview: false,
    allowedFileExtensions: ['jpg','png','jpeg'],
    maxFileCount: 1
});
$(".foto_rumah").on('filebatchuploadsuccess', function (event, data) {
    $('#info_foto_rumah').fadeOut('slow');
    $('#info_error_foto_rumah').fadeOut('slow');
    $('#info_error_foto_rumah').html('');
    $('#info_foto_rumah').html('');
    response = data.response;
    var filename = "";
    var out = '';
    if(!response.errorMessage) {
        $.each(data.files, function (key, file) {
            var fname = file.name;
            out = out + 'File berhasil terupload # ' + (key + 1) + ' - ' + fname + '.';
            filename = fname;
        });

        $("#upload-summary_foto_rumah table").show();
        $("#upload-summary-filename_foto_rumah").text(filename);
        $("#upload-summary-filesize_foto_rumah").text(response.size + "KB");
        $('#info_foto_rumah').html(out);
        $('#info_foto_rumah').fadeIn('slow');
        if($('#removefile_foto_rumah').length > 0){
            $('#removefile_foto_rumah').attr('checked', false);
        }
    } else {
        $('#info_error_foto_rumah').html('<strong>'+response.errorMessage+'</strong>');
        $('#info_error_foto_rumah').fadeIn('slow');
    }
});