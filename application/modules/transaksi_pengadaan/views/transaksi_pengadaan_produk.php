<!DOCTYPE html>
<html lang="en">
<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SAGROUP</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/chocolat/dist/css/chocolat.css'); ?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/components.css'); ?>">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('assets/img/Logo SA X7.ico'); ?>' />
    <!-- DataTable -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/datatables/datatables.min.css') ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') ?>">
    <!-- Fancybox -->
    <script src="<?php echo base_url('assets/js/fancybox.umd.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fancybox.css'); ?>" />
    <!-- Toast -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/izitoast/css/iziToast.min.css'); ?>">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> -->


    <div class="card">
        <div class="card-header">
            <h4>PENCARIAN PRODUK</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-produk">
                    <thead>
                        <tr>
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

    <?php $this->load->view('layout/footer'); ?>

    <script>
    $(document).ready(function() {

        var selectedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];

        var table = $('#table-produk').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            ajax: {
                url: "<?php echo base_url() . 'transaksi_pengadaan/get_produk'; ?>",
                type: "POST",
                data: function(d) {
                    if (d.search.value == "") {
                        return false; // Jangan load data jika tidak ada pencarian
                    }
                    return d;
                }
            },
            deferLoading: 0, // Jangan load data saat pertama kali halaman dibuka
            searchDelay: 500, // Tunggu 500ms sebelum request (mengurangi load server)
            lengthChange: false, // Sembunyikan dropdown jumlah data
            pageLength: 10,
            columns: [{
                    data: "KODE_ITEM"
                },
                {
                    data: "NAMA_ITEM"
                },
                {
                    data: "NAMA_PRODUK_KATEGORI"
                },
                {
                    data: "FOTO_ITEM",
                    render: function(data, type, row, meta) {
                        return `
                            <div class="gallery">
                                <a class="gallery-item m-0 p-2 d-flex justify-content-center align-items-center w-100" 
                                style="max-width: 200px;"
                                href="<?php echo base_url('assets/uploads/item/') ?>${data}" 
                                data-image="<?php echo base_url('assets/uploads/item/') ?>${data}" 
                                data-title="${row.NAMA_ITEM}">
                                
                                    <img class="img-fluid" 
                                        src="<?php echo base_url('assets/uploads/item/'); ?>${data}" 
                                        alt="${row.NAMA_ITEM}" 
                                        style="max-width: 100%; height: 50px;"> 
                                </a>
                            </div>
                        `;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<a href="javascript:void(0);" class="btn btn-primary btn-round has-icon view-btn add-item" 
                        data-id="${row.KODE_ITEM}" 
                        data-nama="${row.NAMA_ITEM}" 
                        data-kategori="${row.NAMA_PRODUK_KATEGORI}"
                        data-foto="${row.FOTO_ITEM}"
                        >
                        <i class="fas fa-plus"></i></a>`;
                    }
                }
            ]
        });

        // 🔥 Inisialisasi Ulang Chocolat Setiap Kali DataTable Render (draw.dt event)
        $('#table-produk').on('draw.dt', function() {
            if (jQuery().Chocolat) {
                $(".gallery").Chocolat({
                    className: 'gallery',
                    imageSelector: '.gallery-item',
                    imageSize: 'contain',
                    fullScreen: false,
                    backgroundColor: 'rgba(0,0,0,0.9)',
                });
            }
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
                nama: $(this).data("nama"),
                kategori: $(this).data("kategori"),
                foto: $(this).data("foto")
            };

            // Cek apakah item sudah ada
            var exists = selectedItems.some(i => i.id === item.id);
            if (!exists) {
                selectedItems.push(item);
                localStorage.setItem("selectedItems", JSON.stringify(selectedItems));
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
    </body>

</html>