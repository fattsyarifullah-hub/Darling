		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="<?php echo base_url(); ?>" class="brand-link">
				<img src="<?php echo base_url('assets/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light" style="font-size: 16px;">Radar Pedagang Keliling</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">Administrator</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?php echo site_url('admin'); ?>" class="nav-link <?php echo ($title == 'Dashboard') ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<li class="nav-header">MANAJEMEN DATA</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/pedagang'); ?>" class="nav-link <?php echo ($title == 'Data Pedagang') ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-store"></i>
								<p>
									Data Pedagang
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/pembeli'); ?>" class="nav-link <?php echo ($title == 'Data Pembeli') ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>Data Pembeli</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/kategori'); ?>" class="nav-link <?php echo ($title == 'Kategori Jajanan') ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-utensils"></i>
								<p>Kategori Jajanan</p>
							</a>
						</li>

						<li class="nav-header">LAINNYA</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/laporan'); ?>" class="nav-link <?php echo ($title == 'Laporan & Keluhan') ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-exclamation-triangle"></i>
								<p>Laporan & Keluhan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/pengaturan'); ?>" class="nav-link <?php echo ($title == 'Pengaturan Sistem') ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-cog"></i>
								<p>Pengaturan Sistem</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"><?php echo $title; ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>">Home</a></li>
								<li class="breadcrumb-item active"><?php echo $title; ?></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<!-- Kolom Kiri: Form Tambah Kategori -->
						<div class="col-md-4">
							<div class="card card-warning card-outline">
								<div class="card-header">
									<h3 class="card-title">Tambah Kategori Baru</h3>
								</div>
								<form action="<?php echo site_url('Admin/kategori') ?>" method="POST">
									<div class="card-body">
										<div class="form-group">
											<label>Nama Kategori</label>
											<input type="text" class="form-control" placeholder="Contoh: Makanan Berat, Minuman" value="<?php echo set_value('type') ?>" name="type">
										</div>
										<?php echo form_error('type','<small class="text-danger">', '</small>') ?>
										<div class="form-group">
											<label>Warna Marker</label>
											<input type="color" class="form-control" value="<?php echo set_value('colour_marker') ?>" name="colour_marker">
										</div>
										<?php echo form_error('colour_marker','<small class="text-danger">', '</small>') ?>
									</div>
									<div class="card-footer">
										<button type="submit" class="btn btn-warning btn-block">
											<i class="fas fa-plus mr-1"></i> Simpan Kategori
										</button>
									</div>
								</form>
							</div>
						</div>

						<!-- Kolom Kanan: Tabel Daftar Kategori -->
						<div class="col-md-8">
							<div class="card card-warning card-outline">
								<div class="card-header">
									<h3 class="card-title">Daftar Kategori Jajanan</h3>
								</div>
								<div class="card-body table-responsive p-0">
									<table class="table table-hover text-nowrap">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Kategori</th>
												<th>Warna Marker</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($allCategory as $data) : ?>
												<tr>
													<td><?php echo $no ?></td>
													<td><?php echo $data['type'] ?></td>
													<td><?php echo $data['colour_marker'] ?></td>
												</tr>
											<?php $no++;
											endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
			<div class="p-3">
				<h5>Title</h5>
				<p>Sidebar content</p>
			</div>
		</aside>
		<!-- /.control-sidebar -->