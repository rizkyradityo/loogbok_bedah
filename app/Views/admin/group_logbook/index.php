
<?php include('tambah.php'); ?>
<style>
	.table td, .table th {
    padding: .30rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
</style>
<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="40%">Nama Group</th>
			<th width="40%">Warna</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($group_logbook as $group_logbook) { 

		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $group_logbook['group_name'] ?></td>
			<td><?php echo $group_logbook['color'] ?> <i style="color:<?php echo $group_logbook['color'] ?>" class="fas fa-square"></i> </td>
			<td>
				<a href="<?php echo base_url('admin/group_logbook/edit/'.$group_logbook['id_group_logbook']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/group_logbook/delete/'.$group_logbook['id_group_logbook']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>


<!-- <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"> -->

<!-- <script src="<?php echo base_url() ?>/assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script> -->
<script>
// $.noConflict() ;
//  //color picker with addon
//  $('.my-colorpicker2').colorpicker()
//  $('.my-colorpicker2').on('colorpickerChange', function(event) {
//       $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
//     });

</script>