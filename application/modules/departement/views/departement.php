            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Data Departement</h4>
                                    <div class="card-header-action">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus"></i> Tambah Data</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm" id="table-2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-4">Nama Departemen</th>
                                                    <th>Keterangan</th>
                                                    <th class="text-center col-1">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_DEPARTEMENT as $index => $d) : ?>
                                                    <tr>
                                                        <td><?php echo $d->NAMA_DEPARTEMEN; ?></td>
                                                        <td><?php echo $d->KETERANGAN; ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                <div class="dropdown-menu">
                                                                    <a href="#" class="dropdown-item has-icon view-btn" data-nama="<?php echo $d->NAMA_DEPARTEMEN; ?>" data-ket="<?php echo $d->KETERANGAN; ?>" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i> View</a>
                                                                    <a href="#" class="dropdown-item has-icon edit-btn" data-id="<?php echo $d->KODE_DEPARTEMEN; ?>" data-nama="<?php echo $d->NAMA_DEPARTEMEN; ?>" data-ket="<?php echo $d->KETERANGAN; ?>" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i> Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->KODE_DEPARTEMEN; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
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
                <div class="settingSidebar">
                    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                    </a>
                    <div class="settingSidebar-body ps-container ps-theme-default">
                        <div class=" fade show active">
                            <div class="setting-panel-header">Setting Panel
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Select Layout</h6>
                                <div class="selectgroup layout-color w-50">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                        <span class="selectgroup-button">Light</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                        <span class="selectgroup-button">Dark</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                <div class="selectgroup selectgroup-pills sidebar-color">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Color Theme</h6>
                                <div class="theme-setting-options">
                                    <ul class="choose-theme list-unstyled mb-0">
                                        <li title="white" class="active">
                                            <div class="white"></div>
                                        </li>
                                        <li title="cyan">
                                            <div class="cyan"></div>
                                        </li>
                                        <li title="black">
                                            <div class="black"></div>
                                        </li>
                                        <li title="purple">
                                            <div class="purple"></div>
                                        </li>
                                        <li title="orange">
                                            <div class="orange"></div>
                                        </li>
                                        <li title="green">
                                            <div class="green"></div>
                                        </li>
                                        <li title="red">
                                            <div class="red"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="mini_sidebar_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Mini Sidebar</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="sticky_header_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Sticky Header</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                    <i class="fas fa-undo"></i> Restore Default
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            </div>

            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Input Data Departemen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formDepartemen">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Departemen</label>
                                    <input type="text" class="form-control" placeholder="Purchasing" name="nama_departement">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" placeholder="Keterangan" name="keterangan">
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary" id="btnSimpanTambah">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal View -->
            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">View Data Departemen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formEditDepartemen">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Departemen</label>
                                    <input type="text" id="nama_departement_view" class="form-control" placeholder="Purchasing" name="nama_departement_view" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" id="keterangan" class="form-control" placeholder="Keterangan" name="keterangan_view" disabled>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Edit Data Departemen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formEdit">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Departemen</label>
                                    <input type="hidden" id="id_departement_edit" class="form-control" placeholder="ID" name="id_departement_edit">
                                    <input type="text" id="nama_departement_edit" class="form-control" placeholder="Purchasing" name="nama_departement_edit">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" id="keterangan_edit" class="form-control" placeholder="Keterangan" name="keterangan_edit">
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary" id="btnEdit">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus -->
            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Hapus Data Departemen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formHapusDepartemen">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" id="id_departement_hapus" class="form-control" placeholder="ID" name="id_departement_hapus">
                                    <p class="text-center">Apakah anda yakin ingin menghapus data ini?</p>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary" id="btnSimpan">Hapus</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php $this->load->view('layout/footer'); ?>

            <script>
                $(document).ready(function() {
                    $('.view-btn').on('click', function() {
                        const nama = $(this).data('nama');
                        const ket = $(this).data('ket');

                        // Isi form di modal edit
                        $('#nama_departement_view').val(nama);
                        $('#keterangan_view').val(ket);
                    });

                    $('.edit-btn').on('click', function() {
                        const id = $(this).data('id');
                        const nama = $(this).data('nama');
                        const ket = $(this).data('ket');

                        // Isi form di modal edit
                        $('#id_departement_edit').val(id);
                        $('#nama_departement_edit').val(nama);
                        $('#keterangan_edit').val(ket);
                    });

                    $('.hapus-btn').on('click', function() {
                        const id = $(this).data('id');

                        // Isi form di modal edit
                        $('#id_departement_hapus').val(id);
                    });

                    $('#formDepartemen').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "departement/insert", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        $('#tambahModal').modal('hide');
                                        location.reload();
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

                    $('#formEdit').on('submit', function(e) {
                        e.preventDefault();
                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "departement/update", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                                        $('#editModal').modal('hide');
                                        location.reload();
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

                    $('#formHapusDepartemen').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "departement/hapus", // Endpoint untuk proses input
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
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>