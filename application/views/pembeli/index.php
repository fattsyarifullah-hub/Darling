<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Penjual</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css'); ?>">
	<style>
		:root {
			--bg: #f4f6f8;
			--card: #ffffff;
			--text: #1f2937;
			--muted: #6b7280;
			--wa: #25d366;
			--wa-dark: #1ebe5b;
			--radius: 16px;
		}

		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
			background: var(--bg);
			color: var(--text);
			min-height: 100vh;
			display: flex;
			flex-direction: column;
			align-items: center;
			padding: 16px;
			gap: 16px;
		}

		/* ===== Top bar: Sync Lokasi (kiri) + profil (kanan) ===== */
		.topbar {
			width: 100%;
			max-width: 600px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
		}

		/* Tombol hijau: dipakai Pesan Sekarang & Sync Lokasi */
		.btn-wa,
		.penjual button {
			padding: 14px 16px;
			border: 0;
			border-radius: 12px;
			background: var(--wa);
			color: #fff;
			font-size: 16px;
			font-weight: 600;
			font-family: inherit;
			cursor: pointer;
			transition: background .2s, transform .1s;
		}

		.btn-wa:hover,
		.penjual button:hover {
			background: var(--wa-dark);
		}

		.btn-wa:active,
		.penjual button:active {
			transform: scale(.98);
		}

		.btn-wa:focus-visible,
		.penjual button:focus-visible {
			outline: 3px solid #86efac;
			outline-offset: 2px;
		}

		/* Ikon profil (tanda sudah login) */
		.profile {
			position: relative;
			width: 48px;
			height: 48px;
			border-radius: 50%;
			background: #e0e7ff;
			color: #4f46e5;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 4px 16px rgba(0, 0, 0, .1);
			flex-shrink: 0;
		}

		.profile svg {
			width: 26px;
			height: 26px;
		}

		/* titik hijau = status login */
		.profile::after {
			content: "";
			position: absolute;
			right: 1px;
			bottom: 1px;
			width: 12px;
			height: 12px;
			border-radius: 50%;
			background: var(--wa);
			border: 2px solid var(--bg);
		}

		/* Peta */
		iframe {
			width: 100%;
			max-width: 600px;
			height: 360px;
			border: 0;
			border-radius: var(--radius);
			box-shadow: 0 4px 16px rgba(0, 0, 0, .1);
			background: #e5e7eb;
		}

		/* Kartu penjual */
		.penjual {
			width: 100%;
			max-width: 600px;
			background: var(--card);
			border-radius: var(--radius);
			box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
			padding: 20px;
			display: grid;
			grid-template-columns: 56px 1fr;
			column-gap: 14px;
			row-gap: 4px;
			align-items: center;
		}

		.penjual::before {
			content: "🧑‍🍳";
			grid-row: 1 / 3;
			width: 56px;
			height: 56px;
			border-radius: 50%;
			background: #fff4e5;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 28px;
		}

		.penjual h1 {
			font-size: 18px;
			line-height: 1.3;
			font-weight: 700;
			align-self: end;
		}

		.penjual h1 br {
			display: none;
		}

		.penjual p {
			font-size: 14px;
			color: var(--muted);
			align-self: start;
		}

		.penjual button {
			grid-column: 1 / -1;
			margin-top: 16px;
			width: 100%;
		}

		/* Status lokasi & peta hasil sync */
		#statusLocation {
			width: 100%;
			max-width: 600px;
			text-align: center;
			font-size: 14px;
			color: var(--muted);
		}

		#mapContainer {
			max-width: 600px;
			border-radius: var(--radius);
			overflow: hidden;
		}

		@media (min-width: 640px) {
			body {
				padding: 32px 16px;
			}

			iframe {
				height: 450px;
			}
		}
	</style>
</head>

<body>
	<?php $roles = isset($user['daftar_role']) ? array_map('trim', explode(',', $user['daftar_role'])) : []; ?>
	<!-- Top bar -->
	<div class="topbar">
		<button type="button" id="syncLocation" class="btn-wa">Sync Lokasi</button>

		<div class="nav-item dropdown">
			<a class="profile" data-toggle="dropdown" href="#" role="button" title="Kamu sudah login" aria-label="Menu profil">
				<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
					<path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0 2c-4.42 0-8 2.24-8 5v1a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-1c0-2.76-3.58-5-8-5z" />
				</svg>
			</a>

			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<div class="dropdown-divider"></div>
				<?php if (in_array('penjual', $roles)) { ?>
					<form action="<?php echo site_url('Penjual/index') ?>">
						<button class="dropdown-item">
							<i class="fas fa-tachometer-alt mr-2"></i> Pergi ke dashboard Anda
						</button>
					</form>
					<?php if (in_array('admin', $roles)) { ?>
						<form action="<?php echo site_url('admin/index') ?>">
						<button class="dropdown-item">
							<i class="fas fa-tachometer-alt mr-2"></i>Dashboard Khusus Admin
						</button>
					</form>
					<?php } ?>
				<?php } else { ?>
					<form action="<?php echo site_url('Penjual/register') ?>">
						<button class="dropdown-item">
							<i class="fas fa-user-plus mr-2"></i> Daftar jadi penjual sekarang
						</button>
					</form>
				<?php } ?>


				<div class="dropdown-divider"></div>
				<form action="<?php echo site_url('auth/logout'); ?>" method="post" id="logoutForm">
					<button type="submit" class="dropdown-item">
						<i class="fas fa-sign-out-alt mr-2"></i> Sign out
					</button>
				</form>
			</div>
		</div>
	</div>

	<div id="mapContainer" style="width: 100%; height: 400px">
	</div>

	<div id="statusLocation">
	</div>

	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
	<script>
		let map = null;
		let marker = null;
		let circle = null;
		let penjualMarker = null

		const btnPesan = document.getElementById('btnPesan');
		if (btnPesan) {
			btnPesan.addEventListener('click', function() {
				const pesan = this.dataset.template_text;
				window.location.href = 'whatsapp://send?phone=' + this.dataset.wa + '&text=' + encodeURIComponent(pesan);
			});
		}


		// Aman untuk ditampilkan di dalam HTML popup (cegah isi toko berisi tag HTML)
		function escapeHtml(text) {
			const div = document.createElement('div');
			div.textContent = text;
			return div.innerHTML;
		}

		// Pesan default kalau penjual belum mengisi template di dashboard
		const TEMPLATE_DEFAULT = 'Halo {nama_toko}, saya mau pesan.';


		// Function untuk mencari Penjual berdasarkan radius
		function loadPenjualTerdekat() {
			fetch('<?php echo site_url("pembeli/getPenjualTerdekat") ?>', {
					method: 'GET',
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					}
				})
				.then(response => response.json())
				.then(res => {
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
							const namaToko = penjual.store_name || penjual.nama_penjual || 'Penjual'
							const phone = penjual.phone || "-"
							const jarakKm = (penjual.jarak_meter / 1000).toFixed(2);
							const type = penjual.type

							let wa = phone.replace(/\D/g, '')
							if (wa.startsWith('0')) {
								wa = '62' + wa.substr(1)
							}

							// Pesan WhatsApp: pakai template penjual (users.template_text)
							const template = (penjual.template_text && penjual.template_text.trim() !== '') ?
								penjual.template_text :
								TEMPLATE_DEFAULT;
							const pesanWa = template.replace(/\{nama_toko\}/g, namaToko);

							const popupContent = `
                            <div style="min-width: 180px;">
                                <h3 style="margin: 0 0 5px 0; font-size: 16px; color: #1f2937;">${escapeHtml(namaToko)}</h3>
                                <p style="margin: 0 0 8px 0; font-size: 13px; color: #d9534f;"><b>Jarak:</b> ${jarakKm} km</p>
                                <a href="whatsapp://send?phone=${wa}&text=${encodeURIComponent(pesanWa)}" 
                                   style="display: block; background: #25d366; color: white; text-align: center; padding: 6px 10px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">
                                   Pesan via WhatsApp
                                </a>
                            </div>
                        `;

							const sellerMarker = L.circleMarker([lat, lng], {
								radius: 8,
								fillColor: getColorByCategory(type),
								color: "#000",
								weight: 1,
								opacity: 1,
								fillOpacity: 0.8
							}).bindPopup(popupContent);
							penjualMarker.addLayer(sellerMarker);
						})
					}
				})
				.catch(error => {
					console.error('Gagal Memuat data Penjual terdekat: ', error)
				})
		}


		function getColorByCategory(color) {
			switch (color) {
				case "Makanan Berat":
					return 'red'
					break;
				case "Minuman":
					return 'blue'
					break;
			}
		}


		document.getElementById('syncLocation').addEventListener('click', function() {
			const button = this;
			const statusText = document.getElementById('statusLocation');

			if (!navigator.geolocation) {
				statusText.textContent = 'Browser ini tidak mendukung fitur lokasi.';
				return;
			}

			button.disabled = true;
			statusText.textContent = 'Meminta akses lokasi...';

			navigator.geolocation.getCurrentPosition(function(position) {
				const lat = position.coords.latitude;
				const lng = position.coords.longitude;
				const body = new URLSearchParams({
					latitude: String(lat),
					longitude: String(lng)
				});

				statusText.textContent = 'Menyimpan lokasi...';

				fetch('<?php echo site_url("pembeli/syncLocation") ?>', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded',
							'X-Requested-With': 'XMLHttpRequest'
						},
						body: body.toString()
					})
					.then(function(response) {
						return response.text().then(function(responseText) {
							let data;
							try {
								data = JSON.parse(responseText);
							} catch (error) {
								throw new Error(
									'Server mengirim respons bukan JSON (HTTP ' + response.status +
									'). Periksa log aplikasi.'
								);
							}

							if (!response.ok || data.status !== 'success') {
								throw new Error(data.message || 'Lokasi gagal disimpan.');
							}
							return data;
						});
					})
					.then(function() {
						statusText.textContent = 'Lokasi berhasil disinkronkan.';

						if (map === null) {
							map = L.map('mapContainer').setView([lat, lng], 16);
							L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
								maxZoom: 19,
								attribution: '&copy; OpenStreetMap contributors'
							}).addTo(map);

							marker = L.marker([lat, lng]).addTo(map);

							circle = L.circle([lat, lng], {
								radius: 500,
								color: '#25d366',
								fillColor: '#25d366',
								fillOpacity: 0.2
							}).addTo(map);

							penjualMarker = L.layerGroup().addTo(map)
						} else {
							map.setView([lat, lng], 16);
							marker.setLatLng([lat, lng]);
							circle.setLatLng([lat, lng]);
						}

						setTimeout(function() {
							map.invalidateSize();
						}, 100);

						loadPenjualTerdekat()
					})
					.catch(function(error) {
						statusText.textContent = error.message;
					})
					.then(function() {
						button.disabled = false;
					});
			}, function(error) {
				const messages = {
					1: 'Izin lokasi ditolak. Izinkan akses lokasi di browser.',
					2: 'Lokasi tidak dapat ditentukan. Coba lagi.',
					3: 'Permintaan lokasi melewati batas waktu. Coba lagi.'
				};
				statusText.textContent = messages[error.code] || 'Gagal mendapatkan lokasi.';
				button.disabled = false;
			}, {
				enableHighAccuracy: true,
				timeout: 15000,
				maximumAge: 0
			});
		});
	</script>
	<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
</body>

</html>