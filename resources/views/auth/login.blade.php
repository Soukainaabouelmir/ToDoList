<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login') }}</title>
    <link href="{{asset('asset/images/logo3.jpeg')}}" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    
    <!-- Styles personnalisés -->
    <style>
        body {
            background: linear-gradient(135deg, #ffffff, #f0f0f0);
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .login-image {
            flex: 1;
            background: url('{{asset('asset/images/login.jpg')}}') no-repeat center center/cover;
        }

        .login-form {
            flex: 1;
            padding: 40px;
        }

        .login-form h2 {
            color: #2d2c2c;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #2d2c2c;
            font-weight: 500;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        .btn-login {
            background-color: #19ddc1;
            color: #f1f1f1;
            border: none;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0b8875;
            transform: translateY(-2px);
        }

        .invalid-feedback {
            display: block;
            color: #e74c3c;
            margin-top: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 90%;
            }

            .login-image {
                display: none; /* Masquer l'image sur les petits écrans */
            }

            .login-form {
                padding: 20px;
            }
        }
        .text-gray-custom {
    color: rgb(87, 87, 87) !important;
    text-decoration: none;
}

    </style>
</head>
<body>
    <div class="login-container">
        <!-- Image à gauche -->
        <div class="login-image"></div>

        <!-- Formulaire de connexion à droite -->
        <div class="login-form">
            <h2 style="color: #19ddc1">{{ __('Connexion') }}</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Champ email -->
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="password">{{ __('Mot de passe') }}</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group text-center text-gray">
                    <a class="text-gray-custom" href="{{ route('password.request') }}" style="text-decoration: none;" >{{ __('Mot de passe oublié ?') }}</a>
                </div>


                <button type="submit" class="btn btn-login">
                    {{ __('Se connecter') }}
                </button>
            </form>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>