<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Penjual | Radar Pedagang Keliling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">

    <div class="register-box" style="width: 480px;">

        <div class="register-logo">
            <b>Radar</b> Pedagang
        </div>

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus mr-2"></i>
                    Registrasi Penjual
                </h3>
            </div>

            <!-- 1. ACTION DIBETULKAN MENGARAH KE CONTROLLER -->
            <form method="POST" action="<?php echo site_url('Penjual/register') ?>">

                <div class="card-body">

                    <div class="form-group">
                        <label>Nama Toko</label>
                        <!-- Name menggunakan "first_name" agar sama dengan database -->
                        <input type="text"
                            name="store_name"
                            class="form-control"
                            placeholder="Contoh: Bakso Pak Rahmat, Perabot Mang Rizky"
                            value="<?php echo set_value('store_name'); ?>"
                            >
                    </div>
                    <?php echo form_error('store_name','<small class="text-danger">', '</small>') ?>

                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="text"
                            name="phone"
                            class="form-control"
                            placeholder="Contoh: 081930139211"
                            value="<?php echo set_value('phone'); ?>"
                            >
                    </div>
                    <?php echo form_error('phone','<small class="text-danger">', '</small>') ?>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">
                        Daftar Sekarang
                    </button>

                    <a href="<?php echo site_url('penjual/login'); ?>"
                        class="btn btn-default float-right">
                        Kembali Login
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