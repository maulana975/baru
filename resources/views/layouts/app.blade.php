<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - GoldTicket</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('images/GoldTicket.png') }}" type="image/png">
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar.scrolled {
            background-color: #000 !important;
            transition: background-color 300ms ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar {
            background-color: transparent !important;
            transition: background-color 300ms ease;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .nav-link {
            font-weight: 500;
            margin: 0 8px;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset("images/kyoto.jpg") }}') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

        .hero-content {
            text-align: center;
            max-width: 900px;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .service-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
        }

        .icon-circle {
            display: inline-flex;
            width: 70px;
            height: 70px;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .destination-card {
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }

        .destination-card .card-img-top {
            height: 250px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
        }

        .badge-price {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1rem;
            padding: 0.5em 0.8em;
            background-color: var(--primary-color);
        }

        .section-padding {
            padding: 80px 0;

                section {
                    margin: 0;
                }
        }

        .testimonial-card {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            position: relative;
        }

        .testimonial-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }

        .footer {
            background-color: #1a1a1a;
            color: #e0e0e0;
            padding: 50px 0 20px;

                .footer {
                    background-color: #1a1a1a;
                    color: #e0e0e0;
                    padding: 50px 0 0;
                    margin: 0;
                }
        }

        .footer h5,
        .footer h6 {
            color: #ffffff;
            font-weight: 600;
        }

        .footer p {
            color: #d0d0d0;
            line-height: 1.8;
        }

        .footer a {
            color: #d0d0d0;
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .footer a:hover {
            color: #007bff;
        }

        .footer ul li a {
            color: #d0d0d0;
        }

        .footer ul li a:hover {
            color: #007bff;
        }

        .footer hr {
            border-color: #333 !important;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid #ccc;
            transition: all 0.3s ease;
            color: #ccc;
        }

        .social-icon:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .alert {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        body.loaded #preloader {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
    </style>

    @yield('styles')
</head>
<body>
    <div id="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-compass-fill me-2"></i>
                <span>GoldTicket</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('packages.index') }}">Paket</a>
                    </li>
                    
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('my-bookings') }}">Pemesanan Saya</a>
                        </li>
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i>Admin
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Sukses!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            <strong>Error!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer m-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-4 mb-4">
                    <h5 class="text-white mb-3">
                        <i class="bi bi-compass-fill me-2"></i> GoldTicket
                    </h5>
                    <p class="text-light">
                        Agensi perjalanan yang berdedikasi untuk menciptakan pengalaman liburan tak terlupakan yang dirancang khusus untuk Anda.
                    </p>
                    <div class="mt-3">
                        <a href="#" class="social-icon me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon me-2"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon me-2"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-md-3 col-lg-2 mb-4">
                    <h6 class="text-white fw-bold mb-3">Link Cepat</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-light text-decoration-none">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('packages.index') }}" class="text-light text-decoration-none">Paket</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                        @auth
                        <li class="mb-2"><a href="{{ route('my-bookings') }}" class="text-light text-decoration-none">Pemesanan Saya</a></li>
                        @endauth
                    </ul>
                </div>

                <div class="col-md-3 col-lg-3 mb-4">
                    <h6 class="text-white fw-bold mb-3">Hubungi Kami</h6>
                    <p class="text-light mb-2"><i class="bi bi-geo-alt-fill me-2"></i> Jember, Indonesia</p>
                    <p class="text-light mb-2"><i class="bi bi-envelope-fill me-2"></i> <a href="mailto:maulanarifai334@gmail.com" class="text-light text-decoration-none">maulanarifai334@gmail.com</a></p>
                    <p class="text-light mb-0"><i class="bi bi-telephone-fill me-2"></i> <a href="tel:085236328522" class="text-light text-decoration-none">085236328522</a></p>
                </div>

                <div class="col-md-3 col-lg-3 mb-4">
                    <h6 class="text-white fw-bold mb-3">Kebijakan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Syarat & Ketentuan</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Kebijakan Privasi</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Kebijakan Pembatalan</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-light mb-0">&copy; 2025 GoldTicket.com - Semua Hak Dilindungi. Designed by GoldTicket</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-light mb-0">
                        <small>
                            <a href="#" class="text-light text-decoration-none">Back to Top</a>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener("scroll", function () {
            const navbar = document.getElementById("navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });

        // Preloader
        window.addEventListener("load", function () {
            document.body.classList.add("loaded");
        });

        // Back to Top
        document.querySelectorAll('a[href="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
