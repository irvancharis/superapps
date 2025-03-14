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
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> -->

</head>

<body>
    <!-- Main Content -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>PENCARIAN PRODUK</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-produk">
                                <thead>
                                    <tr>
                                        <th class="text-center pt-3">
                                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                                <input required type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                    class="custom-control-input" id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>#</th>
                                        <th>KODE PRODUK</th>
                                        <th>NAMA PRODUK</th>
                                        <th>KATEGORI</th>
                                        <th>FOTO ITEM</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/footer'); ?>

</body>

<!-- Bootstrap -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- Toast -->
<script src="<?php echo base_url('assets/bundles/izitoast/js/iziToast.min.js') ?>"></script>
<script>
    $(document).ready(function() {

        var storedProdukItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];
        var filterData = {}; // Variabel untuk menyimpan data filter

        // Menerima data filter dari parent window
        // window.addEventListener("message", function(event) {
        //     console.log('Menerima pesan dari parent window:', event.data);

        //     if (event.data.action === 'applyFilter') {
        //         filterData = event.data.data;
        //         console.log('Filter diterima:', filterData);
        //         alert('Filter diterima!');

        //         // Reload DataTables dengan data filter baru
        //         $('#table-produk').DataTable().ajax.reload();
        //     }
        // }, false);

        var table = $('#table-produk').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            ajax: {
                url: "<?php echo base_url() . 'transaksi_penghapusan/get_produk'; ?>",
                type: "POST",
                data: function(d) {
                    // Ambil data filter dari localStorage
                    var filter = JSON.parse(localStorage.getItem('filterProdukItems')) || {};

                    // Hanya load data jika ada pencarian atau filter tersedia
                    if (d.search.value === "" && (!filter.AREA || !filter.DEPARTEMEN || !filter.RUANGAN || !filter.LOKASI)) {
                        return false;
                    }

                    // Tambahkan data filter ke parameter ajax
                    d.area = filter.AREA || "";
                    d.departemen = filter.DEPARTEMEN || "";
                    d.ruangan = filter.RUANGAN || "";
                    d.lokasi = filter.LOKASI || "";
                    return d;
                }
            },
            deferLoading: 0, // Jangan load data saat pertama kali halaman dibuka
            searchDelay: 500, // Tunggu 500ms sebelum request (mengurangi load server)
            lengthChange: false, // Sembunyikan dropdown jumlah data
            pageLength: 10,
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return `
                    <div class="custom-checkbox custom-control">
                        <input required type="checkbox" data-checkboxes="mygroup" class="custom-control-input">
                        <label class="custom-control-label">&nbsp;</label>
                    </div>
                `;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Auto increment nomor urut
                    }
                },
                {
                    data: "KODE_ITEM"
                },
                {
                    data: "NAMA_PRODUK"
                },
                {
                    data: "NAMA_PRODUK_KATEGORI"
                },
                {
                    data: "FOTO_ITEM",
                    render: function(data, type, row, meta) {
                        return `<img width="100px" src="<?php echo base_url('assets/uploads/item/') ?>${data}" alt="">`;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<a href="javascript:void(0);" class="btn btn-primary btn-round has-icon view-btn add-item" 
                        data-id="${row.KODE_ITEM}" 
                        data-nama="${row.NAMA_PRODUK}" 
                        data-kategori="${row.NAMA_PRODUK_KATEGORI}"
                        data-foto="${row.FOTO_ITEM}"
                        data-stok="${row.JUMLAH_STOK}"
                        >
                        <i class="fas fa-plus"></i></a>`;
                    }
                }
            ]
        });

        // Trigger reload DataTables jika filter di localStorage berubah
        window.addEventListener("storage", function() {
            table.ajax.reload();
        });

        // Event ketika user mengetik di kolom pencarian
        $('#table-produk_filter input').unbind().on('keyup', function() {
            let value = $(this).val();
            let xvalue = value.toUpperCase();
            if (xvalue.length > 1) {
                table.search(xvalue).draw();
            }
        });

        // Event listener untuk menambahkan item ke Local Storage
        $('#table-produk').on('click', '.add-item', function() {
            var item = {
                id: $(this).data("id"),
                NAMA_PRODUK: $(this).data("nama"),
                JUMLAH_STOK: $(this).data("kategori"),
                FOTO_ITEM: $(this).data("foto")
            };

            // Cek apakah item sudah ada
            var exists = storedProdukItems.some(i => i.id === item.id);
            if (!exists) {
                storedProdukItems.push(item);
                localStorage.setItem("storedProdukItems", JSON.stringify(storedProdukItems));
                iziToast.success({
                    title: 'Sukses!',
                    message: 'Berhasil menambahkan item ke daftar.',
                    position: 'topRight'
                });
                // Kirim event ke parent window untuk update tabel
                window.parent.postMessage({
                    action: 'updateTable'
                }, '*');
            } else {
                iziToast.warning({
                    title: 'Gagal!',
                    message: 'Data sudah ada.',
                    position: 'topRight'
                });
            }
        });
    });
</script>

</html>