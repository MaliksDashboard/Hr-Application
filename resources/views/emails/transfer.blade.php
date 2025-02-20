<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .email-container {
            max-width: 500px;
            background: #fff;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #28a745;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 15px;
            font-size: 15px;
        }

        .content p {
            margin: 5px 0;
        }

        .highlight {
            color: #28a745;
            font-weight: bold;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 13px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">Transfer Notification</div>

        <div class="content">
            <p>Dear Team,</p><br>
            <p>Please find attached the **Transfer Letter** for <span class="highlight">{{ $employeeName }}</span>,
                effective <span class="highlight">{{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}</span>.</p>
            <br>
            <p>Best regards,</p>
            <p><strong>HR Team</strong></p>
        </div>

        <div class="footer">
            This is an automated email from the HR system.
        </div>
    </div>
</body>

</html>
