<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Installation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Laravel Installation</h1>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('install.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="DB_HOST" class="form-label">Database Host</label>
                <input type="text" class="form-control" id="DB_HOST" name="DB_HOST" value="127.0.0.1" required>
            </div>
            <div class="mb-3">
                <label for="DB_PORT" class="form-label">Database Port</label>
                <input type="number" class="form-control" id="DB_PORT" name="DB_PORT" value="5432" required>
            </div>
            <div class="mb-3">
                <label for="DB_DATABASE" class="form-label">Database Name</label>
                <input type="text" class="form-control" id="DB_DATABASE" name="DB_DATABASE" required>
            </div>
            <div class="mb-3">
                <label for="DB_USERNAME" class="form-label">Database Username</label>
                <input type="text" class="form-control" id="DB_USERNAME" name="DB_USERNAME" required>
            </div>
            <div class="mb-3">
                <label for="DB_PASSWORD" class="form-label">Database Password</label>
                <input type="password" class="form-control" id="DB_PASSWORD" name="DB_PASSWORD">
            </div>
            <button type="submit" class="btn btn-primary">Install</button>
        </form>
    </div>
</body>
</html>
