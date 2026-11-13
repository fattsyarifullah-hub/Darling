<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href=""
        class="brand-link">

        <img src="<?php echo base_url('assets/dist/img/AdminLTELogo.png'); ?>"
            class="brand-image img-circle elevation-3"
            style="opacity:.8">

        <span class="brand-text font-weight-light">
            Radar Pedagang
        </span>
    </a>

    <div class="sidebar">

        <!-- USER PANEL -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>"
                    class="img-circle elevation-2">
            </div>

            <div class="info">
                <a href="#" class="d-block">
                    Penjual
                </a>
            </div>

        </div>

        <!-- MENU SIDEBAR -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="<?php echo site_url('penjual/dashboard'); ?>"
                        class="nav-link active">

                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>

                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo site_url('penjual/menu_dagangan'); ?>" class="nav-link">

                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Menu Dagangan</p>

                    </a>
                </li>

            </ul>

        </nav>

    </div>
</aside>


<!-- CONTENT WRAPPER -->
<div class="content-wrapper">

    <!-- CONTENT HEADER -->
    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Data dagangan</a>
                        </li>
                    </ol>
                </div>

            </div>

        </div>

    </div>


    <!-- MAIN CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <!-- INFORMASI USAHA -->
            <div class="card">

                <div class="card-body">

                    <h4>
                        Selamat Datang,
                    </h4>

                    <p class="text-muted mb-1">
                        Jenis Dagangan:
                        <strong>

                        </strong>
                    </p>

                    <p class="text-muted mb-0">
                    </p>

                </div>

            </div>


            <!-- TOTAL PRODUK -->
            <div class="row">

                <div class="col-lg-4 col-md-6 col-12">

                    <div class="small-box bg-info">

                        <div class="inner">

                            <h3>hitung menu</h3>

                            <p>Total Menu Dagangan</p>

                        </div>

                        <div class="icon">
                            <i class="fas fa-utensils"></i>
                        </div>

                        <a href="#menu-saya" class="small-box-footer">
                            Lihat Menu
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </div>

                </div>

            </div>


<?php if ($status_jualan['active_selling'] == 1) { ?>

    <h4 class="text-success">Sedang Aktif Berjualan</h4>

    <form method="POST" action="<?= site_url('penjual/ubah_status'); ?>">
        <button type="submit" class="btn btn-danger">
            NONAKTIFKAN JUALAN
        </button>
    </form>

<?php } else { ?>

    <h4 class="text-danger">Tidak Sedang Berjualan</h4>

    <form method="POST" action="<?= site_url('penjual/ubah_status'); ?>">
        <button type="submit" class="btn btn-success">
            AKTIFKAN JUALAN
        </button>
    </form>

<?php } ?>

            <!-- MENU DAGANGAN -->

        </div>

    </section>

</div>


<!-- MODAL TAMBAH MENU -->
<div class="modal fade" id="modalTambahMenu">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h5 class="modal-title">
                    <i class="fas fa-plus mr-1"></i>
                    Tambah Menu Dagangan
                </h5>

                <button type="button"
                    class="close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <form method="POST"
                action=" <?php echo site_url('penjual/tambah_menu'); ?>">

                <div class="modal-body">

                    <div class="form-group">

                        <label>Nama Menu / Barang</label>

                        <input type="text"
                            name="nama_menu"
                            class="form-control"
                            placeholder="Contoh: Bakso, Es Teh, Sayuran"
                            required>

                    </div>


                    <div class="form-group">

                        <label>Kategori</label>

                        <select name="kategori"
                            class="form-control"
                            required>

                            <option value="">-- Pilih Kategori --</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Jajanan">Jajanan</option>
                            <option value="Sayuran dan Buah">Sayuran dan Buah</option>
                            <option value="Sembako">Sembako</option>
                            <option value="Lainnya">Lainnya</option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label>Deskripsi Menu</label>

                        <textarea name="deskripsi"
                            class="form-control"
                            rows="3"
                            placeholder="Deskripsi menu atau barang yang dijual"></textarea>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-default"
                        data-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-info">

                        <i class="fas fa-save mr-1"></i>
                        Simpan Menu

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>