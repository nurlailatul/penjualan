
<div class="modal fade" id="detail" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> <?php echo $halaman; ?></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <label class="col-sm-4 control-label"> Waktu Transaksi</label>
                    <div class="col-sm-7">
                        <?php echo set_indo_time($detail->waktu_transaksi); ?>
                    </div>
                </div>
				<div class="row">
                    <label class="col-sm-4 control-label"> Supplier</label>
                    <div class="col-sm-7">
                        <?php echo $detail->supplier; ?>
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
                        <?php echo set_indo_time($detail->last_upd_time); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Terakhir Diubah Oleh</label>
                    <div class="col-sm-7">
                        <?php echo $detail->real_name; ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label"> Status Transaksi</label>
                    <div class="col-sm-7">
                        <?php $status = set_icon_status_transaksi_pembelian($detail->status_transaksi); ?>
                        <span class="btn btn-xs btn-<?php echo $status['color']; ?> pd-btn"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $detail->status_transaksi; ?></span>
                    </div>
                </div>
                <hr>
                <h4><i class="fa fa-arrow-circle-right"></i> List Barang</h4>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th class="wrap text-left">No</th>
                                <th class="wrap">Barang</th>
                                <th class="wrap text-right">Harga @</th>
                                <th class="wrap text-right">Jml Pcs</th>
                                <th class="wrap  text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $biaya_pembelian = 0; $n = 1;
                            foreach ($list_barang as $r){
                                $biaya_pembelian += $r->total;
                            ?>
                            <tr>
                                <td><?php echo $n++; ?></td>
                                <td><?php echo $r->nama_barang; ?></td>
                                <td class="text-right">Rp. <?php echo set_currency_format($r->harga_satuan); ?></td>
                                <td class="text-right"><?php echo $r->jumlah_pax; ?></td>
                                <td class="text-right">Rp. <?php echo set_currency_format($r->total); ?></td>
                            </tr>
                            <?php }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr class="">
                                <th colspan="4" class="center">TOTAL HARGA BARANG</th>
                                <th class=" text-right">Rp. <?php echo set_currency_format($biaya_pembelian); ?></th>
                            </tr>
                            <tr class="">
                                <th colspan="4" class="center">BIAYA TAMBAHAN</th>
                                <th class=" text-right">Rp. <?php echo set_currency_format($detail->biaya_tambahan); ?></th>
                            </tr>
                            <?php $total = $detail->biaya_tambahan + $biaya_pembelian; ?>
                            <tr class="bg-gray">
                                <th colspan="4" class="center">BIAYA PEMBELIAN</th>
                                <th class=" text-right">Rp. <?php echo set_currency_format($total); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <hr>
            </div>
            <div class="modal-footer">
                <?php if ($updateAct || $updateActOwn){ ?>
                    <a href="<?php echo site_url('trans_pembelian/create_edit/'.$detail->id_trans); ?>"> <button type="button" class="btn btn-info mr-10"><i class="fa fa-pencil-square-o"></i> Edit</button></a>
                <?php } ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                </a>
            </div>
        </div>
    </div>
</div>