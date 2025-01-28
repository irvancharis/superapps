            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>INPUT DATA RUANGAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KODE RUANGAN</label>
                                                <input type="text" name="KODE_RUANGAN" id="KODE_RUANGAN" value="<?= $get_maping_ruangan->KODE_RUANGAN; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA RUANGAN</label>
                                                <input type="text" class="form-control" id="NAMA_RUANGAN" value="<?= $get_maping_ruangan->NAMA_RUANGAN; ?>" name="NAMA_RUANGAN">
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KATEGORI PRODUK</label>
                                                <select name="KODE_RUANGAN" id="KODE_RUANGAN" class="form-control">
                                                    <option value="<?= $get_maping_ruangan->KODE_RUANGAN; ?>" class="text-center" selected disabled><?= $get_maping_ruangan->NAMA_RUANGAN; ?></option>
                                                    <?php foreach ($get_kategori_produk as $row) : ?>
                                                        <option value="<?= $row->KODE_RUANGAN; ?>"><?= $row->NAMA_RUANGAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN PRODUK</label>
                                                <textarea name="KETERANGAN_RUANGAN" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket"><?= $get_maping_ruangan->KETERANGAN_RUANGAN; ?></textarea>
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
            <footer class="main-footer">
                <div class="footer-left">
                    <a href="templateshub.net">SAGROUP.ID</a></a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
            </div>
            </div>
            

            <?php $this->load->view('layout/footer'); ?>

            <script>
                $(document).ready(function() {
                    
                    // Input Area
                    $('#FORM_DATA').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "maping_ruangan/update/"+ <?= $get_maping_ruangan->KODE_RUANGAN; ?> , // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        location.href = "<?php echo base_url(); ?>maping_ruangan";
                                    });
                                } else {
                                    alert('Gagal menyimpan data: ' + response.error);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan pada server.');
                            }
                        });
                    });
                    
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>