<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akses Ditolak</title>
 <link rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>">
  <style>
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>
  <div class="text-center">
    <h1 class="display-4 text-danger">Anda Tidak Memiliki Akses</h1>
    <p class="lead">Mohon hubungi administrator untuk informasi lebih lanjut.</p>
    <button onclick="history.back()" class="btn btn-primary mt-3">Kembali ke Halaman Sebelumnya</button>
  </div>
</body>
</html>