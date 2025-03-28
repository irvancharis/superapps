<!DOCTYPE html>
<html lang="en">


<!-- contact.html  21 Nov 2019 04:05:04 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- MODIFIKASI SEPTIAN SUPAYA SUPPORT ZROK (URL TUNNEL) -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>SAGROUP TICKETING</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/components.css'); ?>">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <!-- Fancybox -->
    <script src="<?php echo base_url('assets/js/fancybox.umd.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fancybox.css'); ?>" />
    <!-- Fancybox -->
    <script src="<?php echo base_url('assets/js/fancybox.umd.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fancybox.css'); ?>" />
    <!-- Preview Image -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/summernote/summernote-bs4.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'); ?>">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('assets/img/Logo SA X7.ico'); ?>' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .SA {
            font-size: 2em;
            color: #e91b31;
            font-weight: bold;
            font-family: 'Barlow Semi Condensed', sans-serif;
            letter-spacing: 0;
            font-style: italic;
        }

        .GROUP {
            font-size: 2em;
            color: #202d45;
            font-weight: bold;
            font-family: 'Barlow Semi Condensed', sans-serif;
            letter-spacing: 0;
            font-style: italic;
        }

        .judul-ticketing {
            color: #202d45;
            font-weight: bold;
            font-family: 'Barlow Semi Condensed', sans-serif;
            letter-spacing: 2px;
            font-style: italic;
        }

        .chat-icon {
            width: 60px;
            height: 60px;
            background-color: #202d45;
            position: fixed;
            bottom: 20px;
            right: 20px;
            border-radius: 50%;
            background-image: url(<?php echo base_url('assets/img/operator.png'); ?>);
            background-repeat: no-repeat;
            background-position: center;
            background-size: 60%;
            cursor: pointer;
            z-index: 2;
        }

        .chat-icon.active {
            background-image: url(<?php echo base_url('assets/img/closeIcon.png'); ?>);
            background-size: 40%;
        }

        .main-chat-box {
            position: fixed;
            right: 20px;
            bottom: 100px;
            background-color: #fff;
            display: none;
            z-index: 1;
        }

        .main-chat-box .traingle-shadow {
            width: 70px;
            height: 80px;
            position: absolute;
            overflow: hidden;
            bottom: -74px;
            right: -14px;
            box-shadow: 0 16px 10px -20px rgba(0, 0, 0, 0.5);
            transform: rotate(100deg);
            z-index: 2;
        }

        .main-chat-box .traingle-shadow ::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            background: #fff;
            transform: rotate(45deg);
            top: 75px;
            left: 25px;
            box-shadow: -1px -1px 10px -2px rgba(0, 0, 0, 0.5);
        }

        .main-chat-box .chatBox {
            width: 200px;
            background-color: #fff;
            border-radius: 5px;
            position: relative;
            bottom: 0px;
            right: 0px;
            display: inline-block;
            padding: 10px 0;
            margin: 0;
            z-index: 1;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        }

        .main-chat-box .chatBox li {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
            float: left;
            font-size: 14px;
            line-height: 21px;
            color: #000;
            margin: 10px 0;
            padding: 0 20px;
        }

        .main-chat-box .chatBox li span.icon-circle {
            width: 100%;
            float: left;
            font-size: 14px;
            line-height: 21px;
            width: 40px;
            height: 40px;
            background-color: #202d45;
            border-radius: 50%;
            position: relative;
        }

        .main-chat-box .chatBox li span.icon-circle img {
            max-width: 70%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .main-chat-box .chatBox li abbr {
            float: left;
            position: relative;
            font-size: 12px;
            line-height: 18px;
            font-family: 'Times New Roman', Times, serif;
            color: #202d45;
            top: 10px;
            left: 10px;
        }

        .chat-icon.btnblickanim {
            opacity: 1;
            animation: blink 1s ease-in-out infinite;
        }

        @keyframes blink {
            0% {
                opacity: 0.25;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.25;
            }
        }
    </style>
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
                        <div class="login-brand">
                            <img src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>" alt="" class="img-fluid" style="width: 100px    ; height: 100px;">
                            <span class="SA">SA</span> <span class="GROUP">GROUP</span>
                        </div>
                        <div class="card card-danger">
                            <div class="row m-0">
                                <div class="col-12 col-md-12 col-lg-12 p-0">
                                    <form class="needs-validation" novalidate="" id="formTicketClient" enctype="multipart/form-data">
                                        <div class="card-header">
                                            <h4 class="judul-ticketing">TICKET PROGRESS UPDATE</h4>
                                            <div class="card-header-action">
                                                <div class="form-group row" style="display: none;">
                                                    <label class="col-sm-5 col-form-label">Tgl Request</label>
                                                    <div class="col-sm-7">
                                                        <input type="date" name="date_ticket" id="date_ticket" class="form-control" value="<?= date('Y-m-d', strtotime(date('Y-m-d'))) ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-12 <?php if ($ticket->FOTO !== null) : ?> col-md-8 col-lg-8 <?php else : ?> col-md-12 col-lg-12 <?php endif; ?>">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <address>
                                                                        <strong>Request Oleh:</strong><br>
                                                                        <?php echo strtoupper($ticket->REQUESTBY); ?><br>
                                                                        <?php echo strtoupper($ticket->EMAIL_TICKET); ?><br>
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <address>
                                                                        <strong>Departemen:</strong><br>
                                                                        <?php echo strtoupper($get_departemen->NAMA_DEPARTEMEN); ?>
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-3 text-md-right">
                                                                    <address>
                                                                        <strong>Type Keluhan:</strong><br>
                                                                        <?php echo strtoupper($ticket->TYPE_TICKET); ?><br>
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-3 text-md-right">
                                                                    <address>
                                                                        <strong>Deskripsi Keluhan:</strong><br>
                                                                        <?php echo strtoupper($ticket->DESCRIPTION_TICKET); ?><br>
                                                                    </address>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <address>
                                                                        <strong>Departemen Diminta:</strong><br>
                                                                        <?php echo strtoupper($get_departemen_request->NAMA_DEPARTEMEN); ?><br>
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <address>
                                                                        <strong>Ditangani Oleh (Teknisi):</strong><br>
                                                                        <?php echo strtoupper($get_technician->NAME_TECHNICIAN); ?>
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-3 text-md-right">
                                                                    <address>
                                                                        <strong>Tanggal Request:</strong><br>
                                                                        <?php echo date('d M Y H:i', strtotime($ticket->DATE_TICKET)); ?><br>
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-3 text-md-right">
                                                                    <address>
                                                                        <strong>Selesai Pada:</strong><br>
                                                                        <?php
                                                                        if (!empty($ticket->DATE_TICKET_DONE)) {
                                                                            $date_done = new DateTime($ticket->DATE_TICKET_DONE);
                                                                            $now = new DateTime($ticket->DATE_TICKET);
                                                                            $diff = $now->diff($date_done);

                                                                            // Format hasil: "X hari, Y jam, Z menit"
                                                                            echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                        } else {
                                                                            echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                        }
                                                                        ?>
                                                                    </address>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
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
                                                            </div>
                                                        </div>
                                                        <?php if ($ticket->FOTO !== null) : ?>
                                                            <div class="col-12 col-md-4 col-lg-4">
                                                                <div class="d-flex justify-content-center my-5 my-md-0 my-lg-0">
                                                                    <?php
                                                                    // Ambil ekstensi file
                                                                    $fileExtension = pathinfo($ticket->FOTO, PATHINFO_EXTENSION);

                                                                    // Daftar ekstensi foto
                                                                    $photoExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                                                                    // Daftar ekstensi dokumen
                                                                    $documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                                                                    // Cek apakah file adalah foto
                                                                    if (in_array(strtolower($fileExtension), $photoExtensions)) {
                                                                        // Jika file adalah foto, tampilkan gambar dengan Fancybox
                                                                        echo '<a href="' . base_url('assets/uploads/ticket/') . $ticket->FOTO . '" data-fancybox data-caption="Single image" data-image="' . base_url('assets/uploads/ticket/') . $ticket->FOTO . '" data-title="' . $ticket->KETERANGAN . '">
                                                                        <img class="img-thumbnail" style="filter: drop-shadow(0px 0px 8px rgba(0, 0, 0, 0.3));" width="150px" src="' . base_url('assets/uploads/ticket/' . $ticket->FOTO) . '" alt="">
                                                                    </a>';
                                                                    } else if (in_array(strtolower($fileExtension), $documentExtensions)) {
                                                                        // Jika file adalah dokumen, tampilkan tautan untuk mengunduh
                                                                        echo '<a href="' . base_url('assets/uploads/ticket/') . $ticket->FOTO . '" download>
                                                                        <i class="fas fa-file-download"></i> Download ' . $ticket->FOTO . '
                                                                    </a>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <?php if ($ticket->STATUS_TICKET == 100) : ?>
                                                <button type="button" class="btn btn-primary btn-icon icon-left update-status d-none" data-id="<?= $ticket->IDTICKET; ?>" data-status="<?= $ticket->STATUS_TICKET; ?>">
                                                    <i class="fas fa-sync-alt"></i> Update Pengerjaan
                                                </button>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-primary btn-icon icon-left update-status" data-id="<?= $ticket->IDTICKET; ?>" data-status="<?= $ticket->STATUS_TICKET; ?>">
                                                    <i class="fas fa-sync-alt"></i> Update Pengerjaan
                                                </button>
                                            <?php endif; ?>
                                            <button type="button" onclick="history.go(-1)" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card card-danger">
                            <div class="card-header">
                                <h4 class="judul-ticketing mx-auto"><i class="fas fa-history"></i> HISTORY PENGERJAAN</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
                                        <thead>
                                            <tr>
                                                <th data-width="40">#</th>
                                                <th>Tgl & Waktu Pengerjaan</th>
                                                <th>Objektif Pengerjaan</th>
                                                <th>Keterangan Pengerjaan</th>
                                                <th>Dikerjakan Oleh</th>
                                                <th class="text-center">Foto Bukti Pengerjaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($M_TICKET_DETAIL_HISTORY as $index => $d) : ?>
                                                <tr height="150">
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td><?php echo date('d-m-Y H:i', strtotime($d->TGL_PENGERJAAN)); ?></td>
                                                    <td><?php echo $d->OBJEK_DITANGANI; ?></td>
                                                    <td><?php echo $d->KETERANGAN; ?></td>
                                                    <td><?php echo $d->NAME_TECHNICIAN; ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($d->FOTO == null) {
                                                            echo "-";
                                                        } else {
                                                        ?>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" data-fancybox data-caption="Single image" data-image="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" data-title="<?= $d->KETERANGAN; ?>">
                                                                    <img src="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" width="150px" alt="<?= $d->KETERANGAN; ?>" class="img-thumbnail">
                                                                </a>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
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
            </div>
        </section>
    </div>

    <?php $this->load->view('layout/footer'); ?>

    <script>
        $(document).ready(function() {
            // Datatable
            $('#table-pengerjaan').DataTable({
                paging: false,
                searching: false,
                info: false
            });

            // 🚀 1. Inisialisasi Progress Bar Saat Halaman Dimuat
            $(".progress-bar").each(function() {
                const id = $(this).data("id");
                const progressValue = $(this).data("status");
                if (progressValue !== undefined) {
                    updateProgressBar(id, progressValue);
                }
            });

            // Update Status Ticket
            $(".update-status").click(function() {
                let id_ticket = $(this).data("id");
                let currentStatus = $(this).data("status");

                swal({
                    title: "Update Pengerjaan",
                    content: {
                        element: "div",
                        attributes: {
                            innerHTML: `
                                    <form id="form-update-status" class="needs-validation" novalidate enctype="multipart/form-data">
                                        <div class="form-group d-none">
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
                                            <label for="OBJEK_DITANGANI">OBJEKTIF PENGERJAAN</label>
                                            <input type="text" class="form-control" id="OBJEK_DITANGANI" name="OBJEK_DITANGANI" placeholder="Komputer, Printer, Kabel, dll" required>
                                            <small class="form-text text-muted mt-2 text-left hint-message" style="display: none;"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="KETERANGAN">KETERANGAN PENGERJAAN</label>
                                            <input type="text" class="form-control" id="KETERANGAN" name="KETERANGAN" placeholder="Analisa Komputer, Penggantian HDD, dll" required>   
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center flex-column">
                                            <label for="image-upload">FOTO BUKTI PENGERJAAN</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Upload Gambar</label>
                                                <input type="file" name="image" id="image-upload" accept="image/gif, image/jpeg, image/png, image/jpg, image/webp, application/pdf" />
                                            </div>
                                        </div>
                                    </form>
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
                        let foto = $("#image-upload")[0].files[0]; // Ambil file yang diupload

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

                        // Buat FormData untuk mengirim file
                        let formData = new FormData();
                        formData.append('status_ticket', selectedStatus);
                        formData.append('id_ticket', id_ticket);
                        formData.append('prosentase', selectedStatus);
                        formData.append('objek_ditangani', objek_ditangani);
                        formData.append('keterangan', keterangan);
                        formData.append('FOTO', foto);

                        // Cek isi FormData
                        // for (let pair of formData.entries()) {
                        //     console.log(pair[0] + ': ' + pair[1]);
                        // }
                        // exit;

                        // Kirim data ke backend via AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/updateStatus",
                            method: "POST",
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            data: formData,
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

                // **Inisialisasi preview setelah modal muncul**
                setTimeout(() => {
                    if ($("#image-upload").length > 0) {
                        $.uploadPreview({
                            input_field: "#image-upload",
                            preview_box: "#image-preview",
                            label_field: "#image-label",
                            label_default: "Choose File",
                            label_selected: "Change File",
                            no_label: false
                        });
                    }
                }, 500);

                // Set radio button sesuai status dari database setelah SweetAlert selesai render
                setTimeout(() => {
                    $(`input[name='status_ticket'][value='${currentStatus}']`).prop("checked", true).trigger("change");

                    // Pastikan tombol Update tetap disabled saat pertama kali terbuka
                    $(".btn-update-status").prop("disabled", true);
                }, 500);

                // Event listener untuk input KETERANGAN
                $(document).on("input", "#OBJEK_DITANGANI", function() {
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

                // **Format input teks menjadi huruf kapital**
                $(document).on('input', '#OBJEK_DITANGANI, #KETERANGAN', function() {
                    $(this).val($(this).val().toUpperCase());
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
                // let hintMessage = $(".hint-message"); // Target elemen hint

                // // Reset pesan hint
                // hintMessage.html("").hide();

                $('.status').removeClass('bg-warning bg-info bg-danger bg-success text-white');

                if ($('#status0').is(':checked')) {
                    $('#label-status0').addClass('bg-warning text-white');
                } else if ($('#status1').is(':checked')) {
                    $('#label-status1').addClass('bg-info text-white');
                    // hintMessage.html("*). Ketik <span class='text-danger'>VALIDASI</span> untuk mengubah status ke <span class='badge badge-danger' style='font-size: small;'>MENUNGGU VALIDASI</span>.").show();
                } else if ($('#status2').is(':checked')) {
                    $('#label-status2').addClass('bg-danger text-white');
                    // hintMessage.html("*). Ketik <span class='text-success'>SELESAI</span> untuk mengubah status ke <span class='badge badge-success' style='font-size: small;'>SELESAI</span>.").show();
                } else if ($('#status3').is(':checked')) {
                    $('#label-status3').addClass('bg-success text-white');
                }

                let progressValue = $(this).val();
                updateProgressBar(progressValue);
            });

            // Inisialisasi Fancybox
            Fancybox.bind("[data-fancybox]");


            // Auto Load Data Otomatis
            // Config
            const CHECK_INTERVAL = 15000; // 30 detik
            const NOTIFICATION_TIMEOUT = 30000; // 60 detik

            // Fungsi utama pengecekan update
            function checkForUpdates() {
                $.ajax({
                    url: "<?php echo base_url(); ?>ticket/check_updates_technician",
                    method: "POST",
                    dataType: "json",
                    success: function(response) {
                        console.debug('Update check:', response);
                        if (response.has_update) {
                            showUpdateNotification();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error checking updates:", error);
                    }
                });
            }

            // Tampilkan notifikasi
            function showUpdateNotification() {
                const lastNotified = localStorage.getItem('lastNotified');
                const now = new Date().getTime();

                // Cek jika notifikasi sudah muncul dalam 1 menit terakhir
                if (lastNotified && (now - lastNotified) < NOTIFICATION_TIMEOUT) {
                    return;
                }

                swal({
                    title: "Data Progress Ticket Diperbarui!",
                    text: "Ada perubahan data terbaru pada progress ticketing.\n\nTerakhir diperiksa: " + new Date().toLocaleTimeString(),
                    icon: "info",
                    buttons: {
                        confirm: {
                            text: "Refresh",
                            value: true,
                            visible: true,
                            className: "btn-refresh",
                            closeModal: true
                        },
                        cancel: {
                            text: "Nanti",
                            value: false,
                            visible: true,
                            className: "btn-cancel",
                            closeModal: true
                        }
                    }
                }).then((result) => {
                    if (result) {
                        localStorage.setItem('lastNotified', now.toString());
                        location.reload();
                    } else {
                        localStorage.setItem('lastNotified', now.toString());
                    }
                });
            }
            // Inisialisasi
            // Jalankan segera saat halaman load
            checkForUpdates();

            // Jadwalkan pengecekan berkala
            setInterval(checkForUpdates, CHECK_INTERVAL);

            // Untuk debugging
            window.debugCheckUpdate = checkForUpdates;
        });

        // Hapus semua data localStorage & sessionStorage ketika user meninggalkan halaman
        $(window).on('beforeunload', function() {
            localStorage.clear(); // Hapus semua data localStorage
            sessionStorage.clear(); // Hapus semua data sessionStorage
        });
    </script>
</body>

<!-- contact.html  21 Nov 2019 04:05:05 GMT -->

</html>