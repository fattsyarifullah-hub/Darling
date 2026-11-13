<?php
// Teks label (dipakai juga sebagai placeholder)
$label_text = ($type == 'email')
    ? sprintf(lang('forgot_password_email_label'), $identity_label)
    : sprintf(lang('forgot_password_identity_label'), $identity_label);
$label_text = rtrim($label_text, ': ');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo lang('forgot_password_heading'); ?></title>

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
      <h5 class="text-center mb-2"><?php echo lang('forgot_password_heading'); ?></h5>
      <p class="login-box-msg"><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>

      <!-- Pesan dari Ion Auth -->
      <?php if (!empty($message)): ?>
        <div id="infoMessage" class="alert alert-danger"><?php echo $message; ?></div>
      <?php endif; ?>

      <?php echo form_open("auth/forgot_password"); ?>

        <div class="input-group mb-3">
          <?php
            echo form_input(array_merge($identity, [
              'type'        => ($type == 'email') ? 'email' : 'text',
              'class'       => 'form-control',
              'placeholder' => $label_text,
            ]));
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-primary btn-block"'); ?>
          </div>
          <!-- /.col -->
        </div>

      <?php echo form_close(); ?>

      <p class="mt-3 mb-1">
        <a href="<?php echo site_url('auth/login'); ?>">Kembali ke halaman login</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
</body>
</html>