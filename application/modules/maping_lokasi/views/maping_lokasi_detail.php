            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>INPUT DATA LOKASI</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KODE LOKASI</label>
                                                <input type="text" name="KODE_LOKASI" id="KODE_LOKASI" value="<?= $get_maping_lokasi->KODE_LOKASI; ?>" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA LOKASI</label>
                                                <input type="text" class="form-control" id="NAMA_LOKASI" value="<?= $get_maping_lokasi->NAMA_LOKASI; ?>" name="NAMA_LOKASI" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN KATEGORI</label>
                                                <textarea name="KETERANGAN_RUANGAN" placeholder="Masukkan keterangan ruangan" class="form-control" id="description_ticket" readonly><?= $get_maping_lokasi->KETERANGAN_RUANGAN; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                    <a href="<?=site_url('maping_lokasi');?>" class="btn btn-primary">Kembali</a>
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