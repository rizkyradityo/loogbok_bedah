<?php include('tambah.php'); ?>
<style>
	.table td, .table th {
    padding: .30rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
</style>
<table class="table table-bordered" id="example1" >
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="20%">Nama</th>
			<th width="20%">Username</th>
			<th width="20%">Email</th>
			<th width="10%">Level</th>
			<th width="10%">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($user as $user) { 
			$status_user = "<span id='sp_sts_".$user['id_user']."' style='color:red;'>Inactive<span>";
			if($user['is_active'] == "1"){
				$status_user = "<span id='sp_sts_".$user['id_user']."' style='color:green;'>Active<span>";
			}
		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $user['nama'] ?></td>
			<td><?php echo $user['username'] ?></td>
			<td><?php echo $user['email'] ?></td>
			<td><?php echo $user['akses_level'] ?></td>
			<td><?php echo $status_user ?></td>
			<td>
				<a href="<?php echo base_url('admin/user/edit/'.$user['id_user']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a id='a_sts_<?php echo $user['id_user'] ?>' href="#" class="btn btn-info btn-sm" onclick="confirmation_activate(event,'<?php echo $user['id_user'] ?>','<?php echo $user['is_active'] ?>')"><i class="fa fa-key"></i></a>
				<a href="<?php echo base_url('admin/user/delete/'.$user['id_user']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
<script>
function confirmation_activate(ev,id_user,is_active) {
	ev.preventDefault();
	var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
	console.log(urlToRedirect); // verify if this is the right URL
	swal({
		title: "Yakin ingin merubah status data ini?",
		//text: "Data yang sudah dihapus tidak dapat dikembalikan",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		// redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
		if (willDelete) {
			// Proses ke URL
			//window.location.href = urlToRedirect;
			$.ajax({
				url : "<?php echo base_url('admin/user/activation/')?>",//+id_user+"/"+is_active
				type: "POST",
				data: {id_user:id_user,is_active:is_active},
				dataType: "JSON",
				success: function(data)
				{
				//if success ;close modal and reload ajax table
				console.log(data);
				$('#sp_sts_'+id_user).text(data.status);
				$('#sp_sts_'+id_user).css("color", data.color);
				$('#a_sts_'+id_user).attr('onclick', "confirmation_activate(event,"+id_user+","+data.is_active+")");
				
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert(errorThrown);
				}
			});
		} 
	});
} 
</script>