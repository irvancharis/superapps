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
            <strong>Kode Item:</strong> <span id="print-kode-item">-</span>
        </div>
        <div class="info-item">
            <strong>Nama Item:</strong> <span id="print-nama-item">-</span>
        </div>
        <div class="info-item">
            <strong>Kategori:</strong> <span id="print-kategori">-</span>
        </div>
        <div class="info-item">
            <strong>Satuan:</strong> <span id="print-satuan">-</span>
        </div>
    </div>

    <div class="info-box">
        <div class="info-item">
            <strong>Area:</strong> <span id="print-area">-</span>
        </div>
        <div class="info-item">
            <strong>Departemen:</strong> <span id="print-departemen">-</span>
        </div>
        <div class="info-item">
            <strong>Ruangan:</strong> <span id="print-ruangan">-</span>
        </div>
        <div class="info-item">
            <strong>Lokasi:</strong> <span id="print-lokasi">-</span>
        </div>
    </div>

    <div style="text-align: center; margin: 15px 0;">
        <img id="print-foto-item" src="" class="item-photo" style="display: none;">
    </div>

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
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody id="print-transaksi-body">
            <!-- Data transaksi akan diisi oleh JavaScript -->
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: <?= $this->session->userdata('NAMA_KARYAWAN') ?></p>
        <p>SA GROUP</p>
    </div>

    <script>
        // Fungsi ini akan diisi dengan data dari controller
        function fillPrintData(data) {
            // Isi informasi item
            document.getElementById('print-kode-item').textContent = data.kode_item || '-';
            document.getElementById('print-nama-item').textContent = data.nama_item || '-';
            document.getElementById('print-kategori').textContent = data.kategori || '-';
            document.getElementById('print-satuan').textContent = data.satuan || '-';

            // Isi informasi lokasi
            document.getElementById('print-area').textContent = data.area || '-';
            document.getElementById('print-departemen').textContent = data.departemen || '-';
            document.getElementById('print-ruangan').textContent = data.ruangan || '-';
            document.getElementById('print-lokasi').textContent = data.lokasi || '-';

            // Isi foto jika ada
            if (data.foto_item) {
                const fotoElement = document.getElementById('print-foto-item');
                fotoElement.src = data.foto_item;
                fotoElement.style.display = 'block';
            }

            // Isi data transaksi
            const tbody = document.getElementById('print-transaksi-body');
            tbody.innerHTML = '';

            if (data.transaksi && data.transaksi.length > 0) {
                let stokAkhir = 0;

                data.transaksi.forEach((item, index) => {
                    // Hitung stok akhir
                    if (item.in_out === 'IN') {
                        stokAkhir += parseInt(item.jumlah);
                    } else {
                        stokAkhir -= parseInt(item.jumlah);
                    }

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="text-center">${index + 1}</td>
                        <td>${item.kode_transaksi}</td>
                        <td>${item.tanggal_transaksi}</td>
                        <td>${item.jenis_transaksi}</td>
                        <td class="text-right">${item.jumlah}</td>
                        <td class="text-center">
                            <span class="badge ${item.in_out === 'IN' ? 'badge-success' : 'badge-danger'}">
                                ${item.in_out}
                            </span>
                        </td>
                        <td class="text-right">${stokAkhir}</td>
                        <td>${item.keterangan || '-'}</td>
                    `;
                    tbody.appendChild(row);
                });
            } else {
                const row = document.createElement('tr');
                row.innerHTML = '<td colspan="8" class="text-center">Tidak ada data transaksi</td>';
                tbody.appendChild(row);
            }

            // Cetak otomatis
            window.print();
        }
    </script>
</body>

</html>