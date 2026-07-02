<!DOCTYPE html>
<html>
<head>
    <title>CSR Report Uploaded</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1a1c1b; background-color: #f9f9f6; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; border: 1px solid #eeeeeb;">
        <h2 style="color: #002b26; margin-top: 0;">New CSR Report Uploaded</h2>
        <p>Dear Partner,</p>
        <p>We have successfully uploaded the CSR/Impact report for your project: <strong>{{ $project->activity->name }}</strong>.</p>
        
        <p>You can now download the PDF report and view updated photos in the workspace dashboard.</p>
        
        <p style="margin-top: 25px;">
            <a href="{{ url('/dashboard') }}" style="background-color: #002b26; color: #ffffff; padding: 12px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">
                Download Report Now
            </a>
        </p>
        
        <p style="margin-top: 25px;">Best regards,<br/><strong>Fun Smart Foundation Operations</strong></p>
    </div>
</body>
</html>
