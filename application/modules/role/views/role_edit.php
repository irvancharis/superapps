            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4>SETTING DETAIL ROLE - <?= $get_role->NAMA_ROLE ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form id="FORM_DATA">
                                            <table class="table table-striped table-bordered">
                                                <tbody>

                                                    <?php foreach ($M_FITUR as $index => $FITUR) : ?>

                                                    <tr>
                                                        <td class="role-title"><?= $FITUR->NAMA_FITUR ?> </td>

                                                        <?php
                                                            $GET_DETAIL_FITUR = $this->M_FITUR->get_detail_fitur($FITUR->KODE_FITUR);
                                                            foreach ($GET_DETAIL_FITUR as $index => $DETAIL_FITUR) : 
                                                                $GET_KODE_DETAIL_FITUR = $this->M_ROLE->get_detail_fitur_single($kode_role,$DETAIL_FITUR->KODE_DETAIL_FITUR);
                                                        ?>

                                                        <td><input class="detail_fitur" type="checkbox"
                                                                KODE_FITUR="<?= $FITUR->KODE_FITUR ?>" KODE_ROLE="<?=$kode_role ?>" KODE_DETAIL_FITUR="<?= $DETAIL_FITUR->KODE_DETAIL_FITUR ?>"
                                                                value="<?= $DETAIL_FITUR->KODE_DETAIL_FITUR ?>"
                                                                <?php if ($GET_KODE_DETAIL_FITUR) echo "checked" ?>>
                                                            <?= $DETAIL_FITUR->NAMA_DETAIL_FITUR ?>
                                                        </td>

                                                        <?php endforeach; ?>

                                                    </tr>

                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                            <br><br>
                                            <center>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </center>
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
    $('#FORM_DATA').on('submit', function(e) {
        e.preventDefault();

        var selectedItems = [];

        $('.detail_fitur:checked').each(function() {
            selectedItems.push({
                KODE_ROLE: $(this).attr('KODE_ROLE'), 
                KODE_FITUR: $(this).attr('KODE_FITUR'), 
                KODE_DETAIL_FITUR: $(this).attr('KODE_DETAIL_FITUR')
            });
        });

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" +
                "role/insert_detail_role/", // Endpoint untuk proses input
            type: 'POST',
            data: {data: selectedItems},
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                        location.href = "<?php echo base_url(); ?>role";
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