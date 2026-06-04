<!-- ==================== FOOTER ==================== -->
<footer id="kontak">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-4">
        <div class="footer-brand"><span style="color:var(--accent)">●</span> DriveEase</div>
        <p class="footer-desc">Platform rental mobil modern yang mengutamakan kemudahan, keamanan, dan kenyamanan perjalanan Anda.</p>
        <div class="social-links">
          <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
          <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      <div class="col-md-4 col-lg-2">
        <div class="footer-heading">Navigasi</div>
        <ul class="footer-links">
          <li><a href="#">Home</a></li>
          <li><a href="#daftar-mobil">Daftar Mobil</a></li>
          <li><a href="#tentang">Tentang Kami</a></li>
          <li><a href="#kontak">Kontak</a></li>
        </ul>
      </div>
      <div class="col-md-4 col-lg-2">
        <div class="footer-heading">Layanan</div>
        <ul class="footer-links">
          <li><a href="#">Sewa Harian</a></li>
          <li><a href="#">Sewa Bulanan</a></li>
          <li><a href="#">Dengan Driver</a></li>
          <li><a href="#">Antar Jemput</a></li>
        </ul>
      </div>
      <div class="col-md-4 col-lg-4">
        <div class="footer-heading">Informasi Kontak</div>
        <div class="contact-item">
          <i class="fas fa-map-marker-alt contact-icon"></i>
          <span class="contact-text">Jl. Sudirman No. 88, Tangerang, Banten 15111</span>
        </div>
        <div class="contact-item">
          <i class="fas fa-phone contact-icon"></i>
          <span class="contact-text">+62 812-3456-7890</span>
        </div>
        <div class="contact-item">
          <i class="fas fa-envelope contact-icon"></i>
          <span class="contact-text">hello@driveease.co.id</span>
        </div>
        <div class="contact-item">
          <i class="fas fa-clock contact-icon"></i>
          <span class="contact-text">Senin – Minggu, 07.00 – 22.00 WIB</span>
        </div>
      </div>
    </div>
    <hr class="footer-divider"/>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <p class="footer-bottom mb-0">© 2025 DriveEase. Seluruh hak cipta dilindungi.</p>
      <p class="footer-bottom mb-0">Dibuat dengan <span style="color:var(--accent)">♥</span> di Indonesia</p>
    </div>
  </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>

  /* ===================== DATA DARI DATABASE ===================== */
  const carsData = <?= json_encode($mobil); ?>;
  console.log(carsData);

  /* ===================== BADGE TYPE ===================== */
  const typeBadgeMap = {
    "SUV"     : "badge-suv",
    "MPV"     : "badge-mpv",
    "SDN"     : "badge-sedan",
    "CITY"    : "badge-city",
    "PREMIUM" : "badge-premium",
    "TRUK"    : "badge-truck",
    "MINIBUS" : "badge-minibus"
  };

  /* ===================== FORMAT HARGA ===================== */
  function formatPrice(p)
  {
    return "Rp " + parseInt(p).toLocaleString("id-ID");
  }

  /* ===================== RENDER MOBIL ===================== */
  function renderCars(data)
  {
    const grid = document.getElementById("carsGrid");

    if (!data.length)
    {
      grid.innerHTML = `
        <div class="no-cars-msg">
          <i class="fas fa-car-burst" style="font-size:2rem;margin-bottom:12px;display:block;color:var(--clay)"></i>
          Tidak ada mobil yang sesuai filter.
        </div>
      `;
      return;
    }

    grid.innerHTML = data.map(c => `
      <div class="car-card"
           data-type="${c.kode_type}"
           data-status="${c.status}"
           data-price="${c.harga_perhari}"
           onclick="if(!event.target.closest('.btn-sewa')) lihatDetail(${c.id_mobil})"
           style="cursor:pointer;">

        <div class="car-img-wrap">
          <img src="<?= base_url('assets/upload/') ?>${c.gambar}" alt="${c.merk}" loading="lazy"/>
          <span class="car-type-badge ${typeBadgeMap[c.kode_type] || 'badge-dark'}">
            ${c.kode_type}
          </span>
          <span class="car-status ${c.status == 1 ? 'status-available' : 'status-rented'}">
            ${c.status == 1 ? 'Tersedia' : 'Tidak Tersedia'}
          </span>
        </div>

        <div class="car-body">
          <div class="car-name">${c.merk}</div>
          <div class="car-meta">${c.warna} · ${c.tahun}</div>

          <div class="car-specs">
            <div class="car-spec">
              <i class="fas fa-users"></i> ${c.kapasitas ? c.kapasitas + ' Kursi' : '-'}
            </div>
            <div class="car-spec">
              <i class="fas fa-cogs"></i> ${c.transmisi || '-'}
            </div>
            <div class="car-spec">
              <i class="fas fa-gas-pump"></i> ${c.bahan_bakar || '-'}
            </div>
          </div>

          <div class="car-footer">
            <div>
              <div class="car-price">
                ${formatPrice(c.harga_perhari)} <span>/ hari</span>
              </div>
            </div>
            <button class="btn-sewa" ${c.status == 0 ? 'disabled' : ''} onclick="sewaMobil(${c.id_mobil})">
              ${c.status == 1 ? 'Sewa Sekarang' : 'Tidak Tersedia'}
            </button>
          </div>
        </div>
      </div>
    `).join('');
  }

  /* ===================== PROSES SEWA ===================== */
  const isLogin = <?= $this->session->userdata('id_customer') ? 'true' : 'false' ?>;

  function sewaMobil(id){
    if(!isLogin){
        window.location.href = "<?= base_url('auth/login') ?>";
    }else{
        window.location.href = "<?= base_url('customer/rental/') ?>" + id;
    }
  }

  /* ===================== MODAL DETAIL ===================== */
  function lihatDetail(id) {
    document.getElementById('modalMobilTitle').innerText = 'Detail Mobil';
    document.getElementById('modalMobilBody').innerHTML = `
      <div class="text-center py-5">
        <div class="spinner-border" style="color:var(--accent)"></div>
      </div>
    `;

    const modal = new bootstrap.Modal(document.getElementById('modalDetailMobil'));
    modal.show();

    fetch(`<?= base_url('customer/mobil/detail/') ?>` + id)
      .then(res => res.json())
      .then(m => {
        document.getElementById('modalMobilTitle').innerText = m.merk;
        const hargaFormat = parseInt(m.harga_perhari).toLocaleString('id-ID');
        const statusAvail = m.status == 1;

        document.getElementById('modalMobilBody').innerHTML = `
          <div class="row g-4">
            <div class="col-md-5 text-center">
              <img src="<?= base_url('assets/upload/') ?>${m.gambar}"
                   class="img-fluid w-100"
                   style="border-radius:14px; max-height:260px; object-fit:cover;">
              <div class="d-flex gap-2 justify-content-center mt-3 flex-wrap">
                <span style="background:var(--linen); color:var(--clay); padding:5px 14px; border-radius:20px; font-size:.8rem; font-weight:600;">
                  ${m.kode_type}
                </span>
                <span style="background:${statusAvail ? '#e8f5e9' : '#fbe9e7'}; color:${statusAvail ? '#388e3c' : '#d84315'}; padding:5px 14px; border-radius:20px; font-size:.8rem; font-weight:600;">
                  ${statusAvail ? 'Tersedia' : 'Tidak Tersedia'}
                </span>
              </div>
            </div>

            <div class="col-md-7">
              <p class="text-muted mb-3" style="font-size:.9rem;">${m.warna} · ${m.tahun}</p>

              <div class="row g-3 mb-3">
                <div class="col-6">
                  <small class="text-muted d-block mb-1">Plat Nomor</small>
                  <span style="background:var(--linen); color:#555; padding:5px 12px; border-radius:8px; font-size:.85rem; font-weight:600;">
                    ${m.no_plat}
                  </span>
                </div>
                <div class="col-6">
                  <small class="text-muted d-block mb-1">Tipe</small>
                  <strong>${m.nama_type ?? m.kode_type}</strong>
                </div>
                <div class="col-6">
                  <small class="text-muted d-block mb-1">Kapasitas</small>
                  <strong>${m.kapasitas ? m.kapasitas + ' Penumpang' : '-'}</strong>
                </div>
                <div class="col-6">
                  <small class="text-muted d-block mb-1">Transmisi</small>
                  <strong>${m.transmisi ?? '-'}</strong>
                </div>
                <div class="col-6">
                  <small class="text-muted d-block mb-1">Bahan Bakar</small>
                  <strong>${m.bahan_bakar ?? '-'}</strong>
                </div>
              </div>

              ${m.deskripsi ? `
              <div class="mb-3">
                <small class="text-muted d-block mb-1">Deskripsi</small>
                <p style="font-size:.88rem; color:#555; margin:0;">${m.deskripsi}</p>
              </div>` : ''}

              <hr>

              <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                  <small class="text-muted">Harga per hari</small>
                  <div style="font-size:1.5rem; font-weight:700; color:var(--accent);">
                    Rp ${hargaFormat}
                  </div>
                </div>
                ${statusAvail
                  ? `<button class="btn-sewa" onclick="sewaMobil(${m.id_mobil})">Sewa Sekarang</button>`
                  : `<button class="btn-sewa" disabled>Tidak Tersedia</button>`
                }
              </div>
            </div>
          </div>
        `;
      })
      .catch(() => {
        document.getElementById('modalMobilBody').innerHTML = `
          <p class="text-danger text-center py-4">Gagal memuat data mobil.</p>
        `;
      });
  }

  /* ===================== FILTER ===================== */
  function filterCars()
  {
    const tipe   = document.getElementById("filterTipe").value;
    const status = document.getElementById("filterStatus").value;
    const harga  = document.getElementById("filterHarga").value;

    const filtered = carsData.filter(c => {
      const matchTipe = !tipe || String(c.kode_type).trim().toLowerCase() == String(tipe).trim().toLowerCase();
      const matchStatus = !status || String(c.status) == String(status);
      
      /* Menggunakan kriteria harga_perhari */
      let matchHarga = true;
      if (harga === "low") {
        matchHarga = parseInt(c.harga_perhari) <= 500000;
      } else if (harga === "mid") {
        matchHarga = parseInt(c.harga_perhari) > 500000 && parseInt(c.harga_perhari) <= 1000000;
      } else if (harga === "high") {
        matchHarga = parseInt(c.harga_perhari) > 1000000;
      }

      return matchTipe && matchStatus && matchHarga;
    });

    renderCars(filtered);
    renderChips(tipe, status, harga);
  }

  /* ===================== CHIP FILTER ===================== */
  function renderChips(tipe, status, harga)
  {
    const wrap = document.getElementById("activeFilters");
    wrap.innerHTML = '';

    const labelMap = {
      low  : "<= Rp 500K",
      mid  : "Rp 500K - 1M",
      high : "> Rp 1M"
    };

    if (tipe) {
      wrap.innerHTML += `<span class="filter-chip">${tipe} <i class="fas fa-xmark" onclick="clearFilter('filterTipe')"></i></span>`;
    }

    if (status) {
      wrap.innerHTML += `<span class="filter-chip">${status == 1 ? 'Tersedia' : 'Tidak Tersedia'} <i class="fas fa-xmark" onclick="clearFilter('filterStatus')"></i></span>`;
    }

    if (harga) {
      wrap.innerHTML += `<span class="filter-chip">${labelMap[harga]} <i class="fas fa-xmark" onclick="clearFilter('filterHarga')"></i></span>`;
    }
  }

  /* ===================== CLEAR FILTER ===================== */
  function clearFilter(id)
  {
    document.getElementById(id).value = '';
    filterCars();
  }

  /* ===================== RESET FILTER ===================== */
  function resetFilter()
  {
    document.getElementById("filterTipe").value = '';
    document.getElementById("filterStatus").value = '';
    document.getElementById("filterHarga").value = '';
    filterCars();
  }

  /* ===================== NAVBAR SCROLL ===================== */
  window.addEventListener("scroll", () => {
    const mainNav = document.getElementById("mainNav");
    if(mainNav) mainNav.classList.toggle("scrolled", window.scrollY > 30);
  });

  /* ===================== DATE DEFAULTS ===================== */
  (function setDates() {
    const inputs = document.querySelectorAll('input[type=date]');
    const today  = new Date();
    const fmt = d => d.toISOString().split('T')[0];
    const tmr  = new Date(today); tmr.setDate(today.getDate() + 1);
    const ntmr = new Date(today); ntmr.setDate(today.getDate() + 3);
    if (inputs[0]) inputs[0].value = fmt(tmr);
    if (inputs[1]) inputs[1].value = fmt(ntmr);
  })();

  /* ===================== INITIAL LOAD ===================== */
  renderCars(carsData);

</script>
</body>
</html>