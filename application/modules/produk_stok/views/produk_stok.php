            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DATA STOK PRODUK</h4>
                                </div>


                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>AREA</label>
                                            <select required name="KODE_AREA" id="KODE_AREA" class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Area --
                                                </option>
                                                <?php foreach ($get_area as $row) : ?>
                                                <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan area!
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>RUANGAN</label>
                                            <select required name="KODE_RUANGAN" id="KODE_RUANGAN" class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Ruangan
                                                    --</option>
                                                <?php foreach ($get_ruangan as $row) : ?>
                                                <option value="<?= $row->KODE_RUANGAN; ?>"><?= $row->NAMA_RUANGAN; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>LOKASI</label>
                                            <select required name="KODE_LOKASI" id="KODE_LOKASI" class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Lokasi
                                                    --</option>
                                                <?php foreach ($get_lokasi as $row) : ?>
                                                <option value="<?= $row->KODE_LOKASI; ?>"><?= $row->NAMA_RUANGAN; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6 col-lg-6">
                                            <label>DEPARTEMEN</label>
                                            <select required name="KODE_DEPARTEMEN" id="KODE_DEPARTEMEN"
                                                class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih
                                                    Departemen --</option>
                                                <?php foreach ($get_departemen as $row) : ?>
                                                <option value="<?= $row->KODE_DEPARTEMEN; ?>">
                                                    <?= $row->NAMA_DEPARTEMEN; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-center">
                                        <label class="btn btn-primary"> <i class="fa fa-search"></i> SHOW PRODUK</label>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-2">
                                            <thead>
                                                <tr>
                                                    <th>QR</th>
                                                    <th>KODE</th>
                                                    <th>NAMA PRODUK</th>
                                                    <th>KATEGORI</th>
                                                    <th>DEPARTEMEN</th>
                                                    <th>MAPING</th>
                                                    <th>STOK</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($M_PRODUK_STOK as $index => $d) : ?>
                                                <tr>
                                                    <td>
                                                        <center><img width="100px"
                                                                src="<?php echo base_url('produk_stok/qr/').$d->UUID_STOK; ?>"
                                                                alt=""></center>
                                                    </td>
                                                    <td><?php echo $d->KODE_ITEM; ?></td>
                                                    <td><?php echo $d->NAMA_PRODUK; ?></td>
                                                    <td><?php echo $d->NAMA_PRODUK_KATEGORI; ?></td>
                                                    <td><?php echo $d->NAMA_DEPARTEMEN; ?></td>
                                                    <td><?php echo 'AREA - '.$d->NAMA_AREA; ?><br><?php echo 'RUANGAN - '.$d->NAMA_RUANGAN; ?><br><?php echo 'LOKASI - '.$d->NAMA_LOKASI; ?>
                                                    </td>
                                                    <td><?php echo $d->JUMLAH_STOK; ?></td>
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
                                        <input required type="radio" name="value" value="1"
                                            class="selectgroup-input-radio select-layout" checked>
                                        <span class="selectgroup-button">Light</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input required type="radio" name="value" value="2"
                                            class="selectgroup-input-radio select-layout">
                                        <span class="selectgroup-button">Dark</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                <div class="selectgroup selectgroup-pills sidebar-color">
                                    <label class="selectgroup-item">
                                        <input required type="radio" name="icon-input" value="1"
                                            class="selectgroup-input select-sidebar">
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input required type="radio" name="icon-input" value="2"
                                            class="selectgroup-input select-sidebar" checked>
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
                                        <input required type="checkbox" name="custom-switch-checkbox"
                                            class="custom-switch-input" id="mini_sidebar_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Mini Sidebar</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input required type="checkbox" name="custom-switch-checkbox"
                                            class="custom-switch-input" id="sticky_header_setting">
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
            <footer class="main-footer">
                <div class="footer-left">
                    <a href="templateshub.net">SAGROUP.ID</a></a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
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
                                    <label>Nama Teknisi</label>
                                    <input required type="text" class="form-control" placeholder="Nama Teknisi"
                                        name="nama_technician">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Departemen</label>
                                        <select class="form-control" name="id_departement">
                                            <option value="" class="text-center" selected disabled>-- Pilih Departemen
                                                --</option>
                                            <?php foreach ($get_departement as $row) : ?>
                                            <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="" class="text-center" selected disabled>-- Pilih Status --
                                            </option>
                                            <option value="0">PASIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ID Karyawan</label>
                                    <select class="form-control" name="id_karyawan">
                                        <option value="" class="text-center" selected disabled>-- Pilih ID Karyawan --
                                        </option>
                                        <?php foreach ($get_karyawan as $row) : ?>
                                        <option value="<?= $row->ID_KARYAWAN; ?>"><?= $row->ID_KARYAWAN; ?> -
                                            <?= $row->NAMA_KARYAWAN; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Teknisi</label>
                                    <textarea class="form-control" placeholder="Deskripsi"
                                        name="description_technician"></textarea>
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
                                    <input required type="text" class="form-control" placeholder="Nama Teknisi"
                                        name="nama_technician" id="nama_technician_view" disabled>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Departemen</label>
                                        <select class="form-control" name="id_departement" id="id_departement_view"
                                            disabled>
                                            <option value="" class="text-center" selected disabled>-- Pilih Departemen
                                                --</option>
                                            <?php foreach ($get_departement as $row) : ?>
                                            <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status" id="status_view" disabled>
                                            <option value="" class="text-center" selected disabled>-- Pilih Status --
                                            </option>
                                            <option value="0">PASIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ID Karyawan</label>
                                    <select class="form-control" name="id_karyawan" id="id_karyawan_view" disabled>
                                        <option value="" class="text-center" selected disabled>-- Pilih ID Karyawan --
                                        </option>
                                        <?php foreach ($get_karyawan as $row) : ?>
                                        <option value="<?= $row->ID_KARYAWAN; ?>"><?= $row->ID_KARYAWAN; ?> -
                                            <?= $row->NAMA_KARYAWAN; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Teknisi</label>
                                    <textarea class="form-control" placeholder="Deskripsi" name="description_technician"
                                        id="description_technician_view" disabled></textarea>
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
                                    <input required type="hidden" id="id_technician_edit" class="form-control"
                                        placeholder="ID" name="id_technician_edit">
                                    <input required type="text" class="form-control" placeholder="Nama Teknisi"
                                        name="nama_technician_edit" id="nama_technician_edit">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Departemen</label>
                                        <select class="form-control" name="id_departement_edit"
                                            id="id_departement_edit">
                                            <option value="" class="text-center" selected disabled>-- Pilih Departemen
                                                --</option>
                                            <?php foreach ($get_departement as $row) : ?>
                                            <option value="<?= $row->KODE_DEPARTEMEN; ?>"><?= $row->NAMA_DEPARTEMEN; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status_edit" id="status_edit">
                                            <option value="" class="text-center" selected disabled>-- Pilih Status --
                                            </option>
                                            <option value="0">PASIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ID Karyawan</label>
                                    <select class="form-control" name="id_karyawan_edit" id="id_karyawan_edit">
                                        <option value="" class="text-center" selected disabled>-- Pilih ID Karyawan --
                                        </option>
                                        <?php foreach ($get_karyawan as $row) : ?>
                                        <option value="<?= $row->ID_KARYAWAN; ?>"><?= $row->ID_KARYAWAN; ?> -
                                            <?= $row->NAMA_KARYAWAN; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Teknisi</label>
                                    <textarea class="form-control" placeholder="Deskripsi"
                                        name="description_technician_edit" id="description_technician_edit"></textarea>
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
                            <h5 class="modal-title" id="formModal">Hapus Data Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formHapusproduk">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input required type="hidden" id="id_technician_hapus" class="form-control"
                                        placeholder="ID" name="KODE_ITEM">
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

            </body>

            <script>
$(document).ready(function() {

    $('#formHapusproduk').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = $(this).serialize();

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" +
                "produk_item/hapus", // Endpoint untuk proses input
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