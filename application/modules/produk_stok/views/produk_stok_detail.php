            <!-- Main Content -->

            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DETAIL PRODUK STOK</h4>
                                </div>
                                <div class="card-body">

                                    <div class="row" style="margin:0 20px 0 20px;">


                                        <div class="form-group col-12 col-md-12 col-lg-4">
                                            <table class="table table-striped table-sm">
                                                <tbody>
                                                    <tr>
                                                        <img width="100%"
                                                            src="<?php echo base_url('assets/uploads/item/') . $detail_aset->FOTO_ITEM; ?>"
                                                            alt="">
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group col-12 col-md-12 col-lg-8">
                                            <table class="table table-striped table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th class="col-2">AREA</th>
                                                        <td><?= $detail_aset->NAMA_AREA; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-2">DEPARTEMEN</th>
                                                        <td><?= $detail_aset->NAMA_DEPARTEMEN; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-2">RUANGAN</th>
                                                        <td><?= $detail_aset->NAMA_RUANGAN; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-2">LOKASI</th>
                                                        <td><?= $detail_aset->NAMA_LOKASI; ?></td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <th class="col-2">KODE ASET</th>
                                                        <td><?= $detail_aset->UUID_ASET; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-2">NAMA PRODUK</th>
                                                        <td><?= $detail_aset->NAMA_PRODUK; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-2">KATEGORI</th>
                                                        <td><?= $detail_aset->NAMA_PRODUK_KATEGORI; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-2">SATUAN</th>
                                                        <td><?= $detail_aset->SATUAN; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tabel">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-2">QR</th>
                                                    <th class="text-center col-2">KODE</th>
                                                    <th>NAMA PRODUK</th>
                                                    <th class="text-center col-2">PIC</th>
                                                    <th class="text-center col-2"><button
                                                            class="btn btn-outline-secondary"
                                                            onclick="window.open('<?php echo base_url('produk_stok/print_qr_aset/'.$this->uri->segment(3)) ?>','_blank')"><i
                                                                class="fas fa-print"></i></button></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($aset as $index => $d) : ?>
                                                <tr>
                                                    <td>
                                                        <center><img width="120px"
                                                                src="<?php echo base_url('produk_stok/qr_link/'.$d->UUID_STOK.'/'.$d->UUID_ASET)?>"
                                                                alt=""></center>
                                                    </td>
                                                    <td><?php echo $d->UUID_ASET; ?></td>
                                                    <td><?php echo $d->NAMA_PRODUK; ?></td>
                                                    <td><?php echo $d->NAMA_PIC; ?></td>                                                    
                                                    <td class="text-center col-2">
                                                        <label
                                                            onclick="detail_stok('<?php echo $d->UUID_STOK; ?>','<?php echo $d->UUID_ASET; ?>')"
                                                            class="btn btn-outline-primary" id="btn-show-produk"> <i
                                                                class="fa fa-eye"></i> CEK HISTORI
                                                        </label>
                                                        <label class="btn btn-outline-secondary"
                                                            onclick="window.open('<?php echo base_url('produk_stok/print_qr_single/'.$d->UUID_ASET) ?>','_blank')"><i
                                                                class="fas fa-print"></i>
                                                        </label>
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
            </div>


            <?php $this->load->view('layout/footer'); ?>
            </body>


            <script>
$('#tabel').dataTable({
    paging: false,
    searching: true,
    info: false
});

function detail_stok(UUID_STOK, UUID_ASET) {
    window.open("<?php echo base_url('produk_stok/produk_aset_histori/') ?>" + UUID_STOK + "/" + UUID_ASET, '_blank');
}
            </script>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>