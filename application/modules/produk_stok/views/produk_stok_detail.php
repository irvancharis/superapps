            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DETAIL PRODUK</h4>
                                </div>
                                <div class="card-body">
                                    <center><img
                                            src="<?php echo base_url('produk_stok/qr/').$get_produk_stok->UUID_STOK; ?>"
                                            alt=""></center>
                                    <div class="row">
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>UUID STOK</label>
                                            <input required type="text" name="KODE_ITEM" id="KODE_ITEM"
                                                value="<?= $get_produk_stok->UUID_STOK; ?>" class="form-control"
                                                readonly>
                                        </div>
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>KODE ITEM</label>
                                            <input required type="text" class="form-control" id="NAMA_ITEM"
                                                value="<?= $get_produk_stok->KODE_ITEM; ?>" name="NAMA_ITEM" readonly>
                                        </div>
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>NAMA PRODUK</label>
                                            <input required type="text" class="form-control" id="NAMA_PRODUK"
                                                value="<?= $get_produk_stok->NAMA_PRODUK; ?>" name="NAMA_PRODUK"
                                                readonly>
                                        </div>
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>KETEGORI</label>
                                            <input required type="text" class="form-control" id="NAMA_PRODUK_KATEGORI"
                                                value="<?= $get_produk_stok->NAMA_PRODUK_KATEGORI; ?>" name="NAMA_PRODUK_KATEGORI"
                                                readonly>
                                        </div>
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>DEPARTEMEN</label>
                                            <input required type="text" class="form-control" id="NAMA_DEPARTEMEN"
                                                value="<?= $get_produk_stok->NAMA_DEPARTEMEN; ?>" name="NAMA_DEPARTEMEN"
                                                readonly>
                                        </div>
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>AREA</label>
                                            <input required type="text" class="form-control" id="NAMA_PRODUK_KATEGORI"
                                                value="<?= $get_produk_stok->NAMA_PRODUK_KATEGORI; ?>" name="NAMA_PRODUK_KATEGORI"
                                                readonly>
                                        </div>
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>RUANGAN</label>
                                            <input required type="text" class="form-control" id="NAMA_PRODUK_KATEGORI"
                                                value="<?= $get_produk_stok->NAMA_RUANGAN; ?>" name="NAMA_PRODUK_KATEGORI"
                                                readonly>
                                        </div>
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>LOKASI</label>
                                            <input required type="text" class="form-control" id="NAMA_PRODUK_KATEGORI"
                                                value="<?= $get_produk_stok->NAMA_LOKASI; ?>" name="NAMA_PRODUK_KATEGORI"
                                                readonly>
                                        </div>
                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label>JUMLAH STOK</label>
                                            <input required type="text" class="form-control" id="NAMA_PRODUK_KATEGORI"
                                                value="<?= $get_produk_stok->JUMLAH_STOK; ?>" name="NAMA_PRODUK_KATEGORI"
                                                readonly>
                                        </div>

                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="<?=site_url('produk_stok');?>" class="btn btn-primary">
                                            <i class="fa fa-arrow-left"></i> KEMBALI</a>
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