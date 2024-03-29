<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Email Verification - Josh Writer AI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        .verification-code {
            font-size: 24px;
            color: #007BFF;
            margin: 20px 0;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .company-name {
            font-size: 18px;
            color: #999;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container" style="text-align: center;">
        <h1>Email Verification - Josh Writer AI</h1>
        <p>Thank you for signing up with Josh Writer AI. To complete your registration, please verify your email address
            by entering the following code:</p>
        <p class="verification-code">{{ $otp }}</p>
        <p>If you did not create an account or did not request this verification, please ignore this email.</p>
        <p class="company-name">Josh Writer AI - Your Partner in Content Creation</p>
    </div>
</body>

</html>
