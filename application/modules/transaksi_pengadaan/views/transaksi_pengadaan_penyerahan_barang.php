            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_PROSES_PENGADAAN">
                                    <div class="card-header">
                                        <h4>TRANSAKSI PENGADAAN - PENYERAHAN BARANG</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select disabled name="AREA_PENEMPATAN" id="AREA_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" disabled>-- Pilih Area --</option>
                                                    <?php foreach ($get_area as $row) : ?>
                                                        <option value="<?= $row->KODE_AREA; ?>" <?= $row->KODE_AREA == $penyerahan_barang->KODE_AREA_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_AREA; ?></option>
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
                                                        <option value="<?= $row->KODE_DEPARTEMEN; ?>" <?= $row->KODE_DEPARTEMEN == $penyerahan_barang->KODE_DEPARTEMEN_PENGAJUAN ? "selected" : ""; ?>><?= $row->NAMA_DEPARTEMEN; ?></option>
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
                                                        <option value="<?= $row->KODE_RUANGAN; ?>" <?= $row->KODE_RUANGAN == $penyerahan_barang->KODE_RUANGAN_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_RUANGAN; ?></option>
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
                                                        <option value="<?= $row->KODE_LOKASI; ?>" <?= $row->KODE_LOKASI == $penyerahan_barang->KODE_LOKASI_DEFAULT ? "selected" : ""; ?>><?= $row->NAMA_LOKASI; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan LOKASI!
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="table-responsive">
                                            <h6 class="font-medium text-center"> <i class="fa fa-map-marker"></i> PENEMPATAN PRODUK/ITEM</h6>
                                            <table class="table table-striped table-hover table-md">
                                                <tr>
                                                    <th width="50%">AREA</th>
                                                    <td><?= $penyerahan_barang->NAMA_AREA; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">DEPARTEMEN</th>
                                                    <td><?= $penyerahan_barang->NAMA_DEPARTEMEN; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">RUANGAN</th>
                                                    <td><?= $penyerahan_barang->NAMA_RUANGAN; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">LOKASI</th>
                                                    <td><?= $penyerahan_barang->NAMA_LOKASI; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">KETERANGAN PENGAJUAN</th>
                                                    <td><?= $penyerahan_barang->KETERANGAN_PENGAJUAN; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">NO. REGISTER</th>
                                                    <td><?= $penyerahan_barang->NO_REGISTER; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">NO. RESI</th>
                                                    <td><?= $penyerahan_barang->NO_RESI; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">PENERIMA KIRIMAN BARANG</th>
                                                    <td><?= $penyerahan_barang->NAMA_PENERIMA_KIRIMAN; ?></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="table-responsive">
                                            <h6 class="font-medium mt-5 text-center">DATA PRODUK</h6>
                                            <table class="table table-striped" id="table-approval-produk">
                                                <thead>
                                                    <tr>
                                                        <th>FOTO PRODUK</th>
                                                        <th>PRODUK/ITEM</th>
                                                        <th>JUMLAH</th>
                                                        <th>KEPERLUAN</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>                                        
                                        <div class="row justify-content-center">
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <br>
                                                <br>
                                                <label>USER PENERIMA BARANG</label>
                                                <input type="hidden" class="form-control" id="KODE_USER_PENYERAHAN_BARANG" name="KODE_USER_PENYERAHAN_BARANG" value="<?= $this->session->userdata('ID_KARYAWAN'); ?>">
                                                <select class="form-control" name="KODE_USER_PENERIMA_BARANG" id="KODE_USER_PENERIMA_BARANG" required>
                                                    <option value="" class="text-center" selected disabled>---- Pilih User ----</option>
                                                    <?php foreach ($karyawan_departemen as $row) : ?>
                                                        <option value="<?= $row->ID_KARYAWAN; ?>"><?= $row->NAMA_KARYAWAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Masukkan USER PENERIMA BARANG !
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center row">
                                        <!-- Tombol PROSES PENGADAAN di tengah -->
                                        <div class="col-12 col-md-8 col-lg-7 col-xl-7 mb-2 mb-md-0 text-md-right">
                                            <button type="submit" class="btn btn-success" id="btn-approve"><i class="fa fa-check"></i> PROSES PENYERAHAN BARANG</button>
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

                    $('#KODE_USER_PENERIMA_BARANG').on('change', function() {
                        saveFormData();
                    })

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
                                    <td class="text-center col-1"><input type="number" class="form-control jumlah" name="JUMLAH_PENGADAAN[${index}]" value="${item.jumlah || ''}" disabled></td>
                                    <td class="text-center col-3"><input type="text" class="form-control keperluan" name="KEPERLUAN[${index}]" value="${item.keperluan || ''}" disabled></td>
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

                    // Form Data Save to Local Storage
                    function saveFormData() {
                        let formData = {
                            AREA_PENEMPATAN: <?php echo $penyerahan_barang->KODE_AREA_DEFAULT; ?>,
                            DEPARTEMEN_PENGAJUAN: <?php echo $penyerahan_barang->KODE_DEPARTEMEN_PENGAJUAN; ?>,
                            RUANGAN_PENEMPATAN: <?php echo $penyerahan_barang->KODE_RUANGAN_DEFAULT; ?>,
                            LOKASI_PENEMPATAN: <?php echo $penyerahan_barang->KODE_LOKASI_DEFAULT; ?>,
                            KODE_USER_PENYERAHAN_BARANG: $('#KODE_USER_PENYERAHAN_BARANG').val(),
                            KODE_USER_PENERIMA_BARANG: $('#KODE_USER_PENERIMA_BARANG').val(),
                        };

                        localStorage.setItem('formPengadaan', JSON.stringify(formData));
                    }

                    // Update data ke database
                    $('#FORM_TRANSAKSI_PENGADAAN_PROSES_PENGADAAN').on('submit', function(e) {
                        e.preventDefault();

                        let selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];
                        let formData = JSON.parse(localStorage.getItem('formPengadaan')) || [];

                        if (selectedItems.length == 0) {
                            swal('Error', 'Tidak ada produk yang dipilih.', 'error');
                            return;
                        }

                        if (!formData.KODE_USER_PENERIMA_BARANG) {
                            swal('Error', 'Lengkapi semua data.', 'error');
                            return;
                        }

                        // Kirim data untuk update
                        $.ajax({
                            url: "<?php echo base_url(); ?>transaksi_pengadaan/update_penyerahan_barang", // Ubah menjadi update
                            type: "POST",
                            data: {
                                id_transaksi: idTransaksi, // Kirim ID transaksi agar dapat diupdate
                                items: selectedItems,
                                form: formData
                            },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Penyerahan Berhasil Di Proses!', 'success').then(function() {
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