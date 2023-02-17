<?php 
use App\Models\Konfigurasi_model;
$konfigurasi  = new Konfigurasi_model;
$site         = $konfigurasi->listing();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title ?></title>
  <meta content="<?php echo strip_tags($description) ?>" name="description">
  <meta content="<?php echo $keywords ?>" name="keywords">
  <!-- Favicons -->
  <link href="<?php echo base_url('assets/upload/image/'.$site['icon']) ?>" rel="icon">
  <link href="<?php echo base_url('assets/upload/image/'.$site['icon']) ?>" rel="apple-touch-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- jQuery -->
<script src="<?php echo base_url() ?>/assets/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/dist/css/adminlte.min.css">
<!-- SWEETALERT -->
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <script src="<?php echo base_url('/assets/sweetalert/js/sweetalert2.min.js') ?>"></script>
</head>
<body class="hold-transition login-page" style="background-color: #c2c2d6;">
<div class="login-box" style="min-width: 35% !important; ">
  
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body" style="border-radius: 10px;">

      
      <hr>
      <p class="login-box-msg" style="font-weight:bold;">Register a new membership</p>

       <?php echo '<span class="text-danger">'.\Config\Services::validation()->listErrors().'</span>'; ?>
<?php 

 echo form_open(base_url('login/register')); ?>
      <?= csrf_field() ?>

        <div class="input-group mb-3">
          <input type="text" name="nama" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div> 
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>         
        <div class="input-group mb-3">
          <input type="text" name="nip_nup" class="form-control" placeholder="NIP/NUP">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="nidn_nidk" class="form-control" placeholder="NIDN/NIDK">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="orchid_id" class="form-control" placeholder="Orchid ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="scopus_id" class="form-control" placeholder="Scopus ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      <?php echo form_close(); ?>
      <hr>
      <p class="mb-1 text-center">
        <a href="<?php echo base_url('login/lupa') ?>">Lupa Password?</a> | <a href="<?php echo base_url('login') ?>" class="text-center">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script>
<?php if($session->getFlashdata('sukses')) { ?>
// Notifikasi
swal ( "Berhasil" ,  "<?php echo $session->getFlashdata('sukses'); ?>" ,  "success" )
<?php } ?>

<?php if(isset($_GET['logout'])) { ?>
// Notifikasi
swal ( "Berhasil" ,  "Anda berhasil logout." ,  "success" )
<?php } ?>

<?php if(isset($_GET['login'])) { ?>
// Notifikasi
swal ( "Oops..." ,  "Anda belum login." ,  "warning" )
<?php } ?>

<?php if($session->getFlashdata('warning')) { ?>
// Notifikasi
swal ( "Mohon maaf" ,  "<?php echo $session->getFlashdata('warning'); ?>" ,  "warning" )
<?php } ?>

</script>


<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>/assets/admin/dist/js/adminlte.min.js"></script>

</body>
</html>
