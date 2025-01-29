            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>DETAIL DATA RUANGAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <input type="text" name="KODE_RUANGAN" id="KODE_RUANGAN" value="<?= $get_maping_ruangan->NAMA_AREA; ?>" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KODE RUANGAN</label>
                                                <input type="text" name="KODE_RUANGAN" id="KODE_RUANGAN" value="<?= $get_maping_ruangan->KODE_RUANGAN; ?>" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA RUANGAN</label>
                                                <input type="text" class="form-control" id="NAMA_RUANGAN" value="<?= $get_maping_ruangan->NAMA_RUANGAN; ?>" name="NAMA_RUANGAN" readonly>
                                            </div>
                                            
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN RUANGAN</label>
                                                <textarea name="KETERANGAN_RUANGAN" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket" readonly><?= $get_maping_ruangan->KETERANGAN_RUANGAN; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Submit</button>
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