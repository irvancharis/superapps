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
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_APPROVAL_GM">
                <div class="card-header">
                    <h4>APPROVAL GENERAL MANAGER - TRANSAKSI PENGADAAN</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        </h6>
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th class="col-2" style="width: 20%">AREA</th>
                                <td><?= $approval_gm->NAMA_AREA; ?></td>
                            </tr>
                            <tr>
                                <th>DEPARTEMEN</th>
                                <td><?= $approval_gm->NAMA_DEPARTEMEN; ?></td>
                            </tr>
                            <tr>
                                <th>RUANGAN</th>
                                <td><?= $approval_gm->NAMA_RUANGAN; ?></td>
                            </tr>
                            <tr>
                                <th>LOKASI</th>
                                <td><?= $approval_gm->NAMA_LOKASI; ?></td>
                            </tr>
                            <tr>
                                <th>KETERANGAN PENGAJUAN</th>
                                <td><?= $approval_gm->KETERANGAN_PENGAJUAN; ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm " id="table-approval-produk">
                            <thead>
                                <tr>
                                    <th>FOTO PRODUK</th>
                                    <th >PRODUK/ITEM</th>
                                    <th class="text-center">JUMLAH</th>
                                    <th >KEPERLUAN</th>
                                </tr>
                            </thead>
                            <tbody id="selected-items-body">
                                <?php
                                        foreach ($item as $item) {
                                            echo '<tr >';
                                            echo '<td class="text-left" style="width: 3%;"><img style="width: 100px;" src="' . base_url('assets/uploads/item/' . $item->FOTO_ITEM) . '"  alt="Foto Produk"></td>';
                                            echo '<td class="text-left col-2">' . $item->NAMA_ITEM . '</td>';
                                            echo '<td class="text-center col-1">' . $item->JUMLAH_PENGADAAN . '</td>';
                                            echo '<td class="text-left col-3">' . $item->KEPERLUAN . '</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
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
    </div>


    <?php $this->load->view('layout/footer'); ?>

    <script>
    window.onload = function() {
        if (window.innerHeight > window.innerWidth) {
            alert("Gunakan mode landscape untuk tampilan lebih baik.");
        }
    };


    $(document).ready(function() {

        let idTransaksi = "<?php echo $id_transaksi_pengadaan; ?>";

        function loadDataFromDB() {

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
                    }
                }
            });
        }

        loadDataFromDB();

        $('#table-approval-produk').DataTable({
            paging: false,
            searching: false,
            sorting: false,
            ordering: false,
            info: false,
            responsive: {
                details: {
                    type: 'column',
                    display: $.fn.dataTable.Responsive.display
                        .childRowImmediate, // Menampilkan detail langsung                
                }
            }
        });

        // Update data ke database
        $('#FORM_TRANSAKSI_PENGADAAN_APPROVAL_GM').on('submit', function(e) {
            e.preventDefault();

            let selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];

            if (selectedItems.length == 0) {
                swal('Error', 'Tidak ada produk yang dipilih.', 'error');
                return;
            }

            // Kirim data untuk update
            $.ajax({
                url: "<?php echo base_url(); ?>transaksi_pengadaan/update_approval_gm", // Ubah menjadi update
                type: "POST",
                data: {
                    id_transaksi: idTransaksi, // Kirim ID transaksi agar dapat diupdate
                    items: selectedItems,
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
                    element: 'textarea',
                    attributes: {
                        placeholder: 'Keterangan',
                        id: 'KETERANGAN_CANCEL_GM',
                    },
                },
            }).then((data) => {
                // swal('Keterangan Cancel :  ' + $('#KETERANGAN_CANCEL_GM').val() + '!');
                let selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];
                $.ajax({
                    url: "<?php echo base_url(); ?>transaksi_pengadaan/disapprove_gm/",
                    type: "POST",
                    data: {
                        id_transaksi: idTransaksi,
                        KETERANGAN_CANCEL_GM: $('#KETERANGAN_CANCEL_GM').val(),
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