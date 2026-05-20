<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ComfyKure Alerts Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="mb-0">🚨 ComfyKure Error Notification Recipients</h5>
                    </div>
                    <div class="card-body p-4">

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('comfykure-alerts/emails') }}" method="POST" class="row g-3 mb-4">
                            @csrf
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control form-control-lg" placeholder="developer@example.com" required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-dark btn-lg w-100">Add Email</button>
                            </div>
                        </form>

                        <hr>

                        <h6 class="text-muted mb-3">Active Notification List</h6>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Email Address</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($emails as $email)
                                        <tr>
                                            <td class="fw-bold">{{ $email->email }}</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td class="text-end">
                                                <form action="{{ url('comfykure-alerts/emails/'.$email->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">No emails registered yet. All system errors will be ignored!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
