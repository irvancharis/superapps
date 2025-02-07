            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>INPUT DATA PRODUK ITEM</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KODE PRODUK</label>
                                                <input required type="text" name="KODE_FITUR" id="KODE_FITUR" value="<?= $get_fitur->KODE_FITUR; ?>" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA PRODUK</label>
                                                <input required type="text" class="form-control" id="NAMA_ITEM" value="<?= $get_fitur->NAMA_ITEM; ?>" name="NAMA_ITEM" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KATEGORI PRODUK</label>
                                                <input required type="text" class="form-control" id="NAMA_PRODUK_KATEGORI" value="<?= $get_fitur->NAMA_PRODUK_KATEGORI; ?>" name="NAMA_ITEM" readonly>
                                            </div>
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN PRODUK</label>
                                                <textarea required name="KETERANGAN_ITEM" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket" readonly><?= $get_fitur->KETERANGAN_ITEM; ?></textarea>
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