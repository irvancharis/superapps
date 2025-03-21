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

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f2f2f2;
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

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .invoice {
                width: 100%;
                margin: 0 auto;
                padding: 20px;
            }

            .invoice-table th,
            .invoice-table td {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice">
            <div class="invoice-title">
                <h2>Ticket</h2>
                <div class="invoice-number"><img width="50px" src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>" alt=""></div>
            </div>
            <hr>

            <table class="table invoice-table">
                <tr>
                    <th>Request Oleh</th>
                    <td><?= strtoupper($ticket->REQUESTBY); ?></td>
                    <th>Email</th>
                    <td><?= strtoupper($ticket->EMAIL_TICKET); ?></td>
                </tr>
                <tr>
                    <th>Departemen</th>
                    <td><?= strtoupper($get_departemen->NAMA_DEPARTEMEN); ?></td>
                    <th>Type Keluhan</th>
                    <td><?= strtoupper($ticket->TYPE_TICKET); ?></td>
                </tr>
                <tr>
                    <th>Deskripsi Keluhan</th>
                    <td colspan="3"><?= strtoupper($ticket->DESCRIPTION_TICKET); ?></td>
                </tr>
                <tr>
                    <th>Departemen Diminta</th>
                    <td><?= strtoupper($get_departemen_request->NAMA_DEPARTEMEN); ?></td>
                    <th>Ditangani Oleh</th>
                    <td><?= empty($get_technician->NAME_TECHNICIAN) ? '-' : strtoupper($get_technician->NAME_TECHNICIAN); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Request</th>
                    <td><?= date('d M Y H:i', strtotime($ticket->DATE_TICKET)); ?></td>
                    <th>Selesai Pada</th>
                    <td>
                        <?php if (!empty($ticket->DATE_TICKET_DONE)) {
                            $date_done = new DateTime($ticket->DATE_TICKET_DONE);
                            $now = new DateTime($ticket->DATE_TICKET);
                            $diff = $now->diff($date_done);
                            echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                        } else {
                            echo "-";
                        } ?>
                    </td>
                </tr>
                <tr>
                    <th>Status Ticket</th>
                    <td>
                        <?php
                        $status_classes = [
                            0 => 'warning',
                            25 => 'primary',
                            50 => 'danger',
                            100 => 'success',
                            200 => 'danger'
                        ];
                        $status_labels = [
                            0 => 'DALAM ANTRIAN',
                            25 => 'SEDANG DIKERJAKAN',
                            50 => 'MENUNGGU VALIDASI',
                            100 => 'SELESAI',
                            200 => 'DITOLAK'
                        ];
                        $status_class = $status_classes[$ticket->STATUS_TICKET] ?? 'danger';
                        $status_label = $status_labels[$ticket->STATUS_TICKET] ?? 'DITOLAK';
                        ?>
                        <span class='badge badge-<?= $status_class; ?>'><?= $status_label; ?></span>
                    </td>
                    <?php if ($ticket->APPROVAL_TICKET == 2) : ?>
                        <th>Alasan Ditolak</th>
                        <td><?= strtoupper($ticket->ALASAN_DITOLAK); ?></td>
                    <?php endif; ?>
                </tr>
            </table>

            <div class="section-title text-center">Detail Pengerjaan</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table-pengerjaan">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl & Waktu</th>
                            <th>Objektif</th>
                            <th>Keterangan</th>
                            <th>Dikerjakan Oleh</th>
                            <th class="text-center">Foto Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ticket_detail as $index => $d) : ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= date('d-m-Y H:i', strtotime($d->TGL_PENGERJAAN)); ?></td>
                                <td><?= $d->OBJEK_DITANGANI; ?></td>
                                <td><?= $d->KETERANGAN; ?></td>
                                <td><?= $d->NAME_TECHNICIAN; ?></td>
                                <td class="text-center">
                                    <?php if ($d->FOTO) : ?>
                                        <a href="<?= base_url('assets/uploads/ticket/') . $d->FOTO; ?>" data-fancybox>
                                            <img src="<?= base_url('assets/uploads/ticket/') . $d->FOTO; ?>" width="100px" class="img-thumbnail">
                                        </a>
                                    <?php else : ?> - <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if ($ticket->STATUS_TICKET == 200) : ?>
        <div class="watermark-ditolak">DITOLAK</div>
    <?php elseif ($ticket->STATUS_TICKET == 100) : ?>
        <div class="watermark-selesai">SELESAI</div>
    <?php endif; ?>
</body>

</html>