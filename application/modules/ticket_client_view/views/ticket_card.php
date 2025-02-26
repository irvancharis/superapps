<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ticket_card.css'); ?>">
</head>

<body>
    <div class="cardWrap">
        <div class="card cardLeft">
            <h1>Ticket <span>Anda</span></h1>
            <div class="title">
                <h2><?php echo $ticket->REQUESTBY; ?></h2>
                <span>Direquest oleh</span>
            </div>
            <div class="name">
                <h2><?php echo $ticket->NAME_TECHNICIAN; ?> (Teknisi)</h2>
                <span>Ditangani oleh</span>
            </div>
            <div class="seat">
                <h2><?php echo date('d-m-Y'); ?></h2>
                <span>Tanggal</span>
            </div>
            <div class="time">
                <h2><?php echo date('H:i'); ?></h2>
                <span>Waktu</span>
            </div>
        </div>
        <div class="card cardRight">
            <img class="eye" src="<?php echo base_url('assets/img/Logo SA X7.png'); ?>" alt="">
            <div class="number">
                <h3>156</h3>
                <span>seat</span>
            </div>
            <div class="barcode"></div>
        </div>

    </div>

</body>

</html>