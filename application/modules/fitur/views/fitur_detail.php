            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate="" id="FORM_DATA">
                                    <div class="card-header">
                                        <h4>DETAIL FITUR - <?php echo $get_fitur->NAMA_FITUR; ?></h4>
                                        <div class="card-header-action">
                                            <a href="<?php echo base_url('fitur/tambah_detail_fitur/').$get_fitur->KODE_FITUR ?>"
                                                class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Detail
                                                Fitur</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <table class="table table-striped" id="table-2">
                                                <thead>
                                                    <tr>
                                                        <th>KODE DETAIL FITUR</th>
                                                        <th>NAMA DETAIL FITUR</th>
                                                        <th>KETERANGAN</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($get_detail_fitur as $index => $d) : ?>
                                                    <tr>
                                                        <td><?php echo $d->KODE_DETAIL_FITUR; ?></td>
                                                        <td><?php echo $d->NAMA_DETAIL_FITUR; ?></td>
                                                        <td><?php echo $d->KETERANGAN_DETAIL_FITUR; ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown"
                                                                    class="btn btn-primary dropdown-toggle">Detail</a>
                                                                <div class="dropdown-menu">
                                                                    <a href="<?= site_url('fitur/hapus_detail_fitur/' . $d->KODE_DETAIL_FITUR); ?>"
                                                                        class="dropdown-item has-icon text-danger hapus-btn"
                                                                        onclick="return confirm('Yakin akan menghapus data?')"><i
                                                                            class="far fa-trash-alt"></i>
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
                                    <div class="card-footer text-right">
                                        <a href="<?=site_url('fitur');?>" class="btn btn-primary">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <?php $this->load->view('layout/footer'); ?>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>