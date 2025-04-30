<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Jurnal Produk per Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }

        .info-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .info-item {
            flex: 1;
            min-width: 200px;
            margin-bottom: 10px;
        }

        .info-item strong {
            display: inline-block;
            width: 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .item-photo {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN JURNAL PRODUK PER ITEM</h1>
        <p>Tanggal Cetak: <?= date('d/m/Y H:i:s') ?></p>
    </div>

    <div class="info-box">
        <div class="info-item">
            <strong>Kode Item:</strong> <?= $kode_item ?>
        </div>
        <div class="info-item">
            <strong>Nama Item:</strong> <?= $nama_item ?>
        </div>
        <div class="info-item">
            <strong>Kategori:</strong> <?= $kategori ?>
        </div>
        <div class="info-item">
            <strong>Satuan:</strong> <?= $satuan ?>
        </div>
    </div>

    <div class="info-box">
        <div class="info-item">
            <strong>Area:</strong> <?= $area ?>
        </div>
        <div class="info-item">
            <strong>Departemen:</strong> <?= $departemen ?>
        </div>
        <div class="info-item">
            <strong>Ruangan:</strong> <?= $ruangan ?>
        </div>
        <div class="info-item">
            <strong>Lokasi:</strong> <?= $lokasi ?>
        </div>
    </div>

    <?php if ($foto_item): ?>
        <div style="text-align: center; margin: 15px 0;">
            <img src="<?= $foto_item ?>" class="item-photo">
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Jenis Transaksi</th>
                <th>Jumlah</th>
                <th>IN/OUT</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stok_akhir = 0;
            if (!empty($transaksi)):
                foreach ($transaksi as $index => $item):
                    // Hitung stok akhir
                    if ($item->IN_OUT == 'IN') {
                        $stok_akhir += $item->JUMLAH;
                    } else {
                        $stok_akhir -= $item->JUMLAH;
                    }
            ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= $item->KODE_TRANSAKSI ?></td>
                        <td><?= $item->TANGGAL_TRANSAKSI ?></td>
                        <td><?= $item->JENIS_TRANSAKSI ?></td>
                        <td class="text-right"><?= $item->JUMLAH ?></td>
                        <td class="text-center">
                            <span class="badge <?= $item->IN_OUT == 'IN' ? 'badge-success' : 'badge-danger' ?>">
                                <?= $item->IN_OUT ?>
                            </span>
                        </td>
                        <td class="text-right"><?= $stok_akhir ?></td>
                    </tr>
                <?php
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data transaksi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: <?= $this->session->userdata('NAMA_KARYAWAN') ?></p>
        <p>SA GROUP</p>
    </div>

    <script>
        // Cetak otomatis saat halaman selesai dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>