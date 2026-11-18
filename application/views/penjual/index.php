<?php
// ===== Nilai aman: cegah error kalau data dari controller kosong/null =====
$status_jualan = (isset($status_jualan) && is_array($status_jualan)) ? $status_jualan : [];

$sedang_aktif = !empty($status_jualan['active_selling']) && (int) $status_jualan['active_selling'] === 1;
$nama_toko    = $status_jualan['store_name']  ?? '';
$jenis_jualan = $status_jualan['description'] ?? '';

// Template pesan WhatsApp (kolom users.template_text)
$template_default = 'Halo kak, saya mau pesan dari {nama_toko}. Apakah masih tersedia?';
$template_text    = (!empty($status_jualan['template_text'])) ? $status_jualan['template_text'] : $template_default;
$flash_pesan      = isset($this->session) ? $this->session->flashdata('pesan') : null;
?>
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
                        Selamat Datang<?php echo $nama_toko !== '' ? ', ' . html_escape($nama_toko) : ''; ?>
                    </h4>

                    <p class="text-muted mb-1">
                        Jenis Dagangan:
                        <form action="<?php echo site_url('penjual/updateCategory') ?>" method="POST">
                            <label for="category">Pilih Kategori</label>
                            <select name="category_id" id="category" required   >
                                <option value="<?php echo set_value('category'); ?>">-- KATEGORI JUALAN --</option>

                                <?php foreach ($category as $c) : ?>
                                <option value="<?php echo $c['id'] ?>"> <?php echo $c['type'] ?> </option>
                                <?php endforeach ?>
                            </select>

                            <button type="submit">Jenis Kategori saya</button>
                        </form>
                    </p>

                    <p class="text-muted mb-0">
                    </p>

                </div>

            </div>


            <!-- BARIS UTAMA: kiri = status jualan, kanan = template WhatsApp -->
            <div class="row">

                <!-- STATUS JUALAN -->
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-body">

                            <?php if ($sedang_aktif) { ?>

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

                        </div>
                    </div>
                </div>

                <!-- TEMPLATE PESAN WHATSAPP (simple) -->
                <div class="col-lg-8 col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Template Pesan WhatsApp</h3>
                        </div>

                        <form method="POST" action="<?= site_url('penjual/simpan_template'); ?>">

                            <div class="card-body">

                                <?php if (!empty($flash_pesan)) { ?>
                                    <div class="alert alert-success py-2">
                                        <?php echo html_escape($flash_pesan); ?>
                                    </div>
                                <?php } ?>

                                <textarea name="template_text"
                                    class="form-control"
                                    rows="4"
                                    maxlength="500"
                                    placeholder="Tulis pesan untuk pembeli"
                                    required><?php echo html_escape($template_text); ?></textarea>

                                <small class="text-muted">
                                    Pakai <code>{nama_toko}</code> untuk nama tokomu.
                                </small>

                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

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
                action="<?php echo site_url('penjual/tambah_menu'); ?>">

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