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
              let marker = createMarker(loc.latitude, loc.longitude, loc.is_used, loc.code, loc.detail, loc.id, loc.store_name, loc.menu_photo);
              markers.push(marker);
              bounds.push([loc.latitude, loc.longitude]);
          });
          if (bounds.length > 0) {
              map.fitBounds(bounds, { padding: [20, 20], maxZoom: 19 });
          }
      })
      .catch(error => console.error('Error fetching locations:', error));

  // Fungsi untuk membuat marker
  function createMarker(lat, lng, isUsed, code, detail, id, storeName, menu_photo) {
      let markerOptions = {
          icon: isUsed ? redIcon : greenIcon
      };

      // Buat konten popup
      let popupContent = '';

      if (isUsed) {
          // Gunakan path gambar langsung dari database, tambahkan / di awal jika belum ada
          const menu_photoPath = menu_photo ? (menu_photo.startsWith('/') ? menu_photo : `/${menu_photo}`) : '';
          const menu_photoHtml = menu_photo ?
              `<div style="text-align: center; margin-bottom: 8px;">
                <img src="${menu_photoPath}" alt="${storeName || 'Produk'}"
                style="max-width: 150px; max-height: 100px; border-radius: 5px; object-fit: cover;">
              </div>` : '';

          const storeNameHtml = storeName ?
              `<div style="font-weight: bold; margin-bottom: 5px; font-size: 14px; text-align: center;">
                ${storeName}
              </div>` : '';

          popupContent = `
              ${menu_photoHtml}
              ${storeNameHtml}
              <div style="font-size: 12px; margin-bottom: 5px;">${detail}</div>
              <div style="padding: 5px; background-color: #dc3545; color: white; text-align: center; border-radius: 5px; margin-top: 5px; font-size: 12px;">
                <b>Lokasi Sudah DiTempati</b>
              </div>`;
      } else {
          // Jika lokasi kosong
          popupContent = `
              <div style="font-weight: bold; margin-bottom: 3px;">${code}</div>
              <div style="font-size: 12px; margin-bottom: 5px;">${detail}</div>
              <button onclick="goToForm(${id})" class="btn btn-primary btn-sm w-100 mt-2">Booking Sekarang</button>`;
      }

      let marker = L.marker([lat, lng], markerOptions)
          .addTo(map)
          .bindPopup(popupContent, {
              maxWidth: 180, // Atur lebar maksimum popup
              className: 'custom-popup' // Tambahkan class untuk styling tambahan jika diperlukan
          });

      return marker;
  }
});

// Fungsi untuk pindah ke halaman form dengan ID lokasi
function goToForm(locationId) {
  window.location.href = `/register/${locationId}`;
}