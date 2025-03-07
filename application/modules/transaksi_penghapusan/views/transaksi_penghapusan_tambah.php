            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" enctype="multipart/form-data" novalidate=""
                                    id="FORM_TRANSAKSI_PENGHAPUSAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT TRANSAKSI PENGHAPUSAN</h4>

                                    </div>
                                    <div class="card-body">

                                        <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select required name="AREA" id="AREA" class="form-control">
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
                                                <select disabled required name="DEPARTEMEN" id="DEPARTEMEN"
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
                                                <select required name="RUANGAN" id="RUANGAN" class="form-control">
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
                                                <select required name="LOKASI" id="LOKASI" class="form-control">
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
                                                        <th class="text-center col-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>

                                        <br><br>
                                        <div class="form-group col-12 col-md-12 col-lg-12">
                                            <label>KETERANGAN</label>
                                            <textarea name="KETERANGAN" placeholder="Masukkan keterangan penghapusan"
                                                class="form-control" id="KETERANGAN"></textarea>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan keterangan penghapusan!
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

            <script src="<?php echo base_url('assets/js/fancybox.umd.js') ?>"></script>

            <script>
Fancybox.bind("[data-fancybox]", {
    Html: {
        iframeAttr: {
            allow: "encrypted-media *; autoplay; fullscreen"
        }
    }
})
            </script>

            <script>
$(document).ready(function() {


    $('#btnshowproduk').on('click', function() {

        let FormPenghapusan = JSON.parse(localStorage.getItem("FormPenghapusan")) || [];

        Fancybox.show([{
            src: "<?php echo base_url('transaksi_penghapusan/get_produk_maping/'); ?>" +
                FormPenghapusan.AREA + "/" + FormPenghapusan.RUANGAN + "/" +
                FormPenghapusan
                .LOKASI + "/" + FormPenghapusan.DEPARTEMEN,
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

    // Fancybox
    $('#btn-penghapusan-produk').on('click', function() {
        Fancybox.show([{
            src: "<?php echo base_url('transaksi_penghapusan/transaksi_penghapusan_produk'); ?>",
            type: "iframe",
            preload: false,
            width: "100%",
            height: "100%",
        }, ]);
    })
    $('#btn-tambah-produk').on('click', function() {
        Fancybox.show([{
            src: "<?php echo base_url('transaksi_penghapusan/transaksi_penghapusan_tambah_produk'); ?>",
            type: "iframe",
            preload: false,
            width: "100%",
            height: "100%",
        }, ]);
    })
    // End Fancybox

    // Tangkap event dari Fancybox
    window.addEventListener('message', function(event) {
        if (event.data.action === 'updateTable') {
            loadSelectedItems();
        }
    });

    $('#btn-riset').on('click', function() {
        localStorage.removeItem('storedProdukItems');
        localStorage.removeItem('FormPenghapusan');
        localStorage.removeItem('filterProdukItems');
        filter_pencarian_produk = '';
        location.reload();
    });

    // Get Data Produk Lock
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

    // Simpan data ketika input berubah
    $('select').on('change', function() {
        saveFormData();
    });
    $('#KETERANGAN_PENGHAPUSAN').on('change', function() {
        saveFormData();
    });

    // Get Ruangan By Area
    $('#AREA').on('change', function() {
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
                var $ruanganPenempatan = $('#RUANGAN');

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
    $('#RUANGAN').on('change', function() {
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
                var $lokasiPenempatan = $('#LOKASI');

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

    $('#FORM_TRANSAKSI_PENGHAPUSAN_TAMBAH').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);


        $.ajax({
            url: "<?php echo base_url(); ?>" + "transaksi_penghapusan/insert",
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
                            'FormPenghapusan'
                        ); // Hapus localStorage setelah disimpan
                        location.href = "<?php echo base_url(); ?>" +
                            "transaksi_penghapusan";
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
            AREA: $('#AREA').val(),
            DEPARTEMEN: $('#DEPARTEMEN').val(),
            RUANGAN: $('#RUANGAN').val(),
            LOKASI: $('#LOKASI').val(),
            KETERANGAN: $('#KETERANGAN').val() == '' ? null : $('#KETERANGAN').val()
        };

        localStorage.setItem('FormPenghapusan', JSON.stringify(formData));
    }

    // Form Data Load from Local Storage
    function loadFormData() {
        let formData = JSON.parse(localStorage.getItem('FormPenghapusan'));
        if (formData) {
            $('#AREA').val(formData.AREA);
            $('#DEPARTEMEN').val(formData.DEPARTEMEN);
            $('#RUANGAN').val(formData.RUANGAN);
            $('#LOKASI').val(formData.LOKASI);
            $('#KETERANGAN').val(formData.KETERANGAN);
        }
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
                                    <td class="text-center col-1"><input type="number" class="form-control" name="JUMLAH_PENGHAPUSAN[${index}]" value="${item.STOK_AKTUAL || ''}"></td>
                                    <td class="text-center col-3"><input type="text" class="form-control" name="KETERANGAN_ITEM[${index}]" value="${item.KETERANGAN_ITEM || ''}"></td>
                                    <td class="text-center col-2"><input type="file" accept="image/gif, image/jpeg, image/png" class="form-control" name="FOTO_KONDISI_AWAL[${index}]"></td>
                                    <td class="text-center col-1">
                                        <button class="btn btn-danger remove-item" data-index="${index}">Hapus</button>
                                    </td>
                                </tr>
                            `);
        });
        // Perbarui listener input setelah render ulang
        attachInputListeners();
    }

    function attachInputListeners() {
        $('#selected-items-body').on('input', '.JUMLAH_PENGHAPUSAN', function() {
            let rowIndex = $(this).closest('tr').data('index');
            let stokReal = $(this).val();

            let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
            storedItems[rowIndex].JUMLAH_PENGHAPUSAN = stokReal;
            localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
        });
    }

    $('#selected-items-body').on('input', '.JUMLAH_PENGHAPUSAN', function() {
        let rowIndex = $(this).closest('tr').data('index');
        let stokReal = $(this).val();

        let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
        storedItems[rowIndex].STOK_AKTUAL = stokReal;
        localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
    });


});
            </script>
            </body>



            </html>