            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Data Teknisi</h4>
                                    <div class="card-header-action">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus"></i> Tambah Data</button>
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
                                                    <th>Nama Teknisi</th>
                                                    <th>Departemen</th>
                                                    <th>Status</th>
                                                    <th>ID Karyawan</th>
                                                    <th>Deskripsi Teknisi</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_TECHNICIAN as $index => $d) : ?>
                                                    <tr>
                                                        <td class="text-center pt-2">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                    id="checkbox-1">
                                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $index + 1; ?></td>
                                                        <td><?php echo $d->NAME_TECHNICIAN; ?></td>
                                                        <td><?php echo $d->NAMA_DEPARTEMEN; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($d->STATUS == 1) {
                                                                echo '<span class="badge badge-success">Aktif</span>';
                                                            } else {
                                                                echo '<span class="badge badge-danger">Tidak Aktif</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $d->IDKARYAWAN; ?></td>
                                                        <td><?php echo $d->DESCRIPTION_TECHNICIAN; ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                <div class="dropdown-menu">
                                                                    <a href="#" class="dropdown-item has-icon view-btn" data-nama="<?php echo $d->NAME_TECHNICIAN; ?>" data-departement="<?php echo $d->DEPARTEMENT; ?>" data-status="<?php echo $d->STATUS; ?>" data-idkaryawan="<?php echo $d->IDKARYAWAN; ?>" data-description="<?php echo $d->DESCRIPTION_TECHNICIAN; ?>" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i> View</a>
                                                                    <a href="#" class="dropdown-item has-icon edit-btn" data-id="<?php echo $d->IDTECH; ?>" data-nama="<?php echo $d->NAME_TECHNICIAN; ?>" data-departement="<?php echo $d->DEPARTEMENT; ?>" data-status="<?php echo $d->STATUS; ?>" data-idkaryawan="<?php echo $d->IDKARYAWAN; ?>" data-description="<?php echo $d->DESCRIPTION_TECHNICIAN; ?>" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i> Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTECH; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
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
                            <h5 class="modal-title" id="formModal">Input Data Teknisi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formTechnician">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Karyawan</label>
                                    <select class="form-control" name="id_karyawan" id="id_karyawan">
                                        <option value="" class="text-center" selected disabled>-- Pilih Karyawan --</option>
                                        <?php foreach ($get_karyawan as $row) : ?>
                                            <option value="<?= $row->ID_KARYAWAN; ?>"><?= $row->NAMA_KARYAWAN; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Teknisi</label>
                                    <input type="text" class="form-control" placeholder="Nama Teknisi" name="nama_technician" id="nama_technician" readonly>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Departemen</label>
                                        <select class="form-control" name="id_departement" id="id_departement" readonly>
                                            <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                            <?php foreach ($get_departement as $row) : ?>
                                                <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status" id="status" readonly>
                                            <option value="" class="text-center" selected disabled>-- Pilih Status --</option>
                                            <option value="PASIF">PASIF</option>
                                            <option value="AKTIF">AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Teknisi</label>
                                    <textarea class="form-control" placeholder="Deskripsi" name="description_technician"></textarea>
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
                            <h5 class="modal-title" id="formModal">View Data Teknisi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formViewTechnician">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Teknisi</label>
                                    <input type="text" class="form-control" placeholder="Nama Teknisi" name="nama_technician" id="nama_technician_view" disabled>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Departemen</label>
                                        <select class="form-control" name="id_departement" id="id_departement_view" disabled>
                                            <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                            <?php foreach ($get_departement as $row) : ?>
                                                <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status" id="status_view" disabled>
                                            <option value="" class="text-center" selected disabled>-- Pilih Status --</option>
                                            <option value="0">PASIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ID Karyawan</label>
                                    <select class="form-control" name="id_karyawan" id="id_karyawan_view" disabled>
                                        <option value="" class="text-center" selected disabled>-- Pilih ID Karyawan --</option>
                                        <?php foreach ($get_karyawan as $row) : ?>
                                            <option value="<?= $row->ID_KARYAWAN; ?>"><?= $row->ID_KARYAWAN; ?> - <?= $row->NAMA_KARYAWAN; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Teknisi</label>
                                    <textarea class="form-control" placeholder="Deskripsi" name="description_technician" id="description_technician_view" disabled></textarea>
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
                            <h5 class="modal-title" id="formModal">Edit Data Teknisi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formEditTechnician">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Teknisi</label>
                                    <input type="hidden" id="id_technician_edit" class="form-control" placeholder="ID" name="id_technician_edit">
                                    <input type="text" class="form-control" placeholder="Nama Teknisi" name="nama_technician_edit" id="nama_technician_edit">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Departemen</label>
                                        <select class="form-control" name="id_departement_edit" id="id_departement_edit">
                                            <option value="" class="text-center" selected disabled>-- Pilih Departemen --</option>
                                            <?php foreach ($get_departement as $row) : ?>
                                                <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status_edit" id="status_edit">
                                            <option value="" class="text-center" selected disabled>-- Pilih Status --</option>
                                            <option value="0">PASIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ID Karyawan</label>
                                    <select class="form-control" name="id_karyawan_edit" id="id_karyawan_edit">
                                        <option value="" class="text-center" selected disabled>-- Pilih ID Karyawan --</option>
                                        <?php foreach ($get_karyawan as $row) : ?>
                                            <option value="<?= $row->ID_KARYAWAN; ?>"><?= $row->ID_KARYAWAN; ?> - <?= $row->NAMA_KARYAWAN; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Teknisi</label>
                                    <textarea class="form-control" placeholder="Deskripsi" name="description_technician_edit" id="description_technician_edit"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
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
                            <h5 class="modal-title" id="formModal">Hapus Data Teknisi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formHapusTechnician">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" id="id_technician_hapus" class="form-control" placeholder="ID" name="id_technician_hapus">
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
                        const departement = $(this).data('departement');
                        const karyawan = $(this).data('idkaryawan');
                        const status = $(this).data('status');
                        const description = $(this).data('description');

                        // Isi form di modal edit
                        $('#nama_technician_view').val(nama);
                        $('#id_departement_view').val(departement).change();
                        $('#id_karyawan_view').val(karyawan).change();
                        $('#status_view').val(status).change();
                        $('#description_technician_view').val(description);
                    });

                    $('.edit-btn').on('click', function() {
                        const id = $(this).data('id');
                        const nama = $(this).data('nama');
                        const departement = $(this).data('departement');
                        const karyawan = $(this).data('idkaryawan');
                        const status = $(this).data('status');
                        const description = $(this).data('description');

                        // Isi form di modal edit
                        $('#id_technician_edit').val(id);
                        $('#nama_technician_edit').val(nama);
                        $('#id_departement_edit').val(departement).change();
                        $('#id_karyawan_edit').val(karyawan).change();
                        $('#status_edit').val(status).change();
                        $('#description_technician_edit').val(description);
                    });

                    $('.hapus-btn').on('click', function() {
                        const id = $(this).data('id');

                        // Isi form di modal edit
                        $('#id_technician_hapus').val(id);
                    });

                    $('#formTechnician').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "technician/insert", // Endpoint untuk proses input
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

                    $('#formEditTechnician').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "technician/update", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Edit Data Berhasil!', 'success').then(function() {
                                        $('#editModal').modal('hide');
                                        location.reload();
                                    });
                                } else {
                                    alert('Gagal mengedit data: ' + response.error);
                                }
                            },
                            error: function() {
                                alert('Gagal melakukan proses.');
                            }
                        });
                    });

                    $('#formHapusTechnician').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "technician/hapus", // Endpoint untuk proses input
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

                    // Set Nama, Departemen, Status Karyawan Teknisi By id_karyawan
                    $('#id_karyawan').on('change', function() {
                        const id_karyawan = $(this).val();
                        $.ajax({
                            url: "<?php echo base_url(); ?>technician/get_karyawan_by_id/" + id_karyawan,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);

                                $('#nama_technician').val(response.NAMA_KARYAWAN);
                                $('#id_departement').val(response.ID_DEPARTEMENT).change();
                                $('#status').val(response.STATUS_KARYAWAN).change();
                            },
                            error: function() {
                                alert('Gagal mengambil data.');
                            }
                        });
                    });
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>