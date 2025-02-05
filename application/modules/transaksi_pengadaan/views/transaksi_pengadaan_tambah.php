            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT DATA TRANSAKSI PENGADAAN</h4>
                                        <div class="card-header-action">
                                            <a href="javascript:void(0)" id="btn-pengadaan-produk" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                            <a href="javascript:void(0)" id="btn-tambah-produk" data-fancybox data-src="<?php echo base_url('transaksi_pengadaan/transaksi_pengadaan_tambah_produk'); ?>" data-type="iframe" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
<<<<<<< HEAD
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NO REGISTER</label>
                                                <input required type="text" class="form-control"
                                                    id="NAMA_TRANSAKSI_PENGADAAN" name="NAMA_TRANSAKSI_PENGADAAN">
                                                <div class="invalid-feedback">
                                                    Masukkan NO REGISTER !
=======
                                            <div class="form-group col-12 col-md-4 col-lg-4">
                                                <label>NO.REGISTER</label>
                                                <input required type="text" class="form-control" id="NO_REGISTER" name="NO_REGISTER">
                                                <div class="invalid-feedback">
                                                    Masukkan NO. REGISTER !
>>>>>>> 9b45cfd15351a1cced30ca60ecfa8b5e0108b618
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-2">
                                                <thead>
                                                    <tr>
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
                                        <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
<<<<<<< HEAD
                                                <label>NO REGISTER</label>
                                                <select required name="ID_MAPING_AREA" id="ID_MAPING_AREA"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Area
                                                        --</option>
=======
                                                <label>AREA</label>
                                                <select required name="AREA_PENEMPATAN" id="AREA_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Area --</option>
>>>>>>> 9b45cfd15351a1cced30ca60ecfa8b5e0108b618
                                                    <?php foreach ($get_area as $row) : ?>
                                                    <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AREA!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DEPARTEMEN</label>
<<<<<<< HEAD
                                                <select required name="ID_DEPARTEMENT" id="ID_DEPARTEMENT"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Departement --</option>
=======
                                                <select required name="DEPARTEMEN_PENGAJUAN" id="DEPARTEMEN_PENGAJUAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Departement --</option>
>>>>>>> 9b45cfd15351a1cced30ca60ecfa8b5e0108b618
                                                    <?php foreach ($get_departemen as $row) : ?>
                                                    <option value="<?= $row->KODE_DEPARTEMEN; ?>">
                                                        <?= $row->NAMA_DEPARTEMEN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan DEPARTEMENT!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
<<<<<<< HEAD
                                                <label>JABATAN</label>
                                                <select required name="ID_JABATAN" id="ID_JABATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Jabatan --</option>
                                                    <?php foreach ($get_jabatan as $row) : ?>
                                                    <option value="<?= $row->KODE_JABATAN; ?>">
                                                        <?= $row->NAMA_JABATAN; ?></option>
=======
                                                <label>RUANGAN</label>
                                                <select required name="RUANGAN_PENEMPATAN" id="RUANGAN_PENEMPATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Ruangan --</option>
                                                    <?php foreach ($get_ruangan as $row) : ?>
                                                        <option value="<?= $row->KODE_RUANGAN; ?>"><?= $row->NAMA_RUANGAN; ?></option>
>>>>>>> 9b45cfd15351a1cced30ca60ecfa8b5e0108b618
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan RUANGAN!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
<<<<<<< HEAD
                                                <label>NIP</label>
                                                <input required type="number"
                                                    oninput="this.value = this.value.replace(/\D+/g, '')" name="NIP"
                                                    id="NIP" class="form-control">
                                                <div class="invalid-feedback">
                                                    Masukkan NIP?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA TRANSAKSI_PENGADAAN</label>
                                                <input required type="text" class="form-control"
                                                    id="NAMA_TRANSAKSI_PENGADAAN" name="NAMA_TRANSAKSI_PENGADAAN">
                                                <div class="invalid-feedback">
                                                    Masukkan NAMA TRANSAKSI_PENGADAAN !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>ALAMAT</label>
                                                <input required type="text" class="form-control" id="ALAMAT"
                                                    name="ALAMAT">
                                                <div class="invalid-feedback">
                                                    Masukkan ALAMAT !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TELEPON</label>
                                                <input required type="number"
                                                    oninput="this.value = this.value.replace(/\D+/g, '')"
                                                    class="form-control" id="TELEPON" name="TELEPON">
                                                <div class="invalid-feedback">
                                                    Masukkan TELEPON !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>EMAIL</label>
                                                <input required type="text" class="form-control" id="EMAIL"
                                                    name="EMAIL">
                                                <div class="invalid-feedback">
                                                    Masukkan EMAIL !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>PENDIDIKAN AKHIR</label>
                                                <input required type="text" class="form-control" id="PENDIDIKAN_AKHIR"
                                                    name="PENDIDIKAN_AKHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan PENDIDIKAN AKHIR !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NIK</label>
                                                <input required type="number"
                                                    oninput="this.value = this.value.replace(/\D+/g, '')"
                                                    class="form-control" id="NIK" name="NIK">
                                                <div class="invalid-feedback">
                                                    Masukkan NIK !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TEMPAT LAHIR</label>
                                                <input required type="text" class="form-control" id="TEMPAT_LAHIR"
                                                    name="TEMPAT_LAHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan TEMPAT LAHIR !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TANGGAL LAHIR</label>
                                                <input required type="DATE" class="form-control" id="TANGGAL_LAHIR"
                                                    name="TANGGAL_LAHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan TANGGAL LAHIR !
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>JENIS KELAMIN</label>
                                                <select required name="JENIS_KELAMIN" id="JENIS_KELAMIN"
                                                    class="form-control">
                                                    <option value="LAKI-LAKI" class="text-center">LAKI-LAKI</option>
                                                    <option value="PEREMPUAN" class="text-center">PEREMPUAN</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan JENIS KELAMIN!
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AGAMA</label>
                                                <select required name="AGAMA" id="AGAMA" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Kategori --</option>
                                                    <option value="ISLAM" class="text-center">ISLAM</option>
                                                    <option value="KRISTEN" class="text-center">KRISTEN</option>
                                                    <option value="PROTESTAN" class="text-center">PROTESTAN</option>
                                                    <option value="HINDU" class="text-center">HINDU</option>
                                                    <option value="BUDHA" class="text-center">BUDHA</option>
                                                    <option value="KONGHUCU" class="text-center">KONGHUCU</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AGAMA!
                                                    <div>
                                                    </div>

                                                    <div class="form-group col-12 col-md-6 col-lg-6">
                                                        <label>AKTIF MULAI TANGGAL</label>
                                                        <input required type="DATE" class="form-control"
                                                            id="AKTIF_MULAI_TANGGAL" name="AKTIF_MULAI_TANGGAL">
                                                        <div class="invalid-feedback">
                                                            Masukkan AKTIF MULAI TANGGAL !
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12 col-md-6 col-lg-6">
                                                        <label>BATAS KONTRAK KERJA</label>
                                                        <input required type="DATE" class="form-control"
                                                            id="BATAS_KONTRAK_KERJA" name="BATAS_KONTRAK_KERJA">
                                                        <div class="invalid-feedback">
                                                            Masukkan BATAS KONTRAK KERJA !
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-12 col-md-6 col-lg-6">
                                                        <label>STATUS TRANSAKSI_PENGADAAN</label>
                                                        <select required name="STATUS_TRANSAKSI_PENGADAAN"
                                                            id="STATUS_TRANSAKSI_PENGADAAN" class="form-control">
                                                            <option value="AKTIF" class="text-center">AKTIF</option>
                                                            <option value="NONAKTIF" class="text-center">NON-AKTIF
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Silahkan masukkan STATUS TRANSAKSI_PENGADAAN!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">SIMPAN</button>
                                            </div>
=======
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
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-primary" id="btn-simpan"><i class="fa fa-save"></i> SIMPAN</button>
                                    </div>
>>>>>>> 9b45cfd15351a1cced30ca60ecfa8b5e0108b618
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <?php $this->load->view('layout/footer'); ?>

            <script>
<<<<<<< HEAD
$(document).ready(function() {

    // Input Area
    $('#FORM_TRANSAKSI_PENGADAAN_TAMBAH').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = $(this).serialize();

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" +
                "transaksi_pengadaan/insert", // Endpoint untuk proses input
            type: 'POST',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                        location.href =
                            "<?php echo base_url(); ?>transaksi_pengadaan";
                    });
                } else {
                    alert('Gagal menyimpan data: ' + response.error);
                }
            },
            error: function() {
                alert('Gagal melakukan proses.');
            }
        });
    });

});
=======
                $(document).ready(function() {

                    loadSelectedItems();

                    // Ambil data dari localStorage jika ada
                    loadFormData();

                    // Simpan data ketika input berubah
                    $('input[name="NO_REGISTER"]').on('change', function() {
                        saveFormData();
                    });
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
                                    swal('Sukses', 'Simpan Data Berhasil!', 'success').then(function() {
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

                    // Tangkap event dari Fancybox
                    window.addEventListener('message', function(event) {
                        if (event.data.action === 'updateTable') {
                            loadSelectedItems();
                        }
                    });

                    // Form Data Save to Local Storage
                    function saveFormData() {
                        let formData = {
                            NO_REGISTER: $('input[name="NO_REGISTER"]').val(),
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
                            $('input[name="NO_REGISTER"]').val(formData.NO_REGISTER);
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
                });
>>>>>>> 9b45cfd15351a1cced30ca60ecfa8b5e0108b618
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>