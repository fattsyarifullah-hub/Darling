<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo lang('login_heading'); ?></title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Pembeli</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?php echo lang('login_subheading'); ?></p>

      <!-- Pesan dari Ion Auth (login gagal, dll.) -->
      <?php if (!empty($message)): ?>
        <div id="infoMessage" class="alert alert-danger"><?php echo $message; ?></div>
      <?php endif; ?>

      <?php echo form_open("auth/login"); ?>

        <div class="input-group mb-3">
          <?php
            echo form_input(array_merge($identity, [
              'class'       => 'form-control',
              'placeholder' => rtrim(lang('login_identity_label'), ': '),
            ]));
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <?php
            echo form_input(array_merge($password, [
              'class'       => 'form-control',
              'placeholder' => rtrim(lang('login_password_label'), ': '),
            ]));
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
              <label for="remember">
                <?php echo rtrim(lang('login_remember_label'), ': '); ?>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary btn-block"'); ?>
          </div>
          <!-- /.col -->
        </div>

      <?php echo form_close(); ?>

      <p class="mb-1 mt-3">
        <a href="<?php echo site_url('auth/forgot_password'); ?>"><?php echo lang('login_forgot_password'); ?></a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
</body>
</html>