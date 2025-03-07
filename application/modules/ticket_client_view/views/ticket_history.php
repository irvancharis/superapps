<!DOCTYPE html>
<html lang="en">


<!-- timeline.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/components.css'); ?>">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('assets/img/Logo SA X7.ico'); ?>' />
    <!-- AOS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/aos.css'); ?>">
    <!-- Fancybox -->
    <script src="<?php echo base_url('assets/js/fancybox.umd.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fancybox.css'); ?>" />
    <style>
        .judul-ticketing {
            color: #202d45;
            font-weight: bold;
            font-family: 'Barlow Semi Condensed', sans-serif;
            letter-spacing: 1px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section px-4 px-md-0 px-lg-0">
                    <h2 class="judul-ticketing"> <img src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>" width="60px" alt=""> Ticket Progress</h2>
                    <div class="section-body">
                        <h2 class="section-title">September 2018</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="activities">
                                    <?php foreach ($ticket_detail as $index => $d) : ?>
                                        <div class="activity">
                                            <div class="activity-icon bg-danger text-white">
                                                <?php if ($d->STATUS_PROGRESS == 100) : ?>
                                                    <i class="fas fa-check"></i>
                                                <?php elseif ($d->STATUS_PROGRESS == 50) : ?>
                                                    <i class="fas fa-clock"></i>
                                                <?php else : ?>
                                                    <i class="fas fa-cog"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="activity-detail" data-aos="zoom-in-right" data-aos-duration="1000">
                                                <div class="mb-2">
                                                    <span class="text-job"><?php echo date('d/m/Y H:i', strtotime($d->TGL_PENGERJAAN)); ?></span>
                                                    <span class="bullet"></span>
                                                    <a class="text-job" href="javascript:void(0);">
                                                        <?php if ($d->STATUS_PROGRESS == 0) {
                                                            echo "<span class='badge badge-warning' style='font-size: extra-small;'>DALAM ANTRIAN</span><br>";
                                                        } elseif ($d->STATUS_PROGRESS == 25) {
                                                            echo "<span class='badge badge-primary' style='font-size: extra-small;'>SEDANG DIKERJAKAN</span><br>";
                                                        } elseif ($d->STATUS_PROGRESS == 50) {
                                                            echo "<span class='badge badge-danger' style='font-size: extra-small;'>MENUNGGU VALIDASI</span><br>";
                                                        } else {
                                                            echo "<span class='badge badge-success' style='font-size: extra-small;'>SELESAI</span><br>";
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                                <p class="font-weight-bold"><?php echo $d->KETERANGAN; ?></p>
                                                <p class="mt-2">Dikerjakan Oleh : <a href="javascript:void(0);"><?php echo $d->NAME_TECHNICIAN; ?></a></p>
                                                <?php if ($d->FOTO !== null) : ?>
                                                    <hr>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" data-fancybox data-caption="<?= $d->KETERANGAN; ?>" data-image="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" data-title="<?= $d->KETERANGAN; ?>">
                                                            <img src="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" class="img-thumbnail" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.3));" width="60px" alt="<?= $d->KETERANGAN; ?>">
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <!-- <p>Have commented on the task of "<a href="#">Responsive design</a>".</p> -->
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    <a href="javascript:void(0);">SA.GROUP.ID</a></a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
    <!-- Custom JS File -->
    <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
    <!-- AOS -->
    <script src="<?php echo base_url('assets/js/aos.js'); ?>"></script>
    <script>
        AOS.init({
            once: true
        });

        // Inisialisasi Fancybox
        Fancybox.bind("[data-fancybox]");
    </script>
</body>


<!-- timeline.html  21 Nov 2019 03:49:32 GMT -->

</html>