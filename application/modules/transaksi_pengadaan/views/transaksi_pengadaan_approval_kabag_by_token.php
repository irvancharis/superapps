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

</head>

<body>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_APPROVAL_KABAG">
                    <div class="card-header">
                        <h4>APPROVAL KABAG - TRANSAKSI PENGADAAN</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th class="col-2" style="width: 20%">AREA</th>
                                    <td><?= $approval_kabag->NAMA_AREA; ?></td>
                                </tr>
                                <tr>
                                    <th>DEPARTEMEN</th>
                                    <td><?= $approval_kabag->NAMA_DEPARTEMEN; ?></td>
                                </tr>
                                <tr>
                                    <th>RUANGAN</th>
                                    <td><i class="fa fa-users"></i> <?= $approval_kabag->NAMA_RUANGAN; ?></td>
                                </tr>
                                <tr>
                                    <th>LOKASI</th>
                                    <td><i class="fa fa-box"></i> <?= $approval_kabag->NAMA_LOKASI; ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover " id="table-approval-produk">
                                <thead>
                                    <tr>
                                        <th>FOTO PRODUK</th>
                                        <th class="col-1">PRODUK/ITEM</th>
                                        <th class="col-1">JUMLAH</th>
                                        <th class="col-2">KEPERLUAN</th>
                                        <th class="col-1">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="selected-items-body">
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-12 col-md-12 col-lg-12">
                                <label>KETERANGAN</label><span
                                    class="text-danger float-right font-italic font-weight-600">*). Wajib Di
                                    Isi</span>
                                <textarea required name="KETERANGAN_PENGAJUAN" id="KETERANGAN_PENGAJUAN"
                                    placeholder="Masukkan keterangan pengajuan" class="form-control"
                                    rows="3"></textarea>
                                <div class="invalid-feedback">
                                    Silahkan masukkan KETERANGAN!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center row">
                        <!-- Tombol APPROVE & DISAPPROVE di tengah -->
                        <div class="col-12 col-md-8 col-lg-7 col-xl-7 mb-2 mb-md-0 text-md-right">
                            <button type="submit" class="btn btn-success mx-1" id="btn-approve">
                                <i class="fa fa-check"></i> APPROVE
                            </button>
                            <button type="button" class="btn btn-danger mx-1" id="btn-disapprove">
                                <i class="fa fa-times"></i> DISAPPROVE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>



    <?php $this->load->view('layout/footer'); ?>

    <script>
    window.onload = function() {
        if (window.innerHeight > window.innerWidth) {
            alert("Gunakan mode landscape untuk tampilan lebih baik.");
        }
    };


    $(document).ready(function() {

        $('#table-approval-produk').DataTable({
            paging: false,
            searching: false,
            sorting: false,
            ordering: false,
            info: false,
        });

        let idTransaksi = "<?php echo $id_transaksi_pengadaan; ?>"; // ID transaksi dari PHP

        function loadSelectedItems() {
            let selectedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];
            let tbody = $("#selected-items-body");
            tbody.empty();

            selectedItems.forEach(function(item, index) {
                tbody.append(`
                                <tr data-index="${index}">
                                    <input type="hidden" name="KODE_PRODUK_ITEM[${index}]" value="${item.id}">
                                    <td style="width: 100px;">
                                        <img style="width: 100px;" src="<?php echo base_url('assets/uploads/item/'); ?>${item.foto}" alt="">
                                    </td>
                                    <td>${item.nama}</td>
                                    <td class="text-center"><input type="number" class="form-control jumlah" name="JUMLAH_PENGADAAN[${index}]" value="${item.jumlah || ''}"></td>
                                    <td class="text-center"><input type="text" class="form-control keperluan" name="KEPERLUAN[${index}]" value="${item.keperluan || ''}"></td>
                                    <td class="text-center"><button class="btn btn-danger remove-item" data-index="${index}">Hapus</button></td>
                                </tr>
                            `);
            });
            attachInputListeners();

            // Initialize Chocolate JS
            if (jQuery().Chocolat) {
                $(".gallery").Chocolat({
                    className: 'gallery',
                    imageSelector: '.gallery-item',
                    imageSize: 'contain', // Menyesuaikan gambar agar pas dalam layar
                    fullScreen: false, // Tidak otomatis fullscreen
                    backgroundColor: 'rgba(0,0,0,0.9)', // Background gelap
                });
            }
        }

        function loadDataFromDB() {
            // Cek apakah sudah ada flag bahwa data sudah di-load dari DB
            if (sessionStorage.getItem("dbDataLoaded")) {
                console.log("Data dari database sudah dimuat sebelumnya. Skip pengambilan ulang.");
                loadSelectedItems();
                return;
            }

            $.ajax({
                url: "<?php echo base_url(); ?>transaksi_pengadaan/get_data_transaksi_detail/" +
                    idTransaksi,
                type: "GET",
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        let storedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];
                        let dbItems = res.data.map(item => ({
                            id: item.KODE_PRODUK_ITEM,
                            nama: item.NAMA_ITEM,
                            jumlah: item.JUMLAH_PENGADAAN,
                            keperluan: item.KEPERLUAN,
                            foto: item.FOTO_ITEM
                        }));

                        // Gabungkan data, tetapi hanya simpan yang tidak duplikat
                        let mergedItems = [...dbItems, ...storedItems].reduce((acc, curr) => {
                            if (!acc.some(item => item.id === curr.id)) {
                                acc.push(curr);
                            }
                            return acc;
                        }, []);

                        localStorage.setItem("selectedItems", JSON.stringify(mergedItems));

                        // Tandai bahwa data dari database sudah dimasukkan ke localStorage
                        sessionStorage.setItem("dbDataLoaded", "true");

                        loadSelectedItems();
                    }
                }
            });
        }

        loadDataFromDB();

        // Fungsi untuk menangani input perubahan data
        function attachInputListeners() {
            $('.jumlah, .keperluan').on('input', function() {
                let rowIndex = $(this).closest('tr').data('index');
                let fieldName = $(this).hasClass('jumlah') ? 'jumlah' : 'keperluan';

                let selectedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];
                selectedItems[rowIndex][fieldName] = $(this).val();
                localStorage.setItem('selectedItems', JSON.stringify(selectedItems));
            });
        }

        // Simpan data ketika input KETERANGAN_PENGAJUAN berubah
        $('#KETERANGAN_PENGAJUAN').on('change', function() {
            saveFormData();
        });

        // Form Data Save to Local Storage
        function saveFormData() {
            let formData = {
                KETERANGAN_PENGAJUAN: $('#KETERANGAN_PENGAJUAN').val()
            };

            localStorage.setItem('formPengadaan', JSON.stringify(formData));
        }

        // Fungsi untuk menghapus data dari localStorage
        $('#selected-items-body').on('click', '.remove-item', function() {
            var index = $(this).data("index");
            let selectedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];
            selectedItems.splice(index, 1);
            localStorage.setItem("selectedItems", JSON.stringify(selectedItems));
            loadSelectedItems();
        });

        // Update data ke database
        $('#FORM_TRANSAKSI_PENGADAAN_APPROVAL_KABAG').on('submit', function(e) {
            e.preventDefault();

            let selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];
            let formData = JSON.parse(localStorage.getItem('formPengadaan')) || {};

            if (selectedItems.length == 0) {
                swal('Error', 'Tidak ada produk yang dipilih.', 'error');
                return;
            }

            if (!formData.KETERANGAN_PENGAJUAN) {
                swal('Error', 'Lengkapi Keterangan Pengajuan.', 'error');
                return;
            }

            // Kirim data untuk update
            $.ajax({
                url: "<?php echo base_url(); ?>transaksi_pengadaan/update_approval_kabag", // Ubah menjadi update
                type: "POST",
                data: {
                    id_transaksi: idTransaksi, // Kirim ID transaksi agar dapat diupdate
                    items: selectedItems,
                    form: formData,
                    token: '<?php echo $this->uri->segment(3); ?>'
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        swal('Sukses', 'Pengajuan Pengadaan Di Setujui!', 'success').then(
                            function() {
                                localStorage.removeItem(
                                    'selectedItems'
                                ); // Hapus localStorage setelah disimpan
                                localStorage.removeItem(
                                    'formPengadaan'
                                ); // Hapus localStorage setelah disimpan
                                sessionStorage.removeItem(
                                    "dbDataLoaded"
                                ); // Hapus localStorage setelah disimpan
                                window.location.replace("about:blank");
                            });
                    } else {
                        swal('Gagal', res.error, 'error');
                    }
                },
                error: function() {
                    swal('Error', 'Terjadi kesalahan pada server.', 'error');
                }
            });
        });

        // Kirim data untuk disapprove
        $('#btn-disapprove').on('click', function() {
            swal({
                title: 'Masukkan Keterangan Cancel',
                content: {
                    element: 'input',
                    attributes: {
                        placeholder: 'Keterangan',
                        type: 'text',
                    },
                },
            }).then((data) => {
                // swal('Keterangan Cancel :  ' + data + '!');
                let selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];
                $.ajax({
                    url: "<?php echo base_url(); ?>transaksi_pengadaan/disapprove_kabag/",
                    type: "POST",
                    data: {
                        id_transaksi: idTransaksi,
                        KETERANGAN_CANCEL_KABAG: data,
                        items: selectedItems
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            swal('Sukses', 'Pengajuan Pengadaan Berhasil Ditolak!',
                                'success').then(function() {
                                localStorage.removeItem(
                                    'selectedItems'
                                ); // Hapus localStorage setelah disimpan
                                sessionStorage.removeItem(
                                    "dbDataLoaded"
                                ); // Hapus localStorage setelah disimpan
                                window.location.replace("about:blank");
                            });
                        } else {
                            swal('Gagal', res.error, 'error');
                        }
                    }
                })
            });
        });
    });

    // Hapus semua data localStorage & sessionStorage ketika user meninggalkan halaman
    $(window).on('beforeunload', function() {
        localStorage.clear(); // Hapus semua data localStorage
        sessionStorage.clear(); // Hapus semua data sessionStorage
    });
    </script>
</body>

<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>