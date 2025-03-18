            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_KARYAWAN_EDIT">
                                    <div class="card-header">
                                        <h4>DETAIL DATA KARYAWAN</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="row ">
                                            <div class="form-group col-5 col-md-2 col-lg-5">
                                                <table class="table table-striped table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <th>ID KARYAWAN</th>
                                                            <td><?= $get_single->ID_KARYAWAN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>NAMA KARYAWAN</th>
                                                            <td><?= $get_single->NAMA_KARYAWAN; ?></td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>JABATAN</th>
                                                            <td><?= $get_single->NAMA_JABATAN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>AREA</th>
                                                            <td><?= $get_single->NAMA_AREA; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>DEPARTEMEN</th>
                                                            <td><?= $get_single->NAMA_DEPARTEMEN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIK</th>
                                                            <td><?= $get_single->NIK; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIP</th>
                                                            <td><?= $get_single->NIP; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>ALAMAT</th>
                                                            <td><?= $get_single->ALAMAT; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>TELEPON</th>
                                                            <td><?= $get_single->TELEPON; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>EMAIL</th>
                                                            <td><?= $get_single->EMAIL; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th>TEMPAT LAHIR</th>
                                                            <td><?= $get_single->TEMPAT_LAHIR; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>TANGGAL LAHIR</th>
                                                            <td><?= $get_single->TANGGAL_LAHIR; ?></td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>JENIS KELAMIN</th>
                                                            <td><?= $get_single->JENIS_KELAMIN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>PENDIDIKAN AKHIR</th>
                                                            <td><?= $get_single->PENDIDIKAN_AKHIR; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>AGAMA</th>
                                                            <td><?= $get_single->AGAMA; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>GOLONGAN DARAH</th>
                                                            <td><?= $get_single->GOLONGAN_DARAH; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>STATUS PERKAWINAN</th>
                                                            <td><?= $get_single->STATUS_PERKAWINAN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>AKTIF MULAI TANGGAL</th>
                                                            <td><?= $this->tanggalindo->formatTanggal($get_single->AKTIF_MULAI_TANGGAL);?>
                                                        </tr>
                                                        <tr>
                                                            <th>BATAS KONTRAK KERJA</th>
                                                            <td><?= $this->tanggalindo->formatTanggal($get_single->BATAS_KONTRAK_KERJA);?>
                                                        </tr>
                                                        <tr>
                                                            <th>STATUS</th>
                                                            <td><?= $get_single->STATUS_KARYAWAN; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>


                                            </div>
                                            <div class="row">
                                                <div class="form-group col-4 col-md-2 col-lg-4">
                                                    <table class="table table-striped table-sm">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <img src="<?php echo base_url('assets/uploads/karyawan/').$get_single->FOTO; ?>"
                                                                        alt="">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a href="<?=site_url('karyawan');?>" class="btn btn-primary">Kembali</a>
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