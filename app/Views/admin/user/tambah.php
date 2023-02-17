<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<?php 
echo form_open(base_url('admin/user')); 
echo csrf_field(); 
?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">Nama lengkap</label>
					<div class="col-9">
						<input type="text" name="nama" class="form-control" placeholder="Nama lengkap" value="<?php echo set_value('nama') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Email</label>
					<div class="col-9">
						<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Username</label>
					<div class="col-9">
						<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Password</label>
					<div class="col-9">
						<input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Level</label>
					<div class="col-9">
						<select name="akses_level" class="form-control">
							<option value="Admin">Admin</option>
							<option value="User">User</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">NIP/NUP</label>
					<div class="col-9">
						<input type="text" name="nip_nup" class="form-control" placeholder="NIP/NUP" value="<?php echo set_value('nip_nup') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">NIDN/NIDK</label>
					<div class="col-9">
						<input type="text" name="nidn_nidk" class="form-control" placeholder="NIDN/NIDK" value="<?php echo set_value('nidn_nidk') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Orchid ID</label>
					<div class="col-9">
						<input type="text" name="orchid_id" class="form-control" placeholder="Orchid ID" value="<?php echo set_value('orchid_id') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Scopus ID</label>
					<div class="col-9">
						<input type="text" name="scopus_id" class="form-control" placeholder="Scopus ID" value="<?php echo set_value('scopus_id') ?>" required>
					</div>
				</div>

			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>
