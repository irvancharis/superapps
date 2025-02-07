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
                                                <input required type="text" name="KODE_FITUR" id="KODE_FITUR" value="<?= $get_fitur->KODE_FITUR; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA PRODUK</label>
                                                <input required type="text" class="form-control" id="NAMA_ITEM" value="<?= $get_fitur->NAMA_ITEM; ?>" name="NAMA_ITEM">
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KATEGORI PRODUK</label>
                                                <select required name="KODE_KATEGORI" id="KODE_KATEGORI" class="form-control">
                                                    <option value="<?= $get_fitur->KODE_KATEGORI; ?>" class="text-center" selected disabled><?= $get_fitur->NAMA_PRODUK_KATEGORI; ?></option>
                                                    <?php foreach ($get_kategori_produk as $row) : ?>
                                                        <option value="<?= $row->KODE_PRODUK_KATEGORI; ?>"><?= $row->NAMA_PRODUK_KATEGORI; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN PRODUK</label>
                                                <textarea required name="KETERANGAN_ITEM" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket"><?= $get_fitur->KETERANGAN_ITEM; ?></textarea>
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
                            url: "<?php echo base_url(); ?>" + "produk_item/update/"+ <?= $get_fitur->KODE_FITUR; ?> , // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        location.href = "<?php echo base_url(); ?>produk_item";
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