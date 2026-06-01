<style>
  .profil-wrap { padding: 40px 0 60px; }

  /* Tabs */
  .profil-tabs {
    display: flex; gap: 6px;
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 6px;
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card);
    margin-bottom: 28px;
    width: fit-content;
  }
  .profil-tab {
    padding: 9px 22px;
    border-radius: var(--radius-md);
    font-size: 0.85rem; font-weight: 500;
    color: var(--text-soft);
    cursor: pointer; border: none; background: none;
    transition: all 0.2s;
    display: flex; align-items: center; gap: 7px;
  }
  .profil-tab.active {
    background: var(--accent);
    color: var(--white);
    box-shadow: 0 4px 12px rgba(212,134,106,0.3);
  }
  .profil-tab:hover:not(.active) { color: var(--accent); background: rgba(212,134,106,0.07); }
  .tab-content { display: none; }
  .tab-content.active { display: block; }

  /* Card */
  .profil-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    border: 1.5px solid rgba(200,180,160,0.15);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    margin-bottom: 24px;
  }
  .profil-card-header {
    padding: 20px 28px;
    border-bottom: 1px solid var(--clay);
    display: flex; align-items: center; gap: 10px;
  }
  .profil-card-header h5 {
    font-family: var(--font-display);
    font-size: 1.05rem; font-weight: 700;
    color: var(--text-dark); margin: 0;
  }
  .profil-card-header i { color: var(--accent); }
  .profil-card-body { padding: 28px; }

  /* Avatar */
  .avatar-section {
    display: flex; align-items: center; gap: 24px;
    margin-bottom: 28px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--clay);
  }
  .avatar-big {
    width: 88px; height: 88px; border-radius: 50%;
    background: linear-gradient(135deg, var(--peach), var(--blush));
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display); font-size: 2rem; font-weight: 700;
    color: var(--accent); flex-shrink: 0; overflow: hidden;
    border: 3px solid var(--clay);
  }
  .avatar-big img { width: 100%; height: 100%; object-fit: cover; }
  .avatar-info h4 { font-family: var(--font-display); font-size: 1.2rem; font-weight: 700; margin-bottom: 4px; }
  .avatar-info p  { font-size: 0.85rem; color: var(--text-soft); margin: 0; }
  .avatar-upload-btn {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.8rem; font-weight: 500;
    color: var(--accent); border: 1.5px solid rgba(212,134,106,0.3);
    background: rgba(212,134,106,0.06);
    border-radius: 50px; padding: 6px 16px;
    cursor: pointer; margin-top: 10px;
    transition: all 0.2s;
  }
  .avatar-upload-btn:hover { background: rgba(212,134,106,0.12); }

  /* Form */
  .form-group-dash { margin-bottom: 20px; }
  .form-label-dash {
    display: block;
    font-size: 0.75rem; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.06em;
    color: var(--text-soft); margin-bottom: 7px;
  }
  .form-control-dash {
    width: 100%;
    border: 1.5px solid var(--clay);
    border-radius: var(--radius-md);
    padding: 11px 16px;
    font-size: 0.9rem;
    color: var(--text-dark);
    background: var(--sand);
    transition: all 0.2s;
    font-family: var(--font-body);
  }
  .form-control-dash:focus {
    outline: none;
    border-color: var(--accent);
    background: var(--white);
    box-shadow: 0 0 0 3px rgba(212,134,106,0.1);
  }
  select.form-control-dash { cursor: pointer; }

  /* Foto dokumen */
  .doc-upload-area {
    border: 2px dashed var(--clay);
    border-radius: var(--radius-lg);
    padding: 24px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    background: var(--sand);
    position: relative;
  }
  .doc-upload-area:hover { border-color: var(--accent); background: rgba(212,134,106,0.04); }
  .doc-upload-area input[type=file] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
  }
  .doc-upload-area i { font-size: 1.8rem; color: var(--clay); margin-bottom: 8px; display: block; }
  .doc-upload-area p { font-size: 0.82rem; color: var(--text-soft); margin: 0; }
  .doc-preview {
    width: 100%; border-radius: var(--radius-md);
    max-height: 160px; object-fit: cover; margin-top: 12px;
    border: 1px solid var(--clay);
  }

  /* Status badge */
  .verified-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.78rem; font-weight: 600;
    padding: 5px 14px; border-radius: 50px;
  }
  .vb-yes     { background: rgba(122,200,140,0.18); color: #3A8A50; }
  .vb-no      { background: rgba(212,134,106,0.15); color: var(--accent); }
  .vb-waiting { background: rgba(184,212,232,0.3);  color: #4A7FA0; }

  /* Btn save */
  .btn-save-profil {
    background: var(--accent); color: var(--white);
    border: none; border-radius: 50px;
    padding: 12px 36px; font-size: 0.9rem; font-weight: 600;
    cursor: pointer; transition: all 0.25s;
    display: inline-flex; align-items: center; gap: 8px;
  }
  .btn-save-profil:hover { background: #C07358; box-shadow: 0 6px 20px rgba(212,134,106,0.35); transform: translateY(-1px); }
  .btn-save-profil:disabled { background: var(--clay); color: var(--text-soft); cursor: not-allowed; transform: none; box-shadow: none; }

  /* Toast */
  .toast-notif {
    position: fixed; bottom: 28px; right: 28px;
    background: var(--text-dark); color: var(--white);
    padding: 14px 22px; border-radius: var(--radius-lg);
    font-size: 0.88rem; font-weight: 500;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    z-index: 9999; transform: translateY(80px); opacity: 0;
    transition: all 0.3s; display: flex; align-items: center; gap: 10px;
  }
  .toast-notif.show { transform: translateY(0); opacity: 1; }
  .toast-notif.success i { color: #6DC87A; }
  .toast-notif.error   i { color: #E07070; }
</style>

<div class="profil-wrap">
  <div class="container">

    <?php
      $profil_lengkap = !empty($customer) && !empty($customer->id_number) && !empty($customer->nomor_sim);
      $is_verified    = !empty($customer) && $customer->is_verified == 1;
    ?>

    <!-- Page Title -->
    <div class="d-flex align-items-center justify-content-between mb-4">
      <div>
        <span style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:var(--accent);">Akun Saya</span>
        <h2 style="font-family:var(--font-display);font-size:1.6rem;font-weight:700;margin:0;">Profil Saya</h2>
      </div>
      <div>
        <?php if ($is_verified): ?>
          <span class="verified-badge vb-yes"><i class="fas fa-circle-check"></i> Terverifikasi</span>
        <?php elseif ($profil_lengkap): ?>
          <span class="verified-badge vb-waiting"><i class="fas fa-clock"></i> Menunggu Verifikasi</span>
        <?php else: ?>
          <span class="verified-badge vb-no"><i class="fas fa-triangle-exclamation"></i> Belum Lengkap</span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Tabs -->
    <div class="profil-tabs">
      <button class="profil-tab active" onclick="switchTab('data-diri')">
        <i class="fas fa-user"></i> Data Diri
      </button>
      <button class="profil-tab" onclick="switchTab('dokumen')">
        <i class="fas fa-id-card"></i> Dokumen Identitas
      </button>
    </div>

    <form id="formProfil" enctype="multipart/form-data">

      <!-- ========== TAB DATA DIRI ========== -->
      <div class="tab-content active" id="tab-data-diri">
        <div class="profil-card">
          <div class="profil-card-header">
            <i class="fas fa-user-circle"></i>
            <h5>Informasi Pribadi</h5>
          </div>
          <div class="profil-card-body">

            <!-- Avatar -->
            <div class="avatar-section">
              <div class="avatar-big" id="avatarPreview">
                <?php if (!empty($customer->foto_profil)): ?>
                  <img src="<?= base_url('assets/upload/profil/'.$customer->foto_profil) ?>" id="imgAvatarPreview"/>
                <?php else: ?>
                  <span id="avatarInitial"><?= strtoupper(substr($this->session->userdata('nama_lengkap'), 0, 1)) ?></span>
                <?php endif; ?>
              </div>
              <div class="avatar-info">
                <h4><?= $this->session->userdata('nama_lengkap') ?></h4>
                <p><?= $this->session->userdata('email') ?></p>
                <label class="avatar-upload-btn">
                  <i class="fas fa-camera"></i> Ganti Foto
                  <input type="file" name="foto_profil" accept="image/*" style="display:none;" onchange="previewAvatar(this)"/>
                </label>
              </div>
            </div>

            <div class="row g-3">
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control-dash"
                         value="<?= $this->session->userdata('nama_lengkap') ?>" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">No. HP</label>
                  <input type="text" name="no_hp" class="form-control-dash"
                         value="<?= !empty($customer->no_hp) ? $customer->no_hp : '' ?>"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">Tanggal Lahir</label>
                  <input type="date" name="tgl_lahir" 
                      value="<?= ($customer->tgl_lahir && $customer->tgl_lahir != '0000-00-00') ? $customer->tgl_lahir : '' ?>">

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control-dash">
                    <option value="">Pilih...</option>
                    <option value="L" <?= (!empty($customer->jenis_kelamin) && $customer->jenis_kelamin == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= (!empty($customer->jenis_kelamin) && $customer->jenis_kelamin == 'P') ? 'selected' : '' ?>>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group-dash">
                  <label class="form-label-dash">Alamat</label>
                  <textarea name="alamat" class="form-control-dash" rows="3"><?= !empty($customer->alamat) ? $customer->alamat : '' ?></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">Kota</label>
                  <input type="text" name="kota" class="form-control-dash"
                         value="<?= !empty($customer->kota) ? $customer->kota : '' ?>"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">Provinsi</label>
                  <input type="text" name="provinsi" class="form-control-dash"
                         value="<?= !empty($customer->provinsi) ? $customer->provinsi : '' ?>"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ========== TAB DOKUMEN ========== -->
      <div class="tab-content" id="tab-dokumen">
        <div class="profil-card">
          <div class="profil-card-header">
            <i class="fas fa-id-card"></i>
            <h5>Dokumen Identitas</h5>
          </div>
          <div class="profil-card-body">

            <?php if (!$is_verified && $profil_lengkap): ?>
            <div style="background:rgba(184,212,232,0.2);border:1.5px solid rgba(74,127,160,0.2);border-radius:var(--radius-md);padding:14px 18px;margin-bottom:24px;font-size:.85rem;color:#4A7FA0;">
              <i class="fas fa-clock me-2"></i> Dokumen kamu sedang diverifikasi admin. Mengubah dokumen akan mereset status verifikasi.
            </div>
            <?php endif; ?>

            <div class="row g-4">
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">Tipe Identitas</label>
                  <select name="id_type" class="form-control-dash">
                    <option value="KTP"      <?= (!empty($customer->id_type) && $customer->id_type == 'KTP') ? 'selected' : '' ?>>KTP</option>
                    <option value="PASSPORT" <?= (!empty($customer->id_type) && $customer->id_type == 'PASSPORT') ? 'selected' : '' ?>>Passport</option>
                    <option value="SIM"      <?= (!empty($customer->id_type) && $customer->id_type == 'SIM') ? 'selected' : '' ?>>SIM (sebagai ID)</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">Nomor Identitas (KTP/Passport)</label>
                  <input type="text" name="id_number" class="form-control-dash"
                         value="<?= !empty($customer->id_number) ? $customer->id_number : '' ?>"
                         placeholder="Masukkan nomor identitas"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group-dash">
                  <label class="form-label-dash">Nomor SIM</label>
                  <input type="text" name="nomor_sim" class="form-control-dash"
                         value="<?= !empty($customer->nomor_sim) ? $customer->nomor_sim : '' ?>"
                         placeholder="Masukkan nomor SIM"/>
                </div>
              </div>

              <!-- Foto KTP -->
              <div class="col-md-6">
                <label class="form-label-dash">Foto KTP / Identitas</label>
                <div class="doc-upload-area" onclick="document.getElementById('inputFotoKTP').click()">
                  <input type="file" id="inputFotoKTP" name="foto_id" accept="image/*"
                         style="display:none;" onchange="previewDoc(this, 'prevKTP')"/>
                  <?php if (!empty($customer->foto_id)): ?>
                    <img src="<?= base_url('assets/upload/'.$customer->foto_id) ?>"
                         id="prevKTP" class="doc-preview"/>
                    <p style="margin-top:8px;">Klik untuk ganti foto</p>
                  <?php else: ?>
                    <i class="fas fa-id-card"></i>
                    <p>Klik untuk upload foto KTP</p>
                    <img id="prevKTP" class="doc-preview" style="display:none;"/>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Foto SIM -->
              <div class="col-md-6">
                <label class="form-label-dash">Foto SIM</label>
                <div class="doc-upload-area" onclick="document.getElementById('inputFotoSIM').click()">
                  <input type="file" id="inputFotoSIM" name="foto_sim" accept="image/*"
                         style="display:none;" onchange="previewDoc(this, 'prevSIM')"/>
                  <?php if (!empty($customer->foto_sim)): ?>
                    <img src="<?= base_url('assets/upload/'.$customer->foto_sim) ?>"
                         id="prevSIM" class="doc-preview"/>
                    <p style="margin-top:8px;">Klik untuk ganti foto</p>
                  <?php else: ?>
                    <i class="fas fa-car"></i>
                    <p>Klik untuk upload foto SIM</p>
                    <img id="prevSIM" class="doc-preview" style="display:none;"/>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tombol Simpan -->
      <div class="d-flex justify-content-end">
        <button type="button" class="btn-save-profil" id="btnSimpan" onclick="simpanProfil()">
          <i class="fas fa-floppy-disk"></i> Simpan Perubahan
        </button>
      </div>

    </form>

  </div>
</div>

<!-- Toast -->
<div class="toast-notif" id="toastNotif">
  <i class="fas fa-circle-check"></i>
  <span id="toastMsg">Berhasil!</span>
</div>

<script>
/* ===== TABS ===== */
function switchTab(tab) {
  document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
  document.querySelectorAll('.profil-tab').forEach(el => el.classList.remove('active'));
  document.getElementById('tab-' + tab).classList.add('active');
  event.currentTarget.classList.add('active');
}

/* ===== PREVIEW AVATAR ===== */
function previewAvatar(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const wrap = document.getElementById('avatarPreview');
      wrap.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;"/>`;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

/* ===== PREVIEW DOC ===== */
function previewDoc(input, previewId) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const img = document.getElementById(previewId);
      img.src = e.target.result;
      img.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
  }
}

/* ===== SIMPAN PROFIL ===== */
function simpanProfil() {
  const btn = document.getElementById('btnSimpan');
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

  const formData = new FormData(document.getElementById('formProfil'));

  fetch('<?= base_url("customer/profil/simpan") ?>', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    showToast(data.status, data.message);
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-floppy-disk"></i> Simpan Perubahan';
  })
  .catch(() => {
    showToast('error', 'Terjadi kesalahan. Coba lagi.');
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-floppy-disk"></i> Simpan Perubahan';
  });
}

/* ===== TOAST ===== */
function showToast(type, msg) {
  const toast = document.getElementById('toastNotif');
  const icon  = toast.querySelector('i');
  document.getElementById('toastMsg').innerText = msg;
  toast.className = 'toast-notif ' + type;
  icon.className  = type === 'success' ? 'fas fa-circle-check' : 'fas fa-circle-xmark';
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 3500);
}
</script>