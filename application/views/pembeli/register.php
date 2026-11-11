<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register Pembeli</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
</head>


<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Pembeli</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Daftar akun baru</p>

      <form action="<?php echo site_url('Pembeli/register') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Nama lengkap" value="<?php echo set_value('name') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('name','<small class="text-danger">', '</small>') ?>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('email','<small class="text-danger">', '</small>') ?>
        <div class="input-group mb-3">
          <input type="number" name="no_hp" class="form-control" placeholder="Nomor HP" value="<?php echo set_value('no_hp') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('no_hp','<small class="text-danger">', '</small>') ?>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('password','<small class="text-danger">', '</small>') ?>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
        </div>
      </form>
    </div>

  </div><!-- /.card -->
</div>
<!-- /.register-box -->
</body>
</html>