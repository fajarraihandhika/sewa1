<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>General Dashboard — Stisla</title>

  <style>

@media print {
    /* ... (kode abang yang lain biarkan tetap ada) ... */

    /* Update bagian ini di dalam @media print abang */
    .table-responsive span.badge {
        display: inline !important;       /* Memaksa badge agar tidak hilang */
        background: transparent !important; /* Menghilangkan warna latar kotak/oval */
        border: none !important;           /* Menghilangkan garis border luar */
        border-radius: 0 !important;       /* Menghilangkan bentuk lengkungan/oval */
        box-shadow: none !important;       /* Menghilangkan bayangan jika ada */
        color: #000 !important;            /* Memastikan warna teks hitam pekat */
        padding: 0 !important;             /* Menghilangkan padding bawaan badge */
        font-size: 11px !important;        /* Menyesuaikan ukuran font tabel */
        font-weight: normal !important;    /* Biar teksnya tidak terlalu tebal */
    }
}


</style>

  <!-- General CSS Files -->
  <link rel="stylesheet"
  href="<?= base_url('assets/assets_admin/assets/modules/bootstrap/css/bootstrap.min.css') ?>">

  <link rel="stylesheet"
  href="<?= base_url('assets/assets_admin/assets/modules/fontawesome/css/all.min.css') ?>">

  <!-- Template CSS -->
  <link rel="stylesheet"
  href="<?= base_url('assets/assets_admin/assets/css/style.css') ?>">

  <link rel="stylesheet"
  href="<?= base_url('assets/assets_admin/assets/css/components.css') ?>">

  

</head>