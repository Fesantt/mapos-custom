<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilize o botão flutuante */
        #floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 20%;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #scanner-container {
            display: none;
        }
    </style>
    <title>QR Code Reader</title>
    <!-- Inclua a biblioteca instascan.js -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>

    <button id="floating-button">Scan QR Code</button>
    <div id="scanner-container">
        <video id="scanner"></video>
    </div>
    <script>
        document.getElementById('floating-button').addEventListener('click', function() {
            let scanner = new Instascan.Scanner({ video: document.getElementById('scanner') });
            scanner.addListener('scan', function (content) {
                // Redireciona para o link contido no código QR
                window.location.href = content;
            });
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    document.getElementById('scanner-container').style.display = 'block';
                } else {
                    console.error('Nenhuma câmera encontrada.');
                }
            });
        });
    </script>
</body>
</html>
