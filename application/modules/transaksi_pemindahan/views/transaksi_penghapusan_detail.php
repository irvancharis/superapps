            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>DETAIL TRANSAKSI PENGHAPUSAN</h4>

                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="form-group col-12 col-md-12 col-lg-6">
                                                <table class="table table-striped table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <th>UUID TRANSAKSI PENGHAPUSAN</th>
                                                            <td><?= $transaksi->UUID_TRANSAKSI_PENGHAPUSAN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>TANGGAL PENGHAPUSAN</th>
                                                            <td><?= $this->tanggalindo->formatTanggal($transaksi->TANGGAL_PENGHAPUSAN);?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>USER PALAKSANA</th>
                                                            <td><?= $transaksi->NAMA_USER_PELAKSANA; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>DEPARTEMEN</th>
                                                            <td><?= $transaksi->NAMA_DEPARTEMEN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>AREA</th>
                                                            <td><?= $transaksi->NAMA_AREA; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>RUANGAN</th>
                                                            <td><?= $transaksi->NAMA_RUANGAN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>LOKASI</th>
                                                            <td><?= $transaksi->NAMA_LOKASI; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>KETERANGAN PENGHAPUSAN</th>
                                                            <td><?= $transaksi->KETERANGAN_PENGHAPUSAN; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th>STATUS PENGHAPUSAN</th>
                                                            <td><?= $transaksi->STATUS_PENGHAPUSAN; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="form-group col-12 col-md-12 col-lg-6">
                                                <table class="table table-striped table-sm">
                                                    <tbody>


                                                        <tr>
                                                            <th>APROVAL KABAG</th>
                                                            <td><?= $transaksi->NAMA_APROVAL_KABAG; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>TANGGAL APROVAL KABAG</th>
                                                            <td><?= $this->tanggalindo->formatTanggal($transaksi->TANGGAL_APROVAL_KABAG);?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>KETERANGAN APROVAL KABAG</th>
                                                            <td><?= $transaksi->KETERANGAN_CANCEL_KABAG; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>APROVAL GM</th>
                                                            <td><?= $transaksi->NAMA_APROVAL_GM; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>TANGGAL APROVAL GM</th>
                                                            <td><?= $this->tanggalindo->formatTanggal($transaksi->TANGGAL_APROVAL_HEAD);?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>KETERANGAN APROVAL GM</th>
                                                            <td><?= $transaksi->KETERANGAN_CANCEL_GM; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>APROVAL HEAD</th>
                                                            <td><?= $transaksi->NAMA_APROVAL_HEAD; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>TANGGAL APROVAL HEAD</th>
                                                            <td><?= $this->tanggalindo->formatTanggal($transaksi->TANGGAL_APROVAL_HEAD);?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>KETERANGAN APROVAL HEAD</th>
                                                            <td><?= $transaksi->KETERANGAN_CANCEL_HEAD; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th>TANGGAL PENYESUAIAN STOK</th>
                                                            <td><?= $this->tanggalindo->formatTanggal($transaksi->TANGGAL_PENYESUAIAN);?>
                                                            </td>
                                                        </tr>



                                                    </tbody>
                                                </table>
                                            </div>



                                        </div>


                                        <div class="table-responsive">
                                            <table class="table table-striped" id="dataprodukitem">
                                                <thead>
                                                    <tr>
                                                        <th>PRODUK/ITEM</th>
                                                        <th>STOK SISTEM</th>
                                                        <th>STOK REAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                    <?php foreach ($detail_transaksi as $index => $d) : ?>
                                                    <tr>
                                                        <td><?php echo $d->NAMA_PRODUK; ?></td>
                                                        <td><?php echo $d->JUMLAH_STOK; ?></td>
                                                        <td><?php echo $d->STOK_AKTUAL; ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div><br><br>

                                        <div class="card-footer text-center">
                                            <a href="<?=site_url('transaksi_penghapusan');?>" class="btn btn-primary">
                                                <i class="fa fa-arrow-left"></i> KEMBALI</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                </section>
            </div>


            <?php $this->load->view('layout/footer'); ?>

            <script>
$(document).ready(function() {

    $('#dataprodukitem').dataTable({
        paging: false,
        searching: false
    });
});
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>