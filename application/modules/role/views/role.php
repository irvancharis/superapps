            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DATA ROLE</h4>
                                    <a href="<?php echo base_url('role/tambah_role') ?>" class="btn btn-primary"><i
                                            class="fas fa-plus"></i> Tambah ROLE</a>
                                </div>


                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-2">
                                            <thead>
                                                <tr>
                                                    <th>NAMA ROLE</th>
                                                    <th>KETERANGAN</th>
                                                    <th class="text-center col-1">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_ROLE as $index => $d) : ?>
                                                <tr>
                                                    <td><?php echo $d->NAMA_ROLE; ?></td>
                                                    <td><?php echo $d->KETERANGAN; ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown"
                                                                class="btn btn-primary dropdown-toggle">Detail</a>
                                                            <div class="dropdown-menu">
                                                                <a href="<?= site_url('role/edit/' . $d->KODE_ROLE); ?>"
                                                                    class="dropdown-item has-icon edit-btn"><i
                                                                        class="far fa-edit"></i> setting role</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="<?= site_url('role/hapus/' . $d->KODE_ROLE); ?>"
                                                                    class="dropdown-item has-icon text-danger hapus-btn"
                                                                    onclick="return confirm('Yakin akan menghapus data?')"><i
                                                                        class="far fa-trash-alt"></i>
                                                                    Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                

                            </div>
                        </div>
                    </div>
            </div>
            </section>
            </div>

            <?php $this->load->view('layout/footer'); ?>

            </body>

            <script>
$(document).ready(function() {

    $('#tabel').dataTable({
        paging: false,
        searching: false
    });

    $('#FORM').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = $(this).serialize();

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" +
                "role/simpan_pengaturan", // Endpoint untuk proses input
            type: 'POST',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Simpan Data Berhasil!', 'success').then(
                        function() {
                            location.reload();
                        });
                } else {
                    alert('Gagal menghapus data: ' + response.error);
                }
            },
            error: function() {
                alert('Gagal melakukan proses.');
            }
        });
    });
});
            </script>

            </html>