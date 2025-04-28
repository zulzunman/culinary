document.addEventListener("DOMContentLoaded", function () {
  var map = L.map('map');
  var bounds = [];
  var markers = [];

  // Tambahkan layer peta dari OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors',
      maxZoom: 23
  }).addTo(map);

  // Ukuran ikon yang lebih kecil
  const iconSize = [15, 24];
  const iconAnchor = [7, 24];
  const popupAnchor = [1, -20];
  const shadowSize = [25, 25];

  // Icon untuk marker merah (sudah digunakan)
  const redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize,
    iconAnchor,
    popupAnchor,
    shadowSize
  });

  // Icon untuk marker hijau (belum digunakan)
  const greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize,
    iconAnchor,
    popupAnchor,
    shadowSize
  });

  // Ambil data lokasi dari API Laravel
  fetch('/locations')
      .then(response => response.json())
      .then(data => {
          if (data.length === 0) {
              map.setView([-6.9175, 107.6191], 19);
              return;
          }

          data.forEach(loc => {
              let marker = createMarker(loc.latitude, loc.longitude, loc.is_used, loc.code, loc.detail, loc.id);
              markers.push(marker);
              bounds.push([loc.latitude, loc.longitude]);
          });

          if (bounds.length > 0) {
              map.fitBounds(bounds, { padding: [20, 20], maxZoom: 19 });
          }
      })
      .catch(error => console.error('Error fetching locations:', error));

  // Fungsi untuk membuat marker
  function createMarker(lat, lng, isUsed, code, detail, id) {
      let markerOptions = {
          icon: isUsed ? redIcon : greenIcon
      };

      let popupContent = isUsed
          ? `${detail}<br><div style="padding:5px; background-color: #dc3545; color: white; text-align:center; border-radius: 5px;">
                <b>Lokasi Sudah DiTempati</b>
              </div>`
          : `<b>${code}</b><br>${detail}<br>
                <button onclick="goToForm(${id})" class="btn btn-primary btn-sm mt-2">Booking Sekarang</button>`;

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
