<div class="login-box" style="margin-top:5%;">
    <div class="login-logo">
		<img style="height:100px;" src="<?php echo base_url("/public/image/logo_new.png") ?>">
    </div>
	<div class="login-logo">
		<p style="font-size:.7em;"><a href="<?php echo base_url(); ?>">Aplikasi Management<br><b>Si Mia Cerdas</b></a></p>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
        </p>
        <?php echo form_open("forgot_password_reset?token=" . $token . "&email=" . $email, array("id" => "reset-form")) ?>
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
			<?php if(isset($errorMessage)): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="callout callout-danger">
                        <h4>Error!</h4>
                        <p><?php echo $errorMessage ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-12" style="margin-bottom:10px;">
                    <p align="center">Please enter your new password :</p>
                </div>
            </div>
            <div class="form-group has-feedback ">
                <div class="form-group field-email required <?php echo isset($errorEmailMessage) ? "has-error" : "" ?>">
                    <input class="form-control" id="email" name="email" placeholder="Email address" value="<?php if($this->input->get()){ echo $this->input->get("email") ;} ?>" readonly>
                    <?php if(isset($errorEmailMessage)): ?>
                        <p class="help-block help-block-error"><?php echo($errorEmailMessage) ?></p>
                    <?php else: ?>
                        <p class="help-block help-block-error"></p>
                    <?php endif; ?>
                </div>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback ">
                <div class="form-group field-password required <?php echo isset($errorPasswordMessage) ? "has-error" : "" ?>">
                    <div class="input-group">
						<input type="password"  id="password" class="form-control" name="password" placeholder="Password" value="<?php if(!empty($pass1_temp)){ echo $pass1_temp;}?>">
						<span class="input-group-addon">
						<span onclick="mouseoverPass1();" id="open1" style="display:block;" data-toggle='tooltip' title='' data-original-title='Show Password'><i class="fa fa-eye"></i></span>
						<span onclick="mouseoutPass1();" id="close1" style="display:none;" data-toggle='tooltip' title='' data-original-title='Hide Password'><i class="fa fa-eye-slash"></i></span>
						</span>
					</div>
                    <?php if(isset($errorPasswordMessage)): ?>
                        <p class="help-block help-block-error"><?php echo($errorPasswordMessage) ?></p>
                    <?php else: ?>
                        <p class="help-block help-block-error"></p>
                    <?php endif; ?>
                </div>
                <span class="glyphicon glyphicon-lock form-control-feedback" style="margin-right:40px;"></span>
            </div>
            <div class="form-group has-feedback">
                <div class="form-group field-confirm required <?php echo isset($errorConfirmPasswordMessage) ? "has-error" : "" ?>">
                    <div class="input-group">
						<input type="password" id="confirm" class="form-control" name="confirm" placeholder="Confirm Password" value="<?php if(!empty($pass2_temp)){ echo $pass2_temp;}?>">
						<span class="input-group-addon">
						<span onclick="mouseoverPass2();" id="open2" style="display:block;" data-toggle='tooltip' title='' data-original-title='Show Password'><i class="fa fa-eye"></i></span>
						<span onclick="mouseoutPass2();" id="close2" style="display:none;" data-toggle='tooltip' title='' data-original-title='Hide Password'><i class="fa fa-eye-slash"></i></span>
						</span>
					</div>
                    <?php if(isset($errorConfirmPasswordMessage)): ?>
                        <p class="help-block help-block-error"><?php echo($errorConfirmPasswordMessage) ?></p>
                    <?php else: ?>
                        <p class="help-block help-block-error"></p>
                    <?php endif; ?>
                </div>
                <span class="glyphicon glyphicon-lock form-control-feedback" style="margin-right:40px;"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-danger btn-block btn-flat" name="reset-button" value="Reset Button">Reset my password!</button>											
                </div>
            </div>
        <?php echo form_close(); ?>

        <div class="row">
            <br>
            <div class="col-md-12 text-center" style="margin-top:5px;">
                <a href="<?php echo site_url() ?>">Back to login form</a>
            </div>
        </div>
    </div>
</div>	<div class="powered muted"><br>
    <span class="fa fa-lock"></span> Every bit of data transmitted is encrypted and officially signed.
    <br>
</div>


<script type="text/javascript">
function mouseoverPass1() {
  document.getElementById('open1').style.display = 'none';
  document.getElementById('close1').style.display = 'block';
  var obj = document.getElementById('password');
  obj.type = "text";
}
function mouseoutPass1() {
  document.getElementById('open1').style.display = 'block';
  document.getElementById('close1').style.display = 'none';
  var obj = document.getElementById('password');
  obj.type = "password";
}
function mouseoverPass2() {
  document.getElementById('open2').style.display = 'none';
  document.getElementById('close2').style.display = 'block';
  var obj = document.getElementById('confirm');
  obj.type = "text";
}
function mouseoutPass2() {
  document.getElementById('open2').style.display = 'block';
  document.getElementById('close2').style.display = 'none';
  var obj = document.getElementById('confirm');
  obj.type = "password";
}
</script>