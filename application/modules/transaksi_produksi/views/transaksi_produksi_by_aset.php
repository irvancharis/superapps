            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4>INPUT TRANSAKSI PRODUKSI</h4>

                                </div>
                                <div class="card-body">

                                    <div class="row justify-content-center">
                                        <div class="form-group col-12 col-md-6 col-lg-6 text-center">
                                            <label>KODE ASET</label>
                                            <input type="text" autofocus required name="KODE_ASET" id="KODE_ASET"
                                                class="form-control">
                                            <div class="invalid-feedback">
                                                Silahkan masukkan KODE ASET!
                                            </div>
                                        </div>
                                    </div>

                                    <form class="needs-validation" enctype="multipart/form-data" novalidate=""
                                        id="FORM_TRANSAKSI_PRODUKSI_TAMBAH">
                                        <input type="hidden" required name="AREA_AWAL" id="AREA_AWAL"
                                            class="form-control">
                                        <input type="hidden" required name="DEPARTEMEN_AWAL" id="DEPARTEMEN_AWAL"
                                            class="form-control">
                                        <input type="hidden" required name="RUANGAN_AWAL" id="RUANGAN_AWAL"
                                            class="form-control">
                                        <input type="hidden" required name="LOKASI_AWAL" id="LOKASI_AWAL"
                                            class="form-control">

                                        <div class="table-responsive">
                                            <table class="table table-striped" id="dataprodukitem">
                                                <thead>
                                                    <tr>
                                                        <th>FOTO</th>
                                                        <th>PRODUK/ITEM</th>                                                        
                                                        <th class="text-center col-2">KETERANGAN</th>
                                                        <th class="text-center col-4">FOTO KONDISI</th>
                                                        <th class="text-center col-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>

                                        <br><br>

                                        <h4 class="text-center" style="border-bottom:1px solid rgb(228, 228, 228)">
                                            LOKASI PRODUKSI</h4>
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
                                            <textarea name="KETERANGAN_PRODUKSI"
                                                placeholder="Masukkan keterangan produksi" class="form-control"
                                                id="KETERANGAN_PRODUKSI"></textarea>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan keterangan produksi!
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

    document.getElementById("KODE_ASET").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            $.ajax({
                url: "<?php echo base_url('transaksi_produksi/get_produk_by_aset/'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    kode_aset: $('#KODE_ASET').val(),
                },
                success: function(response) {

                    if (response) {
                        let dataItem = JSON.parse(localStorage.getItem(
                            'storedProdukItems')) || [];
                        dataItem.push({
                            UUID_STOK: response.UUID_STOK,
                            KODE_ITEM: response.KODE_ITEM,
                            UUID_ASET: response.UUID_ASET,
                            NAMA_PRODUK: response.NAMA_PRODUK,
                            FOTO_ITEM: response.FOTO_ITEM,
                            SATUAN: response.SATUAN,
                        });
                        localStorage.setItem('storedProdukItems', JSON.stringify(dataItem));
                        loadSelectedItems();
                        $('#AREA_AWAL').val(response.KODE_AREA);
                        $('#RUANGAN_AWAL').val(response.KODE_RUANGAN);
                        $('#LOKASI_AWAL').val(response.KODE_LOKASI);
                        $('#DEPARTEMEN_AWAL').val(response.KODE_DEPARTEMEN);
                        $('#KODE_ASET').val('');
                        $('#KODE_ASET').focus();
                    } else {
                        swal('Error', 'Produk tidak ditemukan.', 'error').then(() => {
                            $('#KODE_ASET').val('');
                            $('#KODE_ASET').focus();
                        });
                    }
                }
            })
        }
    });

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
        localStorage.removeItem('FormProduksi');
        location.reload();
    });

    // Get Data Produk Lock
    $('#btn-lock-produk').on('click', function() {

        saveFormData();

        document.getElementById("AREA_AWAL").addEventListener("mousedown", function(e) {
            e.preventDefault(); // Mencegah dropdown terbuka
        });
        document.getElementById("RUANGAN_AWAL").addEventListener("mousedown", function(e) {
            e.preventDefault(); // Mencegah dropdown terbuka
        });
        document.getElementById("LOKASI_AWAL").addEventListener("mousedown", function(e) {
            e.preventDefault(); // Mencegah dropdown terbuka
        });
        document.getElementById("DEPARTEMEN_AWAL").addEventListener("mousedown", function(e) {
            e.preventDefault(); // Mencegah dropdown terbuka
        });

    });

    // Simpan data ketika input berubah
    $('select').on('change', function() {
        saveFormData();
    });
    $('#KETERANGAN_PRODUKSI').on('change', function() {
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

    $('#FORM_TRANSAKSI_PRODUKSI_TAMBAH').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);


        $.ajax({
            url: "<?php echo base_url(); ?>" + "transaksi_produksi/insert",
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
                            'FormProduksi'
                        ); // Hapus localStorage setelah disimpan
                        location.href = "<?php echo base_url(); ?>" +
                            "transaksi_produksi";
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
            KETERANGAN: $('#KETERANGAN_PRODUKSI').val() == '' ? null : $('#KETERANGAN_PRODUKSI')
                .val()
        };

        localStorage.setItem('FormProduksi', JSON.stringify(formData));
    }

    // Form Data Load from Local Storage
    function loadFormData() {
        let formData = JSON.parse(localStorage.getItem('FormProduksi'));
        if (formData) {
            $('#AREA_AWAL').val(formData.AREA_AWAL);
            $('#DEPARTEMEN_AWAL').val(formData.DEPARTEMEN_AWAL);
            $('#RUANGAN_AWAL').val(formData.RUANGAN_AWAL);
            $('#LOKASI_AWAL').val(formData.LOKASI_AWAL);
            $('#AREA_AKHIR').val(formData.AREA_AKHIR);
            $('#DEPARTEMEN_AKHIR').val(formData.DEPARTEMEN_AKHIR);
            $('#RUANGAN_AKHIR').val(formData.RUANGAN_AKHIR);
            $('#LOKASI_AKHIR').val(formData.LOKASI_AKHIR);
            $('#KETERANGAN_PRODUKSI').val(formData.KETERANGAN);
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
                                    <input type="hidden" class="form-control UUID_STOK" name="UUID_STOK[${index}]" value="${item.UUID_STOK || ''}">
                                    <input type="hidden" class="form-control KODE_ITEM" name="KODE_ITEM[${index}]" value="${item.KODE_ITEM || ''}">
                                    <input type="hidden" class="form-control UUID_ASET" name="UUID_ASET[${index}]" value="${item.UUID_ASET || ''}">
                                    <input type="hidden" class="form-control" name="JUMLAH_PRODUKSI[${index}]" value="1">
                                    <td class="text-center col-3"><input type="text" class="form-control" name="KETERANGAN_ITEM[${index}]" value="${item.KETERANGAN_ITEM || ''}"></td>
                                    <td class="text-center col-2"><input type="file" accept="image/gif, image/jpeg, image/png" class="form-control" name="FOTO_AWAL[${index}]"></td>
                                    <td class="text-center col-1">
                                        <button class="btn btn-danger remove-item" data-index="${index}">Hapus</button>
                                    </td>
                                </tr>
                            `);
        });
        // Perbarui listener input setelah render ulang
        attachInputListeners();
    }



    // Hapus data local Storage
    $('#selected-items-body').on('click', '.remove-item', function() {
        let selectedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];
        let index = $(this).data("index");

        if (index > -1) {
            selectedItems.splice(index, 1);
            localStorage.setItem("storedProdukItems", JSON.stringify(
                selectedItems)); // Perbaikan di sini
        }

        loadSelectedItems();
    });

    function attachInputListeners() {
        $('#selected-items-body').on('input', '.JUMLAH_PRODUKSI', function() {
            let rowIndex = $(this).closest('tr').data('index');
            let stokReal = $(this).val();

            let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
            storedItems[rowIndex].JUMLAH_PRODUKSI = stokReal;
            localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
        });
    }

    $('#selected-items-body').on('input', '.JUMLAH_PRODUKSI', function() {
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