
window.confirm = function (url, message, title, form_submit, callback) {
    $("#bootstrap-confirm-box-modal").data('confirm-yes', false);
    if ($("#bootstrap-confirm-box-modal").length == 0) {
        $("body").append('<div id="bootstrap-confirm-box-modal" class="modal fade">\
                    <div class="modal-dialog">\
                        <div class="modal-content">\
                            <div class="modal-header bg-red" style="min-height:40px;">\
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
                                <h4 class="modal-title" style="font-weight:bold;"> </h4>\
                            </div>\
                            <div class="modal-body"><p></p></div>\
                            <div class="modal-footer">\
                                <a href="#" class="btn btn-primary"><i class="fa fa-check"></i> Ya</a>\
                                <a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Tidak</a>\
                            </div>\
                        </div>\
                    </div>\
                </div>');
        $("#bootstrap-confirm-box-modal .modal-footer .btn-primary").on('click', function () {
            $("#bootstrap-confirm-box-modal").data('confirm-yes', true);
            $("#bootstrap-confirm-box-modal").modal('hide');
            if(form_submit == true)
                $('#form_filter').attr('action', url).submit();
            else
                window.location.href = url;
        });
        $("#bootstrap-confirm-box-modal").on('hide.bs.modal', function () {
            if (callback)
                callback($("#bootstrap-confirm-box-modal").data('confirm-yes'));
        });
    }

    $("#bootstrap-confirm-box-modal .modal-header h4").html('<i class="fa fa-warning"></i> '+title || "");
    $("#bootstrap-confirm-box-modal .modal-body p").html(message || "");
    $("#bootstrap-confirm-box-modal").modal('show');
};

function hapusRumah(url)
{
    confirm(url, 'Anda yakin akan menghapus data ini?', 'Konfirmasi Hapus', true)
}

function downloadXls(url, total_data)
{
    confirm(url, '<div style="font-size: larger; line-height:1.5em; ">Anda yakin akan mendownload file XLS dari <b>'+total_data+'</b> data ini? <br> Proses ini mungkin memakan waktu yang cukup lama!</div>', 'Konfirmasi Download', true);
};

function downloadXlsPenerima(url)
{
    confirm(url, '<div style="font-size: larger; line-height:1.5em; ">Anda yakin akan mendownload file XLS penerima bantuan kegiatan ini? <br> Proses ini mungkin memakan waktu yang cukup lama!</div>', 'Konfirmasi Download', true);
};

function downloadDocx(url, total_data)
{
    console.log(url);
    confirm(url, '<div style="font-size: larger; line-height:1.5em; ">Anda yakin akan mendownload file DOCX dari <b>'+total_data+'</b> data ini? <br> Proses ini mungkin memakan waktu yang cukup lama!</div>', 'Konfirmasi Download', true);
};
