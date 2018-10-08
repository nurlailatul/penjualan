
<div class="modal fade" id="detail" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h4 class="modal-title"><i class="fa fa-history"></i> <?php echo $halaman; ?></h4>
            </div>
            <div class="modal-body">

                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive" style="margin-top:5px;">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th class="wrap text-left">No</th>
                                <th class="wrap">Waktu Proses</th>
                                <th class="wrap center">User Pengubah</th>
                                <th class="wrap center">Status Transaksi</th>
                                <th class="wrap center">Status Pembayaran</th>
                                <th class="wrap center">Status Pengiriman</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $n = 1;
                            foreach ($data_process as $r){
                            ?>
                            <tr>
                                <td><?php echo $n++; ?></td>
                                <td><?php echo set_indo_time($r->waktu_proses); ?></td>
                                <td class=" center"><?php echo $r->real_name; ?></td>

                                <td class="wrap center">
                                    <?php $status = set_icon_status_transaksi_penjualan($r->status_transaksi); ?>
                                    <span class="btn btn-xs btn-<?php echo $status['color']; ?> btn-block text-center pd-btn"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $r->status_transaksi; ?></span>
                                </td>
                                <td class="wrap center">
                                    <?php $status = set_icon_status_pembayaran_penjualan($r->status_pembayaran); ?>
                                    <span class="btn btn-xs btn-<?php echo $status['color']; ?> btn-block text-center pd-btn"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $r->status_pembayaran; ?></span>
                                </td>
                                <td class="wrap center">
                                    <?php $status = set_icon_status_pengiriman_penjualan($r->status_pengiriman); ?>
                                    <span class="btn btn-xs btn-<?php echo $status['color']; ?> btn-block text-center pd-btn"><i class="fa fa-<?php echo $status['icon']; ?>"></i> <?php echo $r->status_pengiriman; ?></span>
                                </td>
                            </tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                </a>
            </div>
        </div>
    </div>
</div>