            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_PRODUK_ITEM_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT DATA PRODUK ITEM</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-3 col-lg-3">
                                                <label>KODE PRODUK</label>
                                                <input required type="text" name="KODE_ITEM" id="KODE_ITEM"
                                                    class="form-control">
                                                <div class="invalid-feedback">
                                                    Masukkan kode produk?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA PRODUK</label>
                                                <input required type="text" class="form-control" id="NAMA_ITEM"
                                                    name="NAMA_ITEM">
                                                <div class="invalid-feedback">
                                                    Masukkan nama produk !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-3 col-lg-3">
                                                <label>KATEGORI PRODUK</label>
                                                <select required name="KODE_KATEGORI" id="KODE_KATEGORI"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Kategori --</option>
                                                    <?php foreach ($get_kategori_produk as $row) : ?>
                                                        <option value="<?= $row->KODE_PRODUK_KATEGORI; ?>">
                                                            <?= $row->NAMA_PRODUK_KATEGORI; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan kategori!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-md-3 col-lg-3">
                                                <label>SATUAN</label>
                                                <input required type="text" class="form-control" id="SATUAN"
                                                    name="SATUAN">
                                                <div class="invalid-feedback">
                                                    Masukkan nama produk !
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-9 col-lg-9">
                                                <label>KETERANGAN PRODUK</label>
                                                <textarea required name="KETERANGAN_ITEM"
                                                    placeholder="Masukkan keterangan produk" class="form-control" rows="0"
                                                    id="description_ticket"></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan keterangan produk anda!
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>FOTO</label>
                                                <input required type="file" class="form-control" id="FOTO_ITEM"
                                                    name="FOTO_ITEM" accept="image/gif, image/jpeg, image/png">
                                                <div class="invalid-feedback">
                                                    Masukkan FOTO !
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <div class="control-label ">Apakah Produk Item Ini Bisa Custom ?</div>
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="CUSTOM" id="CUSTOM" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">YA (ON) / TIDAK (OFF)</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
                                        <a href="<?php echo base_url(); ?>produk_item" class="btn btn-secondary"><i
                                                class="fa fa-times"></i> BATAL</a>
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
                    $('#FORM_PRODUK_ITEM_TAMBAH').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = new FormData(this);

                        let KODE_ITEM = $('#KODE_ITEM').val();

                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "produk_item/get_single/" +
                                KODE_ITEM, // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response !== 'null') {
                                    alert('Kode Produk sudah ada!');
                                } else {
                                    $.ajax({
                                        url: "<?php echo base_url(); ?>" +
                                            "produk_item/insert", // Endpoint untuk proses input
                                        type: 'POST',
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        success: function(response) {
                                            let res = JSON.parse(response);
                                            if (res.success) {
                                                swal('Sukses', 'Tambah Data Berhasil!',
                                                    'success').then(function() {
                                                    location.href =
                                                        "<?php echo base_url(); ?>produk_item";
                                                });
                                            } else {
                                                alert('Gagal menyimpan data: ' + response
                                                    .error);
                                            }
                                        },
                                        error: function() {
                                            alert('Gagal melakukan proses.');
                                        }
                                    });

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