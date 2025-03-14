            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DATA PRODUK KATEGORI</h4>
                                    <div class="card-header-action">
                                        <a href="<?php echo base_url('produk_kategori/tambah') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center pt-3">
                                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                class="custom-control-input" id="checkbox-all">
                                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </th>
                                                    <th>#</th>
                                                    <th>KODE KATEGORI</th>
                                                    <th>NAMA KATEGORI</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_PRODUK_KATEGORI as $index => $d) : ?>
                                                    <tr>
                                                        <td class="text-center pt-2">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                    id="checkbox-1">
                                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $index + 1; ?></td>
                                                        <td><?php echo $d->KODE_PRODUK_KATEGORI; ?></td>
                                                        <td><?php echo $d->NAMA_PRODUK_KATEGORI; ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                <div class="dropdown-menu">
                                                                    <a href="#" class="dropdown-kategori has-icon view-btn"><i class="fas fa-eye"></i> View</a>
                                                                    <a href="#" class="dropdown-kategori has-icon edit-btn"><i class="far fa-edit"></i> Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a href="#" class="dropdown-kategori has-icon text-danger hapus-btn" onclick="return confirm('Yakin akan menghapus data?')"><i class="far fa-trash-alt"></i>
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
                </section>                

            <?php $this->load->view('layout/footer'); ?>

            </body>

            <script>
                $(document).ready(function() {

                    $('#formHapusproduk').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "produk_kategori/hapus", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Hapus Data Berhasil!', 'success').then(function() {
                                        $('#hapusModal').modal('hide');
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