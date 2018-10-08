<section class="content-header">
    <h1>
        <span class="fa fa-pencil-square-o"></span>&nbsp; <?php echo $halaman; ?>
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
                                        <?php echo 'Rp. '.set_currency_format($detail->tot_harga_jual - $detail->diskon + $detail->biaya_tambahan + $detail->biaya_pembatalan); ?>
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
                        <hr>

                        <div class="<?php echo isset($is_selesai) ? 'row' : 'form-group'; ?>">
                            <label class="col-sm-2 control-label">Waktu Pengiriman <label class="text-red">*</label></label>

                            <div class="col-sm-6">
                                <?php if(isset($is_selesai)){
                                    echo '<div class="mt-5">'.set_indo_time($edit->waktu_pengiriman).'</div>';
                                } else { ?>
                                <input type="hidden" name="id_trans" value="<?php echo $id_trans; ?>">
                                <?php if(isset($edit)){ ?>
                                    <input type="hidden" name="id_pengiriman" value="<?php echo (isset($edit)) ? $edit->id_pengiriman : ''; ?>">
                                <?php } ?>
                                <input type="text" name="waktu_pengiriman" class="form-control datetimepicker2" placeholder="Masukkan waktu pengiriman" required value="<?php echo (isset($edit)) ? $edit->waktu_pengiriman : ''; ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="<?php echo isset($is_selesai) ? 'row' : 'form-group'; ?>">
                            <label class="col-sm-2 control-label">Jenis Ekspedisi <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <?php if(isset($is_selesai)){
                                    echo '<div class="mt-5">'.$edit->nama_ekspedisi.'</div>';
                                } else { ?>
                                <select class="form-control chosen-select" name="jenis_ekspedisi" data-placeholder="Pilih Jenis Ekspedisi" onchange="changeEkspedisi(this.value)">
                                    <option></option>
                                    <?php foreach ($jenis_ekspedisi as $r){ ?>
                                        <option value="<?php echo $r->id_jenis; ?>" <?php if(isset($edit) && $edit->jenis_ekspedisi == $r->id_jenis) echo 'selected'; ?> ><?php echo $r->nama; ?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="<?php echo isset($is_selesai) ? 'row' : 'form-group'; ?>" id="kurir" style="display: <?php if(isset($edit) && $edit->id_kurir != NULL) echo 'block'; else echo 'none'; ?>">
                            <label class="col-sm-2 control-label">Kurir </label>

                            <div class="col-sm-6">
                                <?php if(isset($is_selesai)){
                                    echo '<div class="mt-5">'.$edit->nama_pegawai.'</div>';
                                } else { ?>
                                <select class="form-control chosen-select" name="id_kurir" data-placeholder="Pilih Kurir Pengantar" style="width: 100%;">
                                    <option></option>
                                    <?php foreach ($data_pegawai as $r){ ?>
                                        <option value="<?php echo $r->id_pegawai; ?>" <?php if(isset($edit) && $edit->id_kurir == $r->id_pegawai) echo 'selected'; ?> ><?php echo $r->nama; ?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="<?php echo isset($is_selesai) ? 'row' : 'form-group'; ?>" id="no_resi" style="display: <?php if(isset($edit) && $edit->no_resi != NULL) echo 'block'; else echo 'none'; ?>;">
                            <label class="col-sm-2 control-label">No. Resi</label>

                            <div class="col-sm-6">
                                <?php if(isset($is_selesai)){
                                    echo '<div class="mt-5">'.$edit->no_resi.'</div>';
                                } else { ?>
                                <input type="text" class="form-control" name="no_resi" placeholder="Masukkan no resi" value="<?php echo (isset($edit)) ? $edit->no_resi : ''; ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="<?php echo isset($is_selesai) ? 'row' : 'form-group'; ?>">
                            <label class="col-sm-2 control-label">Biaya Pengiriman <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <?php if(isset($is_selesai)){
                                    echo '<div class="mt-5">Rp. '.set_currency_format($edit->biaya_pengiriman).'</div>';
                                } else { ?>
                                <input type="text" class="form-control nominal" name="biaya_pengiriman" placeholder="Masukkan biaya pengiriman" value="<?php echo (isset($edit)) ? set_currency_format($edit->biaya_pengiriman): '0'; ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="<?php echo isset($is_selesai) ? 'row' : 'form-group'; ?>">
                            <label class="col-sm-2 control-label">Catatan</label>

                            <div class="col-sm-6">
                                <?php if(isset($is_selesai)){
                                    echo '<div class="mt-5">'.$edit->catatan.'</div>';
                                } else { ?>
                                <textarea class="form-control" name="catatan" placeholder="Masukkan catatan pengiriman"><?php echo (isset($edit)) ? $edit->catatan : ''; ?></textarea>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="<?php echo isset($is_selesai) ? 'row' : 'form-group'; ?>">
                            <label class="col-sm-2 control-label">Waktu Sampai <label class="text-red">*</label></label>

                            <div class="col-sm-6">
                                <?php if(isset($is_selesai)){
                                    echo '<div class="mt-5">'.$edit->waktu_sampai.'</div>';
                                } else { ?>
                                <input type="text" name="waktu_sampai" class="form-control datetimepicker2" placeholder="Masukkan waktu barang sampai" value="<?php echo (isset($edit)) ? $edit->waktu_sampai: ''; ?>">
                                <div class="help-block" style="font-style: italic;">Isi jika barang telah sampai</div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <?php if(!isset($is_selesai)){ ?>
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button> &nbsp;
                                <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button> &nbsp;
                                <?php } ?>
                                <a href="<?php echo site_url('trans_penjualan/index'); ?>"><button type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</button></a>
                            </div>
                        </div>
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
    function changeEkspedisi(jenis) {
        if(jenis == '1'){ // Kurir Sendiri
            $("#kurir").css("display","block");
            $("#no_resi").css("display","none");
            $("input[name='no_resi']").val('');
        }
        else if(jenis != '2' && jenis != '9'){ // Bukan ambil di toko dan bukan ekspedisi lain
            $("#kurir").css("display","none");
            $("select[name='id_kurir']").val(null).trigger("change");
            $("#no_resi").css("display","block");
        } else {
            $("input[name='no_resi']").val('');
            $("select[name='id_kurir']").val(null).trigger("change");
            $("#kurir").css("display","none");
            $("#no_resi").css("display","none");
        }
    }

    function detailTransPenjualan(id) {
        $.post("<?php echo site_url("trans_penjualan/detail") ?>/"+id, {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
            $('#detail').modal('show');
        });
    }
</script>