<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Reset & Body Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            /* background-color: #ffffff; */
            /* background-image: url('/storage/profile_images/bglogin dan register.jpg');
            background-size: cover;
            background-position: center; 
            background-repeat: no-repeat;
            */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Main Container for Auth Forms */
        .auth-main-container {
            display: flex;
            width: 900px;
            max-width: 90%;
            height: 550px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            opacity:90%;
        }

        /* Panel Kiri (Informasi/Welcome) */
        .panel-left {
            flex: 1;
            background: linear-gradient(135deg, #FFD700 0%, #FFC600 100%);
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            z-index: -1;
        }

        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 150px;
            height: 150px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: -1;
        }

        .panel-left h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }

        .panel-left p {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 30px;
            max-width: 300px;
            color: #555;
        }

        .panel-left .action-button {
            background: transparent;
            border: 2px solid #333;
            color: #333;
            padding: 12px 30px;
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
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px;
            background-color: white;
        }

        .panel-right h2 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
            max-width: 320px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            font-size: 15px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
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
        }

        .submit-btn {
            width: 100%;
            max-width: 320px;
            padding: 15px 20px;
            background: linear-gradient(135deg, #FFD700 0%, #FFC600 100%);
            color: #333;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 198, 0, 0.3);
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 198, 0, 0.4);
        }

        /* Social Login */
        .social-login {
            margin-top: 25px;
            text-align: center;
            width: 100%;
            max-width: 320px;
        }

        .social-login p {
            color: #888;
            margin-bottom: 15px;
            font-size: 14px;
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
            gap: 15px;
        }

        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid #e0e0e0;
            border-radius: 50%;
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            border-color: #FFD700;
            color: #FFD700;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(255, 215, 0, 0.1);
        }

        /* Illustration */
        .illustration {
            width: 200px;
            height: 200px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            margin-bottom: 30px;
        }

        .illustration.rocket {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23333"><path d="M12 2.5c0 0 4.5 2.04 4.5 10.5 0 2.49-1.04 5.57-1.6 7H9.1c-.56-1.43-1.6-4.51-1.6-7C7.5 4.54 12 2.5 12 2.5zm2 8.5c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zm-6.31 9.52c-.48-1.23-1.52-4.17-1.67-6.87l-1.13.75c-.56.38-.89 1-.89 1.67v3.28c0 .72.43 1.37 1.09 1.65l1.6.67c1.31.54 2.43-.47 2.43-1.83 0-1.17-.81-2.15-1.87-2.32zm12.31 0c-1.06.17-1.87 1.15-1.87 2.32 0 1.36 1.12 2.37 2.43 1.83l1.6-.67c.66-.28 1.09-.93 1.09-1.65v-3.28c0-.67-.33-1.29-.89-1.67l-1.13-.75c-.15 2.7-1.2 5.64-1.67 6.87z"/></svg>');
        }

        /* Forgot Password Link */
        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #888;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #FFD700;
        }

        /* Responsive Adjustments */
        @media (max-width: 800px) {
            .auth-main-container {
                flex-direction: column;
                height: auto;
            }

            .panel-left, .panel-right {
                width: 100%;
                padding: 30px;
            }

            .panel-left {
                order: 2;
                border-radius: 0 0 15px 15px;
            }

            .panel-right {
                order: 1;
            }

            .illustration {
                width: 150px;
                height: 150px;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-main-container">
        <div class="panel-left">
            <div class="illustration rocket"></div>
            <h2>Baru di sini?</h2>
            <p>Daftar sekarang dan bergabunglah dengan komunitas kami untuk mendapatkan akses penuh.</p>
            <a href="{{ route('register') }}" class="action-button">DAFTAR</a>
        </div>

        <div class="panel-right">
            <h2>Sign In</h2>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <i class="fas fa-envelope icon"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email" />
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <i class="fas fa-lock icon"></i>
                    <input id="password" type="password" name="password" required placeholder="Password" />
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    LOGIN
                </button>

                <div class="social-login">
                    <p>Atau masuk dengan</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-google"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </form>
        </div>
    </div>
</body>
</html>