            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="formTicketTambah">
                                    <div class="card-header">
                                        <h4>VIEW DATA TICKETING</h4>
                                        <div class="card-header-action">
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Tgl Request</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="date_ticket" id="date_ticket" class="form-control" value="<?= isset($get_ticket->DATE_TICKET) ? htmlspecialchars($get_ticket->DATE_TICKET) : ''; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>REQUEST BY</label>
                                                <input type="text" name="request_by" id="request_by" class="form-control" value="<?= isset($get_ticket->REQUESTBY) ? $get_ticket->REQUESTBY : ''; ?>" disabled>
                                                <div class="invalid-feedback">
                                                    Di Request Oleh?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DEPARTEMEN</label>
                                                <select name="id_departemen" id="id_departemen" class="form-control" disabled>
                                                    <option value="<?= isset($get_ticket->KODE_DEPARTEMEN) ? $get_ticket->KODE_DEPARTEMEN : ''; ?>"><?= isset($get_ticket->NAMA_DEPARTEMEN) ? $get_ticket->NAMA_DEPARTEMEN : ''; ?></option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan departemen!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>E-MAIL</label>
                                                <input type="email" class="form-control" id="email_ticket" name="email_ticket" value="<?= isset($get_ticket->EMAIL_TICKET) ? $get_ticket->EMAIL_TICKET : ''; ?>" disabled>
                                                <div class="invalid-feedback">
                                                    Masukkan Email dengan benar!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select name="id_area" id="id_area" class="form-control" disabled>
                                                    <option value="<?= isset($get_ticket->KODE_AREA) ? $get_ticket->KODE_AREA : ''; ?>"><?= isset($get_ticket->NAMA_AREA) ? $get_ticket->NAMA_AREA : ''; ?></option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Pilih Area!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">TYPE KELUHAN</label>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="type_ticket" value="Computer" class="selectgroup-input" <?= (is_array($type_ticket) && in_array('Computer', $type_ticket)) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button">Computer</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="type_ticket" value="Printer" class="selectgroup-input" <?= (is_array($type_ticket) && in_array('Printer', $type_ticket)) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button">Printer</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="type_ticket" value="Network" class="selectgroup-input" <?= (is_array($type_ticket) && in_array('Network', $type_ticket)) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button">Network/Internet</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="type_ticket" value="Fina" class="selectgroup-input" <?= (is_array($type_ticket) && in_array('Fina', $type_ticket)) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button">FINA</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DESCRIPTION</label>
                                                <textarea name="description_ticket" placeholder="Masukkan deskripsi keluhan" class="form-control" id="description_ticket" disabled><?= isset($get_ticket->DESCRIPTION_TICKET) ? $get_ticket->DESCRIPTION_TICKET : ''; ?></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan deskripsi keluhan anda!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DATE TICKET DONE</label>
                                                <input type="date" class="form-control" id="date_ticket_done" name="date_ticket_done" disabled>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TECHNICIAN</label>
                                                <select name="id_technician" id="id_technician" class="form-control" disabled>
                                                    <option value="<?= isset($get_ticket->IDTECH) ? $get_ticket->IDTECH : ''; ?>"><?= isset($get_ticket->NAME_TECHNICIAN) ? $get_ticket->NAME_TECHNICIAN : ''; ?></option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Pilih Teknisi!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">APPROVAL</label>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="approval_ticket" value="0" class="selectgroup-input-radio" id="approval0" <?= ($approval_ticket == 0) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button approval <?= $approval_ticket == 0 ? 'bg-warning text-white' : ''; ?>" id="label-approval0">DALAM ANTRIAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="approval_ticket" value="1" class="selectgroup-input-radio" id="approval1" <?= ($approval_ticket == 1) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button approval <?= $approval_ticket == 1 ? ' bg-success text-white' : ''; ?>" id="label-approval1">DISETUJUI</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="approval_ticket" value="2" class="selectgroup-input-radio" id="approval2" <?= ($approval_ticket == 2) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button approval <?= $approval_ticket == 2 ? ' bg-danger text-white' : ''; ?>" id="label-approval2">DITOLAK</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">STATUS</label>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="0" class="selectgroup-input-radio" id="status0" <?= ($status_ticket == 0) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button status <?= $approval_ticket == 0 ? 'bg-warning text-white' : ''; ?>" id="label-status0">DALAM ANTRIAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="25" class="selectgroup-input-radio" id="status1" <?= ($status_ticket == 1) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button status <?= $approval_ticket == 1 ? 'bg-primary text-white' : ''; ?>" id="label-status1">SEDANG DIKERJAKAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="50" class="selectgroup-input-radio" id="status2" <?= ($status_ticket == 2) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button status <?= $approval_ticket == 2 ? 'bg-danger text-white' : ''; ?>" id="label-status2">MENUNGGU VALIDASI</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="100" class="selectgroup-input-radio" id="status3" <?= ($status_ticket == 3) ? 'checked' : ''; ?> disabled>
                                                        <span class="selectgroup-button status <?= $approval_ticket == 3 ? 'bg-success text-white' : ''; ?>" id="label-status3">SELESAI</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">PROGRESS</label>
                                                <div class="progress">
                                                    <input type="hidden" name="prosentase" id="prosentase">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                        aria-valuemax="100" id="progress-bar">0%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a href="<?php echo base_url() . 'ticket' ?>" class="btn btn-secondary">Kembali</a>
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