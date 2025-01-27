            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="formTicketTambah">
                                    <div class="card-header">
                                        <h4>INPUT DATA TICKETING</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>REQUEST BY</label>
                                                <input type="text" name="request_by" id="request_by" class="form-control">
                                                <div class="invalid-feedback">
                                                    Di Request Oleh?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DEPARTEMEN</label>
                                                <button type="button" class="btn btn-primary btn-sm mb-2 float-right" data-toggle="modal" data-target="#tambahModalDepartemen"><i class="fas fa-plus"></i></button>
                                                <select name="id_departemen" id="id_departemen" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                                    <?php foreach ($get_departement as $row) : ?>
                                                        <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan departemen!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>E-MAIL</label>
                                                <input type="email" class="form-control" id="email_ticket" name="email_ticket">
                                                <div class="invalid-feedback">
                                                    Masukkan Email dengan benar!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <button type="button" class="btn btn-primary btn-sm mb-2 float-right" data-toggle="modal" data-target="#tambahModalArea"><i class="fas fa-plus"></i></button>
                                                <select name="id_area" id="id_area" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Area --</option>
                                                    <?php foreach ($get_area as $row) : ?>
                                                        <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Pilih Area!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">PILIH TYPE KELUHAN</label>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="type_ticket" value="Computer" class="selectgroup-input">
                                                        <span class="selectgroup-button">Computer</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="type_ticket" value="Printer" class="selectgroup-input">
                                                        <span class="selectgroup-button">Printer</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="type_ticket" value="Network" class="selectgroup-input">
                                                        <span class="selectgroup-button">Network/Internet</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="type_ticket" value="Fina" class="selectgroup-input">
                                                        <span class="selectgroup-button">FINA</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DESCRIPTION</label>
                                                <textarea name="description_ticket" placeholder="Masukkan deskripsi keluhan" class="form-control" id="description_ticket"></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan deskripsi keluhan anda!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    <a href="templateshub.net">SAGROUP.ID</a></a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
            </div>
            </div>

            <!-- Modal Tambah Departemen -->
            <div class="modal fade" id="tambahModalDepartemen" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Input Data Departemen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formDepartemen">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Departemen</label>
                                    <input type="text" class="form-control" placeholder="Purchasing" name="nama_departement" id="nama_departement">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" id="keterangan">
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary" id="btnSimpanTambah">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Area -->
            <div class="modal fade" id="tambahModalArea" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Input Data Area</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formArea">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Area</label>
                                    <input type="text" class="form-control" placeholder="PT. XXXXXXX" name="nama_area" id="nama_area">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan Area</label>
                                    <input type="text" class="form-control" placeholder="Keterangan" name="keterangan_area" id="keterangan_area">
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary" id="btnSimpanTambah">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php $this->load->view('layout/footer'); ?>

            <script>
                $(document).ready(function() {
                    // Input Departemen
                    $('#formDepartemen').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "departement/insert", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        $('#tambahModalDepartemen').modal('hide');
                                        reloadSelect();
                                    });
                                } else {
                                    alert('Gagal menyimpan data: ' + response.error);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan pada server.');
                            }
                        });
                    });

                    // Input Area
                    $('#formArea').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "maping_area/insert", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        $('#tambahModalArea').modal('hide');
                                        reloadSelectArea();
                                    });
                                } else {
                                    alert('Gagal menyimpan data: ' + response.error);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan pada server.');
                            }
                        });
                    });

                    // Input Area
                    $('#formTicketTambah').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/insert", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        location.href = "<?php echo base_url(); ?>ticket";
                                    });
                                } else {
                                    alert('Gagal menyimpan data: ' + response.error);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan pada server.');
                            }
                        });
                    });

                    // Fungsi untuk memuat ulang data select option
                    function reloadSelect() {
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/get_departement", // Endpoint untuk mendapatkan data select
                            type: 'GET',
                            dataType: 'json', // Mengharapkan data dalam format JSON
                            success: function(response) {
                                // Kosongkan dan tambahkan ulang data ke dropdown
                                $('#id_departemen').empty(); // Hapus semua opsi
                                $('#id_departemen').append('<option class="text-center" value="" selected disabled>-- Pilih Departemen --</option>'); // Tambahkan opsi default

                                // Looping data dari server dan tambahkan opsi baru
                                $.each(response, function(key, departemen) {
                                    $('#id_departemen').append(
                                        '<option value="' + departemen.KODE_DEPARTEMEN + '">' + departemen.NAMA_DEPARTEMEN + '</option>'
                                    );
                                });
                                $('#nama_departement').val('');
                            },
                            error: function() {
                                alert('Gagal memuat data departemen.');
                            },
                        });
                    }

                    // Fungsi untuk memuat ulang data select option
                    function reloadSelectArea() {
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/get_area", // Endpoint untuk mendapatkan data select
                            type: 'GET',
                            dataType: 'json', // Mengharapkan data dalam format JSON
                            success: function(response) {
                                // Kosongkan dan tambahkan ulang data ke dropdown
                                $('#id_area').empty(); // Hapus semua opsi
                                $('#id_area').append('<option class="text-center" value="" selected disabled>-- Pilih Area --</option>'); // Tambahkan opsi default

                                // Looping data dari server dan tambahkan opsi baru
                                $.each(response, function(key, area) {
                                    $('#id_area').append(
                                        '<option value="' + area.KODE_AREA + '">' + area.NAMA_AREA + '</option>'
                                    );
                                });
                                $('#nama_area').val('');
                            },
                            error: function() {
                                alert('Gagal memuat data Area.');
                            },
                        });
                    }
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>