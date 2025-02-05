            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_OPNAME_EDIT">
                                    <div class="card-header">
                                        <h4>DETAIL DATA TRANSAKSI_PENGADAAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select readonly required name="ID_MAPING_AREA" id="ID_MAPING_AREA" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Area --</option>
                                                    <?php foreach ($get_area as $row) : ?>
                                                        <option <?php if ($row->KODE_AREA == $get_single->ID_MAPING_AREA) echo "selected"; ?> value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AREA!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DEPARTEMEN</label>
                                                <select readonly required name="ID_DEPARTEMENT" id="ID_DEPARTEMENT" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Departement --</option>
                                                    <?php foreach ($get_departemen as $row) : ?>
                                                        <option <?php if ($row->KODE_DEPARTEMEN == $get_single->ID_DEPARTEMENT) echo "selected"; ?> value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan DEPARTEMENT!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>JABATAN</label>
                                                <select readonly required name="ID_JABATAN" id="ID_JABATAN" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Jabatan --</option>
                                                    <?php foreach ($get_jabatan as $row) : ?>
                                                        <option <?php if ($row->KODE_JABATAN == $get_single->ID_JABATAN) echo "selected"; ?> value="<?= $row->KODE_JABATAN; ?>"><?= $row->NAMA_JABATAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan JABATAN!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NIP</label>
                                                <input readonly required type="text" value="<?= $get_single->NIP; ?>" name="NIP" id="NIP" class="form-control">
                                                <div class="invalid-feedback">
                                                Masukkan NIP?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA TRANSAKSI_PENGADAAN</label>
                                                <input readonly required type="text" value="<?= $get_single->NAMA_TRANSAKSI_PENGADAAN; ?>" class="form-control" id="NAMA_TRANSAKSI_PENGADAAN" name="NAMA_TRANSAKSI_PENGADAAN">
                                                <div class="invalid-feedback">
                                                    Masukkan NAMA TRANSAKSI_PENGADAAN  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>ALAMAT</label>
                                                <input readonly required type="text" value="<?= $get_single->ALAMAT; ?>" class="form-control" id="ALAMAT" name="ALAMAT">
                                                <div class="invalid-feedback">
                                                    Masukkan ALAMAT  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TELEPON</label>
                                                <input readonly required type="text" value="<?= $get_single->TELEPON; ?>" class="form-control" id="TELEPON" name="TELEPON">
                                                <div class="invalid-feedback">
                                                    Masukkan TELEPON  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>EMAIL</label>
                                                <input readonly required type="text" value="<?= $get_single->EMAIL; ?>" class="form-control" id="EMAIL" name="EMAIL">
                                                <div class="invalid-feedback">
                                                    Masukkan EMAIL  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>PENDIDIKAN AKHIR</label>
                                                <input readonly required type="text" value="<?= $get_single->PENDIDIKAN_AKHIR; ?>" class="form-control" id="PENDIDIKAN_AKHIR" name="PENDIDIKAN_AKHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan PENDIDIKAN AKHIR  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NIK</label>
                                                <input readonly required readonly type="text" value="<?= $get_single->NIK; ?>" class="form-control" id="NIK" name="NIK">
                                                <div class="invalid-feedback">
                                                    Masukkan NIK  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TEMPAT LAHIR</label>
                                                <input readonly required type="text" value="<?= $get_single->TEMPAT_LAHIR; ?>" class="form-control" id="TEMPAT_LAHIR" name="TEMPAT_LAHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan TEMPAT LAHIR  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TANGGAL LAHIR</label>
                                                <input readonly required type="DATE" value="<?= $get_single->TANGGAL_LAHIR; ?>" class="form-control" id="TANGGAL_LAHIR" name="TANGGAL_LAHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan TANGGAL LAHIR  !
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>JENIS KELAMIN</label>
                                                <select readonly required name="JENIS_KELAMIN" id="JENIS_KELAMIN" class="form-control">
                                                    <option <?php if ('LAKI-LAKI' == $get_single->JENIS_KELAMIN) echo "selected"; ?> value="LAKI-LAKI" class="text-center"  >LAKI-LAKI</option>
                                                    <option <?php if ('PEREMPUAN' == $get_single->JENIS_KELAMIN) echo "selected"; ?> value="PEREMPUAN" class="text-center"  >PEREMPUAN</option>                                                   
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan JENIS KELAMIN!
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AGAMA</label>
                                                <select readonly required name="AGAMA" id="AGAMA" class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Kategori --</option>
                                                    <option <?php if ('ISLAM' == $get_single->AGAMA) echo "selected"; ?> value="ISLAM" class="text-center"  >ISLAM</option>
                                                    <option <?php if ('KRISTEN' == $get_single->AGAMA) echo "selected"; ?> value="KRISTEN" class="text-center"  >KRISTEN</option>
                                                    <option <?php if ('PROTESTAN' == $get_single->AGAMA) echo "selected"; ?> value="PROTESTAN" class="text-center"  >PROTESTAN</option>                                                   
                                                    <option <?php if ('HINDU' == $get_single->AGAMA) echo "selected"; ?> value="HINDU" class="text-center"  >HINDU</option>
                                                    <option <?php if ('BUDHA' == $get_single->AGAMA) echo "selected"; ?> value="BUDHA" class="text-center"  >BUDHA</option>
                                                    <option <?php if ('KONGHUCU' == $get_single->AGAMA) echo "selected"; ?> value="KONGHUCU" class="text-center"  >KONGHUCU</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AGAMA!
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AKTIF MULAI TANGGAL</label>
                                                <input readonly required type="DATE" value="<?= $get_single->AKTIF_MULAI_TANGGAL; ?>" class="form-control" id="AKTIF_MULAI_TANGGAL" name="AKTIF_MULAI_TANGGAL">
                                                <div class="invalid-feedback">
                                                    Masukkan AKTIF MULAI TANGGAL  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>BATAS KONTRAK KERJA</label>
                                                <input  readonly required type="DATE" value="<?= $get_single->BATAS_KONTRAK_KERJA; ?>" class="form-control" id="BATAS_KONTRAK_KERJA" name="BATAS_KONTRAK_KERJA">
                                                <div class="invalid-feedback">
                                                    Masukkan BATAS KONTRAK KERJA  !
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>STATUS TRANSAKSI_PENGADAAN</label>
                                                <select readonly required name="STATUS_TRANSAKSI_PENGADAAN" id="STATUS_TRANSAKSI_PENGADAAN" class="form-control">
                                                    <option value="AKTIF" class="text-center" >AKTIF</option>
                                                    <option value="NONAKTIF" class="text-center" >NON-AKTIF</option>                                                   
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan STATUS TRANSAKSI_PENGADAAN!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                    <a href="<?=site_url('transaksi_pengadaan');?>" class="btn btn-primary">Kembali</a>
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
                    $('#FORM_TRANSAKSI_OPNAME_EDIT').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "transaksi_pengadaan/update", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Update Data Berhasil!', 'success').then(function() {
                                        location.href = "<?php echo base_url(); ?>transaksi_pengadaan";
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