
<div class="modal fade" id="detail" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> <?php echo $halaman; ?></h4>
            </div>
            <div class="modal-body">

				<div class="row">
                    <label class="col-sm-4 control-label"> Nama</label>
                    <div class="col-sm-7">
                        <?php echo $detail->nama; ?>
                    </div>
                </div>
                <?php if($detail->nama_reseller != NULL){ ?>
				<div class="row">
                    <label class="col-sm-4 control-label"> Reseller Upline</label>
                    <div class="col-sm-7">
                        <?php echo $detail->nama_reseller; ?>
                    </div>
                </div>
                <?php } ?>
				<div class="row">
                    <label class="col-sm-4 control-label"> Alamat</label>
                    <div class="col-sm-7">
                        <?php echo $detail->alamat; ?>
                    </div>
                </div>
				<div class="row">
                    <label class="col-sm-4 control-label"> No. Telepon</label>
                    <div class="col-sm-7">
                        <?php echo $detail->no_telp; ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Keterangan</label>
                    <div class="col-sm-7">
                        <?php echo $detail->keterangan; ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Waktu Ditambahkan</label>
                    <div class="col-sm-7">
                        <?php echo $detail->created_time; ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Waktu Terakhir Diubah</label>
                    <div class="col-sm-7">
                        <?php echo $detail->last_modified_time; ?>
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
                    <a href="<?php echo site_url('pelanggan/create_edit/'.$detail->id_pelanggan); ?>"> <button type="button" class="btn btn-info mr-10"><i class="fa fa-pencil-square-o"></i> Edit</button></a>
                <?php } ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                </a>
            </div>
        </div>
    </div>
</div>