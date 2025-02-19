            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_OPNAME_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT TRANSAKSI OPNAME</h4>

                                    </div>
                                    <div class="card-body">

                                        <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select required name="AREA_PENEMPATAN" id="AREA_PENEMPATAN"
                                                    class="form-control">
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
                                                <select disabled required name="DEPARTEMEN_PENGAJUAN"
                                                    id="DEPARTEMEN_PENGAJUAN" class="form-control">
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
                                                <select required name="RUANGAN_PENEMPATAN" id="RUANGAN_PENEMPATAN"
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
                                                <select required name="LOKASI_PENEMPATAN" id="LOKASI_PENEMPATAN"
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
                                            <table class="table table-striped" id="dataprodukitem">
                                                <thead>
                                                    <tr>
                                                        <th>FOTO</th>
                                                        <th>PRODUK/ITEM</th>
                                                        <th class="text-center col-2">STOK SISTEM</th>
                                                        <th class="text-center col-2">STOK REAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>

                                        <br><br>
                                        <div class="form-group col-12 col-md-12 col-lg-12">
                                            <label>KETERANGAN</label>
                                            <textarea name="CATATAN_OPNAME" placeholder="Masukkan keterangan opname"
                                                class="form-control" id="CATATAN_OPNAME"></textarea>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan keterangan opname!
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

    $('#dataprodukitem').dataTable({
        paging: false,
        searching: false,
        info: false
    });

    // Cek apakah sudah ada data di LocalStorage
    let storedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];

    renderTable(storedItems);
    loadFormData();

    $('#btn-riset').on('click', function() {
        localStorage.removeItem('storedProdukItems');
        localStorage.removeItem('FormOpname');
        location.reload();
    });

    // Get Data Produk Lock
    $('#btn-lock-produk').on('click', function() {
        var FormOpname = JSON.parse(localStorage.getItem("FormOpname")) || {};

        // Cek apakah semua properti yang dibutuhkan ada di dalam objek
        var isComplete = (
            FormOpname.AREA_OPNAME &&
            FormOpname.KODE_DEPARTEMEN &&
            FormOpname.RUANGAN_OPNAME &&
            FormOpname.LOKASI_OPNAME
        );

        if (isComplete) {
            $.ajax({
                url: "<?php echo base_url(); ?>" + "transaksi_opname/get_produk_input_opname",
                type: "GET",
                data: {
                    KODE_AREA: FormOpname.AREA_OPNAME,
                    KODE_DEPARTEMEN: FormOpname.KODE_DEPARTEMEN,
                    KODE_RUANGAN: FormOpname.RUANGAN_OPNAME,
                    KODE_LOKASI: FormOpname.LOKASI_OPNAME
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        // Pastikan setiap objek memiliki STOK_AKTUAL, jika tidak, tambahkan nilai default
                        let updatedData = res.data.map(item => ({
                            ...item,
                            STOK_AKTUAL: item.STOK_AKTUAL ||
                                0 // Tambahkan default jika tidak ada
                        }));
                        // Simpan data ke LocalStorage
                        localStorage.setItem("storedProdukItems", JSON.stringify(
                            updatedData));
                        renderTable(updatedData);
                    } else {
                        swal('Gagal', 'Belum ada data produk.', 'error');
                    }
                }
            });

            document.getElementById("AREA_PENEMPATAN").disabled = true;
            document.getElementById("LOKASI_PENEMPATAN").disabled = true;
            document.getElementById("RUANGAN_PENEMPATAN").disabled = true;


        } else {
            alert('Harap lengkapi data sebelum mengambil produk.');
        }
    });

    // Simpan data ketika input berubah
    $('select').on('change', function() {
        saveFormData();
    });
    $('#CATATAN_OPNAME').on('change', function() {
        saveFormData();
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

    $('#FORM_TRANSAKSI_OPNAME_TAMBAH').on('submit', function(e) {
        e.preventDefault();

        let storedProdukItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
        let formData = JSON.parse(localStorage.getItem('FormOpname')) || {};

        if (storedProdukItems.length == 0) {
            swal('Error', 'Tidak ada produk yang dipilih.', 'error').then(function() {
                console.log(storedProdukItems);
            });
        }

        if (!formData.AREA_OPNAME || !formData.KODE_DEPARTEMEN || !formData
            .RUANGAN_OPNAME || !formData.LOKASI_OPNAME || !formData.CATATAN_OPNAME) {
            swal('Error', 'Lengkapi semua data.', 'error').then(function() {
                return;
            });
        }

        $.ajax({
            url: "<?php echo base_url(); ?>" + "transaksi_opname/insert",
            type: "POST",
            data: {
                items: storedProdukItems,
                form: formData
            },
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Simpan Data Berhasil!', 'success').then(function() {
                        localStorage.removeItem(
                            'storedProdukItems'
                        ); // Hapus localStorage setelah disimpan
                        localStorage.removeItem(
                            'FormOpname'); // Hapus localStorage setelah disimpan
                        location.href = "<?php echo base_url(); ?>" +
                            "transaksi_opname";
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
            AREA_OPNAME: $('#AREA_PENEMPATAN').val(),
            KODE_DEPARTEMEN: $('#DEPARTEMEN_PENGAJUAN').val(),
            RUANGAN_OPNAME: $('#RUANGAN_PENEMPATAN').val(),
            LOKASI_OPNAME: $('#LOKASI_PENEMPATAN').val(),
            CATATAN_OPNAME: $('#CATATAN_OPNAME').val() == '' ? null : $('#CATATAN_OPNAME').val()
        };

        localStorage.setItem('FormOpname', JSON.stringify(formData));
    }

    // Form Data Load from Local Storage
    function loadFormData() {
        let formData = JSON.parse(localStorage.getItem('FormOpname'));
        if (formData) {
            $('#AREA_PENEMPATAN').val(formData.AREA_PENEMPATAN);
            $('#DEPARTEMEN_PENGAJUAN').val(formData.DEPARTEMEN_PENGAJUAN);
            $('#RUANGAN_PENEMPATAN').val(formData.RUANGAN_PENEMPATAN);
            $('#LOKASI_PENEMPATAN').val(formData.LOKASI_PENEMPATAN);
            $('#CATATAN_OPNAME').val(formData.CATATAN_OPNAME);
        }
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
                                    <td class="text-center col-2"><center><img width="100px" src="<?php echo base_url('assets/uploads/item/')?>${item.FOTO_ITEM}" alt=""></center></td>    
                                    <td>${item.NAMA_PRODUK}</td>
                                        <td class="text-center col-2">${item.JUMLAH_STOK}</td>
                                        <td class="text-center col-2"><input type="number" class="form-control stok-real" name="STOK_AKTUAL[${index}]" value="${item.STOK_AKTUAL || ''}"></td>
                                    </tr>
                                `);
            });
        }

        // Perbarui listener input setelah render ulang
        attachInputListeners();
    }

    function attachInputListeners() {
        $('#selected-items-body').on('input', '.stok-real', function() {
            let rowIndex = $(this).closest('tr').data('index');
            let stokReal = $(this).val();

            let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
            storedItems[rowIndex].STOK_AKTUAL = stokReal;
            localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
        });
    }

    $('#selected-items-body').on('input', '.stok-real', function() {
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