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
                                        <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>AREA</label>
                                                <select required name="KODE_AREA" id="KODE_AREA" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Area --</option>
                                                    <?php foreach ($get_area as $row) : ?>
                                                        <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan kategori!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>NAMA RUANGAN</label>
                                                <input required type="text" class="form-control" id="NAMA_RUANGAN" name="NAMA_RUANGAN">
                                                <div class="invalid-feedback">
                                                    Masukkan nama ruangan  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>KETERANGAN RUANGAN</label>
                                                <textarea required name="KETERANGAN_RUANGAN" placeholder="Masukkan keterangan ruangan" class="form-control" id="description_ticket"></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan keterangan ruangan anda!
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
                                alert('Gagal melakukan proses.');
                            }
                        });
                    });
                    
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>