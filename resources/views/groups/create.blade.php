<!-- resources/views/groups/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group</title>
</head>
<body>
    <h2>Create a Group</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('group.store') }}" method="post">
        @csrf
        <label for="name">Group Name:</label>
        <input type="text" id="name" name="name" required>
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Create Group</button>
    </form>
</body>
</html>
