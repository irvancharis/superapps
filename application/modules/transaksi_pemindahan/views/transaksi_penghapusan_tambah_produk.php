<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SAGROUP</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/components.css'); ?>">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('assets/img/Logo SA X7.ico'); ?>' />
    <!-- DataTable -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/datatables/datatables.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') ?>">
    <!-- Fancybox -->
    <script src="<?php echo base_url('assets/js/fancybox.umd.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fancybox.css'); ?>" />
    <!-- Toast -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/izitoast/css/iziToast.min.css'); ?>">

</head>

<body>
    <!-- Main Content -->
    <div class="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>INPUT PRODUK BARU</h4>
                            </div>
                            <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_TAMBAH_PRODUK">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>Nama Item</label>
                                            <input type="text" name="NAMA_ITEM" id="NAMA_ITEM" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Item !
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>Kategori</label>
                                            <select name="KODE_KATEGORI" class="form-control" id="KODE_KATEGORI">
                                                <option value="" class="text-center" selected disabled>-- Pilih Kategori --</option>
                                                <?php foreach ($get_kategori_produk as $row) : ?>
                                                    <option value="<?= $row->KODE_PRODUK_KATEGORI; ?>"><?= $row->NAMA_PRODUK_KATEGORI; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Masukkan Kategori !
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>Keterangan</label>
                                            <input type="text" name="KETERANGAN_ITEM" id="KETERANGAN_ITEM" class="form-control">
                                            <div class="valid-feedback">
                                                Masukkan Keterangan !
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6 col-lg-6 mb-0">
                                            <label>Foto</label>
                                            <input type="file" name="FOTO_ITEM" id="FOTO_ITEM" class="form-control">
                                            <div class="invalid-feedback">
                                                Masukkan Foto !
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->load->view('layout/footer'); ?>

</body>

<!-- Toast -->
<script src="<?php echo base_url('assets/bundles/izitoast/js/iziToast.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('#FORM_TRANSAKSI_PENGADAAN_TAMBAH_PRODUK').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url('produk_item/insert'); ?>',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        iziToast.success({
                            title: 'Success',
                            message: 'Data berhasil disimpan',
                            position: 'topRight'
                        });
                        $('#FORM_TRANSAKSI_PENGADAAN_TAMBAH_PRODUK')[0].reset();
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: 'Data gagal disimpan',
                            position: 'topRight'
                        });
                    }
                }
            });
        });
    });
</script>

</html>