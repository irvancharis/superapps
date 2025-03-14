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
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>KODE PRODUK</label>
                                                <input disabled type="text" name="KODE_ITEM" id="KODE_ITEM" value="<?= $get_produk_item->KODE_ITEM; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>NAMA PRODUK</label>
                                                <input required type="text" class="form-control" id="NAMA_ITEM" value="<?= $get_produk_item->NAMA_ITEM; ?>" name="NAMA_ITEM">
                                            </div>
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>KATEGORI PRODUK</label>
                                                <select required name="KODE_KATEGORI" id="KODE_KATEGORI" class="form-control">
                                                    <option value="<?= $get_produk_item->KODE_KATEGORI; ?>" class="text-center" selected disabled><?= $get_produk_item->NAMA_PRODUK_KATEGORI; ?></option>
                                                    <?php foreach ($get_kategori_produk as $row) : ?>
                                                        <option value="<?= $row->KODE_PRODUK_KATEGORI; ?>" <?= $get_produk_item->KODE_KATEGORI == $row->KODE_PRODUK_KATEGORI ? 'selected' : ''; ?>><?= $row->NAMA_PRODUK_KATEGORI; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>SATUAN</label>
                                                <input required type="text" class="form-control" id="SATUAN" name="SATUAN" value="<?= $get_produk_item->SATUAN; ?>">
                                                <div class="invalid-feedback">
                                                    Masukkan nama produk !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>KETERANGAN PRODUK</label>
                                                <textarea required name="KETERANGAN_ITEM" placeholder="Masukkan keterangan produk" class="form-control" id="description_ticket"><?= $get_produk_item->KETERANGAN_ITEM; ?></textarea>
                                            </div>
                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>FOTO</label> <br>
                                                <img src="<?php echo base_url('assets/uploads/item/') . $get_produk_item->FOTO_ITEM; ?>" alt="" id="preview-img" class="img-thumbnail mb-3" style="width: 100px;">
                                                <input required type="file" class="form-control" id="FOTO_ITEM" name="FOTO_ITEM" accept="image/gif, image/jpeg, image/png">
                                                <div class="invalid-feedback">
                                                    Masukkan FOTO !
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
                                        <a href="<?php echo base_url(); ?>produk_item" class="btn btn-secondary"><i class="fa fa-times"></i> BATAL</a>
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

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "produk_item/update/" + <?= $get_produk_item->KODE_ITEM; ?>, // Endpoint untuk proses input
                            type: 'POST',
                            data: new FormData($('#FORM_DATA')[0]),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Update Data Berhasil!', 'success').then(function() {
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

                    // Preview Images Before Upload
                    $('#FOTO_ITEM').on('change', function() {
                        let file = this.files[0];
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview-img').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>