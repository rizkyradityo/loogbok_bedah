<?php 
echo form_open(base_url('admin/user/edit/'.$user['id_user'])); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Nama Pengguna</label>
	<div class="col-9">
		<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?php echo $user['nama'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Email</label>
	<div class="col-9">
		<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $user['email'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Username</label>
	<div class="col-9">
		<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $user['username'] ?>" readonly>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Password</label>
	<div class="col-9">
		<input type="text" name="password" class="form-control" placeholder="Password" value="">
		<small class="text-danger">Minimal 6 karakter dan maksimal 32 karakter atau biarkan kosong</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Level</label>
	<div class="col-9">
		<select name="akses_level" class="form-control">
			<option value="Admin">Admin</option>
			<option value="User" <?php if($user['akses_level']=="User") { echo 'selected'; } ?>>User</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">NIP/NUP</label>
	<div class="col-9">
		<input type="text" name="nip_nup" class="form-control" placeholder="NIP/NUP" value="<?php echo $user['nip_nup'] ?>" >
	</div>
</div>

<div class="form-group row">
	<label class="col-3">NIDN/NIDK</label>
	<div class="col-9">
		<input type="text" name="nidn_nidk" class="form-control" placeholder="NIDN/NIDK" value="<?php echo $user['nidn_nidk'] ?>" >
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Orchid ID</label>
	<div class="col-9">
		<input type="text" name="orchid_id" class="form-control" placeholder="Orchid ID" value="<?php echo $user['orchid_id'] ?>" >
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Scopus ID</label>
	<div class="col-9">
		<input type="text" name="scopus_id" class="form-control" placeholder="Scopus ID" value="<?php echo $user['scopus_id'] ?>" >
	</div>
</div> 

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>