            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DATA TRANSAKSI OPNAME</h4>
                                    <div class="card-header-action">
                                        <a href="<?php echo base_url('transaksi_opname/tambah') ?>"
                                            class="btn btn-outline-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-sm" id="TABEL">
                                            <thead>
                                                <tr>
                                                    <th class="col-2">TANGGAL OPNAME</th>
                                                    <th class="text-center">DEPARTEMEN</th>
                                                    <th class="text-center col-2">PELAKSANA</th>
                                                    <th class="text-center col-1">STATUS</th>
                                                    <th class="text-center col-2"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_TRANSAKSI_OPNAME as $index => $d) : ?>
                                                <tr>

                                                    <td>
                                                        <?php echo $this->tanggalindo->formatTanggal($d->TANGGAL_OPNAME, 'l, d F Y'); ?>
                                                    </td>
                                                    <td><i class="fa fa-map-marker"></i>
                                                        <?php echo $d->NAMA_AREA; ?><br><i class="fa fa-building"></i>
                                                        <?php echo $d->NAMA_RUANGAN; ?><br> <i class="fa fa-users"></i>
                                                        <?php echo $d->NAMA_DEPARTEMEN; ?><br><i class="fa fa-box"></i>
                                                        <?php echo $d->NAMA_LOKASI; ?></td>
                                                    <td class="text-center"><?php echo $d->NAMA_USER_PELAKSANA; ?></td>

                                                    <td class="text-center">
                                                        <?php if($d->STATUS_OPNAME == 'MENUNGGU APROVAL KABAG')
                                                            {
                                                        ?>
                                                        <span class="badge badge-primary">MENUNGGU APROVAL KABAG</span>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_OPNAME == 'MENUNGGU APROVAL GM')
                                                            {
                                                        ?>
                                                        <span class="badge badge-primary">MENUNGGU APROVAL GM</span>


                                                        <?php
                                                            }
                                                            elseif($d->STATUS_OPNAME == 'MENUNGGU APROVAL HEAD')
                                                            {
                                                        ?>
                                                        <span class="badge badge-primary">MENUNGGU APROVAL HEAD</span>

                                                        <?php
                                                        }
                                                            elseif($d->STATUS_OPNAME == 'DITOLAK KABAG')
                                                            {
                                                        ?>
                                                        <span class="badge badge-danger">DITOLAK KABAG</span>
                                                        <?php
                                                            }elseif($d->STATUS_OPNAME == 'DITOLAK GM')
                                                            {
                                                        ?>
                                                        <span class="badge badge-danger">DITOLAK GM</span>
                                                        <?php
                                                            }elseif($d->STATUS_OPNAME == 'DITOLAK HEAD')
                                                            {
                                                        ?>
                                                        <span class="badge badge-danger">DITOLAK HEAD</span>
                                                        <?php
                                                            }elseif($d->STATUS_OPNAME == 'SELESAI')
                                                            {
                                                        ?>
                                                        <span class="badge badge-success">SELESAI</span>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?=site_url('transaksi_opname/detail/'.$d->UUID_TRANSAKSI_OPNAME);?>"
                                                            class="btn btn-outline-secondary"><i
                                                                class="fas fa-eye"></i></a>


                                                        <?php if($d->STATUS_OPNAME == 'MENUNGGU APROVAL KABAG')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_opname/aproval_kabag/'.$d->UUID_TRANSAKSI_OPNAME);?>"
                                                            class="btn btn-outline-primary"><i class="fas fa-edit"></i>
                                                        </a>
                                                        <?php
                                                            }
                                                            elseif($d->STATUS_OPNAME == 'MENUNGGU APROVAL GM')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_opname/aproval_gm/'.$d->UUID_TRANSAKSI_OPNAME);?>"
                                                            class="btn btn-outline-primary"><i class="fas fa-edit"></i>
                                                        </a>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_OPNAME == 'MENUNGGU APROVAL HEAD')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_opname/aproval_head/'.$d->UUID_TRANSAKSI_OPNAME);?>"
                                                            class="btn btn-outline-primary"><i class="fas fa-edit"></i>
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