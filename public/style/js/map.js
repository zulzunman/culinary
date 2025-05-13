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

  // Log untuk debugging
  console.log("Memulai pengambilan data lokasi");

  // Tambahkan CSS untuk slider
  const styleElement = document.createElement('style');
  styleElement.textContent = `
    .location-card {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      background: white;
    }

    .slider-container {
  position: relative;
  overflow: hidden;
  border-radius: 8px 8px 0 0;
  height: 200px; /* Ditingkatkan dari 150px */
  width: 100%;
}

.slides {
  display: flex;
  transition: transform 0.4s ease;
  height: 100%;
}

.slide {
  min-width: 100%;
  position: relative;
  height: 100%;
}

.slide img {
  width: 100%;
  height: 100%;
  object-fit: contain; /* Diubah dari cover ke contain */
  background-color: #f8f9fa; /* Warna latar untuk gambar */
}


.caption {
  position: absolute;
  top: 0; /* Diubah dari bottom: 0 */
  left: 0;
  right: 0;
  background: rgba(0,0,0,0.5);
  color: white;
  padding: 4px 8px;
  font-size: 12px;
  text-align: center;
}

    .nav-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0,0,0,0.4);
      color: white;
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 1;
      transition: background 0.3s;
    }

    .nav-button:hover {
      background: rgba(0,0,0,0.7);
    }

    .prev {
      left: 8px;
    }

    .next {
      right: 8px;
    }

    .dots {
      position: absolute;
      bottom: 10px;
      left: 0;
      right: 0;
      display: flex;
      justify-content: center;
      gap: 5px;
    }

    .dot {
      width: 8px;
      height: 8px;
      background-color: rgba(255,255,255,0.5);
      border-radius: 50%;
      cursor: pointer;
      transition: background 0.3s;
    }

    .dot.active {
      background-color: white;
    }

    .card-content {
      padding: 12px;
    }

    .store-name {
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 8px;
      text-align: center;
      color: #333;
    }

    .card-detail {
      font-size: 13px;
      color: #666;
      margin-bottom: 10px;
      line-height: 1.4;
    }

    .status-badge {
      padding: 6px 10px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: bold;
      text-align: center;
      margin-top: 8px;
    }

    .status-occupied {
      background-color: #dc3545;
      color: white;
    }

    .book-btn {
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 8px;
      width: 100%;
      cursor: pointer;
      font-weight: bold;
      font-size: 13px;
      transition: background 0.3s;
    }

    .book-btn:hover {
      background-color: #0069d9;
    }

    .image-placeholder {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100px;
      background-color: #f8f9fa;
      color: #6c757d;
      font-size: 14px;
    }
  `;
  document.head.appendChild(styleElement);

  // Ambil data lokasi dari API Laravel
  fetch('/locations')
    .then(response => {
      console.log("Response status:", response.status);
      return response.json();
    })
    .then(data => {
      console.log("Data lokasi:", data);

      if (data.length === 0) {
        map.setView([-6.9175, 107.6191], 19);
        return;
      }

      data.forEach(loc => {
        console.log("Processing location:", loc.code, "Menu photo:", loc.image, "Booth photo:", loc.booth_photo);
        let marker = createMarker(
          loc.latitude,
          loc.longitude,
          loc.is_used,
          loc.code,
          loc.detail,
          loc.id,
          loc.store_name,
          loc.image,
          loc.booth_photo
        );
        markers.push(marker);
        bounds.push([loc.latitude, loc.longitude]);
      });

      if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [20, 20], maxZoom: 19 });
      }
    })
    .catch(error => console.error('Error fetching locations:', error));

  // Fungsi untuk membuat marker
  function createMarker(lat, lng, isUsed, code, detail, id, storeName, menuPhoto, boothPhoto) {
    let markerOptions = {
      icon: isUsed ? redIcon : greenIcon
    };

    // Buat konten popup
    let popupContent = '';

    if (isUsed) {
      // Debug photos
      console.log("Creating marker with menu photo:", menuPhoto, "and booth photo:", boothPhoto);

      // Pastikan path foto lengkap
      let menuPhotoPath = menuPhoto ? (menuPhoto.startsWith('http') || menuPhoto.startsWith('/') ? menuPhoto : '/' + menuPhoto) : null;
      let boothPhotoPath = boothPhoto ? (boothPhoto.startsWith('http') || boothPhoto.startsWith('/') ? boothPhoto : '/' + boothPhoto) : null;

      console.log("Final menu photo path:", menuPhotoPath);
      console.log("Final booth photo path:", boothPhotoPath);

      // Buat slideshow jika ada foto
      let slideshowHtml = '';
      let hasImages = (menuPhotoPath || boothPhotoPath);

      if (hasImages) {
        let totalSlides = (menuPhotoPath ? 1 : 0) + (boothPhotoPath ? 1 : 0);

        slideshowHtml = `
          <div class="slider-container">
            <div class="slides" id="slides-${id}">`;

        // Tambahkan foto menu ke slideshow jika tersedia
        if (menuPhotoPath) {
          slideshowHtml += `
              <div class="slide">
                <img src="${menuPhotoPath}" alt="Menu ${storeName || ''}">
                <div class="caption">Menu</div>
              </div>`;
        }

        // Tambahkan foto booth ke slideshow jika tersedia
        if (boothPhotoPath) {
          slideshowHtml += `
              <div class="slide">
                <img src="${boothPhotoPath}" alt="Booth ${storeName || ''}">
                <div class="caption">Booth</div>
              </div>`;
        }

        slideshowHtml += `
            </div>`;

        // Tambahkan navigasi jika ada lebih dari 1 gambar
        if (totalSlides > 1) {
          slideshowHtml += `
            <button class="nav-button prev" onclick="moveSlide('slides-${id}', -1)">&lt;</button>
            <button class="nav-button next" onclick="moveSlide('slides-${id}', 1)">&gt;</button>
            <div class="dots">`;

          for (let i = 0; i < totalSlides; i++) {
            slideshowHtml += `
              <span class="dot ${i === 0 ? 'active' : ''}" onclick="currentSlide('slides-${id}', ${i})"></span>`;
          }

          slideshowHtml += `
            </div>`;
        }

        slideshowHtml += `
          </div>`;
      } else {
        // Jika tidak ada foto, tampilkan placeholder
        slideshowHtml = `
          <div class="image-placeholder">
            Tidak ada foto tersedia
          </div>`;
      }

      popupContent = `
        <div class="location-card">
          ${slideshowHtml}
          <div class="card-content">
            ${storeName ? `<div class="store-name">${storeName}</div>` : ''}
            <div class="card-detail">${detail}</div>
            <div class="status-badge status-occupied">Lokasi Sudah DiTempati</div>
          </div>
        </div>`;
    } else {
      // Jika lokasi kosong
      popupContent = `
        <div class="location-card">
          <div class="card-content">
            <div class="store-name">${code}</div>
            <div class="card-detail">${detail}</div>
            <button onclick="goToForm(${id})" class="book-btn">Booking Sekarang</button>
          </div>
        </div>`;
    }

    let marker = L.marker([lat, lng], markerOptions)
      .addTo(map)
      .bindPopup(popupContent, {
        maxWidth: 280,
        minWidth: 250,
        maxHeight: 350,
        className: 'custom-popup'
      });

    return marker;
  }
});

// Fungsi untuk pindah ke halaman form dengan ID lokasi
function goToForm(locationId) {
  window.location.href = `/register/${locationId}`;
}

// Fungsi untuk menggerakkan slide
function moveSlide(slidesId, direction) {
  const slidesContainer = document.getElementById(slidesId);
  const slides = slidesContainer.querySelectorAll('.slide');
  const dotsContainer = slidesContainer.parentElement.querySelector('.dots');
  const dots = dotsContainer ? dotsContainer.querySelectorAll('.dot') : [];

  // Dapatkan slide aktif saat ini
  let activeIndex = 0;
  if (dots.length > 0) {
    for (let i = 0; i < dots.length; i++) {
      if (dots[i].classList.contains('active')) {
        activeIndex = i;
        break;
      }
    }
  }

  // Hitung index slide baru
  let newIndex = activeIndex + direction;
  if (newIndex < 0) newIndex = slides.length - 1;
  if (newIndex >= slides.length) newIndex = 0;

  // Perbarui posisi slide
  slidesContainer.style.transform = `translateX(-${newIndex * 100}%)`;

  // Perbarui dots
  if (dots.length > 0) {
    dots.forEach(dot => dot.classList.remove('active'));
    dots[newIndex].classList.add('active');
  }
}

// Fungsi untuk pergi ke slide tertentu
function currentSlide(slidesId, index) {
  const slidesContainer = document.getElementById(slidesId);
  const dotsContainer = slidesContainer.parentElement.querySelector('.dots');
  const dots = dotsContainer.querySelectorAll('.dot');

  // Perbarui posisi slide
  slidesContainer.style.transform = `translateX(-${index * 100}%)`;

  // Perbarui dots
  dots.forEach(dot => dot.classList.remove('active'));
  dots[index].classList.add('active');
}