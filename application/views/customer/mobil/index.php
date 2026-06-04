<style>
  .mobil-wrap { padding: 40px 0 60px; }

  /* Filter */
  .filter-dash {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 16px 22px;
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card);
    display: flex; align-items: center; flex-wrap: wrap; gap: 12px;
    margin-bottom: 32px;
  }
  .filter-dash select {
    border: 1.5px solid var(--clay);
    border-radius: var(--radius-sm);
    padding: 8px 14px;
    font-size: 0.85rem; color: var(--text-dark);
    background: var(--sand); cursor: pointer;
    transition: border-color 0.2s; font-family: var(--font-body);
  }
  .filter-dash select:focus { outline: none; border-color: var(--accent); }
  .btn-reset-dash {
    font-size: 0.82rem; font-weight: 500;
    color: var(--text-soft); background: transparent;
    border: 1.5px solid var(--clay); border-radius: 50px;
    padding: 7px 18px; cursor: pointer; transition: all 0.2s;
  }
  .btn-reset-dash:hover { color: var(--accent); border-color: var(--accent); }

  /* Grid */
  .mobil-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(268px, 1fr)); gap: 22px; }
  .mobil-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    border: 1.5px solid rgba(200,180,160,0.12);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
  }
  .mobil-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(100,80,60,0.16); }
  .mobil-img-wrap {
    position: relative; height: 180px;
    background: linear-gradient(135deg, var(--sand), var(--clay));
    display: flex; align-items: center; justify-content: center; overflow: hidden;
  }
  .mobil-img-wrap img { width: 82%; object-fit: contain; transition: transform 0.4s; }
  .mobil-card:hover .mobil-img-wrap img { transform: scale(1.05); }
  .mobil-badge-type {
    position: absolute; top: 12px; left: 12px;
    font-size: 0.68rem; font-weight: 600; letter-spacing: .06em;
    padding: 3px 11px; border-radius: 50px; text-transform: uppercase;
  }
  .mobil-badge-status {
    position: absolute; top: 12px; right: 12px;
    font-size: 0.68rem; font-weight: 600;
    padding: 3px 11px; border-radius: 50px;
  }
  .badge-suv    { background:rgba(185,212,232,.7); color:#4A7FA0; }
  .badge-mpv    { background:rgba(200,216,195,.7); color:#4A7A65; }
  .badge-sedan  { background:rgba(218,211,238,.7); color:#6A5FA0; }
  .badge-city   { background:rgba(250,218,221,.7); color:#A05A65; }
  .badge-premium{ background:rgba(250,213,181,.7); color:#A06020; }
  .badge-truck  { background:rgba(200,200,200,.7); color:#505050; }
  .badge-minibus{ background:rgba(200,230,200,.7); color:#3A6A3A; }
  .s-available  { background:rgba(122,200,140,.2); color:#3A8A50; }
  .s-rented     { background:rgba(220,140,100,.2); color:#B05030; }

  .mobil-body { padding: 18px 20px; }
  .mobil-name { font-family:var(--font-display); font-size:1.1rem; font-weight:700; color:var(--text-dark); margin-bottom:3px; }
  .mobil-meta { font-size:.78rem; color:var(--text-soft); margin-bottom:12px; }
  .mobil-specs { display:flex; gap:8px; margin-bottom:14px; flex-wrap:wrap; }
  .mobil-spec {
    display:flex; align-items:center; gap:4px;
    font-size:.75rem; color:var(--text-mid);
    background:var(--sand); border-radius:6px; padding:3px 9px;
  }
  .mobil-spec i { font-size:.7rem; color:var(--text-soft); }
  .mobil-footer { display:flex; align-items:center; justify-content:space-between; }
  .mobil-price { font-family:var(--font-display); font-size:1.2rem; font-weight:700; color:var(--accent); }
  .mobil-price span { font-family:var(--font-body); font-size:.72rem; font-weight:400; color:var(--text-soft); }
  .btn-pesan {
    background: var(--accent); color: var(--white);
    border: none; border-radius: 50px;
    padding: 8px 18px; font-size:.8rem; font-weight:600;
    cursor: pointer; transition: all 0.25s;
  }
  .btn-pesan:hover { background:#C07358; box-shadow:0 4px 14px rgba(212,134,106,.4); }
  .btn-pesan:disabled { background:var(--clay); color:var(--text-soft); cursor:not-allowed; }

  /* Empty */
  .empty-grid { grid-column:1/-1; text-align:center; padding:60px 20px; color:var(--text-soft); }
  .empty-grid i { font-size:2.2rem; color:var(--clay); margin-bottom:12px; display:block; }

  /* ===== MODAL PESAN ===== */
  .modal-pesan .modal-content { border-radius:20px; border:none; }
  .modal-pesan .modal-header  { border:none; padding:24px 28px 0; }
  .modal-pesan .modal-body    { padding:20px 28px 28px; }
  .modal-pesan .modal-title   { font-family:var(--font-display); font-weight:700; }

  .pesan-mobil-info {
    background: var(--sand);
    border-radius: var(--radius-lg);
    padding: 16px;
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 24px;
    border: 1px solid var(--clay);
  }
  .pesan-mobil-img {
    width: 90px; height: 64px; object-fit: contain;
    background: var(--white); border-radius: var(--radius-md);
    padding: 6px; flex-shrink: 0;
  }
  .pesan-mobil-name { font-family:var(--font-display); font-size:1rem; font-weight:700; color:var(--text-dark); }
  .pesan-mobil-meta { font-size:.8rem; color:var(--text-soft); }

  .form-pesan-label {
    font-size:.74rem; font-weight:600; text-transform:uppercase;
    letter-spacing:.06em; color:var(--text-soft); margin-bottom:6px; display:block;
  }
  .form-pesan-input {
    width:100%; border:1.5px solid var(--clay);
    border-radius:var(--radius-md); padding:10px 14px;
    font-size:.9rem; color:var(--text-dark);
    background:var(--sand); font-family:var(--font-body);
    transition:all 0.2s;
  }
  .form-pesan-input:focus {
    outline:none; border-color:var(--accent);
    background:var(--white); box-shadow:0 0 0 3px rgba(212,134,106,.1);
  }

  /* Durasi option cards */
  .durasi-cards { display:grid; grid-template-columns:repeat(4,1fr); gap:8px; margin-top:6px; }
  .durasi-card {
    border:1.5px solid var(--clay);
    border-radius:var(--radius-md);
    padding:10px 8px;
    cursor:pointer; transition:all 0.2s;
    text-align:center;
    background:var(--sand);
  }
  .durasi-card.selected { border-color:var(--accent); background:rgba(212,134,106,.08); }
  .durasi-card input[type=radio] { display:none; }
  .durasi-card-label { font-size:.8rem; font-weight:600; color:var(--text-dark); }
  .durasi-card-harga { font-size:.68rem; color:var(--accent); margin-top:3px; }

  .total-box {
    background: linear-gradient(135deg, rgba(212,134,106,.1), rgba(212,134,106,.05));
    border: 1.5px solid rgba(212,134,106,.2);
    border-radius: var(--radius-lg);
    padding: 16px 20px;
    margin-top: 20px;
    display: flex; align-items: center; justify-content: space-between;
  }
  .total-label { font-size:.82rem; color:var(--text-mid); }
  .total-harga { font-family:var(--font-display); font-size:1.4rem; font-weight:700; color:var(--accent); }
  .total-durasi { font-size:.76rem; color:var(--text-soft); margin-top:2px; }

  .btn-submit-pesan {
    width:100%; background:var(--accent); color:var(--white);
    border:none; border-radius:50px;
    padding:14px; font-size:.95rem; font-weight:600;
    cursor:pointer; margin-top:18px;
    transition:all 0.25s; display:flex; align-items:center; justify-content:center; gap:8px;
  }
  .btn-submit-pesan:hover { background:#C07358; box-shadow:0 6px 20px rgba(212,134,106,.35); }
  .btn-submit-pesan:disabled { background:var(--clay); color:var(--text-soft); cursor:not-allowed; }

  /* Supir card */
  .supir-cards { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-top:6px; }
  .supir-card {
    border:1.5px solid var(--clay);
    border-radius:var(--radius-md);
    padding:12px;
    cursor:pointer; transition:all 0.2s;
    display:flex; align-items:center; gap:10px;
    background:var(--sand);
  }
  .supir-card.selected { border-color:var(--accent); background:rgba(212,134,106,.08); }
  .supir-card input[type=radio] { display:none; }
  .supir-avatar {
    width:40px; height:40px; border-radius:50%; overflow:hidden;
    background:var(--clay); display:flex; align-items:center; justify-content:center;
    font-weight:700; color:var(--accent); font-family:var(--font-display);
    flex-shrink:0;
  }
  .supir-avatar img { width:100%; height:100%; object-fit:cover; }
  .supir-name { font-size:.82rem; font-weight:600; color:var(--text-dark); }
  .supir-info { font-size:.72rem; color:var(--text-soft); }

  /* Info box supir random */
  .supir-random-info {
    display:flex; align-items:center; gap:10px;
    background:rgba(122,158,142,.08);
    border:1px solid rgba(122,158,142,.2);
    border-radius:var(--radius-md);
    padding:12px 14px;
    font-size:.82rem; color:var(--text-mid);
  }
  .supir-random-info i { color:var(--accent2); font-size:1rem; flex-shrink:0; }
</style>

<div class="mobil-wrap">
  <div class="container">

    <!-- Title -->
    <div class="mb-4">
      <span style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:var(--accent);">Armada Kami</span>
      <h2 style="font-family:var(--font-display);font-size:1.6rem;font-weight:700;margin:0;">Pilih <i style="color:var(--accent)">Mobil</i></h2>
    </div>

    <!-- Filter -->
    <div class="filter-dash">
      <span style="font-size:.82rem;font-weight:600;color:var(--text-mid);"><i class="fas fa-sliders me-2"></i>Filter:</span>
      <select id="fTipe" onchange="filterMobil()">
        <option value="">Semua Tipe</option>
        <?php foreach($type as $t): ?>
          <option value="<?= $t->kode_type ?>"><?= $t->kode_type ?></option>
        <?php endforeach; ?>
      </select>
      <select id="fStatus" onchange="filterMobil()">
        <option value="">Semua Status</option>
        <option value="1">Tersedia</option>
        <option value="0">Tidak Tersedia</option>
      </select>
      <select id="fHarga" onchange="filterMobil()">
        <option value="">Semua Harga</option>
        <option value="low">≤ Rp 500.000</option>
        <option value="mid">Rp 500K – 1 Juta</option>
        <option value="high">> Rp 1.000.000</option>
      </select>
      <button class="btn-reset-dash" onclick="resetFilter()"><i class="fas fa-rotate-left me-1"></i>Reset</button>
    </div>

    <!-- Grid -->
    <div class="mobil-grid" id="mobilGrid"></div>

  </div>
</div>

<!-- ===== MODAL PESAN ===== -->
<div class="modal fade modal-pesan" id="modalPesan" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Pemesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="modalPesanBody">
        <div class="text-center py-4">
          <div class="spinner-border" style="color:var(--accent);"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
const carsData        = <?= json_encode($mobil) ?>;
const isPelangganLama = <?= $is_pelanggan_lama ? 'true' : 'false' ?>;
const baseUrl         = '<?= base_url() ?>';
const uploadUrl       = '<?= base_url("assets/upload/") ?>';

// Simpan data mobil & supir yang sedang di-render di modal
let _currentMobil = null;
let _currentSupir = [];

const typeBadgeMap = {
  SUV:'badge-suv', MPV:'badge-mpv', SDN:'badge-sedan',
  CITY:'badge-city', PREMIUM:'badge-premium', TRUK:'badge-truck', MINIBUS:'badge-minibus'
};

function formatRp(n) {
  return 'Rp ' + parseInt(n).toLocaleString('id-ID');
}

/* ===== RENDER GRID ===== */
function renderMobil(data) {
  const grid = document.getElementById('mobilGrid');
  if (!data.length) {
    grid.innerHTML = `<div class="empty-grid"><i class="fas fa-car-burst"></i><p>Tidak ada mobil yang sesuai filter.</p></div>`;
    return;
  }
  grid.innerHTML = data.map(c => `
    <div class="mobil-card" onclick="bukaPesan(${c.id_mobil})">
      <div class="mobil-img-wrap">
        <img src="${uploadUrl}${c.gambar}" alt="${c.merk}" loading="lazy"/>
        <span class="mobil-badge-type ${typeBadgeMap[c.kode_type] || ''}">${c.kode_type}</span>
        <span class="mobil-badge-status ${c.status == 1 ? 's-available' : 's-rented'}">
          ${c.status == 1 ? 'Tersedia' : 'Tidak Tersedia'}
        </span>
      </div>
      <div class="mobil-body">
        <div class="mobil-name">${c.merk}</div>
        <div class="mobil-meta">${c.warna} · ${c.tahun}</div>
        <div class="mobil-specs">
          <div class="mobil-spec"><i class="fas fa-id-card"></i>${c.no_plat}</div>
          <div class="mobil-spec"><i class="fas fa-car"></i>${c.kode_type}</div>
        </div>
        <div class="mobil-footer">
          <div class="mobil-price">${formatRp(c.harga_perhari)}<span>/ hari</span></div>
          <button class="btn-pesan" ${c.status == 0 ? 'disabled' : ''}
                  onclick="event.stopPropagation(); bukaPesan(${c.id_mobil})">
            ${c.status == 1 ? 'Pesan' : 'Tidak Tersedia'}
          </button>
        </div>
      </div>
    </div>
  `).join('');
}

/* ===== FILTER ===== */
function filterMobil() {
  const tipe   = document.getElementById('fTipe').value;
  const status = document.getElementById('fStatus').value;
  const harga  = document.getElementById('fHarga').value;
  const filtered = carsData.filter(c => {
    const mTipe   = !tipe   || c.kode_type == tipe;
    const mStatus = !status || String(c.status) == status;
    let   mHarga  = true;
    if      (harga === 'low')  mHarga = parseInt(c.harga_perhari) <= 500000;
    else if (harga === 'mid')  mHarga = parseInt(c.harga_perhari) > 500000 && parseInt(c.harga_perhari) <= 1000000;
    else if (harga === 'high') mHarga = parseInt(c.harga_perhari) > 1000000;
    return mTipe && mStatus && mHarga;
  });
  renderMobil(filtered);
}

function resetFilter() {
  ['fTipe','fStatus','fHarga'].forEach(id => document.getElementById(id).value = '');
  renderMobil(carsData);
}

/* ===== BUKA MODAL PESAN ===== */
function bukaPesan(id) {
  document.getElementById('modalPesanBody').innerHTML = `
    <div class="text-center py-4"><div class="spinner-border" style="color:var(--accent);"></div></div>`;
  const modal = new bootstrap.Modal(document.getElementById('modalPesan'));
  modal.show();

  fetch(baseUrl + 'customer/mobil/form_pesan/' + id)
    .then(r => r.json())
    .then(d => {
      _currentMobil = d.mobil;
      _currentSupir = d.supir || [];
      renderFormPesan(d);
    })
    .catch(() => {
      document.getElementById('modalPesanBody').innerHTML =
        '<p class="text-danger text-center py-3">Gagal memuat data.</p>';
    });
}

/* ===== RENDER FORM PESAN ===== */
function renderFormPesan(d) {
  const m           = d.mobil;
  const supirList   = d.supir || [];
  const isPelanggan = d.is_pelanggan_lama;

  /* ── Supir Section ── */
  let supirSection = '';
  if (isPelanggan && supirList.length > 0) {
    const supirCards = supirList.map(s => `
      <label class="supir-card" onclick="pilihSupir(this, ${s.id_supir})">
        <input type="radio" name="id_supir" value="${s.id_supir}"/>
        <div class="supir-avatar">
          ${s.foto ? `<img src="${uploadUrl}${s.foto}"/>` : s.nama.charAt(0)}
        </div>
        <div>
          <div class="supir-name">${s.nama}</div>
          <div class="supir-info">⭐ ${s.rating || '5.0'} · ${s.pengalaman || 0} thn</div>
          <div class="supir-info" style="color:var(--accent);">
            ${formatRp(s.tarif_perhari)}/hari · ${formatRp(s.tarif_perjam)}/jam
          </div>
        </div>
      </label>
    `).join('');

    supirSection = `
      <div style="margin-top:20px;">
        <label class="form-pesan-label">
          Pilih Supir
          <span style="color:var(--text-soft);font-size:.7rem;font-weight:400;"> — Khusus Pelanggan Setia ⭐</span>
        </label>
        <div class="supir-cards">
          <label class="supir-card selected" style="grid-column:1/-1;" onclick="pilihSupir(this, '')">
            <input type="radio" name="id_supir" value="" checked/>
            <div class="supir-avatar" style="background:rgba(200,180,160,.2);">
              <i class="fas fa-random" style="font-size:.8rem;"></i>
            </div>
            <div>
              <div class="supir-name">Supir Otomatis</div>
              <div class="supir-info">Kami pilihkan supir terbaik untuk Anda</div>
            </div>
          </label>
          ${supirCards}
        </div>
      </div>
    `;
  } else {
    // Pelanggan baru: tampilkan info saja
    supirSection = `
      <div style="margin-top:20px;">
        <label class="form-pesan-label">Supir</label>
        <div class="supir-random-info">
          <i class="fas fa-user-tie"></i>
          <div>Supir akan ditentukan otomatis oleh kami. Semua kendaraan sudah termasuk supir.</div>
        </div>
      </div>
    `;
  }

  document.getElementById('modalPesanBody').innerHTML = `

    <!-- Info Mobil -->
    <div class="pesan-mobil-info">
      <img src="${uploadUrl}${m.gambar}" alt="${m.merk}" class="pesan-mobil-img"/>
      <div>
        <div class="pesan-mobil-name">${m.merk}</div>
        <div class="pesan-mobil-meta">${m.warna} · ${m.tahun} · ${m.kode_type}</div>
        <div style="margin-top:6px;display:flex;flex-wrap:wrap;gap:8px;">
          <span style="font-size:.75rem;background:rgba(212,134,106,.1);color:var(--accent);padding:2px 10px;border-radius:50px;">
            ${formatRp(m.harga_perjam)}/jam
          </span>
          <span style="font-size:.75rem;background:rgba(212,134,106,.1);color:var(--accent);padding:2px 10px;border-radius:50px;">
            ${formatRp(m.harga_perhari)}/hari
          </span>
          <span style="font-size:.75rem;background:rgba(212,134,106,.1);color:var(--accent);padding:2px 10px;border-radius:50px;">
            ${formatRp(m.harga_perminggu)}/minggu
          </span>
          <span style="font-size:.75rem;background:rgba(212,134,106,.1);color:var(--accent);padding:2px 10px;border-radius:50px;">
            ${formatRp(m.harga_perbulan)}/bulan
          </span>
        </div>
      </div>
    </div>

    <!-- Jenis Durasi -->
    <div style="margin-bottom:16px;">
      <label class="form-pesan-label">Jenis Sewa</label>
      <div class="durasi-cards">
        <label class="durasi-card selected" onclick="pilihDurasi(this, 'jam')">
          <input type="radio" name="jenis_durasi" value="jam" checked/>
          <div class="durasi-card-label">Per Jam</div>
          <div class="durasi-card-harga">${formatRp(m.harga_perjam)}</div>
        </label>
        <label class="durasi-card" onclick="pilihDurasi(this, 'hari')">
          <input type="radio" name="jenis_durasi" value="hari"/>
          <div class="durasi-card-label">Per Hari</div>
          <div class="durasi-card-harga">${formatRp(m.harga_perhari)}</div>
        </label>
        <label class="durasi-card" onclick="pilihDurasi(this, 'minggu')">
          <input type="radio" name="jenis_durasi" value="minggu"/>
          <div class="durasi-card-label">Per Minggu</div>
          <div class="durasi-card-harga">${formatRp(m.harga_perminggu)}</div>
        </label>
        <label class="durasi-card" onclick="pilihDurasi(this, 'bulan')">
          <input type="radio" name="jenis_durasi" value="bulan"/>
          <div class="durasi-card-label">Per Bulan</div>
          <div class="durasi-card-harga">${formatRp(m.harga_perbulan)}</div>
        </label>
      </div>
      <!-- Info minimal jam -->
      <div id="infoMinJam" style="font-size:.72rem;color:var(--accent);margin-top:6px;">
        * Minimal 3 jam
      </div>
    </div>

    <!-- Tanggal Mulai & Jumlah Durasi -->
    <div class="row g-3">
      <div class="col-md-7">
        <label class="form-pesan-label">Tanggal & Jam Mulai</label>
        <input type="datetime-local" id="tanggalMulai" class="form-pesan-input"
               min="${new Date().toISOString().slice(0,16)}"
               onchange="hitungTotal()"/>
      </div>
      <div class="col-md-5">
        <label class="form-pesan-label" id="labelJumlah">Jumlah Jam</label>
        <input type="number" id="jumlahDurasi" class="form-pesan-input"
               min="3" value="3" onchange="hitungTotal()" oninput="hitungTotal()"/>
      </div>
    </div>

    <!-- Selesai (readonly, dihitung otomatis) -->
    <div style="margin-top:12px;">
      <label class="form-pesan-label">Perkiraan Selesai</label>
      <input type="text" id="tanggalSelesai" class="form-pesan-input"
             readonly style="background:var(--clay);color:var(--text-mid);"
             placeholder="Otomatis dihitung"/>
    </div>

    <!-- Luar Kota -->
    <div style="margin-top:16px;">
      <label style="display:flex;align-items:flex-start;gap:10px;cursor:pointer;padding:12px;
                    background:var(--sand);border-radius:var(--radius-md);border:1.5px solid var(--clay);">
        <input type="checkbox" id="checkLuarKota" style="margin-top:3px;accent-color:var(--accent);"
               onchange="hitungTotal()"/>
        <div>
          <div style="font-size:.85rem;font-weight:600;color:var(--text-dark);">Lokasi di Luar Kota</div>
          <div style="font-size:.75rem;color:var(--text-soft);margin-top:2px;">
            Dikenakan biaya tambahan <strong style="color:var(--accent);">+20%</strong> dari total harga
          </div>
        </div>
      </label>
    </div>

    ${supirSection}

    <!-- Catatan -->
    <div style="margin-top:16px;">
      <label class="form-pesan-label">Catatan (opsional)</label>
      <textarea id="catatanPesan" class="form-pesan-input" rows="2"
                placeholder="Misal: butuh kursi bayi, antar ke pintu tol, dll."></textarea>
    </div>

    <!-- Total -->
    <div class="total-box" id="totalBox">
      <div>
        <div class="total-label">Estimasi Total</div>
        <div class="total-durasi" id="totalDurasi">Isi data di atas terlebih dahulu</div>
      </div>
      <div class="total-harga" id="totalHarga">–</div>
    </div>

    <!-- Rincian -->
    <div id="rincianBox" style="display:none;font-size:.78rem;color:var(--text-soft);margin-top:8px;padding:0 4px;">
      <div id="rincianText"></div>
    </div>

    <!-- Submit -->
    <button class="btn-submit-pesan" id="btnSubmitPesan" onclick="submitPesan(${m.id_mobil})">
      <i class="fas fa-check-circle"></i> Lanjut ke Pembayaran
    </button>
  `;
}

/* ===== PILIH JENIS DURASI ===== */
function pilihDurasi(el, jenis) {
  document.querySelectorAll('.durasi-card').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  el.querySelector('input[type=radio]').checked = true;

  // Update label jumlah & min value
  const labelMap = { jam: 'Jumlah Jam', hari: 'Jumlah Hari', minggu: 'Jumlah Minggu', bulan: 'Jumlah Bulan' };
  const minMap   = { jam: 3, hari: 1, minggu: 1, bulan: 1 };
  document.getElementById('labelJumlah').innerText   = labelMap[jenis];
  document.getElementById('jumlahDurasi').min        = minMap[jenis];
  document.getElementById('jumlahDurasi').value      = minMap[jenis];
  document.getElementById('infoMinJam').style.display = jenis === 'jam' ? 'block' : 'none';

  hitungTotal();
}

/* ===== PILIH SUPIR ===== */
function pilihSupir(el, id) {
  document.querySelectorAll('.supir-card').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  el.querySelector('input[type=radio]').checked = true;
  hitungTotal();
}

/* ===== HITUNG TOTAL ===== */
function hitungTotal() {
  const m           = _currentMobil;
  const jenisEl     = document.querySelector('input[name="jenis_durasi"]:checked');
  const jumlah      = parseInt(document.getElementById('jumlahDurasi')?.value) || 0;
  const tglMulai    = document.getElementById('tanggalMulai')?.value;
  const luarKota    = document.getElementById('checkLuarKota')?.checked;

  if (!m || !jenisEl || jumlah < 1 || !tglMulai) {
    document.getElementById('totalHarga').innerText  = '–';
    document.getElementById('totalDurasi').innerText = 'Isi data di atas terlebih dahulu';
    document.getElementById('rincianBox').style.display = 'none';
    return;
  }

  const jenis = jenisEl.value;

  // Validasi minimal jam
  if (jenis === 'jam' && jumlah < 3) {
    document.getElementById('totalDurasi').innerText = '⚠ Minimal 3 jam';
    document.getElementById('totalHarga').innerText  = '–';
    return;
  }

  // Hitung tanggal selesai
  const tsM = new Date(tglMulai);
  let tsS   = new Date(tglMulai);
  if      (jenis === 'jam')    tsS.setHours(tsS.getHours() + jumlah);
  else if (jenis === 'hari')   tsS.setDate(tsS.getDate() + jumlah);
  else if (jenis === 'minggu') tsS.setDate(tsS.getDate() + jumlah * 7);
  else if (jenis === 'bulan')  tsS.setMonth(tsS.getMonth() + jumlah);

  // Tampilkan perkiraan selesai
  document.getElementById('tanggalSelesai').value =
    tsS.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });

  // Harga satuan mobil
  const hargaMap = {
    jam:    parseFloat(m.harga_perjam),
    hari:   parseFloat(m.harga_perhari),
    minggu: parseFloat(m.harga_perminggu),
    bulan:  parseFloat(m.harga_perbulan),
  };
  const hargaSatuan = hargaMap[jenis];
  const biayaMobil  = hargaSatuan * jumlah;

  // Biaya supir
  let biayaSupir = 0;
  const supirEl  = document.querySelector('input[name="id_supir"]:checked');
  if (supirEl && supirEl.value !== '') {
    const supirData = _currentSupir.find(s => s.id_supir == supirEl.value);
    if (supirData) {
      const tarifSupir = jenis === 'jam'
        ? parseFloat(supirData.tarif_perjam)
        : parseFloat(supirData.tarif_perhari);
      biayaSupir = tarifSupir * jumlah;
    }
  }

  const subtotal       = biayaMobil + biayaSupir;
  const biayaLuarKota  = luarKota ? Math.round(subtotal * 0.20) : 0;
  const total          = subtotal + biayaLuarKota;

  // Tampilkan
  const satuanLabel = { jam:'jam', hari:'hari', minggu:'minggu', bulan:'bulan' };
  document.getElementById('totalHarga').innerText  = formatRp(total);
  document.getElementById('totalDurasi').innerText = `${jumlah} ${satuanLabel[jenis]}`;

  let rincian = `Mobil: ${formatRp(hargaSatuan)} × ${jumlah} ${satuanLabel[jenis]} = ${formatRp(biayaMobil)}`;
  if (biayaSupir > 0) rincian += ` · Supir: ${formatRp(biayaSupir)}`;
  if (biayaLuarKota > 0) rincian += ` · Luar Kota (+20%): ${formatRp(biayaLuarKota)}`;
  document.getElementById('rincianText').innerText    = rincian;
  document.getElementById('rincianBox').style.display = 'block';
}

/* ===== SUBMIT PESAN ===== */
function submitPesan(id_mobil) {
  const btn          = document.getElementById('btnSubmitPesan');
  const jenisEl      = document.querySelector('input[name="jenis_durasi"]:checked');
  const jumlah       = parseInt(document.getElementById('jumlahDurasi').value);
  const tglMulai     = document.getElementById('tanggalMulai').value;
  const luarKota     = document.getElementById('checkLuarKota')?.checked ? 1 : 0;
  const catatan      = document.getElementById('catatanPesan').value;
  const supirEl      = document.querySelector('input[name="id_supir"]:checked');
  const id_supir     = supirEl ? supirEl.value : '';

  if (!jenisEl || !jumlah || !tglMulai) {
    alert('Lengkapi semua data pemesanan!'); return;
  }
  if (jenisEl.value === 'jam' && jumlah < 3) {
    alert('Sewa per jam minimal 3 jam!'); return;
  }

  btn.disabled  = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

  const formData = new FormData();
  formData.append('id_mobil',       id_mobil);
  formData.append('jenis_durasi',   jenisEl.value);
  formData.append('jumlah_durasi',  jumlah);
  formData.append('tanggal_mulai',  tglMulai);
  formData.append('id_supir',       id_supir);
  formData.append('is_luar_kota',   luarKota);
  formData.append('catatan',        catatan);

  fetch(baseUrl + 'customer/mobil/pesan', { method: 'POST', body: formData })
    .then(r => r.json())
    .then(d => {
      if (d.status === 'success') {
        bootstrap.Modal.getInstance(document.getElementById('modalPesan')).hide();
        setTimeout(() => window.location.href = d.redirect, 300);
      } else {
        alert(d.message);
        btn.disabled  = false;
        btn.innerHTML = '<i class="fas fa-check-circle"></i> Lanjut ke Pembayaran';
      }
    })
    .catch(() => {
      alert('Terjadi kesalahan. Coba lagi.');
      btn.disabled  = false;
      btn.innerHTML = '<i class="fas fa-check-circle"></i> Lanjut ke Pembayaran';
    });
}

/* ===== INIT ===== */
renderMobil(carsData);
</script>