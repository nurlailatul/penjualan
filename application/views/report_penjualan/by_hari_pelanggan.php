<section class="content-header">
    <h1>
        <span class="fa fa-book"></span>&nbsp; <?php echo $halaman; ?>
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
                        <form method="get" class="form-inline form-filter" action="<?php echo site_url('report_penjualan/by_hari_pelanggan'); ?>">
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
                                                <div> Urutan </div>
                                            </span>
                                            <select class="form-control" name="orderby">
                                                <option selected disabled>Urutan</option>
                                                <option value="tgl-desc" <?php echo !isset($filter->orderby) || (isset($filter->orderby) && $filter->orderby == 'tgl-desc') ? 'selected' : ''; ?>>Terbaru</option>
                                                <option value="tgl-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'tgl-asc' ? 'selected' : ''; ?>>Terlama</option>
                                                <option value="total_harga-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'total_harga-desc' ? 'selected' : ''; ?>>Tertinggi</option>
                                                <option value="total_harga-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'total_harga-asc' ? 'selected' : ''; ?>>Terendah</option>
                                                <option value="nama-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'nama-asc' ? 'selected' : ''; ?>>Nama ASC</option>
                                                <option value="nama-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'nama-desc' ? 'selected' : ''; ?>>Nama DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="filter_lanjutan" style="display: none;">
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
                                                    <div> Kelompokkan </div>
                                                </span>
                                                <select class="form-control" name="groupby">
                                                    <option selected disabled>Kelompokkan</option>
                                                    <option value="tanpa" <?php echo !isset($groupby) ? 'selected' : ''; ?>>Tanpa Pengelompokkan</option>
                                                    <option value="pelanggan" <?php echo isset($groupby) && $groupby == 'pelanggan' ? 'selected' : ''; ?>>Pelanggan</option>
                                                    <option value="tanggal" <?php echo isset($groupby) && $groupby == 'tanggal' ? 'selected' : ''; ?>>Tanggal</option>
                                                </select>
                                            </div>
    
                                        </div>
                                        <div class="form-group" style="display: block;">
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
                                        <a href="<?php echo site_url("report_penjualan/by_hari_pelanggan") ?>" class="btn btn-danger mt-5" <?php echo isset($is_filter) ? '' : 'disabled'; ?>><span class="fa fa-refresh"></span> Reset</a>
                                    </div>

                                </div>
                            </div>

                        </form>

                        <hr style="margin-top:5px;">
						<?php
							if (!empty($data)) {
						?>
                        <span class="label label-default">Jumlah Data: <?php echo $total_data; ?></span>
                        <div class="table-responsive" style="margin-top:5px;">
                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th class="wrap text-left">No</th>
                                        <th class="wrap">Aksi</th>
                                        <th class="wrap">Pelanggan</th>
                                        <th class="">Tanggal Transaksi</th>
                                        <th class="wrap text-right">Total Harga</th>
                                        <th class="wrap text-right">Total Diskon</th>
                                        <th class="wrap text-right">Total Biaya Lain</th>
                                        <th class="wrap text-right">Total Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                $sumHarga = $sumDiskon = $sumBiayaLain = $sumPembayaran = 0;
                                if(isset($groupby)){
                                    $groupHarga = $groupDiskon = $groupBiayaLain = $groupPembayaran = 0;
                                    if($groupby == 'pelanggan')
                                        $last_pelanggan = '';
                                    if($groupby == 'tanggal')
                                        $last_tanggal = '';
                                }
                                foreach ($data as $r){
                                    ?>
                                    <?php if(isset($groupby)){
                                        if($groupby == 'pelanggan') {
                                            if($last_pelanggan != '' && $last_pelanggan != $r->id_pelanggan){ ?>

                                                <tr>
                                                    <td colspan="4" align="center" class="text-bold">JUMLAH</td>
                                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupHarga); ?></td>
                                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupDiskon); ?></td>
                                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupBiayaLain); ?></td>
                                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupPembayaran); ?></td>
                                                </tr>

                                            <?php
                                                $groupHarga = $groupDiskon = $groupBiayaLain = $groupPembayaran = 0;
                                            }
                                            $last_pelanggan = $r->id_pelanggan;
                                        }
                                        if($groupby == 'tanggal') {
                                            if($last_tanggal != '' && $last_tanggal != $r->tgl){?>

                                                <tr>
                                                    <td colspan="4" align="center" class="text-bold">JUMLAH</td>
                                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupHarga); ?></td>
                                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupDiskon); ?></td>
                                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupBiayaLain); ?></td>
                                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupPembayaran); ?></td>
                                                </tr>

                                                <?php
                                                $groupHarga = $groupDiskon = $groupBiayaLain = $groupPembayaran = 0;
                                            }
                                            $last_tanggal = $r->tgl;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td class="wrap"><?php echo $uri_segment + $i++; ?>. </td>
                                        <td class="wrap">
                                            <div class="btn-group">
                                                <?php $tgl = date('d-m-Y', strtotime($r->tgl)); ?>
                                                <a class="btn btn-success" href="<?php echo site_url('trans_penjualan/index?periode='.$tgl.'+-+'.$tgl.'&pelanggan[]='.$r->id_pelanggan); ?>"><i class="fa fa-search"></i>  </a>
                                            </div>
                                        </td>
                                        <td class="wrap"><?php echo $r->nama; ?></td>
                                        <td class=""><?php echo set_indo_date($r->tgl); ?></td>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($r->total_harga); ?></td>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($r->diskon); ?></td>
                                        <?php $biaya_lain = $r->biaya_tambahan + $r->biaya_pembatalan + $r->biaya_pengiriman; ?>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($biaya_lain); ?></td>
                                        <?php $total_pembayaran = $r->total_harga - $r->diskon + $biaya_lain; ?>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($total_pembayaran); ?></td>
                                    </tr>
                                    <?php
                                    $sumHarga += $r->total_harga;
                                    $sumDiskon += $r->diskon;
                                    $sumBiayaLain += $biaya_lain;
                                    $sumPembayaran += $total_pembayaran;

                                    if(isset($groupby)) {
                                        $groupHarga += $r->total_harga;
                                        $groupDiskon += $r->diskon;
                                        $groupBiayaLain += $biaya_lain;
                                        $groupPembayaran += $total_pembayaran;
                                    }
                                    ?>
                                <?php } ?>

                                <?php if(isset($groupby)){ ?>

                                <tr>
                                    <td colspan="4" align="center" class="text-bold">JUMLAH</td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupHarga); ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupDiskon); ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupBiayaLain); ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($groupPembayaran); ?></td>
                                </tr>

                                <?php } ?>

                                <tr class="bg-gray">
                                    <td colspan="4" align="center" class="text-bold">JUMLAH <?php echo ((isset($link_paging) && $link_paging != '') && isset($page)) ? 'DATA TRANSAKSI HALAMAN '.$page : ''; ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($sumHarga); ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($sumDiskon); ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($sumBiayaLain); ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($sumPembayaran); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($link_paging) { ?>
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="box-footer">
                                            <ul class="pagination pagination-sm no-margin">
                                                <?php echo $link_paging; ?>
                                            </ul>
                                        </div>
                                </div>
                            </div>
                        <?php } ?>
						<?php
							} else {
						?>
						<div class="row">
							<div class="col-md-12">
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

<script>
    function detailBarang(id) {
        $.post("<?php echo site_url("barang/detail") ?>/"+id, {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
            $('#detail').modal('show');
        });
    }
</script>