<section class="content-header">
    <h1>
        <span class="fa fa-gears"></span>&nbsp; <?php echo $halaman; ?>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo site_url() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"> <?php echo $halaman; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline" role="grid">
                        <?php if (!empty($this->session->flashdata('msg'))) : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-success" id="callout">
                                        <h4>Berhasil</h4>
                                        <p><?php echo $this->session->flashdata('msg'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($this->session->flashdata('msgw'))) : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-warning" id="callout">
                                        <h4>Perhatian!</h4>
                                        <p><?php echo $this->session->flashdata('msgw'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form method="get" class="form-inline form-filter">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <select class="form-control chosen-select" name="id_group" data-placeholder="Group">
                                            <option></option>
                                            <option value="0">Semua</option>
                                            <?php foreach ($data_group as $r){ ?>
                                                <option value="<?php echo $r->id_group; ?>" <?php if(isset($filter->id_group) && $r->id_group == $filter->id_group) echo 'selected'; ?>><?php echo $r->nama_group; ?></option>
                                            <?php } ?>
                                        </select>

                                        <select class="form-control chosen-select" name="nama_modul" data-placeholder="Modul">
                                            <option></option>
                                            <option value="0">Semua</option>
                                            <?php foreach ($data_modul as $r){ ?>
                                                <option value="<?php echo $r->nama_modul; ?>" <?php if(isset($filter->nama_modul) && $r->nama_modul == $filter->nama_modul) echo 'selected'; ?>><?php echo ucwords(str_replace('_',' ',$r->nama_modul)); ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="form-control" name="hak_akses" placeholder="Hak Akses" value="<?php echo (isset($filter->hak_akses)) ? $filter->hak_akses : ''; ?>">
                                    </div>

                                    <button type="submit" class="btn btn-primary "><span class="fa fa-glass"></span> Filter</button>
                                    <a href="<?php echo site_url("akses_group_modul") ?>" class="btn btn-danger "><span class="fa fa-refresh"></span> Reset</a>
                                </div>
                            </div>

                        </form>

                        <hr style="margin-top:5px;">
                        <?php
                        if (!empty($data)) {
                            ?>
                            <span class="label label-default">Jumlah Data: <?php echo $jumlah ?></span>
                            <div class="table-responsive" style="margin-top:5px;">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="wrap text-left">No</th>
                                        <th class="wrap">Nama Group</th>
                                        <th class="wrap">Nama Modul</th>
                                        <th class="wrap">Hak Akses</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($data as $r){
                                        $akses = $model->get_akses_group_by_modul_group($r->id_group,$r->nama_modul);
                                        ?>
                                        <tr>
                                            <td class="wrap"><?php echo $this->uri->segment(3) + $i++; ?>. </td>

                                            <td class="wrap"><?php echo $r->nama_group; ?></td>
                                            <td class="wrap"><?php echo ucwords(str_replace('_',' ',$r->nama_modul)); ?></td>
                                            <td class="wrap">
                                                <?php
                                                foreach ($akses as $rr){
                                                    echo '<span style="margin: auto 2px 2px 0px;" class="tag label label-success">'.ucwords($rr['hak_akses']).'</span> ';
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <?php if ($link_paging) { ?>
                                        <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="box-footer">
                                                    <ul class="pagination pagination-sm no-margin pull-right">
                                                        <?php echo $link_paging; ?>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                        </tfoot>
                                    <?php } ?>
                                </table>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-info">
                                        <h4>Maaf</h4>
                                        <p>Data kosong atau data tidak ditemukan.</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="show-modal"></div>

<script>
    function DetailSkpd(id) {
        $.post("<?php echo site_url("unit/data_skpd/detail") ?>/"+id, {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
            $('#detail').modal('show');
        });
    }
</script>