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
            <h2>Application Received Successfully</h2>
        </div>
        <div class="content">
            <p>Dear {{ $application->full_name }},</p>
            
            <p>Thank you for submitting your application. We have received it successfully and our team will review it shortly.</p>
            
            <div class="info-box">
                <p><strong>Application Number:</strong> {{ $application->application_number }}</p>
                <p><strong>Course:</strong> {{ $application->course->name }}</p>
                <p><strong>Country:</strong> {{ $application->country->name }}</p>
                <p><strong>Submitted On:</strong> {{ $application->created_at->format('F d, Y') }}</p>
            </div>
            
            <p>Please save your application number for future reference. You can use it to track your application status.</p>
            
            <p><strong>Next Steps:</strong></p>
            <ul>
                <li>Our team will review your application within 3-5 business days</li>
                <li>We will contact you if we need any additional information</li>
                <li>You will receive an email notification when your application status changes</li>
            </ul>
            
            <p>If you have any questions, please don't hesitate to contact us.</p>
            
            <p>Best regards,<br>Educational Consultancy Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Educational Consultancy. All rights reserved.</p>
        </div>
    </div>
</body>
</html>