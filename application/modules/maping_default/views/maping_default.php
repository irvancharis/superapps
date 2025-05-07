<div class="main-content">
    <div class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Mapping Default</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table id="mapingTable" class="table table-bordered table-striped">
                                <thead class="bg-gray">
                                    <tr>
                                        <th width="20%">Area</th>
                                        <th width="20%">Ruangan</th>
                                        <th width="20%">Lokasi</th>
                                        <th width="20%">Departemen</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sfa_maping_default as $item):
                                        // Cari nama area yang sesuai dengan kode area
                                        $nama_area = '';
                                        foreach ($get_area as $area) {
                                            if ($area->KODE_AREA == $item->AREA) {
                                                $nama_area = $area->NAMA_AREA;
                                                break;
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $nama_area ?></td>
                                            <td>
                                                <select class="form-control form-control-sm select2"
                                                    name="ruangan_<?= $item->AREA ?>"
                                                    id="ruangan_<?= $item->AREA ?>">
                                                    <option value="">Pilih Ruangan</option>
                                                    <?php foreach ($get_ruangan as $ruangan): ?>
                                                        <option value="<?= $ruangan->KODE_RUANGAN ?>"
                                                            <?= ($ruangan->KODE_RUANGAN == $item->RUANGAN) ? 'selected' : '' ?>>
                                                            <?= $ruangan->NAMA_RUANGAN ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm select2"
                                                    name="lokasi_<?= $item->AREA ?>"
                                                    id="lokasi_<?= $item->AREA ?>">
                                                    <option value="">Pilih Lokasi</option>
                                                    <?php foreach ($get_lokasi as $lokasi): ?>
                                                        <option value="<?= $lokasi->KODE_LOKASI ?>"
                                                            <?= ($lokasi->KODE_LOKASI == $item->LOKASI) ? 'selected' : '' ?>>
                                                            <?= $lokasi->NAMA_LOKASI ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm select2"
                                                    name="departemen_<?= $item->AREA ?>"
                                                    id="departemen_<?= $item->AREA ?>">
                                                    <option value="">Pilih Departemen</option>
                                                    <?php foreach ($get_departemen as $departemen): ?>
                                                        <option value="<?= $departemen->KODE_DEPARTEMEN ?>"
                                                            <?= ($departemen->KODE_DEPARTEMEN == $item->DEPARTEMEN) ? 'selected' : '' ?>>
                                                            <?= $departemen->NAMA_DEPARTEMEN ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary btn-save"
                                                    data-area="<?= $item->AREA ?>">
                                                    <i class="fas fa-save"></i> Simpan
                                                </button>
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
</div>

<?php $this->load->view('layout/footer'); ?>

<!-- Modal Confirm -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menyimpan perubahan?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmSave">Ya, Simpan</button>
            </div>
        </div>
    </div>
</div>

<style>
    .table td {
        vertical-align: middle !important;
    }

    .bg-gray {
        background-color: #f8f9fa;
    }

    .btn-save {
        width: 100%;
    }

    .select2-container .select2-selection--single {
        height: 31px !important;
    }
</style>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Pilih opsi',
            allowClear: true
        });

        // Inisialisasi DataTable
        $('#mapingTable').DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        // Handle save button click
        $('.btn-save').click(function() {
            var area = $(this).data('area');
            $('#confirmModal').modal('show');

            // Set confirm button to save this specific row
            $('#confirmSave').off('click').on('click', function() {
                saveData(area);
            });
        });

        // Function to save data via AJAX
        function saveData(area) {
            var ruangan = $('#ruangan_' + area).val();
            var lokasi = $('#lokasi_' + area).val();
            var departemen = $('#departemen_' + area).val();

            $.ajax({
                url: '<?= site_url("maping_default/update") ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    area_edit: area,
                    ruangan_edit: ruangan,
                    lokasi_edit: lokasi,
                    departemen_edit: departemen
                },
                success: function(response) {
                    $('#confirmModal').modal('hide');
                    if (response.success) {
                        showAlert('success', 'Data berhasil disimpan');
                    } else {
                        showAlert('danger', response.error || 'Gagal menyimpan data');
                    }
                },
                error: function() {
                    $('#confirmModal').modal('hide');
                    showAlert('danger', 'Terjadi kesalahan saat menyimpan data');
                }
            });
        }

        // Function to show alert
        function showAlert(type, message) {
            var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                message +
                '</div>';
            $('.card-body').prepend(alertHtml);

            // Auto close alert after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        }
    });
</script>