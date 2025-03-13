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
                    <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="judul-ticketing mx-auto"><i class="fas fa-list"></i> DAFTAR ANTRIAN TICKETING</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID TICKET</th>
                                                <th>ORDER BY</th>
                                                <th>LOKASI</th>
                                                <th>APPROVAL</th>
                                                <th>TEKNISI</th>
                                                <th>PROGRESS</th>
                                                <th>SELESAI PADA</th>
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
                                                    <td class="text-center">
                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                            <span>-</span>
                                                        <?php else : ?>
                                                            <?php echo $d->NAME_TECHNICIAN; ?>
                                                        <?php endif; ?>
                                                    </td>
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
        $('.chat-icon').click(function() {
            $(this).toggleClass('active');
            $(this).toggleClass('btnblickanim');
            $('.main-chat-box').toggle();
        });

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
    </script>
</body>

<!-- contact.html  21 Nov 2019 04:05:05 GMT -->

</html>