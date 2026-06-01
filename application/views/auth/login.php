<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar — DriveEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    /* ===================== ROOT — DriveEase Warm Pastel ===================== */
    :root {
      --primary:      #C1714A;   /* terracotta / salmon — warna aksen utama */
      --primary-dark: #A85A35;   /* terracotta gelap untuk hover */
      --primary-light:#F2E0D5;   /* blush muda untuk background aksen */
      --success:      #6A9E72;   /* hijau sage — selaras dengan palet hangat */
      --success-light:#DFF0E1;
      --danger:       #C0504A;   /* merah bata, tidak terlalu mencolok */
      --text:         #2C1A0E;   /* coklat tua — sesuai halaman utama */
      --text-soft:    #8C7060;   /* coklat muda / tan */
      --border:       #E8D8CC;   /* border hangat, bukan abu-abu dingin */
      --bg:           #F5EDE3;   /* krem/peach — sama persis halaman utama */
      --card:         #FFFAF6;   /* putih hangat untuk card */
      --radius:       12px;
    }

    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'DM Sans', 'Segoe UI', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
    }

    /* ---- Layout ---- */
    .page-wrapper   { display: flex; min-height: 100vh; }
    .right-panel    { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 24px; }
    .form-container {
      width: 100%; max-width: 560px;
      background: var(--card);
      border-radius: 24px;
      padding: 40px 36px;
      box-shadow: 0 8px 40px rgba(44, 26, 14, .10);
      border: 1px solid var(--border);
    }

    /* ---- Header ---- */
    .form-header    { text-align: center; margin-bottom: 28px; }
    .form-header h2 {
      font-family: 'DM Serif Display', Georgia, serif;
      font-size: 1.9rem; font-weight: 400;
      color: var(--text); margin-bottom: 6px;
    }
    .form-header p  { color: var(--text-soft); font-size: .93rem; }

    /* ---- Logo pill ---- */
    .form-logo {
      display: inline-flex; align-items: center; gap: 6px;
      background: var(--primary-light); border-radius: 40px;
      padding: 6px 14px; margin-bottom: 16px;
      font-size: .8rem; font-weight: 600; color: var(--primary);
      letter-spacing: .03em;
    }
    .form-logo span { width: 8px; height: 8px; border-radius: 50%; background: var(--primary); display: inline-block; }

    /* ---- Stepper ---- */
    .stepper        { display: flex; align-items: center; justify-content: center; gap: 0; margin-bottom: 32px; }
    .step-item      { display: flex; flex-direction: column; align-items: center; gap: 6px; flex: 1; position: relative; }
    .step-circle    {
      width: 36px; height: 36px; border-radius: 50%;
      border: 2px solid var(--border);
      background: var(--card);
      display: flex; align-items: center; justify-content: center;
      font-size: .8rem; font-weight: 600; color: var(--text-soft);
      transition: all .3s; z-index: 1;
    }
    .step-item.active .step-circle { border-color: var(--primary); background: var(--primary); color: #fff; }
    .step-item.done   .step-circle { border-color: var(--success); background: var(--success); color: #fff; }
    .step-label     { font-size: .72rem; color: var(--text-soft); text-align: center; }
    .step-item.active .step-label { color: var(--primary); font-weight: 600; }
    .step-item.done   .step-label { color: var(--success); }
    .step-line      { flex: 1; height: 2px; background: var(--border); margin-top: -22px; }
    .step-line.done { background: var(--success); }

    /* ---- Fields ---- */
    .field-group  { margin-bottom: 18px; }
    .field-label  {
      display: block; font-size: .78rem; font-weight: 600;
      text-transform: uppercase; letter-spacing: .06em;
      color: var(--text-soft); margin-bottom: 6px;
    }
    .field-wrap   { position: relative; }
    .field-input  {
      width: 100%; height: 48px; padding: 0 44px 0 44px;
      border: 1.5px solid var(--border); border-radius: var(--radius);
      font-size: .95rem; font-family: inherit;
      background: var(--bg); color: var(--text);
      transition: border .2s, background .2s; outline: none;
    }
    .field-input::placeholder { color: #C0A898; }
    .field-input:focus        { border-color: var(--primary); background: var(--card); box-shadow: 0 0 0 3px var(--primary-light); }
    .field-input.no-icon      { padding-left: 16px; }
    textarea.field-input      { height: 90px; padding-top: 12px; resize: none; }
    .field-icon   { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-soft); font-size: .85rem; pointer-events: none; }
    .field-check  { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); font-size: .9rem; }
    .field-error  { font-size: .8rem; color: var(--danger); margin-top: 4px; display: none; }
    .field-hint   { font-size: .78rem; color: var(--text-soft); margin-top: 4px; }
    .field-row    { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    /* ---- Password toggle ---- */
    .pwd-toggle { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-soft); font-size: .85rem; padding: 0; }
    .pwd-toggle:hover { color: var(--primary); }

    /* ---- Password strength ---- */
    .pwd-strength { margin-top: 8px; }
    .strength-bars { display: flex; gap: 4px; margin-bottom: 4px; }
    .strength-bar  { flex: 1; height: 4px; border-radius: 4px; background: var(--border); transition: background .3s; }
    .strength-label { font-size: .78rem; color: var(--text-soft); }

    /* ---- Checkbox custom ---- */
    .custom-check { display: flex; align-items: flex-start; gap: 10px; }
    .check-box    {
      width: 20px; height: 20px; min-width: 20px; border-radius: 6px;
      border: 1.5px solid var(--border); background: var(--bg);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; transition: all .2s;
    }
    .check-box i  { font-size: .7rem; color: transparent; }
    .check-box.checked { background: var(--primary); border-color: var(--primary); }
    .check-box.checked i { color: #fff; }
    .check-text   { font-size: .88rem; line-height: 1.5; color: var(--text-soft); }
    .check-text a { color: var(--primary); text-decoration: none; font-weight: 500; }
    .check-text a:hover { text-decoration: underline; }

    /* ---- Photo upload ---- */
    .photo-upload {
      border: 1.5px dashed var(--border); border-radius: var(--radius);
      padding: 20px; text-align: center; cursor: pointer;
      position: relative; transition: border-color .2s, background .2s;
      background: var(--bg);
    }
    .photo-upload:hover { border-color: var(--primary); background: var(--primary-light); }
    .photo-upload input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
    .photo-upload-icon { font-size: 1.6rem; color: var(--primary); margin-bottom: 8px; }
    .photo-upload-text { font-size: .85rem; color: var(--text-soft); line-height: 1.5; }
    .photo-upload-text span { color: var(--primary); font-weight: 600; }

    /* ---- Buttons ---- */
    .btn-next, .btn-submit {
      width: 100%; height: 50px; border: none; border-radius: var(--radius);
      background: var(--primary); color: #fff; font-size: .97rem; font-weight: 600;
      font-family: inherit; cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      transition: background .2s, transform .1s; margin-bottom: 10px;
      letter-spacing: .01em;
    }
    .btn-next:hover    { background: var(--primary-dark); }
    .btn-next:active, .btn-submit:active { transform: scale(.98); }
    .btn-submit        { background: var(--success); }
    .btn-submit:hover  { background: #568A5E; }
    .btn-back {
      width: 100%; height: 44px;
      border: 1.5px solid var(--border); border-radius: var(--radius);
      background: var(--card); color: var(--text-soft);
      font-size: .9rem; font-weight: 500; font-family: inherit;
      cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
      transition: border-color .2s, color .2s;
    }
    .btn-back:hover { border-color: var(--primary); color: var(--primary); }

    /* ---- Section divider ---- */
    .section-divider { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
    .section-divider-line { flex: 1; height: 1px; background: var(--border); }
    .section-divider-text {
      font-size: .75rem; font-weight: 600;
      text-transform: uppercase; letter-spacing: .07em;
      color: var(--text-soft); white-space: nowrap;
    }

    /* ---- Step content ---- */
    .step-content        { display: none; }
    .step-content.active { display: block; }

    /* ---- Overlay loading ---- */
    #loadingOverlay {
      display: none; position: fixed; inset: 0;
      background: rgba(44, 26, 14, .5); z-index: 9999;
      align-items: center; justify-content: center; flex-direction: column; gap: 16px;
    }
    #loadingOverlay.show { display: flex; }
    .spinner { width: 48px; height: 48px; border: 4px solid rgba(255,255,255,.3); border-top-color: #fff; border-radius: 50%; animation: spin .8s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }
    #loadingOverlay p { color: #fff; font-size: .95rem; }

    /* ---- Toast ---- */
    #toast {
      position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%) translateY(20px);
      background: var(--text); color: #fff; padding: 12px 24px; border-radius: 40px;
      font-size: .9rem; opacity: 0; pointer-events: none; transition: all .3s; z-index: 9999;
    }
    #toast.show          { opacity: 1; transform: translateX(-50%) translateY(0); }
    #toast.success-toast { background: var(--success); }
    #toast.error-toast   { background: var(--danger); }

    /* ---- Success screen ---- */
    .success-screen { display: none; text-align: center; padding: 20px 0; }
    .success-circle {
      width: 80px; height: 80px; border-radius: 50%;
      background: var(--success-light);
      display: flex; align-items: center; justify-content: center;
      font-size: 2rem; color: var(--success); margin: 0 auto 20px;
    }
    .success-title { font-family: 'DM Serif Display', Georgia, serif; font-size: 1.6rem; font-weight: 400; margin-bottom: 10px; color: var(--text); }
    .success-sub   { color: var(--text-soft); font-size: .93rem; line-height: 1.6; margin-bottom: 24px; }
    .btn-go-login  {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--primary); color: #fff;
      padding: 14px 32px; border-radius: var(--radius);
      border: none; font-size: 1rem; font-weight: 600;
      font-family: inherit; cursor: pointer; text-decoration: none;
      transition: background .2s;
    }
    .btn-go-login:hover { background: var(--primary-dark); }

    .select-arrow { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-soft); pointer-events: none; font-size: .8rem; }
    select.field-input { appearance: none; }

    .d-grid { display: grid; }
    .gap-2  { gap: 8px; }
  </style>
</head>


<body>

<!-- ================= LOADING ================= -->
<div id="loadingOverlay">
  <div class="spinner"></div>
  <p>Memproses login...</p>
</div>

<!-- ================= TOAST ================= -->
<div id="toast"></div>

<!-- ================= PAGE ================= -->
<div class="page-wrapper">
  <div class="right-panel">

    <div class="form-container">

      <!-- ================= HEADER ================= -->
      <div class="form-header">

        <div class="form-logo">
          <span></span> DriveEase
        </div>

        <h2>Login Akun</h2>

        <p>
          Masuk untuk mulai menyewa kendaraan favorit Anda
        </p>

      </div>

      <!-- ================= FORM ================= -->
      <form id="loginForm" method="POST">

        <!-- ================= EMAIL ================= -->
        <div class="field-group">

          <label class="field-label">
            Alamat Email
          </label>

          <div class="field-wrap">

            <input
              type="email"
              class="field-input"
              id="email"
              name="email"
              placeholder="Masukkan email"
              required
            >

            <i class="fas fa-envelope field-icon"></i>

          </div>

        </div>

        <!-- ================= PASSWORD ================= -->
        <div class="field-group">

          <label class="field-label">
            Password
          </label>

          <div class="field-wrap">

            <input
              type="password"
              class="field-input"
              id="password"
              name="password"
              placeholder="Masukkan password"
              required
            >

            <i class="fas fa-lock field-icon"></i>

            <button
              type="button"
              class="pwd-toggle"
              onclick="togglePwd()"
            >
              <i class="fas fa-eye"></i>
            </button>

          </div>

        </div>

        <!-- ================= REMEMBER ================= -->
        <div class="field-group">

          <div class="custom-check">

            <div
              class="check-box"
              id="rememberCheck"
              onclick="toggleCheck('rememberCheck')"
            >
              <i class="fas fa-check"></i>
            </div>

            <div class="check-text">
              Ingat saya
            </div>

          </div>

        </div>

        <!-- ================= BUTTON ================= -->
        <button
          type="submit"
          class="btn-next"
          id="btnLogin"
        >
          Login
        </button>

      </form>

      <!-- ================= REGISTER LINK ================= -->
      <div class="login-link">

        Belum punya akun?

        <a href="<?= base_url('auth/register') ?>">
          Daftar sekarang
        </a>

      </div>

    </div>

  </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>

const BASE_URL  = '<?= base_url() ?>';
const URL_LOGIN = BASE_URL + 'auth/login_process';

const checks = {};


// =====================================================
// LOGIN SUBMIT
// =====================================================
document
.getElementById('loginForm')
.addEventListener('submit', function(e){

    e.preventDefault();

    const email =
    document.getElementById('email').value.trim();

    const password =
    document.getElementById('password').value;

    // VALIDASI
    if(email == ''){

        showToast('Email wajib diisi', 'error');
        return;

    }

    if(password == ''){

        showToast('Password wajib diisi', 'error');
        return;

    }

    // LOADING
    document
    .getElementById('loadingOverlay')
    .classList.add('show');

    // FORM DATA
    const fd = new FormData();

    fd.append('email', email);
    fd.append('password', password);

    // FETCH
    fetch(URL_LOGIN, {

        method:'POST',
        body:fd

    })

    .then(res => res.json())

    .then(data => {

        document
        .getElementById('loadingOverlay')
        .classList.remove('show');

        if(data.status == 'success'){

            showToast('Login berhasil', 'success');

            setTimeout(() => {

                window.location.href =
                data.redirect;

            }, 1200);

        } else {

            showToast(data.message, 'error');

        }

    })

    .catch((err) => {

        console.log(err);

        document
        .getElementById('loadingOverlay')
        .classList.remove('show');

        showToast('Terjadi kesalahan server', 'error');

    });

});


// =====================================================
// TOGGLE PASSWORD
// =====================================================
function togglePwd(){

    const input =
    document.getElementById('password');

    const icon =
    document.querySelector('.pwd-toggle i');

    if(input.type == 'password'){

        input.type = 'text';
        icon.className = 'fas fa-eye-slash';

    } else {

        input.type = 'password';
        icon.className = 'fas fa-eye';

    }

}


// =====================================================
// CHECKBOX
// =====================================================
function toggleCheck(id){

    checks[id] = !checks[id];

    document
    .getElementById(id)
    .classList.toggle('checked', checks[id]);

}


// =====================================================
// TOAST
// =====================================================
function showToast(msg, type){

    const t = document.getElementById('toast');

    t.textContent = msg;

    t.className =
    'show ' +
    (
      type == 'error'
      ? 'error-toast'
      : 'success-toast'
    );

    setTimeout(() => {

        t.className = '';

    }, 3000);

}

</script>

</body>
</html>