<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Received</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #1f2937;
            line-height: 1.6;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 40px 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .email-header {
            background-color: #ffffff;
            padding: 30px 40px;
            text-align: center;
            border-bottom: 1px solid #f3f4f6;
        }
        .logo {
            height: 80px;
            width: auto;
            object-fit: contain;
        }
        .email-hero {
            background-color: #10b981;
            padding: 40px;
            text-align: center;
            color: #ffffff;
        }
        .email-hero h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.025em;
        }
        .email-body {
            padding: 40px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #111827;
        }
        .message-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin: 24px 0;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .label {
            color: #6b7280;
            font-weight: 500;
            width: 30%;
        }
        .value {
            color: #1f2937;
            font-weight: 600;
        }
        .user-message {
            font-style: italic;
            color: #4b5563;
            border-left: 4px solid #10b981;
            padding-left: 16px;
            margin-top: 16px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .social-links {
            margin-bottom: 20px;
        }
        .social-links a {
            color: #6b7280;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 500;
        }
        .social-links a:hover {
            color: #10b981;
        }
        @media (max-width: 600px) {
            .email-container { width: 100%; border-radius: 0; }
            .email-header, .email-body, .footer { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-hero">
                @if(!empty($data['logo_url']))
                    <img src="{{ $data['logo_url'] }}" alt="Logo" class="logo" style="margin-bottom: 20px;">
                @endif
                <h1>Thank You for Contacting Us -  Enquiry Received!</h1>
            </div>

            <div class="email-body">
                <p class="greeting">Hi {{ $data['name'] }},</p>
                
                <p>Greetings from Ceylon, Thank you for reaching out to us. We have received your enquiry and our team is reviewing the details. We will get back to you shortly with the required information.
                If you need any immediate assistance, please feel free to contact us on +91 75111 13333</p>

                 

                <p>Warm regards,</p>
                <p>Team Ceylon Hotels</p>

            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
