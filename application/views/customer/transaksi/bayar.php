<?php
  $t    = $transaksi;
  $durasi_label = [
    'jam'    => 'Jam',
    'hari'   => 'Hari',
    'minggu' => 'Minggu',
    'bulan'  => 'Bulan',
  ];
  $satuan = $durasi_label[$t->jenis_durasi] ?? $t->jenis_durasi;
  $fmt_tgl = function($dt) {
    return $dt ? date('d M Y, H:i', strtotime($dt)) : '-';
  };
?>
<style>
  .bayar-wrap { padding: 40px 0 60px; }
  .bayar-grid {
    display: grid; grid-template-columns: 1fr 360px;
    gap: 24px; align-items: start;
  }
  @media(max-width:991px) { .bayar-grid { grid-template-columns: 1fr; } }

  .bayar-card {
    background: var(--white); border-radius: var(--radius-xl);
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 20px;
  }
  .bayar-card-head {
    padding: 18px 24px; border-bottom: 1px solid var(--clay);
    display: flex; align-items: center; gap: 10px;
  }
  .bayar-card-head h5 {
    font-family: var(--font-display); font-size: 1rem; font-weight: 700;
    color: var(--text-dark); margin: 0;
  }
  .bayar-card-head i { color: var(--accent); }
  .bayar-card-body { padding: 24px; }

  .step-bar { display: flex; align-items: center; gap: 0; margin-bottom: 36px; }
  .step-item { display: flex; align-items: center; gap: 10px; font-size: .82rem; font-weight: 600; }
  .step-circle {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem; font-weight: 700; flex-shrink: 0;
  }
  .step-circle.done   { background: var(--accent); color: var(--white); }
  .step-circle.active { background: var(--accent); color: var(--white); box-shadow: 0 0 0 4px rgba(212,134,106,.2); }
  .step-circle.idle   { background: var(--clay); color: var(--text-soft); }
  .step-label.done    { color: var(--accent); }
  .step-label.active  { color: var(--text-dark); }
  .step-label.idle    { color: var(--text-soft); }
  .step-line { flex: 1; height: 2px; background: var(--clay); margin: 0 10px; }
  .step-line.done { background: var(--accent); }

  .rekening-box {
    background: linear-gradient(135deg, var(--sand), var(--clay));
    border-radius: var(--radius-lg); padding: 24px; margin-bottom: 20px;
    border: 1.5px solid rgba(200,180,160,.2);
  }
  .rekening-bank {
    font-size: .75rem; font-weight: 600; text-transform: uppercase;
    letter-spacing: .08em; color: var(--text-soft); margin-bottom: 6px;
  }
  .rekening-nomor {
    font-family: var(--font-display); font-size: 1.8rem; font-weight: 700;
    color: var(--text-dark); letter-spacing: .04em;
    display: flex; align-items: center; gap: 12px;
  }
  .btn-copy {
    font-size: .75rem; font-weight: 600;
    background: var(--white); color: var(--accent);
    border: 1.5px solid rgba(212,134,106,.3);
    border-radius: 50px; padding: 5px 14px;
    cursor: pointer; transition: all .2s;
  }
  .btn-copy:hover { background: rgba(212,134,106,.08); }
  .rekening-nama { font-size: .85rem; color: var(--text-mid); margin-top: 4px; }

  .total-bayar-box {
    background: rgba(212,134,106,.08); border: 1.5px solid rgba(212,134,106,.2);
    border-radius: var(--radius-lg); padding: 18px 22px;
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 24px;
  }
  .total-bayar-label { font-size: .82rem; color: var(--text-mid); }
  .total-bayar-harga {
    font-family: var(--font-display); font-size: 1.5rem; font-weight: 700; color: var(--accent);
  }

  .upload-area {
    border: 2px dashed var(--clay); border-radius: var(--radius-lg);
    padding: 32px 20px; text-align: center; cursor: pointer;
    transition: all .2s; background: var(--sand); position: relative;
  }
  .upload-area:hover { border-color: var(--accent); background: rgba(212,134,106,.04); }
  .upload-area.has-file { border-color: var(--accent); border-style: solid; }
  .upload-area input[type=file] {
    position: absolute; inset: 0; opacity: 0;
    cursor: pointer; width: 100%; height: 100%;
  }
  .upload-icon { font-size: 2rem; color: var(--clay); margin-bottom: 10px; }
  .upload-text { font-size: .85rem; color: var(--text-soft); }
  .upload-hint { font-size: .75rem; color: var(--text-soft); margin-top: 6px; }
  .preview-img {
    width: 100%; max-height: 220px; object-fit: contain;
    border-radius: var(--radius-md); margin-top: 14px; display: none;
    border: 1px solid var(--clay);
  }

  .info-row {
    display: flex; justify-content: space-between;
    padding: 10px 0; border-bottom: 1px solid rgba(200,180,160,.1); font-size: .85rem;
  }
  .info-row:last-child { border-bottom: none; }
  .info-label { color: var(--text-soft); }
  .info-val   { font-weight: 600; color: var(--text-dark); text-align: right; }

  .btn-upload-bukti {
    width: 100%; background: var(--accent); color: var(--white);
    border: none; border-radius: 50px; padding: 14px;
    font-size: .95rem; font-weight: 600; cursor: pointer; margin-top: 20px;
    transition: all .25s; display: flex; align-items: center; justify-content: center; gap: 8px;
  }
  .btn-upload-bukti:hover { background: #C07358; box-shadow: 0 6px 20px rgba(212,134,106,.35); }
  .btn-upload-bukti:disabled { background: var(--clay); color: var(--text-soft); cursor: not-allowed; }

  .panduan-item {
    display: flex; gap: 12px; align-items: flex-start;
    font-size: .83rem; color: var(--text-mid); margin-bottom: 14px;
  }
  .panduan-num {
    width: 24px; height: 24px; border-radius: 50%;
    background: rgba(212,134,106,.15); color: var(--accent);
    font-size: .75rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px;
  }

  .toast-notif {
    position: fixed; bottom: 28px; right: 28px;
    background: var(--text-dark); color: var(--white);
    padding: 14px 22px; border-radius: var(--radius-lg);
    font-size: .88rem; box-shadow: 0 8px 32px rgba(0,0,0,.2);
    z-index: 9999; transform: translateY(80px); opacity: 0;
    transition: all .3s; display: flex; align-items: center; gap: 10px;
  }
  .toast-notif.show { transform: translateY(0); opacity: 1; }
  .toast-notif.success i { color: #6DC87A; }
  .toast-notif.error   i { color: #E07070; }
</style>

<div class="bayar-wrap">
  <div class="container">

    <!-- Step Bar -->
    <div class="step-bar mb-4">
      <div class="step-item">
        <div class="step-circle done"><i class="fas fa-check"></i></div>
        <span class="step-label done">Pesan</span>
      </div>
      <div class="step-line done"></div>
      <div class="step-item">
        <div class="step-circle active">2</div>
        <span class="step-label active">Pembayaran</span>
      </div>
      <div class="step-line"></div>
      <div class="step-item">
        <div class="step-circle idle">3</div>
        <span class="step-label idle">Konfirmasi Admin</span>
      </div>
      <div class="step-line"></div>
      <div class="step-item">
        <div class="step-circle idle">4</div>
        <span class="step-label idle">Aktif</span>
      </div>
    </div>

    <div class="bayar-grid">

      <!-- KIRI: Upload Bukti -->
      <div>
        <div class="bayar-card">
          <div class="bayar-card-head">
            <i class="fas fa-building-columns"></i>
            <h5>Transfer ke Rekening</h5>
          </div>
          <div class="bayar-card-body">
            <div class="rekening-box">
              <div class="rekening-bank">Bank <?= $rekening['bank'] ?></div>
              <div class="rekening-nomor">
                <span id="nomorRek"><?= $rekening['nomor'] ?></span>
                <button class="btn-copy" onclick="copyRekening()">
                  <i class="fas fa-copy me-1"></i>Salin
                </button>
              </div>
              <div class="rekening-nama">a.n. <?= $rekening['atas_nama'] ?></div>
            </div>

            <div class="total-bayar-box">
              <div>
                <div class="total-bayar-label">Jumlah yang harus ditransfer</div>
                <div style="font-size:.75rem;color:var(--text-soft);">Transfer tepat sesuai nominal</div>
              </div>
              <div class="total-bayar-harga">
                Rp <?= number_format($t->total_harga, 0, ',', '.') ?>
              </div>
            </div>

            <!-- Panduan -->
            <div style="margin-bottom:20px;">
              <div style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--text-soft);margin-bottom:12px;">
                Cara Pembayaran
              </div>
              <div class="panduan-item">
                <div class="panduan-num">1</div>
                <div>Transfer ke rekening di atas sesuai nominal yang tertera.</div>
              </div>
              <div class="panduan-item">
                <div class="panduan-num">2</div>
                <div>Simpan bukti transfer (screenshot atau foto struk).</div>
              </div>
              <div class="panduan-item">
                <div class="panduan-num">3</div>
                <div>Upload bukti transfer di form di bawah ini.</div>
              </div>
              <div class="panduan-item">
                <div class="panduan-num">4</div>
                <div>Admin akan mengkonfirmasi pembayaran dan mengaktifkan pesanan kamu.</div>
              </div>
            </div>

            <!-- Upload Form -->
            <div style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--text-soft);margin-bottom:10px;">
              Upload Bukti Transfer
            </div>
            <div class="upload-area" id="uploadArea">
              <input type="file" id="inputBukti" name="bukti_pembayaran"
                     accept="image/*,.pdf" onchange="previewBukti(this)"/>
              <div id="uploadPlaceholder">
                <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                <div class="upload-text">Klik atau drag file ke sini</div>
                <div class="upload-hint">JPG, PNG, atau PDF · Maks 2MB</div>
              </div>
              <img id="previewImg" class="preview-img"/>
            </div>

            <button class="btn-upload-bukti" id="btnUpload" onclick="uploadBukti()" disabled>
              <i class="fas fa-paper-plane"></i> Kirim Bukti Pembayaran
            </button>
          </div>
        </div>
      </div>

      <!-- KANAN: Ringkasan Pesanan -->
      <div>
        <div class="bayar-card">
          <div class="bayar-card-head">
            <i class="fas fa-receipt"></i>
            <h5>Ringkasan Pesanan</h5>
          </div>
          <div class="bayar-card-body">

            <div style="background:var(--sand);border-radius:var(--radius-lg);padding:16px;text-align:center;margin-bottom:18px;">
              <img src="<?= base_url('assets/upload/'.$t->gambar) ?>"
                   alt="<?= $t->merk ?>"
                   style="max-height:120px;object-fit:contain;width:80%;"/>
            </div>

            <div class="info-row">
              <span class="info-label">Mobil</span>
              <span class="info-val"><?= $t->merk ?></span>
            </div>
            <?php if ($t->is_upgrade && !empty($t->merk_asal)): ?>
            <div class="info-row">
              <span class="info-label" style="color:var(--accent);">Upgrade dari</span>
              <span class="info-val" style="color:var(--accent);"><?= $t->merk_asal ?></span>
            </div>
            <?php endif; ?>
            <div class="info-row">
              <span class="info-label">Tipe</span>
              <span class="info-val"><?= $t->kode_type ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Jenis Sewa</span>
              <span class="info-val"><?= ucfirst($t->jenis_durasi) ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Durasi</span>
              <span class="info-val"><?= $t->jumlah_durasi ?> <?= $satuan ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Mulai</span>
              <span class="info-val"><?= $fmt_tgl($t->tanggal_rental) ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Selesai</span>
              <span class="info-val"><?= $fmt_tgl($t->tanggal_kembali) ?></span>
            </div>
            <?php if (!empty($t->nama_supir)): ?>
            <div class="info-row">
              <span class="info-label">Supir</span>
              <span class="info-val"><?= $t->nama_supir ?></span>
            </div>
            <?php endif; ?>
            <?php if ($t->is_luar_kota): ?>
            <div class="info-row">
              <span class="info-label">Lokasi</span>
              <span class="info-val" style="color:var(--accent);">🗺 Luar Kota (+20%)</span>
            </div>
            <?php endif; ?>

            <!-- Breakdown biaya -->
            <div style="margin-top:12px;padding:12px;background:var(--sand);border-radius:var(--radius-md);font-size:.78rem;color:var(--text-mid);">
              <div style="font-weight:600;color:var(--text-dark);margin-bottom:6px;">Rincian Biaya</div>
              <div style="display:flex;justify-content:space-between;">
                <span>Biaya Mobil</span>
                <span>Rp <?= number_format($t->biaya_mobil, 0, ',', '.') ?></span>
              </div>
              <?php if ($t->biaya_supir > 0): ?>
              <div style="display:flex;justify-content:space-between;margin-top:4px;">
                <span>Biaya Supir</span>
                <span>Rp <?= number_format($t->biaya_supir, 0, ',', '.') ?></span>
              </div>
              <?php endif; ?>
              <?php if ($t->is_luar_kota): ?>
              <div style="display:flex;justify-content:space-between;margin-top:4px;">
                <span>Luar Kota (+20%)</span>
                <span>Rp <?= number_format($t->total_harga - $t->biaya_mobil - $t->biaya_supir, 0, ',', '.') ?></span>
              </div>
              <?php endif; ?>
            </div>

            <div class="info-row" style="border-top:2px solid var(--clay);margin-top:8px;padding-top:16px;">
              <span class="info-label" style="font-weight:600;color:var(--text-dark);">Total</span>
              <span class="info-val" style="color:var(--accent);font-size:1.1rem;">
                Rp <?= number_format($t->total_harga, 0, ',', '.') ?>
              </span>
            </div>

            <div style="margin-top:16px;padding:12px;background:rgba(250,213,181,.2);border-radius:var(--radius-md);font-size:.78rem;color:var(--text-mid);border:1px solid rgba(212,134,106,.15);">
              <i class="fas fa-clock me-2" style="color:var(--accent);"></i>
              ID Pesanan: <strong>#TRX-<?= str_pad($t->id_rental, 5, '0', STR_PAD_LEFT) ?></strong>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast-notif" id="toastNotif">
  <i class="fas fa-circle-check"></i>
  <span id="toastMsg"></span>
</div>

<script>
function copyRekening() {
  const nomor = document.getElementById('nomorRek').innerText;
  navigator.clipboard.writeText(nomor).then(() => showToast('success', 'Nomor rekening disalin!'));
}

function previewBukti(input) {
  const btn         = document.getElementById('btnUpload');
  const area        = document.getElementById('uploadArea');
  const preview     = document.getElementById('previewImg');
  const placeholder = document.getElementById('uploadPlaceholder');

  if (input.files && input.files[0]) {
    const file = input.files[0];
    if (file.size > 2 * 1024 * 1024) {
      showToast('error', 'File terlalu besar. Maksimal 2MB.');
      input.value = ''; return;
    }
    area.classList.add('has-file');
    btn.disabled = false;

    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.style.display = 'block';
        placeholder.innerHTML = `<div style="font-size:.82rem;color:var(--accent);font-weight:600;margin-top:8px;">
          <i class="fas fa-check-circle me-1"></i>${file.name}</div>`;
      };
      reader.readAsDataURL(file);
    } else {
      placeholder.innerHTML = `<i class="fas fa-file-pdf" style="font-size:2rem;color:var(--accent);"></i>
        <div style="font-size:.82rem;color:var(--accent);font-weight:600;margin-top:8px;">${file.name}</div>`;
    }
  }
}

function uploadBukti() {
  const input = document.getElementById('inputBukti');
  if (!input.files[0]) return;

  const btn = document.getElementById('btnUpload');
  btn.disabled  = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupload...';

  const formData = new FormData();
  formData.append('bukti_pembayaran', input.files[0]);

  fetch('<?= base_url("customer/transaksi/upload_bukti/".$transaksi->id_rental) ?>', {
    method: 'POST', body: formData
  })
  .then(r => r.json())
  .then(d => {
    showToast(d.status, d.message);
    if (d.status === 'success') {
      setTimeout(() => window.location.href = d.redirect, 1500);
    } else {
      btn.disabled  = false;
      btn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Bukti Pembayaran';
    }
  })
  .catch(() => {
    showToast('error', 'Gagal upload. Coba lagi.');
    btn.disabled  = false;
    btn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Bukti Pembayaran';
  });
}

function showToast(type, msg) {
  const toast = document.getElementById('toastNotif');
  document.getElementById('toastMsg').innerText = msg;
  toast.className = 'toast-notif ' + type;
  toast.querySelector('i').className = type === 'success' ? 'fas fa-circle-check' : 'fas fa-circle-xmark';
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 3500);
}
</script>