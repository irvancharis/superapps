            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Data Ticketing</h4>
                                    <div class="card-header-action">
                                        <a href="<?php echo base_url('ticket/tambah_view') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center pt-3">
                                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                class="custom-control-input" id="checkbox-all">
                                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </th>
                                                    <th>TICKET ID</th>
                                                    <th>ORDER BY</th>
                                                    <th>SITE</th>
                                                    <th>APPROVAL</th>
                                                    <th>TECHNICIAN</th>
                                                    <th>STATUS</th>
                                                    <th>CLEAR AT</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_TICKET as $index => $d) : ?>
                                                    <tr>
                                                        <td class="text-center pt-2">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                    id="checkbox-1">
                                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $d->IDTICKET; ?></td>
                                                        <td><?php echo $d->REQUESTBY; ?></td>
                                                        <td><?php echo $d->NAMA_AREA; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($d->APPROVAL_TICKET == 0) {
                                                                echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                            } elseif ($d->APPROVAL_TICKET == 1) {
                                                                echo '<span class="badge badge-success">Disetujui</span>';
                                                            } else {
                                                                echo '<span class="badge badge-danger">Ditolak</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $d->NAME_TECHNICIAN; ?></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0"
                                                                    aria-valuemax="100" id="progress-bar" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                            </div>
                                                        </td>
                                                        <td> <?php
                                                                if (!empty($d->DATE_TICKET_DONE)) {
                                                                    $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                    $now = new DateTime($d->DATE_TICKET);
                                                                    $diff = $now->diff($date_done);

                                                                    // Format hasil: "X hari, Y jam, Z menit"
                                                                    echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                } else {
                                                                    echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                }
                                                                ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                <div class="dropdown-menu">
                                                                    <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a>
                                                                    <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Edit</a>
                                                                    <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a>
                                                                    <a href="#" class="dropdown-item has-icon update-status" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Status</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="settingSidebar">
                    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                    </a>
                    <div class="settingSidebar-body ps-container ps-theme-default">
                        <div class=" fade show active">
                            <div class="setting-panel-header">Setting Panel
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Select Layout</h6>
                                <div class="selectgroup layout-color w-50">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                        <span class="selectgroup-button">Light</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                        <span class="selectgroup-button">Dark</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                <div class="selectgroup selectgroup-pills sidebar-color">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Color Theme</h6>
                                <div class="theme-setting-options">
                                    <ul class="choose-theme list-unstyled mb-0">
                                        <li title="white" class="active">
                                            <div class="white"></div>
                                        </li>
                                        <li title="cyan">
                                            <div class="cyan"></div>
                                        </li>
                                        <li title="black">
                                            <div class="black"></div>
                                        </li>
                                        <li title="purple">
                                            <div class="purple"></div>
                                        </li>
                                        <li title="orange">
                                            <div class="orange"></div>
                                        </li>
                                        <li title="green">
                                            <div class="green"></div>
                                        </li>
                                        <li title="red">
                                            <div class="red"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="mini_sidebar_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Mini Sidebar</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="sticky_header_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Sticky Header</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                    <i class="fas fa-undo"></i> Restore Default
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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


            <!-- Modal Hapus -->
            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Hapus Data Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formHapusTicket">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" id="id_ticket_hapus" class="form-control" placeholder="ID" name="id_ticket_hapus">
                                    <p class="text-center">Apakah anda yakin ingin menghapus data ini?</p>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary" id="btnSimpan">Hapus</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php $this->load->view('layout/footer'); ?>

            <script>
                $(document).ready(function() {
                    // Fungsi untuk update tampilan progress bar
                    function updateProgressBar(progressValue) {
                        $("#progress-bar")
                            .css("width", progressValue + "%") // Ubah lebar progress bar
                            .attr("aria-valuenow", progressValue) // Update atribut aksesibilitas
                            .text(progressValue + "%"); // Ubah teks progress bar
                    }

                    $('.hapus-btn').on('click', function() {
                        const id = $(this).data('id');

                        // Isi form di modal edit
                        $('#id_ticket_hapus').val(id);
                    });

                    $('#formHapusTicket').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/hapus", // Endpoint untuk proses input
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

                    // Ambil nilai status_ticket dari elemen yang sudah ada di halaman
                    let progressValue = $("#progress-bar").data("status");

                    // Pastikan nilai progress tidak null atau undefined
                    if (progressValue !== undefined) {
                        updateProgressBar(progressValue);
                    }

                    // Update Status Ticket
                    $(".update-status").click(function() {
                        let id_ticket = $(this).data("id");

                        // Ambil status tiket dari atribut data
                        let currentStatus = $(this).data("status");

                        swal({
                            title: "Update Status Ticket",
                            content: {
                                element: "div",
                                attributes: {
                                    innerHTML: `
                    <div class="selectgroup selectgroup-pills">
                        <label class="selectgroup-item">
                            <input type="radio" name="status_ticket" value="0" class="selectgroup-input-radio" id="status0">
                            <span class="selectgroup-button status" id="label-status0">DALAM ANTRIAN</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status_ticket" value="25" class="selectgroup-input-radio" id="status1">
                            <span class="selectgroup-button status" id="label-status1">SEDANG DIKERJAKAN</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status_ticket" value="50" class="selectgroup-input-radio" id="status2">
                            <span class="selectgroup-button status" id="label-status2">MENUNGGU VALIDASI</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status_ticket" value="100" class="selectgroup-input-radio" id="status3">
                            <span class="selectgroup-button status" id="label-status3">SELESAI</span>
                        </label>
                    </div>
                    `
                                }
                            },
                            buttons: {
                                cancel: "Batal",
                                confirm: {
                                    text: "Update",
                                    closeModal: false
                                }
                            },
                            closeOnClickOutside: false
                        }).then((confirm) => {
                            if (confirm) {
                                let selectedStatus = $("input[name='status_ticket']:checked").val();
                                if (!selectedStatus) {
                                    swal("Pilih status terlebih dahulu!", {
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
                                        prosentase: selectedStatus // Progress sama dengan status
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            swal("Berhasil!", "Status tiket berhasil diperbarui.", "success")
                                                .then(() => {
                                                    // Reload halaman setelah update sukses
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

                        // Tunggu SweetAlert selesai render, lalu set radio button sesuai status dari database
                        setTimeout(() => {
                            $(`input[name='status_ticket'][value='${currentStatus}']`).prop("checked", true).trigger("change");
                        }, 500);
                    });

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


                    // Update Approval Ticket
                    $(".update-approval").click(function() {
                        let id_ticket = $(this).data("id");

                        // Ambil status tiket dari atribut data
                        let currentStatus = $(this).data("approval");

                        swal({
                            title: "Update Approval Ticket",
                            content: {
                                element: "div",
                                attributes: {
                                    innerHTML: `
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="approval_ticket" value="0" class="selectgroup-input-radio" id="approval0">
                                            <span class="selectgroup-button approval" id="label-approval0">DALAM ANTRIAN</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="approval_ticket" value="1" class="selectgroup-input-radio" id="approval1">
                                            <span class="selectgroup-button approval" id="label-approval1">DISETUJUI</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="approval_ticket" value="2" class="selectgroup-input-radio" id="approval2">
                                            <span class="selectgroup-button approval" id="label-approval2">DITOLAK</span>
                                        </label>
                                    </div>
                    `
                                }
                            },
                            buttons: {
                                cancel: "Batal",
                                confirm: {
                                    text: "Update",
                                    closeModal: false
                                }
                            },
                            closeOnClickOutside: false
                        }).then((confirm) => {
                            if (confirm) {
                                let selectedStatus = $("input[name='approval_ticket']:checked").val();
                                if (!selectedStatus) {
                                    swal("Pilih Approval terlebih dahulu!", {
                                        icon: "warning"
                                    });
                                    return;
                                }

                                // Kirim data ke backend via AJAX
                                $.ajax({
                                    url: "<?php echo base_url(); ?>" + "ticket/updateApproval",
                                    method: "POST",
                                    dataType: "json",
                                    data: {
                                        approval_ticket: selectedStatus,
                                        id_ticket: id_ticket,
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            swal("Berhasil!", "Approval berhasil diperbarui.", "success")
                                                .then(() => {
                                                    // Reload halaman setelah update sukses
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

                        // Tunggu SweetAlert selesai render, lalu set radio button sesuai status dari database
                        setTimeout(() => {
                            $(`input[name='approval_ticket'][value='${currentStatus}']`).prop("checked", true).trigger("change");
                        }, 500);
                    });

                    // Fungsi untuk mengatur kelas warna ketika radio button dipilih
                    $(document).on("change", "input[name='approval_ticket']", function() {
                        $('.approval').removeClass('bg-warning bg-info bg-danger bg-success text-white');

                        if ($('#approval0').is(':checked')) {
                            $('#label-approval0').addClass('bg-warning text-white');
                        } else if ($('#approval1').is(':checked')) {
                            $('#label-approval1').addClass('bg-success text-white');
                        } else if ($('#approval2').is(':checked')) {
                            $('#label-approval2').addClass('bg-danger text-white');
                        }
                    });
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>