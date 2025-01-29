            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_MAPING_RUANGAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT DATA RUANGAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KODE RUANGAN</label>
                                                <input type="text" name="KODE_RUANGAN" id="KODE_RUANGAN" class="form-control">
                                                <div class="invalid-feedback">
                                                Masukkan kode ruangan?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA RUANGAN</label>
                                                <input type="text" class="form-control" id="NAMA_RUANGAN" name="NAMA_RUANGAN">
                                                <div class="invalid-feedback">
                                                    Masukkan nama ruangan  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN KATEGORI</label>
                                                <textarea name="KETERANGAN_RUANGAN" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket"></textarea>
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
            

            <?php $this->load->view('layout/footer'); ?>

            <script>
                $(document).ready(function() {
                    
                    // Input Area
                    $('#FORM_MAPING_RUANGAN_TAMBAH').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "maping_ruangan/insert", // Endpoint untuk proses input
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