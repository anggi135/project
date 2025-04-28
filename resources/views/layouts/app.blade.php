<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CTD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .img-hover:hover {
            transform: scale(1.05);
            transition: 0.3s ease;
        }
        .image-container {
             max-width: 100%;
             height: auto;
            }
        .image-container img {
            width: 100%;
            height: auto;
            display: block;
        }
        
    </style>
</head>
<body>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white p-4 mt-5">
        <div class="container">
            <div class="text-center mt-3">
                <small>© 2025 Website Laravel</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
