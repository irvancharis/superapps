            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="formTicketEdit">
                                    <div class="card-header">
                                        <h4>EDIT DATA TICKETING</h4>
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
                                                <input type="hidden" name="id_ticket" id="id_ticket" value="<?= isset($get_ticket->IDTICKET) ? $get_ticket->IDTICKET : ''; ?>">
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
                                                <label>DEPARTEMEN DIREQUEST</label>
                                                <select name="id_departemen_request" id="id_departemen_request" class="form-control" disabled>
                                                    <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                                    <?php foreach ($get_departement as $row) : ?>
                                                        <option value="<?= $row->KODE_DEPARTEMEN; ?>" <?= ($get_ticket->DEPARTEMENT_DIREQUEST == $row->KODE_DEPARTEMEN) ? 'selected' : ''; ?>><?= $row->NAMA_DEPARTEMEN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan departemen!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">TYPE KELUHAN</label>
                                                <div class="selectgroup selectgroup-pills type-ticket">
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
                                                <input type="datetime-local" class="form-control" id="date_ticket_done" name="date_ticket_done" disabled>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TECHNICIAN</label>
                                                <select name="id_technician" id="id_technician" class="form-control" required>
                                                    <option value="" class="text-center" selected disabled>-- Pilih Teknisi --</option>
                                                    <?php foreach ($get_technician as $row) : ?>
                                                        <option value="<?= $row->IDTECH; ?>" <?= ($get_ticket->TECHNICIAN == $row->IDTECH) ? 'selected' : ''; ?>><?= $row->NAME_TECHNICIAN; ?></option>
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
                                                        <input type="radio" name="approval_ticket" value="0" class="selectgroup-input-radio" id="approval0" <?= ($approval_ticket == 0) ? 'checked' : ''; ?>>
                                                        <span class="selectgroup-button approval <?= $approval_ticket == 0 ? 'bg-warning text-white' : ''; ?>" id="label-approval0"><i class="fas fa-spinner"></i> DALAM ANTRIAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="approval_ticket" value="1" class="selectgroup-input-radio" id="approval1" <?= ($approval_ticket == 1) ? 'checked' : ''; ?>>
                                                        <span class="selectgroup-button approval <?= $approval_ticket == 1 ? ' bg-success text-white' : ''; ?>" id="label-approval1"><i class="fas fa-check"></i> DISETUJUI</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="approval_ticket" value="2" class="selectgroup-input-radio" id="approval2" <?= ($approval_ticket == 2) ? 'checked' : ''; ?>>
                                                        <span class="selectgroup-button approval <?= $approval_ticket == 2 ? ' bg-danger text-white' : ''; ?>" id="label-approval2"><i class="fas fa-times"></i> DITOLAK</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">STATUS</label>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="0" class="selectgroup-input-radio" id="status0" <?= ($status_ticket == 0) ? 'checked' : ''; ?>>
                                                        <span class="selectgroup-button status <?= $status_ticket == 0 ? 'bg-warning text-white' : ''; ?>" id="label-status0"><i class="fas fa-spinner"></i> DALAM ANTRIAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="25" class="selectgroup-input-radio" id="status1" <?= ($status_ticket == 25) ? 'checked' : ''; ?>>
                                                        <span class="selectgroup-button status <?= $status_ticket == 1 ? 'bg-primary text-white' : ''; ?>" id="label-status1"><i class="fas fa-briefcase"></i> SEDANG DIKERJAKAN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="50" class="selectgroup-input-radio" id="status2" <?= ($status_ticket == 50) ? 'checked' : ''; ?>>
                                                        <span class="selectgroup-button status <?= $status_ticket == 2 ? 'bg-danger text-white' : ''; ?>" id="label-status2"><i class="fas fa-user-check"></i> MENUNGGU VALIDASI</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="status_ticket" value="100" class="selectgroup-input-radio" id="status3" <?= ($status_ticket == 100) ? 'checked' : ''; ?>>
                                                        <span class="selectgroup-button status <?= $status_ticket == 3 ? 'bg-success text-white' : ''; ?>" id="label-status3"><i class="fas fa-check"></i> SELESAI</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label class="form-label">PROGRESS</label>
                                                <div class="progress">
                                                    <input type="hidden" name="prosentase" id="prosentase">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $status_ticket; ?>" aria-valuemin="0"
                                                        aria-valuemax="100" id="progress-bar" data-status="<?php echo $status_ticket; ?>"><?php echo $status_ticket; ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <?php if ($approval_ticket == 1 || $approval_ticket == 2) : ?>
                                            <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                                        <?php else : ?>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        <?php endif; ?>
                                        <a href="<?php echo base_url() . 'ticket' ?>" class="btn btn-secondary">Kembali</a>
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

                    // Input Area
                    $('#formTicketEdit').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/update", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Ticket Berhasil Di Approve!', 'success').then(function() {
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

                    // Load Status Ticket
                    if ($('#status0').is(':checked')) {
                        $('#label-status0').addClass('bg-warning text-white');
                    } else if ($('#status1').is(':checked')) {
                        $('#label-status1').addClass('bg-info text-white');
                    } else if ($('#status2').is(':checked')) {
                        $('#label-status2').addClass('bg-danger text-white');
                    } else if ($('#status3').is(':checked')) {
                        $('#label-status3').addClass('bg-success text-white');
                    }

                    // Ambil nilai status_ticket dari elemen yang sudah ada di halaman
                    let progressValue = $("#progress-bar").data("status");

                    // Pastikan nilai progress tidak null atau undefined
                    if (progressValue !== undefined) {
                        updateProgressBar(progressValue);
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
                        updateProgressBar(progressValue);
                    });

                    $('input[name="approval_ticket"]').change(function() {
                        // Menghapus kelas warna sebelumnya dari semua label
                        $('.approval').removeClass('bg-warning bg-info bg-danger bg-success text-white');

                        // Menambahkan kelas warna sesuai pilihan
                        if ($('#approval0').is(':checked')) {
                            $('#label-approval0').addClass('bg-warning text-white');
                            $('#id_technician').prop('disabled', true);
                        } else if ($('#approval1').is(':checked')) {
                            $('#label-approval1').addClass('bg-success text-white');
                            $('#id_technician').prop('disabled', false);
                        } else if ($('#approval2').is(':checked')) {
                            $('#label-approval2').addClass('bg-danger text-white');
                            $('#id_technician').prop('disabled', true);
                            $('#id_technician').val('');
                        }
                    });

                    // Trigger event change saat halaman pertama kali dimuat
                    $('input[name="approval_ticket"]:checked').trigger('change');

                    // Fungsi untuk update tampilan progress bar
                    function updateProgressBar(progressValue) {
                        $("#progress-bar")
                            .css("width", progressValue + "%") // Ubah lebar progress bar
                            .attr("aria-valuenow", progressValue) // Update atribut aksesibilitas
                            .text(progressValue + "%"); // Ubah teks progress bar

                        // Generate Date Ticket Done
                        $prosentase = $('#prosentase').val();
                        // Generate Date Ticket Done dengan format YYYY-MM-DD H:i:s ketika prosentase mencapai 100
                        if (progressValue == 100) {
                            var now = new Date();

                            var day = ("0" + now.getDate()).slice(-2); // Format day
                            var month = ("0" + (now.getMonth() + 1)).slice(-2); // Format month
                            var year = now.getFullYear(); // Tahun
                            var hour = ("0" + now.getHours()).slice(-2); // Jam
                            var minute = ("0" + now.getMinutes()).slice(-2); // Menit
                            var second = ("0" + now.getSeconds()).slice(-2); // Detik

                            // Format tanggal dan waktu: YYYY-MM-DD H:i:s
                            var today = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;

                            // Cek apakah nilai input date_ticket_done ada dan ubah jika perlu
                            $('input[name="date_ticket_done"]').val("<?php echo date('Y-m-d H:i:s'); ?>"); // Isi input dengan tanggal dan waktu sekarang
                        }
                    }

                    // Update Type Ticket dari Database
                    function updateTypeTicket(id_ticket) {
                        $.ajax({
                            url: "<?php echo base_url(); ?>ticket/get_departement_joblist_edit", // Endpoint untuk mendapatkan daftar joblist
                            type: 'GET',
                            data: {
                                id_ticket: id_ticket,
                                id_departemen: $('#id_departemen_request').val()
                            },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success && res.data) {
                                    // Kosongkan pilihan type keluhan sebelumnya
                                    $(".type-ticket").empty();

                                    // Ambil data yang sudah dipilih sebelumnya
                                    let selectedTickets = res.selected_tickets || []; // Pastikan server mengembalikan daftar yang dipilih

                                    // Tambahkan opsi baru dari database
                                    res.data.forEach(function(item) {
                                        let isChecked = selectedTickets.includes(item.NAMA_JOBLIST) ? 'checked' : '';
                                        $(".type-ticket").append(`
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="type_ticket" value="${item.NAMA_JOBLIST}" class="selectgroup-input" ${isChecked} disabled>
                                                <span class="selectgroup-button">${item.NAMA_JOBLIST}</span>
                                            </label>
                                        `);
                                    });
                                } else {
                                    swal('Failed', res.error, 'error');
                                }
                            },
                            error: function() {
                                swal('Failed', 'Gagal mengambil data.', 'error');
                            }
                        });
                    }

                    updateTypeTicket("<?php echo $id_ticket; ?>");
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>