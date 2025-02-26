            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="invoice">
                            <div class="invoice-print">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="invoice-title">
                                            <h2>Ticket</h2>
                                            <div class="invoice-number"><img width="50px" src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>" alt=""></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <address>
                                                    <strong>Request Oleh:</strong><br>
                                                    <?php echo strtoupper($ticket->REQUESTBY); ?><br>
                                                    <?php echo strtoupper($ticket->EMAIL_TICKET); ?><br>
                                                </address>
                                            </div>
                                            <div class="col-md-4">
                                                <address>
                                                    <strong>Departemen:</strong><br>
                                                    <?php echo strtoupper($get_departemen->NAMA_DEPARTEMEN); ?>
                                                </address>
                                            </div>
                                            <div class="col-md-4 text-md-right">
                                                <address>
                                                    <strong>Type Keluhan:</strong><br>
                                                    <?php echo strtoupper($ticket->TYPE_TICKET); ?><br>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <address>
                                                    <strong>Departemen Diminta:</strong><br>
                                                    <?php echo strtoupper($get_departemen_request->NAMA_DEPARTEMEN); ?><br>
                                                </address>
                                            </div>
                                            <div class="col-md-4">
                                                <address>
                                                    <strong>Deskripsi Keluhan:</strong><br>
                                                    <?php echo strtoupper($ticket->DESCRIPTION_TICKET); ?><br>
                                                </address>
                                            </div>
                                            <div class="col-md-4 text-md-right">
                                                <address>
                                                    <strong>Ditangani Oleh (Teknisi):</strong><br>
                                                    <?php echo strtoupper($get_technician->NAME_TECHNICIAN); ?>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <address>
                                                    <strong>Status Ticket:</strong><br>
                                                    <?php if ($ticket->STATUS_TICKET == 0) {
                                                        echo "<span class='badge badge-warning' style='font-size: small;'>DALAM ANTRIAN</span><br>";
                                                    } elseif ($ticket->STATUS_TICKET == 25) {
                                                        echo "<span class='badge badge-primary' style='font-size: small;'>SEDANG DIKERJAKAN</span><br>";
                                                    } elseif ($ticket->STATUS_TICKET == 50) {
                                                        echo "<span class='badge badge-danger' style='font-size: small;'>MENUNGGU VALIDASI</span><br>";
                                                    } else {
                                                        echo "<span class='badge badge-success' style='font-size: small;'>SELESAI</span><br>";
                                                    }
                                                    ?>
                                                </address>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="progress">
                                                    <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $ticket->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $ticket->IDTICKET; ?>" data-status="<?php echo $ticket->STATUS_TICKET; ?>"><?php echo $ticket->STATUS_TICKET; ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="section-title">Detail Riwayat Pengerjaan</div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-md">
                                                <tr>
                                                    <th data-width="40">#</th>
                                                    <!-- <th>Teknisi</th> -->
                                                    <th>Objek Ditangani</th>
                                                    <th>Keterangan</th>
                                                    <th class="text-center">Foto</th>
                                                </tr>
                                                <?php foreach ($ticket_detail as $index => $d) : ?>
                                                    <tr>
                                                        <td><?php echo $index + 1; ?></td>
                                                        <!-- <td><?php echo $d->TECHNICIAN; ?></td> -->
                                                        <td><?php echo $d->OBJEK_DITANGANI; ?></td>
                                                        <td><?php echo $d->KETERANGAN; ?></td>
                                                        <td class="text-center"><img src="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" alt=""></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-md-right">
                                <div class="float-lg-left mb-lg-0 mb-3">
                                    <button type="button" class="btn btn-primary btn-icon icon-left update-status" data-id="<?php echo $ticket->IDTICKET; ?>" data-status="<?php echo $ticket->STATUS_TICKET; ?>"><i class="fas fa-sync-alt"></i> Update
                                        Pengerjaan</button>
                                    <button type="button" onclick="history.go(-1)" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Batal</button>
                                </div>
                                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <?php $this->load->view('layout/footer'); ?>

            <script>
                $(document).ready(function() {
                    // Update Status Ticket
                    $(".update-status").click(function() {
                        let id_ticket = $(this).data("id");
                        let currentStatus = $(this).data("status");

                        swal({
                            title: "Input Pengerjaan",
                            content: {
                                element: "div",
                                attributes: {
                                    innerHTML: `
                                        <div class="form-group">
                                            <div class="selectgroup selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status_ticket" value="0" class="selectgroup-input-radio" id="status0" disabled>
                                                    <span class="selectgroup-button status" id="label-status0">DALAM ANTRIAN</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status_ticket" value="25" class="selectgroup-input-radio" id="status1" disabled>
                                                    <span class="selectgroup-button status" id="label-status1">SEDANG DIKERJAKAN</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status_ticket" value="50" class="selectgroup-input-radio" id="status2" disabled>
                                                    <span class="selectgroup-button status" id="label-status2">MENUNGGU VALIDASI</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status_ticket" value="100" class="selectgroup-input-radio" id="status3" disabled>
                                                    <span class="selectgroup-button status" id="label-status3">SELESAI</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="OBJEK_DITANGANI">OBJEK DITANGANI</label>
                                            <input type="text" class="form-control" id="OBJEK_DITANGANI" name="OBJEK_DITANGANI" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="KETERANGAN">KETERANGAN</label>
                                            <input type="text" class="form-control" id="KETERANGAN" name="KETERANGAN" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="FOTO">FOTO</label>
                                            <input type="file" class="form-control" id="FOTO" name="FOTO" accept="image/gif, image/jpeg, image/png">
                                        </div>
                                    `
                                }
                            },
                            buttons: {
                                cancel: "Batal",
                                confirm: {
                                    text: "Update",
                                    closeModal: false,
                                    className: "btn-update-status",
                                    value: true,
                                    attributes: {
                                        disabled: "disabled" // Awalnya tombol Update dinonaktifkan
                                    }
                                }
                            },
                            closeOnClickOutside: false
                        }).then((confirm) => {
                            if (confirm) {
                                let selectedStatus = $("input[name='status_ticket']:checked").val();
                                let keterangan = $("#KETERANGAN").val();
                                let objek_ditangani = $("#OBJEK_DITANGANI").val();
                                let foto = $("#FOTO").val();

                                if (!selectedStatus) {
                                    swal("Pilih status terlebih dahulu!", {
                                        icon: "warning"
                                    });
                                    return;
                                }

                                if (!keterangan) {
                                    swal("Masukkan keterangan!", {
                                        icon: "warning"
                                    });
                                    return;
                                }

                                // Kirim data ke backend via AJAX
                                $.ajax({
                                    url: "<?php echo base_url(); ?>" + "ticket/updateStatus",
                                    method: "POST",
                                    dataType: "json",
                                    data: {
                                        status_ticket: selectedStatus,
                                        id_ticket: id_ticket,
                                        prosentase: selectedStatus, // Progress sama dengan status
                                        objek_ditangani: objek_ditangani,
                                        keterangan: keterangan,
                                        foto: foto
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            swal("Berhasil!", "Status tiket berhasil diperbarui.", "success")
                                                .then(() => {
                                                    updateProgressBar(id_ticket, selectedStatus);
                                                    location.reload();
                                                });
                                        } else {
                                            swal("Gagal!", response.error, "error");
                                        }
                                    },
                                    error: function() {
                                        swal("Error!", "Tidak dapat terhubung ke server.", "error");
                                    }
                                });
                            }
                        });

                        // Set radio button sesuai status dari database setelah SweetAlert selesai render
                        setTimeout(() => {
                            $(`input[name='status_ticket'][value='${currentStatus}']`).prop("checked", true).trigger("change");

                            // Pastikan tombol Update tetap disabled saat pertama kali terbuka
                            $(".btn-update-status").prop("disabled", true);
                        }, 500);

                        // Event listener untuk input KETERANGAN
                        $(document).on("input", "#KETERANGAN", function() {
                            let isFilled = $(this).val().trim() !== "";
                            $(".btn-update-status").prop("disabled", !isFilled);

                            if (isFilled) {
                                if ($(this).val().toLowerCase().includes("validasi")) {
                                    // CEK JIKA ISI INPUTAN MENGANDUNG KATA "VALIDASI" MAKA SET status_ticket = 50
                                    $(`input[name='status_ticket'][value='50']`).prop("checked", true).trigger("change");
                                    return;
                                } else if ($(this).val().toLowerCase().includes("selesai")) {
                                    // CEK JIKA ISI INPUTAN MENGANDUNG KATA "SELESAI" MAKA SET status_ticket = 100
                                    $(`input[name='status_ticket'][value='100']`).prop("checked", true).trigger("change");
                                    return;
                                } else {
                                    // CEK JIKA ISI INPUT KETERANGAN TIDAK KOSONG AUTO SET status_ticket = 25
                                    $(`input[name='status_ticket'][value='25']`).prop("checked", true).trigger("change");
                                }
                            }
                        });
                    });

                    // Fungsi untuk update tampilan progress bar
                    function updateProgressBar(id, progressValue) {
                        $(`.progress-bar[data-id='${id}']`)
                            .css("width", progressValue + "%")
                            .attr("aria-valuenow", progressValue)
                            .text(progressValue + "%");
                    }

                    // Fungsi untuk mengatur kelas warna ketika radio button dipilih
                    $(document).on("change", "input[name='status_ticket']", function() {
                        $('.status').removeClass('bg-warning bg-info bg-danger bg-success text-white');

                        if ($('#status0').is(':checked')) {
                            $('#label-status0').addClass('bg-warning text-white');
                        } else if ($('#status1').is(':checked')) {
                            $('#label-status1').addClass('bg-info text-white');
                        } else if ($('#status2').is(':checked')) {
                            $('#label-status2').addClass('bg-danger text-white');
                        } else if ($('#status3').is(':checked')) {
                            $('#label-status3').addClass('bg-success text-white');
                        }

                        let progressValue = $(this).val();
                        updateProgressBar(progressValue);
                    });
                });

                // Hapus semua data localStorage & sessionStorage ketika user meninggalkan halaman
                $(window).on('beforeunload', function() {
                    localStorage.clear(); // Hapus semua data localStorage
                    sessionStorage.clear(); // Hapus semua data sessionStorage
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>