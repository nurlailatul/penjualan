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
                            <label class="col-sm-2 control-label">Nama <label class="text-red">*</label> </label>

                            <div class="col-sm-6">
                                <?php if(isset($edit)){ ?>
                                    <input type="hidden" name="id_supplier" value="<?php echo (isset($edit)) ? $edit->id_supplier : ''; ?>">
                                <?php } ?>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama supplier" required value="<?php echo (isset($edit)) ? $edit->nama : ''; ?>" maxlength="255">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>

                            <div class="col-sm-6">
                                <textarea class="form-control" name="alamat" placeholder="Masukkan alamat supplier"><?php echo (isset($edit)) ? $edit->alamat : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">No. Telepon </label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="no_telp" placeholder="Masukkan nomor telepon supplier" value="<?php echo (isset($edit)) ? $edit->no_telp : ''; ?>" maxlength="255">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Keterangan </label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="keterangan" placeholder="Masukkan keterangan lain supplier"><?php echo (isset($edit)) ? $edit->keterangan : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button> &nbsp;
                                <a href="<?php echo site_url('supplier/index'); ?>"><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Batal</button></a>
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