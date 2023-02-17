<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<?php 
echo form_open(base_url('admin/group_logbook')); 
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
					<label class="col-3">Nama Grup</label>
					<div class="col-9">
						<input type="text" name="group_name" class="form-control" placeholder="Nama Grup" value="<?php echo set_value('group_name') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Warna</label>
					<div class="col-9">
						<input type="color" name="color" class="form-control" placeholder="Warna" value="<?php echo set_value('email') ?>" required>
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


