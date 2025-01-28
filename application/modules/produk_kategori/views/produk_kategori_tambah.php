            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_PRODUK_KATEGORI_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT DATA PRODUK KATEGORI</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KODE KATEGORI</label>
                                                <input type="text" name="KODE_PRODUK_KATEGORI" id="KODE_PRODUK_KATEGORI" class="form-control">
                                                <div class="invalid-feedback">
                                                Masukkan kode kategori?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA KATEGORI</label>
                                                <input type="text" class="form-control" id="NAMA_PRODUK_KATEGORI" name="NAMA_PRODUK_KATEGORI">
                                                <div class="invalid-feedback">
                                                    Masukkan nama kategori  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN KATEGORI</label>
                                                <textarea name="KETERANGAN_PRODUK_KATEGORI" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket"></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan keterangan kategori anda!
                                                </div>
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
                    $('#FORM_PRODUK_KATEGORI_TAMBAH').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "produk_kategori/insert", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        location.href = "<?php echo base_url(); ?>produk_kategori";
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