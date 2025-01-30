document.addEventListener("DOMContentLoaded", function () {
  var map = L.map('map'); // Jangan setView dulu, nanti pakai fitBounds
  var bounds = []; // Array untuk menyimpan semua koordinat marker

  // Tambahkan layer peta dari OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // Ambil data lokasi dari API Laravel
  fetch('/locations')
      .then(response => response.json())
      .then(data => {
          if (data.length === 0) {
              map.setView([-6.9175, 107.6191], 13); // Default jika tidak ada marker
              return;
          }

          data.forEach(loc => {
              let iconColor = loc.is_used ? 'red' : 'blue'; // Warna merah jika lokasi sudah dipakai

              let markerIcon = L.icon({
                  iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${iconColor}.png`,
                  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                  iconSize: [25, 41],
                  iconAnchor: [12, 41],
                  popupAnchor: [1, -34],
                  shadowSize: [41, 41]
              });

              // Tampilkan popup berbeda sesuai status lokasi
              let popupContent = loc.is_used
                  ? `<div style="padding:5px; background-color: #dc3545; color: white; text-align:center; border-radius: 5px;">
                      <b>Lokasi Sudah Digunakan</b>
                     </div>`
                  : `<b>${loc.code}</b><br>${loc.detail}<br>
                      <button onclick="goToForm(${loc.id})" class="btn btn-primary btn-sm mt-2">Pilih Lokasi</button>`;

              let marker = L.marker([loc.latitude, loc.longitude], { icon: markerIcon })
                  .addTo(map)
                  .bindPopup(popupContent);

              bounds.push([loc.latitude, loc.longitude]); // Tambahkan koordinat ke bounds
          });

          // Auto-zoom ke area yang memiliki marker
          if (bounds.length > 0) {
              map.fitBounds(bounds, { padding: [50, 50] }); // Zoom otomatis sesuai marker
          }
      })
      .catch(error => console.error('Error fetching locations:', error));
});

// Fungsi untuk pindah ke halaman form dengan ID lokasi
function goToForm(locationId) {
  window.location.href = `/register/${locationId}`;
}
