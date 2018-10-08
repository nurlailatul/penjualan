<div id="view" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih login group!</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php
                    foreach ($data as $r){ ?>
                        <a href="<?php echo site_url("index/set_group/".$r['id_group']."/") ?>" class="btn btn-block btn-default"><?php echo $r['nama_group']; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>