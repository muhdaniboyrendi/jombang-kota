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