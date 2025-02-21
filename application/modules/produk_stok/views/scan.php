<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: black;
        }
        #reader {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

    <div id="reader"></div>

    <form id="scanForm" method="post">
        <input type="hidden" name="qr_code" id="qr_code">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function onScanSuccess(decodedText) {
                window.location.href = "<?php echo base_url('produk_stok/produk_aset_histori/') ?>" + decodedText;
            }

            function onScanError(errorMessage) {
                console.warn("QR Scan Error: ", errorMessage);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
                fps: 10,
                qrbox: { width: window.innerWidth, height: window.innerHeight }
            });

            html5QrcodeScanner.render(onScanSuccess, onScanError);
        });
    </script>

</body>
</html>
