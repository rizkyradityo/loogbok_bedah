<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/admin/plugins/datetimepicker-master/jquery.datetimepicker.css">
<style>
	.table td, .table th {
    padding: .30rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
</style>
<div class="page-content">

<div class="form-group row">
        <label for="color" class="col-1 control-label">Tanggal</label>
        <div class="col-7">
            <input type="text" name="start_date" id="start_date"  autocomplete="off"> - <input type="text" name="end_date" id="end_date"  autocomplete="off">
        </div>
    </div>
    <div class="form-group row">
        <label for="color" class="col-1 control-label">Pengguna</label>
        <div class="col-7">
            <select name="id_user" id="id_user" class="form-control custom-select select2"  style="width:100%;line-height:18px;">
                <?php 
                    $session = \Config\Services::session(); 
                     $akses_level= $session->get('akses_level');
                    if( $akses_level == "Admin"){ ?>
                    <option value="">Semua</option>
                <?php } ?>
                <?php foreach($user as $user) { ?>
                <option  value="<?php echo $user['id_user'] ?>">
                <?php echo $user['nama'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </div>


    <button type="button" class="btn btn-success" onclick="show_logbook()">
             Tampilkan
    </button>
</div>
<br/>
<div id='table_content' class="col-md-12">
  <!--   <table class="table table-bordered" id="example1">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama</th>
                <th width="10%">Grup Loogbok</th>
                <th width="10%">Tanggal Awal</th>
                <th width="10%">Tanggal Akhir</th>
                <th width="10%">Judul</th>
                <th width="10%">Deskripsi</th>

            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data_calendar as $data_calendar) { 

            ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $data_calendar['nama'] ?></td>
                <td><?php echo $data_calendar['group_name'] ?></td>
                <td><?php echo $data_calendar['start_date'] ?></td>
                <td><?php echo $data_calendar['end_date'] ?></td>
                <td><?php echo $data_calendar['title'] ?></td>
                <td><?php echo $data_calendar['description'] ?></td>
                

            </tr>
            <?php $no++; } ?>
        </tbody>
    </table> -->
</div>


<script type="text/javascript" src="<?php echo base_url('/assets/admin/plugins/moment/moment.min.js') ?>"></script>   
<script type="text/javascript" src="<?php echo base_url('/assets/admin/plugins/datetimepicker-master/jquery.datetimepicker.js') ?>"></script>  
<!-- <script type="text/javascript" src="<?php echo base_url('/assets/admin/plugins/datetimepicker-master/jquery.js') ?>"></script>   -->
<script src="<?php echo base_url() ?>/assets/admin/plugins/select2/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/select2/css/select2.min.css">

<script>
$('.select2').select2()

$.datetimepicker.setDateFormatter('moment');
$('#start_date').datetimepicker({
    timepicker:false,
	format:'Y-MM-DD',
	formatDate:'Y-MM-DD',
});

$('#end_date').datetimepicker({
    timepicker:false,
	format:'Y-MM-DD',
	formatDate:'Y-MM-DD',
});

function show_logbook(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();

    if(start_date == ""){
        swal("Error", "Tanggal awal harus diisi","warning")
        return;
    }

    if(end_date == ""){
        swal("Error", "Tanggal akhir harus diisi","warning")
        return;
    }
    var id_user = $('#id_user').val();
    console.log(start_date);
    console.log(end_date);
    console.log(id_user);

    $.ajax({
        url : "<?php echo base_url('admin/calendar_event/list_select/')?>",//+id_user+"/"+is_active
        type: "POST",
        data: {id_user:id_user,start_date:start_date,end_date:end_date},
        dataType: "JSON",
        success: function(data)
        {
            //if success ;close modal and reload ajax table
            console.log(data);
            $('#table_content').html(data.view);

            $("#example1").DataTable({
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "responsive": true, 
                "paging": true,
                "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]],
                "lengthChange": true, 
                "autoWidth": false
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(errorThrown);
        }
    });
}

</script>