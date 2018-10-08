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
                        <form method="get" class="form-inline form-filter" action="<?php echo site_url('report_penjualan/index'); ?>">
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
                                                <option value="tgl-desc" <?php echo !isset($filter->orderby) || (isset($filter->orderby) && $filter->orderby == 'waktu_transaksi-desc') ? 'selected' : ''; ?>>Terbaru</option>
                                                <option value="tgl-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'waktu_transaksi-asc' ? 'selected' : ''; ?>>Terlama</option>
                                                <option value="total_harga-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'total_harga-desc' ? 'selected' : ''; ?>>Harga Tertinggi</option>
                                                <option value="total_harga-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'total_harga-asc' ? 'selected' : ''; ?>>Harga Terendah</option>
                                                <option value="laba_reseller-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'laba_reseller-desc' ? 'selected' : ''; ?>>Laba Tertinggi</option>
                                                <option value="laba_reseller-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'laba_reseller-asc' ? 'selected' : ''; ?>>Laba Terendah</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="filter_lanjutan" style="display: none;">
                                        <div class="form-group">
                                            <div class="input-group mt-5" style="width: 100%;">
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
                                        <a href="<?php echo site_url("report_penjualan/index") ?>" class="btn btn-danger mt-5" <?php echo isset($is_filter) ? '' : 'disabled'; ?>><span class="fa fa-refresh"></span> Reset</a>
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
                                        <th class="">Tanggal Transaksi</th>
                                        <th class="wrap text-right">Total Laba</th>
                                        <th class="wrap text-right">Total Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                $sumLaba = $sumPenjualan = 0;
                                foreach ($data as $r){
                                    ?>
                                    <tr>
                                        <td class="wrap"><?php echo $uri_segment + $i++; ?>. </td>
                                        <td class="wrap">
                                            <div class="btn-group">
                                                <?php $tgl = date('d-m-Y', strtotime($r->tgl)); ?>
                                                <a class="btn btn-success" href="<?php echo site_url('trans_penjualan/index?periode='.$tgl.'+-+'.$tgl); ?>"><i class="fa fa-search"></i>  </a>
                                            </div>
                                        </td>
                                        <td class=""><?php echo set_indo_date($r->tgl); ?></td>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($r->tot_laba); ?></td>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($r->tot_penjualan); ?></td>
                                    </tr>
                                    <?php
                                    $sumLaba += $r->tot_laba;
                                    $sumPenjualan += $r->tot_penjualan;
                                    ?>
                                <?php } ?>
                                <tr class="bg-gray">
                                    <td colspan="3" align="center" class="text-bold">JUMLAH <?php echo ((isset($link_paging) && $link_paging != '') && isset($page)) ? 'DATA TRANSAKSI HALAMAN '.$page : ''; ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($sumLaba); ?></td>
                                    <td class="wrap text-right text-bold">Rp. <?php echo set_currency_format($sumPenjualan); ?></td>
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