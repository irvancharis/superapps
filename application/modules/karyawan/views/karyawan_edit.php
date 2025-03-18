            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_KARYAWAN_EDIT">
                                    <div class="card-header">
                                        <h4>EDIT DATA KARYAWAN</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-4">
                                                <label>DEPARTEMEN</label>
                                                <select required name="ID_DEPARTEMENT" id="ID_DEPARTEMENT" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih Departement --</option>
                                                    <?php foreach ($get_departemen as $row) : ?>
                                                        <option <?php if ($row->KODE_DEPARTEMEN == $get_single->ID_DEPARTEMENT) echo "selected"; ?> value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan DEPARTEMENT!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-4">
                                                <label>JABATAN</label>
                                                <select required name="ID_JABATAN" id="ID_JABATAN" class="form-control">
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
                                                <input required type="number" oninput="this.value = this.value.replace(/\D+/g, '')" value="<?= $get_single->NIP; ?>" name="NIP" id="NIP" class="form-control">
                                                <div class="invalid-feedback">
                                                Masukkan NIP?
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NAMA KARYAWAN</label>
                                                <input required type="text" value="<?= $get_single->NAMA_KARYAWAN; ?>" class="form-control" id="NAMA_KARYAWAN" name="NAMA_KARYAWAN">
                                                <div class="invalid-feedback">
                                                    Masukkan NAMA KARYAWAN  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>ALAMAT</label>
                                                <input required type="text" value="<?= $get_single->ALAMAT; ?>" class="form-control" id="ALAMAT" name="ALAMAT">
                                                <div class="invalid-feedback">
                                                    Masukkan ALAMAT  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TELEPON</label>
                                                <input  required type="number" oninput="this.value = this.value.replace(/\D+/g, '')" value="<?= $get_single->TELEPON; ?>" class="form-control" id="TELEPON" name="TELEPON">
                                                <div class="invalid-feedback">
                                                    Masukkan TELEPON  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>EMAIL</label>
                                                <input required type="text" value="<?= $get_single->EMAIL; ?>" class="form-control" id="EMAIL" name="EMAIL">
                                                <div class="invalid-feedback">
                                                    Masukkan EMAIL  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>PENDIDIKAN AKHIR</label>
                                                <select required name="PENDIDIKAN_AKHIR" id="PENDIDIKAN_AKHIR" class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Pendidikan Akhir --</option>
                                                    <option <?php if ('TIDAK SEKOLAH' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="TIDAK SEKOLAH"   >TIDAK SEKOLAH</option>
                                                    <option <?php if ('SD / MI / PAKET A' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="SD"   >SD / MI / PAKET A</option>
                                                    <option <?php if ('SMP / MTS / PAKET B' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="SMP"   >SMP / MTS / PAKET B</option>                                                   
                                                    <option <?php if ('SMK / SMA / PAKET C' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="SMK / SMA"   >SMK / SMA / PAKET C </option>
                                                    <option <?php if ('D1' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="D1"   >D1</option>
                                                    <option <?php if ('D3' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="D3"   >D3</option>
                                                    <option <?php if ('D4' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="D4"   >D4</option>
                                                    <option <?php if ('S1' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="S1"  >S1</option>
                                                    <option <?php if ('S2' == $get_single->PENDIDIKAN_AKHIR) echo "selected"; ?> value="S2"   >S2</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Masukkan PENDIDIKAN AKHIR  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>NIK</label>
                                                <input required readonly type="number" oninput="this.value = this.value.replace(/\D+/g, '')" value="<?= $get_single->NIK; ?>" class="form-control" id="NIK" name="NIK">
                                                <div class="invalid-feedback">
                                                    Masukkan NIK  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TEMPAT LAHIR</label>
                                                <input required type="text" value="<?= $get_single->TEMPAT_LAHIR; ?>" class="form-control" id="TEMPAT_LAHIR" name="TEMPAT_LAHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan TEMPAT LAHIR  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>TANGGAL LAHIR</label>
                                                <input required type="DATE" value="<?= $get_single->TANGGAL_LAHIR; ?>" class="form-control" id="TANGGAL_LAHIR" name="TANGGAL_LAHIR">
                                                <div class="invalid-feedback">
                                                    Masukkan TANGGAL LAHIR  !
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-3">
                                                <label>JENIS KELAMIN</label>
                                                <select required name="JENIS_KELAMIN" id="JENIS_KELAMIN" class="form-control">
                                                    <option <?php if ('LAKI-LAKI' == $get_single->JENIS_KELAMIN) echo "selected"; ?> value="LAKI-LAKI" class="text-center"  >LAKI-LAKI</option>
                                                    <option <?php if ('PEREMPUAN' == $get_single->JENIS_KELAMIN) echo "selected"; ?> value="PEREMPUAN" class="text-center"  >PEREMPUAN</option>                                                   
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan JENIS KELAMIN!
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-3">
                                                <label>AGAMA</label>
                                                <select required name="AGAMA" id="AGAMA" class="form-control">
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

                                            <div class="form-group col-12 col-md-6 col-lg-3">
                                                <label>GOLONGAN DARAH</label>
                                                <select required name="GOLONGAN_DARAH" id="GOLONGAN_DARAH" class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Kategori --</option>
                                                    <option <?php if ('O' == $get_single->GOLONGAN_DARAH) echo "selected"; ?> value="O" class="text-center"  >O</option>
                                                    <option <?php if ('A' == $get_single->GOLONGAN_DARAH) echo "selected"; ?> value="A" class="text-center"  >A</option>
                                                    <option <?php if ('B' == $get_single->GOLONGAN_DARAH) echo "selected"; ?> value="B" class="text-center"  >B</option>                                                   
                                                    <option <?php if ('AB' == $get_single->GOLONGAN_DARAH) echo "selected"; ?> value="AB" class="text-center"  >AB</option>
                                                    <option <?php if ('TIDAK TAHU' == $get_single->GOLONGAN_DARAH) echo "selected"; ?> value="TIDAK TAHU" class="text-center"  >TIDAK TAHU</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AGAMA!
                                                </div>
                                            </div>

                                            <div class="form-group col-12 col-md-6 col-lg-3">
                                                <label>STATUS KAWIN</label>
                                                <select required name="STATUS_PERKAWINAN" id="STATUS_PERKAWINAN" class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Kategori --</option>
                                                    <option <?php if ('BELUM MENIKAH' == $get_single->STATUS_PERKAWINAN) echo "selected"; ?> value="BELUM MENIKAH" class="text-center"  >BELUM MENIKAH</option>
                                                    <option <?php if ('SUDAH MENIKAH' == $get_single->STATUS_PERKAWINAN) echo "selected"; ?> value="SUDAH MENIKAH" class="text-center"  >SUDAH MENIKAH</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AGAMA!
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AKTIF MULAI TANGGAL</label>
                                                <input required type="DATE" value="<?= $get_single->AKTIF_MULAI_TANGGAL; ?>" class="form-control" id="AKTIF_MULAI_TANGGAL" name="AKTIF_MULAI_TANGGAL">
                                                <div class="invalid-feedback">
                                                    Masukkan AKTIF MULAI TANGGAL  !
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>BATAS KONTRAK KERJA</label>
                                                <input required type="DATE" value="<?= $get_single->BATAS_KONTRAK_KERJA; ?>" class="form-control" id="BATAS_KONTRAK_KERJA" name="BATAS_KONTRAK_KERJA">
                                                <div class="invalid-feedback">
                                                    Masukkan BATAS KONTRAK KERJA  !
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>STATUS KARYAWAN</label>
                                                <select required name="STATUS" id="STATUS" class="form-control">
                                                    <option value="1" class="text-center" >AKTIF</option>
                                                    <option value="0" class="text-center" >NON-AKTIF</option>                                                   
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan STATUS KARYAWAN!
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
                    $('#FORM_KARYAWAN_EDIT').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "karyawan/update", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Update Data Berhasil!', 'success').then(function() {
                                        location.href = "<?php echo base_url(); ?>karyawan";
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