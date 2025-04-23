            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" enctype="multipart/form-data" novalidate=""
                                    id="FORM_TRANSAKSI_PERMINTAAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT TRANSAKSI PERMINTAAN</h4>

                                    </div>
                                    <div class="card-body">

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
                                                        <th class="text-center col-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>

                                        <br><br>

                                        <h4 class="text-center" style="border-bottom:1px solid rgb(228, 228, 228)">
                                            LOKASI PERMINTAAN</h4>
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
                                                <select required disabled name="DEPARTEMEN_AKHIR" id="DEPARTEMEN_AKHIR"
                                                    class="form-control">
                                                    <option value="<?php echo $this->session->userdata('ID_DEPARTEMEN'); ?>" class="text-center" selected><?php echo $this->session->userdata('NAMA_DEPARTEMEN'); ?></option>
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
                                            <textarea name="KETERANGAN_PERMINTAAN"
                                                placeholder="Masukkan keterangan permintaan" class="form-control"
                                                id="KETERANGAN_PERMINTAAN"></textarea>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan keterangan permintaan!
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

                    let formData = JSON.parse(localStorage.getItem('FormPermintaan'));

                    loadFormData();


                    $('#btnshowproduk').on('click', function() {

                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "transaksi_permintaan/get_maping_default",
                            type: "POST",
                            success: function(response) {
                                let maping = JSON.parse(response);

                                Fancybox.show([{
                                    src: "<?php echo base_url('transaksi_permintaan/get_produk_maping/'); ?>" +
                                        maping.AREA + "/" + maping.RUANGAN + "/" +
                                        maping
                                        .LOKASI + "/" + maping.DEPARTEMEN,
                                    type: "iframe",
                                    preload: false,
                                    width: "100%",
                                    height: "100%",
                                }, ]);
                            },
                            error: function() {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
                            }
                        });





                    })

                    $('#dataprodukitem').dataTable({
                        paging: false,
                        searching: false,
                        info: false
                    });

                    // Cek apakah sudah ada data di LocalStorage
                    let storedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];

                    loadSelectedItems();



                    // Tangkap event dari Fancybox
                    window.addEventListener('message', function(event) {
                        if (event.data.action === 'updateTable') {
                            loadSelectedItems();
                        }
                    });

                    $('#btn-riset').on('click', function() {
                        localStorage.removeItem('storedProdukItems');
                        localStorage.removeItem('FormPermintaan');
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
                    $('#KETERANGAN_PERMINTAAN').on('change', function() {
                        saveFormData();
                    });



                    $('#AREA_AKHIR').on('change', function() {
                        let area = $(this).val();
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "transaksi_permintaan/get_ruangan_by_area",
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
                                    <td class="text-center col-1"><input type="number" required class="form-control JUMLAH_PERMINTAAN" a="JUMLAH_PERMINTAAN" name="JUMLAH_PERMINTAAN[${index}]" value="${item.JUMLAH_PERMINTAAN || ''}"></td>
                                    <td class="text-center col-3"><input type="text" required class="form-control KETERANGAN_ITEM" a="KETERANGAN_ITEM" name="KETERANGAN_ITEM[${index}]" value="${item.KETERANGAN_ITEM || ''}"></td>
                                    <td class="text-center col-1">
                                        <button class="btn btn-danger remove-item" data-index="${index}">Hapus</button>
                                    </td>
                                </tr>
                            `);
                        });

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
                        $('.JUMLAH_PERMINTAAN, .KETERANGAN_ITEM, .FOTO_AWAL').on('input', function() {
                            let rowIndex = $(this).closest('tr').data('index');
                            let fieldName = $(this).attr('a');
                            let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];

                            storedItems[rowIndex][fieldName] = $(this).val();
                            localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
                        });
                    }

                });

                $('#FORM_TRANSAKSI_PERMINTAAN_TAMBAH').on('submit', function(e) {
                    e.preventDefault();

                    swal({
                        title: 'KONFIRMASI',
                        text: 'Yakin Ingin Simpan?',
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
                            let formData = new FormData(this);
                            let requiredFields = ['AREA_AKHIR', 'DEPARTEMEN_AKHIR', 'RUANGAN_AKHIR', 'LOKASI_AKHIR', 'KETERANGAN'];
                            let isEmpty = requiredFields.some(field => !formData.get(field));

                            if (isEmpty) {
                                swal('Error', 'Lengkapi semua data.', 'error');
                            }

                            let storedProdukItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];

                            if (storedProdukItems.length == 0 || storedProdukItems.some(item => !item.JUMLAH_PERMINTAAN ||
                                    !item.KETERANGAN_ITEM)) {
                                swal('Error', 'Lengkapi data produk.', 'error').then(function() {
                                    console.log(storedProdukItems);
                                });
                            } else {
                                $.ajax({
                                    url: "<?php echo base_url(); ?>" + "transaksi_permintaan/insert",
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
                                                    'FormPermintaan'
                                                ); // Hapus localStorage setelah disimpan
                                                location.href = "<?php echo base_url(); ?>" +
                                                    "transaksi_permintaan";
                                            });
                                        } else {
                                            swal('Gagal', res.error, 'error');
                                        }
                                    }
                                });
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
                        KETERANGAN: $('#KETERANGAN_PERMINTAAN').val() == '' ? null : $('#KETERANGAN_PERMINTAAN').val()
                    };

                    localStorage.setItem('FormPermintaan', JSON.stringify(formData));
                }

                // Form Data Load from Local Storage
                function loadFormData() {
                    let formData = JSON.parse(localStorage.getItem('FormPermintaan'));
                    if (formData) {
                        $('#AREA_AWAL').val(formData.AREA_AWAL);
                        $('#DEPARTEMEN_AWAL').val(formData.DEPARTEMEN_AWAL);
                        $('#RUANGAN_AWAL').val(formData.RUANGAN_AWAL);
                        $('#LOKASI_AWAL').val(formData.LOKASI_AWAL);
                        $('#AREA_AKHIR').val(formData.AREA_AKHIR);
                        $('#DEPARTEMEN_AKHIR').val(formData.DEPARTEMEN_AKHIR);
                        $('#RUANGAN_AKHIR').val(formData.RUANGAN_AKHIR);
                        $('#LOKASI_AKHIR').val(formData.LOKASI_AKHIR);
                        $('#KETERANGAN_PERMINTAAN').val(formData.KETERANGAN);
                    }
                }
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>