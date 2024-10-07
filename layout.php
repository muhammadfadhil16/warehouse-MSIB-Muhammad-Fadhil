<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Website' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="main.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            flex: 1;
        }

        .navbar {
            background-color: #F0F8FF;
        }
        .navbar .nav-item .nav-link {
            color: #333333;
        }

        .navbar .nav-item .nav-link:hover {
            color: #5F9EA0;
            transition: 0.3s;
        }

        .navbar .navbar-brand {
            color: #5F9EA0;
        }


        footer {
            width: 100% ;
            height: 30%;
            background-color: #5F9EA0;
            color: #fff;
            margin-top: auto;
        }

        footer h2 {
            margin-bottom: 20px; /* Jarak bawah untuk heading */
            color: white;
            text-align: justify;
        }

        footer p {
            margin-bottom: 15px;
        }

        .social-icons {
            list-style: none; /* Menghilangkan bullet point */
            padding: 0; /* Menghilangkan padding */
        }

        .social-icons li {
            display: inline; /* Menampilkan ikon dalam satu baris */
            margin: 0 10px; /* Jarak antar ikon */
        }

        .social-icons a {
            color: #fff; /* Warna ikon sosial */
            font-size: 20px; /* Ukuran ikon sosial */
            transition: color 0.3s; /* Efek transisi saat hover */
        }

        .social-icons a:hover {
            color: #d4af37; /* Warna saat hover */
        }

        
        .float-md-end {
            float: right !important;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark shadow p-3 mb-5 ">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#">
                    <i class="bi bi-box-seam"></i> Warehouse
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="view.php">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Create-warehouse.php">
                                 Tambah Warehouse
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view-data-warehouse.php">
                                 View Warehouse
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Page Content -->
    <div class="container-fluid w-120">
        <div class="content mt-5 pt-4">
            <?= $content ?>
        </div>
    </div>

    <footer style="background-color: #5F9EA0; color: #fff; padding: 40px 20px;text-align:right">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <h2 class="mb-3">Tentang Warehouse Kami</h2>
                <p style="text-align: justify; padding:0%">Selamat datang di sistem peminjaman ruangan Fakultas Teknik. Kami hadir untuk memudahkan Anda dalam melakukan pemesanan dan pengelolaan ruangan secara online. Dengan sistem ini, Anda dapat mengelola warehouse dengan efisien dan mendapatkan informasi terbaru mengenai status dan ketersediaan ruangan.</p>
            </div>
            <div class="col-md-6 mb-4">
                <h2 class="mb-3" style="text-align: right;">Ikuti Kami</h2>
                <ul class="list-inline social-icons">
                    <li class="list-inline-item">
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div style="background-color: #4E747E; padding: 20px 0; text-align:center">
        <p class="mb-0">&copy; <?= date("Y") ?> Warehouse Management System. All rights reserved.</p>
    </div>
</footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
