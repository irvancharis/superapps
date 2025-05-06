<style>
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 0.25rem;
        display: block;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .is-valid {
        border-color: #28a745 !important;
    }
</style>

<div class="main-content">
    <div class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Pengaturan Aplikasi</h3>
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

                        <form action="<?= site_url('setting/update') ?>" method="post" id="settingForm" novalidate>
                            <div class="row">
                                <!-- Kolom Pertama -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="gm" class="form-label">GM</label>
                                        <input type="text" class="form-control" id="gm" name="gm"
                                            value="<?= $setting->GM ?? '' ?>" required>
                                        <small class="text-muted">Nama General Manager</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="head" class="form-label">Head</label>
                                        <input type="text" class="form-control" id="head" name="head"
                                            value="<?= $setting->HEAD ?? '' ?>" required>
                                        <small class="text-muted">Nama Department Head</small>
                                    </div>
                                </div>

                                <!-- Kolom Kedua -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="token_wa" class="form-label">Token WhatsApp</label>
                                        <input type="text" class="form-control" id="token_wa" name="token_wa"
                                            value="<?= $setting->TOKEN_WA ?? '' ?>" required>
                                        <small class="text-muted">Token API WhatsApp</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Aksi</label>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Simpan Perubahan
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                <i class="fas fa-undo"></i> Reset Form
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layout/footer'); ?>

<script>
    $(document).ready(function() {
        // Validasi form sebelum submit
        $('#settingForm').submit(function(e) {
            e.preventDefault();

            let isValid = true;
            const form = this;

            // Reset error state
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            // Validasi GM
            if ($('#gm').val().trim() === '' || $('#gm').val().trim().length < 2) {
                $('#gm').addClass('is-invalid');
                $('#gm').after('<div class="invalid-feedback">Nama GM minimal 2 karakter</div>');
                isValid = false;
            }

            // Validasi Head
            if ($('#head').val().trim() === '' || $('#head').val().trim().length < 2) {
                $('#head').addClass('is-invalid');
                $('#head').after('<div class="invalid-feedback">Nama Head minimal 2 karakter</div>');
                isValid = false;
            }

            // Validasi Token WA
            if ($('#token_wa').val().trim() === '' || $('#token_wa').val().trim().length < 5) {
                $('#token_wa').addClass('is-invalid');
                $('#token_wa').after('<div class="invalid-feedback">Token WA minimal 5 karakter</div>');
                isValid = false;
            }

            // Jika valid, submit form
            if (isValid) {
                form.submit();
            }
        });

        // Validasi real-time saat input berubah
        $('#gm, #head, #token_wa').on('input', function() {
            const $input = $(this);
            if ($input.val().trim() !== '') {
                $input.removeClass('is-invalid').addClass('is-valid');
                $input.next('.invalid-feedback').remove();
            } else {
                $input.removeClass('is-valid');
            }
        });

        // Reset form
        $("button[type='reset']").click(function() {
            $('#settingForm')[0].reset();
            $('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
            $('.invalid-feedback').remove();
        });
    });
</script>