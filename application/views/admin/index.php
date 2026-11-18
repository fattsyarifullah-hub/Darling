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
							<a href="<?php echo site_url('admin'); ?>" class="nav-link active">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<li class="nav-header">MANAJEMEN DATA</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/pedagang'); ?>" class="nav-link">
								<i class="nav-icon fas fa-store"></i>
								<p>
									Data Pedagang
									<span class="right badge badge-warning"></span>
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
					<!-- 4 Kotak Statistik -->
					<div class="row">
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-warning">
								<div class="inner">
									<h3><?php echo $countPedagang ?></h3>
									<p>Total Mitra Pedagang</p>
								</div>
								<div class="icon">
									<i class="fas fa-store"></i>
								</div>
								<a href="<?php echo site_url('admin/pedagang'); ?>" class="small-box-footer">Kelola Pedagang <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-success">
								<div class="inner">
									<h3><?php echo $countActivePedagang ?></h3>
									<p>Pedagang Online (GPS Aktif)</p>
								</div>
								<div class="icon">
									<i class="fas fa-satellite-dish"></i>
								</div>
								<a href="#peta-pantauan" class="small-box-footer">Pantau di Peta <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-info">
								<div class="inner">
									<h3><?php echo $countAll ?></h3>
									<p>Pembeli Terdaftar</p>
								</div>
								<div class="icon">
									<i class="fas fa-users"></i>
								</div>
								<a href="<?php echo site_url('admin/pembeli'); ?>" class="small-box-footer">Lihat Pembeli <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

					</div>
					<!-- /.row -->

					<!-- Peta Pantauan & Statistik Kategori -->
					<div class="row" id="peta-pantauan">
						<!-- Peta Live Radar (8 Kolom) -->
						<div class="col-lg-8">
							<div class="card bg-gradient-primary">
								<div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
									<h3 class="card-title">
										<i class="fas fa-map-marker-alt mr-1"></i>
										Live Radar Sebaran Pedagang
									</h3>
									<!-- card tools -->
									<div class="card-tools">
										<span class="badge badge-success mr-2"><i class="fas fa-circle text-xs"></i> <?php echo $countActivePedagang ?> Aktif </span>
										<button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
									<!-- /.card-tools -->
								</div>
								<div class="card-body p-0" id="map" style="width: 100%; height: 400px">

								</div>
								<!-- /.card-body-->
								<div class="card-footer bg-transparent">
									<small class="text-white"><i class="fas fa-info-circle mr-1"></i> Menampilkan titik koordinat terakhir pedagang yang aktif berkeliling.</small>
								</div>
							</div>
						</div>

						<!-- Statistik Kategori & Wilayah Ramai (4 Kolom) -->
						<div class="col-lg-4">
							<!-- Proporsi Kategori Jajanan -->
							<div class="card card-warning card-outline">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Proporsi Kategori Aktif</h3>
								</div>
								<div class="card-body">
									<div class="progress-group">
										Makanan Berat (Bakso, Mie Ayam)
										<span class="float-right"><b>18</b>/44</span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-danger" style="width: 45%"></div>
										</div>
									</div>

									<div class="progress-group">
										Minuman Segar (Es Doger, Cendol)
										<span class="float-right"><b>12</b>/44</span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-primary" style="width: 30%"></div>
										</div>
									</div>

									<div class="progress-group">
										Jajanan Ringan (Siomay, Cilok)
										<span class="float-right"><b>9</b>/44</span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-warning" style="width: 20%"></div>
										</div>
									</div>

									<div class="progress-group mb-0">
										Kue & Roti Keliling
										<span class="float-right"><b>5</b>/44</span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-success" style="width: 12%"></div>
										</div>
									</div>
								</div>
							</div>

							<!-- Titik Keramaian Pembeli -->
							<div class="card card-success card-outline">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-fire mr-1"></i> Titik Keramaian Pembeli</h3>
								</div>
								<div class="card-body p-0">
									<ul class="nav flex-column">
										<li class="nav-item">
											<span class="nav-link">
												1. Area Situ Cilodong
												<span class="float-right badge bg-success">68 Pencarian</span>
											</span>
										</li>
										<li class="nav-item">
											<span class="nav-link">
												2. Boulevard Grand Depok City
												<span class="float-right badge bg-info">54 Pencarian</span>
											</span>
										</li>
										<li class="nav-item">
											<span class="nav-link">
												3. Jl. Raya Kalimulya
												<span class="float-right badge bg-warning">39 Pencarian</span>
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
		<script>
		const map = L.map('map').setView([-6.438095918337525, 106.82835283756185], 12);

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

		const penjualMarker = L.layerGroup().addTo(map);

		fetch('<?php echo site_url("admin/locationActive") ?>', {
				method: 'GET',
				headers: { 'X-Requested-With': 'XMLHttpRequest'}
			})
			.then(response => response.json())
			.then(res => {
				console.log(res)
				if (res.status === 'success') {
					const penjualArray = res.data

					if (!penjualMarker) {
							if (map !== null) {
								penjualMarker = L.layerGroup().addTo(map);
							} else {
								return; // Hentikan jika peta belum siap
							}
						} else {
							penjualMarker.clearLayers();
						}

					penjualArray.forEach(penjual => {
						const lng = parseFloat(penjual.longitude)
						const lat = parseFloat(penjual.latitude)
						const namaToko = penjual.store_name || penjual.nama_penjual
						const phone = penjual.phone || "-"

						let wa = phone.replace(/\D/g, '')
						if (wa.startsWith('0')) {
							wa = '62' + wa.substr(1)
						}

						const popupContent = `
                            <div style="min-width: 180px;">
                                <h3 style="margin: 0 0 5px 0; font-size: 16px; color: #1f2937;">${namaToko}</h3>
                                <p style="margin: 0 0 4px 0; font-size: 13px; color: #6b7280;"><b>Nomor:</b> ${phone}</p>
                            </div>
                        `;

						const sellerMarker = L.marker([lat, lng]).bindPopup(popupContent);
                        penjualMarker.addLayer(sellerMarker);
					})
				}
			})
			.catch(error => {
				console.error('Gagal Memuat data Penjual terdekat: ', error)
			})
		</script>