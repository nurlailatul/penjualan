<section class="content-header">
    <h1>
        <span class="fa fa-handshake-o"></span>&nbsp; <?php echo $halaman; ?>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo site_url() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"> <?php echo $halaman; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline" role="grid">
                        <?php if (!empty($this->session->flashdata('msg'))) : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-success" id="callout">
                                        <h4>Berhasil</h4>
                                        <p><?php echo $this->session->flashdata('msg'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($this->session->flashdata('msgw'))) : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-warning" id="callout">
                                        <h4>Perhatian!</h4>
                                        <p><?php echo $this->session->flashdata('msgw'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form method="get" class="form-inline form-filter">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group mt-5">
                                            <span class="input-group-addon bg-gray">
                                                <div> Periode </div>
                                            </span>
                                            <input type="text" name="periode" placeholder="Periode" class="form-control rangetime4" value="<?php echo isset($filter->periode) ? $filter->periode : ''; ?>" autocomplete="off">
                                        </div>
                                        <div class="input-group mt-5">
                                                <span class="input-group-addon bg-gray">
                                                    <div>Jenis</div>
                                                </span>
                                            <select class="form-control" name="jenis_transaksi">
                                                <option selected disabled>Jenis</option>
                                                <option value="all" <?php echo !isset($jenis_transaksi) ? 'selected' : ''; ?>>Semua</option>
                                                <option value="DROPSHIP" <?php echo isset($jenis_transaksi) && $jenis_transaksi == 'DROPSHIP' ? 'selected' : ''; ?>>DROPSHIP</option>
                                                <option value="BIASA" <?php echo isset($jenis_transaksi) && $jenis_transaksi == 'BIASA' ? 'selected' : ''; ?>>BIASA</option>
                                            </select>
                                        </div>
                                        <div class="input-group mt-5">
                                            <span class="input-group-addon bg-gray">
                                                <div> Urutan </div>
                                            </span>
                                            <select class="form-control" name="orderby">
                                                <option selected disabled>Urutan</option>
                                                <option value="id_trans-desc" <?php echo !isset($filter->orderby) || (isset($filter->orderby) && $filter->orderby == 'id_trans-desc') ? 'selected' : ''; ?>>ID Tertinggi</option>
                                                <option value="id_trans-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'id_trans-asc' ? 'selected' : ''; ?>>ID Terendah</option>
                                                <option value="waktu_transaksi-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'waktu_transaksi-desc' ? 'selected' : ''; ?>>Waktu Terbaru</option>
                                                <option value="waktu_transaksi-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'waktu_transaksi-asc' ? 'selected' : ''; ?>>Waktu Terlama</option>
                                                <option value="pelanggan-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'pelanggan-asc' ? 'selected' : ''; ?>>Pelanggan A-Z</option>
                                                <option value="pelanggan-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'pelanggan-desc' ? 'selected' : ''; ?>>Pelanggan Z-A</option>
                                                <option value="biaya_penjualan-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'biaya_penjualan-desc' ? 'selected' : ''; ?>>Biaya Tertinggi</option>
                                                <option value="biaya_penjualan-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'biaya_penjualan-asc' ? 'selected' : ''; ?>>Biaya Terendah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="filter_lanjutan" style="display: none;">
                                        <div style="display: block;">

                                            <div class="form-group">
                                                <div class="input-group mt-5">
                                                <span class="input-group-addon bg-gray">
                                                    <div>Transaksi</div>
                                                </span>
                                                    <select class="form-control" name="status_transaksi">
                                                        <option disabled>Status Transaksi</option>
                                                        <option value="all">SEMUA</option>
                                                        <?php foreach ($data_status_transaksi as $r){ ?>
                                                            <option value="<?php echo $r; ?>" <?php echo (isset($filter->status_transaksi) && $r == $filter->status_transaksi) ? 'selected': ''; ?>><?php echo $r; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group mt-5">
                                            <span class="input-group-addon bg-gray">
                                                <div>Pembayaran</div>
                                            </span>
                                                    <select class="form-control" name="status_pembayaran">
                                                        <option disabled>Status Pembayaran</option>
                                                        <option value="all">SEMUA</option>
                                                        <?php foreach ($data_status_pembayaran as $r){ ?>
                                                            <option value="<?php echo $r; ?>" <?php echo (isset($filter->status_pembayaran) && $r == $filter->status_pembayaran) ? 'selected': ''; ?>><?php echo $r; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="input-group mt-5">
                                            <span class="input-group-addon bg-gray">
                                                <div>Pengiriman</div>
                                            </span>
                                                    <select class="form-control" name="status_pengiriman">
                                                        <option disabled>Status Pengiriman</option>
                                                        <option value="all">SEMUA</option>
                                                        <?php foreach ($data_status_pengiriman as $r){ ?>
                                                            <option value="<?php echo $r; ?>" <?php echo (isset($filter->status_pengiriman) && $r == $filter->status_pengiriman) ? 'selected': ''; ?>><?php echo $r; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: block;">

                                            <div class="form-group">
                                                <div class="input-group mt-5">
                                            <span class="input-group-addon bg-gray">
                                                <div>Reseller</div>
                                            </span>
                                                    <select class="form-control chosen-select" name="reseller[]" data-placeholder="Pilih Reseller" style="width: 100%;" multiple>
                                                        <option></option>
                                                        <?php foreach ($data_reseller as $r){ ?>
                                                            <option value="<?php echo $r->id_pelanggan; ?>" <?php echo (isset($filter->reseller) && in_array($r->id_pelanggan, $filter->reseller)) ? 'selected': ''; ?>><?php echo $r->nama; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group mt-5">
                                                    <span class="input-group-addon bg-gray">
                                                        <div>Pelanggan</div>
                                                    </span>
                                                    <select class="form-control chosen-select" name="pelanggan[]" data-placeholder="Pilih Pelanggan" style="width: 100%;" multiple>
                                                        <option></option>
                                                        <?php foreach ($data_pelanggan as $r){ ?>
                                                            <option value="<?php echo $r->id_pelanggan; ?>" <?php echo (isset($filter->pelanggan) && in_array($r->id_pelanggan, $filter->pelanggan)) ? 'selected': ''; ?>><?php echo $r->nama; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mt-5">
                                                    <span class="input-group-addon bg-gray">
                                                        <div>Kurir</div>
                                                    </span>
                                                    <select class="form-control chosen-select" name="kurir[]" data-placeholder="Pilih Kurir" style="width: 100%;" multiple>
                                                        <option></option>
                                                        <?php foreach ($data_kurir as $r){ ?>
                                                            <option value="<?php echo $r->id_pegawai; ?>" <?php echo (isset($filter->kurir) && in_array($r->id_pegawai, $filter->kurir)) ? 'selected': ''; ?>><?php echo $r->nama; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mt-5">
                                                <span class="input-group-addon bg-gray">
                                                    <div>Total Harga</div>
                                                </span>
                                                <input type="text" name="minimum" placeholder="Minimum" class="form-control nominal" value="<?php echo isset($filter->minimum) ? set_currency_format($filter->minimum) : ''; ?>" autocomplete="off">
                                                <span class="input-group-addon bg-gray">
                                                    <div>-</div>
                                                </span>
                                                <input type="text" name="maximum" placeholder="Maximum" class="form-control nominal" value="<?php echo isset($filter->maximum) ? set_currency_format($filter->maximum) : ''; ?>" autocomplete="off">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-5"><span class="fa fa-glass"></span> Filter</button>
                                        <button type="button" class="btn bg-navy btn_filter_tool mt-5" onclick="show_filter_tool()"><span class="fa fa-cog"></span> Lainnya</button>
                                        <a href="<?php echo site_url("trans_penjualan/index") ?>" class="btn btn-danger mt-5" <?php echo isset($is_filter) ? '' : 'disabled'; ?>><span class="fa fa-refresh"></span> Reset</a>
                                    </div>
                                    <?php if($createAct){ ?>
                                        <a href="<?php echo site_url("trans_penjualan/create_edit") ?>" class="btn btn-primary pull-right mt-5"><span class="fa fa-plus"></span> Tambah</a>
                                    <?php } ?>
                                </div>
                            </div>

                        </form>

                        <hr style="margin-top:5px;">
							<div class="row">
								<div class="col-md-12 mb-10">
									<div class="btn_batal_penerima" style="display: none;">
										<a href="#" onclick="ubahStatus(true)" class="btn btn-warning pull-left ml-5" ><span class="fa fa-pencil-square-o"></span> Ubah Status</a>
									</div>
								</div>
							</div>
						<?php
							if (!empty($data)) {
						?>
                                <span class="label label-default">Jumlah Data: <?php echo $total_data; ?></span>
                        <div class="table-responsive" style="margin-top:5px;">
                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th class="wrap text-left" colspan="2">No</th>
                                        <th class="wrap">Aksi</th>
                                        <th class="wrap">ID</th>
                                        <th class="wrap">Waktu Transaksi</th>
                                        <th class="wrap">Jenis Transaksi</th>
                                        <th class="wrap">Pelanggan</th>
                                        <th class="wrap text-right">Total<br>Pembayaran</th>
                                        <th class="wrap">Pengiriman</th>
                                        <th class="">Keterangan</th>
                                        <th class="wrap center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; foreach ($data as $r){
                                    ?>
                                    <tr>
                                        <td class="wrap"><?php echo $uri_segment + $i++; ?>. </td>
                                        <td class="wrap">
                                            <?php if ($updateAct || $updateActOwn || $deleteAct || $deleteActOwn){ ?>
                                            <?php if ($r->status_transaksi != 'BATAL'){ ?>
                                                <input type="checkbox" value="<?php echo $r->id_trans; ?>" class="tickpenerima" onchange="pilih_transaksi()">
                                            <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td class="wrap">
                                            <div class="btn-group">
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a onclick="detailTransPenjualan(<?php echo $r->id_trans; ?>);" class="text-blue" style="cursor: pointer;"><i class="fa fa-info-circle"></i> Detail </a>
                                                </li>
                                                <li>
                                                    <a onclick="detailProcess(<?php echo $r->id_trans; ?>);" class="text-blue" style="cursor: pointer;"><i class="fa fa-history"></i> Detail Proses</a>
                                                </li>
                                                    <?php if (($updateAct || $updateActOwn) && $r->status_transaksi != 'BATAL'){ ?>

                                                    <li>
                                                        <a onclick="ubahStatus(false,'<?php echo $r->id_trans; ?>','<?php echo $r->status_transaksi; ?>')"  class="text-blue" style="cursor: pointer;"><i class="fa fa-mail-forward"></i> Ubah Status</a></li>
                                                        <li>
                                                            <a href="<?php echo site_url('trans_penjualan/cetak/'.$r->id_trans); ?>" target="_blank" class="text-blue" style="cursor: pointer;"><i class="fa fa-print"></i> Cetak Struk</a></li>

                                                        <?php if($r->status_transaksi == 'PESAN' || $r->status_transaksi == 'PROSES'){ ?>
                                                            <?php $url = site_url("trans_penjualan/create_edit/".$r->id_trans) ."?" . $url_param;
                                                            if(strpos($url, 'paging=') === false){
                                                                $url .= "&paging=" . urlencode($paging_param);
                                                            } ?>
                                                            <li><a href="<?php echo $url; ?>" class="text-blue"><i class="fa fa-pencil"></i> Edit</a></li>
                                                        <?php } ?>

                                                    <?php } ?>
                                            </ul>
                                            </div>
                                        </td>
                                        <td class="wrap"><?php echo $r->id_trans; ?></td>
                                        <td class="wrap">
                                            <?php
                                            echo '<i class="fa fa-calendar"></i> '.set_indo_date(substr($r->waktu_transaksi,0,10));
                                            echo '<br><i class="fa fa-clock-o"></i> '.substr($r->waktu_transaksi,11,5);
                                            ?>
                                        </td>
                                        <td class="wrap"><?php echo $r->jenis_transaksi; ?>
                                        <?php if($r->nama_reseller != NULL) echo '<br><i class="fa fa-user"></i> '.$r->nama_reseller; ?></td>
                                        <td class="wrap"><?php echo $r->pelanggan; ?></td>

                                        <td class=" text-right">
                                        <div style="font-weight: bold;">Rp.&nbsp;<?php echo set_currency_format($r->biaya_penjualan); ?></div>
											</td>

                                        <td class="wrap">
                                            <?php if($r->id_pengiriman != NULL){
                                                echo '<i class="fa fa-clock-o"></i>&nbsp;&nbsp;'.set_indo_time($r->waktu_pengiriman).'<br>';
                                                echo '<i class="fa fa-truck"></i>&nbsp;&nbsp;'.$r->jenis_ekspedisi.'<br>';
                                                if($r->nama_kurir != NULL)
                                                    echo '<i class="fa fa-user"></i>&nbsp;&nbsp;'.$r->nama_kurir.'<br>';
                                                if($r->no_resi != NULL)
                                                    echo '<i class="fa fa-barcode"></i>&nbsp;&nbsp;'.$r->no_resi.'<br>';
                                                if($r->waktu_sampai != NULL)
                                                    echo '<i class="fa fa-check"></i>&nbsp;&nbsp;'.set_indo_time($r->waktu_sampai).'<br>';
                                            } ?>
                                        </td>
                                        <td class=""><?php echo substr($r->keterangan, 0, 150); ?></td>

                                        <td class="wrap center">

                                            <?php $status = set_icon_status_transaksi_penjualan($r->status_transaksi); ?>
                                            <div class="btn-group">
                                                <span class="btn btn-xs btn-default pd-btn"><i class="fa fa-handshake-o"></i></span>
                                            <span class="btn btn-xs btn-<?php echo $status['color']; ?> btn-block text-center pd-btn"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $r->status_transaksi; ?></span>
                                            </div>
                                            <!--<div class="btn-group mt-5">
                                            <?php /*$status = set_icon_status_pembayaran_penjualan($r->status_pembayaran); */?>
                                                <span class="btn btn-xs btn-default pd-btn"><i class="fa fa-money"></i></span>
                                            <span class="btn btn-xs btn-<?php /*echo $status['color']; */?> btn-block text-center pd-btn"><i class="fa fa-<?php /*echo $status['icon']; */?>"></i> <?php /*echo $r->status_pembayaran; */?></span>
                                            </div>
                                            <div class="btn-group mt-5">
                                            <?php /*$status = set_icon_status_pengiriman_penjualan($r->status_pengiriman); */?>
                                                <span class="btn btn-xs btn-default pd-btn"><i class="fa fa-truck"></i></span>
                                            <span class="btn btn-xs btn-<?php /*echo $status['color']; */?> btn-block text-center pd-btn"><i class="fa fa-<?php /*echo $status['icon']; */?>"></i> <?php /*echo $r->status_pengiriman; */?></span>
                                            </div>-->
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <?php if ($link_paging) { ?>
                                    <tfoot>
                                        <tr>
                                            <td colspan="17">
                                                <div class="box-footer">
                                                    <ul class="pagination pagination-sm no-margin">
                                                        <?php echo $link_paging; ?>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tfoot>
                                <?php } ?>
                            </table>
                        </div>
						<?php
							} else {
						?>
						<div class="row">
							<div class="col-md-12 mt-5">
								<div class="callout callout-info">
									<h4>Maaf</h4>
									<p>Data kosong atau data tidak ditemukan.</p>
								</div>
							</div>
						</div>
						<?php
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="show-modal"></div>


<?php if ($updateAct || $updateActOwn){ ?>
    <div class="modal fade" id="ubah_status" role="dialog" data-backdrop="static" data-keyboard="false">
        <?php $url = site_url("trans_penjualan/ubah_status") ."?" . $url_param;
        if(strpos($url, 'paging=') === false){
            $url .= "&paging=" . urlencode($paging_param);
        } ?>
        <form class="form-horizontal" method="post" action="<?php echo $url; ?>">
            <textarea name="id_trans" style="display: none;"></textarea>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-default">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Ubah Status Transaksi Penjualan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status Transaksi</label>
                            <div class="col-sm-7">
                                <select class="form-control chosen-select" name="status" id="statusOption" width="100%" data-placeholder="Pilih Salah Satu">
                                    <option></option>
                                    <?php foreach ($data_status_transaksi as $r){ ?>
                                        <option value="<?php echo $r; ?>"><?php echo $r; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-sm-12 pull-right">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Ubah Status</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php } ?>

<script>
    function detailTransPenjualan(id) {
        $.post("<?php echo site_url("trans_penjualan/detail") ?>/"+id, {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
            $('#detail').modal('show');
        });
    }
    function detailProcess(id) {
        $.post("<?php echo site_url("trans_penjualan/detail_process") ?>/"+id, {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
            $('#detail').modal('show');
        });
    }

    function pilih_transaksi() {
        var param='';
        $('input[class="tickpenerima"]:checked').each(function() {
            param += '1';
        });

        if(param != ''){
            $(".btn_batal_penerima").css("display","block");
        } else {
            $(".btn_batal_penerima").css("display","none");
        }
    }
    function ubahStatus(many = false, id_trans = null, status = null) {
        if(many){
            var id = '';
            $('input:checkbox.tickpenerima').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");

                if(sThisVal != ''){
                    if(id != ''){ id += '|'; }
                    id += sThisVal;
                }
            });
        } else {
            var id = id_trans;
        }

        $("textarea[name='id_trans']").val(id);

        if(status !== null) {
            if (status != '') {
                $('#statusOption').val(status).trigger('change');
            }
        }

        $('#ubah_status').modal('show');
    }

    <?php if($this->input->get("cetak")){
        $id_cetak = $this->input->get("cetak");
        $url = site_url('/trans_penjualan/cetak/'.$id_cetak);
        echo 'window.open("'.$url.'", "_blank");';
    } ?>
</script>