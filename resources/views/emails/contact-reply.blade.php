<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reply to Your Inquiry</h2>
        </div>
        <div class="content">
            <p>Dear {{ $contact->name }},</p>
            
            <p>Thank you for contacting us. Here is our reply to your inquiry:</p>
            
            <div style="background: white; padding: 15px; border-left: 4px solid #4F46E5; margin: 20px 0;">
                {{ $contact->admin_reply }}
            </div>
            
            <p><strong>Your Original Message:</strong></p>
            <p>{{ $contact->message }}</p>
            
            <p>If you have any further questions, please don't hesitate to contact us.</p>
            
            <p>Best regards,<br>Educational Consultancy Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Educational Consultancy. All rights reserved.</p>
        </div>
    </div>
</body>
</html>