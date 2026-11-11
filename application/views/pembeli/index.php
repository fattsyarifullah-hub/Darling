<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Penjual</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
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

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3368.7781183091256!2d106.82804601447455!3d-6.4375712590096485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eb1403c4f39f%3A0xc4fae7de4f7e2f4!2sKurma%20Media!5e0!3m2!1sid!2sid!4v1794296199675!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>

    <div class="penjual">
        <h1>Nama: <br> Budi Sentyo</h1>
        <p>Jenis Jualan</p>
        <button>Pesan Sekarang</button>
    </div>

    <div id="statusLocation">

    </div>

    <div id="mapContainer" style="width: 100%; height: 400px">

    </div>
</body>

</html>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
    let map = null
    let marker = null
    document.getElementById('syncLocation').addEventListener('click', function() {
        const statusText = document.getElementById('statusLocation')
        statusText.textContent = "Mencari lokasi"

        if (!navigator.geolocation) {
            statusText.textContent = "Browser Tidak mengizinkan lokasi, silahkan aktifkan terlebih dahulu"
        }
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude
            const lng = position.coords.longitude

            statusText.textContent = `Lokasi didapat latitude: ${lat}, longitude: ${lng}`

            setTimeout(() => {

                fetch('<?php echo site_url("pembeli/syncLocation") ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: `lat=${lat}&lng=${lng}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {

                            statusText.textContent = "Lokasi Berhasil diperbarui"
                            if (map == null) {
                                map = L.map("mapContainer").setView([lat, lng], 16);

                                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                    maxZoom: 23,
                                }).addTo(map);
                                marker = L.marker([lat, lng]).addTo(map)
                                L.circle([lat, lng], {
                                    color: 'red',
                                    fillColor: 'gray',
                                    fillOpacity: 0.5,
                                    radius: 500
                                }).addTo(map)
                            } else {
                                map.setView([lat, lng], 16)
                                marker.setLatLng([lat, lng])
                                L.circle([lat, lng], {
                                    color: 'red',
                                    fillColor: 'gray',
                                    fillOpacity: 0.5,
                                    radius: 500
                                }).addTo(map)
                            }
                            setTimeout(() => {
                                map.invalidateSize();
                            }, 100);
                        } else {
                            alert(`Gagal ${data.message}`)
                        }
                    })
                    .catch(error => {
                        statusText.textContent = `Terjadi Kesalahan ${error}`
                    })
            }, 5000)
        })
    })
</script>


</body>

</html>