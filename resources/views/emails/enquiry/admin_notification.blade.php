<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enquiry Message</title>
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
            background-color: #3b82f6; /* Blue for Admin */
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
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
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
                    <!-- Using white background for logo visibility on blue -->
                    <img src="{{ $data['logo_url'] }}" alt="Logo" class="logo" style="margin-bottom: 20px;">
                @endif
                <h1>New Enquiry Message</h1>
            </div>

            <div class="email-body">
                <p class="greeting">Hello Admin,</p>
                
                <p>You have received a new enquiry message from the website.</p>

                <div class="message-box">
                    <h3 style="margin-top: 0; font-size: 16px; color: #374151; margin-bottom: 16px;">Details</h3>
                    <table class="details-table">
                        <tr>
                            <td class="label">Name:</td>
                            <td class="value">{{ $data['e_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="label">Email:</td>
                            <td class="value">{{ $data['e_email'] }}</td>
                        </tr>
                        <tr>
                            <td class="label">Phone:</td>
                            <td class="value">{{ $data['e_phone'] ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Check in date :</td>
                            <td class="value">{{ $data['e_in_date'] ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Checkout date :</td>
                            <td class="value">{{ $data['e_out_date'] ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Room Type:</td>
                            <td class="value">{{ $data['e_r_type'] ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Number of Adults:</td>
                            <td class="value">{{ $data['e_no_adults'] ?? 'N/A' }}</td>
                        </tr>
                        @if(!empty($data['e_no_children']))
                            <tr>
                                <td class="label">Number of Children:</td>
                                <td class="value">{{ $data['e_no_children'] }}</td>
                            </tr>
                        @endif

                        @if(!empty($data['e_desc']))
                            <tr>
                                <td class="label">Special Requests:</td>
                                <td class="value">{{ $data['e_desc'] }}</td>
                            </tr>
                        @endif


                    </table>
                </div>

               
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
