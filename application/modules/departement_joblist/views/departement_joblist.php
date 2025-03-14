            xxx
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Data Joblist Per Departemen</h4>
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
                                                    <th>Departemen</th>
                                                    <th>Joblist</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_DEPARTEMENT_JOBLIST as $index => $d) : ?>
                                                    <tr>
                                                        <td class="text-center pt-2">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                    id="checkbox-1">
                                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $index + 1; ?></td>
                                                        <td><?php echo $d->NAMA_DEPARTEMEN; ?></td>
                                                        <td><?php echo $d->NAMA_JOBLIST; ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                <div class="dropdown-menu">
                                                                    <a href="#" class="dropdown-item has-icon view-btn" data-departement="<?php echo $d->DEPARTEMENT; ?>" data-joblist="<?php echo $d->NAMA_JOBLIST; ?>" data-area="<?php echo $d->KODE_AREA; ?>" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i> View</a>
                                                                    <a href="#" class="dropdown-item has-icon edit-btn" data-id="<?php echo $d->ID_JOBLIST; ?>" data-departement="<?php echo $d->DEPARTEMENT; ?>" data-joblist="<?php echo $d->NAMA_JOBLIST; ?>" data-area="<?php echo $d->KODE_AREA; ?>" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i> Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->ID_JOBLIST; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
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
                            <h5 class="modal-title" id="formModal">Input Data Joblist</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formJoblist">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <select class="form-control" name="id_departement" id="id_departement">
                                        <option value="" selected disabled>Pilih Departemen</option>
                                        <?php foreach ($get_departement as $key => $value) { ?>
                                            <option value="<?= $value->KODE_DEPARTEMEN ?>"><?= $value->NAMA_DEPARTEMEN ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Joblist</label>
                                    <input type="text" class="form-control" placeholder="Trouble FINA" name="nama_joblist" id="nama_joblist">
                                </div>
                                <div class="form-group">
                                    <label>Lingkup Area</label>
                                    <div class="selectgroup selectgroup-pills">
                                        <?php foreach ($get_area as $key => $value) : ?>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="kode_area[]" value="<?= $value->KODE_AREA ?>" class="selectgroup-input">
                                                <span class="selectgroup-button"><?= $value->NAMA_AREA ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
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
                            <h5 class="modal-title" id="formModal">View Data Joblist</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formViewJoblist">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <select class="form-control" name="id_departement_view" id="id_departement_view" disabled>
                                        <option value="">Pilih Departemen</option>
                                        <?php foreach ($get_departement as $key => $value) { ?>
                                            <option value="<?= $value->KODE_DEPARTEMEN ?>"><?= $value->NAMA_DEPARTEMEN ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Joblist</label>
                                    <input type="text" class="form-control" placeholder="Trouble FINA" name="nama_joblist_view" id="nama_joblist_view" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Lingkup Area</label>
                                    <div class="selectgroup selectgroup-pills">
                                        <?php foreach ($get_area as $key => $value) : ?>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="kode_area_view[]" value="<?= $value->KODE_AREA ?>" class="selectgroup-input" disabled>
                                                <span class="selectgroup-button"><?= $value->NAMA_AREA ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
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
                            <h5 class="modal-title" id="formModal">Edit Data Joblist</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formEditJoblist">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <input type="hidden" id="id_joblist_edit" class="form-control" placeholder="ID" name="id_joblist_edit">
                                    <select class="form-control" name="id_departement_edit" id="id_departement_edit">
                                        <option value="">Pilih Departemen</option>
                                        <?php foreach ($get_departement as $key => $value) { ?>
                                            <option value="<?= $value->KODE_DEPARTEMEN ?>"><?= $value->NAMA_DEPARTEMEN ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Joblist</label>
                                    <input type="text" class="form-control" placeholder="Trouble FINA" name="nama_joblist_edit" id="nama_joblist_edit">
                                </div>
                                <div class="form-group">
                                    <label>Lingkup Area</label>
                                    <div class="selectgroup selectgroup-pills">
                                        <?php foreach ($get_area as $key => $value) : ?>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="kode_area_edit[]" value="<?= $value->KODE_AREA ?>" class="selectgroup-input">
                                                <span class="selectgroup-button"><?= $value->NAMA_AREA ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
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
                            <h5 class="modal-title" id="formModal">Hapus Data Joblist</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formHapusJoblist">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" id="id_joblist_hapus" class="form-control" placeholder="ID" name="id_joblist_hapus">
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
                        const departement = $(this).data('departement');
                        const joblist = $(this).data('joblist');
                        const kode_area = $(this).data('area'); // Contoh data area: "1,2,3,4" atau "1" atau null

                        // Isi form di modal view
                        $('#id_departement_view').val(departement).change();
                        $('#nama_joblist_view').val(joblist);

                        // Format checkbox kode_area_view berdasarkan data area
                        if (kode_area) { // Pastikan kode_area tidak kosong
                            // Ubah kode_area menjadi string (jika belum string)
                            const kode_area_str = String(kode_area);
                            const checkboxValues = kode_area_str.split(',').map(Number); // Ubah string menjadi array angka

                            // Loop melalui semua checkbox
                            $('input[name="kode_area_view[]"]').each(function() {
                                const checkbox = $(this);
                                const value = parseInt(checkbox.val(), 10); // Ambil nilai checkbox sebagai number

                                // Hapus atribut disabled sementara
                                checkbox.prop('disabled', false);

                                // Centang checkbox jika nilai ada dalam array checkboxValues
                                if (checkboxValues.includes(value)) {
                                    checkbox.prop('checked', true);
                                } else {
                                    checkbox.prop('checked', false);
                                }

                                // Kembalikan atribut disabled
                                checkbox.prop('disabled', true);
                            });
                        } else {
                            // Jika kode_area kosong, pastikan semua checkbox tidak tercentang
                            $('input[name="kode_area_view[]"]').each(function() {
                                const checkbox = $(this);

                                // Hapus atribut disabled sementara
                                checkbox.prop('disabled', false);

                                // Uncheck checkbox
                                checkbox.prop('checked', false);

                                // Kembalikan atribut disabled
                                checkbox.prop('disabled', true);
                            });
                        }
                    });

                    $('.edit-btn').on('click', function() {
                        const id = $(this).data('id');
                        const departement = $(this).data('departement');
                        const joblist = $(this).data('joblist');
                        const kode_area = $(this).data('area'); // Ambil data area

                        // Isi form di modal edit
                        $('#id_joblist_edit').val(id);
                        $('#id_departement_edit').val(departement).change();
                        $('#nama_joblist_edit').val(joblist);

                        // Format checkbox kode_area_edit berdasarkan data area
                        if (kode_area) { // Pastikan kode_area tidak kosong
                            // Ubah kode_area menjadi string (jika belum string)
                            const kode_area_str = String(kode_area);
                            const checkboxValues = kode_area_str.split(',').map(Number); // Ubah string menjadi array angka

                            // Loop melalui semua checkbox
                            $('input[name="kode_area_edit[]"]').each(function() {
                                const checkbox = $(this);
                                const value = parseInt(checkbox.val(), 10); // Ambil nilai checkbox sebagai number

                                // Centang checkbox jika nilai ada dalam array checkboxValues
                                if (checkboxValues.includes(value)) {
                                    checkbox.prop('checked', true);
                                } else {
                                    checkbox.prop('checked', false);
                                }
                            });
                        } else {
                            // Jika kode_area kosong, pastikan semua checkbox tidak tercentang
                            $('input[name="kode_area_edit[]"]').prop('checked', false);
                        }

                        // Tampilkan modal edit
                        $('#editModal').modal('show');
                    });

                    $('.hapus-btn').on('click', function() {
                        const id = $(this).data('id');

                        // Isi form di modal edit
                        $('#id_joblist_hapus').val(id);
                    });

                    $('#formJoblist').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "departement_joblist/insert", // Endpoint untuk proses input
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

                    $('#formEditJoblist').on('submit', function(e) {
                        e.preventDefault();
                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "departement_joblist/update", // Endpoint untuk proses input
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
                                    alert('Gagal menyimpan data: ' + response.error);
                                }
                            },
                            error: function() {
                                alert('Gagal melakukan proses.');
                            }
                        });
                    });

                    $('#formHapusJoblist').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "departement_joblist/hapus", // Endpoint untuk proses input
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