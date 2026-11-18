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
						<div class="col-12">
							<div class="card card-info card-outline">
								<div class="card-header">
									<h3 class="card-title">Daftar Pengguna (Pembeli) Terdaftar</h3>
									<div class="card-tools">
										<div class="input-group input-group-sm" style="width: 220px;">
											<input type="text" name="table_search" class="form-control float-right" placeholder="Cari nama atau email...">
											<div class="input-group-append">
												<button type="submit" class="btn btn-default">
													<i class="fas fa-search"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card-header -->

								<div class="card-body table-responsive p-0">
									<table class="table table-hover text-nowrap">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Lengkap</th>
												<th>Email</th>
												<th>No. Handphone</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; 
											foreach ($allUsers as $data) : ?>
											<!-- Data Dummy 1 -->
											<tr>
												<td><?php echo $no ?></td>
												<td><?php echo $data['first_name'] . ' ' . $data['last_name']  ?></td>
												<td><?php echo $data['email'] ?></td>
												<td><?php echo $data['phone'] ?></td>
											</tr>
											<?php $no++; endforeach ?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->

								<div class="card-footer clearfix">
									<div class="float-left text-muted text-sm">
										Menampilkan 3 dari 152 data pembeli
									</div>
									<ul class="pagination pagination-sm m-0 float-right">
										<li class="page-item"><a class="page-link" href="#">«</a></li>
										<li class="page-item active"><a class="page-link" href="#">1</a></li>
										<li class="page-item"><a class="page-link" href="#">2</a></li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item"><a class="page-link" href="#">»</a></li>
									</ul>
								</div>
							</div>
							<!-- /.card -->
						</div>
					</div>
				</div>
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- ========================================================================= -->
		<!-- MODAL POP-UP DETAIL PEMBELI                                               -->
		<!-- ========================================================================= -->
		<div class="modal fade" id="modal-detail-pembeli">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-info">
						<h4 class="modal-title">Detail Informasi Pembeli</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Nama Pengguna</b> <a class="float-right"></a>
							</li>
							<li class="list-group-item">
								<b>Alamat Utama</b> <a class="float-right">Perumahan GDC Sektor Melati, Depok</a>
							</li>
							<li class="list-group-item">
								<b>Total Jajan / Panggilan</b> <a class="float-right">14 Kali</a>
							</li>
							<li class="list-group-item">
								<b>Jajanan Favorit</b> <a class="float-right">Bakso Malang, Es Doger</a>
							</li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
			<div class="p-3">
				<h5>Title</h5>
				<p>Sidebar content</p>
			</div>
		</aside>
		<!-- /.control-sidebar -->
