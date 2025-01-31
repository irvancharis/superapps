            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>EDIT DATA RUANGAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select required name="KODE_AREA" id="KODE_AREA" class="form-control">
                                                    <?php foreach ($get_maping_area as $row) : ?>
                                                        <option value="<?= $row->KODE_AREA; ?>" <?php if ($row->KODE_AREA == $get_maping_ruangan->KODE_AREA) echo "selected"; ?>><?= $row->NAMA_AREA; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KODE RUANGAN</label>
                                                <input required type="text" name="KODE_RUANGAN" id="KODE_RUANGAN" value="<?= $get_maping_ruangan->KODE_RUANGAN; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA RUANGAN</label>
                                                <input required type="text" class="form-control" id="NAMA_RUANGAN" value="<?= $get_maping_ruangan->NAMA_RUANGAN; ?>" name="NAMA_RUANGAN">
                                            </div>
                                            
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN RUANGAN</label>
                                                <textarea required name="KETERANGAN_RUANGAN" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket"><?= $get_maping_ruangan->KETERANGAN_RUANGAN; ?></textarea>
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
                                alert('Gagal melakukan proses.');
                            }
                        });
                    });
                    
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>