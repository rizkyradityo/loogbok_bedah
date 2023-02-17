<form action="<?php echo base_url('admin/file_download/edit/'.$download['id_download']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-2">Judul Download</label>
	<div class="col-md-10">
		<input type="text" name="title" class="form-control" value="<?php echo $download['title'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Upload File</label>
	<div class="col-md-10">
		<input type="file" name="file" class="form-control" value="">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Pemilik</label>
	<div class="col-md-10">
		<select name="id_user" class="form-control select2">
			<?php foreach($user as $user) { ?>
			<option value="<?php echo $user['id_user'] ?>" <?php if($download['id_user']==$user['id_user']) { echo 'selected'; } ?>>
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

<script src="<?php echo base_url() ?>/assets/admin/plugins/select2/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/select2/css/select2.min.css">
<script>
	$('.select2').select2()
</script>