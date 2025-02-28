            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_PRODUK_ITEM_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT RIWAYAT PRODUK</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="row" style="margin:0 20px 0 20px;">


                                            <div class="form-group col-12 col-md-12 col-lg-4">
                                                <table class="table table-striped table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <img width="100%"
                                                                src="<?php echo base_url('assets/uploads/item/') . $aset->FOTO_ITEM; ?>"
                                                                alt="">
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group col-12 col-md-12 col-lg-8">
                                                <table class="table table-striped table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <th class="col-1">AREA</th>
                                                            <td><?= $aset->NAMA_AREA; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-1">DEPARTEMEN</th>
                                                            <td><?= $aset->NAMA_DEPARTEMEN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-1">RUANGAN</th>
                                                            <td><?= $aset->NAMA_RUANGAN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-1">LOKASI</th>
                                                            <td><?= $aset->NAMA_LOKASI; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-1">PIC</th>
                                                            <td><?= $aset->NAMA_PIC; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-1">KODE ASET</th>
                                                            <td><?= $aset->UUID_ASET; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-1">NAMA PRODUK</th>
                                                            <td><?= $aset->NAMA_PRODUK; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-1">KATEGORI</th>
                                                            <td><?= $aset->NAMA_PRODUK_KATEGORI; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-1">SATUAN</th>
                                                            <td><?= $aset->SATUAN; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row">                                            

                                            <div class="form-group col-12 col-md-12 col-lg-12">
                                                <label>KETERANGAN RIWAYAT PRODUK</label>
                                                <input type="hidden" name="UUID_ASET" value="<?= $aset->UUID_ASET; ?>">                                                
                                                <textarea required name="KETERANGAN_TINDAKAN" rows="10" autofocus
                                                    placeholder="Masukkan keterangan produk" class="form-control"
                                                    id="description_ticket"></textarea>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan keterangan produk anda!
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
                                        <a href="#" onclick="history.back()" class="btn btn-secondary"><i
                                                class="fa fa-times"></i> BATAL</a>
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
    $('#FORM_PRODUK_ITEM_TAMBAH').on('submit', function(e) {
        e.preventDefault();

        // Ambil data dari form
        let formData = new FormData(this);

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: "<?php echo base_url(); ?>" +
            "produk_stok/simpan_histori", // Endpoint untuk proses input
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Tambah Data Berhasil!', 'success').then(function() {
                        window.open("<?php echo base_url(); ?>produk_stok/produk_aset_histori/<?= $aset->UUID_STOK; ?>/<?= $aset->UUID_ASET; ?>", '_blank');
                        window.history.back();
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