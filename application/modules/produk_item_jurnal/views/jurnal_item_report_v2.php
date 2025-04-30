<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>LAPORAN JURNAL ITEM PER AREA</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin: 10px 20px;
        }

        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .login-brand {
            display: flex;
            align-items: center;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            margin-right: 10px;
        }

        .SA {
            font-size: 1.5em;
            color: #e91b31;
            font-weight: bold;
            font-family: 'Barlow Semi Condensed', sans-serif;
            letter-spacing: 0;
            font-style: italic;
        }

        .GROUP {
            font-size: 1.5em;
            color: #202d45;
            font-weight: bold;
            font-family: 'Barlow Semi Condensed', sans-serif;
            letter-spacing: 0;
            font-style: italic;
        }

        h1 {
            color: black;
            text-align: center;
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        h2 {
            color: #333;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            page-break-after: avoid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 15px;
            page-break-inside: auto;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 6px;
            text-align: center;
            font-size: 0.9em;
        }

        th {
            background-color: #1E5F8C;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #E6F2FF;
        }

        tr:nth-child(odd) {
            background-color: white;
        }

        .area-group {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .summary {
            margin-top: 5px;
            padding: 8px;
            border-radius: 5px;
            background-color: #f5f5f5;
            border-left: 4px solid #60B5FF;
            margin-bottom: 15px;
            page-break-after: avoid;
        }

        .summary-title {
            font-weight: bold;
            color: #202d45;
            margin-bottom: 5px;
        }

        .summary-item {
            display: flex;
            align-items: center;
            margin-bottom: 3px;
        }

        .summary-label {
            font-weight: bold;
            color: #202d45;
            min-width: 180px;
        }

        .summary-value {
            font-weight: bold;
            color: #e91b31;
        }

        .summary-icon {
            margin-right: 8px;
            color: #60B5FF;
        }

        @media print {
            body {
                margin: 0.5cm;
                font-size: 10pt;
            }

            .first-page-content {
                page-break-after: avoid;
            }

            .area-group {
                page-break-after: auto;
                page-break-inside: avoid;
                margin-bottom: 15px;
            }

            table {
                page-break-inside: auto;
                margin-bottom: 10px;
            }

            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="first-page-content">
        <div class="header-container">
            <div class="login-brand">
                <img src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>" alt="SA Group Logo" class="logo-img">
                <div>
                    <span class="SA">SA</span> <span class="GROUP">GROUP</span>
                </div>
            </div>
        </div>

        <h1>LAPORAN JURNAL ITEM PER AREA</h1>

        <div class="summary">
            <div class="summary-title">📊 Ringkasan Laporan</div>
            <div class="summary-item">
                <span class="summary-icon">📍</span>
                <span class="summary-label">Total Area:</span>
                <span class="summary-value"><?php echo $total_areas; ?> area</span>
            </div>
            <div class="summary-item">
                <span class="summary-icon">📝</span>
                <span class="summary-label">Total Transaksi:</span>
                <span class="summary-value"><?php echo $total_items; ?> transaksi</span>
            </div>
        </div>
    </div>

    <?php
    $first_group = true;
    foreach ($grouped_data as $area_code => $area_data):
    ?>
        <div class="area-group <?php echo $first_group ? 'first-group' : ''; ?>">
            <h2>AREA: <?php echo $area_data['nama_area']; ?></h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jenis Transaksi</th>
                        <th>Item</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Satuan</th>
                        <th>Departemen</th>
                        <th>Ruangan</th>
                        <th>Lokasi</th>
                        <th>Jumlah</th>
                        <th>IN/OUT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($area_data['items'] as $index => $item): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $item->KODE_TRANSAKSI; ?></td>
                            <td><?php echo date('d-m-Y H:i', strtotime($item->TANGGAL_TRANSAKSI)); ?></td>
                            <td><?php echo $item->JENIS_TRANSAKSI; ?></td>
                            <td><?php echo $item->NAMA_ITEM; ?></td>
                            <td><?php echo $item->KATEGORI; ?></td>
                            <td><?php echo $item->KETERANGAN_ITEM ?: '-'; ?></td>
                            <td><?php echo $item->SATUAN; ?></td>
                            <td><?php echo $item->NAMA_DEPARTEMEN; ?></td>
                            <td><?php echo $item->NAMA_RUANGAN; ?></td>
                            <td><?php echo $item->NAMA_LOKASI; ?></td>
                            <td><?php echo $item->JUMLAH; ?></td>
                            <td><?php echo $item->IN_OUT; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php $first_group = false; ?>
    <?php endforeach; ?>
</body>

</html>