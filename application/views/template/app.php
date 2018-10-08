<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo (isset($halaman)) ? $halaman.' | ' : ''; ?> <?php echo isset($app_name) ? '-'.$app_name : ''; ?></title>
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

        <style>
            .no-data{
                height: 50px; vertical-align:middle; font-weight: bold;
            }
            .pd-btn { padding: 3px 7px 3px 7px; }
            .text-bold { font-weight: bold; }
        </style>


        <script src="<?php echo base_url("/public/js/jQuery-2.1.4.min.js"); ?>"></script>

    </head>

    <?php
    $idgroup = $this->session->userdata("r_idGroup");
    ?>

    <body class="skin-blue hold-transition <?php if (isset($sidebar)) echo 'sidebar-collapse'; ?> <?php if(!isset($userId)) echo 'layout-top-nav'; ?>">
        <div class="wrapper">
            <header class="main-header">

                <?php if(isset($userId)){ ?>
                    <a href="<?php echo site_url(); ?>" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>A</b>LT</span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Amanah</b>SHOP</span>
                    </a>
                    <nav class="navbar navbar-static-top" role="navigation">
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="fa fa-user"></span>
                                        <span class="hidden-xs"> <?php echo $username ?></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li class="user-header">
                                            <p>
                                                <?php echo $realName ?>
                                                <small><?php echo $email ?></small>
                                            </p>
                                        </li>
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo site_url("profile") ?>" class="btn btn-default btn-flat">Akun Saya</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo site_url("logout") ?>" class="btn btn-default btn-flat">Keluar</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                <?php } ?>
            </header>
            <div class="content-wrapper" style="min-height: 1092px;">

                <?php if(!isset($userId)){ ?>
                <div class="container"> <?php } ?>
                    <?php if(isset($graph_page) && $graph_page){ ?>
                        <script src="<?php echo base_url().'/public/plugins/chartjs2/dist/Chart.bundle.js'; ?>"></script>
                        <script src="<?php echo base_url().'/public/plugins/chartjs2/dist/Chart.min.js'; ?>"></script>
                        <script src="<?php echo base_url().'/public/plugins/chartjs2/color.js'; ?>"></script>
                        <script src="<?php echo base_url().'/public/plugins/chartjs2/data_label.js'; ?>"></script>
                        <script src="<?php echo base_url().'/public/plugins/chartjs2/legend_padding2.js'; ?>"></script>
                        <script src="<?php echo base_url("/public/plugins/canvas2image/canvas2image.js"); ?>" type="text/javascript"></script>
                    <?php } ?>
                {CONTENT}

                <?php if(!isset($userId)){ ?></div><?php } ?>
            </div>

            <?php if(isset($userId)){ ?>
            <aside class="main-sidebar">
                <section class="sidebar" style="height: auto;">
                    <?php $id_group = $this->session->userdata('r_idGroup'); ?>
                    <ul class="sidebar-menu">
                        <li <?php echo uri_string() == "" ? 'class="header active" style="padding:0;"' : "" ?> style="padding:0;"><a href="<?php echo site_url() ?>"><span class="fa fa-dashboard"></span> DASHBOARD</a></li>
                        <!--<li <?php /*echo uri_string() == "frontend" ? 'class="header active" style="padding:0;"' : "" */?> style="padding:0;"><a href="<?php /*echo site_url('frontend/index') */?>"><span class="fa fa-dashboard"></span> FRONTEND</a></li>-->
                    </ul>
                      <?php if (in_array("dashboard.read", $userMenus)) { ?>
                        <ul class="sidebar-menu">
                            <li class="header">MENU</li>
                            <li <?php echo preg_match("#^barang#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("barang/index") ?>"><i class="fa fa-barcode"></i>Data Barang</a></li>
                            <li <?php echo preg_match("#^supplier#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("supplier/index") ?>"><i class="fa fa-user-o"></i>Data Supplier</a></li>
                            <li <?php echo preg_match("#^pegawai#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("pegawai/index") ?>"><i class="fa fa-user-circle-o"></i>Data Pegawai</a></li>
                            <li <?php echo preg_match("#^pelanggan#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("pelanggan/index") ?>"><i class="fa fa-users"></i>Data Pelanggan</a></li>
                            <li <?php echo preg_match("#^trans_pembelian#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("trans_pembelian/index") ?>"><i class="fa fa-exchange"></i>Transaksi Pembelian</a></li>
                            <li <?php echo preg_match("#^trans_penjualan#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("trans_penjualan/index") ?>"><i class="fa fa-handshake-o"></i>Transaksi Penjualan</a></li>
                            </li>
                            <li class="header">REPORT PENJUALAN</li>
                            <li <?php echo preg_match("#^report_penjualan/index#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("report_penjualan/index") ?>"><i class="fa fa-book"></i>Per Hari</a></li>
                            <li <?php echo preg_match("#^report_penjualan/by_reseller#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("report_penjualan/by_reseller") ?>"><i class="fa fa-book"></i>Per Pelanggan</a></li>
                            <li <?php echo preg_match("#^report_penjualan/by_hari_reseller#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("report_penjualan/by_hari_reseller") ?>"><i class="fa fa-book"></i>Per Hari Per Pelanggan</a></li>

                            <li class="header">REPORT PEMBELIAN</li>
                            <li <?php echo preg_match("#^report_pembelian/index#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("report_pembelian/index") ?>"><i class="fa fa-book"></i>Pembelian Per Hari</a></li>
                        </ul>
		                <?php } ?>


                    <ul class="sidebar-menu">
                        <li class="header">Akun</li>
                        <li <?php echo preg_match("#^profile#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("profile") ?>"><i class="fa fa-user-md"></i>Akun Saya</a></li>
                        <li <?php echo preg_match("#^logout#", uri_string()) ? 'class="header active" style="padding:0;"' : "" ?>><a href="<?php echo site_url("logout") ?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
                    </ul>
                </section>
            </aside>
            <?php } ?>
            <footer class="main-footer muted">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>

                Developed by <a href="http://www.jelajah123.com/" target="_blank"><strong>Nur Lailatul Choiriyah</strong></a>
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
        <!--<script src="<?php /*echo base_url("/public/plugins/chartjs/Chart.min.js"); */?>"></script>-->
        <!--<script src="<?php /*echo base_url().'/public/plugins/chartjs2/dist/Chart.bundle.js'; */?>"></script>-->
        <script src="<?php echo base_url().'/public/plugins/chartjs2/utils.js'; ?>"></script>
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
                $('.rangetime3').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
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
                $('.rangetime4').daterangepicker({
                    locale: {
                        format: 'DD-MM-YYYY'
                    },
                    autoUpdateInput: false,
                    ranges: {
                        'Hari Ini': [moment(), moment()],
                        'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                        'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        '3 Bulan Terakhir': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')],
                        '6 Bulan Terakhir': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')],
                        'Tahun Ini': [moment().startOf('year'), moment()],
                        'Tahun Lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    }
                }, function(start_date, end_date) {
                    $('.rangetime4').val(start_date.format('DD-MM-YYYY') + ' - ' + end_date.format('DD-MM-YYYY'));
                });
                $('#rangetime2').daterangepicker({locale: {
                        format: 'DD-MM-YYYY'
                    }});
				
				$('#rangepickerblank').daterangepicker({
					locale: {
						format: 'DD-MM-YYYY'
					},
					autoUpdateInput: false
				}, function(start_date, end_date) {
				  $('#rangepickerblank').val(start_date.format('DD-MM-YYYY') + ' - ' + end_date.format('DD-MM-YYYY'));
				});

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

                $(".chosen").chosen();

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
                $('.datetimepicker2').datetimepicker({
                    format: 'DD-MM-YYYY HH:mm'
                });
				$('.tahunpicker').datepicker({
					dateFormat: 'yy',  changeYear: true,  changeMonth: false,
					format: "yyyy",
					viewMode: "years", 
					minViewMode: "years",
					autoclose: true
				});
				
				$('.bulanpicker').datepicker({
					dateFormat: 'mm',  changeYear: true,  changeMonth: true,
					format: "mm",
					viewMode: "months", 
					minViewMode: "months",
					autoclose: true,
				});
				
				$('.bulanmulai').datepicker({
					dateFormat: 'mm-yyyy',  changeYear: true,  changeMonth: true,
					format: "mm-yyyy",
					viewMode: "months", 
					minViewMode: "months",
					autoclose: true,
				}).on('changeDate', function (selected) {
					startDate = new Date(selected.date.valueOf());
					startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
					$('.bulanselesai').datepicker('setStartDate', startDate);
				});
				
				$('.bulanselesai').datepicker({
					dateFormat: 'mm-yyyy',  changeYear: true,  changeMonth: true,
					format: "mm-yyyy",
					viewMode: "months", 
					minViewMode: "months",
					autoclose: true,
				}).on('changeDate', function (selected) {
					FromEndDate = new Date(selected.date.valueOf());
					FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
					$('.bulanmulai').datepicker('setEndDate', FromEndDate);
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
				
				$('#detail').on('show.bs.modal', function (e) {
                    $('.chosen', this).chosen({width: "320px"});
                    $('.chosen-select', this).select2({width: "320px"});
                });

                $('#create').on('show.bs.modal', function (e) {
                    $('.chosen', this).chosen({width: "320px"});
                    $('.chosen-select', this).select2({width: "320px"});
                });
				
				$('.modal').on('show.bs.modal', function (e) {
                    $('.chosen', this).chosen({width: "320px"});
                    $('.chosen-select', this).select2({width: "320px"});
                });
				
				$('.table-responsive').on('show.bs.dropdown', function () {
					 $('.table-responsive').css( "overflow", "inherit" );
				});

				$('.table-responsive').on('hide.bs.dropdown', function () {
					 $('.table-responsive').css( "overflow", "auto" );
				})

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
                // Allow: backspace, delete, tab, escape, enter and . and comma
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 188]) !== -1 ||
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
                $('#modal_gambar').modal('show');
            }

            function getKegiatanByTahun(tahun) {
                $.post("<?php echo site_url("kegiatan/penerima_bantuan/get_kegiatan") ?>", { tahun: tahun }, function (result) {
                    $("#kegiatan").html(result).removeAttr('disabled');
                    $("#kegiatan").attr('required', 'required');
                });
            }

            function DetailKegiatanPembangunan(id) {
                $.post("<?php echo site_url("kegiatan/kegiatan_pembangunan/detail") ?>/"+id, {}, function (result) {
                    $("#show-modal").html("");
                    $("#show-modal").html(result);
                    $('#detail').modal('show');
                });
            }

            function show_filter_tool() {
                $(".btn_filter_tool").attr("onClick","hide_filter_tool()");
                $("#filter_lanjutan").fadeIn();
            }
            function hide_filter_tool() {
                $(".btn_filter_tool").attr("onClick","show_filter_tool()");
                $("#filter_lanjutan").fadeOut();
            }

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })
        </script>
        <script type="text/javascript">document.write = "</bo" + "dy >";</script>

        <script type="text/javascript">
            /*$(function(){
                //Gives you the distance from top of document to the element
                //no what you can see, think of it as if you print the page
                //and then measure the distance from the top to the nav...
                var navOffsetTop = $('.navbar-static-top').offset().top;
                //Add a listener for the scroll movement
                $(window).scroll(function() {
                    //Gives you how much pixels has moved the scrollbar
                    var currentScroll = $(window).scrollTop();
                    //If the distance puts you in the nav position
                    if (currentScroll >= navOffsetTop) {
                        //Change the nav to be fixed in the page
                        $('.navbar-static-top').css({
                            position: 'fixed',
                            top: '0',
                            left: '0'
                        });
                    } else {
                        //Returns the nav to no-fixed position
                        $('.navbar-static-top').css({
                            position: 'static'
                        });
                    }
                });
            });*/
        </script>
</html>
