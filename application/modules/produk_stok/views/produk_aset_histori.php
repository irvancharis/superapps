            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>History Aset</title>

                <link rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>">
                <link rel="stylesheet" href="<?php echo base_url('assets/bundles/chocolat/dist/css/chocolat.css'); ?>">
                <!-- Template CSS -->
                <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
                <link rel="stylesheet" href="<?php echo base_url('assets/css/components.css'); ?>">
                <!-- Custom style CSS -->
                <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
                <link rel='shortcut icon' type='image/x-icon'
                    href='<?php echo base_url('assets/img/Logo SA X7.ico'); ?>' />
                <!-- DataTable -->
                <link rel="stylesheet" href="<?php echo base_url('assets/bundles/datatables/datatables.min.css') ?>">
                <link rel="stylesheet"
                    href="<?php echo base_url('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') ?>">
                <!-- Fancybox -->
                <script src="<?php echo base_url('assets/js/fancybox.umd.js'); ?>"></script>
                <link rel="stylesheet" href="<?php echo base_url('assets/css/fancybox.css'); ?>" />
                <!-- Toast -->
                <link rel="stylesheet" href="<?php echo base_url('assets/bundles/izitoast/css/iziToast.min.css'); ?>">


                <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f9;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }

                .timeline-container {
                    width: 100%;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background: white;
                }

                .timeline {
                    position: relative;
                    width: 90%;
                    max-width: 1200px;
                    margin: auto;
                    padding: 20px;
                    /* background: white; */
                    border-radius: 10px;
                    /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); */
                }

                .timeline::before {
                    content: '';
                    position: absolute;
                    left: 20px;
                    top: 0;
                    width: 4px;
                    height: 100%;
                    background: linear-gradient(to bottom, #999 40%, #007bff 60%);
                    border-radius: 2px;
                }

                .timeline-item {
                    position: relative;
                    margin: 40px 0;
                    padding: 20px 20px 20px 50px;
                    /* background: rgb(0 0 0 / 3%); */
                    border-radius: 10px;
                    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
                }

                .timeline-item::before {
                    content: '';
                    position: absolute;
                    top: 20px;
                    left: 10px;
                    width: 20px;
                    height: 20px;
                    background: #007bff;
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
                }

                .year {
                    font-size: 14px;
                    font-weight: bold;
                    color: #555;
                }

                .year.active {
                    color: #007bff;
                }

                .content {
                    font-size: 16px;
                }

                .content h3 {
                    margin: 5px 0;
                    font-size: 15px;
                    font-weight: bold;
                }

                .content p {
                    color: #666;
                    font-size: 12px;
                }

                .content h3.active,
                .content p.active {
                    color: #007bff;
                }
                </style>
            </head>

            <body>
                <h1 style="text-align: center; clear: both; margin-top: 20px;margin-bottom: 20px;">Histori Aset</h1>


                <div class="row" style="margin:0 20px 0 20px;">


                    <div class="form-group col-12 col-md-12 col-lg-4">
                        <table class="table table-striped table-sm">
                            <tbody>
                                <tr>
                                    <img width="100%"
                                        src="<?php echo base_url('assets/uploads/item/') . $aset->FOTO_ITEM; ?>" alt="">
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


                <div class="timeline">

                    <?php foreach ($histori_aset as $index => $d) : ?>
                    <div class="timeline-item">
                        <div class="year">
                            <?php echo $this->tanggalindo->formatTanggal($d->TANGGAL_TINDAKAN, 'l, d F Y'); ?></div>
                        <div class="content">
                            <h3><?php echo $d->KETERANGAN_TINDAKAN; ?></h3>
                            <p><?php echo $d->NAMA_USER_TINDAKAN; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>

            </body>

            </html>