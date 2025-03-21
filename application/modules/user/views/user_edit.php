            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>EDIT USER</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>KARYAWAN</label>
                                                <select required disabled readonly name="ID_KARYAWAN" id="ID_KARYAWAN"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Karyawan --</option>
                                                    <?php foreach ($get_karyawan as $row) : ?>
                                                    <option value="<?= $row->ID_KARYAWAN; ?>"
                                                        <?php if ($row->ID_KARYAWAN == $get_user->ID_KARYAWAN) echo "selected"; ?>>
                                                        <?= $row->NAMA_KARYAWAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan kategori!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>ROLE</label>
                                                <select required name="ROLE" id="ROLE" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Role
                                                        --</option>
                                                    <?php foreach ($get_role as $row) : ?>
                                                    <option value="<?= $row->KODE_ROLE; ?>"
                                                        <?php if ($row->KODE_ROLE == $get_user->KODE_ROLE) echo "selected"; ?>>
                                                        <?= $row->NAMA_ROLE; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan kategori!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NEW PASSWORD</label>
                                                <input type="text" name="PASSWORD" id="PASSWORD" class="form-control" >
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan PASWORD!
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
    $('#FORM_DATA').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = $(this).serialize();

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" + "user/update/" +
            '<?= $get_user->UUID_USER; ?>', // Endpoint untuk proses input
            type: 'POST',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                        location.href = "<?php echo base_url(); ?>user";
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