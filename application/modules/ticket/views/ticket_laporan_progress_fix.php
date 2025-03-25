<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-title h2 {
            margin: 0;
            font-size: 24px;
        }

        .invoice-number img {
            vertical-align: middle;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .progress-bar {
            background-color: #007bff;
            color: white;
            padding: 5px;
            text-align: center;
            border-radius: 5px;
        }

        .watermark-ditolak,
        .watermark-selesai {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
            color: rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .watermark-ditolak {
            content: "DITOLAK";
        }

        .watermark-selesai {
            content: "SELESAI";
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .invoice {
                width: 100%;
                margin: 0 auto;
                padding: 20px;
            }

            .table th,
            .table td {
                font-size: 12px;
            }

            .invoice-title h2 {
                font-size: 20px;
            }

            .section-title {
                font-size: 16px;
            }

            .progress-bar {
                font-size: 12px;
            }

            .watermark-ditolak,
            .watermark-selesai {
                font-size: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice">
            <div class="invoice-print">
                <div class="invoice-title text-center">
                    <h2>Ticket Progress Report</h2>
                    <div class="invoice-number"><img width="50px" src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>" alt=""></div>
                </div>
                <hr>

                <div class="section-title">Detail Tiket</div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Request Oleh</strong></td>
                            <td><?php echo strtoupper($ticket->REQUESTBY); ?></td>
                        </tr>
                        <tr>
                            <td><strong>No. WA</strong></td>
                            <td><?php echo strtoupper($ticket->TELP); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Departemen</strong></td>
                            <td><?php echo strtoupper($get_departemen->NAMA_DEPARTEMEN); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Type Keluhan</strong></td>
                            <td><?php echo strtoupper($ticket->TYPE_TICKET); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Deskripsi Keluhan</strong></td>
                            <td><?php echo strtoupper($ticket->DESCRIPTION_TICKET); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Status Ticket</strong></td>
                            <td>
                                <?php if ($ticket->STATUS_TICKET == 0) {
                                    echo "<span class='badge badge-warning'>DALAM ANTRIAN</span>";
                                } elseif ($ticket->STATUS_TICKET == 25) {
                                    echo "<span class='badge badge-primary'>SEDANG DIKERJAKAN</span>";
                                } elseif ($ticket->STATUS_TICKET == 50) {
                                    echo "<span class='badge badge-danger'>MENUNGGU VALIDASI</span>";
                                } elseif ($ticket->STATUS_TICKET == 100) {
                                    echo "<span class='badge badge-success'>SELESAI</span>";
                                } else {
                                    echo "<span class='badge badge-danger'>DITOLAK</span>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Foto Bukti Keluhan</strong></td>
                            <td>
                                <?php if (!empty($ticket->FOTO)) : ?>
                                    <img src="<?= base_url('assets/uploads/ticket/' . $ticket->FOTO); ?>" width="100px" class="img-thumbnail">
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="section-title">Detail Pengerjaan</div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tgl & Waktu</th>
                                <th>Objektif</th>
                                <th>Keterangan</th>
                                <th>Teknisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ticket_detail as $index => $d) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo date('d-m-Y H:i', strtotime($d->TGL_PENGERJAAN)); ?></td>
                                    <td><?php echo $d->OBJEK_DITANGANI; ?></td>
                                    <td><?php echo $d->KETERANGAN; ?></td>
                                    <td><?php echo $d->NAME_TECHNICIAN; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-center">Foto Bukti Pengerjaan</th>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="5">
                                        <?php if ($d->FOTO == null) {
                                            echo "-";
                                        } else { ?>
                                            <img src="<?php echo base_url('assets/uploads/ticket/') . $d->FOTO; ?>" width="100px" class="img-thumbnail" />
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>