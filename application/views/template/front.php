<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo (isset($halaman)) ? $halaman.' | ' : ''; ?> <?php echo $appname; ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?php echo base_url("/public/image/favicon2.png"); ?>">
        <link href="<?php echo base_url("/public/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css">

        <!-- Icons -->
        <link href="<?php echo base_url("/public/css/font-awesome.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/ionicons.min.css"); ?>" rel="stylesheet" type="text/css">

        <!-- Plugins -->
        <link href="<?php echo base_url("/public/plugins/datatables/dataTables.bootstrap.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/select2/select2.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/switch/bootstrap-switch.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/datepicker/datepicker3.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/datetimepicker/bootstrap-datetimepicker.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/timepicker/bootstrap-timepicker.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/daterangepicker/daterangepicker.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/ionslider/ion.rangeSlider.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/ionslider/ion.rangeSlider.skinNice.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/morris/morris.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/dualistbox/bootstrap-duallistbox.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/chosen/chosen.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/chosen/bootstrap-chosen.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/fileinput2/css/fileinput.css"); ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url("/public/plugins/iCheck/all.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("/public/plugins/eventcalendar/eventCalendar.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("/public/plugins/eventcalendar/eventCalendar_theme_responsive.css"); ?>">

        <!-- AdminLTE & skin -->
        <link href="<?php echo base_url("/public/css/AdminLTE.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/skin-blue.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/helper.css"); ?>" rel="stylesheet" type="text/css">

        <!-- YooHee! CSS overrides -->
        <link href="<?php echo base_url("/public/css/yoohee.min.css"); ?>" rel="stylesheet" type="text/css">

        <script async="" src="<?php echo base_url("/public/js/analytics.js"); ?>"></script><script type="text/javascript">
            var initClientId = null;
            var initDeptId = null;
        </script>


        <script src="<?php echo base_url("/public/js/jQuery-2.1.4.min.js"); ?>"></script>

    </head>

    <?php
    $trigger = $this->session->userdata("triggered");
    $idgroup = $this->session->userdata("t_idGroup");
    ?>

    <body class="skin-blue hold-transition layout-top-nav">
        <div class="wrapper">
            <header class="main-header">


                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="../../index2.html" class="logo"><img src="<?php echo base_url("/public/image/logonew-hrz-light.png"); ?>" style="height:40px;"></a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav" style="font-weight: bold;">
                                <li <?php echo preg_match("#^frontend/index#", uri_string()) ? 'class="header active"' : "" ?>><a href="<?php echo site_url('frontend/index'); ?>">BERANDA <span class="sr-only">(current)</span></a></li>
                                <li class="dropdown" <?php echo preg_match("#^frontend/profil_dpkp#", uri_string()) ||
                                preg_match("#^frontend/profil_bidang#", uri_string()) ? 'class="header active"' : "" ?>>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">PROFIL <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo site_url('frontend/profil_dpkp'); ?>">Profil DPKP</a></li>
                                        <li><a href="<?php echo site_url('frontend/profil_bidang'); ?>">Profil Bidang Rumah Swadaya</a></li>
                                    </ul>
                                </li>
                                <li <?php echo preg_match("#^frontend/pedoman#", uri_string()) ? 'class="header active"' : "" ?>><a href="<?php echo site_url('frontend/pedoman'); ?>">PEDOMAN</a></li>
                                <li <?php echo preg_match("#^frontend/galeri#", uri_string()) ? 'class="header active"' : "" ?>><a href="<?php echo site_url('frontend/galeri'); ?>">GALERI</a></li>
                                <li <?php echo preg_match("#^frontend/forum#", uri_string()) ? 'class="header active"' : "" ?>><a href="<?php echo site_url('frontend/forum'); ?>">FORUM</a></li>
                                <li <?php echo preg_match("#^frontend/pertanyaan#", uri_string()) ? 'class="header active"' : "" ?>><a href="<?php echo site_url('frontend/pertanyaan'); ?>">PERTANYAAN</a></li>
                                <li <?php echo preg_match("#^frontend/kontak#", uri_string()) ? 'class="header active"' : "" ?>><a href="<?php echo site_url('frontend/kontak'); ?>">KONTAK</a></li>
                                <?php if(isset($userId)){ ?>
                                <li><a href="<?php echo site_url(''); ?>">DASHBOARD</a></li>
                                <?php } else { ?>
                                    <li class="dropdown" <?php echo preg_match("#^frontend/profil_dpkp#", uri_string()) ||
                                    preg_match("#^frontend/profil_bidang#", uri_string()) ? 'class="header active"' : "" ?>>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">LOGIN <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo site_url('login/pendataan'); ?>">Pendataan</a></li>
                                            <li><a href="<?php echo site_url('login/pemantauan'); ?>">Pemantauan</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                </nav>

            </header>
            <div class="content-wrapper" style="min-height: 1092px;">

                <div class="container">
                {CONTENT}

                </div>
            </div>

            <footer class="main-footer muted">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>

                Developed by <a href="http://www.jelajah123.com/" target="_blank"><strong>PT. Jelajah Tekno Indonesia</strong></a>
            </footer>
        </div>



    <div class="modal fade" id="modal_gambar" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <img width="800px" id="gambar">
                    <div id="img_description"></div>
                </div>
            </div>
        </div>
    </div>

        <!-- jQuery & Bootstrap -->
        <script src="<?php echo base_url("/public/js/bootstrap.min.js"); ?>" type="text/javascript"></script>

        <!-- Plugins -->
        <script src="<?php echo base_url("/public/plugins/slimScroll/jquery.slimscroll.min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/fastclick/fastclick.min.js"); ?>"></script>
        <script src="<?php echo base_url("/public/plugins/select2/select2.min.js"); ?>"></script>
        <script src="<?php echo base_url("/public/plugins/chosen/chosen.jquery.min.js"); ?>"></script>
        <script src="<?php echo base_url("/public/js/bootbox.min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/switch/bootstrap-switch.min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/moment.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/daterangepicker/daterangepicker.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/morris/morris.min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/raphael-min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/datepicker/bootstrap-datepicker.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/datetimepicker/bootstrap-datetimepicker.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/dualistbox/jquery.bootstrap-duallistbox.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/fileinput2/js/fileinput.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/datatables/jquery.dataTables.min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/datatables/dataTables.bootstrap.min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"); ?>"></script>
        <script src="<?php echo base_url("/public/js/app.min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/yoohee.min2.js"); ?>" type="text/javascript"></script>
        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo base_url("/public/plugins/chartjs/Chart.min.js"); ?>"></script>
        <script src="<?php echo base_url("/public/js/yii.js") ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/yii.validation.js") ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/yii.activeForm.js") ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/timepicker/bootstrap-timepicker2.min.js"); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/plugins/iCheck/icheck.min.js"); ?>"></script>
        <script src="<?php echo base_url("/public/plugins/ionslider/ion.rangeSlider.min.js"); ?>"></script>
        <!-- InputMask -->
        <script src="<?php echo base_url("/public/plugins/input-mask/jquery.inputmask.js"); ?>"></script>
        <script src="<?php echo base_url("/public/plugins/input-mask/jquery.inputmask.date.extensions.js"); ?>"></script>
        <script src="<?php echo base_url("/public/plugins/input-mask/jquery.inputmask.extensions.js"); ?>"></script>

        <script type="text/javascript">

            $(document).ready(function () {
                $.ajaxSetup({
                    data: {
<?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
                    }
                });

                $("[data-mask]").inputmask();

                $('#rangetime').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD hh:mm'
                    },
                    timePicker: true, timePickerIncrement: 30, timePicker24Hour: true,
                    showCustomRangeLabel: true});
                $('.rangetime2').daterangepicker({
                    locale: {
                        format: 'DD-MM-YYYY'
                    },
                    ranges: {
                    'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Hari Ini': [moment(), moment()],
                        'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                        '7 Hari Ke Depan': [moment(), moment().add(6, 'days')],
                        'Bulan Depan': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
                    }
                });
                $('#rangetime2').daterangepicker({locale: {
                        format: 'DD-MM-YYYY'
                    }});

                $(".textarea").wysihtml5();
                $(".dataTablee").DataTable();
                $(".dataTable-1,.dataTable-2,.dataTable-3,.dataTable-4,.dataTable-5,.dataTable-6,.dataTable-7,.dataTable-8,.dataTable-9,.dataTable-10").DataTable();
                $(".dataTable-11,.dataTable-12,.dataTable-13,.dataTable-14,.dataTable-15,.dataTable-16,.dataTable-17,.dataTable-18,.dataTable-19,.dataTable-20").DataTable();
                $('.dataTable2').DataTable({scrollX: true});
                $('.dataTablex').DataTable({"sDom": 'tp'});
                var value = $("input").val();
                var page = parseInt(value);
                $('.dataTable3').DataTable({"pageLength": 3, "sDom": 'tp', "ordering": false, "displayStart": page});
                var table = $('.dataTable3').DataTable();
                var info = table.page.info();

                $(".chosen-select").select2();
                $("#selecct2").select2();


                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd'
                });
                $('.datepicker2').datepicker({
                    dateFormat: 'yyy-dd-mm HH:MM:ss',
                    autoclose: 'true'
                });
                $('.datepicker-tl').datepicker({
                    format: 'yyyy-mm-dd',
                    startView: 2,
                    autoclose: true
                });
                $('.datetimepicker').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm:ss',
                    minDate: startDate,
                    daysOfWeekDisabled: [0,6]
                });

                //Date picker - restrict from start to date
                var startDate = new Date();
                var FromEndDate = new Date('01/01/2020'); //max date
                var ToEndDate = new Date('01/01/2020'); //max date

                $('#datepicker').datepicker({
                    weekStart: 1,
                    startDate: startDate,
                    endDate: FromEndDate,
                    autoclose: true
                })

                        .on('changeDate', function (selected) {
                            startDate = new Date(selected.date.valueOf());
                            startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
                            $('#datepicker2').datepicker('setStartDate', startDate);
                        });
                $('#datepicker2').datepicker({
                    weekStart: 1,
                    startDate: startDate,
                    endDate: ToEndDate,
                    autoclose: true
                })
                        .on('changeDate', function (selected) {
                            FromEndDate = new Date(selected.date.valueOf());
                            FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
                            $('#datepicker').datepicker('setEndDate', FromEndDate);
                        });

                //Timepicker
                $(".timepicker").timepicker({
                    timeFormat: 'HH:mm:ss',
                    showInputs: false
                });

                $(".fileinput-app-ajax").fileinput({
                    uploadUrl: "<?php echo site_url("upload_file/index/") ?>",
                    uploadAsync: false,
                    showPreview: false,
                    allowedFileExtensions: ['jpg','jpeg','png','gif','xls','xlsx','doc','docx','pdf','zip'],
                    maxFileCount: 1
                });
                $(".fileinput-app-ajax").on('filebatchuploadsuccess', function (event, data) {
                    response = data.response;

                    var filename = "";
                    var out = '';
                    $.each(data.files, function (key, file) {
                        var fname = file.name;
                        out = out + 'Uploaded file # ' + (key + 1) + ' - ' + fname + ' successfully.';
                        filename = fname;
                    });

                    $("#upload-summary table").show();
                    $("#upload-summary-filename").text(filename);
                    $("#upload-summary-filesize").text(response.size + "KB");
                    $('#info').html(out);
                    $('#info').fadeIn('slow');
                    $('#submit1').attr('disabled', false);
                });

                setTimeout(function () {
                    $('#callout').show().addClass('animated fadeOutDown').fadeOut();
                }, 4000);

                $('#edit').on('show.bs.modal', function (e) {
                    $('.chosen', this).chosen({width: "320px"});
                    $('.chosen-select', this).select2({width: "320px"});
                });

                $('#create').on('show.bs.modal', function (e) {
                    $('.chosen', this).chosen({width: "320px"});
                    $('.chosen-select', this).select2({width: "320px"});
                });

            });

            // FOR NOMINAL
            $(document).on('keyup', '.nominal', function () {
                var input = $(this).val();
                input = input.split('.').join('');
                $(this).val(num(input));
            });

            function num(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Pembatasan hanya angka
            $(document).on('keydown', '.nominal', function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            // END FOR NOMINAL

            function showGambar(url_gambar, description = '') {
                $("#gambar").attr("src", url_gambar);
                $("#img_description").html(description);
                $('#modal_gambar').modal('show');
            }

        </script>
        <script type="text/javascript">document.write = "</bo" + "dy >";</script>
</html>
