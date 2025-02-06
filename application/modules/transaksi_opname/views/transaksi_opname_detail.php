            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGADAAN_TAMBAH">
                                    <div class="card-header">
                                        <h4>DETAIL TRANSAKSI OPNAME</h4>

                                    </div>
                                    <div class="card-body">

                                        <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <input type="text" class="form-control" name="area" id="area" required
                                                    value="<?= $get_single->NAMA_AREA; ?>" readonly>

                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AREA!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DEPARTEMEN</label>
                                                <input type="text" class="form-control" name="departemen"
                                                    id="departemen" required
                                                    value="<?= $get_single->NAMA_DEPARTEMEN; ?>" readonly>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan DEPARTEMENT!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>RUANGAN</label>
                                                <input type="text" class="form-control" name="ruangan" id="ruangan"
                                                    required value="<?= $get_single->NAMA_RUANGAN; ?>" readonly>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan RUANGAN!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>LOKASI</label>
                                                <input type="text" class="form-control" name="lokasi" id="lokasi"
                                                    required value="<?= $get_single->NAMA_LOKASI; ?>" readonly>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan LOKASI!
                                                </div>
                                            </div>
                                        </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped" id="dataprodukitem">
                                            <thead>
                                                <tr>
                                                    <th>PRODUK/ITEM</th>
                                                    <th>STOK SISTEM</th>
                                                    <th>STOK REAL</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selected-items-body">
                                            </tbody>
                                        </table>
                                    </div><br><br>

                                    <div class="form-group col-12 col-md-12 col-lg-12">
                                        <label>KETERANGAN</label>
                                        <textarea readonly name="description_ticket" placeholder="Masukkan keterangan opname"
                                            class="form-control" id="description_ticket"><?= $get_single->CATATAN_OPNAME; ?></textarea>
                                        <div class="invalid-feedback">
                                            Silahkan masukkan keterangan opname!
                                        </div>

                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="<?=site_url('transaksi_opname');?>" class="btn btn-primary">
                                            <i class="fa fa-arrow-left"></i> KEMBALI</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <?php $this->load->view('layout/footer'); ?>

            <script>
$(document).ready(function() {

    $('#dataprodukitem').dataTable({
        paging: false,
        searching: false
    });
});
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>