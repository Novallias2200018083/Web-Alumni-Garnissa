<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* General Reset & Body Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f2f5 0%, #e0e7ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Main Container for Auth Forms */
        .auth-main-container {
            display: flex;
            width: 900px; /* DIUBAH: Diperkecil dari 900px */
            max-width: 90%; 
            min-height: 520px; /* DIUBAH: Diperkecil dari 580px */
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            flex-direction: row-reverse; 
        }

        /* Panel Kiri (Informasi/Welcome) */
        .panel-left {
            flex: 0.8; /* DIUBAH: Sedikit diperkecil agar panel kanan lebih dominan jika perlu */
            background: linear-gradient(135deg, #FFD700 0%, #FFC600 100%);
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px; /* DIUBAH: Padding disesuaikan */
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            top: -40px; /* Disesuaikan */
            right: -40px; /* Disesuaikan */
            width: 160px; /* Disesuaikan */
            height: 160px; /* Disesuaikan */
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            z-index: -1;
        }

        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -20px; /* Disesuaikan */
            left: -20px; /* Disesuaikan */
            width: 120px; /* Disesuaikan */
            height: 120px; /* Disesuaikan */
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: -1;
        }

        .panel-left h2 {
            font-size: 26px; /* Disesuaikan */
            font-weight: 700;
            margin-bottom: 12px; /* Disesuaikan */
            color: #333;
        }

        .panel-left p {
            font-size: 14px; /* Disesuaikan */
            line-height: 1.5;
            margin-bottom: 25px; /* Disesuaikan */
            max-width: 280px; /* Disesuaikan */
            color: #555;
        }

        .panel-left .action-button {
            background: transparent;
            border: 2px solid #333;
            color: #333;
            padding: 10px 25px; /* Disesuaikan */
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .panel-left .action-button:hover {
            background: #333;
            color: #FFD700;
        }

        /* Panel Kanan (Form) */
        .panel-right {
            flex: 1.2; /* DIUBAH: Memberi sedikit lebih banyak ruang relatif untuk form */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start; 
            padding: 30px 30px; /* DIUBAH: Padding disesuaikan */
            background-color: white;
            overflow-y: auto; 
        }

        .panel-right h2 {
            font-size: 26px; /* Disesuaikan */
            font-weight: 700;
            color: #333;
            margin-bottom: 20px; /* Disesuaikan */
            text-align: center;
        }

        .form-group {
            margin-bottom: 16px; /* Disesuaikan */
            width: 100%;
            max-width: 300px; /* Disesuaikan */
            position: relative;
        }
        
        .form-group.dropdown-container {
             margin-bottom: 16px; /* Disesuaikan */
        }


        .form-group input,
        .form-group select {
            width: 100%;
            padding: 11px 15px 11px 40px; /* Disesuaikan */
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            font-size: 13px; /* Disesuaikan */
            background-color: #f9f9f9;
            transition: all 0.3s ease;
            -webkit-appearance: none; 
            -moz-appearance: none;
            appearance: none;
        }
        
        .form-group select {
            padding-right: 40px; /* Disesuaikan */
            background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23888888%22%20d%3D%22M287%2C114.7L146.2%2C255.5L5.4%2C114.7c-7.2-7.2-7.2-18.9%2C0-26.1c7.2-7.2%2C18.9-7.2%2C26.1%2C0l114.7%2C114.7l114.7-114.7c7.2-7.2%2C18.9-7.2%2C26.1%2C0C294.2%2C95.8%2C294.2%2C107.5%2C287%2C114.7z%22%2F%3E%3C%2Fsvg%3E');
            background-repeat: no-repeat;
            background-position: right 12px center; /* Disesuaikan */
            background-size: 10px; /* Disesuaikan */
        }


        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #FFD700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            background-color: #fff;
        }

        .form-group .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            z-index: 2; 
            font-size: 0.9em; /* Disesuaikan ukuran ikon */
        }

        .submit-btn {
            width: 100%;
            max-width: 300px; /* Disesuaikan */
            padding: 12px 20px; /* Disesuaikan */
            background: linear-gradient(135deg, #FFD700 0%, #FFC600 100%);
            color: #333;
            border: none;
            border-radius: 50px;
            font-size: 14px; /* Disesuaikan */
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 198, 0, 0.3);
            margin-top: 8px; /* Disesuaikan */
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 198, 0, 0.4);
        }

        .social-login {
            margin-top: 18px; /* Disesuaikan */
            text-align: center;
            width: 100%;
            max-width: 300px; /* Disesuaikan */
        }

        .social-login p {
            color: #888;
            margin-bottom: 12px; /* Disesuaikan */
            font-size: 13px; /* Disesuaikan */
            position: relative;
        }

        .social-login p::before,
        .social-login p::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #e0e0e0;
        }

        .social-login p::before {
            left: 0;
        }

        .social-login p::after {
            right: 0;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 12px; /* Disesuaikan */
        }

        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px; /* Disesuaikan */
            height: 36px; /* Disesuaikan */
            border: 1px solid #e0e0e0;
            border-radius: 50%;
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9em; /* Disesuaikan ukuran ikon sosial */
        }

        .social-icons a:hover {
            border-color: #FFD700;
            color: #FFD700;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(255, 215, 0, 0.1);
        }

        .illustration {
            width: 150px; /* Disesuaikan */
            height: 150px; /* Disesuaikan */
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            margin-bottom: 20px; /* Disesuaikan */
        }

        .illustration.sitting-person {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23333"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>');
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px; /* Disesuaikan */
            margin-top: 4px; /* Disesuaikan */
            display: block;
            text-align: left; 
            padding-left: 5px; 
        }
        
        .form-wrapper { 
            width: 100%;
            max-width: 300px; /* Disesuaikan */
            display: flex;
            flex-direction: column;
            align-items: center; 
        }


        /* Responsive Adjustments */
        @media (max-width: 800px) {
            .auth-main-container {
                flex-direction: column;
                height: auto;
                max-width: 95%; 
                min-height: 0; 
                width: 100%; /* Agar mengisi layar pada mobile */
            }

            .panel-left, .panel-right {
                width: 100%;
                padding: 25px 15px; /* Disesuaikan padding mobile */
                min-height: auto; 
                flex: none; /* Hapus flex agar ukuran ditentukan konten */
            }
             .panel-right {
                overflow-y: visible; 
            }


            .panel-left {
                order: 2;
                border-radius: 0 0 15px 15px;
                 padding-bottom: 30px; /* Tambah padding bawah di mobile */
            }

            .panel-right {
                order: 1;
                 border-radius: 15px 15px 0 0;
            }

            .illustration {
                width: 100px; /* Disesuaikan */
                height: 100px; /* Disesuaikan */
                margin-bottom: 15px; /* Disesuaikan */
            }
            .panel-right h2 {
                font-size: 22px; /* Disesuaikan */
                margin-bottom: 15px; /* Disesuaikan */
            }
            .panel-left h2 {
                font-size: 22px; /* Disesuaikan */
            }
             .panel-left p {
                font-size: 13px; /* Disesuaikan */
                margin-bottom: 20px;
            }
            .form-group, .submit-btn, .social-login, .form-wrapper {
                max-width: 100%; /* Menggunakan lebar penuh di mobile */
            }
             .form-group input, .form-group select {
                font-size: 13px; /* Sedikit lebih kecil di mobile */
                padding: 10px 15px 10px 40px;
            }
            .submit-btn {
                padding: 12px 20px;
                font-size: 14px;
            }
        }
         @media (max-width: 400px) {
            .panel-left h2 {
                font-size: 20px;
            }
            .panel-right h2 {
                font-size: 20px;
            }
            .panel-left p {
                font-size: 12px;
            }
            .social-login p {
                font-size: 12px;
            }
             .form-group input, .form-group select, .submit-btn {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-main-container">
        <div class="panel-right">
            <h2>Sign Up</h2>

            {{-- Menampilkan pesan sukses atau error --}}
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 text-center">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600 px-4 py-2 bg-red-100 border border-red-400 rounded-md w-full max-w-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="form-wrapper">
                @csrf

                <div class="form-group">
                    <i class="fas fa-user icon"></i>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Full Name" />
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <i class="fas fa-envelope icon"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Email Address" />
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Nomor Induk Siswa --}}
                <div class="form-group">
                    <i class="fas fa-id-card icon"></i>
                    <input id="student_id" type="text" name="student_id" value="{{ old('student_id') }}" required placeholder="Nomor Induk Siswa" />
                    @error('student_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Jurusan (Dropdown) - Sekarang di bawah Nomor Induk Siswa --}}
                <div class="form-group dropdown-container">
                    <i class="fas fa-book icon"></i>
                    <select id="major_id" name="major_id" required class="block w-full">
                        <option value="">Pilih Jurusan</option>
                        @if(isset($majors))
                            @foreach($majors as $major)
                                <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                    {{ $major->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('major_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tahun Angkatan Lulus (Dropdown) - Sekarang di bawah Jurusan --}}
                <div class="form-group dropdown-container">
                    <i class="fas fa-calendar-alt icon"></i>
                    <select id="graduation_year" name="graduation_year" required class="block w-full">
                        <option value="">Pilih Tahun Lulus</option>
                        @if(isset($years))
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ old('graduation_year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('graduation_year')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- Password dan Konfirmasi Password --}}
                <div class="form-group">
                    <i class="fas fa-lock icon"></i>
                    <input id="password" type="password" name="password" required placeholder="Password" />
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <i class="fas fa-lock icon"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm Password" />
                </div>

                <button type="submit" class="submit-btn">
                    SIGN UP
                </button>

                <div class="social-login">
                    <p>Or Sign up with</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-google"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </form>
        </div>

        <div class="panel-left">
            <div class="illustration sitting-person"></div>
            <h2>Salah satu dari kami?</h2>
            <p>Untuk tetap terhubung dengan kami, silakan login dengan informasi pribadi Anda.</p>
            <a href="{{ route('login') }}" class="action-button">LOGIN</a>
        </div>
    </div>
</body>
</html>
