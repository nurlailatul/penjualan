<section class="content-header">
    <h1>
        <span class="fa fa-money"></span>&nbsp; <?php echo $halaman; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <?php foreach ($breadcrumb as $b){ ?>
        <li><a href="<?php echo site_url($b['link']) ?>"><?php echo $b['page']; ?></a></li>
        <?php } ?>
        <li class="active"> <?php echo $halaman; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">

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

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lengkapi form di bawah ini! &nbsp; <small>Field bertanda (<label class="text-red">*</label>) harus diisi.</small></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Waktu Transaksi</div>
                                    <div class="col-sm-8">
                                        <?php echo set_indo_time($detail->waktu_transaksi); ?>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Pelanggan</div>
                                    <div class="col-sm-8">
                                        <?php echo $detail->pelanggan; ?>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Total Harga</div>
                                    <div class="col-sm-8">
                                        <?php echo 'Rp. '.set_currency_format($detail->tot_harga_jual); ?>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Diskon</div>
                                    <div class="col-sm-8">
                                        <?php echo 'Rp. '.set_currency_format($detail->diskon); ?>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Biaya Tambahan</div>
                                    <div class="col-sm-8">
                                        <?php echo 'Rp. '.set_currency_format($detail->biaya_tambahan); ?>
                                    </div>
                                </div>

                                <?php if($detail->biaya_pembatalan != 0){ ?>
                                    <div class="row mt-5">
                                        <div class="col-sm-4 text-bold text-right"> Biaya Pembatalan</div>
                                        <div class="col-sm-8">
                                            <?php echo 'Rp. '.set_currency_format($detail->biaya_pembatalan); ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Total Biaya</div>
                                    <div class="col-sm-8">
                                        <?php $total_biaya = $detail->tot_harga_jual - $detail->diskon + $detail->biaya_tambahan + $detail->biaya_pembatalan;
                                        echo 'Rp. '.set_currency_format($total_biaya); ?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">

                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right">Detail Informasi </div>
                                    <div class="col-sm-3">
                                        <a onclick="detailTransPenjualan(<?php echo $id_trans; ?>);" class="btn btn-primary btn-xs pd-btn"><i class="fa fa-info-circle"></i> Detail</a>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Status Transaksi</div>
                                    <div class="col-sm-3">

                                        <?php $status = set_icon_status_transaksi_penjualan($detail->status_transaksi); ?>
                                        <span class="btn btn-xs btn-<?php echo $status['color']; ?> text-center pd-btn"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $detail->status_transaksi; ?></span>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Status Pembayaran</div>
                                    <div class="col-sm-3">
                                        <?php $status = set_icon_status_pembayaran_penjualan($detail->status_pembayaran); ?>
                                        <span class="btn btn-xs btn-<?php echo $status['color']; ?> text-center pd-btn"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $detail->status_pembayaran; ?></span>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-sm-4 text-bold text-right"> Status Pengiriman</div>
                                    <div class="col-sm-3">
                                        <?php $status = set_icon_status_pengiriman_penjualan($detail->status_pengiriman); ?>
                                        <span class="btn btn-xs btn-<?php echo $status['color']; ?> text-center pd-btn"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $detail->status_pengiriman; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if(!empty($data_pembayaran)){ ?>

                            <hr class="mb-0">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4><i class="fa fa-list"></i> Data Pembayaran</h4>
                            </div>
                            <div class="col-sm-10 col-sm-offset-1">

                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="wrap">Aksi</th>
                                        <th class="wrap">Waktu Pembayaran</th>
                                        <th class="wrap">Metode Pembayaran</th>
                                        <th class="wrap text-right">Nominal</th>
                                        <th class="">Catatan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $nominal = 0; foreach ($data_pembayaran as $r){ ?>
                                        <tr>
                                            <td class="wrap">
                                                <?php if($detail->status_transaksi != 'SELESAI'){ ?>
                                                <div class="btn-group">
                                                    <?php if ($updateAct || $updateActOwn){ ?>
                                                        <a href="<?php echo site_url('trans_penjualan/create_edit_pembayaran/'.$id_trans.'/'.$r->id_pembayaran); ?>" class="btn btn-info btn-flat btn-xs"><i class="fa fa-pencil"></i></a>
                                                    <?php } ?>

                                                    <?php if ($deleteAct || $deleteActOwn){ ?>
                                                        <a href="<?php echo site_url('trans_penjualan/hapus_pembayaran/'.$id_trans.'/'.$r->id_pembayaran); ?>" class="btn btn-danger btn-flat btn-xs" data-confirm="Anda yakin akan menghapus data ini? <strong class='pull-right' style='color:#000;'></strong>" data-box-title="Konfirmasi" data-box-class="modal-danger"><i class="fa fa-times"></i></a>
                                                    <?php } ?>

                                                </div>
                                                <?php } ?>
                                            </td>
                                            <td class="wrap"><?php echo set_indo_time($r->waktu_pembayaran); ?></td>
                                            <td class="wrap"><?php echo $r->metode_pembayaran; ?></td>
                                            <td class="wrap text-right"><?php echo 'Rp. '.set_currency_format($r->nominal); ?></td>
                                            <td><?php echo $r->catatan; ?></td>
                                        </tr>

                                    <?php $nominal += $r->nominal; } ?>
                                    <tr class="bg-gray" style="font-weight: bold;">
                                        <td colspan="3" class="center">TOTAL PEMBAYARAN</td>
                                        <td class="wrap text-right"><?php echo 'Rp. '.set_currency_format($nominal); ?></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                            <?php } ?>

                        <?php if($detail->status_transaksi != 'SELESAI'){ ?>
                        <hr class="mb-0">
                        <div class="row">
                            <div class="col-sm-12 mb-10">
                                <h4><i class="fa fa-<?php echo isset($edit) ? 'pencil' : 'plus-circle'; ?>"></i> <?php echo isset($edit) ? 'Edit ' : ''; ?>Pembayaran <?php echo isset($edit) ? '' : 'Baru'; ?></h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Pembayaran <label class="text-red">*</label></label>

                            <div class="col-sm-6">
                                <input type="hidden" name="id_trans" value="<?php echo $id_trans; ?>">
                                <?php if(isset($edit)){ ?>
                                    <input type="hidden" name="id_pembayaran" value="<?php echo (isset($edit)) ? $edit->id_pembayaran : ''; ?>">
                                    <input type="hidden" name="id_trans" value="<?php echo (isset($edit)) ? $id_trans : ''; ?>">
                                <?php } ?>
                                <input type="text" name="waktu_pembayaran" class="form-control datetimepicker2" placeholder="Masukkan waktu pembayaran" required value="<?php echo (isset($edit)) ? $edit->waktu_pembayaran : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Metode Pembayaran <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <select class="form-control" name="metode_pembayaran">
                                    <option selected disabled>Pilih Salah Satu</option>
                                    <?php foreach ($metode_pembayaran as $r){ ?>
                                        <option value="<?php echo $r; ?>" <?php if(isset($edit) && $edit->metode_pembayaran == $r) echo 'selected'; ?> ><?php echo $r; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nominal Pembayaran <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control nominal" name="nominal" placeholder="Masukkan nominal pembayaran" value="<?php echo (isset($edit)) ? set_currency_format($edit->nominal): '0'; ?>">
                                <div class="help-block" style="font-style: italic;"><a style="cursor: pointer;" onclick="getTotalBiaya()">Gunakan Total Biaya</a></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Catatan</label>

                            <div class="col-sm-6">
                                <textarea class="form-control" name="catatan" placeholder="Masukkan catatan pembayaran"><?php echo (isset($edit)) ? $edit->catatan : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button> &nbsp;
                                <button type="reset" class="btn btn-danger"><i class="fa fa-close"></i> Reset</button> &nbsp;
                                <a href="<?php echo site_url('trans_penjualan/index'); ?>"><button type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</button></a>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <a href="<?php echo site_url('trans_penjualan/index'); ?>"><button type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</button></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
</section>

<div id="show-modal"></div>

<script>

    function detailTransPenjualan(id) {
        $.post("<?php echo site_url("trans_penjualan/detail") ?>/"+id, {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
            $('#detail').modal('show');
        });
    }

    function getTotalBiaya() {
        var total = '<?php echo set_currency_format($total_biaya); ?>';
        $("input[name='nominal']").val(total);
    }
</script>