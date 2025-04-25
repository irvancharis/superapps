            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>DETAIL PRODUK ITEM</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <center>
                                                    <img src="<?php echo base_url('assets/uploads/item/').$get_produk_item->FOTO_ITEM; ?>"
                                                        alt="">
                                                </center>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <table class="table table-striped table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <th class="col-3">KODE PRODUK ITEM</th>
                                                            <td><?= $get_produk_item->KODE_ITEM; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>NAMA PRODUK ITEM</th>
                                                            <td><?= $get_produk_item->NAMA_ITEM; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>KATEGORI</th>
                                                            <td><?= $get_produk_item->NAMA_PRODUK_KATEGORI; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>SATUAN</th>
                                                            <td><?= $get_produk_item->SATUAN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>KETERANGAN</th>
                                                            <td><?= $get_produk_item->KETERANGAN_ITEM; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a href="<?=site_url('produk_item');?>" class="btn btn-primary">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <?php $this->load->view('layout/footer'); ?>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>