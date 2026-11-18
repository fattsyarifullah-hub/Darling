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
							<a href="<?php echo site_url('admin'); ?>" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<li class="nav-header">MANAJEMEN DATA</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/pedagang'); ?>" class="nav-link active">
								<i class="nav-icon fas fa-store"></i>
								<p>
									Data Pedagang
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/pembeli'); ?>" class="nav-link">
								<i class="nav-icon fas fa-users"></i>
								<p>Data Pembeli</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/kategori'); ?>" class="nav-link">
								<i class="nav-icon fas fa-utensils"></i>
								<p>Kategori Jajanan</p>
							</a>
						</li>

						<li class="nav-header">LAINNYA</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/laporan'); ?>" class="nav-link">
								<i class="nav-icon fas fa-exclamation-triangle"></i>
								<p>Laporan & Keluhan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/pengaturan'); ?>" class="nav-link">
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
								<li class="breadcrumb-item"><a href="#">Home</a></li>
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

					<!-- Kolom Kanan: Status GPS Terkini -->
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Aktivitas GPS Pedagang Terkini</h3>
							</div>
							<div class="card-body table-responsive p-0">
								<table class="table table-striped table-valign-middle">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Toko</th>
											<th>Kategori Dagangan</th>
											<th>Aktif</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; 
											foreach ($allPedagang as $data) : ?>
										<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $data['store_name'] ?></td>
											<td><?php echo $data['type'] ?></td>
											<td><span class="badge <?php echo $data['active_selling'] == 1 ? 'badge-success' : 'badge-secondary' ?>"><?php echo $data['active_selling'] == 1 ? 'Aktif' : 'Nonaktif' ?></span></td>
										</tr>
										<?php $no++; endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /.row -->
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