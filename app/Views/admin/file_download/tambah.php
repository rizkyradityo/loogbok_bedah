<form action="<?php echo base_url('admin/file_download/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-2">Judul Download</label>
	<div class="col-md-10">
		<input type="text" name="title" class="form-control" value="<?php echo set_value('title') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Upload File</label>
	<div class="col-md-10">
		<input type="file" name="file" class="form-control" value="<?php echo set_value('file') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Pemilik</label>
	<div class="col-md-10">
		<select name="id_user" class="form-control">
			<?php foreach($user as $user) { ?>
			<option value="<?php echo $user['id_user'] ?>">
				<?php echo $user['nama'] ?>
			</option>
			<?php } ?>
		</select>
	</div>
</div>


<div class="form-group row">
	<label class="col-md-2"></label>
	<div class="col-md-10">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>