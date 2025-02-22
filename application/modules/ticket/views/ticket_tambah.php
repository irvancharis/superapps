            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="formTicketTambah">
                                    <div class="card-header">
                                        <h4>INPUT DATA TICKETING</h4>
                                        <div class="card-header-action">
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Tgl Request</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="date_ticket" id="date_ticket" class="form-control" value="<?= date('Y-m-d', strtotime(date('Y-m-d'))) ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
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
                                                <label>DEPARTEMEN DIREQUEST</label>
                                                <select name="id_departemen_request" id="id_departemen_request" class="form-control">
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
                                                <label class="form-label">PILIH TYPE KELUHAN</label>
                                                <div class="selectgroup selectgroup-pills type-ticket">
                                                    <p style="color:red;font-style: italic;">*). Muncul setelah memilih DEPARTEMEN DIREQUEST</p>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DESCRIPTION</label>
                                                <textarea name="description_ticket" placeholder="Masukkan deskripsi keluhan" class="form-control" id="description_ticket"></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan deskripsi keluhan anda!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DATE TICKET DONE</label>
                                                <input type="date" class="form-control" id="date_ticket_done" name="date_ticket_done" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TECHNICIAN</label>
                                                <button type="button" class="btn btn-primary btn-sm mb-2 float-right" data-toggle="modal" data-target="#tambahModalTech"><i class="fas fa-plus"></i></button>
                                                <select name="id_technician" id="id_technician" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Teknisi --</option>
                                                    <?php foreach ($get_technician as $row) : ?>
                                                        <option value="<?= $row->IDTECH; ?>"><?= $row->NAME_TECHNICIAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Pilih Teknisi!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">APPROVAL</label>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="approval_ticket" value="0" class="selectgroup-input-radio" id="approval0">
                                                        <span class="selectgroup-button approval" id="label-approval0"><i class="fas fa-spinner"></i> DALAM ANTRIAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="approval_ticket" value="1" class="selectgroup-input-radio" id="approval1">
                                                        <span class="selectgroup-button approval" id="label-approval1"><i class="fas fa-check"></i> DISETUJUI</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="approval_ticket" value="2" class="selectgroup-input-radio" id="approval2">
                                                        <span class="selectgroup-button approval" id="label-approval2"><i class="fas fa-times"></i> DITOLAK</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">PILIH STATUS</label>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="0" class="selectgroup-input-radio" id="status0">
                                                        <span class="selectgroup-button status" id="label-status0"><i class="fas fa-spinner"></i> DALAM ANTRIAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="25" class="selectgroup-input-radio" id="status1">
                                                        <span class="selectgroup-button status" id="label-status1"><i class="fas fa-briefcase"></i> SEDANG DIKERJAKAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="50" class="selectgroup-input-radio" id="status2">
                                                        <span class="selectgroup-button status" id="label-status2"><i class="fas fa-user-check"></i> MENUNGGU VALIDASI</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="100" class="selectgroup-input-radio" id="status3">
                                                        <span class="selectgroup-button status" id="label-status3"><i class="fas fa-check"></i> SELESAI</span>
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
                                        <button class="btn btn-primary">Simpan</button>
                                        <a href="<?php echo base_url() . 'ticket' ?>" class="btn btn-secondary">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            
            </div>
            </div>

            <!-- Modal Tambah Departemen -->
            <div class="modal fade" id="tambahModalDepartemen" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
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
                <div class="modal-dialog modal-dialog-centered" role="document">
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

            <!-- Modal Tambah Teknisi -->
            <div class="modal fade" id="tambahModalTech" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Input Data Teknisi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formTechnician">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Teknisi</label>
                                    <input type="text" class="form-control" placeholder="Nama Teknisi" name="nama_technician">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Departemen</label>
                                        <select class="form-control" name="id_departement">
                                            <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                            <?php foreach ($get_departement as $row) : ?>
                                                <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="" class="text-center" selected disabled>-- Pilih Status --</option>
                                            <option value="0">PASIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ID Karyawan</label>
                                    <select class="form-control" name="id_karyawan">
                                        <option value="" class="text-center" selected disabled>-- Pilih ID Karyawan --</option>
                                        <?php foreach ($get_karyawan as $row) : ?>
                                            <option value="<?= $row->ID_KARYAWAN; ?>"><?= $row->ID_KARYAWAN; ?> - <?= $row->NAMA_KARYAWAN; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Teknisi</label>
                                    <textarea class="form-control" placeholder="Deskripsi" name="description_technician"></textarea>
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
                                alert('Gagal melakukan proses.');
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
                                alert('Gagal melakukan proses.');
                            }
                        });
                    });

                    // Input Technician
                    $('#formTechnician').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "technician/insert", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        $('#tambahModalTech').modal('hide');
                                        reloadSelectTech();
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
                                alert('Gagal melakukan proses.');
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

                    // Fungsi untuk memuat ulang data select option
                    function reloadSelectTech() {
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/get_technician", // Endpoint untuk mendapatkan data select
                            type: 'GET',
                            dataType: 'json', // Mengharapkan data dalam format JSON
                            success: function(response) {
                                // Kosongkan dan tambahkan ulang data ke dropdown
                                $('#id_technician').empty(); // Hapus semua opsi
                                $('#id_technician').append('<option class="text-center" value="" selected disabled>-- Pilih Teknisi --</option>'); // Tambahkan opsi default

                                // Looping data dari server dan tambahkan opsi baru
                                $.each(response, function(key, teknisi) {
                                    $('#id_technician').append(
                                        '<option value="' + teknisi.IDTECH + '">' + teknisi.NAME_TECHNICIAN + '</option>'
                                    );
                                });
                                $('#nama_technician').val('');
                            },
                            error: function() {
                                alert('Gagal memuat data Area.');
                            },
                        });
                    }

                    // Fungsi untuk mengatur kelas warna ketika radio button dipilih
                    $('input[name="status_ticket"]').change(function() {
                        // Menghapus kelas warna sebelumnya dari semua label
                        $('.status').removeClass('bg-warning bg-info bg-danger bg-success text-white');

                        // Menambahkan kelas warna sesuai pilihan
                        if ($('#status0').is(':checked')) {
                            $('#label-status0').addClass('bg-warning text-white');
                        } else if ($('#status1').is(':checked')) {
                            $('#label-status1').addClass('bg-info text-white');
                        } else if ($('#status2').is(':checked')) {
                            $('#label-status2').addClass('bg-danger text-white');
                        } else if ($('#status3').is(':checked')) {
                            $('#label-status3').addClass('bg-success text-white');
                        }

                        // Ambil nilai dari radio button yang dipilih
                        let progressValue = $(this).val();
                        $('#prosentase').val(progressValue);

                        // Update progress bar
                        $('#progress-bar')
                            .css('width', progressValue + '%') // Ubah lebar progress bar
                            .attr('aria-valuenow', progressValue) // Update atribut `aria-valuenow`
                            .text(progressValue + '%'); // Ubah teks progress bar
                    });

                    $('input[name="approval_ticket"]').change(function() {
                        // Menghapus kelas warna sebelumnya dari semua label
                        $('.approval').removeClass('bg-warning bg-info bg-danger bg-success text-white');

                        // Menambahkan kelas warna sesuai pilihan
                        if ($('#approval0').is(':checked')) {
                            $('#label-approval0').addClass('bg-warning text-white');
                        } else if ($('#approval1').is(':checked')) {
                            $('#label-approval1').addClass('bg-success text-white');
                        } else if ($('#approval2').is(':checked')) {
                            $('#label-approval2').addClass('bg-danger text-white');
                        }
                    });

                    $('#id_departemen_request').change(function() {
                        // Ambil nilai dari radio button yang dipilih
                        let id_departemen = $(this).val();
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/get_departement_joblist", // Endpoint untuk proses input
                            type: 'POST',
                            data: {
                                id_departemen: id_departemen
                            },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success && res.data) {
                                    // Kosongkan pilihan type keluhan sebelumnya
                                    $(".type-ticket").empty();

                                    // Tambahkan opsi baru dari database
                                    res.data.forEach(function(item) {
                                        $(".type-ticket").append(`
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="type_ticket[]" value="${item.NAMA_JOBLIST}" class="selectgroup-input">
                                                <span class="selectgroup-button">${item.NAMA_JOBLIST}</span>
                                            </label>
                                        `);
                                    });
                                } else {
                                    swal('Failed', res.error, 'error');
                                }
                            },
                            error: function() {
                                swal('Failed', 'Gagal melakukan proses.', 'error');
                            }
                        });
                    });
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>