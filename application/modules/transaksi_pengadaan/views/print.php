<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Departemen</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        FONT-SIZE: 14px;
    }

    .container {
        margin: auto;
        padding: 20px;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        height: 80px;
    }

    .header span {
        font-size: 30px;
        font-weight: bold;
        flex-grow: 1;
        /*text memenuhi area tengah*/
        text-align: center;
    }

    .logo {
        width: 100px;
        /* Sesuaikan ukuran logo */
        margin-right: 10px;
        /* Beri jarak antara logo dan teks */
    }

    .sub-header {
        text-align: left;
        font-size: 18px;
        font-weight: bold;
        border-top: 2px solid #000;
        padding-top: 20px;
    }

    .info {
        margin-top: 10px;
    }

    thead {
        background-color: #16121233;
        /*warna baris*/
        color: black;
        /*teks warna */
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    .tanggal {
        margin-top: 20px;
        text-align: right;
    }

    .signature-container {
        display: flex;
        justify-content: space-between;
        /* Rata kiri, tengah, kanan */
        width: 100%;
        margin-top: 20px;
    }

    .signature {
        display: flex;
        flex-direction: column;
        /* Teks di atas, garis di bawah */
        align-items: center;
        text-align: center;
    }

    .line {
        width: 100px;
        /* Panjang garis */
        margin-top:120px;
        border-bottom: 1px solid rgb(221, 221, 221);
        /* Garis bawah */
        
        /* Jarak antara teks dan garis */
    }

    .tembusan {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <span><?php echo $transaksi->NAMA_AREA; ?></span>
        </div>
        <div class="sub-header">PERMINTAAN DEPARTEMEN (PD) :</div>
        <div class="info">
            <p><strong>Kepada Yth :</strong> DIVISI PRASARANA</p>
            <p><strong>No. PD :</strong> <?php echo $transaksi->UUID_TRANSAKSI_PENGADAAN; ?></p>
            <p><strong>Tanggal :</strong> <?php echo date('d/m/Y',strtotime($transaksi->TANGGAL_PENGAJUAN)); ?></p>
        </div>
        <p>Kami Pesan Barang-barang Di bawah ini:</p>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Spesifikasi</th>
                    <th>Satuan</th>
                    <th>Jml</th>
                    <th>Tgl Pemakaian</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($detail as $row) {
                    ?>
                <tr>
                    <td><?php echo $row->NAMA_PRODUK; ?></td>
                    <td><?php echo $row->KETERANGAN_PRODUK; ?></td>
                    <td><?php echo $row->SATUAN; ?></td>
                    <td><?php echo $row->JUMLAH_PENGADAAN; ?></td>
                    <td><?php echo date('d/m/Y',strtotime($transaksi->TANGGAL_PENGAJUAN)); ?></td>
                    <td><?php echo $row->KEPERLUAN; ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="tanggal">
            <p><strong>Malang, <?php echo date('d/m/Y',strtotime($transaksi->TANGGAL_PENGAJUAN)); ?></strong></p>
        </div>
        <div class="signature-container">
            <div class="signature">
                <span>User: </span>
                <div class="line"></div>
                <span><?php echo $transaksi->NAMA_USER_PENGAJUAN; ?></span>
                
            </div>
            <div class="signature">
                <span>Mengetahui: </span>
                <div class="line"></div>
                <span><?php echo $transaksi->NAMA_APROVAL_GM; ?></span>
            </div>
            <div class="signature">
                <span>Menyetujui:</span>
                <div class="line"></div>
                <span><?php echo $transaksi->NAMA_APROVAL_HEAD; ?></span>
            </div>
            <div class="signature">
                <span>Penerima Order:</span>
                <div class="line"></div>
                <span><?php echo $transaksi->NAMA_USER_PENGADAAN; ?></span>
            </div>
        </div>        
    </div>
</body>

</html>

<script>
    window.print();
</script>