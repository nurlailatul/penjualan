<section class="content-header">
    <h1>
        <span class="fa fa-barcode"></span>&nbsp; <?php echo $halaman; ?>
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
                                                <div> Cari </div>
                                            </span>
                                            <input type="text" name="f_nama" placeholder="Cari Barang" class="form-control" value="<?php echo isset($filter->nama) ? $filter->nama : ''; ?>">
                                        </div>
                                        <div class="input-group mt-5">
                                            <span class="input-group-addon bg-gray">
                                                <div> Urutan </div>
                                            </span>
                                            <select class="form-control" name="orderby">
                                                <option selected disabled>Urutan</option>
                                                <option value="created_time-desc" <?php echo !isset($filter->orderby) || (isset($filter->orderby) && $filter->orderby == 'created_time-desc') ? 'selected' : ''; ?>>Terbaru</option>
                                                <option value="created_time-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'created_time-asc' ? 'selected' : ''; ?>>Terlama</option>
                                                <option value="nama-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'nama-asc' ? 'selected' : ''; ?>>A-Z</option>
                                                <option value="nama-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'nama-desc' ? 'selected' : ''; ?>>Z-A</option>
                                                <option value="harga_umum-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'harga_umum-desc' ? 'selected' : ''; ?>>Harga Tertinggi</option>
                                                <option value="harga_umum-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'harga_umum-asc' ? 'selected' : ''; ?>>Harga Terendah</option>
                                                <option value="stok-desc" <?php echo isset($filter->orderby) && $filter->orderby == 'stok-desc' ? 'selected' : ''; ?>>Stok Tertinggi</option>
                                                <option value="stok-asc" <?php echo isset($filter->orderby) && $filter->orderby == 'stok-asc' ? 'selected' : ''; ?>>Stok Terendah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-5 "><span class="fa fa-glass"></span> Filter</button>
                                    <a href="<?php echo site_url("barang/index") ?>" class="btn btn-danger mt-5" <?php echo isset($is_filter) ? '' : 'disabled'; ?>><span class="fa fa-refresh"></span> Reset</a>

                                    <?php if($createAct){ ?>
                                        <a href="<?php echo site_url("barang/create_edit") ?>" class="btn btn-primary pull-right mt-5"><span class="fa fa-plus"></span> Tambah Data</a>
                                    <?php } ?>
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
                                        <th class="wrap">ID</th>
                                        <th class="wrap">Kode Barang</th>
                                        <th class="wrap">Nama Barang</th>
                                        <th class="wrap text-right">Harga Beli</th>
                                        <th class="wrap text-right">Harga Reseller</th>
                                        <th class="wrap text-right">Harga Umum</th>
                                        <th class="wrap">Stok</th>
                                        <th class="">Deskripsi</th>
                                        <th class="wrap">Waktu Ditambahkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; foreach ($data as $r){
                                    ?>
                                    <tr>
                                        <td class="wrap"><?php echo $uri_segment + $i++; ?>. </td>
                                        <td class="wrap">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a onclick="detailBarang(<?php echo $r->id_barang; ?>);" class="text-blue"><i class="fa fa-info-circle"></i> Detail</a>
                                                    </li>
                                                    <li>
                                                        <?php if ($updateAct || $updateActOwn){ ?>
                                                            <a href="<?php echo site_url('barang/create_edit/'.$r->id_barang.'?'.$url_param); ?>" class="text-blue"><i class="fa fa-pencil"></i> Edit</a>
                                                        <?php } ?>
                                                    </li>
                                                    <li>
                                                        <?php if ($deleteAct || $deleteActOwn){ ?>
                                                            <a href="<?php echo site_url('barang/hapus/'.$r->id_barang); ?>" class="text-blue" data-confirm="Anda yakin akan menghapus data ini? <strong class='pull-right' style='color:#000;'></strong>" data-box-title="Konfirmasi" data-box-class="modal-danger"><i class="fa fa-trash"></i> Hapus</a>
                                                        <?php } ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="wrap"><?php echo $r->id_barang; ?></td>
                                        <td class="wrap"><?php echo $r->kode; ?></td>
                                        <td class="wrap"><?php echo $r->nama; ?></td>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($r->harga_beli); ?></td>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($r->harga_reseller); ?></td>
                                        <td class="wrap text-right">Rp. <?php echo set_currency_format($r->harga_umum); ?></td>
                                        <td class="wrap center"><?php echo set_currency_format($r->stok); ?></td>
                                        <td class=""><?php echo substr($r->deskripsi, 0, 200); ?></td>
                                        <td class="wrap"><?php echo set_indo_date($r->created_time); ?></td>
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