<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            text-align: center;
            padding: 20px 0;
            background-color: #007bff;
            color: white;
            margin: 0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .pagination {
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>

    <h1>Request Logs</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Request</th>
                <th>Response</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requestLogs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->request }}</td> {{-- Format as needed --}}
                    <td>{{ $log->response }}</td> {{-- Format as needed --}}
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $requestLogs->links() }} {{-- Pagination links --}}
    </div>

</body>
</html>
