<!DOCTYPE html>
<html lang="en">


<!-- contact.html  21 Nov 2019 04:05:04 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SAGROUP TICKETING</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/components.css'); ?>">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <!-- Preview Image -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/summernote/summernote-bs4.css'); ?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bundles/jquery-selectric/selectric.css'); ?>"> -->
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
                                                    <label>REQUEST BY</label>
                                                    <input type="text" name="request_by" id="request_by" class="form-control">
                                                    <div class="invalid-feedback">
                                                        Di Request Oleh?
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>DEPARTEMEN</label>
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
                                                <!-- E-MAIL -->
                                                <!-- <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>E-MAIL</label>
                                                    <input type="email" class="form-control" id="email_ticket" name="email_ticket">
                                                    <div class="invalid-feedback">
                                                        Masukkan Email dengan benar!
                                                    </div>
                                                </div> -->
                                                <!-- TELP -->
                                                <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>NO. WA</label>
                                                    <input type="text" class="form-control" id="telp" name="telp">
                                                    <div class="invalid-feedback">
                                                        Masukkan NO. TELEPON dengan benar!
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>AREA</label>
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
                                                    <select id="id_departemen_request" class="form-control" disabled>
                                                        <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                                        <?php foreach ($get_departement as $row) : ?>
                                                            <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <input type="hidden" name="id_departemen_request" id="select_id_departemen_request">
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
                                                <div class="form-group col-12 col-md-6 col-lg-6" id="image-container">
                                                    <label>FOTO</label>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div id="image-preview" class="image-preview">
                                                            <label for="image-upload" id="image-label">Upload Gambar</label>
                                                            <input type="file" name="image" id="image-upload"
                                                                accept="image/gif, image/jpeg, image/png, image/webp, application/pdf" />
                                                        </div>
                                                    </div>
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
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
                                            <button type="reset" class="btn btn-secondary"><i class="fas fa-redo"></i> Reset</button>
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
    <span class="chat-icon btnblickanim"></span>
    <div class="main-chat-box">
        <span class="traingle-shadow"></span>
        <ul class="chatBox">
            <li>
                <a href="">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/whatsapp.png'); ?>" alt="whatsapp">
                    </span>
                    <abbr title="">Whatsapp</abbr>
                </a>
            </li>
            <li>
                <a href="">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/facebook_messanger.png'); ?>" alt="facebook">
                    </span>
                    <abbr title="">Facebook</abbr>
                </a>
            </li>
            <li>
                <a href="">
                    <span class="icon-circle">
                        <img src="<?= base_url('assets/img/message-closed-envelope.png'); ?>" alt="email">
                    </span>
                    <abbr title="">Email</abbr>
                </a>
            </li>
        </ul>
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
                            swal('Sukses', 'Request Ticket Berhasil Dikirim!', 'success').then(function() {
                                location.href = "<?php echo base_url(); ?>" + "ticket_client_view/ticket_queue";
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

            // Trigger event change saat halaman pertama kali dimuat
            $('#id_departemen_request').trigger('change');

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
                        previewBox.append(`<p class="file-preview text-danger mt-5">Format file tidak didukung</p>`);
                    }

                    label.text("Change File"); // Ubah label setelah file dipilih
                } else {
                    // Jika tidak ada file yang dipilih
                    previewBox.find(".file-preview").remove();
                    label.text("Upload Dokumen");
                }
            });

        });
    </script>
</body>

<!-- contact.html  21 Nov 2019 04:05:05 GMT -->

</html>