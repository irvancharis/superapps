            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DATA STOK PRODUK</h4>
                                </div>


                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>AREA</label>
                                            <select required name="AREA_PENEMPATAN" id="AREA_PENEMPATAN"
                                                class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Area --
                                                </option>
                                                <?php foreach ($get_area as $row) : ?>
                                                <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan area!
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>RUANGAN</label>
                                            <select required name="RUANGAN_PENEMPATAN" id="RUANGAN_PENEMPATAN"
                                                class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Ruangan
                                                    --</option>
                                                <?php foreach ($get_ruangan as $row) : ?>
                                                <option value="<?= $row->KODE_RUANGAN; ?>"><?= $row->NAMA_RUANGAN; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>LOKASI</label>
                                            <select required name="LOKASI_PENEMPATAN" id="LOKASI_PENEMPATAN"
                                                class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Lokasi
                                                    --</option>
                                                <?php foreach ($get_lokasi as $row) : ?>
                                                <option value="<?= $row->KODE_LOKASI; ?>"><?= $row->NAMA_RUANGAN; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>DEPARTEMEN</label>
                                            <select required name="DEPARTEMEN_PENEMPATAN" id="DEPARTEMEN_PENEMPATAN"
                                                class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih
                                                    Departemen --</option>
                                                <?php foreach ($get_departemen as $row) : ?>
                                                <option value="<?= $row->KODE_DEPARTEMEN; ?>">
                                                    <?= $row->NAMA_DEPARTEMEN; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-center">
                                        <label class="btn btn-primary" id="btn-show-produk"> <i
                                                class="fa fa-search"></i> SHOW PRODUK</label>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="TABEL">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-1">FOTO</th>
                                                    <th class="text-center col-1">KODE</th>
                                                    <th>NAMA PRODUK</th>
                                                    <th class="text-center col-2">KATEGORI</th>
                                                    <th class="text-center col-3">MAPING</th>
                                                    <th class="text-center col-1">STOK</th>
                                                    <th class="text-center col-1">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selected-items-body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php $this->load->view('layout/footer'); ?>

            </body>


            <script>
$(document).ready(function() {
    $('#TABEL').dataTable({
        paging: false
    });

    localStorage.removeItem(
        'FormMapping');



    $('select').on('change', function() {
        saveFormData();
    });

    // Form Data Save to Local Storage
    function saveFormData() {
        let formData = {
            AREA: $('#AREA_PENEMPATAN').val(),
            DEPARTEMEN: $('#DEPARTEMEN_PENEMPATAN').val(),
            RUANGAN: $('#RUANGAN_PENEMPATAN').val(),
            LOKASI: $('#LOKASI_PENEMPATAN').val(),
        };

        localStorage.setItem('FormMapping', JSON.stringify(formData));
    }

    $('#formHapusproduk').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = $(this).serialize();

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" +
                "produk_item/hapus", // Endpoint untuk proses input
            type: 'POST',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Hapus Data Berhasil!', 'success').then(function() {
                        $('#hapusModal').modal('hide');
                        location.reload();
                    });
                } else {
                    alert('Gagal menghapus data: ' + response.error);
                }
            },
            error: function() {
                alert('Gagal melakukan proses.');
            }
        });
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


    // Get Data Produk Lock
    $('#btn-show-produk').on('click', function() {

        var FormMapping = localStorage.getItem("FormMapping");

        try {
            FormMapping = JSON.parse(FormMapping) || {};
        } catch (e) {
            alert('Data FormMapping tidak valid!');
            return;
        }



        $.ajax({
            url: "<?php echo base_url(); ?>" + "produk_stok/get_produk_stok",
            type: "POST",
            dataType: "json", // Pastikan server mengembalikan data JSON
            data: {
                KODE_AREA: FormMapping.AREA,
                KODE_DEPARTEMEN: FormMapping.DEPARTEMEN,
                KODE_RUANGAN: FormMapping.RUANGAN,
                KODE_LOKASI: FormMapping.LOKASI
            },
            success: function(response) {
                if (response.length > 0) {
                    let rows = '';
                    $.each(response, function(index, data) {

                        let options = "";
                        if (data.jumlah_aset < data.jumlah_stok) {
                            options += `
                                    <label onclick="generate_aset('${data.UUID_STOK}')" class="btn btn-outline-warning">
                                        <i class="fa fa-eye"></i> GENERATE ASSET
                                    </label>
                            `;
                        }

                        rows += `<tr>
                            <td class="text-center col-1"><center><img width="100px" src="<?php echo base_url('assets/uploads/item/')?>${data.FOTO_ITEM}" alt=""></center></td>
                            <td >${data.KODE_ITEM}</td>
                            <td>${data.NAMA_PRODUK}</td>
                            <td class="text-center">${data.NAMA_PRODUK_KATEGORI}</td>
                            <td><i class="fa fa-map-marker"></i> ${data.NAMA_AREA}<br><i class="fa fa-building"></i> ${data.NAMA_RUANGAN}<br> <i class="fa fa-users"></i> ${data.NAMA_DEPARTEMEN}<br><i class="fa fa-box"></i> ${data.NAMA_LOKASI}</td>
                            <td class="text-center col-1">${data.JUMLAH_STOK}</td>
                            <td class="text-center col-2"><label onclick="detail_stok('${data.UUID_STOK}')" class="btn btn-outline-primary" id="btn-show-produk"> <i class="fa fa-eye"></i> DETAIL</label> ${options}</td>
                            
                         </tr>`;
                    });
                    $('#selected-items-body').html(rows);
                } else {
                    $('#selected-items-body').html(
                        '<tr><td colspan="12"><center>Data tidak ditemukan.</center></td></tr>'
                    );
                }
            },
            error: function(xhr, status, error) {
                $('#selected-items-body').html(
                    '<tr><td colspan="12"><center>Data tidak ditemukan.</center></td></tr>'
                );
            }
        });
    });

});

function generate_aset(uuid) {
    $.ajax({
        url: "<?php echo base_url(); ?>" + "produk_stok/generate_aset/" + uuid,
        type: "POST",
        success: function(response) {
            let res = JSON.parse(response);
            if (res.success) {
                swal('Sukses', 'Simpan Data Berhasil!', 'success').then(function() {
                    location.href = "<?php echo base_url(); ?>" +
                        "produk_stok";
                });
            } else {
                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
            }
        }
    });
}


function detail_stok(uuid) {

    $.ajax({
        url: "<?php echo base_url(); ?>" + "produk_stok/cek_aset/" + uuid,
        type: "POST",
        success: function(response) {
            let res = JSON.parse(response);
            if (res.length > 0) {
                window.location.href = "<?php echo base_url(); ?>produk_stok/detail_stok/" + uuid;
            } else {
                swal('Data aset tidak ditemukan', 'Lakukan generate aset terlebih dahulu', 'warning');
            }
        }
    });
}
            </script>

            </html>