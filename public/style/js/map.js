document.addEventListener("DOMContentLoaded", function () {
  var map = L.map('map'); // Jangan setView dulu, nanti pakai fitBounds
  var bounds = []; // Array untuk menyimpan semua koordinat marker
  var markers = []; // Menyimpan semua marker

  // Tambahkan layer peta dari OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors',
      maxZoom: 23
  }).addTo(map);

  // Definisikan ikon untuk marker merah (untuk lokasi yang sudah digunakan)
  var redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

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

  // Fungsi untuk membuat marker
  function createMarker(lat, lng, isUsed, code, detail, id) {
      // Tentukan icon berdasarkan status isUsed
      let markerOptions = {
          isUsed: isUsed
      };

      // Jika lokasi sudah digunakan, gunakan ikon merah
      if (isUsed) {
          markerOptions.icon = redIcon;
      }

      let popupContent = isUsed
          ? `${detail}<br><div style="padding:5px; background-color: #dc3545; color: white; text-align:center; border-radius: 5px;">
                <b>Lokasi Sudah DiTempati</b>
              </div>`
          : `<b>${code}</b><br>${detail}<br>
                <button onclick="goToForm(${id})" class="btn btn-primary btn-sm mt-2">Booking Sekarang</button>`;

      // Membuat marker
      let marker = L.marker([lat, lng], markerOptions)
          .addTo(map)
          .bindPopup(popupContent);

      return marker;
  }
});

// Fungsi untuk pindah ke halaman form dengan ID lokasi
function goToForm(locationId) {
  window.location.href = `/register/${locationId}`;
}