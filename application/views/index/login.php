<div class="login-box" style="margin-top: 20px;">
    <div class="login-logo">
		<img style="height:100px;" src="<?php echo base_url("/public/image/Untitled-1.png") ?>">
    </div>
    <div class="login-logo">
        <p style="font-size:.7em; color: #3d3d3d;"><b><?php echo $app_name; ?> </b></p>
        <p style="font-size:.5em; font-weight: bold; font-style: italic;"></p>
    </div>
    <div class="login-box-body" style="background-color: #0c0c0c; opacity: 0.7;">
        <?php echo form_open('/', array('id' => 'login-form')); ?>
        <?php if (isset($successMessage)): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="callout callout-success">
                        <p><?php echo $successMessage ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
		<?php if (isset($errorMessage)): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="callout callout-danger">
                        <p><?php echo $errorMessage ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="form-group has-feedback">
            <div class="form-group field-user-username required <?php echo isset($errorMessage) ? "has-error" : "" ?>">
                <input type="text" id="user-username" class="form-control" name="username" placeholder="Username / Email" value="<?php if(!empty($user_temp)){ echo $user_temp;}?>">
                <p class="help-block help-block-error"></p>
            </div>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <div class="form-group field-user-password required">
                <div class="input-group">
					<input type="password" id="user-password" class="form-control" name="password" placeholder="Password">
					<span class="input-group-addon">
					<span onclick="mouseoverPass();" id="open" style="display:block;" data-toggle='tooltip' title='' data-original-title='Show Password'><i class="fa fa-eye"></i></span>
					<span onclick="mouseoutPass();" id="close" style="display:none;" data-toggle='tooltip' title='' data-original-title='Hide Password'><i class="fa fa-eye-slash"></i></span>
					</span>
				</div>
                <p class="help-block help-block-error"></p>
            </div>					
            <span class="glyphicon glyphicon-lock form-control-feedback" style="margin-right:40px;"></span>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" id="buttondefault" class="btn btn-danger btn-block btn-flat" name="login-button" value="Login Button">Login</button>
            </div>
			<br><br>
			<div class="col-xs-12">
				<center><a href="<?php echo site_url("forgot_password"); ?>">Lupa Password</a></center>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>	<!--<div class="powered muted"><br><br><br>
    <span class="fa fa-lock"></span>
</div>-->

<script type="text/javascript">
function mouseoverPass() {
  document.getElementById('open').style.display = 'none';
  document.getElementById('close').style.display = 'block';
  var obj = document.getElementById('user-password');
  obj.type = "text";
}
function mouseoutPass() {
  document.getElementById('open').style.display = 'block';
  document.getElementById('close').style.display = 'none';
  var obj = document.getElementById('user-password');
  obj.type = "password";
}
</script>