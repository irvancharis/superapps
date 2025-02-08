            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_FITUR_TAMBAH">
                                    <div class="card-header">
                                        <h4>TAMBAH DETAIL FITUR </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>FITUR</label>
                                                <select required name="KODE_FITUR" id="KODE_FITUR"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Fitur --</option>
                                                    <?php foreach ($get_fitur as $row) : ?>
                                                    <option value="<?= $row->KODE_FITUR; ?>">
                                                        <?= $row->NAMA_FITUR; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan kategori!
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA DETAIL FITUR</label>
                                                <input required type="text" class="form-control" id="NAMA_DETAIL_FITUR"
                                                    name="NAMA_DETAIL_FITUR">
                                                <div class="invalid-feedback">
                                                    Masukkan nama detail fitur !
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KETERANGAN DETAIL FITUR</label>
                                                <textarea required name="KETERANGAN"
                                                    placeholder="Masukkan keterangan fitur" class="form-control"
                                                    id="KETERANGAN"></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan keterangan fitur anda!
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
    $('#FORM_FITUR_TAMBAH').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = $(this).serialize();

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" + "fitur/insert_detail_fitur", // Endpoint untuk proses input
            type: 'POST',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                        location.href = "<?php echo base_url(); ?>fitur";
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