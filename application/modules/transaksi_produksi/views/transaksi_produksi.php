            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DATA TRANSAKSI PRODUKSI</h4>
                                    <div class="card-header-action">
                                        <a href="<?php echo base_url('transaksi_produksi/tambah') ?>"
                                            class="btn btn-outline-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-sm" id="TABEL">
                                            <thead>
                                                <tr>
                                                    <th class="col-2">TANGGAL PENGAJUAN</th>
                                                    <th class="">DEPARTEMEN</th>
                                                    <th class="text-center col-2">USER PENGAJUAN</th>
                                                    <th class="text-center col-1">STATUS</th>
                                                    <th class="text-center col-2"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_TRANSAKSI_PRODUKSI as $index => $d) : ?>
                                                <tr>

                                                    <td>
                                                        <?php echo $this->tanggalindo->formatTanggal($d->TANGGAL_PENGAJUAN, 'l, d F Y H:i:s'); ?>
                                                    </td>
                                                    <td><i class="fa fa-map-marker"></i>
                                                        <?php echo $d->NAMA_AREA; ?><br><i
                                                            class="fa fa-building"></i>
                                                        <?php echo $d->NAMA_DEPARTEMEN; ?>
                                                    </td>
                                                    <td class="text-center"><?php echo $d->NAMA_PENGAJUAN; ?></td>
                                                    <td class="text-center">
                                                        <?php if($d->STATUS_TRANSAKSI_PRODUKSI == 'MENUNGGU PENYERAHAN BAHAN')
                                                            {
                                                        ?>
                                                        <span class="badge badge-primary">MENUNGGU PENYERAHAN BAHAN</span>                                                        
                                                        <?php
                                                        }
                                                            elseif($d->STATUS_TRANSAKSI_PRODUKSI == 'PROSES PRODUKSI')
                                                            {
                                                        ?>
                                                        <span class="badge badge-success">PROSES PRODUKSI</span>
                                                        <?php
                                                        }
                                                            elseif($d->STATUS_TRANSAKSI_PRODUKSI == 'SELESAI')
                                                            {
                                                        ?>
                                                        <span class="badge badge-success">SELESAI</span>
                                                        <?php
                                                        }
                                                            elseif($d->STATUS_TRANSAKSI_PRODUKSI == 'BATAL')
                                                            {
                                                        ?>
                                                        <span class="badge badge-danger">BATAL</span>
                                                        <?php 
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="<?=site_url('transaksi_produksi/detail/'.$d->UUID_TRANSAKSI_PRODUKSI);?>" class="btn btn-outline-secondary"><i
                                                                class="fas fa-eye"></i></a>

                                                        <?php 
                                                        if($d->STATUS_TRANSAKSI_PRODUKSI == 'MENUNGGU APROVAL KABAG')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_produksi/aproval_kabag/'.$d->UUID_TRANSAKSI_PRODUKSI);?>"
                                                            class="btn btn-outline-secondary"><i class="fas fa-edit"></i>
                                                        </a>
                                                        <?php
                                                            }
                                                            elseif($d->STATUS_TRANSAKSI_PRODUKSI == 'MENUNGGU PENYERAHAN')
                                                            {
                                                        ?>
                                                        <a href="<?=site_url('transaksi_produksi/proses_penyerahan/'.$d->UUID_TRANSAKSI_PRODUKSI);?>"
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