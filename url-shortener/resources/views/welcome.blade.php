<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener - Modern & Fast</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            color: #f8fafc;
        }
        .main-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border: none;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
            color: white;
        }
        .custom-input {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            border-radius: 12px !important;
            padding: 14px 18px;
        }
        .custom-input:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: #6366f1;
            color: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.25);
        }
        .custom-input::placeholder {
            color: #94a3b8;
        }
        .result-box {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 14px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3">

    <div class="container" style="max-width: 650px;">
        <!-- Header Navigation -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0 fw-bold text-white d-flex align-items-center gap-2">
                <i class="bi bi-link-45deg text-primary fs-3"></i> URL Shortener
            </h4>
            <a href="{{ route('url.dashboard') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
            </a>
        </div>

        <!-- Main Card -->
        <div class="main-card p-4 p-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Shorten Your Long Link</h2>
                <p class="text-secondary small">Paste your long URL below to generate a short, clean link instantly.</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 text-start mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('url.shorten') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="url" name="long_url" class="form-control custom-input" placeholder="https://example.com/very-long-url-path" required>
                </div>
                <button type="submit" class="btn btn-gradient w-100 py-3 rounded-3 fs-6">
                    Shorten URL <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>

            <!-- Result Box -->
            @if (session('short_url'))
                <div class="result-box p-3 mt-4 text-center">
                    <p class="text-success mb-1 small fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Link Shortened Successfully!</p>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <a href="{{ session('short_url') }}" target="_blank" class="fw-bold text-white fs-5 text-decoration-none">
                            {{ session('short_url') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

</body>
</html>