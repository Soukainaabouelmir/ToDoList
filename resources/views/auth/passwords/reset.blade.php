<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réinitialisation du mot de passe</title> 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.8s ease-out;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }

        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
            background: none;
            border: none;
        }

        .card-body {
            padding: 20px;
        }   
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:hover,
        .form-control:focus {
            border-color: #1abc9c;
            box-shadow: 0 0 8px rgba(26, 188, 156, 0.3);
        }

      
        .btn-primary {
            background-color: #1abc9c;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #16a085;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(26, 188, 156, 0.4);
        }

       
        .alert {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .text-danger {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
        }
   
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .card-img {
            width: 100px;
            height: auto;
            margin: 0 auto 20px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card"> 
                    <div class="card-header">{{ __('Nouveau mot de passe') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">   
                            <div class="form-group mb-4">
                                <label for="email" class="form-label">{{ __('Adresse Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg" required>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
                                <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>    
                            <div class="form-group mb-4">
                                <label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary mt-3">
                                    {{ __('Réinitialiser le mot de passe') }}
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>