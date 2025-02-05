            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT DATA TRANSAKSI PENGADAAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NO REGISTER</label>
                                                <input required type="text" class="form-control"
                                                    id="NAMA_TRANSAKSI_PENGADAAN" name="NAMA_TRANSAKSI_PENGADAAN">
                                                <div class="invalid-feedback">
                                                    Masukkan NO REGISTER !
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NO REGISTER</label>
                                                <select required name="ID_MAPING_AREA" id="ID_MAPING_AREA"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Area
                                                        --</option>
                                                    <?php foreach ($get_area as $row) : ?>
                                                    <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan NO REGISTER!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DEPARTEMEN</label>
                                                <select required name="ID_DEPARTEMENT" id="ID_DEPARTEMENT"
                                                    class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Departement --</option>
                                                    <?php foreach ($get_departemen as $row) : ?>
                                                    <option value="<?= $row->KODE_DEPARTEMEN; ?>">
                                                        <?= $row->NAMA_DEPARTEMEN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan DEPARTEMENT!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>JABATAN</label>
                                                <select required name="ID_JABATAN" id="ID_JABATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Jabatan --</option>
                                                    <?php foreach ($get_jabatan as $row) : ?>
                                                    <option value="<?= $row->KODE_JABATAN; ?>">
                                                        <?= $row->NAMA_JABATAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan JABATAN!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NIP</label>
                                                <input required type="number"
                                                    oninput="this.value = this.value.replace(/\D+/g, '')" name="NIP"
                                                    id="NIP" class="form-control">
                                                <div class="invalid-feedback">
                                                    Masukkan NIP?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA TRANSAKSI_PENGADAAN</label>
                                                <input required type="text" class="form-control"
                                                    id="NAMA_TRANSAKSI_PENGADAAN" name="NAMA_TRANSAKSI_PENGADAAN">
                                                <div class="invalid-feedback">
                                                    Masukkan NAMA TRANSAKSI_PENGADAAN !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>ALAMAT</label>
                                                <input required type="text" class="form-control" id="ALAMAT"
                                                    name="ALAMAT">
                                                <div class="invalid-feedback">
                                                    Masukkan ALAMAT !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TELEPON</label>
                                                <input required type="number"
                                                    oninput="this.value = this.value.replace(/\D+/g, '')"
                                                    class="form-control" id="TELEPON" name="TELEPON">
                                                <div class="invalid-feedback">
                                                    Masukkan TELEPON !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>EMAIL</label>
                                                <input required type="text" class="form-control" id="EMAIL"
                                                    name="EMAIL">
                                                <div class="invalid-feedback">
                                                    Masukkan EMAIL !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>PENDIDIKAN AKHIR</label>
                                                <input required type="text" class="form-control" id="PENDIDIKAN_AKHIR"
                                                    name="PENDIDIKAN_AKHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan PENDIDIKAN AKHIR !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NIK</label>
                                                <input required type="number"
                                                    oninput="this.value = this.value.replace(/\D+/g, '')"
                                                    class="form-control" id="NIK" name="NIK">
                                                <div class="invalid-feedback">
                                                    Masukkan NIK !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TEMPAT LAHIR</label>
                                                <input required type="text" class="form-control" id="TEMPAT_LAHIR"
                                                    name="TEMPAT_LAHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan TEMPAT LAHIR !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TANGGAL LAHIR</label>
                                                <input required type="DATE" class="form-control" id="TANGGAL_LAHIR"
                                                    name="TANGGAL_LAHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan TANGGAL LAHIR !
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>JENIS KELAMIN</label>
                                                <select required name="JENIS_KELAMIN" id="JENIS_KELAMIN"
                                                    class="form-control">
                                                    <option value="LAKI-LAKI" class="text-center">LAKI-LAKI</option>
                                                    <option value="PEREMPUAN" class="text-center">PEREMPUAN</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan JENIS KELAMIN!
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AGAMA</label>
                                                <select required name="AGAMA" id="AGAMA" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Kategori --</option>
                                                    <option value="ISLAM" class="text-center">ISLAM</option>
                                                    <option value="KRISTEN" class="text-center">KRISTEN</option>
                                                    <option value="PROTESTAN" class="text-center">PROTESTAN</option>
                                                    <option value="HINDU" class="text-center">HINDU</option>
                                                    <option value="BUDHA" class="text-center">BUDHA</option>
                                                    <option value="KONGHUCU" class="text-center">KONGHUCU</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AGAMA!
                                                    <div>
                                                    </div>

                                                    <div class="form-group col-12 col-md-6 col-lg-6">
                                                        <label>AKTIF MULAI TANGGAL</label>
                                                        <input required type="DATE" class="form-control"
                                                            id="AKTIF_MULAI_TANGGAL" name="AKTIF_MULAI_TANGGAL">
                                                        <div class="invalid-feedback">
                                                            Masukkan AKTIF MULAI TANGGAL !
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12 col-md-6 col-lg-6">
                                                        <label>BATAS KONTRAK KERJA</label>
                                                        <input required type="DATE" class="form-control"
                                                            id="BATAS_KONTRAK_KERJA" name="BATAS_KONTRAK_KERJA">
                                                        <div class="invalid-feedback">
                                                            Masukkan BATAS KONTRAK KERJA !
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-12 col-md-6 col-lg-6">
                                                        <label>STATUS TRANSAKSI_PENGADAAN</label>
                                                        <select required name="STATUS_TRANSAKSI_PENGADAAN"
                                                            id="STATUS_TRANSAKSI_PENGADAAN" class="form-control">
                                                            <option value="AKTIF" class="text-center">AKTIF</option>
                                                            <option value="NONAKTIF" class="text-center">NON-AKTIF
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Silahkan masukkan STATUS TRANSAKSI_PENGADAAN!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">SIMPAN</button>
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
    $('#FORM_TRANSAKSI_PENGADAAN_TAMBAH').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = $(this).serialize();

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" +
                "transaksi_pengadaan/insert", // Endpoint untuk proses input
            type: 'POST',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                        location.href =
                            "<?php echo base_url(); ?>transaksi_pengadaan";
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