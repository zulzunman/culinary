document.addEventListener("DOMContentLoaded", function () {
  var map = L.map('map'); // Jangan setView dulu, nanti pakai fitBounds
  var bounds = []; // Array untuk menyimpan semua koordinat marker
  var markers = []; // Menyimpan semua marker agar bisa diubah ukurannya

  // Tambahkan layer peta dari OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors',
      maxZoom : 23
  }).addTo(map);

  // Ambil data lokasi dari API Laravel
  fetch('/locations')
      .then(response => response.json())
      .then(data => {
          if (data.length === 0) {
              map.setView([-6.9175, 107.6191], 19); // Zoom lebih dekat jika tidak ada marker
              return;
          }

          data.forEach(loc => {
              let marker = createMarker(loc.latitude, loc.longitude, loc.is_used, loc.code, loc.detail, loc.id);
              markers.push(marker);
              bounds.push([loc.latitude, loc.longitude]); // Tambahkan koordinat ke bounds
          });

          // Auto-zoom ke area yang memiliki marker dengan zoom lebih dekat
          if (bounds.length > 0) {
              map.fitBounds(bounds, { padding: [20, 20], maxZoom: 19 }); // Zoom otomatis sesuai marker
          }
      })
      .catch(error => console.error('Error fetching locations:', error));

  // Fungsi untuk membuat marker dengan ukuran yang disesuaikan
  function createMarker(lat, lng, isUsed, code, detail, id) {
      let zoom = map.getZoom(); // Ambil zoom level saat ini
      let size = getMarkerSize(zoom); // Tentukan ukuran berdasarkan zoom level

      // Tentukan iconUrl berdasarkan isUsed
      let iconUrl = isUsed ? '/assets/img/icon/store-red.png' : '/assets/img/icon/store-blue.png';

      let markerIcon = L.icon({
          iconUrl: iconUrl, // Gunakan icon yang sesuai dengan isUsed
          iconSize: [size, size],
          iconAnchor: [size / 2, size],
          popupAnchor: [0, -size]
      });

      let popupContent = isUsed
          ? `<div style="padding:5px; background-color: #dc3545; color: white; text-align:center; border-radius: 5px;">
                <b>Lokasi Sudah Digunakan</b>
              </div>`
          : `<b>${code}</b><br>${detail}<br>
                <button onclick="goToForm(${id})" class="btn btn-primary btn-sm mt-2">Pilih Lokasi</button>`;

      // Membuat marker dengan menambahkan isUsed pada options
      let marker = L.marker([lat, lng], {
          icon: markerIcon,
          isUsed: isUsed  // Simpan status isUsed dalam marker
      })
      .addTo(map)
      .bindPopup(popupContent);

      return marker;
  }

  // Fungsi untuk mendapatkan ukuran marker berdasarkan zoom level
  function getMarkerSize(zoom) {
      return Math.max(10, Math.min(20, zoom * 2)); // Ukuran antara 10 - 40px
  }

  // Event listener untuk mengubah ukuran marker saat zoom berubah
  map.on("zoomend", function () {
      let zoom = map.getZoom();
      markers.forEach(marker => {
          let size = getMarkerSize(zoom);  // Ukuran marker berdasarkan zoom level

          // Ambil status isUsed dari marker (simpan status ini saat marker dibuat)
          let isUsed = marker.options.isUsed;

          // Tentukan iconUrl berdasarkan isUsed
          let iconUrl = isUsed ? '/assets/img/icon/store-red.png' : '/assets/img/icon/store-blue.png';

          // Buat ikon baru dengan ukuran dan icon yang sesuai
          let newIcon = L.icon({
              iconUrl: iconUrl,  // Gunakan icon berdasarkan isUsed
              iconSize: [size, size],
              iconAnchor: [size / 2, size],
              popupAnchor: [0, -size]
          });

          // Set ikon baru ke marker
          marker.setIcon(newIcon);
      });
  });
});

// Fungsi untuk pindah ke halaman form dengan ID lokasi
function goToForm(locationId) {
  window.location.href = `/register/${locationId}`;
}
