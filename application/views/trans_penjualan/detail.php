
<div class="modal fade" id="detail" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> <?php echo $halaman; ?></h4>
            </div>
            <div class="modal-body">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Transaksi</a></li>
                        <li><a href="#tab_2" data-toggle="tab">List Barang</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Pengiriman</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Pembayaran</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <hr>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Waktu Transaksi</label>
                                <div class="col-sm-7">
                                    <?php echo set_indo_time($detail->waktu_transaksi); ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Jenis Transaksi</label>
                                <div class="col-sm-7">
                                    <?php echo $detail->jenis_transaksi; ?>
                                </div>
                            </div>
                            <?php if($detail->nama_reseller != NULL){ ?>
                                <div class="row">
                                    <label class="col-sm-4 control-label"> Reseller</label>
                                    <div class="col-sm-7">
                                        <?php echo $detail->nama_reseller; ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Pelanggan</label>
                                <div class="col-sm-7">
                                    <?php echo $detail->pelanggan; ?>
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
                                    <?php $status = set_icon_status_transaksi_penjualan($detail->status_transaksi); ?>
                                    <span class="btn btn-xs btn-<?php echo $status['color']; ?> text-center pd-btn mt-5"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $detail->status_transaksi; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Status Pembayaran</label>
                                <div class="col-sm-7">
                                    <?php $status = set_icon_status_pembayaran_penjualan($detail->status_pembayaran); ?>
                                    <span class="btn btn-xs btn-<?php echo $status['color']; ?> text-center pd-btn mt-5"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $detail->status_pembayaran; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Status Pengiriman</label>
                                <div class="col-sm-7">
                                    <?php $status = set_icon_status_pengiriman_penjualan($detail->status_pengiriman); ?>
                                    <span class="btn btn-xs btn-<?php echo $status['color']; ?> text-center pd-btn mt-5"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $detail->status_pengiriman; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <hr>
                            <h4><i class="fa fa-arrow-circle-right"></i> List Barang</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                    <table class="table table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th class="wrap text-left">No</th>
                                            <th class="wrap">Barang</th>
                                            <th class="wrap text-right">Harga @</th>
                                            <th class="wrap text-right">Pcs</th>
                                            <th class="wrap  text-right">(n) Harga</th>
                                            <th class="wrap  text-right">Laba</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $total_harga = 0; $total_laba = 0; $n = 1;
                                        foreach ($list_barang as $r){
                                            $total_harga += $r->total;
                                            $laba = $r->laba*$r->jumlah_pax;
                                            $total_laba += $laba;
                                            ?>
                                            <tr>
                                                <td><?php echo $n++; ?></td>
                                                <td><?php echo $r->nama_barang; ?></td>
                                                <td class="text-right"><?php echo set_currency_format($r->harga_satuan); ?></td>
                                                <td class="text-right"><?php echo $r->jumlah_pax; ?></td>
                                                <td class="text-right"><?php echo set_currency_format($r->total); ?></td>
                                                    <td class="text-right"><?php echo set_currency_format($laba); ?></td>
                                            </tr>
                                        <?php }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr class="">
                                            <th colspan="4" class="center">TOTAL</th>
                                            <th class=" text-right"><?php echo set_currency_format($total_harga); ?></th>
                                                <th class=" text-right"><?php echo set_currency_format($total_laba); ?></th>
                                        </tr>
                                        <tr class="">
                                            <th colspan="4" class="center">DISKON</th>
                                            <th class=" text-right">- <?php echo set_currency_format($detail->diskon); ?></th>
                                        </tr>
                                        <tr class="">
                                            <th colspan="4" class="center">BIAYA TAMBAHAN</th>
                                            <th class=" text-right"><?php echo set_currency_format($detail->biaya_tambahan); ?></th>
                                        </tr>
                                        <?php if($detail->biaya_pembatalan != 0){ ?>
                                            <tr class="">
                                                <th colspan="4" class="center">BIAYA PEMBATALAN</th>
                                                <th class=" text-right"><?php echo set_currency_format($detail->biaya_pembatalan); ?></th>
                                            </tr>
                                        <?php } ?>
                                        <?php $total = $total_harga - $detail->diskon + $detail->biaya_tambahan + $detail->biaya_pembatalan; ?>
                                        <tr class="bg-gray">
                                            <th colspan="4" class="center">TOTAL HARGA BARANG</th>
                                            <th class=" text-right"><?php echo set_currency_format($total); ?></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <hr>

                            <div class="row">
                                <label class="col-sm-4 control-label"> Total Harga Barang</label>
                                <div class="col-sm-7">
                                    <?php echo 'Rp. '.set_currency_format($detail->tot_harga_jual); ?>
                                </div>
                            </div>

                            <?php if($detail->diskon != 0){ ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Diskon</label>
                                <div class="col-sm-7">
                                    <?php echo 'Rp. '.set_currency_format($detail->diskon); ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if($detail->biaya_tambahan != 0){ ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Biaya Tambahan</label>
                                <div class="col-sm-7">
                                    <?php echo 'Rp. '.set_currency_format($detail->biaya_tambahan); ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if($detail->biaya_pembatalan != 0){ ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Biaya Pembatalan</label>
                                <div class="col-sm-7">
                                    <?php echo 'Rp. '.set_currency_format($detail->biaya_pembatalan); ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php $biaya_pengiriman = 0;
                            if(isset($data_pengiriman) && !empty($data_pengiriman)){
                                $biaya_pengiriman = $data_pengiriman->biaya_pengiriman; ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Biaya Pengiriman</label>
                                <div class="col-sm-7">
                                    <?php echo 'Rp. '.set_currency_format($biaya_pengiriman); ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php $pembayaran = $detail->tot_harga_jual - $detail->diskon +$detail->biaya_tambahan + $detail->biaya_pembatalan + $biaya_pengiriman; ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Total Yang Harus Dibayar</label>
                                <div class="col-sm-7">
                                    <?php echo 'Rp. '.set_currency_format($pembayaran); ?>
                                </div>
                            </div>
                            <hr>
                            <?php if(!empty($data_pembayaran)){ ?>
                                <h4><i class="fa fa-money"></i> Data Pembayaran</h4>
                                <div class="row">
                                    <div class="col-sm-12">

                                        <table class="table table-hover table-responsive">
                                            <thead>
                                            <tr>
                                                <th class="wrap">Waktu Pembayaran</th>
                                                <th class="wrap">Metode Pembayaran</th>
                                                <th class="wrap text-right">Nominal</th>
                                                <th class="">Catatan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $nominal = 0; foreach ($data_pembayaran as $r){ ?>
                                                <tr>
                                                    <td class="wrap"><?php echo set_indo_time($r->waktu_pembayaran); ?></td>
                                                    <td class="wrap"><?php echo $r->metode_pembayaran; ?></td>
                                                    <td class="wrap text-right"><?php echo 'Rp. '.set_currency_format($r->nominal); ?></td>
                                                    <td><?php echo $r->catatan; ?></td>
                                                </tr>

                                                <?php $nominal += $r->nominal; } ?>
                                            <tr class="bg-gray" style="font-weight: bold;">
                                                <td colspan="2" class="center">TOTAL PEMBAYARAN</td>
                                                <td class="wrap text-right"><?php echo 'Rp. '.set_currency_format($nominal); ?></td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <?php }  else { ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="callout callout-danger" >
                                            <h4>Data Kosong!</h4>
                                            <p>Belum ada data pembayaran</p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane" id="tab_4">

                            <hr>
                            <?php if(isset($data_pengiriman) && !empty($data_pengiriman)){ ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Waktu Pengiriman</label>
                                <div class="col-sm-7">
                                    <?php echo set_indo_time($data_pengiriman->waktu_pengiriman); ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Jenis Ekspedisi</label>
                                <div class="col-sm-7">
                                    <?php echo $data_pengiriman->nama_ekspedisi; ?>
                                </div>
                            </div>
                                <?php if($data_pengiriman->no_resi != NULL){ ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> No Resi</label>
                                <div class="col-sm-7">
                                    <?php echo $data_pengiriman->no_resi; ?>
                                </div>
                            </div>
                                <?php } ?>
                                <?php if($data_pengiriman->id_kurir!= NULL){ ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Kurir</label>
                                <div class="col-sm-7">
                                    <?php echo $data_pengiriman->nama_pegawai; ?>
                                </div>
                            </div>
                                <?php } ?>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Biaya Pengiriman</label>
                                <div class="col-sm-7">
                                    <?php echo set_currency_format($data_pengiriman->biaya_pengiriman); ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Catatan</label>
                                <div class="col-sm-7">
                                    <?php echo $data_pengiriman->catatan; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label"> Waktu Sampai</label>
                                <div class="col-sm-7">
                                    <?php echo set_indo_time($data_pengiriman->waktu_sampai); ?>
                                </div>
                            </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="callout callout-danger" >
                                            <h4>Data Kosong!</h4>
                                            <p>Belum ada data pengiriman</p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <hr>
            </div>
            <div class="modal-footer">
                <?php if ($updateAct || $updateActOwn){ ?>
                    <a href="<?php echo site_url('trans_penjualan/create_edit/'.$detail->id_trans); ?>"> <button type="button" class="btn btn-info mr-10"><i class="fa fa-pencil-square-o"></i> Edit</button></a>
                <?php } ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                </a>
            </div>
        </div>
    </div>
</div>