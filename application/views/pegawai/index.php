<section class="content-header">
    <h1>
        <span class="fa fa-user-circle-o"></span>&nbsp; <?php echo $halaman; ?>
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
                                        <!--<input type="text" name="f_kode" placeholder="Kode Pegawai" class="form-control" value="<?php /*echo isset($filter->kode) ? $filter->kode : ''; */?>">-->
                                        <input type="text" name="f_nama" placeholder="Cari Pegawai" class="form-control" value="<?php echo isset($filter->nama) ? $filter->nama : ''; ?>">
                                    </div>

                                    <button type="submit" class="btn btn-primary "><span class="fa fa-glass"></span> Filter</button>
                                    <a href="<?php echo site_url("pegawai/index") ?>" class="btn btn-danger " <?php echo isset($is_filter) ? '' : 'disabled'; ?>><span class="fa fa-refresh"></span> Reset</a>

                                    <?php if($createAct){ ?>
                                        <a href="<?php echo site_url("pegawai/create_edit") ?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Tambah Data</a>
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
                                        <th class="wrap">Nama Pegawai</th>
                                        <th class="wrap">Jabatan</th>
                                        <th class="wrap">Alamat</th>
                                        <th class="wrap">Telepon</th>
                                        <th class="wrap">Keterangan</th>
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
                                                        <a onclick="detailPegawai(<?php echo $r->id_pegawai; ?>);" class="text-blue"><i class="fa fa-info-circle"></i> Detail</a>
                                                    </li>
                                                    <li>
                                                        <?php if ($updateAct || $updateActOwn){ ?>
                                                            <a href="<?php echo site_url('pegawai/create_edit/'.$r->id_pegawai.'?'.$url_param); ?>" class="text-blue"><i class="fa fa-pencil"></i> Edit</a>
                                                        <?php } ?>
                                                    </li>
                                                    <li>
                                                        <?php if ($deleteAct || $deleteActOwn){ ?>
                                                            <a href="<?php echo site_url('pegawai/hapus/'.$r->id_pegawai); ?>" class="text-blue" data-confirm="Anda yakin akan menghapus data ini? <strong class='pull-right' style='color:#000;'></strong>" data-box-title="Konfirmasi" data-box-class="modal-danger"><i class="fa fa-trash"></i> Hapus</a>
                                                        <?php } ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="wrap"><?php echo $r->nama; ?></td>
                                        <td class="wrap"><?php echo $r->jabatan; ?></td>
                                        <td class="wrap"><?php echo $r->alamat; ?></td>
                                        <td class="wrap"><?php echo $r->no_telp; ?></td>
                                        <td class="wrap"><?php echo substr($r->keterangan, 0, 120); ?></td>
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
    function detailPegawai(id) {
        $.post("<?php echo site_url("pegawai/detail") ?>/"+id, {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
            $('#detail').modal('show');
        });
    }
</script>