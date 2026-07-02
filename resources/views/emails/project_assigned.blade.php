<!DOCTYPE html>
<html>
<head>
    <title>New Project Workspace Assigned</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1a1c1b; background-color: #f9f9f6; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; border: 1px solid #eeeeeb;">
        <h2 style="color: #002b26; margin-top: 0;">New Project Workspace Assigned</h2>
        <p>Dear Partner,</p>
        <p>We are excited to inform you that a new CSR project workspace has been set up and assigned to your organization on our partner portal.</p>
        
        <h3 style="color: #002b26; border-bottom: 1px solid #eeeeeb; padding-bottom: 8px;">Project Overview</h3>
        <p style="margin: 5px 0;"><strong>Project Name:</strong> {{ $project->activity->name }}</p>
        <p style="margin: 5px 0;"><strong>Execution Date:</strong> {{ $project->execution_date ? \Carbon\Carbon::parse($project->execution_date)->format('F d, Y') : 'TBD' }}</p>
        @if($project->coordinator_name)
            <p style="margin: 5px 0;"><strong>Coordinator:</strong> {{ $project->coordinator_name }} ({{ $project->coordinator_phone ?? 'N/A' }})</p>
        @endif
        
        <p style="margin-top: 25px;">
            <a href="{{ url('/dashboard') }}" style="background-color: #002b26; color: #ffffff; padding: 12px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">
                Access Partner Workspace
            </a>
        </p>
        
        <p style="margin-top: 25px;">Best regards,<br/><strong>Fun Smart Foundation Operations</strong></p>
    </div>
</body>
</html>
