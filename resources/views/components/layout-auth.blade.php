<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    @livewireStyles

</head>
<body class="bg-secondary-subtle">

    {{ $slot }}

    @livewireScripts

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        let html5QrcodeScanner;

        function initializeScanner() {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: { width: 250, height: 250 } }
            );
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        function onScanSuccess(decodedText, decodedResult) {
            // Kirim hasil scan ke komponen Livewire
            Livewire.dispatch('qrCodeScanned', { qrCode: decodedText });
        }

        function onScanFailure(error) {
            console.warn(`QR code scanning failed: ${error}`);
        }

        document.addEventListener('livewire:init', () => {
            initializeScanner();

            Livewire.on('qrCodeScanned', () => {
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear();
                }
            });
        });
    </script>
</body>
</html>