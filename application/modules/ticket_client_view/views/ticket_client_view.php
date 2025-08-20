<!DOCTYPE html>
<html lang="en">


<!-- contact.html  21 Nov 2019 04:05:04 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- MODIFIKASI SEPTIAN SUPAYA SUPPORT ZROK (URL TUNNEL) -->
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
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
    <!-- Preview Image -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/summernote/summernote-bs4.css'); ?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bundles/jquery-selectric/selectric.css'); ?>"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'); ?>">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('assets/img/Logo SA X7.ico'); ?>' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/select2/dist/css/select2.min.css'); ?>">
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

        .image-preview {
            width: 100%;
            min-height: 100px;
            border: 2px dashed #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            text-align: center;
        }

        .image-preview iframe {
            width: 100%;
            height: 200px;
            border: none;
        }

        .image-preview i {
            font-size: 50px;
            color: #007bff;
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
                                            <h4 class="judul-ticketing">TICKETING</h4>
                                            <button type="button" id="guideButton" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-video"></i> Panduan Ticket
                                            </button>
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
                                                <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>NAMA</label>
                                                    <input type="text" name="request_by" id="request_by" placeholder="" class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        Masukkan NAMA anda
                                                    </div>
                                                </div>
                                                <!-- TELP -->
                                                <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>NO. WHATSAPP</label>
                                                    <input type="text" class="form-control" id="telp" placeholder="" name="telp" required>
                                                    <div class="invalid-feedback">
                                                        Masukkan NO. WHATSAPP dengan benar!
                                                    </div>
                                                </div>
                                                <!-- E-MAIL -->
                                                <!-- <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>E-MAIL</label>
                                                    <input type="email" class="form-control" id="email_ticket" name="email_ticket">
                                                    <div class="invalid-feedback">
                                                        Masukkan Email dengan benar!
                                                    </div>
                                                </div> -->
                                                <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>DEPARTEMEN ANDA</label>
                                                    <select name="id_departemen" id="id_departemen" class="form-control select2" required>
                                                        <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                                        <?php foreach ($get_departement as $row) : ?>
                                                            <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <p style="color:red;font-style: italic;">*). Jika DEPARTEMEN tidak terdaftar, pilih UMUM</p>
                                                    <div class="invalid-feedback">
                                                        Silahkan pilih DEPARTEMEN ANDA!
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>AREA</label>
                                                    <select name="id_area" id="id_area" class="form-control" required>
                                                        <option value="" class="text-center" selected disabled>-- Pilih Area --</option>
                                                        <?php foreach ($get_area as $row) : ?>
                                                            <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Silahkan pilih AREA!
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-6 col-lg-6 d-none">
                                                    <label>DEPARTEMEN DIREQUEST</label>
                                                    <select id="id_departemen_request" class="form-control" disabled>
                                                        <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                                        <?php foreach ($get_departement as $row) : ?>
                                                            <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <input type="hidden" name="id_departemen_request" id="select_id_departemen_request">
                                                    <div class="invalid-feedback">
                                                        Silahkan masukkan DEPARTEMEN DIREQUEST!
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-12 col-lg-12">
                                                    <label class="form-label">PILIH TYPE KELUHAN</label>
                                                    <div class="selectgroup selectgroup-pills type-ticket">
                                                        <!-- <p style="color:red;font-style: italic;">*). Muncul setelah memilih DEPARTEMEN DIREQUEST</p> -->
                                                        <p style="color:red;font-style: italic;">*). Muncul setelah memilih AREA</p>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-12 col-lg-12">
                                                    <label>DESKRIPSI KELUHAN</label>
                                                    <textarea name="description_ticket" placeholder="" class="form-control" id="description_ticket" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Silahkan masukkan DESKRIPSI KELUHAN anda!
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-12 col-lg-12" id="image-container">
                                                    <label>FOTO BUKTI KELUHAN</label>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div id="image-preview" class="image-preview">
                                                            <label for="image-upload" id="image-label">Upload Gambar</label>
                                                            <input type="file" name="image" id="image-upload"
                                                                accept="image/gif, image/jpeg, image/png, image/webp, application/pdf" />
                                                        </div>
                                                    </div>
                                                    <p style="color:red;font-style: italic;">*). Boleh dikosongi</p>
                                                </div>
                                                <div class="form-group col-12 col-md-6 col-lg-6" id="dokumen-container" style="display: none;">
                                                    <label>UPLOAD DOKUMEN</label>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div id="dokumen-preview" class="image-preview">
                                                            <label for="dokumen-upload" id="dokumen-label">Upload Dokumen</label>
                                                            <input type="file" name="dokumen" id="dokumen-upload"
                                                                accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-12 col-lg-12">
                                                    <div class="alert alert-light alert-has-icon">
                                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                                        <div class="alert-body">
                                                            <div class="alert-title">Informasi</div>
                                                            Jika TICKET STUCK (MACET/ERROR) harap refresh halaman dan kirim ulang TICKET tanpa UPLOAD GAMBAR.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex flex-wrap justify-content-center justify-content-sm-between text-center">
                                            <div class="mb-2 mb-sm-0">
                                                <button class="btn btn-info me-sm-2 mb-2 mb-sm-0" onclick="cekAntrian()">
                                                    <i class="fas fa-list"></i> Cek Antrian Ticket
                                                </button>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary me-2 mb-2 mb-sm-0">
                                                    <i class="fas fa-paper-plane"></i> Kirim
                                                </button>
                                                <button type="reset" class="btn btn-danger mb-2 mb-sm-0">
                                                    <i class="fas fa-redo"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1 mt-5">
                        <!-- <div class="card">
                            <div class="card-header">
                                <h4 class="judul-ticketing mx-auto"><i class="fas fa-list"></i> DAFTAR ANTRIAN TICKETING</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>TICKET ID</th>
                                                <th>ORDER BY</th>
                                                <th>SITE</th>
                                                <th>APPROVAL</th>
                                                <th>TECHNICIAN</th>
                                                <th>STATUS</th>
                                                <th>CLEAR AT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($M_TICKET as $index => $d) : ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
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
                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
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
                                                            ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                        <div class="simple-footer">
                            Copyright &copy; SA GROUP <?php echo date('Y'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Floating Button Chat -->
    <!-- <span class="chat-icon btnblickanim"></span>
    <div class="main-chat-box">
        <span class="traingle-shadow"></span>
        <ul class="chatBox">
            <li class="menu-header">IT Administrator</li>
            <li>
                <a href="https://wa.me/6287777176997" target="_blank">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/whatsapp.png'); ?>" alt="whatsapp">
                    </span>
                    <abbr title="">RIO</abbr>
                </a>
            </li>
            <li>
                <a href="https://wa.me/628175766631" target="_blank">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/whatsapp.png'); ?>" alt="facebook">
                    </span>
                    <abbr title="">TAUFIQ</abbr>
                </a>
            </li>
            <li>
                <a href="https://wa.me/6281357501196" target="_blank">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/whatsapp.png'); ?>" alt="email">
                    </span>
                    <abbr title="">CHARIS</abbr>
                </a>
            </li>
            <li class="menu-header">IT Support</li>
            <li>
                <a href="https://wa.me/6287777176997" target="_blank">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/whatsapp.png'); ?>" alt="whatsapp">
                    </span>
                    <abbr title="">JUNIYAR</abbr>
                </a>
            </li>
            <li>
                <a href="https://wa.me/628175766631" target="_blank">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/whatsapp.png'); ?>" alt="facebook">
                    </span>
                    <abbr title="">IHSAN</abbr>
                </a>
            </li>
            <li>
                <a href="https://wa.me/6281357501196" target="_blank">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/whatsapp.png'); ?>" alt="email">
                    </span>
                    <abbr title="">SEPTIAN</abbr>
                </a>
            </li>
        </ul>
    </div> -->
    <!-- Floating Button Chat End -->

    <!-- Modal Pilihan Desktop/Mobile -->
    <div id="videoGuideModal" style="display: none; text-align: center;">
        <h3>Pilih Versi Panduan</h3>
        <button onclick="playDesktopVideo()" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; margin: 10px;">
            🖥️ Desktop
        </button>
        <button onclick="playMobileVideo()" style="padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer; margin: 10px;">
            📱 Mobile
        </button>
    </div>

    <!-- Video Desktop -->
    <div id="desktopVideo" style="display: none;">
        <video controls>
            <source src="<?php echo base_url('assets/img/Tutorial/Desktop_Revisi.mp4'); ?>" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
    </div>

    <!-- Video Mobile -->
    <div id="mobileVideo" style="display: none;">
        <video controls>
            <source src="<?php echo base_url('assets/img/Tutorial/Mobile_Revisi.mp4'); ?>" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
    </div>

    <!-- General JS Scripts -->
    <script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
    <!-- Preview Gambar -->
    <script src="<?php echo base_url('assets/bundles/summernote/summernote-bs4.js') ?>"></script>
    <!-- <script src="<?php echo base_url('assets/bundles/jquery-selectric/jquery.selectric.min.js') ?>"></script> -->
    <script src="<?php echo base_url('assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js') ?>"></script>
    <!-- <script src="<?php echo base_url('assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') ?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/js/page/create-post.js') ?>"></script> -->
    <!-- Page Specific JS File -->
    <script src="<?php echo base_url('assets/js/page/contact.js') ?>"></script>
    <!-- Template JS File -->
    <script src="<?php echo base_url('assets/js/scripts.js') ?>"></script>
    <!-- Custom JS File -->
    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
    <!-- Sweetalert -->
    <script src="<?php echo base_url('assets/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/page/sweetalert.js'); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url('assets/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            // Set Departemen Direquest langsung ke IT (ganti value sesuai database)
            let defaultDepartemen = '1'; // Ganti dengan KODE_DEPARTEMEN sebenarnya untuk IT
            $('#id_departemen_request').val(defaultDepartemen);
            $('#select_id_departemen_request').val(defaultDepartemen);

            $('.chat-icon').click(function() {
                $(this).toggleClass('active');
                $(this).toggleClass('btnblickanim');
                $('.main-chat-box').toggle();
            });

            $('#formTicketClient').on('submit', function(e) {
                e.preventDefault();

                // Pengecekan validitas form
                const form = this;
                if (!form.checkValidity()) {
                    // Jika form tidak valid, tampilkan pesan error
                    e.stopPropagation();
                    form.classList.add('was-validated');
                    return false;
                }

                // Tampilkan pop-up "Mohon Tunggu"
                swal({
                    title: "Mohon Tunggu",
                    text: "Sedang memproses ticket...",
                    buttons: false, // Sembunyikan tombol OK
                    closeOnClickOutside: false // Tidak boleh menutup dengan mengklik di luar
                });


                // Ambil data dari form
                let formData = new FormData(this);

                // Cek isi FormData
                // for (let pair of formData.entries()) {
                //     console.log(pair[0] + ': ' + pair[1]);
                // }
                // exit;

                // Kirim data ke server melalui AJAX
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "ticket_client_view/insert", // Endpoint untuk proses input
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            swal.close();
                            swal('Sukses', 'Request Ticket Berhasil Dikirim!. Tunggu konfirmasi selanjutnya via WHATSAPP', 'success').then(function() {
                                location.href = "<?php echo base_url(); ?>" + "ticket_client_view/ticket_queue";
                            });
                        } else {
                            swal.close();
                            swal('Gagal', res.error, 'error');
                        }
                    },
                    error: function() {
                        swal.close();
                        swal('Gagal', 'Terjadi kesalahan pada Server !', 'error');
                    }
                });
            });

            // Event listener untuk id_area
            $('#id_area').change(function() {
                const id_area = $(this).val();
                const id_departemen = $('#id_departemen_request').val();

                // Jika id_departemen belum dipilih, tampilkan pesan
                if (!id_departemen) {
                    swal('Peringatan', 'Silakan pilih Departemen Direquest terlebih dahulu.', 'warning');
                    return;
                }

                // Kirim permintaan AJAX untuk mendapatkan type_ticket
                $.ajax({
                    url: "<?php echo base_url(); ?>ticket_client_view/get_departement_joblist",
                    type: 'POST',
                    data: {
                        id_departemen: id_departemen,
                        id_area: id_area
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        console.log(res);

                        if (res.success && res.data) {
                            // Kosongkan pilihan type keluhan sebelumnya
                            $(".type-ticket").empty();

                            // Tambahkan opsi baru dari database
                            res.data.forEach(function(item) {
                                $(".type-ticket").append(`
                            <label class="selectgroup-item">
                                <input type="radio" name="type_ticket" value="${item.NAMA_JOBLIST}" class="selectgroup-input">
                                <span class="selectgroup-button">${item.NAMA_JOBLIST}</span>
                            </label>
                        `);
                            });

                            // Tambahkan event listener untuk radio button type keluhan
                            $('input[name="type_ticket"]').change(function() {
                                let selectedType = $(this).val();

                                // Cek jika kategori keluhan adalah "Register OB Sales" atau "Pindah Rute Sales"
                                if (selectedType === "REGISTER OB SALES" || selectedType === "PINDAH RUTE SALES") {
                                    // Tampilkan input file dokumen
                                    $("#image-container").hide();
                                    $("#dokumen-container").show();
                                } else {
                                    // Sembunyikan input file dokumen
                                    $("#dokumen-container").hide();
                                    $("#image-container").show();
                                }
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

            // Event listener untuk id_departemen_request
            $('#id_departemen_request').change(function() {
                const id_departemen = $(this).val();
                const id_area = $('#id_area').val();

                // Jika id_area belum dipilih, tampilkan pesan
                if (!id_area) {
                    swal('Peringatan', 'Silakan pilih Area terlebih dahulu.', 'warning');
                    return;
                }

                // Kirim permintaan AJAX untuk mendapatkan type_ticket
                $.ajax({
                    url: "<?php echo base_url(); ?>ticket/get_departement_joblist",
                    type: 'POST',
                    data: {
                        id_departemen: id_departemen,
                        id_area: id_area
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
                                <input type="radio" name="type_ticket" value="${item.NAMA_JOBLIST}" class="selectgroup-input" required>
                                <span class="selectgroup-button">${item.NAMA_JOBLIST}</span>
                            </label>
                        `);
                            });

                            // Tambahkan event listener untuk radio button type keluhan
                            $('input[name="type_ticket"]').change(function() {
                                let selectedType = $(this).val();

                                // Cek jika kategori keluhan adalah "Register OB Sales" atau "Pindah Rute Sales"
                                if (selectedType === "REGISTER OB SALES" || selectedType === "PINDAH RUTE SALES") {
                                    // Tampilkan input file dokumen
                                    $("#image-container").hide();
                                    $("#dokumen-container").show();
                                } else {
                                    // Sembunyikan input file dokumen
                                    $("#dokumen-container").hide();
                                    $("#image-container").show();
                                }
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

            // Trigger event change saat halaman pertama kali dimuat
            // $('#id_departemen_request').trigger('change');

            // 🚀 1. Inisialisasi Semua Progress Bar Saat Halaman Dimuat
            $(".progress-bar").each(function() {
                const id = $(this).data("id");
                const progressValue = $(this).data("status");
                if (progressValue !== undefined) {
                    updateProgressBar(id, progressValue);
                }
            });

            // Fungsi untuk update tampilan progress bar
            function updateProgressBar(id, progressValue) {
                $(`.progress-bar[data-id='${id}']`)
                    .css("width", progressValue + "%")
                    .attr("aria-valuenow", progressValue)
                    .text(progressValue + "%");
            }

            // File Preview
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "Choose File", // Default: Choose File
                label_selected: "Change File", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            // 2. Preview Dokumen (Custom Script)
            $("#dokumen-upload").change(function(event) {
                let file = event.target.files[0];
                let previewBox = $("#dokumen-preview");
                let label = $("#dokumen-label");

                if (file) {
                    let fileType = file.type;
                    let fileURL = URL.createObjectURL(file);

                    // Hapus preview sebelumnya (jika ada), tapi JANGAN hapus input file
                    previewBox.find(".file-preview").remove();

                    if (fileType === "application/pdf") {
                        // Preview PDF dalam iframe
                        previewBox.append(`
                    <div class="file-preview mt-2">
                        <iframe src="${fileURL}" width="100%" height="200px"></iframe>
                    </div>
                `);
                    } else if (
                        fileType.includes("word") ||
                        fileType.includes("spreadsheet")
                    ) {
                        // Preview untuk Word / Excel (hanya ikon + nama file)
                        previewBox.append(`
                    <div class="file-preview d-flex flex-column align-items-center mt-2">
                        <i class="fas fa-file-alt fa-3x text-primary"></i>
                        <p class="mt-5">${file.name}</p>
                    </div>
                `);
                    } else {
                        // Jika format tidak didukung
                        swal('PERINGATAN', 'Format file tidak didukung.', 'error');
                        previewBox.append(`<p class="file-preview text-danger" style="margin-top: 100px;">Format file tidak didukung</p>`);
                    }

                    label.text("Change File"); // Ubah label setelah file dipilih
                } else {
                    // Jika tidak ada file yang dipilih
                    previewBox.find(".file-preview").remove();
                    label.text("Upload Dokumen");
                }
            });

            // **Format input teks menjadi huruf kapital**
            $(document).on('input', '#request_by, #description_ticket', function() {
                $(this).val($(this).val().toUpperCase());
            });

            // Inisialisasi Fancybox untuk tombol panduan
            document.getElementById('guideButton').addEventListener('click', function() {
                Fancybox.show([{
                    src: "#videoGuideModal",
                    type: "inline",
                }, ]);
            });

            // Reset Form
            // Tangkap tombol reset
            const resetButton = document.querySelector('button[type="reset"]');

            // Tambahkan event listener untuk tombol reset
            resetButton.addEventListener('click', function(e) {
                // Reset Select2
                $('#id_departemen').val(null).trigger('change');

                // Reset input file
                document.getElementById('image-upload').value = '';
                document.getElementById('dokumen-upload').value = '';

                // Reset preview gambar
                const imagePreview = document.getElementById('image-preview');
                imagePreview.style.backgroundImage = '';
                document.getElementById('image-label').style.display = 'block';

                // Reset preview dokumen
                const dokumenPreview = document.getElementById('dokumen-preview');
                dokumenPreview.style.backgroundImage = '';
                document.getElementById('dokumen-label').style.display = 'block';
            });
        });

        // Fungsi untuk memutar video Desktop
        function playDesktopVideo() {
            Fancybox.close(); // Tutup modal pilihan
            Fancybox.show([{
                src: "#desktopVideo",
                type: "inline",
            }, ]);
        }

        // Fungsi untuk memutar video Mobile
        function playMobileVideo() {
            Fancybox.close(); // Tutup modal pilihan
            Fancybox.show([{
                src: "#mobileVideo",
                type: "inline",
            }, ]);
        }

        // Fungsi untuk cekAntrian()
        function cekAntrian() {
            window.location.href = "<?php echo base_url('ticket_client_view/ticket_queue'); ?>";
        }
    </script>
</body>

<!-- contact.html  21 Nov 2019 04:05:05 GMT -->

</html>