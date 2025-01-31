            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>INPUT DATA PRODUK KATEGORI</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KODE KATEGORI</label>
                                                <input required type="text" name="KODE_PRODUK_KATEGORI" id="KODE_PRODUK_KATEGORI" value="<?= $get_produk_kategori->KODE_PRODUK_KATEGORI; ?>" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA KATEGORI</label>
                                                <input required type="text" class="form-control" id="NAMA_PRODUK_KATEGORI" value="<?= $get_produk_kategori->NAMA_PRODUK_KATEGORI; ?>" name="NAMA_PRODUK_KATEGORI" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN KATEGORI</label>
                                                <textarea required name="KETERANGAN_PRODUK_KATEGORI" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket" readonly><?= $get_produk_kategori->KETERANGAN_PRODUK_KATEGORI; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                    <a href="<?=site_url('produk_kategori');?>" class="btn btn-primary">Kembali</a>
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