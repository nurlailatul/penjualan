
<section class="content-header">
    <h1>
        <span class="fa fa-user-md"></span> Akun Saya
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo site_url() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"> Akun Saya</li>
    </ol>
</section>
<section class="content">
    <?php echo form_open("profile", array("id" => "update-form")); ?>	
    <?php if (isset($successMessage)): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-success">
                    <h4>Sukses!</h4>
                    <p><?php echo $successMessage ?></p>
                </div>
            </div>
        </div>
    <?php elseif (isset($errorMessage)): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-danger">
                    <h4>Errors!</h4>
                    <p><?php echo $errorMessage ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-default">
                <div class="box-body">
                    <div class="form-group field-username required <?php echo isset($errorUsernameMessage) ? "has-error" : "" ?>">
                        <label class="control-label" for="username">Username</label>
                        <input type="text" readonly id="username" class="form-control" name="username" value="<?php echo $detail['username'] ?>">

                        <p class="help-block help-block-error"></p>
                    </div>
                    <div class="form-group field-email required">
                        <label class="control-label" for="email">Nama User</label>
                        <input type="text" id="real_name" class="form-control" name="real_name" value="<?php echo $detail['real_name'] ?>" <?php echo $idGroup == '1' ? '' : 'disabled'; ?>>
                        <p class="help-block help-block-error"></p>
                    </div>
                    <div class="form-group field-email required <?php echo isset($errorEmailMessage) ? "has-error" : "" ?>">
                        <label class="control-label" for="email">Email</label>
                        <input type="text" id="email" class="form-control" name="email" value="<?php echo $detail['email'] ?>" <?php echo $idGroup == '1' ? '' : 'disabled'; ?>>
                        <p class="help-block help-block-error"></p>
                    </div>
                    <div class="form-group field-real_name required">
                        <label class="control-label" for="email">Role User</label>
                        <div style="max-height:300px;overflow-y:auto;word-break:break-all;padding:9px;background-color:#f5f5f5;border:1px solid #ccc;">
						<ul class="list-inline" style="line-height: 30px">
						<?php foreach($detail['group'] as $g){ ?>
							<li class="list-inline-item"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="<?php echo $g->keterangan; ?>"><?php echo $g->nama_group; ?></span></li>
						<?php } ?>
						</ul>
						</div>
                    </div>								
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Password</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group field-user-change_password">
                        <div class="checkbox">
                            <label>
                                <input <?php echo $changePassword != null ? "checked='checked'" : "" ?> id="user-change_password" name="change_password" value="1" type="checkbox">
                                Ubah Password
                            </label>
                        </div>
                    </div>
                    <div id="password-box" class="<?php echo $changePassword == null ? "hide" : "" ?>">
                        <div class="form-group field-password required <?php echo isset($errorPasswordOldMessage) ? "has-error" : "" ?>">
                            <label class="control-label" for="password-old">Password Lama</label>
                            <div class="input-group">
                                <input type="password" id="password-old" class="form-control" name="password_old" placeholder="Masukkan Password Lama...">
                                <span class="input-group-addon">
                                    <span onClick="mouseoverPass1();" id="eye_o_1" style="display:block;" data-toggle='tooltip' title='' data-original-title='Perlihatkan Password'><i class="fa fa-eye"></i></span>
                                    <span onClick="mouseoutPass1();" id="eye_c_1" style="display:none;" data-toggle='tooltip' title='' data-original-title='Sembunyikan Password'><i class="fa fa-eye-slash"></i></span>
                                </span>
                            </div>
                            <p class="help-block help-block-error"><?php echo isset($errorPasswordOldMessage) ? $errorPasswordOldMessage : "" ?></p>
                        </div>
                        <div class="form-group field-password required <?php echo isset($errorPasswordMessage) ? "has-error" : "" ?>">
                            <label class="control-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan Password Baru...">
                                <span class="input-group-addon">
                                    <span onClick="mouseoverPass1();" id="eye_o_1" style="display:block;" data-toggle='tooltip' title='' data-original-title='Show Password'><i class="fa fa-eye"></i></span>
                                    <span onClick="mouseoutPass1();" id="eye_c_1" style="display:none;" data-toggle='tooltip' title='' data-original-title='Hide Password'><i class="fa fa-eye-slash"></i></span>
                                </span>
                            </div>
                            <p class="help-block help-block-error"><?php echo isset($errorPasswordMessage) ? $errorPasswordMessage : "" ?></p>
                        </div>
                        <div class="form-group field-confirm required <?php echo isset($errorConfirmMessage) ? "has-error" : "" ?>">
                            <label class="control-label" for="confirm">Ulangi Password</label>
                            <div class="input-group">
                                <input type="password" id="confirm" class="form-control" name="confirm" placeholder="Masukkan Password Baru Kembali...">
                                <span class="input-group-addon">
                                    <span onClick="mouseoverPass2();" id="eye_o_2" style="display:block;" data-toggle='tooltip' title='' data-original-title='Show Password'><i class="fa fa-eye"></i></span>
                                    <span onClick="mouseoutPass2();" id="eye_c_2" style="display:none;" data-toggle='tooltip' title='' data-original-title='Hide Password'><i class="fa fa-eye-slash"></i></span>
                                </span>
                            </div>
                            <p class="help-block help-block-error"><?php echo isset($errorConfirmMessage) ? $errorConfirmMessage : "" ?></p>
                        </div>								
                    </div>
                </div>
            </div>
            <div class="box box-solid">
                <div class="box-body clearfix">
                    <button type="submit" class="btn btn-success btn-flat pull-right" name="submit-button" value="Submit Button"><i class="fa fa-save"></i> Simpan</button>
				</div>
            </div>
        </div>
    </div>

</section>



<script type="text/javascript">
    function mouseoverPass1() {
        document.getElementById('eye_o_1').style.display = 'none';
        document.getElementById('eye_c_1').style.display = 'block';
        var obj = document.getElementById('password');
        obj.type = "text";
    }
    function mouseoutPass1() {
        document.getElementById('eye_o_1').style.display = 'block';
        document.getElementById('eye_c_1').style.display = 'none';
        var obj = document.getElementById('password');
        obj.type = "password";
    }
    function mouseoverPass2() {
        document.getElementById('eye_o_2').style.display = 'none';
        document.getElementById('eye_c_2').style.display = 'block';
        var obj = document.getElementById('confirm');
        obj.type = "text";
    }
    function mouseoutPass2() {
        document.getElementById('eye_o_2').style.display = 'block';
        document.getElementById('eye_c_2').style.display = 'none';
        var obj = document.getElementById('confirm');
        obj.type = "password";
    }
</script>