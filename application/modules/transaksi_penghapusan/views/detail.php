<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PERMINTAAN">
                        <div class="card-header">
                            <h4>DETAIL TRANSAKSI PENGHAPUSAN</h4>

                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-12 col-md-12 col-lg-12">
                                    
                                    <table class="table table-striped table-sm ">
                                        <tbody>
                                            <tr>
                                                <th class="text-left col-2">AREA</th>
                                                <td><?= $transaksi->NAMA_AREA; ?></td>
                                                <input type="hidden" class="form-control" name="area" id="area" required
                                                    value="<?= $transaksi->NAMA_AREA; ?>" readonly>
                                            </tr>
                                            <tr>
                                                <th>DEPARTEMEN</th>
                                                <td><?= $transaksi->NAMA_DEPARTEMEN; ?></td>
                                                <input type="hidden" class="form-control" name="departemen"
                                                    id="departemen" required
                                                    value="<?= $transaksi->NAMA_DEPARTEMEN; ?>" readonly>
                                            </tr>
                                            <tr>
                                                <th>RUANGAN</th>
                                                <td><?= $transaksi->NAMA_RUANGAN; ?></td>
                                                <input type="hidden" class="form-control" name="ruangan" id="ruangan"
                                                    required value="<?= $transaksi->NAMA_RUANGAN; ?>" readonly>
                                            </tr>
                                            <tr>
                                                <input type="hidden" class="form-control" name="lokasi" id="lokasi"
                                                    required value="<?= $transaksi->NAMA_LOKASI; ?>" readonly>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-bordered" id="dataprodukitem">
                                    <thead>
                                        <tr>
                                            <th class="text-center col-2"></th>
                                            <th class="col-2">PRODUK / ITEM</th>
                                            <th class="text-center col-2">JUMLAH</th>
                                            <th class="col-4">KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selected-items-body">
                                        <?php foreach ($detail_transaksi as $row) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <img width="100px"
                                                    src="<?php echo base_url('assets/uploads/item/') ?><?= $row->FOTO_ITEM; ?>"
                                                    alt="">
                                            </td>
                                            <td><?= $row->NAMA_PRODUK; ?></td>
                                            <td class="text-center"><?= $row->JUMLAH_PENGHAPUSAN; ?></td>
                                            <td><?= $row->KETERANGAN_ITEM; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div><br>

                            <div class="form-group col-12 col-md-12 col-lg-12">
                                <table class="table table-striped table-sm ">
                                    <tbody>
                                        <tr>
                                            <th class="text-left col-2">KETERANGAN :
                                                <?= $transaksi->KETERANGAN_PENGHAPUSAN; ?></th>
                                        </tr>
                                        <tr>
                                            <th class="text-left col-2">STATUS PERMINTAAN :
                                                <?php if($transaksi->STATUS_PENGHAPUSAN == 'MENUNGGU APROVAL KABAG')
                                                            {
                                                        ?>
                                                <span class="badge badge-primary">MENUNGGU APROVAL KABAG</span>
                                                <?php
                                                            }
                                                            elseif($transaksi->STATUS_PENGHAPUSAN == 'MENUNGGU PENYERAHAN')
                                                            {
                                                        ?>
                                                <span class="badge badge-warning">MENUNGGU PENYERAHAN</span>
                                                <?php
                                                        }
                                                            elseif($transaksi->STATUS_PENGHAPUSAN == 'SELESAI')
                                                            {
                                                        ?>
                                                <span class="badge badge-success">SELESAI</span>
                                                <?php
                                                        }
                                                            elseif($transaksi->STATUS_PENGHAPUSAN == 'DITOLAK KABAG')
                                                            {
                                                        ?>
                                                <span class="badge badge-danger">DITOLAK KABAG</span>
                                                <?php 
                                                            }
                                                        ?>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br><br>


                            <div class="row justify-content-center align-items-center">
                                <div class="form-group col-2 col-md-2 col-lg-2 text-center">
                                    <label>DIAJUKAN :</label><br>
                                    <span><?php echo $transaksi->NAMA_USER_PENGAJUAN; ?></span>
                                </div>
                                <div class="form-group col-2 col-md-2 col-lg-2 text-center">
                                    <label>DISETUJUI :</label><br>
                                    <span><?php echo $transaksi->NAMA_APROVAL_KABAG; ?></span>
                                </div>
                                <div class="form-group col-2 col-md-2 col-lg-2 text-center">
                                    <label>MENGETAHUI :</label><br>
                                    <span><?php echo $transaksi->NAMA_APROVAL_GM; ?></span>
                                </div>
                                <div class="form-group col-2 col-md-2 col-lg-2 text-center">
                                    <label>MENGETAHUI :</label><br>
                                    <span><?php echo $transaksi->NAMA_APROVAL_HEAD; ?></span>
                                </div>
                                <div class="form-group col-2 col-md-2 col-lg-2 text-center">
                                    <label>PELAKSANA :</label><br>
                                    <span><?php echo $transaksi->NAMA_USER_PELAKSANA; ?></span>
                                </div>
                                
                            </div>


                            <div class="card-footer text-center">
                                <label onclick="history.go(-1)" class="btn btn-outline-primary" id="btn-aprove">
                                    <i class="fa fa-backward"></i> KEMBALI</label>
                            </div>
                        </div>
                </div>
            </div>
    </section>
</div>


<?php $this->load->view('layout/footer'); ?>


</body>


<!-- index.html  21 Nov 2019 02:47:04 GMT -->

</html>