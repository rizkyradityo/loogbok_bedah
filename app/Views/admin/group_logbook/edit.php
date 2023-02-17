<?php 
echo form_open(base_url('admin/group_logbook/edit/'.$group_logbook['id_group_logbook'])); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Nama Grup</label>
	<div class="col-9">
		<input type="text" name="group_name" class="form-control" placeholder="Nama Grup" value="<?php echo $group_logbook['group_name'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Warna</label>
	<div class="col-9">
		<input type="color" name="color" class="form-control" placeholder="Email" value="<?php echo $group_logbook['color'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>