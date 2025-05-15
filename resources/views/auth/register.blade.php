@extends('navbar.navbar')

@section('content')
    <style>
        /* Style personnalisé pour le formulaire */
        .card {}

        .card-header {
            background-color: #343a40;
            color: white;
            font-weight: bold;
        }

        .form-control {
            border-radius: 1px;
            padding: 10px;
        }

        .btn-dark-custom {
            background-color: #343a40;
            border: 1px solid #343a40;
            color: #f1f1f1;
            width: 100%;
            padding: 10px;
            border-radius: 1px;
        }

        .btn-dark-custom:hover {
            background-color: #23272b;
            border-color: #f1f1f1;
            color: #f1f1f1;
        }

        .container {
            margin-top: 30px;
        }

        .card {

            margin-bottom: 60px;
        }

        .container-fluide {
            background-color: #0a0a0a;
            color: #f1f1f1;

        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Champ Nom -->
                            <div class="row mb-3">
                                <input type="hidden" name="role_id" value="1">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ Email -->
                            <div class="row mb-3">
                                <label for="email"            
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ Mot de passe -->
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ Confirmation du mot de passe -->
                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- Bouton d'inscription -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark-custom">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluide   footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class=" mb-4">Catalouge</h4>
                    <div class="row g-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="{{ asset('asset/images/melangecake.jpg') }}"
                                alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="{{ asset('asset/images/pancake.jpg') }}"
                                alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="{{ asset('asset/images/rasberycake.jpg') }}"
                                alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="{{ asset('asset/images/cakechoc.jpg') }}"
                                alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="{{ asset('asset/images/cakechoc.jpg') }}"
                                alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="{{ asset('asset/images/pistachecake.jpg') }}"
                                alt="Image">
                        </div>
                        <div class="d-flex pt-2">
                            <a class="btn btn-square btn-outline rounded-circle me-1" href=""><i
                                    class="fab fa-twitter" style="color: #f1f1f1;"></i></a>
                            <a class="btn btn-square btn-outline rounded-circle me-1" href=""><i
                                    class="fab fa-facebook-f" style="color: #f1f1f1;"></i></a>
                            <a class="btn btn-square btn-outline rounded-circle me-1" href=""><i
                                    class="fab fa-youtube" style="color: #f1f1f1;"></i></a>
                            <a class="btn btn-square btn-outline rounded-circle me-0" href=""><i
                                    class="fab fa-linkedin-in" style="color: #f1f1f1;"></i></a>
                                    
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class=" mb-4"> Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Lorem ipsum dolor sit.</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+212678319345</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>dalidamode@gmail.com</p>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class=" mb-4">Conditions générale</h4>

                    <a class="btn btn-link" style="color: #f1f1f1; text-decoration:none;" href="">Conditions
                        d'Utilisation</a>
                    <a class="btn btn-link" style="color: #f1f1f1; text-decoration:none;" href="">Politique de
                        livraison</a>
                    <a class="btn btn-link" style="color: #f1f1f1; text-decoration:none;" href="">Retours et
                        échanges</a>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class=" mb-4">A propose</h4>

                    <a class="btn btn-link" style="color: #f1f1f1; text-decoration:none;" href="">Qui sommes-nous
                        ?</a>

                    <a class="btn btn-link" style="color: #f1f1f1; text-decoration:none;" href="">Contact</a>

                </div>

            </div>
        </div>
        <div class="container-fluid copyright  py-4 wow fadeIn" data-wow-delay="0.1s"
            style="border-top:1px solid #f1f1f1;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#" style="color: #f1f1f1; text-align:center;">Dalidamode.ma.ma</a>, All
                        Right Reserved.
                    </div>

                </div>
            </div>
        </div>
<div class="container-fluid copyright py-4 wow fadeIn">
<div>
    <div><p>link to home page</p></div>
    <div><p>link to home page</p></div>
    <div><p>link to menu page</p></div>
</div>
</div>
        
    </div>
@endsection
