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
                <form class="form-horizontal" method="post" id="form_brg" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kode </label>
                            <div class="col-sm-6">
                                <?php if(isset($edit)){ ?>
                                    <input type="hidden" name="id_barang" value="<?php echo (isset($edit)) ? $edit->id_barang : ''; ?>">
                                <?php } ?>
                                <input type="text" name="kode" class="form-control" placeholder="Masukkan kode barang" value="<?php echo (isset($edit)) ? $edit->kode : ''; ?>" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama barang" required value="<?php echo (isset($edit)) ? $edit->nama : ''; ?>" maxlength="255">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Harga Beli <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control nominal" name="harga_beli" placeholder="Masukkan harga beli" value="<?php echo (isset($edit)) ? set_currency_format($edit->harga_beli) : ''; ?>" maxlength="15" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Harga Reseller <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control nominal" name="harga_reseller" placeholder="Masukkan harga reseller" value="<?php echo (isset($edit)) ? set_currency_format($edit->harga_reseller) : ''; ?>" maxlength="15" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Harga Umum <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control nominal" name="harga_umum" placeholder="Masukkan harga barang" value="<?php echo (isset($edit)) ? set_currency_format($edit->harga_umum) : ''; ?>" maxlength="15" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Deskripsi</label>

                            <div class="col-sm-6">
                                <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi barang"><?php echo (isset($edit)) ? $edit->deskripsi : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Stok <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control nominal" name="stok" placeholder="Masukkan stok barang" value="<?php echo (isset($edit)) ? set_currency_format($edit->stok) : ''; ?>" maxlength="15" required>

                            </div>
                        </div>
                        <?php if(isset($edit)){ ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Catatan Edit </label>
                            <div class="col-sm-6">
                                <input type="text" name="catatan" class="form-control" placeholder="Masukkan catatan perubahan data (opsional)" maxlength="255">
                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button> &nbsp;
                                <a href="<?php echo site_url('barang/index'); ?>"><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Batal</button></a>
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

<script type="text/javascript">
    $(document).ready( function() {
        $("#form_brg").submit(function(e){
            e.preventDefault();
            var harga_beli = $("input[name='harga_beli']").val();
            var harga_reseller = $("input[name='harga_reseller']").val();
            var harga_umum = $("input[name='harga_umum']").val();

            var regex = /[.\s]/g;
            var harga_beli = parseInt(harga_beli.replace(regex, ''));
            var harga_reseller = parseInt(harga_reseller.replace(regex, ''));
            var harga_umum = parseInt(harga_umum.replace(regex, ''));

            var valid = true;
            // harga beli can't higher than harga reseller or harga umum
            if(harga_beli > harga_reseller || harga_beli > harga_umum){
                alert('Harga tidak valid. Cek kembali!');
                valid = false;
            }

            if(valid)
                $("#form_brg").unbind().submit();
        });
    });
</script>