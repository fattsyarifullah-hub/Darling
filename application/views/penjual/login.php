<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Penjual | Radar Pedagang Keliling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box" style="width: 450px;">

    <div class="login-logo">
        <b>Radar Pedagang Keliling</b> 
    </div>

    <div class="card card-info">

        <div class="card-header">
            <h3 class="card-title">
                Login Penjual
            </h3>
        </div>

        <!-- Menampilkan pesan error jika login gagal -->
        <?php if(isset($error)): ?>
            <div class="alert alert-danger m-2" style="font-size: 14px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form class="form-horizontal" method="POST" action="<?php echo site_url('penjual/login'); ?>">
            
            <div class="card-body">

                <div class="form-group row">
                    <!-- Label diubah -->
                    <label class="col-sm-4 col-form-label">
                        Email / No WA
                    </label>

                    <div class="col-sm-8">
                        <!-- name="identity" dan type="text" agar bisa diisi email atau angka -->
                        <input type="text"
                               name="identity"
                               class="form-control"
                               placeholder="Masukkan Email atau No WA"
                               required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        Password
                    </label>

                    <div class="col-sm-8">
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Masukkan password"
                               required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-sm-4 col-sm-8">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info">
                    Login
                </button>

                <a href="<?php echo site_url('penjual/register'); ?>" class="btn btn-default float-right">
                    Register
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>