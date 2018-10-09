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
<!-- form start -->
<form class="form-horizontal" method="post" enctype="multipart/form-data" id="frm_trx">
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lengkapi form di bawah ini! &nbsp; <small>Field bertanda (<label class="text-red">*</label>) harus diisi.</small></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Transaksi <label class="text-red">*</label> </label>

                        <div class="col-sm-6">
                            <?php if(isset($edit)){ ?>
                                <input type="hidden" name="id_trans" value="<?php echo (isset($edit)) ? $edit->id_trans : ''; ?>">
                            <?php } ?>
                            <select class="form-control" name="jenis_transaksi" style="width: 100%;" onchange="changeJenisTransaksi(this.value)" <?php echo isset($edit) ? 'disabled' : ''; ?>>
                                <option selected disabled>Pilih Salah Satu</option>
                                <?php foreach ($jenis_transaksi as $r){ ?>
                                    <option value="<?php echo $r; ?>" <?php echo (isset($edit) && $r == $edit->jenis_transaksi) ? 'selected': ''; ?>><?php echo $r; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="reseller" style="display:<?php if(isset($edit) && $edit->id_reseller != NULL) echo 'block'; else echo 'none'; ?>;">
                        <label class="col-sm-2 control-label">Reseller <label class="text-red">*</label> </label>

                        <div class="col-sm-6">
                            <select class="form-control chosen-select" name="id_reseller" data-placeholder="Pilih Reseller" style="width: 100%;">
                                <option></option>
                                <?php foreach ($data_reseller as $r){ ?>
                                    <option value="<?php echo $r->id_pelanggan; ?>" <?php echo (isset($edit) && $r->id_pelanggan == $edit->id_reseller) ? 'selected': ''; ?>><?php echo $r->nama.' - '.$r->no_telp.' - '.$r->alamat; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pelanggan <label class="text-red">*</label> </label>

                        <div class="col-sm-6">
                            <select class="form-control chosen-select" name="id_pelanggan" data-placeholder="Pilih Pelanggan" style="width: 100%;" onchange="onChangePelanggan()">
                                <option></option>
                                <option value="new">Pelanggan Baru</option>
                                <?php foreach ($data_pelanggan as $r){ ?>
                                    <option value="<?php echo $r->id_pelanggan; ?>" <?php echo (isset($edit) && $r->id_pelanggan == $edit->id_pelanggan) ? 'selected': ''; ?>><?php echo $r->nama.' - '.$r->no_telp.' - '.$r->alamat; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="pelanggan_baru" style="display:none;">
                        <label class="col-sm-2 control-label">Pelanggan Baru </label>

                        <div class="col-sm-6">
                            <input type="text" name="pelanggan_baru" class="form-control" placeholder="Masukkan nama pelanggan baru" maxlength="255">
                            <div class="help-block" style="font-style: italic;">Jika pelanggan belum ditambahkan</div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Waktu Transaksi <label class="text-red">*</label></label>

                        <div class="col-sm-6">
                            <input type="text" name="waktu_transaksi" id="waktuTransaksi" class="form-control datetimepicker2" placeholder="Masukkan waktu transaksi" required value="<?php echo (isset($edit)) ? $edit->waktu_transaksi : ''; ?>">
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cari Barang <label class="text-red">*</label> </label>
                        <div class="col-sm-6">
                            <div id="transaksi_null" style="display:  <?php echo !isset($edit) ? 'block' : 'none'; ?>;">
                                <select class="form-control chosen-select" data-placeholder="Pilih Barang" style="width: 100%;">
                                    <option></option>
                                </select>
                            </div>
                            <div id="transaksi_biasa" style="display: <?php echo isset($edit) && $edit->jenis_transaksi == 'BIASA' ? 'block' : 'none'; ?>;" >
                                <select class="form-control chosen-select" name="transaksi_biasa" data-placeholder="Pilih Barang" style="width: 100%;">
                                    <option></option>
                                    <?php foreach ($data_barang as $r){ ?>
                                        <?php if($r->stok > 0){ ?>
                                            <option value="<?php echo $r->id_history; ?>"><?php echo $r->nama.' - '.set_currency_format($r->harga_umum).'- Stok: '.$r->stok.' - ['.$r->kode.']'; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div id="transaksi_dropship" style="display: <?php echo isset($edit) && $edit->jenis_transaksi == 'DROPSHIP' ? 'block' : 'none'; ?>;" >
                                <select class="form-control chosen-select" name="transaksi_dropship" data-placeholder="Pilih Barang" style="width: 100%;">
                                    <option></option>
                                    <?php foreach ($data_barang as $r){ ?>
                                        <?php if($r->stok > 0){ ?>
                                            <option value="<?php echo $r->id_history; ?>"><?php echo $r->nama.' - '.set_currency_format($r->harga_reseller).'- Stok: '.$r->stok.' - ['.$r->kode.']'; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="help-block" style="font-style: italic;">Cek <a href="<?php echo site_url('barang/index'); ?>">stok barang</a> untuk info lebih lanjut</div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-warning" onclick="pilihBarang()"><i class="fa fa-hand-pointer-o"></i> Pilih </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1" id="daftar_beli">

                            <table class="table table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th class="wrap">Barang</th>
                                    <th class="wrap text-right">Harga @</th>
                                    <th class="wrap text-right">Jml Pcs</th>
                                    <th class="wrap  text-right">Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="list_item">
                                <?php if(isset($list_barang)){
                                    $n = 1; $total_harga = 0;
                                    foreach ($list_barang as $r){
                                        ?>
                                        <tr id="item-<?php echo $r->id_history; ?>-">
                                            <td class="wrap">
                                                <?php echo $r->kode != NULL ? '['.$r->kode.']' : ''; ?>
                                                <?php echo ' '.$r->nama_barang; ?><input type="hidden" name="id_history[]" value="<?php echo $r->id_history; ?>"></td>
                                            <td class="wrap text-right">Rp. <?php echo set_currency_format($r->harga_satuan); ?> <input type="hidden" class="harga_satuan" name="harga_satuan[]" value="<?php echo $r->harga_satuan; ?>"></td>
                                            <td class="text-right"><input type="number" class="jumlah_pax" name="jumlah_pax[]" value="<?php echo $r->jumlah_pax; ?>" style="width: 30%; text-align: center;" placeholder="Jml" onchange="onChangeJml(<?php echo $r->id_history; ?>)">
                                                <?php $total = intval($r->harga_satuan) * intval($r->jumlah_pax); ?>
                                                <input type="hidden" class="total" name="total[]" value="<?php echo $total; ?>"></td>
                                            <td class="wrap td_total  text-right">Rp. <?php echo set_currency_format($total); ?> </td>
                                            <td class="wrap"><button type="button" class="btn btn-danger btn-xs" onclick="removeBarang(<?php echo $r->id_history; ?>)"><i class="fa fa-times"></i> </button> </td>
                                        </tr>
                                <?php
                                        $total_harga += $total;
                                    }
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr class="bg-gray">
                                    <th colspan="3" class="center">TOTAL HARGA BARANG</th>
                                    <th id="total_harga" class=" text-right"><?php echo isset($edit) ? 'Rp. '.set_currency_format($total_harga) : ''; ?></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Diskon (Rp)</label>

                        <div class="col-sm-6">
                            <input type="text" name="diskon" class="form-control nominal" id="diskon" placeholder="Masukkan diskon" value="<?php echo (isset($edit)) ? set_currency_format($edit->diskon): ''; ?>" maxlength="15">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Biaya Tambahan </label>

                        <div class="col-sm-6">
                            <input type="text" name="biaya_tambahan" class="form-control nominal" id="biayaTambahan" placeholder="Masukkan biaya tambahan" value="<?php echo (isset($edit)) ? set_currency_format($edit->biaya_tambahan) : ''; ?>" maxlength="15">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Biaya Pembatalan </label>

                        <div class="col-sm-6">
                            <input type="text" name="biaya_pembatalan" class="form-control nominal" id="biayaPembatalan" placeholder="Masukkan biaya pembatalan" value="<?php echo (isset($edit)) ? set_currency_format($edit->biaya_pembatalan) : ''; ?>" maxlength="15">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Keterangan</label>

                        <div class="col-sm-6">
                            <textarea class="form-control" name="keterangan" placeholder="Masukkan keterangan penjualan"><?php echo (isset($edit)) ? $edit->keterangan : ''; ?></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status Transaksi</label>

                        <div class="col-sm-6">
                            <select class="form-control" name="status_transaksi" id="statusTransaksi" width="100%">
                                <option selected disabled>Pilih Salah Satu</option>
                            <?php foreach ($data_status_transaksi as $r){ ?>
                                <option value="<?php echo $r; ?>" <?php echo (isset($edit) && $edit->status_transaksi == $r) ? 'selected': ''; ?>><?php echo $r; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer -->
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status Pengiriman</label>

                        <div class="col-sm-6">
                            <select class="form-control" name="status_pengiriman" id="statusPengiriman" width="100%">
                                <option selected disabled>Pilih Salah Satu</option>
                              <?php foreach ($data_status_pengiriman as $r){ ?>
                                  <option value="<?php echo $r; ?>" <?php echo (isset($edit) && isset($pengiriman) && $edit->status_pengiriman == $r) ? 'selected': ''; ?>><?php echo $r; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-2 control-label">Waktu Pengiriman</label>

                        <div class="col-sm-6">
                          <?php if(isset($pengiriman)){ ?>
                              <input type="hidden" name="id_pengiriman" value="<?php echo (isset($pengiriman)) ? $pengiriman->id_pengiriman : ''; ?>">
                          <?php } ?>
                            <input type="text" name="waktu_pengiriman" id="waktuPengiriman" class="form-control datetimepicker2" placeholder="Masukkan waktu pengiriman" value="<?php echo (isset($pengiriman)) ? $pengiriman->waktu_pengiriman : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Ekspedisi </label>

                        <div class="col-sm-6">
                            <select class="form-control chosen-select" name="jenis_ekspedisi" id="jenisEkspedisi" data-placeholder="Pilih Jenis Ekspedisi" onchange="changeEkspedisi(this.value)">
                                <option></option>
                              <?php foreach ($jenis_ekspedisi as $r){ ?>
                                  <option value="<?php echo $r->id_jenis; ?>" <?php if(isset($pengiriman) && $pengiriman->jenis_ekspedisi == $r->id_jenis) echo 'selected'; ?> ><?php echo $r->nama; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="kurir" style="display: <?php if(isset($pengiriman) && $pengiriman->id_kurir != NULL) echo 'block'; else echo 'none'; ?>">
                        <label class="col-sm-2 control-label">Kurir </label>

                        <div class="col-sm-6">
                            <select class="form-control chosen-select" name="id_kurir" data-placeholder="Pilih Kurir Pengantar" style="width: 100%;">
                                <option></option>
                              <?php foreach ($data_pegawai as $r){ ?>
                                  <option value="<?php echo $r->id_pegawai; ?>" <?php if(isset($pengiriman) && $pengiriman->id_kurir == $r->id_pegawai) echo 'selected'; ?> ><?php echo $r->nama; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="no_resi" style="display: <?php if(isset($pengiriman) && $pengiriman->no_resi != NULL) echo 'block'; else echo 'none'; ?>;">
                        <label class="col-sm-2 control-label">No. Resi</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="no_resi" placeholder="Masukkan no resi" value="<?php echo (isset($pengiriman)) ? $pengiriman->no_resi : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Biaya Pengiriman </label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control nominal" name="biaya_pengiriman" id="biayaPengiriman" placeholder="Masukkan biaya pengiriman" value="<?php echo (isset($pengiriman)) ? set_currency_format($pengiriman->biaya_pengiriman): ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Catatan</label>

                        <div class="col-sm-6">
                            <textarea class="form-control" name="catatan" placeholder="Masukkan catatan pengiriman"><?php echo (isset($pengiriman)) ? $pengiriman->catatan : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Waktu Sampai</label>

                        <div class="col-sm-6">
                            <input type="text" name="waktu_sampai" id="waktuSampai" class="form-control datetimepicker2" placeholder="Masukkan waktu barang sampai" value="<?php echo (isset($pengiriman)) ? $pengiriman->waktu_sampai: ''; ?>">
                            <div class="help-block" style="font-style: italic;">Isi jika barang telah sampai</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status Pembayaran</label>

                        <div class="col-sm-6">
                            <select class="form-control" name="status_pembayaran" id="statusPembayaran" width="100%">
                                <option selected disabled>Pilih Salah Satu</option>
                              <?php foreach ($data_status_pembayaran as $r){ ?>
                                  <option value="<?php echo $r; ?>" <?php echo (isset($edit) && isset($pembayaran) && $edit->status_pembayaran == $r) ? 'selected': ''; ?>><?php echo $r; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Waktu Pembayaran </label>

                        <div class="col-sm-6">
                          <?php if(isset($pembayaran)){ ?>
                              <input type="hidden" name="id_pembayaran" value="<?php echo (isset($pembayaran)) ? $pembayaran->id_pembayaran : ''; ?>">
                          <?php } ?>
                            <input type="text" name="waktu_pembayaran" id="waktuPembayaran" class="form-control datetimepicker2" placeholder="Masukkan waktu pembayaran" value="<?php echo (isset($pembayaran)) ? $pembayaran->waktu_pembayaran : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Metode Pembayaran </label>

                        <div class="col-sm-6">
                            <select class="form-control" name="metode_pembayaran" id="metodePembayaran">
                                <option selected disabled>Pilih Salah Satu</option>
                              <?php foreach ($metode_pembayaran as $r){ ?>
                                  <option value="<?php echo $r; ?>" <?php if(isset($pembayaran) && $pembayaran->metode_pembayaran == $r) echo 'selected'; ?> ><?php echo $r; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nominal Pembayaran </label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control nominal" id="nominal" name="nominal" placeholder="Masukkan nominal pembayaran" value="<?php echo (isset($pembayaran)) ? set_currency_format($pembayaran->nominal): ''; ?>">
                            <div class="help-block" style="font-style: italic;"><a style="cursor: pointer;" onclick="getTotalBiaya()">Hitung Ulang Total Biaya</a></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Catatan</label>

                        <div class="col-sm-6">
                            <textarea class="form-control" name="catatan" placeholder="Masukkan catatan pembayaran"><?php echo (isset($pembayaran)) ? $pembayaran->catatan : ''; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" name="btn_submit" class="btn btn-success" value="save"><i class="fa fa-check"></i> Simpan</button> &nbsp;
                            <button type="submit" name="btn_submit" class="btn btn-primary" value="save_print"><i class="fa fa-print"></i> Simpan & Cetak Struk </button> &nbsp;
                            <a href="<?php echo site_url('trans_penjualan/index'); ?>"><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Batal</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
</form>

<script>
    var data_barang = <?php echo json_encode($data_barang); ?>;
    var no_item = <?php echo isset($edit) ? $n : '1'; ?>;
    var total_harga = <?php echo isset($edit) ? $edit->tot_harga_jual : '0'; ?>;


    function changeJenisTransaksi(jenis) {
        if(jenis == 'BIASA'){
            $("#reseller").css("display","none");
            $("select[name='id_reseller']").val(null).trigger("change");
            $("#transaksi_null").css("display", "none");
            $("#transaksi_dropship").css("display", "none");
            $("#transaksi_biasa").css("display", "block");
        } else {
            $("#reseller").css("display","block");
            $("#transaksi_null").css("display", "none");
            $("#transaksi_dropship").css("display", "block");
            $("#transaksi_biasa").css("display", "none");
        }
    }

    function pilihBarang() {
        var transaksi = $("select[name='jenis_transaksi'").val();
        if(transaksi == 'DROPSHIP')
            var cbx = $("select[name='transaksi_dropship'");
        else
            var cbx = $("select[name='transaksi_biasa'");
            
        var id_history = cbx.val();
        var element = '#item-'+id_history+'-';
        if($(element).length == 0) {
            var item = data_barang.find(function (row) {
                return row.id_history === id_history;
            });
            cbx.val(null).trigger("change");
            var harga = 0;
            if(transaksi == 'BIASA')
                harga = parseInt(item.harga_umum);
            else
                harga = parseInt(item.harga_reseller);
            var harga_rupiah = formatRupiah(harga);
            var string_kode = '';
            if(item.kode != null)
                string_kode = '['+item.kode+']';

            var string = '' +
                '                                    <tr id="item-' + id_history + '-">\n' +
                '                                        <td>'+string_kode+' ' + item.nama + '<input type="hidden" name="id_history[]" value="' + id_history + '">' +
                '<input type="hidden" class="stok" value="' + item.stok + '"></td>\n' +
                '                                        <td class="wrap text-right">' + harga_rupiah + ' <input type="hidden" class="harga_satuan" name="harga_satuan[]" value="' + harga + '"></td>\n' +
                '                                        <td class="wrap text-right"><input type="number" class="jumlah_pax" name="jumlah_pax[]" value="1" style="width: 30%; text-align: center;" placeholder="Jml" onchange="onChangeJml('+id_history+')">' +
                '<input type="hidden" class="total" name="total[]" value="' + harga + '"></td>\n' +
                '                                        <td class="wrap td_total  text-right">' + harga_rupiah + ' </td>\n' +
                '<td class="wrap"><button type="button" class="btn btn-danger btn-xs" onclick="removeBarang('+id_history+')"><i class="fa fa-times"></i> </button> </td>\n' +
                '                                    </tr>';
            $("#list_item").append(string);
            no_item++;
        }
        $(element).addClass("bg-success");
        setTimeout(function () {
            $(element).removeClass("bg-success");
        }, 2000);
        hitungBiayaTotal();
    }

    function formatRupiah(nominal) {
        var ribuan = currencyFormat(nominal);

            return 'Rp. '+ribuan;
    }

    function currencyFormat(nominal) {
        var reverse = nominal.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');

            return ribuan;
    }

    function onChangeJml(id_history) {
        var element = '#item-'+id_history+'-';
        var harga_satuan = $(element +" .harga_satuan").val();
        var stok = $(element +" .stok").val();
        var jumlah_pax = $(element +" .jumlah_pax").val();

        if(parseInt(jumlah_pax) > parseInt(stok)){
            $(element +" .jumlah_pax").val(stok);
            jumlah_pax = stok;
        }
        var total = parseInt(harga_satuan) * parseInt(jumlah_pax);
        $(element +" .total").val(total);
        $(element +" .td_total").html(formatRupiah(total));
        hitungBiayaTotal();
    }

    function removeBarang(id_history) {
        if($(".total").length > 1) {
            var element = '#item-' + id_history + '-';
            $(element).remove();
            hitungBiayaTotal();
        }
    }

    function hitungBiayaTotal() {
        var total = 0;
        $(".total").each(function (index) {
            var item = $(this).val();
            total = total + parseInt(item);
        });
        total_harga = currencyFormat(total);
        var rupiah = formatRupiah(total);
        $("#total_harga").html(rupiah);
    }

    function onChangePelanggan() {
        var pelanggan = $("select[name='id_pelanggan']").val();
        if(pelanggan == 'new'){
            $("#pelanggan_baru").css("display", "block");
        } else {
            $("input[name='pelanggan_baru']").val('');
            $("#pelanggan_baru").css("display", "none");
        }

    }

    $("#statusTransaksi").change(function() {
        var statusTransaksi = $("#statusTransaksi").val();
        var statusPembayaran = $("#statusPembayaran");
        var statusPengiriman = $("#statusPengiriman");
        var waktuTransaksi = $("#waktuTransaksi").val();
        var waktuPengiriman = $("#waktuPengiriman");
        var jenisEkspedisi = $("#jenisEkspedisi");
        var waktuSampai = $("#waktuSampai");
        var waktuPembayaran = $("#waktuPembayaran");
        var nominal = $("#nominal");

        if(statusTransaksi == 'SELESAI'){
            // change pembayaran and pengiriman if both null

            if(!statusPembayaran.val()) {
                statusPembayaran.val('LUNAS');
            }

            if(!statusPengiriman.val()) {
                statusPengiriman.val('SAMPAI');
            }

            if(!jenisEkspedisi.val()) {
                var val = '1';
                jenisEkspedisi.val(val).trigger("chosen:updated").change();
            }

            if(waktuPengiriman.val() == '') {
                waktuPengiriman.val(waktuTransaksi);
            }

            if(waktuSampai.val() == '') {
                waktuSampai.val(waktuTransaksi);
            }

            if(waktuPembayaran.val() == '') {
                waktuPembayaran.val(waktuTransaksi);
            }

            if(nominal.val() == '' || nominal.val() == '0') {
                getTotalBiaya();
            }
        }
    });


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

    function getTotalBiaya() {
        var diskon = $("#diskon").val();
        var biayaTambahan = $("#biayaTambahan").val();
        var biayaPembatalan = $("#biayaPembatalan").val();
        var biayaPengiriman = $("#biayaPengiriman").val();

        if(diskon == '')
            diskon = '0';

        if(biayaTambahan == '')
            biayaTambahan = '0';

        if(biayaPembatalan == '')
            biayaPembatalan = '0';

        if(biayaPengiriman == '')
            biayaPengiriman = '0';

        diskon = floatConv(diskon.toString());
        biayaTambahan = floatConv(biayaTambahan.toString());
        biayaPembatalan = floatConv(biayaPembatalan.toString());
        biayaPengiriman = floatConv(biayaPengiriman.toString());
        var totalHarga = floatConv(total_harga.toString());

        var total = totalHarga + biayaTambahan + biayaPembatalan + biayaPengiriman - diskon;
        total = currencyFormat(total);
        $("#nominal").val(total);
    }

    function floatConv(string) {
        var regex = /[.,\s]/g;
        return parseFloat(string.replace(regex, ''));
    }

    $(document).ready( function() {
        $("#frm_trx").submit(function(e){
            e.preventDefault();
            var statusPengiriman = $("#statusPengiriman").val();
            var statusPembayaran = $("#statusPembayaran").val();

            var valid = true;

            if(statusPengiriman){
                if($("#waktuPengiriman").val() == ''){
                    alert('Waktu Pengiriman tidak boleh kosong');
                    valid = false;
                }
                if(!$("#jenisEkspedisi").val()){
                    alert('Jenis Ekspedisi tidak boleh kosong');
                    valid = false;
                }
                if($("#biayaPengiriman").val() == ''){
                    alert('Biaya Pengiriman tidak boleh kosong');
                    valid = false;
                }
            }

            if(statusPembayaran){
                if($("#waktuPembayaran").val() == ''){
                    alert('Waktu Pembayaran tidak boleh kosong');
                    valid = false;
                }
                if(!$("#metodePembayaran").val()){
                    alert('Metode Pembayaran tidak boleh kosong');
                    valid = false;
                }
                if($("#nominal").val() == ''){
                    alert('Biaya Pengiriman tidak boleh kosong');
                    valid = false;
                }
            }

            if(valid)
                $("#frm_trx").unbind().submit();
        });
    });
</script>