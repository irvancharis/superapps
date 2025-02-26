            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DATA TRANSAKSI PENGHAPUSAN</h4>
                                    <div class="card-header-action">
                                        <a href="<?php echo base_url('transaksi_penghapusan/tambah') ?>"
                                            class="btn btn-outline-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="TABEL">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-2">TANGGAL PENGAJUAN</th>
                                                    <th class="text-center">DEPARTEMEN</th>
                                                    <th class="text-center col-2">USER PENGAJUAN</th>
                                                    <th class="text-center col-2">APROVAL</th>
                                                    <th class="text-center col-2">STATUS</th>
                                                    <th class="text-center col-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_TRANSAKSI_PENGHAPUSAN as $index => $d) : ?>
                                                <tr>

                                                    <td class="text-center"><?php echo $this->tanggalindo->formatTanggal($d->TANGGAL_PENGAJUAN, 'l, d F Y'); ?>
                                                    </td>
                                                    <td><i class="fa fa-map-marker"></i>
                                                        <?php echo $d->NAMA_AREA; ?><br><i class="fa fa-building"></i>
                                                        <?php echo $d->NAMA_RUANGAN; ?><br> <i class="fa fa-users"></i>
                                                        <?php echo $d->NAMA_DEPARTEMEN; ?><br><i class="fa fa-box"></i>
                                                        <?php echo $d->NAMA_LOKASI; ?></td>
                                                    <td class="text-center"><?php echo $d->NAMA_USER_PENGAJUAN; ?></td>
                                                    <td >
                                                        <?php echo 'KABAG - ( ' . (($d->KODE_APROVAL_KABAG != null) ? $d->NAMA_APROVAL_KABAG . ' <i class="fas fa-check text-success"></i>' : $d->NAMA_APROVAL_KABAG . ' <i class="fas fa-times text-danger"></i>') . ' )'; ?><br>
                                                        <?php echo 'GM - ( ' . (($d->KODE_APROVAL_GM != null) ? $d->NAMA_APROVAL_GM . ' <i class="fas fa-check text-success"></i>' : $d->NAMA_APROVAL_GM . ' <i class="fas fa-times text-danger"></i>') . ' )'; ?><br>
                                                        <?php echo 'HEAD - ( ' . (($d->KODE_APROVAL_HEAD != null) ? $d->NAMA_APROVAL_HEAD . ' <i class="fas fa-check text-success"></i>' : $d->NAMA_APROVAL_HEAD . ' <i class="fas fa-times text-danger"></i>') . ' )'; ?>
                                                    <td class="text-center">
                                                        <?php if($d->STATUS_PENGHAPUSAN == 'MENUNGGU APROVAL KABAG')
                                                            {
                                                        ?>
                                                        <span class="badge badge-warning">MENUNGGU APROVAL KABAG</span>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'MENUNGGU APROVAL GM')
                                                            {
                                                        ?>
                                                        <span class="badge badge-warning">MENUNGGU APROVAL GM</span>


                                                        <?php
                                                            }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'MENUNGGU APROVAL HEAD')
                                                            {
                                                        ?>
                                                        <span class="badge badge-warning">MENUNGGU APROVAL HEAD</span>


                                                        <?php
                                                            }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'MENUNGGU JADWAL PENGHAPUSAN')
                                                            {
                                                        ?>
                                                        <span class="badge badge-warning">MENUNGGU JADWAL
                                                            PENGHAPUSAN</span>


                                                        <?php
                                                            }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'PROSES PENGHAPUSAN')
                                                            {
                                                        ?>
                                                        <span class="badge badge-warning">PROSES PENGHAPUSAN</span>


                                                        <?php
                                                        }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'SELESAI')
                                                            {
                                                        ?>
                                                        <span class="badge badge-success">SELESAI</span>
                                                        <?php
                                                        }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'DITOLAK KABAG')
                                                            {
                                                        ?>
                                                        <span class="badge badge-danger">DITOLAK KABAG</span>
                                                        <?php
                                                            }elseif($d->STATUS_PENGHAPUSAN == 'DITOLAK GM')
                                                            {
                                                        ?>
                                                        <span class="badge badge-danger">DITOLAK GM</span>                                                      
                                                        <?php
                                                            }elseif($d->STATUS_PENGHAPUSAN == 'DITOLAK HEAD')
                                                            {
                                                        ?>
                                                        <span class="badge badge-danger">DITOLAK HEAD</span>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <?php if($d->STATUS_PENGHAPUSAN == 'MENUNGGU APROVAL KABAG')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_penghapusan/aproval_kabag/'.$d->UUID_TRANSAKSI_PENGHAPUSAN);?>"
                                                            class="btn btn-outline-primary"><i class="fas fa-eye"></i>
                                                        </a>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'MENUNGGU APROVAL GM')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_penghapusan/aproval_gm/'.$d->UUID_TRANSAKSI_PENGHAPUSAN);?>"
                                                            class="btn btn-outline-primary"><i class="fas fa-eye"></i>
                                                        </a>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'MENUNGGU APROVAL HEAD')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_penghapusan/aproval_head/'.$d->UUID_TRANSAKSI_PENGHAPUSAN);?>"
                                                            class="btn btn-outline-primary"><i class="fas fa-eye"></i>
                                                        </a>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'MENUNGGU JADWAL PENGHAPUSAN')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_penghapusan/jadwal_penghapusan/'.$d->UUID_TRANSAKSI_PENGHAPUSAN);?>"
                                                            class="btn btn-outline-primary"><i class="fas fa-eye"></i>
                                                        </a>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_PENGHAPUSAN == 'PROSES PENGHAPUSAN')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_penghapusan/proses_penghapusan/'.$d->UUID_TRANSAKSI_PENGHAPUSAN);?>"
                                                            class="btn btn-outline-primary"><i class="fas fa-eye"></i>
                                                        </a>

                                                        <?php
                                                            }
                                                        ?>
                                                        <a class="btn btn-outline-secondary"><i
                                                                class="fas fa-print"></i></a>
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

            <?php $this->load->view('layout/footer'); ?>

            </body>

            <script>
$(document).ready(function() {


    $('#TABEL').dataTable({
        paging: false
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
});
            </script>

            </html>