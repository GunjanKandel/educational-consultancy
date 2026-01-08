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
        .info-box {
            background: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Inquiry</h2>
        </div>
        <div class="content">
            <p>A new contact inquiry has been submitted on the website.</p>
            
            <div class="info-box">
                <p><strong>Name:</strong> {{ $contact->name }}</p>
                <p><strong>Email:</strong> {{ $contact->email }}</p>
                <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                @if($contact->subject)
                <p><strong>Subject:</strong> {{ $contact->subject }}</p>
                @endif
                <p><strong>Submitted:</strong> {{ $contact->created_at->format('F d, Y h:i A') }}</p>
            </div>
            
            <p><strong>Message:</strong></p>
            <div style="background: white; padding: 15px; border-left: 4px solid #4F46E5; margin: 20px 0;">
                {{ $contact->message }}
            </div>
            
            <p>Please log in to the admin panel to reply to this inquiry.</p>
        </div>
    </div>
</body>
</html>