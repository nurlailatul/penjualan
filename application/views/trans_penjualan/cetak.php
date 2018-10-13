<html>
<head>

    <link href="<?php echo base_url("/public/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css">
<style>
    td {
        border: none !important;
    }
</style>

    <script>
        window.print();
    </script>
<body>

<div class="nav-tabs-custom">
    <div>
        <h3 class="text-center">AMANAH SHOP</h3>
        <div class="text-center">Jalan Teluk Pelabuhan Ratu 52 RT 02, RW 03, Arjosari, Malang</div>
        <hr style="border-style: dashed; border-color: #8f8d91;">
        <div>
            <table class="table">
                <tr>
                    <td width="40%">Waktu Transaksi</td>
                    <td width="60%"><?php echo set_indo_time($detail->waktu_transaksi); ?></td>
                </tr>
                <tr>
                    <td>Jenis Transaksi</td>
                    <td><?php echo $detail->jenis_transaksi; ?></td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td><?php echo $detail->pelanggan; ?></td>
                </tr>
                <tr>
                    <td>Status Transaksi</td>
                    <td><?php echo $detail->status_transaksi; ?></td>
                </tr>

            </table>
        </div>
        <div>
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
                                <td class="text-right"><?php echo 'Rp. '.set_currency_format($r->harga_satuan); ?></td>
                                <td class="text-right"><?php echo $r->jumlah_pax; ?></td>
                                <td class="text-right"><?php echo 'Rp. '.set_currency_format($r->total); ?></td>
                            </tr>
                        <?php }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr class="">
                            <th colspan="4" class="center">TOTAL</th>
                            <th class=" text-right"><?php echo 'Rp. '.set_currency_format($total_harga); ?></th>
                        </tr>
                        <tr class="">
                            <th colspan="4" class="center">Diskon</th>
                            <th class=" text-right">- <?php echo 'Rp. '.set_currency_format($detail->diskon); ?></th>
                        </tr>
                        <tr class="">
                            <th colspan="4" class="center">Biaya Tambahan</th>
                            <th class=" text-right"><?php echo 'Rp. '.set_currency_format($detail->biaya_tambahan); ?></th>
                        </tr>

                        <?php $total = $total_harga - $detail->diskon + $detail->biaya_tambahan; ?>
                        <tr>
                            <th colspan="4" class="center">TOTAL HARGA</th>
                            <th class=" text-right"><?php echo 'Rp. '.set_currency_format($total); ?></th>
                        </tr>



                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <!--<div>
            <table class="table">
                <?php /*if(!empty($data_pembayaran)){
                    $r = $data_pembayaran[0]; */?>
                      <tr>
                          <td width="40%">Waktu Pembayaran</td>
                          <td width="60%"><?php /*echo set_indo_time($r->waktu_pembayaran); */?></td>
                      </tr>
                      <tr>
                          <td>Metode Pembayaran</td>
                          <td><?php /*echo $r->metode_pembayaran; */?></td>
                      </tr>
                      <tr>
                          <td>Nominal</td>
                          <td><?php /*echo 'Rp. '.'Rp. '.set_currency_format($r->nominal); */?></td>
                      </tr>

                <?php /*} */?>
                <tr>
                    <td>Status Pembayaran</td>
                    <td><?php /*echo $detail->status_pembayaran */?></td>
                </tr>
              </table>
        </div>
        <div>

            <?php /*if(isset($data_pengiriman) && !empty($data_pengiriman)){ */?>
              <table class="table">
                  <tr>
                      <td width="40%">Waktu Pengiriman</td>
                      <td width="60%"><?php /*echo set_indo_time($data_pengiriman->waktu_pengiriman); */?></td>
                  </tr>
                  <tr>
                      <td>Jenis EKspedisi</td>
                      <td><?php /*echo $data_pengiriman->nama_ekspedisi; */?></td>
                  </tr>
              <?php /*if($data_pengiriman->no_resi != NULL){ */?>
                  <tr>
                      <td>No. Resi</td>
                      <td><?php /*echo $data_pengiriman->no_resi; */?></td>
                  </tr>
                <?php /*} */?>
                <?php /*if($data_pengiriman->id_kurir!= NULL){ */?>
                  <tr>
                      <td>Kurir</td>
                      <td><?php /*echo $data_pengiriman->nama_pegawai; */?></td>
                  </tr>
                <?php /*} */?>
                  <tr>
                      <td>Biaya Pengiriman</td>
                      <td><?php /*echo 'Rp. '.set_currency_format($data_pengiriman->biaya_pengiriman); */?></td>
                  </tr>
                  <tr>
                      <td>Waktu Sampai</td>
                      <td><?php /*echo set_indo_time($data_pengiriman->waktu_sampai); */?></td>
                  </tr>
                  <tr>
                      <td>Status Pengiriman</td>
                      <td><?php /*echo $detail->status_pengiriman; */?></td>
                  </tr>
              </table>
            <?php /*} */?>
        </div>-->
        <hr style="border-style: dashed; border-color: #8f8d91;">
        <div class="text-center">Terima kasih telah berbelanja di toko kami.</div>
    </div>
</div>

<hr>
</body>

</html>
