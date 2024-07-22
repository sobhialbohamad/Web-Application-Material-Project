<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Report</title>
</head>
<body>
    <h1>File Report</h1>
    <p>File Name: {{ $file->filename }}</p>
    
    <p>Total Downloads: {{ $file->downloads }}</p>

    <!-- Additional report details and charts can be added here -->
</body>
</html>
