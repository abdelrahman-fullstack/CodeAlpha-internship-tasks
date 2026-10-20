<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Analytics</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
        }
        .dashboard-card {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .table-dark-custom {
            --bs-table-bg: transparent;
            --bs-table-color: #cbd5e1;
            border-color: rgba(255, 255, 255, 0.08);
        }
        .badge-clicks {
            background: rgba(99, 102, 241, 0.2);
            color: #818cf8;
            border: 1px solid rgba(99, 102, 241, 0.3);
            font-weight: 600;
        }
    </style>
</head>
<body class="py-5">

    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1"><i class="bi bi-speedometer2 text-primary me-2"></i>Analytics Dashboard</h3>
                <p class="text-secondary small mb-0">Overview of all generated short links and click metrics.</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4 fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Shorten New Link
            </a>
        </div>

        <!-- Analytics Table -->
        <div class="dashboard-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold m-0 text-white">All Short Links ({{ $urls->count() }})</h6>
            </div>

            <div class="table-responsive">
                <table class="table table-dark-custom align-middle">
                    <thead>
                        <tr class="text-secondary small">
                            <th scope="col">#</th>
                            <th scope="col">Original Long URL</th>
                            <th scope="col">Shortened URL</th>
                            <th scope="col">Clicks</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($urls as $index => $url)
                            <tr>
                                <th scope="row" class="text-secondary">{{ $index + 1 }}</th>
                                <td class="text-truncate" style="max-width: 280px;">
                                    <a href="{{ $url->long_url }}" target="_blank" class="text-secondary text-decoration-none" title="{{ $url->long_url }}">
                                        {{ $url->long_url }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ url($url->short_code) }}" target="_blank" class="fw-semibold text-primary text-decoration-none">
                                        {{ url($url->short_code) }} <i class="bi bi-box-arrow-up-right small ms-1"></i>
                                    </a>
                                </td>
                                <td>
                                    <span class="badge badge-clicks px-3 py-2 rounded-pill">
                                        <i class="bi bi-cursor-fill me-1"></i> {{ $url->clicks }}
                                    </span>
                                </td>
                                <td class="text-secondary small">{{ $url->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    No short links generated yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>