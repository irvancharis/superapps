            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_APPROVAL_KABAG">
                                    <div class="card-header">
                                        <h4>APPROVAL KABAG TRANSAKSI PENGADAAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select disabled name="AREA_PENEMPATAN" id="AREA_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" disabled>-- Pilih Area --</option>
                                                    <?php foreach ($get_area as $row) : ?>
                                                        <option value="<?= $row->KODE_AREA; ?>" <?= $row->KODE_AREA == $approval_kabag->KODE_AREA_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_AREA; ?></option>
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
                                                        <option value="<?= $row->KODE_DEPARTEMEN; ?>" <?= $row->KODE_DEPARTEMEN == $approval_kabag->KODE_DEPARTEMEN_PENGAJUAN ? "selected" : ""; ?>><?= $row->NAMA_DEPARTEMEN; ?></option>
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
                                                        <option value="<?= $row->KODE_RUANGAN; ?>" <?= $row->KODE_RUANGAN == $approval_kabag->KODE_RUANGAN_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_RUANGAN; ?></option>
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
                                                        <option value="<?= $row->KODE_LOKASI; ?>" <?= $row->KODE_LOKASI == $approval_kabag->KODE_LOKASI_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_LOKASI; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan LOKASI!
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="table-responsive">
                                            <h6 class="font-medium text-center"> <i class="fa fa-map-marker"></i> PENEMPATAN PRODUK/ITEM</h6>
                                            <table class="table table-striped table-hover table-sm">
                                                <tr>
                                                    <th class="col-2">AREA</th>
                                                    <td><?= $approval_kabag->NAMA_AREA; ?></td>
                                                </tr>
                                                <tr>
                                                    <th >DEPARTEMEN</th>
                                                    <td><?= $approval_kabag->NAMA_DEPARTEMEN; ?></td>
                                                </tr>
                                                <tr>
                                                    <th >RUANGAN</th>
                                                    <td><i class="fa fa-users"></i> <?= $approval_kabag->NAMA_RUANGAN; ?></td>
                                                </tr>
                                                <tr>
                                                    <th >LOKASI</th>
                                                    <td><i class="fa fa-box"></i> <?= $approval_kabag->NAMA_LOKASI; ?></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="table-responsive">
                                            <h6 class="font-medium mt-5 text-center"> <i class="fa fa-list"></i> DATA PRODUK</h6>
                                            <table class="table table-striped table-hover " id="table-approval-produk">
                                                <thead>
                                                    <tr>
                                                        <th class="col-2">FOTO PRODUK</th>
                                                        <th>PRODUK/ITEM</th>
                                                        <th class="col-1">JUMLAH</th>
                                                        <th class="col-3">KEPERLUAN</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>KETERANGAN</label><span class="text-danger float-right font-italic font-weight-600">*). Wajib Di Isi</span>
                                                <textarea required name="KETERANGAN_PENGAJUAN" id="KETERANGAN_PENGAJUAN" placeholder="Masukkan keterangan pengajuan" class="form-control" rows="3"></textarea>
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

                                        <!-- Tombol KEMBALI di kanan -->
                                        <div class="col-12 col-md-4 col-lg-5 col-xl-5 text-md-right">
                                            <a href="<?php echo base_url(); ?>transaksi_pengadaan" class="btn btn-secondary">
                                                <i class="fa fa-arrow-left"></i> KEMBALI
                                            </a>
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
                        info: false
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
                                    <td class="text-center">
                                        <div class="gallery d-flex justify-content-center">
                                            <a class="gallery-item w-25" href="<?php echo base_url('assets/uploads/item/') ?>${item.foto}" data-image="<?php echo base_url('assets/uploads/item/') ?>${item.foto}" data-title="${item.nama}">
                                                <img style="width: 100px;" src="<?php echo base_url('assets/uploads/item/'); ?>${item.foto}" alt="">
                                            </a>
                                        </div>
                                    </td>
                                    <td>${item.nama}</td>
                                    <td class="text-center col-1"><input type="number" class="form-control jumlah" name="JUMLAH_PENGADAAN[${index}]" value="${item.jumlah || ''}"></td>
                                    <td><input type="text" class="form-control keperluan" name="KEPERLUAN[${index}]" value="${item.keperluan || ''}"></td>
                                    <td class="text-center col-1"><button class="btn btn-danger remove-item" data-index="${index}">Hapus</button></td>
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
                            url: "<?php echo base_url(); ?>transaksi_pengadaan/get_data_transaksi_detail/" + idTransaksi,
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
                                form: formData
                            },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Pengajuan Pengadaan Di Setujui!', 'success').then(function() {
                                        localStorage.removeItem('selectedItems'); // Hapus localStorage setelah disimpan
                                        localStorage.removeItem('formPengadaan'); // Hapus localStorage setelah disimpan
                                        sessionStorage.removeItem("dbDataLoaded"); // Hapus localStorage setelah disimpan
                                        location.href = "<?php echo base_url(); ?>" + "transaksi_pengadaan";
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
                                        swal('Sukses', 'Pengajuan Pengadaan Berhasil Ditolak!', 'success').then(function() {
                                            localStorage.removeItem('selectedItems'); // Hapus localStorage setelah disimpan
                                            sessionStorage.removeItem("dbDataLoaded"); // Hapus localStorage setelah disimpan
                                            location.href = "<?php echo base_url(); ?>" + "transaksi_pengadaan";
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