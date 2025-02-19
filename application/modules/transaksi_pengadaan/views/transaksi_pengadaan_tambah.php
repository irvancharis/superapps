            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT DATA TRANSAKSI PENGADAAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select required name="AREA_PENEMPATAN" id="AREA_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Area --</option>
                                                    <?php foreach ($get_area as $row) : ?>
                                                        <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?></option>
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
                                                        <option value="<?= $row->KODE_DEPARTEMEN; ?>" <?php echo $row->KODE_DEPARTEMEN == $this->session->userdata('ID_DEPARTEMEN') ? "selected" : ""; ?>><?= $row->NAMA_DEPARTEMEN; ?></option>
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
                                                <select required name="RUANGAN_PENEMPATAN" id="RUANGAN_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Ruangan --</option>
                                                    <?php foreach ($get_ruangan as $row) : ?>
                                                        <option value="<?= $row->KODE_RUANGAN; ?>"><?= $row->NAMA_RUANGAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan RUANGAN!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>LOKASI</label>
                                                <select required name="LOKASI_PENEMPATAN" id="LOKASI_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Lokasi --</option>
                                                    <?php foreach ($get_lokasi as $row) : ?>
                                                        <option value="<?= $row->KODE_LOKASI; ?>"><?= $row->NAMA_LOKASI; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan LOKASI!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <h6 class="font-medium mt-5 text-center">DETAIL DATA PRODUK</h6>
                                            <div class="card-header-action text-right">
                                                <a href="javascript:void(0)" id="btn-pengadaan-produk" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                                <a href="javascript:void(0)" id="btn-tambah-produk" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                            </div>
                                            <table class="table table-striped" id="table-data-produk">
                                                <thead>
                                                    <tr>
                                                        <th>FOTO PRODUK</th>
                                                        <th>PRODUK/ITEM</th>
                                                        <th>JUMLAH</th>
                                                        <th>KEPERLUAN</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-primary mx-2" id="btn-simpan"><i class="fa fa-save"></i> SIMPAN</button>
                                        <a href="<?php echo base_url(); ?>transaksi_pengadaan" class="btn btn-secondary"><i class="fa fa-times"></i> BATAL</a>
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

                    $('#table-data-produk').dataTable({
                        paging: false,
                        searching: false,
                        info: false
                    });

                    loadSelectedItems();

                    // Ambil data dari localStorage jika ada
                    loadFormData();

                    // Simpan data ketika input berubah
                    $('select').on('change', function() {
                        saveFormData();
                    });

                    $('#FORM_TRANSAKSI_PENGADAAN_TAMBAH').on('submit', function(e) {
                        e.preventDefault();

                        let selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];
                        let formData = JSON.parse(localStorage.getItem('formPengadaan')) || {};

                        if (selectedItems.length == 0) {
                            swal('Error', 'Tidak ada produk yang dipilih.', 'error').then(function() {
                                console.log(selectedItems);
                            });
                        }

                        if (!formData.AREA_PENEMPATAN || !formData.DEPARTEMEN_PENGAJUAN || !formData.RUANGAN_PENEMPATAN || !formData.LOKASI_PENEMPATAN || !formData.TANGGAL_PENGAJUAN) {
                            swal('Error', 'Lengkapi semua data.', 'error').then(function() {
                                return;
                            });
                        }

                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "transaksi_pengadaan/insert",
                            type: "POST",
                            data: {
                                items: selectedItems,
                                form: formData
                            },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Pengajuan Berhasil Dikirim!', 'success').then(function() {
                                        localStorage.removeItem('selectedItems'); // Hapus localStorage setelah disimpan
                                        localStorage.removeItem('formPengadaan'); // Hapus localStorage setelah disimpan
                                        location.href = "<?php echo base_url(); ?>" + "transaksi_pengadaan";
                                    });
                                } else {
                                    swal('Gagal', res.error, 'error');
                                }
                            }
                        });
                    });

                    // Fancybox
                    $('#btn-pengadaan-produk').on('click', function() {
                        Fancybox.show([{
                            src: "<?php echo base_url('transaksi_pengadaan/transaksi_pengadaan_produk'); ?>",
                            type: "iframe",
                            preload: false,
                            width: "100%",
                            height: "100%",
                        }, ]);
                    })
                    $('#btn-tambah-produk').on('click', function() {
                        Fancybox.show([{
                            src: "<?php echo base_url('transaksi_pengadaan/transaksi_pengadaan_tambah_produk'); ?>",
                            type: "iframe",
                            preload: false,
                            width: "100%",
                            height: "100%",
                        }, ]);
                    })

                    // Tangkap event dari Fancybox
                    window.addEventListener('message', function(event) {
                        if (event.data.action === 'updateTable') {
                            loadSelectedItems();
                        }
                    });

                    // Form Data Save to Local Storage
                    function saveFormData() {
                        let formData = {
                            AREA_PENEMPATAN: $('#AREA_PENEMPATAN').val(),
                            DEPARTEMEN_PENGAJUAN: $('#DEPARTEMEN_PENGAJUAN').val(),
                            RUANGAN_PENEMPATAN: $('#RUANGAN_PENEMPATAN').val(),
                            LOKASI_PENEMPATAN: $('#LOKASI_PENEMPATAN').val()
                        };

                        localStorage.setItem('formPengadaan', JSON.stringify(formData));
                    }

                    // Form Data Load from Local Storage
                    function loadFormData() {
                        let formData = JSON.parse(localStorage.getItem('formPengadaan'));
                        if (formData) {
                            $('#AREA_PENEMPATAN').val(formData.AREA_PENEMPATAN);
                            $('#DEPARTEMEN_PENGAJUAN').val(formData.DEPARTEMEN_PENGAJUAN);
                            $('#RUANGAN_PENEMPATAN').val(formData.RUANGAN_PENEMPATAN);
                            $('#LOKASI_PENEMPATAN').val(formData.LOKASI_PENEMPATAN);
                        }
                    }

                    // Fungsi Load Data dari Local Storage
                    function loadSelectedItems() {
                        selectedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];
                        var tbody = $("#selected-items-body");
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
                                    <td><input type="number" class="form-control jumlah" name="JUMLAH_PENGADAAN[${index}]" value="${item.jumlah || ''}"></td>
                                    <td><input type="text" class="form-control keperluan" name="KEPERLUAN[${index}]" value="${item.keperluan || ''}"></td>
                                    <td>
                                        <button class="btn btn-danger remove-item" data-index="${index}">Hapus</button>
                                    </td>
                                </tr>
                            `);
                        });
                        // Perbarui listener input setelah render ulang
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

                    function attachInputListeners() {
                        $('.jumlah, .keperluan').on('input', function() {
                            let rowIndex = $(this).closest('tr').data('index');
                            let fieldName = $(this).hasClass('jumlah') ? 'jumlah' : 'keperluan';

                            selectedItems[rowIndex][fieldName] = $(this).val();
                            localStorage.setItem('selectedItems', JSON.stringify(selectedItems));
                        });
                    }

                    // Hapus data local Storage
                    $('#selected-items-body').on('click', '.remove-item', function() {
                        var index = $(this).data("index");
                        selectedItems.splice(index, 1);
                        localStorage.setItem("selectedItems", JSON.stringify(selectedItems));
                        loadSelectedItems();
                        renderTable();
                    });

                    // Get Ruangan By Area
                    $('#AREA_PENEMPATAN').on('change', function() {
                        let area = $(this).val();
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "transaksi_pengadaan/get_ruangan_by_area",
                            type: "POST",
                            data: {
                                AREA_PENEMPATAN: area
                            },
                            success: function(response) {
                                var ruangan = JSON.parse(response);
                                var data_ruangan = ruangan.data;
                                var $ruanganPenempatan = $('#RUANGAN_PENEMPATAN');

                                $ruanganPenempatan.empty().append('<option value="" class="text-center" selected disabled>-- Pilih Ruangan --</option>');

                                $.each(data_ruangan, function(index, lokasi) {
                                    $ruanganPenempatan.append($('<option>', {
                                        value: lokasi.KODE_RUANGAN,
                                        text: lokasi.NAMA_RUANGAN
                                    }));
                                });

                            },
                            error: function() {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
                            }
                        });
                    });

                    // Get Lokasi By Ruangan
                    $('#RUANGAN_PENEMPATAN').on('change', function() {
                        let ruangan = $(this).val();
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "transaksi_pengadaan/get_lokasi_by_ruangan",
                            type: "POST",
                            data: {
                                RUANGAN_PENEMPATAN: ruangan
                            },
                            success: function(response) {
                                var lokasi = JSON.parse(response);
                                var data_lokasi = lokasi.data;
                                var $lokasiPenempatan = $('#LOKASI_PENEMPATAN');

                                $lokasiPenempatan.empty().append('<option value="" class="text-center" selected disabled>-- Pilih Lokasi --</option>');

                                $.each(data_lokasi, function(index, lokasi) {
                                    $lokasiPenempatan.append($('<option>', {
                                        value: lokasi.KODE_LOKASI,
                                        text: lokasi.NAMA_LOKASI
                                    }));
                                });

                            },
                            error: function() {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
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