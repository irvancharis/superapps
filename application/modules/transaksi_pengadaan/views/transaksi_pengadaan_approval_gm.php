            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_APPROVAL_GM">
                                    <div class="card-header">
                                        <h4>APPROVAL GENERAL MANAGER TRANSAKSI PENGADAAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select disabled name="AREA_PENEMPATAN" id="AREA_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" disabled>-- Pilih Area --</option>
                                                    <?php foreach ($get_area as $row) : ?>
                                                        <option value="<?= $row->KODE_AREA; ?>" <?= $row->KODE_AREA == $approval_gm->KODE_AREA_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_AREA; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AREA!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DEPARTEMEN</label>
                                                <select disabled name="DEPARTEMEN_PENGAJUAN" id="DEPARTEMEN_PENGAJUAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Departement --</option>
                                                    <?php foreach ($get_departemen as $row) : ?>
                                                        <option value="<?= $row->KODE_DEPARTEMEN; ?>" <?= $row->KODE_DEPARTEMEN == $approval_gm->KODE_DEPARTEMEN_PENGAJUAN ? "selected" : ""; ?>><?= $row->NAMA_DEPARTEMEN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan DEPARTEMENT!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>RUANGAN</label>
                                                <select disabled name="RUANGAN_PENEMPATAN" id="RUANGAN_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Ruangan --</option>
                                                    <?php foreach ($get_ruangan as $row) : ?>
                                                        <option value="<?= $row->KODE_RUANGAN; ?>" <?= $row->KODE_RUANGAN == $approval_gm->KODE_RUANGAN_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_RUANGAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan RUANGAN!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>LOKASI</label>
                                                <select disabled name="LOKASI_PENEMPATAN" id="LOKASI_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Lokasi --</option>
                                                    <?php foreach ($get_lokasi as $row) : ?>
                                                        <option value="<?= $row->KODE_LOKASI; ?>" <?= $row->KODE_LOKASI == $approval_gm->KODE_LOKASI_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_LOKASI; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan LOKASI!
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <tr>
                                                    <th class="col-2">AREA</th>
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
                                            <table class="table table-striped table-sm " id="table-approval-produk">
                                                <thead>
                                                    <tr>
                                                        <th class="col-2">FOTO PRODUK</th>
                                                        <th>PRODUK/ITEM</th>
                                                        <th class="col-1">JUMLAH</th>
                                                        <th class="col-3">KEPERLUAN</th>
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
                                        <!-- <div class="row mt-3">
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>KETERANGAN PENGAJUAN</label>
                                                <textarea disabled name="KETERANGAN_PENGAJUAN" id="KETERANGAN_PENGAJUAN" placeholder="Masukkan keterangan pengajuan" class="form-control" rows="3"><?= $approval_gm->KETERANGAN_PENGAJUAN; ?></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan KETERANGAN!
                                                </div>
                                            </div>
                                        </div> -->
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
                </section>
            </div>


            <?php $this->load->view('layout/footer'); ?>

            <script>
                $(document).ready(function() {
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

                    let idTransaksi = "<?php echo $id_transaksi_pengadaan; ?>"; // ID transaksi dari PHP



                    function loadDataFromDB() {
                        // Cek apakah sudah ada flag bahwa data sudah di-load dari DB
                        if (sessionStorage.getItem("dbDataLoaded")) {
                            console.log("Data dari database sudah dimuat sebelumnya. Skip pengambilan ulang.");
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

                    // Update data ke database
                    $('#FORM_TRANSAKSI_PENGADAAN_APPROVAL_GM').on('submit', function(e) {
                        e.preventDefault();

                        swal({
                            title: 'KONFIRMASI',
                            text: 'Yakin Ingin Disetujui?',
                            icon: 'warning',
                            buttons: {
                                cancel: {
                                    text: 'Tidak',
                                    value: false,
                                    visible: true,
                                    closeModal: true
                                },
                                confirm: {
                                    text: 'Ya',
                                    value: true,
                                    visible: true,
                                    closeModal: true
                                }
                            },
                            dangerMode: true
                        }).then((confirm) => {
                            if (confirm) {
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
                                        items: selectedItems
                                    },
                                    success: function(response) {
                                        let res = JSON.parse(response);
                                        if (res.success) {
                                            swal('Sukses', 'Pengajuan Pengadaan Di Setujui!', 'success').then(
                                                function() {
                                                    localStorage.removeItem(
                                                        'selectedItems'); // Hapus localStorage setelah disimpan
                                                    sessionStorage.removeItem(
                                                        "dbDataLoaded"); // Hapus localStorage setelah disimpan
                                                    location.href = "<?php echo base_url(); ?>" +
                                                        "transaksi_pengadaan";
                                                });
                                        } else {
                                            swal('Gagal', res.error, 'error');
                                        }
                                    },
                                    error: function() {
                                        swal('Error', 'Terjadi kesalahan pada server.', 'error');
                                    }
                                });
                            }
                        });
                    });

                    // Kirim data untuk disapprove
                    $('#btn-disapprove').on('click', function() {

                        swal({
                            title: 'KONFIRMASI',
                            text: 'Yakin Ingin Ditolak?',
                            icon: 'warning',
                            buttons: {
                                cancel: {
                                    text: 'Tidak',
                                    value: false,
                                    visible: true,
                                    closeModal: true
                                },
                                confirm: {
                                    text: 'Ya',
                                    value: true,
                                    visible: true,
                                    closeModal: true
                                }
                            },
                            dangerMode: true
                        }).then((confirm) => {
                            if (confirm) {
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
                                                    location.href = "<?php echo base_url(); ?>" +
                                                        "transaksi_pengadaan";
                                                });
                                            } else {
                                                swal('Gagal', res.error, 'error');
                                            }
                                        }
                                    })
                                });
                            }
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