            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DETAIL PRODUK STOK</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-3">TANGGAL TINDAKAN</th>
                                                    <th class="text-center col-3">PELAKSANA</th>
                                                    <th>KETERANGAN TINDAKAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($histori_aset as $index => $d) : ?>
                                                <tr>
                                                    <td><?php echo $d->TANGGAL_PENANGANAN; ?></td>
                                                    <td><?php echo $d->NAMA_USER_TINDAKAN; ?></td>
                                                    <td><?php echo $d->KETERANGAN_TINDAKAN; ?></td>
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

            <?php $this->load->view('layout/footer'); ?>
            </body>
            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>