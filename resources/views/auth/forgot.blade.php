<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{ env('APP_NAME')}} - Mot de passe oublié</title>
    <link rel="shortcut icon" class="ronded" href="{{ asset('assets/img/favicon-32x32.png') }}">

    @include('public.css')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-4">Réinitialiser votre mot de passe !</h1>
                                    </div>
                                    <form class="user" id="resetPassForm">
                                    @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control "
                                            id="email" name="email" placeholder="Votre numéro de téléphone" aria-describedby="emailHelp"
                                                 >
                                        </div> 
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control " id="mot_de_passe" name="mot_de_passe" placeholder="Nouveau mot de passe" onkeyup="checkPass(); return false;">
                                        
                                    <span id='message' class="mt-3"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control " id="c_mot_de_passe" name="c_mot_de_passe" placeholder="Confimer le mot de passe" onkeyup="checkPass(); return false;">
                                        
                                    </div>

                                </div>
                                        <a type="button" id="resetPassBtn" onclick="resetPass()" class="btn btn-primary btn-user   btn-block">
                                        Soumettre
                                        </a> 
                                    </form> 
                                    <hr>
                            <div class="text-center">
                                <a class="small" href="/login">Vous avez déjà un compte ? Connectez-vous !</a>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
 
    @include('public.js')

</body>

</html>