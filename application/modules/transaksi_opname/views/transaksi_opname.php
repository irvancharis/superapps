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
                                            class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="TABEL">
                                            <thead>
                                                <tr>
                                                    <th>TANGGAL OPNAME</th>
                                                    <th>DEPARTEMEN</th>
                                                    <th>PELAKSANA</th>
                                                    <th>APROVAL</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_TRANSAKSI_OPNAME as $index => $d) : ?>
                                                <tr>
                                                    
                                                    <td><?php echo $this->tanggalindo->formatTanggal($d->TANGGAL_OPNAME, 'l, d F Y'); ?>
                                                    </td>
                                                    <td><?php echo $d->NAMA_DEPARTEMEN; ?></td>
                                                    <td><?php echo $d->NAMA_USER_PELAKSANA; ?></td>
                                                    <td>
                                                        <?php echo 'KABAG - ( ' . (($d->KODE_APROVAL_KABAG != null) ? $d->NAMA_APROVAL_KABAG . ' <i class="fas fa-check text-success"></i>' : $d->NAMA_APROVAL_KABAG . ' <i class="fas fa-times text-danger"></i>') . ' )'; ?><br>
                                                        <?php echo 'GM - ( ' . (($d->KODE_APROVAL_GM != null) ? $d->NAMA_APROVAL_GM . ' <i class="fas fa-check text-success"></i>' : $d->NAMA_APROVAL_GM . ' <i class="fas fa-times text-danger"></i>') . ' )'; ?><br>
                                                        <?php echo 'HEAD - ( ' . (($d->KODE_APROVAL_HEAD != null) ? $d->NAMA_APROVAL_HEAD . ' <i class="fas fa-check text-success"></i>' : $d->NAMA_APROVAL_HEAD . ' <i class="fas fa-times text-danger"></i>') . ' )'; ?>
                                                    <td>
                                                        <?php if($d->STATUS_OPNAME == 'MENUNGGU APROVAL KABAG')
                                                            {
                                                        ?>
                                                        <span class="badge badge-warning">MENUNGGU APROVAL KABAG</span>
                                                        <a href="<?=site_url('transaksi_opname/aproval_kabag/'.$d->UUID_TRANSAKSI_OPNAME);?>"
                                                            class="btn btn-primary"><i class="fas fa-eye"></i>
                                                        </a>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_OPNAME == 'MENUNGGU APROVAL GM')
                                                            {
                                                        ?>
                                                        <span class="badge badge-warning">MENUNGGU APROVAL GM</span>
                                                        <a href="<?=site_url('transaksi_opname/aproval_gm/'.$d->UUID_TRANSAKSI_OPNAME);?>"
                                                            class="btn btn-primary"><i class="fas fa-eye"></i>
                                                        </a>

                                                        <?php
                                                            }
                                                            elseif($d->STATUS_OPNAME == 'MENUNGGU APROVAL HEAD')
                                                            {
                                                        ?>
                                                        <span class="badge badge-warning">MENUNGGU APROVAL HEAD</span>
                                                        <a href="<?=site_url('transaksi_opname/aproval_head/'.$d->UUID_TRANSAKSI_OPNAME);?>"
                                                            class="btn btn-primary"><i class="fas fa-eye"></i>
                                                        </a>

                                                        <?php
                                                        }
                                                            elseif($d->STATUS_OPNAME == 'SELESAI')
                                                            {
                                                        ?>
                                                        <span class="badge badge-success">SELESAI</span>
                                                        <?php
                                                            }elseif($d->STATUS_OPNAME == 'CANCEL')
                                                            {
                                                        ?>
                                                        <span class="badge badge-danger">CANCEL</span>
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