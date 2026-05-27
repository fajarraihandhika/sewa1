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
<script>

  /* ===================== DATA DARI DATABASE ===================== */
  const carsData = <?= json_encode($mobil); ?>;

  console.log(carsData);

  /* ===================== BADGE TYPE ===================== */
  const typeBadgeMap = {
   "SUV"      : "badge-suv",
        "MPV"      : "badge-mpv",
        "SDN"      : "badge-sedan",
        "CITY"     : "badge-city",
        "PREMIUM"  : "badge-premium",
        "TRUK"     : "badge-truck",
        "MINIBUS"  : "badge-minibus"
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
      
        <i class="fas fa-car-burst"
           style="font-size:2rem;margin-bottom:12px;display:block;color:var(--clay)">
        </i>

        Tidak ada mobil yang sesuai filter.

      </div>
      
      `;

      return;
    }

    grid.innerHTML = data.map(c => `

      <div class="car-card"
           data-type="${c.kode_type}"
           data-status="${c.status}"
           data-price="${c.harga}">

        <div class="car-img-wrap">

          <img src="<?= base_url('assets/upload/') ?>${c.gambar}"
               alt="${c.merk}"
               loading="lazy"/>

          <span class="car-type-badge ${typeBadgeMap[c.kode_type]}">

            ${c.kode_type}

          </span>

          <span class="car-status
            ${c.status == 1 ? 'status-available' : 'status-rented'}">

            ${c.status == 1 ? 'Tersedia' : 'Tidak Tersedia'}

          </span>

        </div>

        <div class="car-body">

          <div class="car-name">

            ${c.merk}

          </div>

          <div class="car-meta">

            ${c.warna} · ${c.tahun}

          </div>

          <div class="car-specs">

            <div class="car-spec">

              <i class="fas fa-id-card"></i>

              ${c.no_plat}

            </div>

            <div class="car-spec">

              <i class="fas fa-car"></i>

              ${c.kode_type}

            </div>

          </div>

          <div class="car-footer">

            <div>

              <div class="car-price">

                ${formatPrice(c.harga)}

                <span>/ hari</span>

              </div>

            </div>

            <button 
    class="btn-sewa"
    ${c.status == 0 ? 'disabled' : ''}
    onclick="sewaMobil(${c.id_mobil})"
>

${c.status == 1
    ? 'Sewa Sekarang'
    : 'Tidak Tersedia'}

</button>

          </div>

        </div>

      </div>

    `).join('');
  }

  const isLogin = <?= $this->session->userdata('id_customer') ? 'true' : 'false' ?>;

function sewaMobil(id){
    
    if(!isLogin){

        window.location.href = "<?= base_url('auth/login') ?>";

    }else{

        window.location.href = "<?= base_url('customer/rental/') ?>" + id;

    }
}

  /* ===================== FILTER ===================== */
  function filterCars()
  {
    const tipe   = document.getElementById("filterTipe").value;
    const status = document.getElementById("filterStatus").value;
    const harga  = document.getElementById("filterHarga").value;

    const filtered = carsData.filter(c => {

      /* FILTER TYPE */
      const matchTipe =
        !tipe ||
        String(c.kode_type).trim().toLowerCase() ==
        String(tipe).trim().toLowerCase();

    const matchStatus =
        !status ||
        String(c.status) == String(status);
      /* FILTER HARGA */
      let matchHarga = true;

      if (harga === "low")
{
    matchHarga = parseInt(c.harga) <= 500000;
}

else if (harga === "mid")
{
    matchHarga =
        parseInt(c.harga) > 500000 &&
        parseInt(c.harga) <= 1000000;
}

else if (harga === "high")
{
    matchHarga = parseInt(c.harga) > 1000000;
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
      low  : "< Rp 400K",
      mid  : "Rp 400K - 700K",
      high : "> Rp 700K"
    };

    if (tipe)
    {
      wrap.innerHTML += `
      
      <span class="filter-chip">

        ${tipe}

        <i class="fas fa-xmark"
           onclick="clearFilter('filterTipe')">
        </i>

      </span>
      
      `;
    }

    if (status)
    {
      wrap.innerHTML += `
      
      <span class="filter-chip">

        ${status == 1 ? 'Tersedia' : 'Tidak Tersedia'}

        <i class="fas fa-xmark"
           onclick="clearFilter('filterStatus')">
        </i>

      </span>
      
      `;
    }

    if (harga)
    {
      wrap.innerHTML += `
      
      <span class="filter-chip">

        ${labelMap[harga]}

        <i class="fas fa-xmark"
           onclick="clearFilter('filterHarga')">
        </i>

      </span>
      
      `;
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

  /* ===================== LOAD AWAL ===================== */
  renderCars(carsData);
  



  /* ===================== NAVBAR SCROLL ===================== */
  window.addEventListener("scroll", () => {
    document.getElementById("mainNav").classList.toggle("scrolled", window.scrollY > 30);
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

  /* ===================== INIT ===================== */
  renderCars(carsData);

  // const carsData = [
  //   { id:1, name:"Toyota Fortuner",  type:"SUV",      price:750000, status:"Tersedia", seats:7, fuel:"Diesel",   img:"https://placehold.co/400x220/EDE4D8/8B6A50?text=Fortuner" },
  //   { id:2, name:"Honda CR-V",       type:"SUV",      price:680000, status:"Tersedia", seats:5, fuel:"Bensin",   img:"https://placehold.co/400x220/E8DDD0/8B6A50?text=CR-V" },
  //   { id:3, name:"Toyota Innova",    type:"MPV",      price:450000, status:"Disewa",   seats:7, fuel:"Diesel",   img:"https://placehold.co/400x220/F5EFE6/8B6A50?text=Innova" },
  //   { id:4, name:"Mitsubishi Xpander",type:"MPV",    price:420000, status:"Tersedia", seats:7, fuel:"Bensin",   img:"https://placehold.co/400x220/EDE4D8/8B6A50?text=Xpander" },
  // ];

  // const typeBadgeMap = { "SUV":"badge-suv","MPV":"badge-mpv","Sedan":"badge-sedan","City Car":"badge-city" };

  // function formatPrice(p) { return "Rp " + p.toLocaleString("id-ID"); }

  // function renderCars(data) {
  //   const grid = document.getElementById("carsGrid");
  //   if (!data.length) {
  //     grid.innerHTML = `<div class="no-cars-msg"><i class="fas fa-car-burst" style="font-size:2rem;margin-bottom:12px;display:block;color:var(--clay)"></i>Tidak ada mobil yang sesuai filter.</div>`;
  //     return;
  //   }
  //   grid.innerHTML = data.map(c => `
  //     <div class="car-card" data-type="${c.type}" data-status="${c.status}" data-price="${c.price}">
  //       <div class="car-img-wrap">
  //         <img src="${c.img}" alt="${c.name}" loading="lazy"/>
  //         <span class="car-type-badge ${typeBadgeMap[c.type]}">${c.type}</span>
  //         <span class="car-status ${c.status==='Tersedia'?'status-available':'status-rented'}">${c.status}</span>
  //       </div>
  //       <div class="car-body">
  //         <div class="car-name">${c.name}</div>
  //         <div class="car-meta">${c.fuel} · ${c.seats} kursi</div>
  //         <div class="car-specs">
  //           <div class="car-spec"><i class="fas fa-users"></i>${c.seats} Orang</div>
  //           <div class="car-spec"><i class="fas fa-gas-pump"></i>${c.fuel}</div>
  //           <div class="car-spec"><i class="fas fa-snowflake"></i>AC</div>
  //         </div>
  //         <div class="car-footer">
  //           <div>
  //             <div class="car-price">${formatPrice(c.price)} <span>/ hari</span></div>
  //           </div>
  //           <button class="btn-sewa" ${c.status==='Disewa'?'disabled':''}>
  //             ${c.status==='Disewa'?'Tidak Tersedia':'Sewa Sekarang'}
  //           </button>
  //         </div>
  //       </div>
  //     </div>
  //   `).join('');
  // }

  // function filterCars() {
  //   const tipe   = document.getElementById("filterTipe").value;
  //   const status = document.getElementById("filterStatus").value;
  //   const harga  = document.getElementById("filterHarga").value;

  //   const filtered = carsData.filter(c => {
  //     const matchTipe   = !tipe   || c.type === tipe;
  //     const matchStatus = !status || c.status === status;
  //     let matchHarga = true;
  //     if      (harga === "low")  matchHarga = c.price < 400000;
  //     else if (harga === "mid")  matchHarga = c.price >= 400000 && c.price <= 700000;
  //     else if (harga === "high") matchHarga = c.price > 700000;
  //     return matchTipe && matchStatus && matchHarga;
  //   });

  //   renderCars(filtered);
  //   renderChips(tipe, status, harga);
  // }

  // function renderChips(tipe, status, harga) {
  //   const wrap = document.getElementById("activeFilters");
  //   wrap.innerHTML = '';
  //   const labelMap = { low:"< Rp 400K", mid:"Rp 400K–700K", high:"> Rp 700K" };
  //   if (tipe)   wrap.innerHTML += `<span class="filter-chip">${tipe} <i class="fas fa-xmark" onclick="clearFilter('filterTipe')"></i></span>`;
  //   if (status) wrap.innerHTML += `<span class="filter-chip">${status} <i class="fas fa-xmark" onclick="clearFilter('filterStatus')"></i></span>`;
  //   if (harga)  wrap.innerHTML += `<span class="filter-chip">${labelMap[harga]} <i class="fas fa-xmark" onclick="clearFilter('filterHarga')"></i></span>`;
  // }

  // function clearFilter(id) {
  //   document.getElementById(id).value = '';
  //   filterCars();
  // }

  // function resetFilter() {
  //   ["filterTipe","filterStatus","filterHarga"].forEach(id => document.getElementById(id).value = '');
  //   filterCars();
  // }
</script>
</body>
</html>