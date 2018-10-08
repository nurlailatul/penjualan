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
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Supplier <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <?php if(isset($edit)){ ?>
                                    <input type="hidden" name="id_trans" value="<?php echo (isset($edit)) ? $edit->id_trans : ''; ?>">
                                <?php } ?>
                                <select class="form-control chosen-select" name="id_supplier" data-placeholder="Pilih Supplier" style="width: 100%;" onchange="onChangeSupplier()">
                                    <option></option>
                                    <option value="new">Supplier Baru</option>
                                    <?php foreach ($data_supplier as $r){ ?>
                                        <option value="<?php echo $r->id_supplier; ?>" <?php echo (isset($edit) && $r->id_supplier == $edit->id_supplier) ? 'selected': ''; ?>><?php echo $r->nama.' - '.$r->no_telp.' - '.$r->alamat; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="supplier_baru" style="display:none;">
                            <label class="col-sm-2 control-label">Supplier Baru </label>

                            <div class="col-sm-6">
                                <input type="text" name="supplier_baru" class="form-control" placeholder="Masukkan nama supplier baru" maxlength="255">
                                <div class="help-block" style="font-style: italic;">Jika supplier belum ditambahkan</div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Transaksi <label class="text-red">*</label></label>

                            <div class="col-sm-6">
                                <input type="text" name="waktu_transaksi" class="form-control datetimepicker2" placeholder="Masukkan waktu transaksi" required value="<?php echo (isset($edit)) ? $edit->waktu_transaksi : ''; ?>">
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cari Barang <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <select class="form-control chosen-select" name="cari_barang" data-placeholder="Pilih Barang">
                                    <option></option>
                                    <?php foreach ($data_barang as $r){ ?>
                                        <option value="<?php echo $r->id_history; ?>"><?php echo $r->nama.' - '.set_currency_format($r->harga_beli).' - ['.$r->kode.']'; ?></option>
                                    <?php } ?>
                                </select>
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
                                    </tr>
                                    </thead>
                                    <tbody id="list_item">
                                    <?php if(isset($list_barang)){
                                        $n = 1; $biaya_pembelian = 0;
                                        foreach ($list_barang as $r){
                                            ?>
                                            <tr id="item-<?php echo $r->id_history; ?>-">
                                                <td><?php echo $r->nama_barang; ?><input type="hidden" name="id_history[]" value="<?php echo $r->id_history; ?>"></td>
                                                <td class=" text-right">Rp. <?php echo set_currency_format($r->harga_satuan); ?> <input type="hidden" class="harga_satuan" name="harga_satuan[]" value="<?php echo number_format($r->harga_satuan,0); ?>"></td>
                                                <td class=" text-right"><input type="number" class="jumlah_pax" name="jumlah_pax[]" value="<?php echo $r->jumlah_pax; ?>" style="width: 30%; text-align: center;" placeholder="Jml" onchange="onChangeJml(<?php echo $r->id_history; ?>)">
                                                    <?php $total = intval($r->harga_satuan) * intval($r->jumlah_pax); ?>
                                                    <input type="hidden" class="total" name="total[]" value="<?php echo $total; ?>"></td>
                                                <td class="td_total  text-right">Rp. <?php echo set_currency_format($total); ?> </td>
                                            </tr>
                                    <?php
                                            $biaya_pembelian += $total;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr class="bg-gray">
                                        <th colspan="3" class="center">TOTAL HARGA BARANG</th>
                                        <th id="total_harga" class=" text-right"><?php echo isset($edit) ? 'Rp. '.set_currency_format($biaya_pembelian) : ''; ?></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Biaya Tambahan </label>

                            <div class="col-sm-6">
                                <input type="text" name="biaya_tambahan" class="form-control nominal" placeholder="Masukkan biaya tambahan" value="<?php echo (isset($edit)) ? set_currency_format($edit->biaya_tambahan) : ''; ?>" maxlength="15">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Keterangan</label>

                            <div class="col-sm-6">
                                <textarea class="form-control" name="keterangan" placeholder="Masukkan keterangan pembelian"><?php echo (isset($edit)) ? $edit->keterangan : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button> &nbsp;
                                <a href="<?php echo site_url('trans_pembelian/index'); ?>"><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Batal</button></a>
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

<script>
    var data_barang = <?php echo json_encode($data_barang); ?>;
    console.log(data_barang);
    var no_item = <?php echo isset($edit) ? $n : '1'; ?>;

    function pilihBarang() {
        var cbx = $("select[name='cari_barang'");
        var id_history = cbx.val();
        var element = '#item-'+id_history+'-';
        if($(element).length == 0) {
            var item = data_barang.find(function (row) {
                return row.id_history === id_history;
            });
            cbx.val(null).trigger("change");
            var harga = parseInt(item.harga_beli);
            var harga_rupiah = formatRupiah(harga);
            var string = '' +
                '                                    <tr id="item-' + id_history + '-">\n' +
                '                                        <td>' + item.nama + '<input type="hidden" name="id_history[]" value="' + id_history + '"></td>\n' +
                '                                        <td class=" text-right">' + harga_rupiah + ' <input type="hidden" class="harga_satuan" name="harga_satuan[]" value="' + harga + '"></td>\n' +
                '                                        <td class=" text-right"><input type="number" class="jumlah_pax" name="jumlah_pax[]" value="1" style="width: 30%; text-align: center;" placeholder="Jml" onchange="onChangeJml('+id_history+')">' +
                '<input type="hidden" class="total" name="total[]" value="' + harga + '"></td>\n' +
                '                                        <td class="td_total  text-right">' + harga_rupiah + ' </td>\n' +
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
        var reverse = nominal.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');

            return 'Rp. '+ribuan;
    }

    function onChangeJml(id_history) {
        var element = '#item-'+id_history+'-';
        console.log(element);

        var harga_satuan = $(element +" .harga_satuan").val();
        var jumlah_pax = $(element +" .jumlah_pax").val();
        var total = parseInt(harga_satuan) * parseInt(jumlah_pax);
        $(element +" .total").val(total);
        $(element +" .td_total").html(formatRupiah(total));
        hitungBiayaTotal();
    }

    function hitungBiayaTotal() {
        var total = 0;
        $(".total").each(function (index) {
            var item = $(this).val();
            total = total + parseInt(item);
        });
        var rupiah = formatRupiah(total);
        $("#total_harga").html(rupiah);
    }

    function onChangeSupplier() {
        var supplier = $("select[name='id_supplier']").val();
        if(supplier == 'new'){
            $("#supplier_baru").css("display", "block");
        } else {
            $("input[name='supplier_baru']").val('');
            $("#supplier_baru").css("display", "none");
        }

    }
</script>