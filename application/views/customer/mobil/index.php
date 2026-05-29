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
  .pesan-harga      { font-size:.9rem; font-weight:700; color:var(--accent); margin-top:3px; }

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
  .supir-tanpa {
    grid-column:1/-1;
    border:1.5px solid var(--clay);
    border-radius:var(--radius-md);
    padding:10px 14px;
    cursor:pointer; transition:all 0.2s;
    display:flex; align-items:center; gap:8px;
    background:var(--sand); font-size:.82rem; color:var(--text-mid);
  }
  .supir-tanpa.selected { border-color:var(--accent); background:rgba(212,134,106,.08); color:var(--accent); }
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
const carsData   = <?= json_encode($mobil) ?>;
const isPelangganLama = <?= $is_pelanggan_lama ? 'true' : 'false' ?>;
const baseUrl    = '<?= base_url() ?>';
const uploadUrl  = '<?= base_url("assets/upload/") ?>';

const typeBadgeMap = {
  SUV:'badge-suv', MPV:'badge-mpv', SDN:'badge-sedan',
  CITY:'badge-city', PREMIUM:'badge-premium', TRUK:'badge-truck', MINIBUS:'badge-minibus'
};

function formatRp(n) { return 'Rp ' + parseInt(n).toLocaleString('id-ID'); }

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
          <div class="mobil-price">${formatRp(c.harga)}<span>/ hari</span></div>
          <button class="btn-pesan" ${c.status == 0 ? 'disabled' : ''} onclick="event.stopPropagation(); bukaPesan(${c.id_mobil})">
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
    if      (harga === 'low')  mHarga = parseInt(c.harga) <= 500000;
    else if (harga === 'mid')  mHarga = parseInt(c.harga) > 500000 && parseInt(c.harga) <= 1000000;
    else if (harga === 'high') mHarga = parseInt(c.harga) > 1000000;
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
    .then(d => renderFormPesan(d))
    .catch(() => {
      document.getElementById('modalPesanBody').innerHTML = '<p class="text-danger text-center py-3">Gagal memuat data.</p>';
    });
}

/* ===== RENDER FORM PESAN ===== */
function renderFormPesan(d) {
  const m = d.mobil;
  const supirList = d.supir || [];
  const isPelanggan = d.is_pelanggan_lama;

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
        </div>
      </label>
    `).join('');

    supirSection = `
      <div class="mb-3" style="margin-top:20px;">
        <label class="form-pesan-label">Pilih Supir <span style="color:var(--text-soft);font-size:.7rem;">(Khusus Pelanggan Setia)</span></label>
        <div class="supir-cards">
          <label class="supir-tanpa selected" onclick="pilihSupir(this, '')">
            <input type="radio" name="id_supir" value="" checked/>
            <i class="fas fa-user-slash"></i> Tanpa Supir
          </label>
          ${supirCards}
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
        <div class="pesan-harga">${formatRp(m.harga)} <span style="font-size:.75rem;font-weight:400;color:var(--text-soft)">/ hari</span></div>
      </div>
    </div>

    <!-- Tanggal -->
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-pesan-label">Tanggal Sewa</label>
        <input type="date" id="tglRental" class="form-pesan-input"
               min="${new Date().toISOString().split('T')[0]}"
               onchange="hitungTotal(${m.harga})" required/>
      </div>
      <div class="col-md-6">
        <label class="form-pesan-label">Tanggal Kembali</label>
        <input type="date" id="tglKembali" class="form-pesan-input"
               onchange="hitungTotal(${m.harga})" required/>
      </div>
    </div>

    ${supirSection}

    <!-- Catatan -->
    <div style="margin-top:16px;">
      <label class="form-pesan-label">Catatan (opsional)</label>
      <textarea id="catatanPesan" class="form-pesan-input" rows="2"
                placeholder="Misal: antar ke bandara, butuh kursi bayi, dll."></textarea>
    </div>

    <!-- Total -->
    <div class="total-box">
      <div>
        <div class="total-label">Estimasi Total</div>
        <div class="total-durasi" id="totalDurasi">Pilih tanggal terlebih dahulu</div>
      </div>
      <div class="total-harga" id="totalHarga">–</div>
    </div>

    <!-- Submit -->
    <button class="btn-submit-pesan" id="btnSubmitPesan" onclick="submitPesan(${m.id_mobil})">
      <i class="fas fa-check-circle"></i> Konfirmasi Pemesanan
    </button>
  `;
}

/* ===== PILIH SUPIR ===== */
function pilihSupir(el, id) {
  document.querySelectorAll('.supir-card, .supir-tanpa').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  el.querySelector('input[type=radio]').checked = true;
}

/* ===== HITUNG TOTAL ===== */
function hitungTotal(hargaPerHari) {
  const tgl1 = document.getElementById('tglRental').value;
  const tgl2 = document.getElementById('tglKembali').value;
  if (!tgl1 || !tgl2 || tgl2 <= tgl1) {
    document.getElementById('totalHarga').innerText = '–';
    document.getElementById('totalDurasi').innerText = 'Pilih tanggal yang valid';
    return;
  }
  const hari = Math.ceil((new Date(tgl2) - new Date(tgl1)) / 86400000);
  const supirDipilih = document.querySelector('input[name="id_supir"]:checked');
  const pakaSupir    = supirDipilih && supirDipilih.value !== '';
  const total        = (hargaPerHari * hari) + (pakaSupir ? 150000 * hari : 0);
  document.getElementById('totalHarga').innerText  = formatRp(total);
  document.getElementById('totalDurasi').innerText = `${hari} hari` + (pakaSupir ? ' + biaya supir' : '');
}

/* ===== SUBMIT PESAN ===== */
function submitPesan(id_mobil) {
  const btn        = document.getElementById('btnSubmitPesan');
  const tglRental  = document.getElementById('tglRental').value;
  const tglKembali = document.getElementById('tglKembali').value;
  const catatan    = document.getElementById('catatanPesan').value;
  const supirEl    = document.querySelector('input[name="id_supir"]:checked');
  const id_supir   = supirEl ? supirEl.value : '';

  if (!tglRental || !tglKembali) {
    alert('Lengkapi tanggal sewa dan kembali!'); return;
  }

  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

  const formData = new FormData();
  formData.append('id_mobil', id_mobil);
  formData.append('tanggal_rental', tglRental);
  formData.append('tanggal_kembali', tglKembali);
  formData.append('id_supir', id_supir);
  formData.append('catatan', catatan);

  fetch(baseUrl + 'customer/mobil/pesan', {
    method: 'POST', body: formData
  })
  .then(r => r.json())
  .then(d => {
    if (d.status === 'success') {
      bootstrap.Modal.getInstance(document.getElementById('modalPesan')).hide();
      setTimeout(() => window.location.href = d.redirect, 300);
    } else {
      alert(d.message);
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-check-circle"></i> Konfirmasi Pemesanan';
    }
  });
}

/* ===== INIT ===== */
renderMobil(carsData);
</script>