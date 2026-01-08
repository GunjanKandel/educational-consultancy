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
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: bold;
            margin: 10px 0;
        }
        .status-approved {
            background: #10B981;
            color: white;
        }
        .status-rejected {
            background: #EF4444;
            color: white;
        }
        .status-reviewing {
            background: #F59E0B;
            color: white;
        }
        .status-pending {
            background: #6B7280;
            color: white;
        }
        .status-document_required {
            background: #3B82F6;
            color: white;
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
            <h2>Application Status Update</h2>
        </div>
        <div class="content">
            <p>Dear {{ $application->full_name }},</p>
            
            <p>Your application status has been updated.</p>
            
            <div class="info-box">
                <p><strong>Application Number:</strong> {{ $application->application_number }}</p>
                <p><strong>Course:</strong> {{ $application->course->name }}</p>
                <p><strong>Country:</strong> {{ $application->country->name }}</p>
                <p>
                    <strong>Status:</strong> 
                    <span class="status-badge status-{{ $application->status }}">
                        {{ ucwords(str_replace('_', ' ', $application->status)) }}
                    </span>
                </p>
            </div>
            
            @if($application->admin_notes)
            <div style="background: white; padding: 15px; border-left: 4px solid #4F46E5; margin: 20px 0;">
                <p><strong>Admin Notes:</strong></p>
                <p>{{ $application->admin_notes }}</p>
            </div>
            @endif
            
            @if($application->status === 'approved')
            <p style="color: #10B981;"><strong>Congratulations! Your application has been approved.</strong></p>
            <p>Our team will contact you shortly with the next steps.</p>
            @elseif($application->status === 'document_required')
            <p style="color: #3B82F6;"><strong>Additional documents are required.</strong></p>
            <p>Please submit the required documents at your earliest convenience.</p>
            @elseif($application->status === 'rejected')
            <p style="color: #EF4444;">We regret to inform you that your application was not successful at this time.</p>
            @endif
            
            <p>If you have any questions, please contact us.</p>
            
            <p>Best regards,<br>Educational Consultancy Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Educational Consultancy. All rights reserved.</p>
        </div>
    </div>
</body>
</html>