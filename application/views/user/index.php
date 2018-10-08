<section class="content-header">
    <h1>
        <span class="fa fa-users"></span>&nbsp; <?php echo $halaman; ?>
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
                                        <input type="text" name="uname" placeholder="Username / Email" class="form-control" value="<?php echo $this->input->get('uname'); ?>" autocomplete="off">
                                    </div>
									
									<div class="form-group">
										<select class="form-control chosen-select" name="role[]" data-placeholder="Role User" multiple>
											<option></option>
											<option value="0" <?php echo $this->input->get('role') && in_array('0', $this->input->get('role')) ? 'selected': ''; ?>>SEMUA</option>
											<?php foreach ($data_user_group as $r){ ?>
												<option value="<?php echo $r->id_group; ?>" <?php echo $this->input->get('role') && in_array($r->id_group, $this->input->get('role')) ? 'selected': ''; ?> ><?php echo $r->nama_group; ?></option>
											<?php } ?>
										</select>
									</div>

                                    <button type="submit" class="btn btn-primary "><span class="fa fa-glass"></span> Filter</button>
									<?php if($this->input->get()){ ?>
										<a href="<?php echo site_url("unit/user") ?>" class="btn btn-danger "><span class="fa fa-refresh"></span> Reset</a>
									<?php } ?>

                                    <?php if($createAct){ ?>
                                        <a onclick="$('#temporary_data').val(''); $('#warning_info').val(''); CreateUser();" href="#" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Tambah User</a>
                                    <?php } ?>
                                </div>
                            </div>

                        </form>

                        <hr style="margin-top:5px;">

                        <span class="label label-default">Jumlah Data: <?php echo count($data); ?></span>
                        <div class="table-responsive" style="margin-top:5px;">
                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th class="wrap text-left">No</th>
                                        <?php if ($updateAct || $updateActOwn || $deleteAct || $deleteActOwn){ ?>
                                        <th class="wrap" style="min-width: 100px">Aksi</th>
                                        <?php } ?>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th class="wrap">Group / Role User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 								
								if(!empty($data)){ $i = 1; foreach ($data as $r){
                                    ?>
                                    <tr>
                                        <td class="wrap"><?php echo $this->uri->segment(4) + $i++; ?>. </td>
                                        <?php if ($updateAct || $updateActOwn || $deleteAct || $deleteActOwn){ ?>
                                        <td class="wrap">
											<div class="btn-group">
												<button type="button" class="btn btn-success">Aksi</button>
												<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<ul class="dropdown-menu" role="menu">
                                                    <?php if ($updateAct || $updateActOwn){ ?>
                                                        <li><a href="#" onclick="$('#temporary_data').val(''); $('#warning_info').val(''); EditUser(<?php echo $r->id_user; ?>);" class="text-blue" style="font-weight: bold; cursor: pointer;"><i class="fa fa-pencil"></i> Ubah Data</a></li>
                                                    <?php } ?>

                                                    <?php if ($deleteAct || $deleteActOwn){ ?>
                                                        <?php if($userId != $r->id_user){ ?>
                                                            <li><a href="<?php echo base_url('unit/user/hapus/'.$r->id_user); ?>" style="font-weight: bold; cursor: pointer;" class="text-blue" data-confirm="Anda yakin akan menghapus data User ini? <strong class='pull-right' style='color:#000;'></strong>" data-box-title="Konfirmasi" data-box-class="modal-danger"><i class="fa fa-trash"></i> Hapus</a></li>
                                                        <?php } ?>
                                                    <?php } ?>
												</ul>
											</div>
                                        </td>
                                        <?php } ?>
                                        <td><?php echo $this->input->get('uname') ? str_replace(strtolower($this->input->get('uname')), '<span class="btn-warning">'.strtolower($this->input->get('uname')).'</span>', strtolower($r->username)) : $r->username; ?></td>
                                        <td>
										<?php echo $this->input->get('uname') ? str_replace(strtolower($this->input->get('uname')), '<span class="btn-warning">'.strtolower($this->input->get('uname')).'</span>', strtolower($r->email)) : $r->email; ?></td>
                                        <td class="wrap">
											<ul class="list-inline" style="line-height: 25px">
											<?php 
											
											if(!$this->input->get()){
												$group = explode('|', $r->nama_grup);
												$ket = explode('|', $r->ket_grup);
												foreach($group as $k => $g){ ?>
													<?php if($k > 0 && $k % 4 == 0){ echo '<br/>'; } ?>
													
													<li class="list-inline-item"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="<?php echo $ket[$k]; ?>"><?php echo $g; ?></span></li>
												<?php } ?>
											<?php } else { 
												$group = $this->model->get_user_group($r->id_user);
												foreach($group as $k => $g){
											?>
												
												<?php if($k > 0 && $k % 4 == 0){ echo '<br/>'; } ?>
													
												<li class="list-inline-item"><span class="label label-<?php echo !empty($this->input->get('role')) && in_array($g->id_group, $this->input->get('role')) ? 'success' : 'default'; ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $g->keterangan; ?>"><?php echo $g->nama_group; ?></span></li>
												
											<?php } } ?>
											
											</ul>
										</td>
                                    </tr>
                                <?php } } else { ?>
									<tr><td colspan="5" class="text-center bg-warning text-danger" style="height: 100px; vertical-align:middle"><i class="fa fa-exclamation-triangle"></i> <b><?php echo $this->input->get() ? 'Data user yang Anda cari tidak ditemukan!' : 'Belum Ada Data User'; ?></b></td></tr>
								<?php } ?>
                                </tbody>
                                <?php if($link_paging){?>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="show-modal"></div>
<div hidden><textarea id="temporary_data"></textarea></div>
<div hidden><input type="hidden" id="warning_info"></div>

<script type="text/javascript">
    $(document).ready(function () {
		<?php if(!empty($this->session->flashdata('temp_data')) && !empty($this->session->flashdata('warning_modal'))){ 
			$dt = $this->session->flashdata('temp_data');
			?>
			
			var dt = '<?php echo json_encode($dt); ?>';
			var wr = '<?php echo $this->session->flashdata('warning_modal'); ?>';
			
			$('#temporary_data').val(dt);
			$('#warning_info').val(wr);
			<?php if($dt['id_user']){ ?>
				EditUser('<?php echo $dt['id_user']; ?>');
			<?php } else { ?>
				CreateUser();
			<?php } ?>
		<?php } ?>
	});
	
	
	function CreateUser() {
        $.post("<?php echo site_url("unit/user/create_edit") ?>", {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
			
			if($('#temporary_data').val() && $('#warning_info').val()){ // IF SOMETHING ERROR WITH FORM
				var dt = JSON.parse($('#temporary_data').val());
				
				$('#uname').val(dt['username']);
				$('#mail').val(dt['email']);
				$("#rl").val( dt['role'] );
				
				$("#info_in_modal").text( $('#warning_info').val() );
				$("#warning_in_modal").css('display', 'block');
			}
			
            $('#detail').modal('show');
        });
    }
	
	function EditUser(id) {
        $.post("<?php echo site_url("unit/user/create_edit") ?>/"+id, {}, function (result) {
            $("#show-modal").html("");
            $("#show-modal").html(result);
			
			if($('#temporary_data').val() && $('#warning_info').val()){ // IF SOMETHING ERROR WITH FORM
				var dt = JSON.parse($('#temporary_data').val());
				
				$('#uname').val(dt['username']);
				$('#mail').val(dt['email']);
				$("#rl").val( dt['role'] );
				
				$("#info_in_modal").text( $('#warning_info').val() );
				$("#warning_in_modal").css('display', 'block');
				
				if(dt['changepass'] != null){
					$("#chgPass").prop('checked', true);
					
					$('#password-box').slideToggle();
					$('#pOne').attr('required', 'required');
					$('#pTwo').attr('required', 'required');
					
				}
			}
			
            $('#detail').modal('show');
        });
    }
</script>