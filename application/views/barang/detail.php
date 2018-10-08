
<div class="modal fade" id="detail" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> <?php echo $halaman; ?></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <label class="col-sm-4 control-label"> Kode</label>
                    <div class="col-sm-7">
                        <?php echo $detail->kode; ?>
                    </div>
                </div>
				<div class="row">
                    <label class="col-sm-4 control-label"> Nama</label>
                    <div class="col-sm-7">
                        <?php echo $detail->nama; ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Harga Beli</label>
                    <div class="col-sm-7">
                        Rp. <?php echo set_currency_format($detail->harga_beli); ?>
                    </div>
                </div>
				<div class="row">
                    <label class="col-sm-4 control-label"> Harga Reseller</label>
                    <div class="col-sm-7">
                        Rp. <?php echo set_currency_format($detail->harga_reseller); ?>
                    </div>
                </div>
				<div class="row">
                    <label class="col-sm-4 control-label"> Harga Umum</label>
                    <div class="col-sm-7">
                        Rp. <?php echo set_currency_format($detail->harga_umum); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Deskripsi</label>
                    <div class="col-sm-7">
                        <?php echo $detail->deskripsi; ?>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-4 control-label"> Waktu Ditambahkan</label>
                    <div class="col-sm-7">
                        <?php echo set_indo_time($detail->created_time); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Waktu Terakhir Diubah</label>
                    <div class="col-sm-7">
                        <?php echo set_indo_time($detail->last_modified_time); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Terakhir Diubah Oleh</label>
                    <div class="col-sm-7">
                        <?php echo $detail->real_name; ?>
                    </div>
                </div>

                <hr>
            </div>
            <div class="modal-footer">
                <?php if ($updateAct || $updateActOwn){ ?>
                    <a href="<?php echo site_url('barang/create_edit/'.$detail->id_barang); ?>"> <button type="button" class="btn btn-info mr-10"><i class="fa fa-pencil-square-o"></i> Edit</button></a>
                <?php } ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                </a>
            </div>
        </div>
    </div>
</div>