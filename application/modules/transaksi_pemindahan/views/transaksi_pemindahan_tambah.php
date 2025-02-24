            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" enctype="multipart/form-data" novalidate=""
                                    id="FORM_TRANSAKSI_PEMINDAHAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT TRANSAKSI PEMINDAHAN</h4>

                                    </div>
                                    <div class="card-body">
                                        <h4 class="text-center" style="border-bottom:1px solid rgb(228, 228, 228)">
                                            LOKASI ASAL</h4>
                                        <br>
                                        <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select required name="AREA_AWAL" id="AREA_AWAL" class="form-control">
                                                    <option value="" class="text-center" selected>-- Pilih
                                                        Area
                                                        --</option>
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
                                                <select required name="DEPARTEMEN_AWAL" id="DEPARTEMEN_AWAL"
                                                    class="form-control">
                                                    <?php foreach ($get_departemen as $row) : ?>
                                                    <option value="<?= $row->KODE_DEPARTEMEN; ?>"
                                                        <?php echo $row->KODE_DEPARTEMEN == $this->session->userdata('ID_DEPARTEMEN') ? "selected " : ""; ?>>
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
                                                <label>RUANGAN</label>
                                                <select required name="RUANGAN_AWAL" id="RUANGAN_AWAL"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected>-- Pilih
                                                        Ruangan --</option>
                                                    <?php foreach ($get_ruangan as $row) : ?>
                                                    <option value="<?= $row->KODE_RUANGAN; ?>">
                                                        <?= $row->NAMA_RUANGAN; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan RUANGAN!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>LOKASI</label>
                                                <select required name="LOKASI_AWAL" id="LOKASI_AWAL"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected>-- Pilih
                                                        Lokasi --</option>
                                                    <?php foreach ($get_lokasi as $row) : ?>
                                                    <option value="<?= $row->KODE_LOKASI; ?>"><?= $row->NAMA_LOKASI; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan LOKASI!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer text-center">
                                            <label>
                                                <button type="button" class="btn btn-danger" id="btn-riset">
                                                    <i class="fa fa-redo"></i> RISET
                                            </label>

                                            <label>
                                                <button type="button" class="btn btn-success" id="btn-lock-produk">
                                                    <i class="fa fa-save"></i> LOCK DATA
                                            </label>

                                        </div>
                                        <div class="table-responsive">
                                            <div class="card-header-action text-right">
                                                <a id="btnshowproduk" href="#" class="btn btn-primary"><i
                                                        class="fas fa-search"></i></a>
                                            </div>
                                            <table class="table table-striped" id="dataprodukitem">
                                                <thead>
                                                    <tr>
                                                        <th>FOTO</th>
                                                        <th>PRODUK/ITEM</th>
                                                        <th class="text-center col-1">STOK SISTEM</th>
                                                        <th class="text-center col-2">JUMLAH</th>
                                                        <th class="text-center col-2">KETERANGAN</th>
                                                        <th class="text-center col-4">FOTO KONDISI</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>

                                        <br><br>

                                        <h4 class="text-center" style="border-bottom:1px solid rgb(228, 228, 228)">
                                            LOKASI PEMINDAHAN</h4>
                                        <br>
                                        <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select required name="AREA_AKHIR" id="AREA_AKHIR" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Area
                                                        --</option>
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
                                                <select required name="DEPARTEMEN_AKHIR" id="DEPARTEMEN_AKHIR"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Departemen --</option>
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
                                                <label>RUANGAN</label>
                                                <select required name="RUANGAN_AKHIR" id="RUANGAN_AKHIR"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Ruangan --</option>
                                                    <?php foreach ($get_ruangan as $row) : ?>
                                                    <option value="<?= $row->KODE_RUANGAN; ?>">
                                                        <?= $row->NAMA_RUANGAN; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan RUANGAN!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>LOKASI</label>
                                                <select required name="LOKASI_AKHIR" id="LOKASI_AKHIR"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Lokasi --</option>
                                                    <?php foreach ($get_lokasi as $row) : ?>
                                                    <option value="<?= $row->KODE_LOKASI; ?>"><?= $row->NAMA_LOKASI; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan LOKASI!
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group col-12 col-md-12 col-lg-12">
                                            <label>KETERANGAN</label>
                                            <textarea name="KETERANGAN_PEMINDAHAN"
                                                placeholder="Masukkan keterangan pemindahan" class="form-control"
                                                id="KETERANGAN_PEMINDAHAN"></textarea>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan keterangan pemindahan!
                                            </div>


                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-primary" id="btn-simpan">
                                                <i class="fa fa-save"></i> SIMPAN
                                            </button>
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


    $('#btnshowproduk').on('click', function() {

        let formPenghapusan = JSON.parse(localStorage.getItem("FormPemindahan")) || [];

        Fancybox.show([{
            src: "<?php echo base_url('transaksi_pemindahan/get_produk_maping/'); ?>" +
                formPenghapusan.AREA_AWAL + "/" + formPenghapusan.RUANGAN_AWAL + "/" + formPenghapusan
                .LOKASI_AWAL + "/" + formPenghapusan.DEPARTEMEN_AWAL,
            type: "iframe",
            preload: false,
            width: "100%",
            height: "100%",
        }, ]);
    })

    $('#dataprodukitem').dataTable({
        paging: false,
        searching: false,
        info: false
    });

    // Cek apakah sudah ada data di LocalStorage
    let storedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];

    loadSelectedItems();
    loadFormData();


    // Tangkap event dari Fancybox
    window.addEventListener('message', function(event) {
        if (event.data.action === 'updateTable') {
            loadSelectedItems();
        }
    });

    $('#btn-riset').on('click', function() {
        localStorage.removeItem('storedProdukItems');
        localStorage.removeItem('FormPemindahan');
        location.reload();
    });

    // Get Data Produk Lock
    $('#btn-lock-produk').on('click', function() {
        $('#btn-lock-produk').on('click', function() {

            saveFormData();

            document.getElementById("AREA").addEventListener("mousedown", function(e) {
                e.preventDefault(); // Mencegah dropdown terbuka
            });
            document.getElementById("RUANGAN").addEventListener("mousedown", function(e) {
                e.preventDefault(); // Mencegah dropdown terbuka
            });
            document.getElementById("LOKASI").addEventListener("mousedown", function(e) {
                e.preventDefault(); // Mencegah dropdown terbuka
            });
            document.getElementById("DEPARTEMEN").addEventListener("mousedown", function(e) {
                e.preventDefault(); // Mencegah dropdown terbuka
            });

        });
    });

    // Simpan data ketika input berubah
    $('select').on('change', function() {
        saveFormData();
    });
    $('#KETERANGAN_PEMINDAHAN').on('change', function() {
        saveFormData();
    });

    // Get Ruangan By Area
    $('#AREA_AWAL').on('change', function() {
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
                var $ruanganPenempatan = $('#RUANGAN_AWAL');

                $ruanganPenempatan.empty().append(
                    '<option value="" class="text-center" selected disabled>-- Pilih Ruangan --</option>'
                );

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
    $('#RUANGAN_AWAL').on('change', function() {
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
                var $lokasiPenempatan = $('#LOKASI_AWAL');

                $lokasiPenempatan.empty().append(
                    '<option value="" class="text-center" selected disabled>-- Pilih Lokasi --</option>'
                );

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

    $('#AREA_AKHIR').on('change', function() {
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
                var $ruanganPenempatan = $('#RUANGAN_AKHIR');

                $ruanganPenempatan.empty().append(
                    '<option value="" class="text-center" selected disabled>-- Pilih Ruangan --</option>'
                );

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
    $('#RUANGAN_AKHIR').on('change', function() {
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
                var $lokasiPenempatan = $('#LOKASI_AKHIR');

                $lokasiPenempatan.empty().append(
                    '<option value="" class="text-center" selected disabled>-- Pilih Lokasi --</option>'
                );

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

    $('#FORM_TRANSAKSI_PEMINDAHAN_TAMBAH').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);


        $.ajax({
            url: "<?php echo base_url(); ?>" + "transaksi_pemindahan/insert",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Simpan Data Berhasil!', 'success').then(function() {
                        localStorage.removeItem(
                            'storedProdukItems'
                        ); // Hapus localStorage setelah disimpan
                        localStorage.removeItem(
                            'FormPemindahan'
                        ); // Hapus localStorage setelah disimpan
                        location.href = "<?php echo base_url(); ?>" +
                            "transaksi_pemindahan";
                    });
                } else {
                    swal('Gagal', res.error, 'error');
                }
            }
        });
    });

    // Form Data Save to Local Storage
    function saveFormData() {
        let formData = {
            AREA_AWAL: $('#AREA_AWAL').val(),
            DEPARTEMEN_AWAL: $('#DEPARTEMEN_AWAL').val(),
            RUANGAN_AWAL: $('#RUANGAN_AWAL').val(),
            LOKASI_AWAL: $('#LOKASI_AWAL').val(),
            AREA_AKHIR: $('#AREA_AKHIR').val(),
            DEPARTEMEN_AKHIR: $('#DEPARTEMEN_AKHIR').val(),
            RUANGAN_AKHIR: $('#RUANGAN_AKHIR').val(),
            LOKASI_AKHIR: $('#LOKASI_AKHIR').val(),
            KETERANGAN: $('#KETERANGAN_PEMINDAHAN').val() == '' ? null : $('#KETERANGAN_PEMINDAHAN').val()
        };

        localStorage.setItem('FormPemindahan', JSON.stringify(formData));
    }

    // Form Data Load from Local Storage
    function loadFormData() {
        let formData = JSON.parse(localStorage.getItem('FormPemindahan'));
        if (formData) {
            $('#AREA_AWAL').val(formData.AREA_AWAL);
            $('#DEPARTEMEN_AWAL').val(formData.DEPARTEMEN_AWAL);
            $('#RUANGAN_AWAL').val(formData.RUANGAN_AWAL);
            $('#LOKASI_AWAL').val(formData.LOKASI_AWAL);
            $('#AREA_AKHIR').val(formData.AREA_AKHIR);
            $('#DEPARTEMEN_AKHIR').val(formData.DEPARTEMEN_AKHIR);
            $('#RUANGAN_AKHIR').val(formData.RUANGAN_AKHIR);
            $('#LOKASI_AKHIR').val(formData.LOKASI_AKHIR);
            $('#KETERANGAN_PEMINDAHAN').val(formData.KETERANGAN);
        }
    }

    // Fungsi Load Data dari Local Storage
    function loadSelectedItems() {
        storedProdukItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];
        var tbody = $("#selected-items-body");
        tbody.empty();

        storedProdukItems.forEach(function(item, index) {
            tbody.append(`
                                <tr data-index="${index}">
                                    <td class="text-center col-1"><center><img width="100px" src="<?php echo base_url('assets/uploads/item/') ?>${item.FOTO_ITEM}" alt=""></center></td>    
                                    <td>${item.NAMA_PRODUK}</td>
                                    <td class="text-center col-1">${item.JUMLAH_STOK}</td>
                                    <input type="hidden" class="form-control UUID_STOK" name="UUID_STOK[${index}]" value="${item.UUID_STOK || ''}">
                                    <input type="hidden" class="form-control KODE_ITEM" name="KODE_ITEM[${index}]" value="${item.KODE_ITEM || ''}">
                                    <td class="text-center col-1"><input type="number" class="form-control" name="JUMLAH_PEMINDAHAN[${index}]" value="${item.STOK_AKTUAL || ''}"></td>
                                    <td class="text-center col-3"><input type="text" class="form-control" name="KETERANGAN_ITEM[${index}]" value="${item.KETERANGAN_ITEM || ''}"></td>
                                    <td class="text-center col-2"><input type="file" accept="image/gif, image/jpeg, image/png" class="form-control" name="FOTO_AWAL[${index}]"></td>
                                </tr>
                            `);
        });
        // Perbarui listener input setelah render ulang
        attachInputListeners();
    }

    // Fungsi untuk menampilkan data dalam tabel
    function renderTable(data) {
        let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
        let tbody = $("#selected-items-body");
        tbody.empty(); // Kosongkan isi tabel sebelum diisi ulang

        if (data.length === 0) {
            tbody.append('<tr><td colspan="4" class="text-center">Tidak ada data ditemukan</td></tr>');
        } else {
            data.forEach((item, index) => {
                tbody.append(`
                                    <tr data-index="${index}">
                                        <td class="text-center col-1"><center><img width="100px" src="<?php echo base_url('assets/uploads/item/') ?>${item.FOTO_ITEM}" alt=""></center></td>    
                                        <td>${item.NAMA_PRODUK}</td>
                                        <td class="text-center col-1">${item.JUMLAH_STOK}</td>
                                        <input type="hidden" class="form-control UUID_STOK" name="UUID_STOK[${index}]" value="${item.UUID_STOK || ''}">
                                        <input type="hidden" class="form-control KODE_ITEM" name="KODE_ITEM[${index}]" value="${item.KODE_ITEM || ''}">
                                        <td class="text-center col-1"><input type="number" class="form-control" name="JUMLAH_PEMINDAHAN[${index}]" value="${item.STOK_AKTUAL || ''}"></td>
                                        <td class="text-center col-3"><input type="text" class="form-control" name="KETERANGAN_ITEM[${index}]" value="${item.KETERANGAN_ITEM || ''}"></td>
                                        <td class="text-center col-2"><input type="file" accept="image/gif, image/jpeg, image/png" class="form-control" name="FOTO_AWAL[${index}]"></td>
                                    </tr>
                                `);
            });
        }

        // Perbarui listener input setelah render ulang
        attachInputListeners();
    }

    function attachInputListeners() {
        $('#selected-items-body').on('input', '.JUMLAH_PEMINDAHAN', function() {
            let rowIndex = $(this).closest('tr').data('index');
            let stokReal = $(this).val();

            let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
            storedItems[rowIndex].JUMLAH_PEMINDAHAN = stokReal;
            localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
        });
    }

    $('#selected-items-body').on('input', '.JUMLAH_PEMINDAHAN', function() {
        let rowIndex = $(this).closest('tr').data('index');
        let stokReal = $(this).val();

        let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
        storedItems[rowIndex].STOK_AKTUAL = stokReal;
        localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
    });


});
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>