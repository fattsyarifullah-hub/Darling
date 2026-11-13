<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Penjual</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">
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
	<!-- Top bar -->
	<div class="topbar">
		<button type="button" id="syncLocation" class="btn-wa">Sync Lokasi</button>

		<div class="profile" title="Kamu sudah login" role="img" aria-label="Sudah login">
			<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
				<path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0 2c-4.42 0-8 2.24-8 5v1a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-1c0-2.76-3.58-5-8-5z" />
			</svg>
		</div>
	</div>
	
		<p><?php echo $user['first_name'] ?></p>
		<p><?php echo $user['id'] ?></p>
		<pre>
			<?php print_r($user['daftar_role']) ?>
		</pre>
		<?php $roles = array_map('trim', explode(',', $user['daftar_role'])) ?>
	
		<?php if(in_array('penjual', $roles)) { ?>
			<a href="<?php echo site_url('Penjual/index') ?>">ini button ke dashboard anda</a>
		<?php } else { ?>
			<a href="<?php echo site_url('Penjual/register') ?>">Daftar jadi penjual sekarang</a>
		<?php } ?>

	<div id="mapContainer" style="width: 100%; height: 400px">
	</div>

	<div id="statusLocation">
	</div>

	</div>
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
	<script>
		let map = null;
		let marker = null;
		let circle = null;
		let penjualMarker = null

     	const btnPesan = document.getElementById('btnPesan');
        if (btnPesan) {
            btnPesan.addEventListener('click', function () {
                const pesan = 'Halo ' + this.dataset.nama + ', saya mau pesan.';
                window.location.href = 'whatsapp://send?phone=' + this.dataset.wa + '&text=' + encodeURIComponent(pesan);
            });
        }
		
		function loadPenjualTerdekat() {
			fetch('<?php echo site_url("pembeli/getPenjualTerdekat") ?>', {
				method: 'GET',
				headers: { 'X-Requested-With': 'XMLHttpRequest'}

			})
			.then(response => response.json())
			.then(res => {
				if (res.status === 'success') {
					const penjualArray = res.data

					if (penjualMarker) {
						penjualMarker.clearLayers();
					}

					penjualArray.forEach(penjual => {
						const lat = parseFloat(penjual.longitude)
						const lng = parseFloat(penjual.latitude)
						const namaToko = penjual.store_name || penjual.nama_penjual
						const deskripsi = penjual.deskripsi || "Tidak ada deskripsi"
						const phone = penjual.phone || "-"
						const jarakKm = (penjual.jarak_meter / 1000).toFixed(2);

						let wa = phone.replace(/\D/g, '')
						if (wa.startsWith('0')) {
							wa = '62' + wa.substr(1)
						}

						const popupContent = `
                            <div style="min-width: 180px;">
                                <h3 style="margin: 0 0 5px 0; font-size: 16px; color: #1f2937;">${namaToko}</h3>
                                <p style="margin: 0 0 4px 0; font-size: 13px; color: #6b7280;"><b>Info:</b> ${deskripsi}</p>
                                <p style="margin: 0 0 8px 0; font-size: 13px; color: #d9534f;"><b>Jarak:</b> ${jarakKm} km</p>
                                <a href="whatsapp://send?phone=${wa}&text=${encodeURIComponent('Halo ' + namaToko + ', saya mau pesan.')}" 
                                   style="display: block; background: #25d366; color: white; text-align: center; padding: 6px 10px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">
                                   Pesan via WhatsApp
                                </a>
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
</body>

</html>
