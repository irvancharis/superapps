            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DATA TRANSAKSI PENGADAAN</h4>
                                    <div class="card-header-action">
                                        <a href="<?php echo base_url('transaksi_pengadaan/tambah') ?>"
                                            class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-sm" id="table-pengadaan">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">TANGGAL PENGAJUAN</th>
                                                    <th class="text-center col-1">USER PENGAJUAN</th>
                                                    <th class="text-center col-3">DEPARTEMEN</th>
                                                    <th class="text-center col-1">STATUS</th>
                                                    <th class="text-center col-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_TRANSAKSI_PENGADAAN as $index => $d) : ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $this->tanggalindo->formatTanggal($d->TANGGAL_PENGAJUAN, 'l, d F Y'); ?>
                                                    <td class="text-center"><?php echo $d->NAMA_USER_PENGAJUAN; ?></td>
                                                    <td><i class="fa fa-map-marker"></i>
                                                        <?php echo $d->NAMA_AREA; ?><br><i class="fa fa-building"></i>
                                                        <?php echo $d->NAMA_RUANGAN; ?><br> <i class="fa fa-users"></i>
                                                        <?php echo $d->NAMA_DEPARTEMEN; ?><br><i class="fa fa-box"></i>
                                                        <?php echo $d->NAMA_LOKASI; ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                            if ($d->STATUS_PENGADAAN == "MENUNGGU APROVAL KABAG") {
                                                                echo '<span class="badge badge-primary">MENUNGGU APROVAL KABAG</span> ';
                                                            } elseif ($d->STATUS_PENGADAAN == "MENUNGGU APROVAL GM") {
                                                                echo '<span class="badge badge-primary">MENUNGGU APROVAL GM</span> ';
                                                            } elseif ($d->STATUS_PENGADAAN == "MENUNGGU APROVAL HEAD") {
                                                                echo '<span class="badge badge-primary">MENUNGGU APROVAL HEAD</span> ';
                                                            } elseif ($d->STATUS_PENGADAAN == "PROSES PENGADAAN") {
                                                                echo '<span class="badge badge-warning">PROSES PENGADAAN</span> ';
                                                            } elseif ($d->STATUS_PENGADAAN == "MENUNGGU KIRIMAN BARANG") {
                                                                echo '<span class="badge badge-warning">MENUNGGU KIRIMAN BARANG</span> ';
                                                            } elseif ($d->STATUS_PENGADAAN == "MENUNGGU PENYERAHAN") {
                                                                echo '<span class="badge badge-warning">MENUNGGU PENYERAHAN</span> ';
                                                            } elseif ($d->STATUS_PENGADAAN == "PROSES PENYERAHAN") {
                                                                echo '<span class="badge badge-warning">PROSES PENYERAHAN</span> ';
                                                            } elseif ($d->STATUS_PENGADAAN == "DITOLAK KABAG") {
                                                                echo '<span class="badge badge-danger">DITOLAK KABAG</span>';
                                                            } elseif ($d->STATUS_PENGADAAN == "DITOLAK GM") {
                                                                echo '<span class="badge badge-danger">DITOLAK GM</span>';
                                                            } elseif ($d->STATUS_PENGADAAN == "DITOLAK HEAD") {
                                                                echo '<span class="badge badge-danger">DITOLAK HEAD</span>';
                                                            } else {
                                                                echo '<span class="badge badge-success">SELESAI</span>';
                                                            }
                                                            ?>
                                                    </td>
                                                    <td class="text-center">

                                                        <a href="<?=site_url('transaksi_pengadaan/detail/'.$d->UUID_TRANSAKSI_PENGADAAN);?>"
                                                            class="btn btn-outline-secondary"><i
                                                                class="fas fa-eye"></i></a>

                                                        <?php                                                                                                                    
                                                        if ($d->STATUS_PENGADAAN == "MENUNGGU APROVAL KABAG") {
                                                                echo '<a href="' . base_url("transaksi_pengadaan/approval_kabag/" . $d->UUID_TRANSAKSI_PENGADAAN) . '" class="btn btn-outline-primary has-icon view-btn"> <i class="fas fa-edit"></i></a>';                                                                
                                                            } elseif ($d->STATUS_PENGADAAN == "MENUNGGU APROVAL GM") {
                                                                echo '<a href="' . base_url("transaksi_pengadaan/approval_gm/" . $d->UUID_TRANSAKSI_PENGADAAN) . '" class="btn btn-outline-primary has-icon view-btn"> <i class="fas fa-edit"></i></a>';
                                                            } elseif ($d->STATUS_PENGADAAN == "MENUNGGU APROVAL HEAD") {
                                                                echo '<a href="' . base_url("transaksi_pengadaan/approval_head/" . $d->UUID_TRANSAKSI_PENGADAAN) . '" class="btn btn-outline-primary has-icon view-btn"> <i class="fas fa-edit"></i></a>';
                                                            } elseif ($d->STATUS_PENGADAAN == "PROSES PENGADAAN") {
                                                                echo '<a href="' . base_url("transaksi_pengadaan/proses_pengadaan/" . $d->UUID_TRANSAKSI_PENGADAAN) . '" class="btn btn-outline-primary has-icon view-btn"> <i class="fas fa-edit"></i></a>';
                                                            } elseif ($d->STATUS_PENGADAAN == "MENUNGGU KIRIMAN BARANG") {
                                                                echo '<a href="' . base_url("transaksi_pengadaan/m_kiriman_barang/" . $d->UUID_TRANSAKSI_PENGADAAN) . '" class="btn btn-outline-primary has-icon view-btn"> <i class="fas fa-edit"></i></a>';
                                                            } elseif ($d->STATUS_PENGADAAN == "MENUNGGU PENYERAHAN") {
                                                                echo '<a href="' . base_url("transaksi_pengadaan/penyerahan_barang/" . $d->UUID_TRANSAKSI_PENGADAAN) . '" class="btn btn-outline-primary has-icon view-btn"> <i class="fas fa-edit"></i></a>';
                                                            } elseif ($d->STATUS_PENGADAAN == "PROSES PENYERAHAN") {
                                                                echo '<a href="' . base_url("transaksi_pengadaan/penyerahan_barang_user/" . $d->UUID_TRANSAKSI_PENGADAAN) . '" class="btn btn-outline-primary has-icon view-btn"> <i class="fas fa-edit"></i></a>';
                                                            }
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>transaksi_pengadaan/print/<?php echo $d->UUID_TRANSAKSI_PENGADAAN; ?>"
                                                            target="_blank" class="btn btn-outline-secondary"><i
                                                                class="fas fa-print"></i>
                                                        </a>
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
            </div>

            </div>
            </div>
            </div>

            <?php $this->load->view('layout/footer'); ?>

            </body>

            <script>
$(document).ready(function() {

    $('#table-pengadaan').DataTable({
        paging: false,
        searching: true,
        sorting: false,
        ordering: false,
        info: false,
        responsive: {
            details: {
                type: 'column',
                display: $.fn.dataTable.Responsive.display
                    .childRowImmediate, // Menampilkan detail langsung                
            }
        }
    });


    $('#formHapusproduk').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = $(this).serialize();

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" +
                "transaksi_pengadaan/hapus", // Endpoint untuk proses input
            type: 'POST',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Hapus Data Berhasil!', 'success').then(
                        function() {
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
});
            </script>

            </html>