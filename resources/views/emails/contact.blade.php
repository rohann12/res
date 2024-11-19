<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <h1>Contact Form Submission</h1>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Organization Name:</strong> {{ $data['organization_name'] ?? 'N/A' }}</p>
    <p><strong>Message:</strong> {{ $data['message'] }}</p>
</body>
</html>
