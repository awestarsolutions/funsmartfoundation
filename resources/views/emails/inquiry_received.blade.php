<!DOCTYPE html>
<html>
<head>
    <title>Inquiry Received</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1a1c1b; background-color: #f9f9f6; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; border: 1px solid #eeeeeb;">
        <h2 style="color: #002b26; margin-top: 0;">Hello {{ $data['name'] }},</h2>
        <p>Thank you for reaching out to Fun Smart Foundation. We have received your inquiry and our team will get back to you shortly.</p>
        
        <h3 style="color: #002b26; border-bottom: 1px solid #eeeeeb; padding-bottom: 8px;">Inquiry Details</h3>
        <p style="margin: 5px 0;"><strong>Name:</strong> {{ $data['name'] }}</p>
        <p style="margin: 5px 0;"><strong>Email:</strong> {{ $data['email'] }}</p>
        <p style="margin: 5px 0;"><strong>Phone:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
        <p style="margin: 5px 0;"><strong>Company:</strong> {{ $data['company_name'] ?? 'N/A' }}</p>
        <p style="margin: 5px 0;"><strong>Message:</strong></p>
        <p style="background-color: #f4f4f1; padding: 15px; border-radius: 8px; font-style: italic; margin-top: 5px;">{{ $data['message'] }}</p>
        
        <p style="margin-top: 25px;">Best regards,<br/><strong>Fun Smart Foundation Team</strong></p>
    </div>
</body>
</html>
