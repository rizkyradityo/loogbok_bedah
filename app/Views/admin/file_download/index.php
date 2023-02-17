<style>
	.table td, .table th {
    padding: .30rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
</style>

<p>
	<a href="<?php echo base_url('admin/file_download/tambah') ?>" class="btn btn-success">
		<i class="fa fa-plus"></i> Tambah Baru
	</a>
</p>

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="15%">File</th>
			<th width="30%">Pemilik</th>		
			<th width="30%">Judul</th>
			
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($download as $download) { ?>
		<tr>
			<td><?php echo $no ?></td>
			
			<td>
				<?php if($download['file']=="") { echo '-'; }else{ ?>
					<button onclick="view_file('<?php echo $download['id_download'] ?>')"  class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</button>
					<a href="<?php echo base_url('admin/file_download/unduh/'.$download['id_download']) ?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Unduh</a>
				<?php } ?>
			</td>
			<td><?php echo $download['nama'] ?></td>
			<td><?php echo $download['title'] ?></td>						
			<td>
				
				<a href="<?php echo base_url('admin/file_download/edit/'.$download['id_download']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/file_download/delete/'.$download['id_download']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>


<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog"  style = "width:500px;height:500px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <!-- Preview-->
        <div id='preview'></div>
      </div>
 
    </div>

  </div>
</div>

<script>
function view_file(id_download){
    
    $.ajax({
        url : "<?php echo base_url('admin/file_download/view_file/')?>",//+id_user+"/"+is_active
        type: "POST",
        data: {id_download:id_download},
        dataType: "JSON",
        success: function(data)
        {
            //if success ;close modal and reload ajax table
			$('#uploadModal').modal('show');
			$('#preview').html(data.view);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(errorThrown);
        }
    });
}

</script>