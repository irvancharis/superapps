<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Check-up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 4px;
        background: #dee2e6;
        transform: translateX(-50%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 20px;
        width: 50%;
        padding: 10px 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        top: 20px;
        width: 15px;
        height: 15px;
        background: #0d6efd;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .timeline-item:nth-child(odd) {
        left: 0;
        text-align: right;
    }

    .timeline-item:nth-child(odd)::before {
        right: -12px;
    }

    .timeline-item:nth-child(even) {
        left: 50%;
        text-align: left;
    }

    .timeline-item:nth-child(even)::before {
        left: -12px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Histori Check-up</h2>
        <div class="timeline">
            <?php foreach ($histori_aset as $index => $d) : ?>
            <div class="timeline-item">
                <h5><?php echo $this->tanggalindo->formatTanggal($d->TANGGAL_TINDAKAN, 'l, d F Y'); ?></h5>
                <p><?php echo $d->KETERANGAN_TINDAKAN; ?></p>
                <p style="font-style: italic;"><?php echo $d->NAMA_USER_TINDAKAN; ?></p>
            </div>
            <?php endforeach; ?>            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>