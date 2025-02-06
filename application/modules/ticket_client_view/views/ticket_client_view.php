<!DOCTYPE html>
<html lang="en">


<!-- contact.html  21 Nov 2019 04:05:04 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SAGROUP TICKETING</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/Logo SA X7.ico' />
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
                                    <form class="needs-validation" novalidate="" id="formTicketClient">
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
                                                <div class="form-group col-12 col-md-6 col-lg-6">
                                                    <label>E-MAIL</label>
                                                    <input type="email" class="form-control" id="email_ticket" name="email_ticket">
                                                    <div class="invalid-feedback">
                                                        Masukkan Email dengan benar!
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
                                                        <p style="color:red;font-style: italic;">*). Muncul setelah memilih Departemen Direquest</p>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 col-md-12 col-lg-12">
                                                    <label>DESCRIPTION</label>
                                                    <textarea name="description_ticket" placeholder="Masukkan deskripsi keluhan" class="form-control" id="description_ticket"></textarea>
                                                    <div class="invalid-feedback">
                                                        Silahkan masukkan deskripsi keluhan anda!
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
    <script src="assets/js/app.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/contact.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <!-- Sweetalert -->
    <script src="<?php echo base_url('assets/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/page/sweetalert.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $('.chat-icon').click(function() {
                $(this).toggleClass('active');
                $(this).toggleClass('btnblickanim');
                $('.main-chat-box').toggle();
            });

            $('#formTicketClient').on('submit', function(e) {
                e.preventDefault();

                // Ambil data dari form
                let formData = $(this).serialize();

                // Kirim data ke server melalui AJAX
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "ticket_client_view/insert", // Endpoint untuk proses input
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            swal('Sukses', 'Request Ticket Berhasil Dikirim!', 'success').then(function() {
                                location.href = "<?php echo base_url(); ?>" + "ticket_client_view";
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

<!-- contact.html  21 Nov 2019 04:05:05 GMT -->

</html>