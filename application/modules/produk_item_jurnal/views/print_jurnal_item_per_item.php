<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Jurnal Produk per Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c7be5;
            --secondary-color: #f0f4f8;
            --accent-color: #e5f0ff;
            --text-color: #333;
            --border-color: #e0e0e0;
            --success-color: #28a745;
            --danger-color: #dc3545;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            margin: 40px;
            color: var(--text-color);
            background-color: #f8fafc;
            line-height: 1.5;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            color: var(--primary-color);
            font-weight: 600;
            padding: 10px;
            background-color: var(--secondary-color);
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .tanggal-cetak {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
            color: #666;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: var(--border-color);
            margin: 20px 0;
        }

        table.info {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        table.info tr td:first-child {
            width: 150px;
            white-space: nowrap;
            padding-right: 5px;
            font-weight: 600;
            color: var(--primary-color);
        }

        table.info td {
            padding: 8px 5px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        table.info td:nth-child(3) {
            font-weight: 500;
        }

        .foto-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
        }

        .foto-img {
            width: 120px;
            height: 90px;
            object-fit: contain;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 5px;
            background-color: white;
        }

        table.laporan {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
            margin-top: 20px;
            border-radius: 6px;
            overflow: hidden;
            border: 0px solid #000;
            /* Ubah di sini */
        }

        table.laporan th {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 8px;
            text-align: center;
            font-weight: 600;
            position: sticky;
            top: 0;
            border: 0px solid #000;
            /* Tambahkan ini */
        }

        table.laporan td {
            border: 0px solid #000;
            /* Ubah di sini */
            padding: 10px 8px;
            text-align: center;
            background-color: white;
        }

        table.laporan tr:nth-child(even) td {
            background-color: var(--secondary-color);
        }

        table.laporan tr:hover td {
            background-color: var(--accent-color);
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 13px;
            padding: 15px;
            background-color: white;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .footer span {
            color: var(--primary-color);
            font-weight: 600;
        }

        .icon {
            margin-right: 5px;
            color: var(--primary-color);
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-in {
            background-color: #e6f7eb;
            color: var(--success-color);
            border: 1px solid #c3e6cb;
        }

        .badge-out {
            background-color: #fce8e8;
            color: var(--danger-color);
            border: 1px solid #f5c6cb;
        }

        .stok-info {
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>

<body>

    <h2><i class="fas fa-clipboard-list icon"></i>LAPORAN JURNAL PRODUK PER ITEM</h2>
    <div class="tanggal-cetak"><i class="far fa-calendar-alt icon"></i>Tanggal Cetak: <?php echo date('d/m/Y H:i:s'); ?></div>

    <hr>

    <table class="info">
        <tr>
            <td><i class="fas fa-barcode icon"></i>Kode Item</td>
            <td>:</td>
            <td><?php echo $kode_item; ?></td>
            <td rowspan="6">
                <div class="foto-container">
                    <img src="<?php echo $foto_item; ?>" alt="Foto Item" class="foto-img" onerror="this.src='https://via.placeholder.com/120x90?text=No+Image'">
                </div>
            </td>
        </tr>
        <tr>
            <td><i class="fas fa-tag icon"></i>Nama Item</td>
            <td>:</td>
            <td><?php echo $nama_item; ?></td>
        </tr>
        <tr>
            <td><i class="fas fa-layer-group icon"></i>Kategori</td>
            <td>:</td>
            <td><?php echo $kategori; ?></td>
        </tr>
        <tr>
            <td><i class="fas fa-info-circle icon"></i>Keterangan</td>
            <td>:</td>
            <td><?php echo $keterangan_item; ?></td>
        </tr>
        <tr>
            <td><i class="fas fa-balance-scale icon"></i>Satuan</td>
            <td>:</td>
            <td><?php echo $satuan; ?></td>
        </tr>
        <tr>
            <td><i class="fas fa-boxes icon"></i>Stok Akhir</td>
            <td>:</td>
            <td class="stok-info">
                <?php
                echo $stok_akhir;
                if ($stok_akhir > 0) {
                    echo '<span class="badge badge-in"><i class="fas fa-check"></i> Tersedia</span>';
                } else {
                    echo '<span class="badge badge-out"><i class="fas fa-exclamation"></i> Habis</span>';
                }
                ?>
            </td>
        </tr>
    </table>

    <table class="laporan">
        <thead>
            <tr>
                <th><i class="fas fa-hashtag icon"></i>No</th>
                <th><i class="fas fa-qrcode icon"></i>Kode Transaksi</th>
                <th><i class="far fa-calendar-alt icon"></i>Tanggal</th>
                <th><i class="fas fa-exchange-alt icon"></i>Jenis</th>
                <th><i class="fas fa-map-marker-alt icon"></i>Area</th>
                <th><i class="fas fa-building icon"></i>Departemen</th>
                <th><i class="fas fa-door-open icon"></i>Ruangan</th>
                <th><i class="fas fa-location-arrow icon"></i>Lokasi</th>
                <th><i class="fas fa-cubes icon"></i>Jumlah</th>
                <th><i class="fas fa-arrows-alt-h icon"></i>In/Out</th>
                <th><i class="fas fa-boxes icon"></i>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($transaksi)) {
                $no = 1;
                foreach ($transaksi as $row) {
                    echo '<tr>';
                    echo '<td>' . $no . '</td>';
                    echo '<td>' . $row->KODE_TRANSAKSI . '</td>';
                    echo '<td>' . date('d/m/Y', strtotime($row->TANGGAL_TRANSAKSI)) . '</td>';
                    echo '<td>' . $row->JENIS_TRANSAKSI . '</td>';
                    echo '<td>' . $row->NAMA_AREA . '</td>';
                    echo '<td>' . $row->NAMA_DEPARTEMEN . '</td>';
                    echo '<td>' . $row->NAMA_RUANGAN . '</td>';
                    echo '<td>' . $row->NAMA_LOKASI . '</td>';
                    echo '<td>' . $row->JUMLAH . '</td>';
                    echo '<td><span class="badge ' . ($row->IN_OUT == 'IN' ? 'badge-in' : 'badge-out') . '">';
                    echo ($row->IN_OUT == 'IN' ? '<i class="fas fa-arrow-down"></i> ' : '<i class="fas fa-arrow-up"></i> ');
                    echo $row->IN_OUT . '</span></td>';
                    echo '<td>' . $row->JUMLAH_STOK . '</td>';
                    echo '</tr>';
                    $no++;
                }
            } else {
                echo '<tr><td colspan="11" class="no-data"><i class="fas fa-info-circle"></i> Tidak ada data transaksi</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh: <span><?php echo $_SESSION['nama_user'] ?? 'System'; ?></span><br>
        <i class="fas fa-building icon"></i>SA GROUP - <?php echo date('Y'); ?>
    </div>

</body>

</html>