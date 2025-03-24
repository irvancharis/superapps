<!DOCTYPE html>
<html lang="en">


<!-- timeline.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- MODIFIKASI SEPTIAN SUPAYA SUPPORT ZROK (URL TUNNEL) -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>SAGROUP</title>
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
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/izitoast/css/iziToast.min.css'); ?>">
    <style>
        .judul-ticketing {
            color: #202d45;
            font-weight: bold;
            font-family: 'Barlow Semi Condensed', sans-serif;
            letter-spacing: 1px;
            font-style: italic;
        }

        .confirmation-button-container {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            /* Pastikan tombol berada di atas elemen lain */
        }

        .btn-confirm {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 25px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-confirm:hover {
            background-color: #0056b3;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <!-- Tombol Konfirmasi -->
        <!-- <?php if ($status_ticket != '0' && $status_ticket != '100') : ?>
            <div class="confirmation-button-container">
                <button class="btn btn-success btn-confirm" data-id="<?php echo $id_ticket; ?>">Konfirmasi Selesai</button>
            </div>
        <?php endif; ?> -->

        <div class="main-wrapper main-wrapper-1">
            <!-- Main Content -->
            <div class="main-content pt-5">
                <section class="section px-4 px-md-0 px-lg-0">
                    <h3 class="judul-ticketing"> <img src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>" width="60px" alt=""> Ticket Progress</h3>
                    <h5 class="mt-5">ID TICKET : <span style="color: #114fd8;"><?php echo $id_ticket; ?></span></h5>
                    <div class="section-body">
                        <?php
                        // Kelompokkan data berdasarkan tanggal
                        $groupedData = [];
                        foreach ($ticket_detail as $d) {
                            $date = date('d F Y', strtotime($d->TGL_PENGERJAAN)); // Format tanggal: "01 October 2023"
                            if (!isset($groupedData[$date])) {
                                $groupedData[$date] = [];
                            }
                            $groupedData[$date][] = $d;
                        }
                        ?>

                        <?php foreach ($groupedData as $date => $activities) : ?>
                            <!-- Judul tanggal -->
                            <!-- <h2 class="section-title"><?php echo $date; ?></h2> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="activities">
                                        <?php foreach ($activities as $index => $d) : ?>
                                            <div class="activity">
                                                <div class="activity-icon bg-danger text-white">
                                                    <?php if ($d->STATUS_PROGRESS == 100) : ?>
                                                        <i class="fas fa-check"></i>
                                                    <?php elseif ($d->STATUS_PROGRESS == 50) : ?>
                                                        <i class="fas fa-clock"></i>
                                                    <?php elseif ($d->STATUS_PROGRESS == 25) : ?>
                                                        <i class="fas fa-cog"></i>
                                                    <?php else : ?>
                                                        <i class="fas fa-file-signature"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="activity-detail" data-aos="zoom-in-right" data-aos-duration="1000">
                                                    <div class="mb-2">
                                                        <span class="text-job"><?php echo date('H:i', strtotime($d->TGL_PENGERJAAN)); ?></span>
                                                        <span class="bullet"></span>
                                                        <a class="text-job" href="javascript:void(0);">
                                                            <?php if ($d->STATUS_PROGRESS == 0) {
                                                                echo "<span class='badge badge-warning' style='font-size: 10px;'>DALAM ANTRIAN</span><br>";
                                                            } elseif ($d->STATUS_PROGRESS == 25) {
                                                                echo "<span class='badge badge-primary' style='font-size: 10px;'>SEDANG DIKERJAKAN</span><br>";
                                                            } elseif ($d->STATUS_PROGRESS == 50) {
                                                                echo "<span class='badge badge-danger' style='font-size: 10px;'>MENUNGGU VALIDASI</span><br>";
                                                            } else {
                                                                echo "<span class='badge badge-success' style='font-size: 10px;'>SELESAI</span><br>";
                                                            }
                                                            ?>
                                                        </a>
                                                    </div>
                                                    <p class="font-weight-bold"><?php echo $d->KETERANGAN; ?></p>
                                                    <p class="mt-2">Dikerjakan Oleh : <a href="javascript:void(0);"><?php echo $d->NAME_TECHNICIAN; ?></a></p>
                                                    <p id="complaints-list"></p>
                                                    <?php if ($d->FOTO !== null) : ?>
                                                        <hr>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" data-fancybox data-caption="<?= $d->KETERANGAN; ?>" data-image="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" data-title="<?= $d->KETERANGAN; ?>">
                                                                <img src="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" class="img-thumbnail" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.3));" width="60px" alt="<?= $d->KETERANGAN; ?>">
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
    <!-- Toastr -->
    <script src="<?php echo base_url('assets/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
    <!-- Sweetalert -->
    <script src="<?php echo base_url('assets/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/page/sweetalert.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memuat ulang data
            function loadTicketProgress() {
                let id_ticket = '<?php echo $id_ticket; ?>';
                $.ajax({
                    url: '<?php echo site_url("ticket_client_view/get_ticket_progress/"); ?>' + id_ticket, // Sesuaikan dengan URL endpoint Anda
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Kosongkan konten timeline sebelum memuat ulang
                        $('.section-body').empty(); // Hapus semua konten di dalam .section-body

                        // Cek data terbaru
                        let latestData = response[0]; // Ambil data terbaru (indeks 0)
                        let isTicketCompleted = latestData.STATUS_PROGRESS == 100; // Cek apakah status ticket adalah 100

                        // Kelompokkan data berdasarkan tanggal
                        let groupedData = {};
                        response.forEach(function(d) {
                            let date = new Date(d.TGL_PENGERJAAN).toLocaleDateString('en-GB', {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            });
                            if (!groupedData[date]) {
                                groupedData[date] = [];
                            }
                            groupedData[date].push(d);
                        });

                        // Render ulang timeline
                        for (let date in groupedData) {
                            let activities = groupedData[date];
                            let sectionTitle = `<h2 class="section-title">${date}</h2>`;
                            let activityHtml = '<div class="activities">'; // Mulai kontainer activities

                            // Tambahkan Tombol Konfirmasi pada sectionTitle
                            if (latestData.STATUS_PROGRESS != '0' && latestData.STATUS_PROGRESS != '100') {
                                $('.confirmation-button-container').remove(); // Hapus jika sudah ada sebelumnya
                                sectionTitle += `<div class="confirmation-button-container"><button class="btn btn-success btn-confirm" data-id="<?php echo $id_ticket; ?>">Konfirmasi Selesai</button></div>`;
                            } else {
                                $('.confirmation-button-container').remove(); // Hapus jika sudah ada sebelumnya
                            }

                            activities.forEach(function(d, index) {
                                let iconClass = '';
                                let badgeClass = '';
                                let badgeText = '';

                                if (d.STATUS_PROGRESS == 100) {
                                    iconClass = 'fas fa-check';
                                    badgeClass = 'badge badge-success';
                                    badgeText = 'SELESAI';
                                } else if (d.STATUS_PROGRESS == 50) {
                                    iconClass = 'fas fa-clock';
                                    badgeClass = 'badge badge-danger';
                                    badgeText = 'MENUNGGU VALIDASI';
                                } else if (d.STATUS_PROGRESS == 25) {
                                    iconClass = 'fas fa-cog';
                                    badgeClass = 'badge badge-primary';
                                    badgeText = 'SEDANG DIKERJAKAN';
                                } else {
                                    iconClass = 'fas fa-file-signature';
                                    badgeClass = 'badge badge-warning';
                                    badgeText = 'DALAM ANTRIAN';
                                }

                                activityHtml += `
                                <div class="activity">
                                    <div class="activity-icon bg-danger text-white">
                                        <i class="${iconClass}"></i>
                                    </div>
                                    <div class="activity-detail" data-aos="zoom-in-right" data-aos-duration="1000">
                                        <div class="mb-2">
                                            <span class="text-job">${new Intl.DateTimeFormat('en-GB', { hour: '2-digit', minute: '2-digit', hour12: false }).format(new Date(d.TGL_PENGERJAAN))}</span>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="javascript:void(0);">
                                                <span class="${badgeClass}" style="font-size: 10px;">${badgeText}</span><br>
                                            </a>
                                        </div>
                                        <p class="font-weight-bold">${d.KETERANGAN}</p>
                                        <p class="mt-2">Dikerjakan Oleh : <a href="javascript:void(0);">${d.NAME_TECHNICIAN}</a></p>
                                        ${d.FOTO ? `
                                            <hr>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="<?php echo base_url('assets/uploads/ticket/') ?>${d.FOTO}" data-fancybox data-caption="${d.KETERANGAN}" data-image="<?php echo base_url('assets/uploads/ticket/') ?>${d.FOTO}" data-title="${d.KETERANGAN}">
                                                    <img src="<?php echo base_url('assets/uploads/ticket/') ?>${d.FOTO}" class="img-thumbnail" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.3));" width="60px" alt="${d.KETERANGAN}">
                                                </a>
                                            </div>
                                        ` : ''}
                                    </div>
                                </div>
                            `;
                            });

                            activityHtml += '</div>'; // Tutup kontainer activities
                            $('.section-body').append(sectionTitle + activityHtml); // Tambahkan ke section-body
                        }

                        // Inisialisasi ulang AOS dan Fancybox
                        AOS.init({
                            once: true
                        });
                        Fancybox.bind("[data-fancybox]");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching ticket progress:", error);
                    }
                });
            }

            // Lakukan polling setiap 15 detik
            setInterval(loadTicketProgress, 15000);

            // Muat data pertama kali saat halaman dimuat
            loadTicketProgress();

            // Contoh penggunaan iziToast
            iziToast.info({
                title: 'INFO',
                message: 'Halaman ini akan refresh otomatis setiap 15 detik untuk memperbarui update pengerjaan ticket.',
                position: 'topCenter'
            });

            // Event listener untuk tombol konfirmasi
            $(document).on('click', '.btn-confirm', function() {
                let id_ticket = $(this).data('id'); // Ambil ID ticket dari atribut data-id

                // Tampilkan SweetAlert
                swal({
                    title: 'KONFIRMASI',
                    text: 'Yakin Konfirmasi Selesai?',
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: 'Tidak',
                            value: false,
                            visible: true,
                            closeModal: true
                        },
                        confirm: {
                            text: 'Ya',
                            value: true,
                            visible: true,
                            closeModal: true
                        }
                    },
                    dangerMode: true
                }).then((confirm) => {
                    if (confirm) {
                        // Jika pengguna menekan "Ya", lakukan AJAX request untuk update ticket
                        $.ajax({
                            url: '<?php echo site_url("ticket_client_view/updateKonfirmasiSelesai/"); ?>' + id_ticket, // Sesuaikan dengan URL endpoint Anda
                            method: 'POST',
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    // Tampilkan pesan sukses
                                    swal({
                                        title: 'SUKSES!',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Refresh halaman atau lakukan sesuatu setelah update
                                        location.reload(); // Contoh: refresh halaman
                                    });
                                } else {
                                    // Tampilkan pesan error
                                    swal({
                                        title: 'GAGAL!',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                // Tampilkan pesan error jika AJAX request gagal
                                swal({
                                    title: 'ERROR!',
                                    text: 'Terjadi kesalahan saat mengupdate ticket.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });

            // Trigger btn-confirm saat halaman pertama kali dimuat
            setTimeout(function() {
                $('.btn-confirm').trigger('click'); // Trigger klik tombol konfirmasi otomatis
            }, 1000); // Delay 1 detik untuk memastikan tombol tersedia sebelum diklik
        });
    </script>
</body>


<!-- timeline.html  21 Nov 2019 03:49:32 GMT -->

</html>