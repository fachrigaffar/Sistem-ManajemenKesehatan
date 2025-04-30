<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik - Selamat Datang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
        }
        .header-nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 15px;
            display: flex;
            justify-content: flex-end;
        }
        .header-nav a, .header-nav form button {
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
        }
        .header-nav a:hover, .header-nav form button:hover {
            background-color: #e0e0e0;
        }
        .hero-section {
            background: linear-gradient(135deg, #007bff, #00d4ff);
            color: white;
            padding: 100px 0;
            text-align: center;
            border-radius: 0 0 0px 0px;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 20px auto;
        }
        .btn-login {
            background-color: #ffffff;
            color: #007bff;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #e0e0e0;
            color: #0056b3;
        }
        .profile-section {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }
        .profile-section h2 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .profile-section p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            .hero-section p {
                font-size: 1rem;
            }
            .header-nav {
                justify-content: center;
            }
            .header-nav a, .header-nav form button {
                padding: 6px 15px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header class="w-full">
        <div class="header-nav">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ Auth::user()->role === 'dokter' ? route('dokter') : route('pasien') }}"
                            class="inline-block px-5 py-1.5 text-[#1b1b18] border border-[#19140035] hover:bg-[#e0e0e0] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="inline-block px-5 py-1.5 text-[#1b1b18] border border-[#19140035] hover:bg-[#e0e0e0] rounded-sm text-sm leading-normal"
                            >
                                Logout
                            </button>
                        </form>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 text-[#1b1b18] border border-transparent hover:bg-[#e0e0e0] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 text-[#1b1b18] border border-[#19140035] hover:bg-[#e0e0e0] rounded-sm text-sm leading-normal"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>Selamat Datang di Poliklinik</h1>
            <p>Kami menyediakan layanan kesehatan terbaik dengan tenaga medis profesional untuk Anda dan keluarga.</p>
            <a href="{{ route('login') }}" class="btn btn-login">Login ke Dashboard</a>
        </div>
    </div>

    <!-- Profile Section -->
    <div class="profile-section">
        <h2>Tentang Poliklinik</h2>
        <p>
            Poliklinik adalah pusat layanan kesehatan yang berkomitmen untuk memberikan perawatan medis berkualitas tinggi. 
            Dengan tim dokter dan perawat berpengalaman, kami menawarkan berbagai layanan mulai dari konsultasi umum, 
            pemeriksaan kesehatan, hingga perawatan khusus. Misi kami adalah menjaga kesehatan Anda dengan pelayanan yang ramah 
            dan profesional.
        </p>
    </div>

    <!-- Bootstrap JS (Optional for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>