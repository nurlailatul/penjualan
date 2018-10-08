<div class="login-box">
    <div class="login-logo">
		<img style="height:100px;" src="<?php echo base_url("/public/image/logo_new.png") ?>">
    </div>
	<div class="login-logo">
            <p style="font-size:.7em;"><a href="<?php echo base_url(); ?>"><b>Si Mia Cerdas</b><br>Monitoring Administrasi Akademik<br><p><font size="2"><b><i>Cermat, Cepat, Terintegrasi, Mudah dan Hemat Kertas</i></b></font></p></a></p>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
        </p>
        <?php echo form_open("forgot_password") ?>
        <?php if(isset($successMessage)): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-success">
                    <h4>Sukses!</h4>
                    <p><?php echo $successMessage ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12" style="margin-bottom:10px;">
                <p align="center">Silahkan masukkan email untuk mereset password</p>
            </div>
        </div>
        <div class="form-group has-feedback <?php echo isset($errorMessage) ? "has-error" : "" ?>"">
            <input class="form-control" name="email" placeholder="Email address">
            <?php if(isset($errorMessage)): ?>
            <p class="help-block help-block-error"><?php echo($errorMessage) ?></p>
            <?php endif; ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-warning btn-block btn-flat" name="reset-button" value="Reset Button">Reset my password!</button>											
            </div>
        </div>
        <?php echo form_close() ?>
        <div class="row">
			<br>
            <div class="col-md-12 text-center" style="margin-top:5px;">
                <a href="<?php echo site_url() ?>">Back to login form</a>
            </div>
        </div>
    </div>
</div>	
<div class="powered muted">
<br>
    <span class="fa fa-lock"></span> Every bit of data transmitted is encrypted and officially signed.
</div>