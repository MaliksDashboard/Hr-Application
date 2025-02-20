<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badge PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .badge-preview {
            border: 2px solid black;
            padding: 20px;
            width: 300px;
            margin: auto;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .badge-preview-img {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .badge-preview-text {
            text-align: left;
        }

        .name {
            font-size: 22px;
            font-weight: bold;
            color: #00B7F1;
        }

        .title {
            font-size: 18px;
            color: #666;
        }

        .barcode {
            width: 150px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="badge-preview">
        <div class="badge-preview-img">
            <img src="{{ $logoBase64 }}" width="50px">
            <img src="{{ $barcodeImage }}" class="barcode" alt="Barcode">
        </div>
        <div class="badge-preview-text">
            <div class="name">{{ $shortName }}</div>
            <div class="title">{{ $title }}</div>
        </div>
    </div>
</body>

</html>
