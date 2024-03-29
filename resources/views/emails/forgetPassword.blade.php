<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Josh Writer AI</title>
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

        .reset-link {
            font-size: 18px;
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
        <h1>Forgot Password - Josh Writer AI</h1>
        <p>Dear user, you've requested to reset your password for your Josh Writer AI account. <br> Here is your new auto
            generated password.</p>
        <a class="reset-link">{{ $password }}</a>
        <p>If you didn't request a password reset, please ignore this email.</p>
        <p class="company-name">Josh Writer AI - Your Partner in Content Creation</p>
    </div>
</body>

</html>
