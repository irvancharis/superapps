            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>DETAIL USER</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KARYAWAN</label>
                                                <select required name="ID_KARYAWAN" id="ID_KARYAWAN" class="form-control" readonly>
                                                    <option value="" class="text-center" selected disabled>-- Pilih Karyawan --</option>
                                                    <?php foreach ($get_karyawan as $row) : ?>
                                                        <option value="<?= $row->ID_KARYAWAN; ?>" <?php if ($row->ID_KARYAWAN == $get_user->ID_KARYAWAN) echo "selected"; ?>><?= $row->NAMA_KARYAWAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan kategori!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>ROLE</label>
                                                <select required name="ROLE" id="ROLE" class="form-control" readonly>
                                                    <option value="" class="text-center" selected disabled>-- Pilih Role --</option>
                                                    <?php foreach ($get_role as $row) : ?>
                                                        <option value="<?= $row->KODE_ROLE; ?>" <?php if ($row->KODE_ROLE == $get_user->KODE_ROLE) echo "selected"; ?>><?= $row->NAMA_ROLE; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan kategori!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                    <a href="<?=site_url('user');?>" class="btn btn-primary">Kembali</a>
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