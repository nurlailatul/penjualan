
<div class="modal fade" id="detail" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> <?php echo $halaman; ?></h4>
            </div>
			<form class="form-horizontal" action="<?php echo site_url('unit/user/save'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body" style="margin-left: 20px; margin-right: 20px;">
				<div class="row" id="warning_in_modal" style="display:none;">
					<div class="col-md-12">
						<div class="callout callout-warning">
							<h5><b>Terjadi Kesalahan!</b></h5>
							<p id="info_in_modal"></p>
						</div>
					</div>
				</div>
				
				<h5 class="box-title">Lengkapi form di bawah ini! &nbsp; <small>Field bertanda (<label class="text-red">*</label>) harus diisi.</small></h5>
				<hr style="padding: 0px"/>
				
				<input type="hidden" name="callback" id="callback_url" value="<?php echo 'unit/user'; ?>">
				
				<?php if(isset($detail)){ ?>
					<input type="hidden" name="editId" value="<?php echo $id; ?>">
				<?php } ?>
				
				<div class="form-group">
					<label class="col-sm-3 control-label"> Username <sup class="text-danger">*</sup></label>
					<div class="col-sm-9">
						<input type="text" id="uname" name="username" class="form-control" placeholder="Masukkan Username..." required value="<?php echo (isset($detail)) ? $detail->username : ''; ?>" <?php echo isset($detail) ? 'readonly' : ''; ?> autocomplete="off">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label"> Email <sup class="text-danger">*</sup></label>
					<div class="col-sm-9">
						<input type="text" id="mail" name="email" class="form-control" placeholder="Masukkan Email..." required value="<?php echo (isset($detail)) ? $detail->email : ''; ?>" autocomplete="off">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label"> Role User <sup class="text-danger">*</sup></label>
					<div class="col-sm-9">
						<select class="form-control chosen-select" id="rl" name="role[]" multiple="" required data-placeholder="Pilih Role User...">
							<?php if(isset($detail)){
								$group = explode('|', $detail->id_grup);
							} ?>
							
							<?php foreach ($role_list as $r){ ?>
							<option value="<?php echo $r->id_group; ?>" <?php echo (isset($detail) && in_array($r->id_group, $group)) ? 'selected': ''; ?>><?php echo $r->nama_group; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<?php if(isset($detail)){ ?>
				<div class="form-group field-user-change_password">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-9 checkbox">
						<label>
							<input name="change_password" id="chgPass" value="1" type="checkbox" onclick="changePassword(this)">
							Ubah Password
						</label>
					</div>
				</div>
				<?php } ?>
				
				<div id="password-box" <?php echo isset($detail) ? "hidden" : "" ?>>
				
					<br/>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"> Password <sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="password" id="pOne" class="form-control" name="pass" placeholder="Masukkan Password..." <?php echo !isset($detail) ? 'required' : ''; ?> autocomplete="off">
								<span class="input-group-addon">
									<span onClick="mouseoverPass('One');" id="oOne" style="display:block;" data-toggle='tooltip' title='' data-original-title='Show Password'><i class="fa fa-eye"></i></span>
									<span onClick="mouseoutPass('One');" id="cOne" style="display:none;" data-toggle='tooltip' title='' data-original-title='Hide Password'><i class="fa fa-eye-slash"></i></span>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"> Konfirmasi Password <sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="password" id="pTwo" class="form-control" name="vpass" placeholder="Masukkan Password Kembali..." <?php echo !isset($detail) ? 'required' : ''; ?> autocomplete="off">
								<span class="input-group-addon">
									<span onClick="mouseoverPass('Two');" id="oTwo" style="display:block;" data-toggle='tooltip' title='' data-original-title='Show Password'><i class="fa fa-eye"></i></span>
									<span onClick="mouseoutPass('Two');" id="cTwo" style="display:none;" data-toggle='tooltip' title='' data-original-title='Hide Password'><i class="fa fa-eye-slash"></i></span>
								</span>
							</div>
							
							<button type="button" class="btn btn-gray btn-xs mt-10" onclick="get_password()" style="cursor: pointer;"><i class="fa fa-cog"></i> Generate Password</button>
						</div>
					</div>
				
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                <button type="submit" class="btn btn-success mr-10"><i class="fa fa-save"></i> Simpan</button>
            </div>
			</form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
		$(".chosen-select").select2();
		
		$('#detail').on('show.bs.modal', function (e) {
			$('.chosen', this).chosen({width: "390px"});
			$('.chosen-select', this).select2({width: "390px"});
		});
	});
	
	function mouseoverPass(elem) {
        document.getElementById('o' + elem).style.display = 'none';
        document.getElementById('c' + elem).style.display = 'block';
        var obj = document.getElementById('p' + elem);
        obj.type = "text";
    }
    function mouseoutPass(elem) {
        document.getElementById('o' + elem).style.display = 'block';
        document.getElementById('c' + elem).style.display = 'none';
        var obj = document.getElementById('p' + elem);
        obj.type = "password";
    }
	
	function changePassword(elem){
		if($(elem).is(':checked')){
			$('#pOne').attr('required', 'required');
			$('#pTwo').attr('required', 'required');
		} else {
			$('#pOne').removeAttr('required');
			$('#pTwo').removeAttr('required');
		}
		
		$('#password-box').slideToggle();
	}
	
	function get_password() {
        var get = generatePassword();
		
		$("#pOne").val(get);
		$("#pTwo").val(get);
        mouseoverPass('One');
        mouseoverPass('Two');
    }

    function generatePassword() {
        var numLc = 4;
        var numUc = 2;
        var numDigits = 4;
        var numSpecial = 2;


        var lcLetters = 'abcdefghijklmnopqrstuvwxyz';
        var ucLetters = lcLetters.toUpperCase();
        var numbers = '0123456789';
        var special = '!?=#*$@+-.';

        var getRand = function(values) {
            return values.charAt(Math.floor(Math.random() * values.length));
        };

        //+ Jonas Raoni Soares Silva
        //@ http://jsfromhell.com/array/shuffle [v1.0]
        function shuffle(o){ //v1.0
            for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
            return o;
        };

        var pass = [];
        for(var i = 0; i < numLc; ++i) { pass.push(getRand(lcLetters)) }
        for(var i = 0; i < numUc; ++i) { pass.push(getRand(ucLetters)) }
        for(var i = 0; i < numDigits; ++i) { pass.push(getRand(numbers)) }
        for(var i = 0; i < numSpecial; ++i) { pass.push(getRand(special)) }

        return shuffle(pass).join('');
    }
</script>